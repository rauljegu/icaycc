<?php
///error_reporting(E_ALL);
//ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\SMTP;
header('Content-Type: application/json');								   								   
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$titulo = $_POST['titulo'];
	//CARGA DEL TEXTO
    $uploadDir = "../corregidos/";
    $allowedTypes = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword'];
    $maxSize = 5 * 1024 * 1024; // 5MB

    if (!isset($_FILES['paper']) || $_FILES['paper']['error'] !== UPLOAD_ERR_OK) {
        die(json_encode(["status" => "error", "message" => "Error al subir el archivo."]));
    }

    $file = $_FILES['paper'];
    $fileType = mime_content_type($file['tmp_name']);
	$fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileSize = $file['size'];
    
	$fileName = "correccion_".date("Y_m_d_H_i") . "_" . preg_replace("/[^a-zA-Z0-9_\-]/", "_", $titulo).".".$fileExtension;
    $filePath = $uploadDir . $fileName;

    if (!in_array($fileType, $allowedTypes)) {
        die(json_encode(["status" => "error", "message" => "Solo se permiten archivos .doc o .docx para el texto"]));
    }

    if ($fileSize > $maxSize) {
        die(json_encode(["status" => "error", "message" => "El archivo no debe superar los 5MB"]));
    }

    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        die(json_encode(["status" => "error", "message" => "No se pudo mover el archivo."]));
    }
	//CARGA DEL IMAGENES
	$fileName1 = NULL; 	
	if (!isset($_FILES['paper_img']) || $_FILES['paper_img']['error'] === UPLOAD_ERR_OK) {
        $uploadDir1 = "../corregidos/img/";
	
		$maxSize1 = 2 * 1024 * 1024 * 1024; // 2 GiB	
		$file1 = $_FILES['paper_img'];
		$fileType1 = mime_content_type($file1['tmp_name']);
		$fileExtension1 = pathinfo($file1['name'], PATHINFO_EXTENSION);
		$fileSize1 = $file1['size'];
		$fileName1 = "correccion__IMG_".date("Y_m_d_H_i")."_". preg_replace("/[^a-zA-Z0-9_\-]/", "_", $titulo).".".$fileExtension1;
		$filePath1 = $uploadDir1 . $fileName1;

		if (!in_array($fileType1, $allowedTypes)) {
			die(json_encode(["status" => "error", "message" => "Solo se permiten archivos .doc o .docx para las imagenes"]));
		}

		if ($fileSize1 > $maxSize1) {
			die(json_encode(["status" => "error", "message" => "El archivo no debe superar los 2GB"]));
		}

		if (!move_uploaded_file($file1['tmp_name'], $filePath1)) {
			die(json_encode(["status" => "error", "message" => "No se pudo mover el archivo."]));
		}	
	}	
		
    // Guardar en BD (si aplica)
    include 'conexion.php';

	// Verificar si la conexión es válida
	if ($conn->connect_error) {
		die(json_encode(["status" => "error", "message" => "Error de conexión a la base de datos: " . $conn->connect_error]));
	}

	// Verificar si las variables POST están definidas
	if (!isset($_POST['titulo'], $_POST['comentarios'], $_POST['id_recibidos'], $_POST['user_id'], $_POST['id_revisor'])) {
		die(json_encode(["status" => "error", "message" => "Faltan datos en la solicitud."]));
	}
	$fecha = date("Y/m/d");
	$comentarios = $_POST['comentarios'];
	$id_recibidos = $_POST['id_recibidos'];
	$user_id = $_POST['user_id'];
	$revisor = $_POST['id_revisor'];
	$status = 7;
	if(isset($_POST["envio"])){
		$cor=$_POST["envio"];
		if($_POST["envio"] > 0){
			$cor = ++$cor; 
		} else {
			$cor = 1;
		}
	}
	
	$stmt = $conn->prepare("INSERT INTO corregidos (fecha, id_recibidos, user_id, archivo, imagenes, comentarios,id_revisor, correccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

	// Verificar si la preparación de la consulta fue exitosa
	if (!$stmt) {
		die(json_encode(["status" => "error", "message" => "Error al preparar la consulta: " . $conn->error]));
	}

	$stmt->bind_param("siisssii", $fecha, $id_recibidos, $user_id, $fileName, $fileName1, $comentarios, $revisor,$cor);

	// Ejecutar y verificar si la consulta fue exitosa
	if ($stmt->execute()) {
		///ACTUALIZAR BD  RECIBIDOS
		$stmt1 = $conn->prepare("UPDATE recibidos SET status = ? WHERE id_recibidos = ? ");
		if (!$stmt1) {
			die(json_encode(["status" => "error", "message" => "Error al preparar la consulta: " . $conn->error]));
		}
		$stmt1->bind_param("ii", $status, $id_recibidos);
		if ($stmt1->execute()) {
	ob_clean();
	//echo json_encode(["status" => "success", "message" => "Recibidos actualizada correctamente."]);
	//exit;
	$revi="SELECT id_user FROM revisores WHERE id_revisor = '$revisor'";
	 include '../../includes/connect.php';
							$connect = $conn;
	$rrevi=$conn->query($revi);
	$rrevirow=$rrevi->fetch_assoc();
	$uir=$rrevirow["id_user"];

	/////CORREO//////
	$partes_ruta = pathinfo($_SERVER["PHP_SELF"]); 
					//$url=  $_SERVER["HTTP_HOST"].$partes_ruta['dirname'];
					$url=  $_SERVER["HTTP_HOST"];
	$correo="SELECT correo FROM users WHERE id = '$uir'";
	 include '../../includes/connect.php';
							$connect = $conn;
	$rcorreo=$conn->query($correo);
	$rcorreorow=$rcorreo->fetch_assoc();
	$destinatario=$rcorreorow["correo"];
	include'../../assets/enviar_correo.php';
					$asunto= "Tienes un mensaje nuevo de GacetaSD";
					$cuerpo= "
						
						<p>Te han enviado las correcciones de ".$fileName." que solicitaste.  Ingresa a tu perfil para revisarlas: </p>
						<p><a href='https://$url/gacetaSD/' target='_blank'>Ir al sitio de la gaceta: </a> href='https://$url/gacetaSD/</p>	
						<p>Si usted tiene algún problema técnico, le pedimos contactarnos al correo: gacetasd@facmed.unam.mx</p>
					";
				
					enviarCorreo($destinatario, $asunto, $cuerpo, $adjunto = null);	
	/////CORREO//////	
			
			
		} else { die(json_encode(["status" => "error", "message" => "Error al actualizar en la base de recibidos: " . $stmt1->error])); }
	} else {
		die(json_encode(["status" => "error", "message" => "Error al guardar en la base de datos: " . $stmt->error]));
	}
		$stmt->close();
		$conn->close();
}
	echo json_encode(["status" => "success", "message" => "Archivo subido correctamente."]);
exit;					 
?>
