
<?php
header('Content-Type: application/json; charset=utf-8');

include '../../includes/connect.php';
$connect = $conn;

session_start();

function responder($status, $mensaje, $extra = []) {
    echo json_encode(
        array_merge([
            "status" => $status,
            "mensaje" => $mensaje
        ], $extra),
        JSON_UNESCAPED_UNICODE
    );
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    responder("error", "Método no permitido.");
}

if (
    !isset($_FILES['foto']) ||
    !isset($_POST['id_usuario'], $_POST['mail'])
) {
    responder("error", "Faltan datos para procesar la fotografía.");
}

$archivo = $_FILES['foto'];
$id_usuario = $_POST['id_usuario'];
$mail = trim($_POST['mail']);

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    responder("error", "El correo electrónico no es válido.");
}

if ($archivo['error'] !== UPLOAD_ERR_OK) {
    responder("error", "Error PHP en la subida. Código: " . $archivo['error']);
}

if (!is_uploaded_file($archivo['tmp_name'])) {
    responder("error", "El archivo recibido no es una subida válida.");
}

/* Validar tamaño: máximo 20 MB */
if ($archivo['size'] > 20 * 1024 * 1024) {
    responder("error", "La imagen supera los 20 MB permitidos.");
}

/* Validar extensión */
$extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

$extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];

if (!in_array($extension, $extensiones_permitidas, true)) {
    responder("error", "Extensión de archivo no permitida.");
}

/* Validar tipo real de imagen */
$tipo = exif_imagetype($archivo['tmp_name']);

$tipos_permitidos = [
    IMAGETYPE_JPEG => ['jpg', 'jpeg'],
    IMAGETYPE_PNG  => ['png'],
    IMAGETYPE_GIF  => ['gif']
];

if (
    $tipo === false ||
    !isset($tipos_permitidos[$tipo]) ||
    !in_array($extension, $tipos_permitidos[$tipo], true)
) {
    responder("error", "El archivo no es una imagen válida o su extensión no coincide.");
}

/* Directorio de destino */
$carpeta_destino = realpath(__DIR__ . '/../../../investigadores/img/');

if ($carpeta_destino === false || !is_writable($carpeta_destino)) {
	error_log("Ruta calculada: " . __DIR__ . '/../../../investigadores/img/');
error_log("Ruta real: " . var_export(realpath(__DIR__ . '/../../../investigadores/img/'), true));
error_log("Existe directorio: " . (is_dir(__DIR__ . '/../../../investigadores/img/') ? 'SI' : 'NO'));
error_log("Escribible desde PHP: " . (is_writable(__DIR__ . '/../../../investigadores/img/') ? 'SI' : 'NO'));
	
    error_log("Directorio inexistente o sin permisos de escritura: " .
        __DIR__ . '/../../../investigadores/img/');

    responder("error", "El directorio de fotografías no está disponible para escritura.");
}

/* Nombre de archivo */
$id_seguro = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$id_usuario);

if ($id_seguro === '') {
    responder("error", "Identificador de usuario no válido.");
}

$nombre_archivo = 'perfil_' . $id_seguro . '_' .
    bin2hex(random_bytes(6)) . '.' . $extension;

$ruta_destino = $carpeta_destino . DIRECTORY_SEPARATOR . $nombre_archivo;

/* Recuperar fotografía anterior */
$sql_check = "SELECT foto FROM personal WHERE correo = ?";
$stmt_check = $connect->prepare($sql_check);

if (!$stmt_check) {
    error_log("Error preparando consulta de fotografía: " . $connect->error);
    responder("error", "No fue posible consultar la fotografía anterior.");
}

$stmt_check->bind_param("s", $mail);
$stmt_check->execute();

$result = $stmt_check->get_result();
$row = $result->fetch_assoc();

$foto_anterior = $row['foto'] ?? '';

$stmt_check->close();

/* Mover archivo */
if (!move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
    error_log("No se pudo mover el archivo a: " . $ruta_destino);
    responder("error", "Error al guardar la imagen.");
}

/* Actualizar base de datos */
$sql_update = "UPDATE personal SET foto = ? WHERE correo = ?";
$stmt = $connect->prepare($sql_update);

if (!$stmt) {
    @unlink($ruta_destino);
    error_log("Error preparando actualización: " . $connect->error);
    responder("error", "No fue posible preparar la actualización.");
}

$stmt->bind_param("ss", $nombre_archivo, $mail);

if (!$stmt->execute()) {
    @unlink($ruta_destino);
    error_log("Error actualizando fotografía: " . $stmt->error);

    $stmt->close();
    $connect->close();

    responder("error", "No fue posible actualizar la fotografía.");
}

/* Eliminar fotografía anterior después de actualizar */
if (!empty($foto_anterior) && $foto_anterior !== $nombre_archivo) {
    $nombre_anterior = basename($foto_anterior);
    $ruta_anterior = $carpeta_destino . DIRECTORY_SEPARATOR . $nombre_anterior;

    if (is_file($ruta_anterior)) {
        @unlink($ruta_anterior);
    }
}

$stmt->close();
$connect->close();

responder("success", "Foto actualizada correctamente.", [
    "archivo" => $nombre_archivo
]);
?>