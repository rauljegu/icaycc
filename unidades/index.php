<?php
require_once __DIR__ . '/../config/config.php';
?>

<div class="container py-5">

    <h1 class="mb-4">
        Unidades de Apoyo
    </h1>

    <div class="row">

    <?php

    $sql = "
    SELECT
        u.id_unidades,
        u.nombre,
        u.tipo,
        p.nombre AS responsable

    FROM unidades u

    LEFT JOIN personal p
        ON p.id_personal = u.responsable

    LEFT JOIN personal_unidades pu
        ON pu.id_unidades = u.id_unidades

    GROUP BY
        u.id_unidades,
        u.nombre,
        u.tipo,
        p.nombre

    ORDER BY
        u.tipo,
        u.nombre
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

                    <a
                        href="detalle.php?id=<?= $row['id_unidades']; ?>"
                        class="btn btn-icaycc">
                        Ver informaci&oacute;n
                    </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>