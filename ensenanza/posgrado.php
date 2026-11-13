
<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/slider-revolution.php';

$sql = "
SELECT
   *
FROM posgrado
";

//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$pos = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="container py-5">

    <!-- ===================================== -->
    <!-- PRESENTACIÓN -->
    <!-- ===================================== -->

    <h1 class="mb-4">
        <?=htmlspecialchars($pos['nombre']);?>
    </h1>

    <div class="row g-4 mb-5">

        <div class="col-12 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center p-4">

                    <h2 class="card-title mb-3">
                        Orientación en Ciencias Atmosféricas
                    </h2>

                    <p class="mb-0">
                        <?=htmlspecialchars($pos['descripcion']);?>
                    </p>

                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body card-fondo-verde
                            d-flex align-items-center justify-content-center p-3">

                    <img
                        src="img/pos.jpg"
                        class="img-fluid"
                        alt="Posgrado"
                    >

                </div>
            </div>
        </div>

    </div>


    <!-- ===================================== -->
    <!-- ASPIRANTES -->
    <!-- ===================================== -->

    <section class="mb-5 p-3 p-md-4"
             style="background:#F2FAFF;"
             id="aspirantes">

        <h2 class="h3 text-center mb-4">
            ASPIRANTES
        </h2>

        <div class="row g-4">

            <!-- PRESENTACIÓN 1 -->

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column
                                justify-content-center align-items-center
                                text-center card-fondo-medium p-4">

                        <h2 class="card-title mb-3">
                            <i class="bi bi-card-checklist"></i>
                        </h2>

                        <p class="mb-4">
                            <?=htmlspecialchars($pos['temarios']);?>
                        </p>

                        <a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_temarios']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde mt-auto">
                            VER M&Aacute;S
                        </a>

                    </div>
                </div>
            </div>


            <!-- PRESENTACIÓN 2 -->

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column
                                justify-content-center align-items-center
                                text-center card-fondo-verde p-4">

                        <h2 class="card-title mb-3">
                            <i class="bi bi-mortarboard"></i>
                        </h2>

                        <p class="mb-4">
                            <?=htmlspecialchars($pos['tutores']);?>
                        </p>

                        <a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_tutores']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde mt-auto">
                            VER M&Aacute;S
                        </a>

                    </div>
                </div>
            </div>


            <!-- PRESENTACIÓN 3 -->

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column
                                justify-content-center align-items-center
                                text-center card-fondo-medium p-4">

                        <h2 class="card-title mb-3">
                            <i class="bi bi-geo-alt"></i>
                        </h2>

                        <p class="mb-4">
                            <?=htmlspecialchars($pos['tutores_ext']);?>
                        </p>

                        <a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_tutores_e']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde mt-auto">
                            VER M&Aacute;S
                        </a>

                    </div>
                </div>
            </div>

        </div>


        <!-- PROCESO DE ADMISIÓN -->

        <div class="row mt-4">

            <div class="col-12">

                <div class="card shadow-sm h-100">
                    <div class="card-body card-fondo-medium
                                d-flex flex-column flex-md-row
                                justify-content-between align-items-center
                                gap-3 p-4">

                        <h3 class="h5 mb-0 text-center text-md-start">
                            PROCESO DE ADMISI&Oacute;N
                        </h3>

                        <a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_admision']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde">
                            M&Aacute;S INFORMACI&Oacute;N
                        </a>

                    </div>
                </div>

            </div>

        </div>

    </section>


    <!-- ===================================== -->
    <!-- ESTUDIANTES -->
    <!-- ===================================== -->

    <section class="mb-5 p-3 p-md-4"
             style="background:#F2FAFF;"
             id="estudiantes">

        <h2 class="h3 text-center mb-4">
            ESTUDIANTES
        </h2>

        <div class="row g-4">

            <!-- PRESENTACIÓN 1 -->

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column
                                justify-content-center align-items-center
                                text-center card-fondo-medium p-4">

                        <h2 class="card-title mb-3">
                            <i class="bi bi-card-checklist"></i>
                        </h2>

                        <p class="mb-4">
                            <?=htmlspecialchars($pos['asignaturas']);?>
                        </p>

                        <a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_asignaturas']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde mt-auto">
                            VER M&Aacute;S
                        </a>

                    </div>
                </div>
            </div>


            <!-- PRESENTACIÓN 2 -->

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column
                                justify-content-center align-items-center
                                text-center card-fondo-verde p-4">

                        <h2 class="card-title mb-3">
                            <i class="bi bi-mortarboard"></i>
                        </h2>

                        <p class="mb-4">
                            <?=htmlspecialchars($pos['calendario']);?>
                        </p>

                        <a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_calendario']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde mt-auto">
                            VER M&Aacute;S
                        </a>

                    </div>
                </div>
            </div>


            <!-- PRESENTACIÓN 3 -->

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column
                                justify-content-center align-items-center
                                text-center card-fondo-medium p-4">

                        <h2 class="card-title mb-3">
                            <i class="bi bi-geo-alt"></i>
                        </h2>

                        <p class="mb-4">
                            <?=htmlspecialchars($pos['formatos']);?>
                        </p>

                        <a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_formatos']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde mt-auto">
                            VER M&Aacute;S
                        </a>

                    </div>
                </div>
            </div>

        </div>

    </section>


    <!-- ===================================== -->
    <!-- INFORMACIÓN PARA GRADUARSE -->
    <!-- ===================================== -->

    <div class="row g-4 mb-5">

        <!-- INFORMACIÓN PARA GRADUARSE -->

        <div class="col-12 col-lg-6">

            <div class="card shadow-sm h-100">
                <div class="card-body p-4">

                    <hr class="w-50 mx-auto">

                    <h3 class="h5 text-center mb-4">
                        Informaci&oacute;n para graduarse
                    </h3>

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_pasos']);?>"
                               target="_blank"
                               rel="noopener noreferrer">
                                Pasos a seguir
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_ftt']);?>"
                               target="_blank"
                               rel="noopener noreferrer">
                                Formato para tr&aacute;mite de titulaci&oacute;n
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_fva']);?>"
                               target="_blank"
                               rel="noopener noreferrer">
                                Formato de voto aprobatorio
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_fvamh']);?>"
                               target="_blank"
                               rel="noopener noreferrer">
                                Formato de voto aprobatorio con menci&oacute;n honor&iacute;fica
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_fct']);?>"
                               target="_blank"
                               rel="noopener noreferrer">
                                Formato de car&aacute;tula de tesis
                            </a>
                        </li>

                    </ul>

                </div>
            </div>

        </div>


        <!-- CREDENCIAL -->

        <div class="col-12 col-lg-6">

            <div class="card shadow-sm h-100">
                <div class="card-body p-4">

                    <hr class="w-50 mx-auto">

                    <h3 class="h5 text-center mb-4">
                        Credencial
                    </h3>

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_credencial']);?>"
                               target="_blank"
                               rel="noopener noreferrer">
                                Procedimiento para la obtenci&oacute;n de credencial
                            </a>
                        </li>

                    </ul>

                </div>
            </div>

        </div>

    </div>


    <!-- ===================================== -->
    <!-- BECAS -->
    <!-- ===================================== -->

    <section class="mb-5 p-3 p-md-4"
             style="background:#F2FAFF;"
             id="becas">

        <div class="row">

            <div class="col-12">

                <div class="d-flex flex-column flex-lg-row align-items-stretch">

                    <!-- MENÚ VERTICAL / HORIZONTAL -->

                    <div class="nav nav-tabs flex-row flex-lg-column
                                me-lg-3 mb-3 mb-lg-0"
                         id="nav-tab"
                         role="tablist"
                         aria-orientation="vertical">

                        <button
                            class="nav-link active boton-fondo-verde"
                            id="nav-Becas-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-Becas"
                            type="button"
                            role="tab"
                            aria-controls="nav-Becas"
                            aria-selected="true">

                            <h3 class="h5 text-center mb-0">
                                BECAS
                            </h3>

                        </button>

                    </div>


                    <!-- CONTENIDO DE LAS TABS -->

                    <div class="tab-content flex-grow-1"
                         id="nav-tabContent">

                        <!-- BECAS -->

                        <div class="tab-pane fade show active"
                             id="nav-Becas"
                             role="tabpanel"
                             aria-labelledby="nav-Becas-tab"
                             tabindex="0">

                            <div class="card shadow-sm border-0">

                                <div class="card-body p-3 p-md-4">

                                    <div class="row g-3">

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a href="http://www.pctierra.unam.mx/es/contenido/becas"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="btn btn-primary boton-fondo-verde w-100 h-100 d-flex align-items-center justify-content-center text-center p-3">

                                                POSGRADO EN CIENCIAS DE LA TIERRA

                                            </a>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a href="https://internationalweek.unaminternacional.unam.mx/"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="btn btn-primary boton-fondo-verde w-100 h-100 d-flex align-items-center justify-content-center text-center p-3">

                                                BECAS UNAM

                                            </a>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a href="https://vsrp.kaust.edu.sa/"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="btn btn-primary boton-fondo-verde w-100 h-100 d-flex align-items-center justify-content-center text-center p-3">

                                                BECAS KAUST

                                            </a>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a href="https://www.becasmexico.com.mx/"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="btn btn-primary boton-fondo-verde w-100 h-100 d-flex align-items-center justify-content-center text-center p-3">

                                                BECAS M&Eacute;XICO

                                            </a>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a href="https://www.becarios.unam.mx/Portal2018/?page_id=111"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="btn btn-primary boton-fondo-verde w-100 h-100 d-flex align-items-center justify-content-center text-center p-3">

                                                BECAS ALTO RENDIMIENTO

                                            </a>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a href="https://www.fordfoundation.org/our-work-around-the-world/mexico-and-central-america/"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="btn btn-primary boton-fondo-verde w-100 h-100 d-flex align-items-center justify-content-center text-center p-3">

                                                BECAS FORD

                                            </a>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ===================================== -->
    <!-- COMITÉ ACADÉMICO -->
    <!-- ===================================== -->

    <section class="p-3 p-md-4"
             style="background:#F2FAFF;"
             id="comite">

        <h2 class="h3 text-center mb-4">
            COMIT&Eacute; ACAD&Eacute;MICO
        </h2>

        <div class="row g-4">

            <!-- FECHAS DE REUNIONES -->

            <div class="col-12 col-md-6 col-lg-4">

                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column
                                justify-content-center align-items-center
                                text-center card-fondo-medium p-4">

                        <h2 class="card-title mb-3">
                            <i class="bi bi-card-checklist"></i>
                        </h2>

                        <p class="mb-4">
                            <?=htmlspecialchars($pos['ca_fechas_reuniones']);?>
                        </p>

                        <a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_aca_fechas_reuniones']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde mt-auto">
                            VER M&Aacute;S
                        </a>

                    </div>
                </div>

            </div>


            <!-- FORMATOS -->

            <div class="col-12 col-md-6 col-lg-4">

                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column
                                justify-content-center align-items-center
                                text-center card-fondo-verde p-4">

                        <h2 class="card-title mb-3">
                            <i class="bi bi-mortarboard"></i>
                        </h2>

                        <p class="mb-4">
                            <?=htmlspecialchars($pos['ca_formatos']);?>
                        </p>

                        <a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_ca_formatos']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde mt-auto">
                            VER M&Aacute;S
                        </a>

                    </div>
                </div>

            </div>


            <!-- ACTAS -->

            <div class="col-12 col-md-6 col-lg-4">

                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column
                                justify-content-center align-items-center
                                text-center card-fondo-medium p-4">

                        <h2 class="card-title mb-3">
                            <i class="bi bi-geo-alt"></i>
                        </h2>

                        <p class="mb-4">
                            <?=htmlspecialchars($pos['ca_actas']);?>
                        </p>

                        <a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_ca_actas']);?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-primary boton-fondo-verde mt-auto">
                            VER M&Aacute;S
                        </a>

                    </div>
                </div>

            </div>

        </div>

    </section>

</div>


<?php
//finalizarSlidersRevolution();
require_once ROOT_PATH . '/includes/footer.php';
?>
