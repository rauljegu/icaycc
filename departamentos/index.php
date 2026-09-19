<?php
require_once __DIR__ . '/../config/config.php';
/*require_once($enlace.'includes/conexion.php');

include($enlace.'includes/header.php');
include($enlace.'includes/menu.php');
*/
?>

<div class="container py-5">

    <h1 class="mb-4">
        Departamentos de Investigaci&oacute;n
    </h1>

    <div class="row">

    <?php

    $sql = "
    SELECT
        d.id_departamento,
        d.nombre,
        d.tipo,
        p.nombre AS responsable,
        COUNT(id.id_investigador) AS total

    FROM departamentos d

    LEFT JOIN personal p
        ON p.id_personal = d.responsable

    LEFT JOIN investigador_departamento id
        ON id.id_departamento = d.id_departamento

    GROUP BY
        d.id_departamento,
        d.nombre,
        d.tipo,
        p.nombre

    ORDER BY
        d.tipo,
        d.nombre
    ";
 //echo $sql;
    $stmt = $pdo->query($sql);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    ?>

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <span class="badge bg-secondary mb-2">
                        <?= ucfirst($row['tipo']); ?>
                    </span>

                    <h5 class="card-title">
                        <?= htmlspecialchars($row['nombre']); ?>
                    </h5>

                    <?php if(!empty($row['responsable'])){ ?>

                        <p class="small text-muted mb-2">
                            <strong>Responsable:</strong><br>
                            <?= htmlspecialchars($row['responsable']); ?>
                        </p>

                    <?php } ?>

                    <p>
                        <strong><?= $row['total']; ?></strong>
                        integrantes registrados
                    </p>

                    <a
                        href="detalle.php?id=<?= $row['id_departamento']; ?>"
                        class="btn btn-icaycc">
                        Ver información
                    </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>