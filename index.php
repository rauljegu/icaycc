<?php
require_once __DIR__ . '/config/config.php';



/* ==========================
   DEPARTAMENTOS INVESTIGACIÓN
   ========================== */

$sql = "
SELECT
    d.id_departamento,
    d.nombre,
    i.nombre AS responsable
FROM departamentos d

LEFT JOIN personal i
    ON i.id_personal = d.responsable

WHERE d.tipo = 'investigacion'
AND d.activo = 1

ORDER BY d.nombre
";
//echo $sql;
$investigacion = $pdo->query($sql);
/* ==========================
   GRUPOS DE INVESTIGACIÓN
   ========================== */


$sql = "
SELECT
    id_grupo,
    nombre
FROM grupos
ORDER BY nombre
";

$grupos = $pdo->query($sql);


/* ==========================
   UNIDADES DE APOYO
   ========================== */

$sql = "
SELECT
    d.id_unidades,
    d.nombre,
    i.nombre AS responsable
FROM unidades d

LEFT JOIN personal i
    ON i.id_personal = d.responsable

WHERE d.tipo = 'apoyo'
AND d.activo = 1

ORDER BY d.nombre
";
//echo "<br>" .$sql;
$apoyo = $pdo->query($sql);


/* ================================

RECURSOS
===================================*/
$convocatorias = [
    ['categoria' => 'Convocatoria', 'titulo' => 'Convocatorias académicas', 'fecha' => 'Consulta las fechas vigentes', 'url' => '#'],
    ['categoria' => 'Noticias', 'titulo' => 'Actualidad del ICAyCC', 'fecha' => 'Noticias del Instituto', 'url' => '#'],
    ['categoria' => 'Cursos', 'titulo' => 'Cursos y actividades académicas', 'fecha' => 'Consulta la oferta disponible', 'url' => '#'],
];

$eventos = [
    ['dia' => 'Próximo', 'mes' => 'EVENTO', 'titulo' => 'Actividad académica del Instituto', 'detalle' => 'Fecha, horario y sede por confirmar.'],
    ['dia' => 'Agenda', 'mes' => 'ICAyCC', 'titulo' => 'Seminarios y conferencias', 'detalle' => 'Consulta próximamente los detalles de cada actividad.'],
];

$noticias = [
    ['tipo' => 'NOTICIAS', 'titulo' => 'Noticias recientes del Instituto', 'resumen' => 'Espacio para destacar la actualidad y las actividades del ICAyCC.'],
    ['tipo' => 'ARTÍCULOS RECIENTES', 'titulo' => 'Investigación y conocimiento científico', 'resumen' => 'Publicaciones y artículos recientes de la comunidad académica.'],
    ['tipo' => 'ICAyCC EN LOS MEDIOS', 'titulo' => 'La ciencia del Instituto en los medios', 'resumen' => 'Entrevistas, notas y colaboraciones con medios de comunicación.'],
];
function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

?>

<!--<div class="container py-5">-->

     <main>
        <section id="inicio" aria-label="Banner principal">
            <!--<div class="hero-banner">
                <img src="icaycc-gif-banner.gif" alt="Fachada del Instituto de Ciencias de la Atmósfera y Cambio Climático de la UNAM">
            </div>--->
			<div class="hero-header">
				<div class="hero-logos">
					<a href="https://www.unam.mx/" target="_blank"
					rel="noopener noreferrer" aria-label="UNAM">
						<img
						src="<?= BASE_URL ?>assets/img/unam.png"
						alt="Universidad Nacional Autónoma de México"
						class="logo-unam">
					</a>

					<a href="<?= BASE_URL ?>" aria-label="Inicio ICAyCC">
						<img
						src="<?= BASE_URL ?>assets/img/logo_icaycc_colores.svg"
						alt="Instituto de Ciencias de la Atmósfera y Cambio Climático"
						class="logo-icaycc">
					</a>
				</div>

				<div class="hero-banner">
					<img
					src="icaycc-gif-banner.gif"
					alt="Banner institucional del ICAyCC">
				</div>
			</div>
            <div class="hero-caption py-3 py-md-4">
                <div class="container d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.12em;color:#BDE4D7">Investigación · Docencia · Difusión</div>
                        <h1 class="h3 mb-0 fw-bold">Instituto de Ciencias de la Atmosf&eacute;ra y Cambio Clim&aacute;tico</h1>
                    </div>
                    <a class="btn btn-institutional px-4 py-2" href="#actualidad">Conoce nuestra actualidad <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </section>

        <section id="actualidad" class="section">
            <div class="container">
                <div class="mb-4 mb-lg-5">
                    <div class="section-kicker mb-2">Mantente al día</div>
                    <h2 class="section-title display-6 mb-2">Convocatorias, noticias y cursos</h2>
                    <p class="section-intro mb-0">Un espacio para destacar la información más relevante de la comunidad del Instituto.</p>
                </div>
                <div class="row g-4">
                    <?php foreach ($convocatorias as $item): ?>
                        <div class="col-md-4">
                            <article class="content-card">
                                <div class="card-symbol" aria-hidden="true">
                                    <?php if ($item['categoria'] === 'Convocatoria'): ?><i class="bi bi-megaphone"></i>
                                    <?php elseif ($item['categoria'] === 'Noticias'): ?><i class="bi bi-newspaper"></i>
                                    <?php else: ?><i class="bi bi-mortarboard"></i><?php endif; ?>
                                </div>
                                <div class="p-4">
                                    <div class="category mb-2"><?= e($item['categoria']) ?></div>
                                    <h3 class="h5 card-title"><?= e($item['titulo']) ?></h3>
                                    <p class="text-secondary small"><?= e($item['fecha']) ?></p>
                                    <a class="text-link" href="<?= e($item['url']) ?>">Consultar información <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="eventos" class="section section-soft">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-7">
                        <div class="section-kicker mb-2">Agenda del Instituto</div>
                        <h2 class="section-title display-6 mb-2">Próximos eventos</h2>
                        <p class="section-intro">Seminarios, conferencias, cursos y actividades académicas.</p>
                        <?php foreach ($eventos as $evento): ?>
                            <article class="event-item">
                                <div class="event-date"><strong><?= e($evento['dia']) ?></strong><span class="small"><?= e($evento['mes']) ?></span></div>
                                <div>
                                    <h3 class="h5 card-title mb-1"><?= e($evento['titulo']) ?></h3>
                                    <p class="text-secondary mb-0"><?= e($evento['detalle']) ?></p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                        <a class="btn btn-outline-institutional mt-4" href="#contacto">Consultar agenda completa</a>
                    </div>
                    <div class="col-lg-5">
                        <div class="p-4 p-lg-5 bg-white rounded-4 shadow-sm h-100">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <div class="section-kicker mb-1">Organiza tu visita</div>
                                    <h3 class="h4 section-title mb-0">Calendario</h3>
                                </div>
                                <i class="bi bi-calendar3 fs-2" style="color:var(--icaycc-medium)" aria-hidden="true"></i>
                            </div>
                            <p class="text-secondary">Aquí se puede integrar un calendario mensual con los eventos registrados en el sitio.</p>
                            <div class="rounded-3 p-3" style="background:var(--icaycc-light)">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fw-bold" style="color:var(--icaycc-dark)">Agenda ICAyCC</span>
                                    <i class="bi bi-calendar-event" style="color:var(--icaycc-medium)"></i>
                                </div>
                                <div class="row row-cols-7 g-1 text-center small text-secondary">
                                    <?php foreach (['L','M','M','J','V','S','D'] as $dia): ?><div class="col py-1 fw-bold"><?= e($dia) ?></div><?php endforeach; ?>
                                    <?php for ($d = 1; $d <= 31; $d++): ?>
                                        <div class="col py-1"><span class="d-inline-block rounded-circle <?= in_array($d, [5,12,19,26]) ? 'text-white' : '' ?>" style="<?= in_array($d, [5,12,19,26]) ? 'background:var(--icaycc-medium);width:28px;height:28px;line-height:28px;' : 'line-height:28px;' ?>"><?= $d ?></span></div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="small text-secondary mt-3 mb-0">Calendario ilustrativo; no representa fechas reales de eventos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pronosticos" class="section">
            <div class="container">
                <div class="section-kicker mb-2">Servicios científicos</div>
                <h2 class="section-title display-6 mb-2">Pronósticos</h2>
                <p class="section-intro mb-4">Accede directamente a las herramientas y servicios de pronóstico del Instituto.</p>
                <div class="row g-4">
                    <div class="col-md-4">
                        <article class="forecast-card">
                            <i class="bi bi-cloud-sun forecast-icon" aria-hidden="true"></i>
                            <h3 class="h4 mt-3">Pronósticos</h3>
                            <p>Consulta el portal de pronósticos atmosféricos.</p>
                            <a class="btn btn-light fw-semibold mt-2" href="https://pronosticos.atmosfera.unam.mx/" target="_blank" rel="noopener noreferrer">Ir al pronóstico <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="forecast-card">
                            <i class="bi bi-wind forecast-icon" aria-hidden="true"></i>
                            <h3 class="h4 mt-3">Pronóstico de ozono</h3>
                            <p>Consulta la información relacionada con el ozono.</p>
                            <a class="btn btn-light fw-semibold mt-2" href="https://pronosticos.atmosfera.unam.mx/ozono/" target="_blank" rel="noopener noreferrer">Consultar ozono <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="forecast-card">
                            <i class="bi bi-activity forecast-icon" aria-hidden="true"></i>
                            <h3 class="h4 mt-3">Operativo</h3>
                            <p>Accede al servicio operativo de pronósticos.</p>
                            <a class="btn btn-light fw-semibold mt-2" href="https://pronosticos.atmosfera.unam.mx/operativo/" target="_blank" rel="noopener noreferrer">Ver operativo <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section id="noticias" class="section section-soft">
            <div class="container">
                <div class="section-kicker mb-2">Conocimiento en movimiento</div>
                <h2 class="section-title display-6 mb-2">Noticias y divulgación</h2>
                <p class="section-intro mb-4">Investigación, publicaciones y participación del Instituto en la conversación pública.</p>
                <div class="row g-4">
                    <?php foreach ($noticias as $noticia): ?>
                        <div class="col-md-4">
                            <article class="content-card p-4">
                                <div class="category mb-3"><?= e($noticia['tipo']) ?></div>
                                <h3 class="h5 card-title"><?= e($noticia['titulo']) ?></h3>
                                <p class="text-secondary"><?= e($noticia['resumen']) ?></p>
                                <a class="text-link" href="#contacto">Ver publicaciones <i class="bi bi-arrow-right"></i></a>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>


<!--</div>-->

<?php //include('includes/footer.php'); 


require_once ROOT_PATH . '/includes/footer.php';

?>
