<?php
require_once __DIR__ . '/../config/config.php';
?>

<div class="container py-5">

    <h1 class="mb-4">
        Quienes Somos
    </h1>

    <div class="row g-4">

        <!-- HISTORIA -->
        <div class="col-12">
            <div class="card shadow-sm h-100">
                <div class="card-body card-fondo-medium" id="historia">
                    <h2 class="card-title">Historia</h2>

                    <p>
                        El 8 de septiembre de 2021 en sesión extraordinaria, el pleno del Consejo Universitario 
                        aprobó por unanimidad la transformación del Centro de Ciencias de la Atmósfera (CCA), creado en 1977,
                        en Instituto de Ciencias de la Atmósfera y Cambio Climático (ICAyCC). 
                        Este en un recorrido histórico por los sucesos y personajes que siguen marcando esta transformación.
                    </p>

                    <iframe 
                        src="https://cdn.knightlab.com/libs/timeline3/latest/embed/index.html?source=v2:2PACX-1vQ79pM47oahX9_CeVRjjvWfLA9uo6MjoPCYuhDKVkro5av0KR4BV4O8V5ORXUyPaA&amp;font=Default&amp;lang=en&amp;initial_zoom=2&amp;height=650"
                        width="100%"
                        height="650"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>

                </div>
            </div>
        </div>


        <!-- MISIÓN -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body" id="mision">
                    <h2 class="card-title">Misión</h2>

                    <p>
                        Desarrollar y promover la investigación, comunicar el conocimiento y formar recursos humanos 
                        en las distintas disciplinas que abarcan las ciencias atmosféricas y el cambio climático, 
                        con un enfoque integral, multi e interdisciplinario, atendiendo, principalmente, diversos 
                        problemas nacionales, regionales y de coyuntura en estos temas.
                    </p>
                </div>
            </div>
        </div> 
		<!-- IMG MISIÓN -->
<div class="col-12 col-md-6">
    <div class="card shadow-sm h-100">
        <div class="card-body card-fondo-verde d-flex align-items-center justify-content-center">
            
            <img 
                src="img/mision.jpg"
                class="img-fluid"
                alt="Misión del ICAyCC"
            >

        </div>
    </div>
</div>


        <!-- VISIÓN -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body " id="vision">
                    <h2 class="card-title">Visión</h2>

                    <p>
                        Ser una entidad académica universitaria líder en la generación de conocimiento sobre las 
                        ciencias de la atmósfera y del cambio climático, reconocida nacional e internacionalmente, 
                        cuya comunidad se involucre en solucionar problemas nacionales, regionales y de coyuntura 
                        en su área de especialidad y esté comprometida en preparar a las nuevas generaciones de 
                        expertos en estos temas.
                    </p>
                </div>
            </div>
        </div>
		<!-- IMG VISIÓN -->
        <div class="col-12 col-md-6">
    <div class="card shadow-sm h-100">
        <div class="card-body card-fondo-verde d-flex align-items-center justify-content-center">
            
            <img 
                src="img/vision.jpg"
                class="img-fluid"
                alt="Misión del ICAyCC"
            >

        </div>
    </div>
</div>


        <!-- OBJETIVOS -->
        <div class="col-12">
            <div class="card shadow-sm h-100">
                <div class="card-body card-fondo-medium">
                    <h2 class="card-title">Objetivos</h2>

                    <p>
                        Consolidar el liderazgo en la investigación de las Ciencias de la Atmósfera y del Cambio 
                        Climático, así como proporcionar condiciones favorables para una investigación multidisciplinaria 
                        de excelencia, en un marco de ética, inclusión, igualdad y libertad de investigación y cátedra, 
                        promoviendo el desarrollo de las ciencias en los temas de su especialidad, como una estrategia 
                        clave para la solución de problemas nacionales, regionales y coyunturales, en beneficio de la sociedad.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>