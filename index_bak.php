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

?>

<div class="container py-5">

    <!-- ENCABEZADO -->

    <div class="text-center mb-5">
		 <img
        src="<?= BASE_URL ?>assets/img/logo_icaycc_colores.svg"
        alt="ICAyCC"
        class="img-fluid mb-4"
        style="max-height:180px;">

       <!-- <h1 class="display-5 fw-bold titulo-seccion">
            Instituto de Ciencias de la Atmósfera
            y Cambio Climático
        </h1>-->

        <p class="lead text-muted">
            Universidad Nacional Autónoma de México
        </p>

    </div>

    <!-- DEPARTAMENTOS -->

    <div class="mb-5">

        <h2 class="titulo-seccion mb-4">
            Departamentos de Investigación
        </h2>

        <div class="row">

            <?php while($dep = $investigacion->fetch(PDO::FETCH_ASSOC)){ ?>

                <div class="col-md-6 col-lg-3 mb-4">

                    <div class="card card-departamento shadow-sm h-100">

                        <div class="card-body">

                            <span class="badge badge-investigacion mb-2">
                                Investigación
                            </span>

                            <h5 class="card-title">
                                <?= htmlspecialchars($dep['nombre']); ?>
                            </h5>

                            <?php if(!empty($dep['responsable'])){ ?>

                                <p class="small text-muted">
                                    <strong>Responsable</strong><br>
                                    <?= htmlspecialchars($dep['responsable']); ?>
                                </p>

                            <?php } ?>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a
                                href="<?= BASE_URL ?>departamentos/detalle.php?id=<?= $dep['id_departamento']; ?>"
                                class="btn btn-icaycc w-100">

                                Ver departamento

                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>
<!-- GRUPOS DE INVESTIGACIÓN -->

<div class="my-5">

    <h2 class="titulo-seccion mb-4">
        Grupos de Investigación
    </h2>

    <div class="row">

        <?php while($grupo = $grupos->fetch(PDO::FETCH_ASSOC)){ ?>

            <div class="col-md-6 col-lg-3 mb-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <span class="badge badge-grupo mb-2">
                            Grupo
                        </span>

                        <h6 class="card-title">

                            <?= htmlspecialchars($grupo['nombre']); ?>

                        </h6>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <a
                            href="<?= BASE_URL ?>grupos/detalle.php?id=<?= $grupo['id_grupo']; ?>"
                            class="btn btn-icaycc w-100">

                            Ver grupo

                        </a>

                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

</div>
    <!-- UNIDADES DE APOYO -->

    <div>

        <h2 class="titulo-seccion mb-4">
            Unidades de Apoyo
        </h2>

        <div class="row">

            <?php while($dep = $apoyo->fetch(PDO::FETCH_ASSOC)){ ?>

                <div class="col-md-6 col-lg-4 mb-4">

                    <div class="card shadow-sm h-100">

                        <div class="card-body">

                            <span class="badge badge-apoyo mb-2">
                                Apoyo
                            </span>

                            <h5 class="card-title">
                                <?= htmlspecialchars($dep['nombre']); ?>
                            </h5>

                            <?php if(!empty($dep['responsable'])){ ?>

                                <p class="small text-muted">
                                    <strong>Responsable</strong><br>
                                    <?= htmlspecialchars($dep['responsable']); ?>
                                </p>

                            <?php } ?>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a
                                href="<?= BASE_URL ?>unidades/detalle.php?id=<?= $dep['id_unidades']; ?>"
                                class="btn btn-icaycc w-100">

                                Ver unidad

                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</div>

<?php //include('includes/footer.php'); 


require_once ROOT_PATH . '/includes/footer.php';

?>
