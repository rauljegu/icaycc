<?php
/*
 * prueba_index.php
 * Portada de prueba para ICAyCC-UNAM.
 * Coloca icaycc-gif-banner.gif en el mismo directorio que este archivo.
 * Página demostrativa: sustituir los contenidos de ejemplo por datos reales.
 */

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
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portada de prueba del Instituto de Ciencias de la Atmósfera y Cambio Climático, UNAM.">
    <title>ICAyCC-UNAM | Portada de prueba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --icaycc-dark: #004F5C;
            --icaycc-medium: #008492;
            --icaycc-green: #2C9571;
            --icaycc-orange: #CF5415;
            --icaycc-light: #F3F7F6;
            --icaycc-text: #25383B;
        }
        html { scroll-behavior: smooth; }
        body { color: var(--icaycc-text); font-family: system-ui, -apple-system, "Segoe UI", sans-serif; }
        a { text-decoration: none; }
        .topbar { background: var(--icaycc-dark); color: #fff; font-size: .84rem; }
        /*.navbar { background: #fff; }*/
        .brand-mark {
            width: 48px; height: 48px; display: grid; place-items: center;
            background: var(--icaycc-dark); color: #fff; border-radius: 50%;
            font-size: 1.4rem; flex-shrink: 0;
        }
        .brand-title { color: var(--icaycc-dark); font-weight: 750; line-height: 1.15; }
        .brand-subtitle { font-size: .78rem; color: #53686B; }
        /*.navbar .nav-link { color: var(--icaycc-dark); font-weight: 600; }
        .navbar .nav-link:hover, .navbar .nav-link:focus { color: var(--icaycc-medium); }*/
        .hero-banner { background: #dce8e7; overflow: hidden; }
        .hero-banner img { display: block; width: 100%; height: clamp(150px, 25vw, 300px); object-fit: cover; object-position: center; }
        .hero-caption { background: linear-gradient(90deg, var(--icaycc-dark), #006875); color: #fff; }
        .section { padding: 3.75rem 0; }
        .section-soft { background: var(--icaycc-light); }
        .section-kicker { color: var(--icaycc-green); text-transform: uppercase; letter-spacing: .12em; font-size: .78rem; font-weight: 800; }
        .section-title { color: var(--icaycc-dark); font-weight: 750; }
        .section-intro { max-width: 720px; color: #5B6C6F; }
        .content-card { height: 100%; border: 1px solid #e1e9e8; border-radius: 1rem; overflow: hidden; background: #fff; transition: transform .2s ease, box-shadow .2s ease; }
        .content-card:hover { transform: translateY(-4px); box-shadow: 0 1rem 2rem rgba(0,79,92,.10); }
        .card-symbol { height: 128px; display: grid; place-items: center; background: linear-gradient(135deg, #e8f1ef, #d4e7e4); color: var(--icaycc-dark); font-size: 2.5rem; }
        .category { color: var(--icaycc-green); text-transform: uppercase; font-size: .72rem; font-weight: 800; letter-spacing: .07em; }
        .card-title { color: var(--icaycc-dark); font-weight: 700; }
        .text-link { color: var(--icaycc-medium); font-weight: 700; }
        .text-link:hover { color: var(--icaycc-dark); }
        .event-date { min-width: 76px; padding: .8rem .5rem; background: var(--icaycc-dark); color: #fff; border-radius: .75rem; text-align: center; }
        .event-date strong { display: block; font-size: 1rem; }
        .event-item { display: flex; gap: 1rem; padding: 1.2rem 0; border-bottom: 1px solid #dce6e4; }
        .forecast-card { height: 100%; border-radius: 1rem; padding: 1.5rem; color: #fff; background: var(--icaycc-dark); }
        .forecast-card:nth-child(2) { background: var(--icaycc-medium); }
        .forecast-card:nth-child(3) { background: #246E5B; }
        .forecast-icon { font-size: 2rem; opacity: .95; }
        .forecast-card p { color: rgba(255,255,255,.85); }
        .btn-institutional { background: var(--icaycc-orange); color: #fff; border: 0; font-weight: 700; }
        .btn-institutional:hover { background: #a94310; color: #fff; }
        .btn-outline-institutional { color: var(--icaycc-dark); border: 1px solid var(--icaycc-dark); font-weight: 700; }
        .btn-outline-institutional:hover { color: #fff; background: var(--icaycc-dark); }
        footer { background: var(--icaycc-dark); color: #fff; }
        footer a { color: #e3f2ef; }
        footer a:hover { color: #fff; text-decoration: underline; }
        .footer-rule { border-color: rgba(255,255,255,.22); }
        @media (max-width: 575.98px) {
            .section { padding: 2.5rem 0; }
            .hero-caption h1 { font-size: 1.25rem; }
            .brand-subtitle { max-width: 245px; }
        }
    </style>
</head>
<body>
    <div class="topbar py-2">
        <div class="container d-flex justify-content-between align-items-center gap-3">
            <span>Universidad Nacional Autónoma de México</span>
            <span class="d-none d-md-inline">Ciencia · Investigación · Formación</span>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg sticky-top shadow-sm" aria-label="Navegación principal">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center gap-3 me-lg-4" href="#inicio">
                <span class="brand-mark" aria-hidden="true"><i class="bi bi-globe-americas"></i></span>
                <span>
                    <span class="brand-title d-block">ICAyCC</span>
                    <span class="brand-subtitle d-block">Instituto de Ciencias de la Atmósfera y Cambio Climático</span>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#actualidad">Actualidad</a></li>
                    <li class="nav-item"><a class="nav-link" href="#eventos">Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pronosticos">Pronósticos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#noticias">Noticias</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <section id="inicio" aria-label="Banner principal">
            <div class="hero-banner">
                <img src="icaycc-gif-banner.gif" alt="Fachada del Instituto de Ciencias de la Atmósfera y Cambio Climático de la UNAM">
            </div>
            <div class="hero-caption py-3 py-md-4">
                <div class="container d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.12em;color:#BDE4D7">Investigación · Docencia · Difusión</div>
                        <h1 class="h3 mb-0 fw-bold">Ciencia atmosférica y cambio climático</h1>
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

    <footer id="contacto" class="pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <h2 class="h4 fw-bold">Instituto de Ciencias de la Atmósfera y Cambio Climático</h2>
                    <p class="mb-0" style="color:#d6e7e5">Universidad Nacional Autónoma de México</p>
                </div>
                <div class="col-6 col-lg-3">
                    <h3 class="h6 fw-bold">Información</h3>
                    <ul class="list-unstyled small d-grid gap-2">
                        <li><a href="#inicio">Acerca del Instituto</a></li>
                        <li><a href="#actualidad">Convocatorias y cursos</a></li>
                        <li><a href="#noticias">Noticias y artículos</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h3 class="h6 fw-bold">Enlaces</h3>
                    <ul class="list-unstyled small d-grid gap-2">
                        <li><a href="https://www.unam.mx/" target="_blank" rel="noopener noreferrer">UNAM</a></li>
                        <li><a href="https://pronosticos.atmosfera.unam.mx/" target="_blank" rel="noopener noreferrer">Pronósticos</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ul>
                </div>
            </div>
            <hr class="footer-rule my-4">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-2 small" style="color:#d6e7e5">
                <span>© <?= date('Y') ?> ICAyCC-UNAM · Portada de prueba</span>
                <span>Propuesta visual preliminar</span>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
