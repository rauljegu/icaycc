<?php
/*
 * Módulo de administración de Actualidad.
 * Incluir este archivo después de connect.php y antes de cualquier HTML.
 * Requiere: $connect como conexión MySQLi.
 */

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($connect) || !($connect instanceof mysqli)) {
    die('No se encontró una conexión MySQLi válida en $connect.');
}

if (empty($_SESSION['csrf_actualidad'])) {
    $_SESSION['csrf_actualidad'] = bin2hex(random_bytes(32));
}

$actualidadBaseFisica = dirname(__DIR__, 3) . '/assets/img/actualidad/';
$actualidadBaseRelativa = 'assets/img/actualidad/';
$actualidadError = null;
$actualidadFlash = $_SESSION['mensaje_actualidad'] ?? null;
unset($_SESSION['mensaje_actualidad']);

/* ==========================================
   REGISTRAR / ACTUALIZAR PUBLICACIÓN
   ========================================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_actualidad'])) {
    $imagenNuevaFisica = null;

    try {
        if (
            empty($_POST['csrf_actualidad']) ||
            !hash_equals($_SESSION['csrf_actualidad'], $_POST['csrf_actualidad'])
        ) {
            throw new Exception('La sesión del formulario no es válida. Recarga la página e inténtalo nuevamente.');
        }

        $idActualidad = filter_var($_POST['id_actualidad'] ?? 0, FILTER_VALIDATE_INT);
        if ($idActualidad === false || $idActualidad < 0) {
            throw new Exception('Identificador de publicación no válido.');
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $enlaceMas = trim($_POST['enlace_mas'] ?? '');
        $enlaceCartel = trim($_POST['enlace_cartel'] ?? '');
        $fechaPublicacion = trim($_POST['fecha_publicacion'] ?? '');
        $fechaDespublicacion = trim($_POST['fecha_despublicacion'] ?? '');
        $orden = filter_var($_POST['orden'] ?? null, FILTER_VALIDATE_INT);
        $activo = isset($_POST['activo']) ? 1 : 0;

        if ($titulo === '' || mb_strlen($titulo) > 255) {
            throw new Exception('El título es obligatorio y no debe superar 255 caracteres.');
        }

        if ($orden === false || $orden === null || $orden < 1) {
            throw new Exception('El orden debe ser un número entero mayor o igual a 1.');
        }

        $inicio = DateTime::createFromFormat('!Y-m-d', $fechaPublicacion);
        if (!$inicio || $inicio->format('Y-m-d') !== $fechaPublicacion) {
            throw new Exception('La fecha de publicación no es válida.');
        }

        if ($fechaDespublicacion !== '') {
            $fin = DateTime::createFromFormat('!Y-m-d', $fechaDespublicacion);
            if (!$fin || $fin->format('Y-m-d') !== $fechaDespublicacion) {
                throw new Exception('La fecha de despublicación no es válida.');
            }
            if ($fechaDespublicacion < $fechaPublicacion) {
                throw new Exception('La fecha de despublicación no puede ser anterior a la fecha de publicación.');
            }
        }

        foreach ([$enlaceMas, $enlaceCartel] as $url) {
            if ($url !== '') {
                $partes = parse_url($url);
                if (
                    filter_var($url, FILTER_VALIDATE_URL) === false ||
                    !isset($partes['scheme']) ||
                    !in_array(strtolower($partes['scheme']), ['http', 'https'], true)
                ) {
                    throw new Exception('Los enlaces deben ser direcciones URL válidas que comiencen con http:// o https://.');
                }
            }
        }

        $imagenAnterior = null;

        if ($idActualidad > 0) {
            $stmtAnterior = $connect->prepare('SELECT imagen FROM actualidad WHERE id_actualidad = ? LIMIT 1');
            if (!$stmtAnterior) {
                throw new Exception('No fue posible preparar la consulta de edición.');
            }
            $stmtAnterior->bind_param('i', $idActualidad);
            $stmtAnterior->execute();
            $registroAnterior = $stmtAnterior->get_result()->fetch_assoc();
            $stmtAnterior->close();

            if (!$registroAnterior) {
                throw new Exception('La publicación que intentas editar no existe.');
            }
            $imagenAnterior = $registroAnterior['imagen'];
        }

        $archivo = $_FILES['imagen'] ?? null;
        $hayArchivo = $archivo && $archivo['error'] !== UPLOAD_ERR_NO_FILE;

        if ($hayArchivo) {
            if ($archivo['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('Ocurrió un error durante la carga de la imagen.');
            }

            if ($archivo['size'] > 5 * 1024 * 1024) {
                throw new Exception('La imagen no debe superar los 5 MB.');
            }

            if (!is_uploaded_file($archivo['tmp_name'])) {
                throw new Exception('El archivo recibido no es una carga válida.');
            }

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($archivo['tmp_name']);
            $formatos = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp'
            ];

            if (!isset($formatos[$mime]) || @getimagesize($archivo['tmp_name']) === false) {
                throw new Exception('Formato de imagen no permitido. Utiliza JPG, PNG o WebP.');
            }

            if (!is_dir($actualidadBaseFisica) || !is_writable($actualidadBaseFisica)) {
                throw new Exception('El directorio de imágenes no existe o Apache no tiene permisos de escritura.');
            }

            $nombreImagen = bin2hex(random_bytes(16)) . '.' . $formatos[$mime];
            $imagenNuevaFisica = $actualidadBaseFisica . $nombreImagen;

            if (!move_uploaded_file($archivo['tmp_name'], $imagenNuevaFisica)) {
                $imagenNuevaFisica = null;
                throw new Exception('No se pudo guardar la imagen en el servidor.');
            }

            $rutaImagen = $actualidadBaseRelativa . $nombreImagen;
        } else {
            if ($idActualidad === 0) {
                throw new Exception('Debes seleccionar una imagen para la nueva publicación.');
            }
            $rutaImagen = $imagenAnterior;
        }

        if ($idActualidad > 0) {
            $sql = "UPDATE actualidad
                    SET titulo = ?,
                        imagen = ?,
                        enlace_mas = NULLIF(?, ''),
                        enlace_cartel = NULLIF(?, ''),
                        fecha_publicacion = ?,
                        fecha_despublicacion = NULLIF(?, ''),
                        orden = ?,
                        activo = ?
                    WHERE id_actualidad = ?";

            $stmt = $connect->prepare($sql);
            if (!$stmt) {
                throw new Exception('No fue posible preparar la actualización.');
            }

            $stmt->bind_param(
                'ssssssiii',
                $titulo,
                $rutaImagen,
                $enlaceMas,
                $enlaceCartel,
                $fechaPublicacion,
                $fechaDespublicacion,
                $orden,
                $activo,
                $idActualidad
            );
            $operacion = 'actualizada';
        } else {
            $sql = "INSERT INTO actualidad
                    (titulo, imagen, enlace_mas, enlace_cartel,
                     fecha_publicacion, fecha_despublicacion, orden, activo)
                    VALUES (?, ?, NULLIF(?, ''), NULLIF(?, ''),
                            ?, NULLIF(?, ''), ?, ?)";

            $stmt = $connect->prepare($sql);
            if (!$stmt) {
                throw new Exception('No fue posible preparar el registro.');
            }

            $stmt->bind_param(
                'ssssssii',
                $titulo,
                $rutaImagen,
                $enlaceMas,
                $enlaceCartel,
                $fechaPublicacion,
                $fechaDespublicacion,
                $orden,
                $activo
            );
            $operacion = 'registrada';
        }

        if (!$stmt->execute()) {
            $errorSql = $stmt->error;
            $stmt->close();
            throw new Exception('No se pudo guardar la publicación: ' . $errorSql);
        }
        $stmt->close();

        // La imagen anterior se elimina únicamente después de guardar la nueva ruta.
        if ($idActualidad > 0 && $hayArchivo && $imagenAnterior) {
            $nombreAnterior = basename($imagenAnterior);
            $rutaAnterior = $actualidadBaseFisica . $nombreAnterior;

            if (is_file($rutaAnterior)) {
                @unlink($rutaAnterior);
            }
        }

        $_SESSION['mensaje_actualidad'] = [
            'tipo' => 'success',
            'texto' => 'Publicación ' . $operacion . ' correctamente.'
        ];

        header('Location: secciones.php#actualidad-admin');
        exit;

    } catch (Throwable $e) {
        if ($imagenNuevaFisica && is_file($imagenNuevaFisica)) {
            @unlink($imagenNuevaFisica);
        }
        $actualidadError = $e->getMessage();
    }
}

/* ==========================================
   CARGAR PUBLICACIÓN PARA EDICIÓN
   ========================================== */
$edicionActualidad = null;

if (isset($_GET['editar_actualidad'])) {
    $idEditar = filter_var($_GET['editar_actualidad'], FILTER_VALIDATE_INT);

    if ($idEditar && $idEditar > 0) {
        $stmtEditar = $connect->prepare('SELECT * FROM actualidad WHERE id_actualidad = ? LIMIT 1');
        $stmtEditar->bind_param('i', $idEditar);
        $stmtEditar->execute();
        $edicionActualidad = $stmtEditar->get_result()->fetch_assoc();
        $stmtEditar->close();

        if (!$edicionActualidad) {
            $actualidadError = 'La publicación solicitada no existe.';
        }
    } else {
        $actualidadError = 'El identificador de publicación no es válido.';
    }
}

/* ==========================================
   LISTADO Y PAGINACIÓN
   Publicadas, programadas, finalizadas e inactivas.
   ========================================== */
$actualidadPorPagina = 10;
$actualidadPagina = max(1, (int)($_GET['pagina'] ?? 1));

$resultTotalActualidad = $connect->query('SELECT COUNT(*) AS total FROM actualidad');
if (!$resultTotalActualidad) {
    die('Error al contar las publicaciones: ' . $connect->error);
}

$totalActualidad = (int)$resultTotalActualidad->fetch_assoc()['total'];
$totalPaginasActualidad = max(1, (int)ceil($totalActualidad / $actualidadPorPagina));
$actualidadPagina = min($actualidadPagina, $totalPaginasActualidad);
$actualidadOffset = ($actualidadPagina - 1) * $actualidadPorPagina;

$sqlListadoActualidad = "
    SELECT *
    FROM actualidad
    ORDER BY
        CASE
            WHEN activo = 0 THEN 3
            WHEN fecha_despublicacion IS NOT NULL
                 AND fecha_despublicacion < CURDATE() THEN 2
            WHEN fecha_publicacion > CURDATE() THEN 1
            ELSE 0
        END ASC,
        orden ASC,
        fecha_publicacion ASC,
        fecha_registro DESC
    LIMIT ? OFFSET ?
";

$stmtListadoActualidad = $connect->prepare($sqlListadoActualidad);
if (!$stmtListadoActualidad) {
    die('Error al preparar el listado de actualidad: ' . $connect->error);
}
$stmtListadoActualidad->bind_param('ii', $actualidadPorPagina, $actualidadOffset);
$stmtListadoActualidad->execute();
$resultActualidad = $stmtListadoActualidad->get_result();
