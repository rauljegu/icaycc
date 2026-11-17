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

/*$eventos = [
    ['dia' => 'Próximo', 'mes' => 'EVENTO', 'titulo' => 'Actividad académica del Instituto', 'detalle' => 'Fecha, horario y sede por confirmar.'],
    ['dia' => 'Agenda', 'mes' => 'ICAyCC', 'titulo' => 'Seminarios y conferencias', 'detalle' => 'Consulta próximamente los detalles de cada actividad.'],
];*/

$noticias = [  
    ['tipo' => 'ARTÍCULOS RECIENTES','link' => 'comunicacion/publicaciones.php', 'titulo' => 'Investigación y conocimiento científico', 'resumen' => 'Publicaciones y artículos recientes de la comunidad académica.'],
    ['tipo' => 'ICAyCC EN LOS MEDIOS','link' => 'comunicacion/medios.php', 'titulo' => 'La ciencia del Instituto en los medios', 'resumen' => 'Entrevistas, notas y colaboraciones con medios de comunicación.'],
	['tipo' => 'DIVULGACIÓN', 'link' => 'comunicacion/divulgacion.php', 'titulo' => 'Artículos de Divulgación recientes del Instituto', 'resumen' => 'Espacio para destacar los artículos de diculgación del ICAyCC.'],
];
function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
require_once __DIR__ . '/includes/agenda.php';
$sql = "
    SELECT
        id_actualidad,
        titulo,
        imagen,
        enlace_mas,
        enlace_cartel,
        fecha_publicacion,
        fecha_despublicacion
    FROM actualidad
    WHERE activo = 1
      AND fecha_publicacion <= CURDATE()
      AND (
            fecha_despublicacion IS NULL
            OR fecha_despublicacion >= CURDATE()
          )
    ORDER BY orden ASC, fecha_registro DESC
";

$actualidad = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!--<div class="container py-5">-->

     <main>
        <section id="inicio" class="hero-home" aria-label="Presentación del ICAyCC">
            <div class="hero-home__photo">
                <img src="<?= BASE_URL ?>assets/img/icaycc-gif-banner.gif"
                     alt="Banner institucional del ICAyCC"
                     fetchpriority="high">
            </div>

            <div class="hero-home__panel">
                <div class="hero-home__content">
                    <div class="hero-home__logos">
                        <a href="https://www.unam.mx/" target="_blank" rel="noopener noreferrer"
                           aria-label="Universidad Nacional Autónoma de México">
                            <img src="<?= BASE_URL ?>assets/img/unam.png"
                                 alt="Universidad Nacional Autónoma de México"
                                 class="hero-home__logo-unam logo-unam">
                        </a>
                        <span class="hero-home__separator" aria-hidden="true"></span>
                        <a href="<?= BASE_URL ?>" aria-label="Inicio ICAyCC">
                            <img src="<?= BASE_URL ?>assets/img/logo_icaycc_colores.svg"
                                 alt="Instituto de Ciencias de la Atmósfera y Cambio Climático"
                                 class="hero-home__logo-icaycc">
                        </a>
                    </div>

                    <div class="hero-home__heading">
                       <h1 class="hero-title">
							<span>Instituto de Ciencias de la</span>
							<span>Atmósfera y Cambio Climático</span>
						</h1>
                        <div class="hero-home__rule"></div>
                        <p>INVESTIGACIÓN <span>·</span> DOCENCIA <span>·</span> DIFUSIÓN</p>
                        <a class="hero-home__button" href="#actualidad">
                            Conoce nuestra actualidad <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="hero-home__diagonal hero-home__diagonal--one" aria-hidden="true"></div>
            <div class="hero-home__diagonal hero-home__diagonal--two" aria-hidden="true"></div>
        </section>

		<section id="actualidad" class="section">
			<div class="container">

				<?php if (!empty($actualidad)): ?>

					<div id="carruselActualidad"
						 class="carousel slide actualidad-carousel"
						 data-bs-ride="carousel"
						 data-bs-interval="6000">

						<div class="carousel-inner">

							<?php foreach ($actualidad as $indice => $item): ?>

								<div class="carousel-item <?= $indice === 0 ? 'active' : '' ?>">

									<div class="actualidad-slide">

										<img
											src="<?= BASE_URL . e($item['imagen']) ?>"
											alt="<?= e($item['titulo']) ?>"
											class="actualidad-img"
											loading="<?= $indice === 0 ? 'eager' : 'lazy' ?>"
										>

										<?php if (
											!empty($item['enlace_mas']) ||
											!empty($item['enlace_cartel'])
										): ?>

											<div class="actualidad-actions">

												<?php if (!empty($item['enlace_mas'])): ?>

													<a href="<?= e($item['enlace_mas']) ?>"
													   class="btn btn-actualidad"
													   target="_blank"
													   rel="noopener noreferrer">
														Ver más
													</a>

												<?php endif; ?>

												<?php if (!empty($item['enlace_cartel'])): ?>

													<a href="<?= e($item['enlace_cartel']) ?>"
													   class="btn btn-cartel"
													   target="_blank"
													   rel="noopener noreferrer">
														Cartel
													</a>

												<?php endif; ?>

											</div>

										<?php endif; ?>

									</div>

								</div>

							<?php endforeach; ?>

						</div>

						<?php if (count($actualidad) > 1): ?>

							<button class="carousel-control-prev"
									type="button"
									data-bs-target="#carruselActualidad"
									data-bs-slide="prev"
									aria-label="Publicación anterior">

								<span class="carousel-control-prev-icon"
									  aria-hidden="true"></span>

							</button>

							<button class="carousel-control-next"
									type="button"
									data-bs-target="#carruselActualidad"
									data-bs-slide="next"
									aria-label="Publicación siguiente">

								<span class="carousel-control-next-icon"
									  aria-hidden="true"></span>

							</button>

						<?php endif; ?>

					</div>

				<?php endif; ?>

			</div>
		</section>

		<?php include __DIR__ . '/includes/agenda_vista.php'; ?>
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
                <h2 class="section-title display-6 mb-2">Publicaciones, noticias y divulgación</h2>
                <p class="section-intro mb-4">Investigación, publicaciones y participación del Instituto en la conversación pública.</p>
                <div class="row g-4">
                    <?php foreach ($noticias as $noticia): ?>
                        <div class="col-md-4">
                            <article class="content-card p-4">
                                <div class="category mb-3"><?= e($noticia['tipo']) ?></div>
                                <h3 class="h5 card-title"><?= e($noticia['titulo']) ?></h3>
                                <p class="text-secondary"><?= e($noticia['resumen']) ?></p>
                                <a class="text-link" href="<?= e($noticia['link']) ?>">Ver publicaciones <i class="bi bi-arrow-right"></i></a>
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
