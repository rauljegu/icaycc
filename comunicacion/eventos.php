<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/slider-revolution.php';

/*
 * Agenda pública ICAyCC
 * Ruta: /comunicacion/eventos.php
 * Reutiliza la tabla eventos y los campos del administrador existente.
 */

date_default_timezone_set('America/Mexico_City');

function eventos_h($valor): string {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

function eventos_fecha_es(string $fecha, bool $incluirHora = false): string {
    $dt = new DateTime($fecha);
    $meses = [
        1=>'enero',2=>'febrero',3=>'marzo',4=>'abril',5=>'mayo',6=>'junio',
        7=>'julio',8=>'agosto',9=>'septiembre',10=>'octubre',11=>'noviembre',12=>'diciembre'
    ];
    $salida = $dt->format('d') . ' de ' . $meses[(int)$dt->format('n')] . ' de ' . $dt->format('Y');
    if ($incluirHora) $salida .= ' · ' . $dt->format('H:i') . ' h';
    return $salida;
}

function eventos_imagen_url(?string $ruta): string {
    if (!$ruta) return '';
    // Las rutas guardadas por el administrador son relativas a la raíz del sitio.
    return BASE_URL . ltrim($ruta, '/');
}

function eventos_obtener(PDO $pdo, int $mes, int $anio, string $busqueda = ''): array {
    $inicioMes = sprintf('%04d-%02d-01 00:00:00', $anio, $mes);
    $siguienteMes = (new DateTime($inicioMes))->modify('+1 month')->format('Y-m-d H:i:s');

    $sql = "SELECT id_evento, titulo, descripcion, categoria, fecha_inicio, fecha_fin,
                   lugar, direccion, enlace, imagen, organizador
            FROM eventos
            WHERE activo = 1
              AND fecha_inicio < :siguiente
              AND fecha_fin >= :inicio";
    $params = [':inicio' => $inicioMes, ':siguiente' => $siguienteMes];

    if ($busqueda !== '') {
        $sql .= " AND (titulo LIKE :q1 OR descripcion LIKE :q2 OR categoria LIKE :q3
                       OR lugar LIKE :q4 OR organizador LIKE :q5)";
        $like = '%' . $busqueda . '%';
        for ($i = 1; $i <= 5; $i++) $params[':q' . $i] = $like;
    }

    $sql .= " ORDER BY fecha_inicio ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function eventos_serializar(array $filas): array {
    $salida = [];
    foreach ($filas as $ev) {
        $inicio = new DateTime($ev['fecha_inicio']);
        $fin = new DateTime($ev['fecha_fin']);
        $salida[] = [
            'id' => (int)$ev['id_evento'],
            'titulo' => $ev['titulo'],
            'descripcion' => $ev['descripcion'] ?? '',
            'categoria' => $ev['categoria'] ?? '',
            'inicio' => $inicio->format('Y-m-d H:i:s'),
            'fin' => $fin->format('Y-m-d H:i:s'),
            'dia' => $inicio->format('Y-m-d'),
            'hora_inicio' => $inicio->format('H:i'),
            'hora_fin' => $fin->format('H:i'),
            'lugar' => $ev['lugar'] ?? '',
            'direccion' => $ev['direccion'] ?? '',
            'enlace' => $ev['enlace'] ?? '',
            'imagen' => eventos_imagen_url($ev['imagen'] ?? null),
            'organizador' => $ev['organizador'] ?? '',
            'url' => BASE_URL . 'comunicacion/evento.php?id=' . (int)$ev['id_evento']
        ];
    }
    return $salida;
}

/* Endpoint AJAX de esta misma página: conserva una sola fuente de datos. */
if (isset($_GET['ajax']) && $_GET['ajax'] === 'eventos') {
    header('Content-Type: application/json; charset=utf-8');
    try {
        $mes = max(1, min(12, (int)($_GET['mes'] ?? date('n'))));
        $anio = max(2000, min(2100, (int)($_GET['anio'] ?? date('Y'))));
        $busqueda = trim((string)($_GET['q'] ?? ''));
        $filas = eventos_obtener($pdo, $mes, $anio, $busqueda);
        echo json_encode([
            'ok' => true,
            'eventos' => eventos_serializar($filas),
            'mes' => $mes,
            'anio' => $anio
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } catch (Throwable $e) {
        http_response_code(500);
        echo json_encode(['ok'=>false, 'mensaje'=>'No fue posible consultar la agenda.']);
    }
    exit;
}

$hoy = new DateTime('today');
$mesInicial = (int)($_GET['mes'] ?? $hoy->format('n'));
$anioInicial = (int)($_GET['anio'] ?? $hoy->format('Y'));
if ($mesInicial < 1 || $mesInicial > 12) $mesInicial = (int)$hoy->format('n');
if ($anioInicial < 2000 || $anioInicial > 2100) $anioInicial = (int)$hoy->format('Y');

$mesesNombre = [
    1=>'enero',2=>'febrero',3=>'marzo',4=>'abril',5=>'mayo',6=>'junio',
    7=>'julio',8=>'agosto',9=>'septiembre',10=>'octubre',11=>'noviembre',12=>'diciembre'
];
$eventosIniciales = eventos_serializar(eventos_obtener($pdo, $mesInicial, $anioInicial));
$anios = range((int)$hoy->format('Y') - 5, (int)$hoy->format('Y') + 5);
?>

<link rel="stylesheet" href="<?= eventos_h(BASE_URL) ?>comunicacion/assets/css/eventos.css">

<main class="container-fluid container-xl py-4 agenda-publica"
      id="agendaPublica"
      data-ajax-url="<?= eventos_h(BASE_URL) ?>comunicacion/eventos.php"
      data-detalle-url="<?= eventos_h(BASE_URL) ?>comunicacion/evento.php">
    <section class="agenda-toolbar" aria-label="Herramientas de agenda">
        <div class="input-group agenda-search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="search" class="form-control" id="agendaBuscar"
                   placeholder="Buscar eventos..." aria-label="Buscar eventos">
            <button class="btn btn-outline-secondary" type="button" id="agendaLimpiar" aria-label="Limpiar búsqueda">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="agenda-toolbar-bottom">
            <div class="agenda-selectores">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                    <select class="form-select" id="agendaMes" aria-label="Seleccionar mes">
                        <?php foreach ($mesesNombre as $num=>$nombre): ?>
                            <option value="<?= $num ?>" <?= $num===$mesInicial?'selected':'' ?>>
                                <?= eventos_h(ucfirst($nombre)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <select class="form-select agenda-anio" id="agendaAnio" aria-label="Seleccionar año">
                        <?php foreach ($anios as $anio): ?>
                            <option value="<?= $anio ?>" <?= $anio===$anioInicial?'selected':'' ?>><?= $anio ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="btn-group agenda-vistas" role="group" aria-label="Tipo de vista">
                <button type="button" class="btn btn-primary active" id="agendaVistaMes" aria-pressed="true">Mensualmente</button>
                <button type="button" class="btn btn-outline-primary" id="agendaVistaHorario" aria-pressed="false">Vista de horario</button>
            </div>
        </div>
    </section>

    <section class="agenda-panel mt-4">
        <div class="agenda-mes-cabecera">
            <button type="button" class="agenda-nav agenda-nav-anterior" id="agendaAnterior">
                <i class="bi bi-chevron-left"></i><span id="agendaMesAnterior">Anterior</span>
            </button>
            <h1 id="agendaTituloMes"><?= eventos_h(ucfirst($mesesNombre[$mesInicial]) . ' ' . $anioInicial) ?></h1>
            <button type="button" class="agenda-nav agenda-nav-siguiente" id="agendaSiguiente">
                <span id="agendaMesSiguiente">Siguiente</span><i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <div class="agenda-contenido" id="agendaVistaMensual">
            <div class="agenda-calendario">
                <div class="agenda-dias-semana">
                    <?php foreach (['LU','MA','MI','JU','VI','SA','DO'] as $dia): ?>
                        <div><?= $dia ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="agenda-cuadricula" id="agendaCuadricula" aria-live="polite"></div>
            </div>

            <aside class="agenda-lateral">
                <h2>EVENTOS</h2>
                <div id="agendaListaEventos" class="agenda-lista-eventos" aria-live="polite">
                    <?php if (!$eventosIniciales): ?>
                        <p class="agenda-vacio">No hay eventos para este mes.</p>
                    <?php else: foreach ($eventosIniciales as $ev): ?>
                        <a class="agenda-evento-lista" href="<?= eventos_h($ev['url']) ?>">
                            <img src="<?= eventos_h($ev['imagen']) ?>" alt="" loading="lazy">
                            <span class="agenda-evento-lista-info">
                                <small><?= eventos_h(eventos_fecha_es($ev['inicio'])) ?></small>
                                <small class="agenda-hora"><i class="bi bi-clock"></i> <?= eventos_h($ev['hora_inicio']) ?> - <?= eventos_h($ev['hora_fin']) ?></small>
                                <strong><?= eventos_h($ev['titulo']) ?></strong>
                                <?php if ($ev['lugar']): ?><small class="agenda-lugar"><?= eventos_h($ev['lugar']) ?></small><?php endif; ?>
                            </span>
                        </a>
                    <?php endforeach; endif; ?>
                </div>
            </aside>
        </div>

        <div id="agendaVistaLista" class="agenda-vista-lista" hidden></div>
        <div id="agendaEstado" class="agenda-estado" role="status" aria-live="polite"></div>
    </section>
</main>

<script>
window.ICAYCC_AGENDA_INICIAL = <?= json_encode([
    'mes'=>$mesInicial,
    'anio'=>$anioInicial,
    'eventos'=>$eventosIniciales,
    'hoy'=>$hoy->format('Y-m-d'),
    'meses'=>$mesesNombre
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>
<script src="<?= eventos_h(BASE_URL) ?>comunicacion/assets/js/eventos.js" defer></script>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
