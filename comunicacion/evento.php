<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/slider-revolution.php';
require_once __DIR__ . '/../includes/wp-media.php';
date_default_timezone_set('America/Mexico_City');

function evento_h($valor): string {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}
function evento_fecha_larga(string $fecha): string {
    $dt = new DateTime($fecha);
    $dias = [1=>'lunes',2=>'martes',3=>'miércoles',4=>'jueves',5=>'viernes',6=>'sábado',7=>'domingo'];
    $meses = [1=>'enero',2=>'febrero',3=>'marzo',4=>'abril',5=>'mayo',6=>'junio',7=>'julio',8=>'agosto',9=>'septiembre',10=>'octubre',11=>'noviembre',12=>'diciembre'];
    return ucfirst($dias[(int)$dt->format('N')]) . ' ' . $dt->format('d') . ' de ' . $meses[(int)$dt->format('n')] . ' de ' . $dt->format('Y');
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$evento = null;
if ($id && $id > 0) {
    $stmt = $pdo->prepare("SELECT id_evento,titulo,descripcion,categoria,fecha_inicio,fecha_fin,lugar,direccion,enlace,imagen,organizador
                           FROM eventos WHERE id_evento = :id AND activo = 1 LIMIT 1");
    $stmt->execute([':id'=>$id]);
    $evento = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

if (!$evento) {
    http_response_code(404);
}
$inicio = $evento ? new DateTime($evento['fecha_inicio']) : null;
$fin = $evento ? new DateTime($evento['fecha_fin']) : null;
$ahora = new DateTime();
$estado = '';
if ($evento) {
    if ($fin < $ahora) $estado = 'Finalizado';
    elseif ($inicio > $ahora) $estado = 'Próximo';
    else $estado = 'En curso';
}

$imagen = wordpressMediaUrl($evento['imagen']);
			
//$imagen = ($evento && !empty(wordpressMediaUrl($evento['imagen'])))
    //? BASE_URL . ltrim($evento['imagen'], '/')
   // ?  ltrim(wordpressMediaUrl($evento['imagen']), '/')
   // : '';
?>
<link rel="stylesheet" href="<?= evento_h(BASE_URL) ?>comunicacion/assets/css/eventos.css">

<main class="container-fluid container-xl py-4 evento-detalle">
<?php if (!$evento): ?>
    <div class="alert alert-light border text-center py-5">
        <h1 class="h3">Evento no disponible</h1>
        <p>El evento solicitado no existe o ya no está publicado.</p>
        <a class="btn btn-primary" href="<?= evento_h(BASE_URL) ?>comunicacion/eventos.php">Volver a la agenda</a>
    </div>
<?php else: ?>
    <div class="row g-4">
        <article class="col-lg-8">
            <?php if ($imagen !== ''): ?>
                <img class="evento-cartel-principal" src="<?= evento_h($imagen) ?>" alt="Cartel de <?= evento_h($evento['titulo']) ?>">
            <?php endif; ?>
            <h1 class="evento-titulo-detalle"><?= evento_h($evento['titulo']) ?></h1>

            <div class="evento-resumen-fecha">
                <strong><?= evento_h(evento_fecha_larga($evento['fecha_inicio'])) ?></strong>
                <span><?= evento_h($inicio->format('H:i')) ?> h<?= $fin->format('Y-m-d') === $inicio->format('Y-m-d') ? ' – '.evento_h($fin->format('H:i')).' h' : '' ?></span>
                <?php if (!empty($evento['lugar'])): ?><span><?= evento_h($evento['lugar']) ?></span><?php endif; ?>
            </div>

            <?php if (!empty($evento['organizador'])): ?>
                <p class="evento-organizador"><strong>Organiza:</strong> <?= evento_h($evento['organizador']) ?></p>
            <?php endif; ?>

            <?php if (!empty($evento['descripcion'])): ?>
                <div class="evento-descripcion agenda-description"><?= $evento['descripcion'] ?></div>
            <?php endif; ?>

            <?php if (!empty($evento['enlace'])): ?>
                <p class="mt-4"><a class="btn btn-primary" href="<?= evento_h($evento['enlace']) ?>" target="_blank" rel="noopener noreferrer">Más información <i class="bi bi-box-arrow-up-right ms-1"></i></a></p>
            <?php endif; ?>
        </article>

        <aside class="col-lg-4">
            <div class="evento-ficha">
                <div class="evento-ficha-item">
                    <i class="bi bi-calendar3"></i>
                    <div><strong>FECHA</strong><span><?= evento_h($inicio->format('d/m/Y')) ?></span><small class="evento-estado estado-<?= strtolower(str_replace(' ', '-', $estado)) ?>"><?= evento_h($estado) ?></small></div>
                </div>
                <div class="evento-ficha-item">
                    <i class="bi bi-clock"></i>
                    <div><strong>HORA</strong><span><?= evento_h($inicio->format('H:i')) ?> – <?= evento_h($fin->format('H:i')) ?> h</span></div>
                </div>
                <?php if (!empty($evento['categoria'])): ?>
                <div class="evento-ficha-item">
                    <i class="bi bi-bookmark"></i>
                    <div><strong>ETIQUETAS</strong><span><?= evento_h($evento['categoria']) ?></span></div>
                </div>
                <?php endif; ?>
                <div class="evento-ficha-item">
                    <i class="bi bi-geo-alt"></i>
                    <div><strong>LUGAR</strong>
                        <?php if (!empty($evento['lugar'])): ?><span><?= evento_h($evento['lugar']) ?></span><?php endif; ?>
                        <?php if (!empty($evento['direccion'])): ?><span><?= evento_h($evento['direccion']) ?></span><?php endif; ?>
                    </div>
                </div>
                <a class="btn btn-outline-primary w-100 mt-3" href="<?= evento_h(BASE_URL) ?>comunicacion/eventos.php?mes=<?= (int)$inicio->format('n') ?>&anio=<?= (int)$inicio->format('Y') ?>">
                    <i class="bi bi-arrow-left me-1"></i> Volver a la agenda
                </a>
            </div>
        </aside>
    </div>
<?php endif; ?>
</main>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
