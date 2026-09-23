<?php
include '../../includes/connect.php';
session_start();
$conn = $connect;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    // Validar id_usuario
    if (!isset($_POST['id_usuario']) || !is_numeric($_POST['id_usuario'])) {
        echo json_encode(["status" => "error", "mensaje" => "ID de usuario inválido."]);
        exit;
    }
    
    $id_usuario = (int) $_POST['id_usuario'];
    $carpeta_destino = "img/perfil/";

    // Crear la carpeta si no existe
    if (!is_dir($carpeta_destino) && !mkdir($carpeta_destino, 0777, true) && !is_dir($carpeta_destino)) {
        echo json_encode(["status" => "error", "mensaje" => "No se pudo crear la carpeta de destino."]);
        exit;
    }

    $archivo = $_FILES['foto'];
    $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
    $nombre_archivo = "perfil_" . $id_usuario . "_" . time() . "." . $extension;
    $ruta_destino = $carpeta_destino . $nombre_archivo;

    // Validar tipo de archivo con finfo_file
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $tipo_real = finfo_file($finfo, $archivo['tmp_name']);
    finfo_close($finfo);

    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'tiff'];
    $mime_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/tiff'];

    if (!in_array($extension, $extensiones_permitidas) || !in_array($tipo_real, $mime_permitidos)) {
        echo json_encode(["status" => "error", "mensaje" => "Formato de imagen no válido. Solo JPG, PNG y GIF."]);
        exit;
    }

    // Validar tamaño del archivo (máx. 2MB)
    if ($archivo['size'] > 2 * 1024 * 1024) {
        echo json_encode(["status" => "error", "mensaje" => "El archivo es demasiado grande. Máximo 2MB."]);
        exit;
    }

    // Mover el archivo al directorio de destino
    if (!move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
        echo json_encode(["status" => "error", "mensaje" => "Error al mover la foto al servidor."]);
        exit;
    }

    // Iniciar transacción en la base de datos
    $conn->begin_transaction();
    
    try {
        // Verificar si el usuario ya tiene una foto registrada
        $sql_check = "SELECT foto FROM datos_users WHERE id_user = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("i", $id_usuario);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($row = $result_check->fetch_assoc()) {
            $foto_anterior = $carpeta_destino . $row['foto'];
            
            // Verificar si el archivo existe antes de eliminar
            if ($row['foto'] && file_exists($foto_anterior)) {
                unlink($foto_anterior);
            }

            // Actualizar la foto en la base de datos
            $sql_update = "UPDATE datos_users SET foto = ? WHERE id_user = ?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("si", $nombre_archivo, $id_usuario);
        } else {
            // Insertar nuevo registro si no existe
            $sql_insert = "INSERT INTO datos_users (foto, id_user) VALUES (?, ?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bind_param("si", $nombre_archivo, $id_usuario);
			if (!$stmt->execute()) {
				throw new Exception("Error en la inserción: " . $stmt->error);
			}
        }

        // Ejecutar consulta
        if (!$stmt->execute()) {
            throw new Exception("Error al guardar la foto: " . $stmt->error);
        }

        // Confirmar transacción
        $conn->commit();
		error_log("Respuesta JSON: " . json_encode(["status" => "success", "mensaje" => "Foto guardada correctamente.", "ruta" => $ruta_destino]));
        echo json_encode(["status" => "success", "mensaje" => "Foto guardada correctamente.", "ruta" => $ruta_destino]);

        // Cerrar conexiones
        $stmt->close();
        $stmt_check->close();
    } catch (Exception $e) {
        // Revertir cambios en caso de error
        $conn->rollback();
        echo json_encode(["status" => "error", "mensaje" => $e->getMessage()]);
		exit;
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "mensaje" => "No se recibió ningún archivo."]);
	exit;
}
?>
