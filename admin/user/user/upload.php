<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];

    // CARGA DEL TEXTO
    $uploadDir = "../recibidos/";
    $allowedTypes = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword'];
    $maxSize = 5 * 1024 * 1024; // 5MB

    if (!isset($_FILES['paper']) || $_FILES['paper']['error'] !== UPLOAD_ERR_OK) {
        die(json_encode(["status" => "error", "message" => "Error al subir el archivo del texto."]));
    }

    $file = $_FILES['paper'];
    $fileType = mime_content_type($file['tmp_name']);
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileSize = $file['size'];
    $fileName = date("Y_m_d") . "_" . preg_replace("/[^a-zA-Z0-9_\-]/", "_", $titulo) . "." . $fileExtension;
    $filePath = $uploadDir . $fileName;

    if (!in_array($fileType, $allowedTypes)) {
        die(json_encode(["status" => "error", "message" => "Solo se permiten archivos .doc o .docx"]));
    }

    if ($fileSize > $maxSize) {
        die(json_encode(["status" => "error", "message" => "El archivo no debe superar los 5MB"]));
    }

    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        die(json_encode(["status" => "error", "message" => "No se pudo mover el archivo del texto."]));
    }

    // CARGA DE LA IMAGEN EN FORMATO WORD (OPCIONAL)
    $fileName1 = NULL; 
    if (isset($_FILES['paper_img']) && $_FILES['paper_img']['error'] === UPLOAD_ERR_OK) {
        $uploadDir1 = "../recibidos/img/";
		$maxSize1 = 2 * 1024 * 1024 * 1024; // 2 GiB
        $file1 = $_FILES['paper_img'];
        $fileType1 = mime_content_type($file1['tmp_name']);
        $fileExtension1 = pathinfo($file1['name'], PATHINFO_EXTENSION);
        $fileSize1 = $file1['size'];
        $fileName1 = date("Y_m_d") . "_IMG_" . preg_replace("/[^a-zA-Z0-9_\-]/", "_", $titulo) . "." . $fileExtension1;
        $filePath1 = $uploadDir1 . $fileName1;

        if (!in_array($fileType1, $allowedTypes)) {
            die(json_encode(["status" => "error", "message" => "Solo se permiten archivos .doc o .docx para la imagen."]));
        }

        if ($fileSize1 > $maxSize1) {
            die(json_encode(["status" => "error", "message" => "El archivo no debe superar los 2GB"]));
        }

        if (!move_uploaded_file($file1['tmp_name'], $filePath1)) {
            die(json_encode(["status" => "error", "message" => "No se pudo mover el archivo de la imagen."]));
        }
    }

    // CONEXIÓN A LA BASE DE DATOS
    include 'conexion.php';
    if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Error de conexión a la base de datos: " . $conn->connect_error]));
    }

    // VALIDACIÓN DE DATOS REQUERIDOS
    if (!isset($_POST['titulo'], $_POST['abstract'], $_POST['palabras'], $_POST['autores'], $_SESSION['id'])) {
        die(json_encode(["status" => "error", "message" => "Faltan datos en la solicitud."]));
    }

    $fecha = date("Y/m/d");
    $tipo = $_POST['tipo'];
    $tema = $_POST['tema'];
    $abstract = $_POST['abstract'];
    $autores = is_array($_POST['autores']) ? $_POST['autores'] : [$_POST['autores']];
    $pclave = is_array($_POST['palabras']) ? implode(", ", $_POST['palabras']) : $_POST['palabras'];
    $status = 0;
	// Verificar si las variables POST están definidas
	if (!isset($_POST['titulo'], $_POST['abstract'], $_POST['tema'], $_POST['palabras'], $_POST['autores'])) {
    die(json_encode(["status" => "error", "message" => "Faltan datos en la solicitud."]));
	}
	if (empty($_POST['abstract'])) {
    die(json_encode(["status" => "error", "message" => "Falta el abstract."]));
	}
	if (empty($_POST['correspondencia'])) {
    die(json_encode(["status" => "error", "message" => "Agregue al menos un autor de correspondencia."]));
	}
    // INSERTAR EN LA TABLA 'recibidos'
    $stmt = $conn->prepare("INSERT INTO recibidos (fecha, id_tipopub, titulo, abstract, palabras_clave, autores, archivo, imagenes, user_id, status, tema) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
			ob_clean();
        die( json_encode(["status" => "error", "message" => "Error al preparar la consulta: " . $conn->error]));
		exit;
    }
	
    $autoresLista = implode(", ", $autores);
    $stmt->bind_param("sissssssiii", $fecha, $tipo, $titulo, $abstract, $pclave, $autoresLista, $fileName, $fileName1, $_SESSION['id'], $status, $tema);

    if ($stmt->execute()) {
        $recibido_id = $stmt->insert_id; // Obtener el ID del documento recién insertado

        // PROCESAR AUTORES Y DETALLES
        if (isset($_POST['adscripcion'], $_POST['correos'], $_POST['correspondencia'])) {
            $adscripcion = is_array($_POST['adscripcion']) ? $_POST['adscripcion'] : [$_POST['adscripcion']];
            $correos = is_array($_POST['correos']) ? $_POST['correos'] : [$_POST['correos']];
            $correspondencia = is_array($_POST['correspondencia']) ? $_POST['correspondencia'] : [$_POST['correspondencia']];
			
			

            $stmt_autores = $conn->prepare("INSERT INTO autores_detalles (recibido_id, nombre_autor, adscripcion, correo, correspondencia) VALUES (?, ?, ?, ?, ?)");

            if (!$stmt_autores) {
				
                die( json_encode(["status" => "error", "message" => "Error al preparar la consulta de autores: " .$conn->error]));
				//echo json_encode(["status" => "error", "message" => "Error al preparar la consulta de autores"]);
							//exit();
            }
			
            // Insertar cada autor con su información
            for ($i = 0; $i < count($autores); $i++) {
                $autor = $autores[$i] ?? null;
                $ads = $adscripcion[$i] ?? null;
                $correo = $correos[$i] ?? null;
                $corr = $correspondencia[$i] ?? null;

                $stmt_autores->bind_param("issss", $recibido_id, $autor, $ads, $correo, $corr);
                $stmt_autores->execute();
            }

            $stmt_autores->close();
        }
		/////CORREO//////
		$c = "";
		require("src/PHPMailer.php");
		require("src/SMTP.php");
		require("src/Exception.php");


$partes_ruta = pathinfo($_SERVER["PHP_SELF"]); 
					//$url=  $_SERVER["HTTP_HOST"].$partes_ruta['dirname'];
					$url=  $_SERVER["HTTP_HOST"];
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0; // 0 para producción
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->IsHTML(true);
		$mail->Username = "";
		$mail->Password = "";
		$mail->CharSet = 'UTF-8';
		$mail->SetFrom("no-reply@facmed.unam.mx", "GACETASD");
		$mail->Subject = "Tienes un mensaje nuevo de GacetaSD";
		$mail->Body = "
			
			<p>Han enviado un escrito para revisón</p>
			<p><a href='https://".$_SERVER["HTTP_HOST"]."/gacetaSD/' target='_blank'> Ir al sitio de la gaceta:</a> http://$url/gacetaSD/</p>	
			<p>Si usted tiene algún problema técnico, le pedimos contactarnos al correo: gacetasd@facmed.unam.mx</p>
		";
		$mail->AddAddress($c);

		if (!$mail->Send()) {
			//error_log("Error al enviar el correo: " . $mail->ErrorInfo);
			echo json_encode(["status" => "error", "message" => "Error al enviar el correo."]);
		} else {
					
					

		}	
		/////CORREO//////	
        echo json_encode(["status" => "success", "message" => "Artículo enviado correctamente."]);
    } else {
       // die(json_encode(["status" => "error", "message" => "Error al guardar en la base de datos: " . addslashes($stmt->error)]));
       echo json_encode(["status" => "error", "message" => "Error al guardar en la base de datos."]);
    }

    $stmt->close();
    $conn->close();
}
?>