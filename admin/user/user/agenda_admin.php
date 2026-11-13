<?php
/*
 * Agenda ICAyCC - lógica administrativa.
 * Incluir desde admin/user/user/secciones.php ANTES de imprimir HTML.
 * Requiere que $connect sea una conexión MySQLi activa.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_agenda'])) {
    $_SESSION['csrf_agenda'] = bin2hex(random_bytes(32));
}

$agendaMensaje = '';
$agendaEditar = null;
$agendaPorPagina = 10;
$agendaPagina = max(1, (int)($_GET['pagina_agenda'] ?? 1));

$agendaDirectorioFisico = dirname(__DIR__, 3) . '/assets/img/eventos/';
$agendaDirectorioRelativo = 'assets/img/eventos/';

function agenda_h($valor): string {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}
function agenda_validar_fecha_hora($valor): bool {
    $dt = DateTime::createFromFormat('!Y-m-d\TH:i', (string)$valor);
    return $dt && $dt->format('Y-m-d\TH:i') === $valor;
}
function agenda_sanitizar_descripcion(string $html): string {
    $html = trim($html);
    if ($html === '') return '';

    $html = preg_replace('~<(script|style|iframe|object|embed|svg|math|form|input|button)\\b[^>]*>.*?</\\1\\s*>~is', '', $html);
    $html = preg_replace('~<(script|style|iframe|object|embed|svg|math|form|input|button)\\b[^>]*/?>~is', '', $html);

    $permitidas = '<p><br><strong><b><em><i><u><s><ul><ol><li><h1><h2><h3><h4><blockquote><a><span><div><hr><figure><table><thead><tbody><tfoot><tr><td><th><colgroup><col>';
    $html = strip_tags($html, $permitidas);

    return preg_replace_callback('~<(\\/)?([a-z][a-z0-9]*)\\b([^>]*)>~i', function($m) {
        $cierre = ($m[1] === '/');
        $tag = strtolower($m[2]);
        $permitidas = ['p','br','strong','b','em','i','u','s','ul','ol','li','h1','h2','h3','h4','blockquote','a','span','div','hr','figure','table','thead','tbody','tfoot','tr','td','th','colgroup','col'];
        if (!in_array($tag, $permitidas, true)) return '';
        if ($cierre) return in_array($tag, ['br','hr','col'], true) ? '' : '</'.$tag.'>';

        $atributos = [];
        $resto = $m[3];

        if (preg_match('/\\bstyle\\s*=\\s*(["\\\'])(.*?)\\1/is', $resto, $sm)) {
            $estilos = [];
            foreach (explode(';', html_entity_decode($sm[2], ENT_QUOTES, 'UTF-8')) as $declaracion) {
                if (strpos($declaracion, ':') === false) continue;
                [$prop,$valor] = array_map('trim', explode(':', $declaracion, 2));
                $colorSeguro = '/^(#[0-9a-fA-F]{3,8}|rgba?\\(\\s*[0-9.%\\s,]+\\)|hsla?\\(\\s*[0-9.%\\s,deg]+\\))$/i';
                if ($prop === 'text-align' && in_array($valor, ['left','center','right','justify'], true)) {
                    $estilos[] = 'text-align:'.$valor;
                } elseif (in_array($prop, ['color','background-color','border-color'], true) && preg_match($colorSeguro, $valor)) {
                    $estilos[] = $prop.':'.$valor;
                } elseif ($prop === 'font-size' && preg_match('/^(6|[7-9]|[1-6][0-9]|7[0-2])(px|pt|em|rem|%)$/', $valor)) {
                    $estilos[] = 'font-size:'.$valor;
                } elseif ($prop === 'font-family' && preg_match('/^(Arial|Helvetica|Verdana|Tahoma|Georgia|["\\\']?Times New Roman["\\\']?|sans-serif|serif)$/i', $valor)) {
                    $estilos[] = 'font-family:'.$valor;
                } elseif ($prop === 'width' && preg_match('/^(100%|[1-9][0-9]?%)$/', $valor)) {
                    $estilos[] = 'width:'.$valor;
                }
            }
            if ($estilos) $atributos[] = 'style="'.htmlspecialchars(implode(';', $estilos), ENT_QUOTES, 'UTF-8').'"';
        }

        if ($tag === 'figure' && preg_match('/\\bclass\\s*=\\s*(["\\\'])table\\1/i', $resto)) {
            $atributos[] = 'class="table"';
        }
        foreach (['colspan','rowspan'] as $attr) {
            if (preg_match('/\\b'.$attr.'\\s*=\\s*(["\\\']?)([1-9][0-9]?)\\1/i', $resto, $am)) {
                $atributos[] = $attr.'="'.(int)$am[2].'"';
            }
        }
        if ($tag === 'a' && preg_match('/\\bhref\\s*=\\s*(["\\\'])(.*?)\\1/is', $resto, $hm)) {
            $href = html_entity_decode($hm[2], ENT_QUOTES, 'UTF-8');
            if (filter_var($href, FILTER_VALIDATE_URL)) {
                $partes = parse_url($href);
                if (isset($partes['scheme']) && in_array(strtolower($partes['scheme']), ['http','https'], true)) {
                    $atributos[] = 'href="'.htmlspecialchars($href, ENT_QUOTES, 'UTF-8').'"';
                    $atributos[] = 'target="_blank"';
                    $atributos[] = 'rel="noopener noreferrer"';
                }
            }
        }
        return '<'.$tag.($atributos ? ' '.implode(' ', $atributos) : '').(in_array($tag, ['br','hr','col'], true) ? ' />' : '>');
    }, $html);
}
function agenda_url_valida($url): bool {
    if ($url === '') return true;
    if (!filter_var($url, FILTER_VALIDATE_URL)) return false;
    $p = parse_url($url);
    return isset($p['scheme']) && in_array(strtolower($p['scheme']), ['http','https'], true);
}
function agenda_guardar_imagen($campo, $directorioFisico, $directorioRelativo): ?string {
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] === UPLOAD_ERR_NO_FILE) return null;
    if ($_FILES[$campo]['error'] !== UPLOAD_ERR_OK) throw new Exception('No se pudo recibir la imagen.');
    if ($_FILES[$campo]['size'] > 5 * 1024 * 1024) throw new Exception('La imagen no debe superar 5 MB.');
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($_FILES[$campo]['tmp_name']);
    $extensiones = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
    if (!isset($extensiones[$mime]) || getimagesize($_FILES[$campo]['tmp_name']) === false) {
        throw new Exception('Formato de imagen no válido. Utiliza JPG, PNG o WebP.');
    }
    if (!is_dir($directorioFisico) && !mkdir($directorioFisico, 0755, true)) {
        throw new Exception('No se pudo crear el directorio de imágenes.');
    }
    $nombre = bin2hex(random_bytes(16)).'.'.$extensiones[$mime];
    if (!move_uploaded_file($_FILES[$campo]['tmp_name'], $directorioFisico.$nombre)) {
        throw new Exception('No se pudo guardar la imagen.');
    }
    return $directorioRelativo.$nombre;
}
function agenda_borrar_imagen_local($ruta, $directorioFisico, $directorioRelativo): void {
    if (!$ruta || strpos($ruta, $directorioRelativo) !== 0) return;
    $archivo = $directorioFisico.basename($ruta);
    if (is_file($archivo)) @unlink($archivo);
}

/* Guardar o actualizar */
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    (isset($_POST['guardar_evento']) || isset($_POST['actualizar_evento']))) {
    $imagenNueva = null;
    try {
        if (empty($_POST['csrf_agenda']) ||
            !hash_equals($_SESSION['csrf_agenda'], $_POST['csrf_agenda'])) {
            throw new Exception('La solicitud expiró. Recarga la página e inténtalo nuevamente.');
        }
        $id = (int)($_POST['id_evento'] ?? 0);
        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = agenda_sanitizar_descripcion((string)($_POST['descripcion'] ?? ''));
        $categoria = trim($_POST['categoria'] ?? '');
        $inicio = trim($_POST['fecha_inicio'] ?? '');
        $fin = trim($_POST['fecha_fin'] ?? '');
        $lugar = trim($_POST['lugar'] ?? '');
        $direccion = trim($_POST['direccion'] ?? '');
        $enlace = trim($_POST['enlace'] ?? '');
        $organizador = trim($_POST['organizador'] ?? '');
        $activo = isset($_POST['activo']) ? 1 : 0;

        if ($titulo === '') throw new Exception('El título es obligatorio.');
        if (!agenda_validar_fecha_hora($inicio) || !agenda_validar_fecha_hora($fin)) {
            throw new Exception('Indica fechas y horas válidas.');
        }
        $dtInicio = DateTime::createFromFormat('!Y-m-d\TH:i', $inicio);
        $dtFin = DateTime::createFromFormat('!Y-m-d\TH:i', $fin);
        if ($dtFin < $dtInicio) throw new Exception('La fecha final no puede ser anterior al inicio.');
        if (!agenda_url_valida($enlace)) throw new Exception('El enlace debe ser una URL http o https válida.');

        $imagenNueva = agenda_guardar_imagen('imagen', $agendaDirectorioFisico, $agendaDirectorioRelativo);
        $fechaInicioSql = $dtInicio->format('Y-m-d H:i:s');
        $fechaFinSql = $dtFin->format('Y-m-d H:i:s');

        if (isset($_POST['guardar_evento'])) {
            $sql = "INSERT INTO eventos (titulo,descripcion,categoria,fecha_inicio,fecha_fin,lugar,direccion,enlace,imagen,organizador,activo)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $connect->prepare($sql);
            if (!$stmt) throw new Exception('No se pudo preparar el registro: '.$connect->error);
            $imagen = $imagenNueva;
            $stmt->bind_param('ssssssssssi', $titulo,$descripcion,$categoria,$fechaInicioSql,$fechaFinSql,$lugar,$direccion,$enlace,$imagen,$organizador,$activo);
            if (!$stmt->execute()) throw new Exception('No se pudo registrar el evento: '.$stmt->error);
            $stmt->close();
            $_SESSION['mensaje_agenda'] = ['tipo'=>'success','texto'=>'Evento registrado correctamente.'];
        } else {
            if ($id < 1) throw new Exception('Identificador de evento no válido.');
            $stmt = $connect->prepare("SELECT imagen FROM eventos WHERE id_evento=?");
            $stmt->bind_param('i',$id); $stmt->execute();
            $actual = $stmt->get_result()->fetch_assoc(); $stmt->close();
            if (!$actual) throw new Exception('El evento que intentas editar no existe.');

            if ($imagenNueva !== null) {
                $sql = "UPDATE eventos SET titulo=?,descripcion=?,categoria=?,fecha_inicio=?,fecha_fin=?,lugar=?,direccion=?,enlace=?,imagen=?,organizador=?,activo=? WHERE id_evento=?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param('ssssssssssii',$titulo,$descripcion,$categoria,$fechaInicioSql,$fechaFinSql,$lugar,$direccion,$enlace,$imagenNueva,$organizador,$activo,$id);
            } else {
                $sql = "UPDATE eventos SET titulo=?,descripcion=?,categoria=?,fecha_inicio=?,fecha_fin=?,lugar=?,direccion=?,enlace=?,organizador=?,activo=? WHERE id_evento=?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param('sssssssssii',$titulo,$descripcion,$categoria,$fechaInicioSql,$fechaFinSql,$lugar,$direccion,$enlace,$organizador,$activo,$id);
            }
            if (!$stmt || !$stmt->execute()) throw new Exception('No se pudo actualizar el evento: '.($stmt ? $stmt->error : $connect->error));
            $stmt->close();
            if ($imagenNueva !== null) agenda_borrar_imagen_local($actual['imagen'], $agendaDirectorioFisico, $agendaDirectorioRelativo);
            $_SESSION['mensaje_agenda'] = ['tipo'=>'success','texto'=>'Evento actualizado correctamente.'];
        }
        header('Location: secciones.php#agendaAdmin');
        exit;
    } catch (Throwable $e) {
        if ($imagenNueva !== null) agenda_borrar_imagen_local($imagenNueva, $agendaDirectorioFisico, $agendaDirectorioRelativo);
        $agendaMensaje = $e->getMessage();
    }
}

/* Baja lógica */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['desactivar_evento'])) {
    try {
        if (empty($_POST['csrf_agenda']) ||
            !hash_equals($_SESSION['csrf_agenda'], $_POST['csrf_agenda'])) {
            throw new Exception('La solicitud no es válida.');
        }
        $id = (int)($_POST['id_evento'] ?? 0);
        $stmt = $connect->prepare("UPDATE eventos SET activo=0 WHERE id_evento=?");
        $stmt->bind_param('i',$id);
        if (!$stmt->execute()) throw new Exception('No se pudo desactivar el evento.');
        $stmt->close();
        $_SESSION['mensaje_agenda'] = ['tipo'=>'success','texto'=>'Evento desactivado. El registro se conservó en la base de datos.'];
        header('Location: secciones.php#agendaAdmin'); exit;
    } catch (Throwable $e) { $agendaMensaje = $e->getMessage(); }
}

/* Mensajes flash */
if (isset($_SESSION['mensaje_agenda'])) {
    $agendaMensaje = $_SESSION['mensaje_agenda'];
    unset($_SESSION['mensaje_agenda']);
}

/* Evento a editar */
if (isset($_GET['editar_evento'])) {
    $idEditar = (int)$_GET['editar_evento'];
    $stmt = $connect->prepare("SELECT * FROM eventos WHERE id_evento=?");
    $stmt->bind_param('i',$idEditar); $stmt->execute();
    $agendaEditar = $stmt->get_result()->fetch_assoc(); $stmt->close();
}

/* Paginación y listado: próximos/activos primero; históricos e inactivos después */
$total = (int)$connect->query("SELECT COUNT(*) AS total FROM eventos")->fetch_assoc()['total'];
$agendaTotalPaginas = max(1, (int)ceil($total / $agendaPorPagina));
$agendaPagina = min($agendaPagina, $agendaTotalPaginas);
$offset = ($agendaPagina - 1) * $agendaPorPagina;
$sqlLista = "SELECT * FROM eventos
 ORDER BY (activo=1 AND fecha_fin >= NOW()) DESC,
            CASE WHEN activo=1 AND fecha_fin >= NOW() THEN fecha_inicio END ASC,
            fecha_inicio DESC, id_evento DESC
 LIMIT ? OFFSET ?";
$stmt = $connect->prepare($sqlLista);
$stmt->bind_param('ii',$agendaPorPagina,$offset);
$stmt->execute();
$agendaEventos = $stmt->get_result();
$stmt->close();
?>
