
<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/slider-revolution.php';

// Información general
$sql = "SELECT * FROM integrate";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$inte = $stmt->fetch(PDO::FETCH_ASSOC);

// Programas activos
$sql1 = "
    SELECT *
    FROM programas_ss_pp
    WHERE activo = 1
    ORDER BY id_programa ASC
";

$stmt1 = $pdo->prepare($sql1);
$stmt1->execute();

// Consulta del contenido asociado a cada programa
$sql2 = "
    SELECT *
    FROM lista_ss_pp
    WHERE id_programa = :id_programa
";

$stmt2 = $pdo->prepare($sql2);

// Licenciaturas Afines
$sql3 = "
    SELECT *
    FROM lic_afines
    WHERE activo = 1
    ORDER BY id_lic_afin ASC
";

$stmt3 = $pdo->prepare($sql3);
$stmt3->execute();

// Posgrados Afines
$sql4 = "
    SELECT *
    FROM pos_afines
    WHERE activo = 1
    ORDER BY id_pos_afin ASC
";

$stmt4 = $pdo->prepare($sql4);
$stmt4->execute();
?>


<div class="container py-5">

    <!-- ===================================== -->
    <!-- PRESENTACIÓN -->
    <!-- ===================================== -->

    <h1 class="mb-4">
        <?=htmlspecialchars($inte['nombre']);?>
    </h1>

    <div class="row g-4 mb-5">

        <div class="col-12 col-lg-6">

            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center p-4">

                    <h2 class="h4 card-title mb-3">
                        Servicio Social y Pr&aacute;cticas Profesionales
                    </h2>

                    <p>
                        <?=htmlspecialchars($inte['descripcion']);?>
                    </p>

                    <h3 class="h5 mb-2">
                        Informes
                    </h3>

                    <p class="mb-1">
                        <i class="bi bi-envelope me-2"></i>
                        <?=htmlspecialchars($inte['correo']);?>
                    </p>

                    <p class="mb-0">
                        <i class="bi bi-telephone me-2"></i>
                        <?=htmlspecialchars($inte['telefono']);?>
                    </p>

                </div>
            </div>

        </div>


        <div class="col-12 col-lg-6">

            <div class="card shadow-sm h-100">
                <div class="card-body card-fondo-verde
                            d-flex align-items-center justify-content-center p-3">

                    <img
                        src="img/inte.jpg"
                        class="img-fluid"
                        alt="Intégrate"
                    >

                </div>
            </div>

        </div>

    </div>


    <!-- ===================================== -->
    <!-- TRÁMITES DE SERVICIO SOCIAL -->
    <!-- ===================================== -->

    <section class="row g-3 mb-5 p-3 p-md-4"
             style="background:#F2FAFF;"
             id="servicio">

        <div class="col-12">

            <div class="card shadow-sm h-100 border-0">

                <div class="card-body d-flex flex-column
                            justify-content-center
                            card-fondo-medium p-4">

                    <h2 class="h4 mb-3">
                        TR&Aacute;MITES DE SERVICIO SOCIAL EN EL ICAYCC
                    </h2>

                    <p class="mb-0">
                        <?=nl2br(htmlspecialchars($inte['tramites']));?>
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- ===================================== -->
    <!-- PROGRAMAS -->
    <!-- ===================================== -->

    <section class="row g-3 mb-5 p-3 p-md-4"
             style="background:#F2FAFF;"
             id="practicas">

        <div class="col-12">

            <h2 class="h3 mb-4">
                PROGRAMAS
            </h2>

            <div class="accordion accordion-flush"
                 id="accordionProgramas">

                <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) { ?>

                    <?php
                    // Recuperar los contenidos correspondientes al programa
                    $stmt2->execute([
                        ':id_programa' => $row['id_programa']
                    ]);

                    $listas = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                    // Identificador único para cada acordeón
                    $idPrograma = (int) $row['id_programa'];
                    $headingId = 'heading' . $idPrograma;
                    $collapseId = 'collapse' . $idPrograma;
                    ?>

                    <div class="accordion-item">

                        <h3 class="accordion-header"
                            id="<?= $headingId; ?>">

                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#<?= $collapseId; ?>"
                                aria-expanded="false"
                                aria-controls="<?= $collapseId; ?>"
                            >
                                <?= htmlspecialchars($row['nombre']); ?>
                            </button>

                        </h3>

                        <div
                            id="<?= $collapseId; ?>"
                            class="accordion-collapse collapse"
                            aria-labelledby="<?= $headingId; ?>"
                            data-bs-parent="#accordionProgramas"
                        >

                            <div class="accordion-body p-3 p-md-4">

                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered align-middle mb-0">

                                        <tbody>

                                            <?php foreach ($listas as $lista) { ?>

                                                <tr>

                                                    <td>
                                                        <p class="mb-1">
                                                            <?= htmlspecialchars($lista['nombre']); ?>
                                                        </p>

                                                        <p class="mb-0">
                                                            CLAVE: <?= htmlspecialchars($lista['clave']); ?>
                                                        </p>
                                                    </td>

                                                    <?php if($lista['especialidad']!= "") { ?>

                                                        <td>
                                                            <?= htmlspecialchars($lista['especialidad']); ?>
                                                        </td>

                                                    <?php } ?>

                                                </tr>

                                            <?php } ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </section>


    <!-- ===================================== -->
    <!-- LICENCIATURAS Y POSGRADOS AFINES -->
    <!-- ===================================== -->

    <section class="row g-4 p-3 p-md-4"
             style="background:#F2FAFF;">

        <!-- LICENCIATURAS AFINES -->

        <div class="col-12 col-lg-6">

            <div class="card shadow-sm h-100 border-0">

                <div class="card-body d-flex flex-column
                            card-fondo-medium p-4">

                    <h2 class="h4 mb-3">
                        Licenciaturas afines al ICAYCC
                    </h2>

                    <p>
                        <?=htmlspecialchars($inte['lic_afines']);?>
                    </p>

                    <ul class="list-unstyled d-flex flex-column gap-2 mb-0">

                        <?php
                        while ($row1 = $stmt3->fetch(PDO::FETCH_ASSOC)) { ?>

                            <li>

                                <a href="<?=htmlspecialchars($row1['link']);?>"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn btn-primary boton-fondo-medium w-100 text-start">

                                    <?=htmlspecialchars($row1['licenciatura']);?>

                                </a>

                            </li>

                        <?php } ?>

                    </ul>

                </div>

            </div>

        </div>


        <!-- POSGRADOS AFINES -->

        <div class="col-12 col-lg-6">

            <div class="card shadow-sm h-100 border-0">

                <div class="card-body d-flex flex-column
                            card-fondo-medium p-4">

                    <h2 class="h4 mb-3">
                        Posgrados de la UNAM afines al ICAYCC
                    </h2>

                    <p>
                        <?=htmlspecialchars($inte['pos_afines']);?>
                    </p>

                    <ul class="list-unstyled d-flex flex-column gap-2 mb-0">

                        <?php
                        while ($row2 = $stmt4->fetch(PDO::FETCH_ASSOC)) { ?>

                            <li>

                                <a href="<?=htmlspecialchars($row2['link']);?>"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn btn-primary boton-fondo-medium w-100 text-start">

                                    <?=htmlspecialchars($row2['posgrado']);?>

                                </a>

                            </li>

                        <?php } ?>

                    </ul>

                </div>

            </div>

        </div>

    </section>

</div>


<?php
//finalizarSlidersRevolution();
require_once ROOT_PATH . '/includes/footer.php';
?>
