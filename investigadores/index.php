<?php

require_once __DIR__ . '/../config/config.php';

$id = intval($_GET['id']);

$sql = "
SELECT *
FROM grupos
WHERE id_grupo = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$grupo = $stmt->fetch(PDO::FETCH_ASSOC);



?>

<div class="container py-5">

    <h1>
        <?= htmlspecialchars($grupo['nombre']); ?>
    </h1>

    <?php if(!empty($grupo['descripcion'])){ ?>

        <p class="lead">
            <?= nl2br(htmlspecialchars($grupo['descripcion'])); ?>
        </p>

    <?php } ?>

    <hr>

    <h3>
        Integrantes
    </h3>

    <div class="row">

    <?php

    $sql = "
    SELECT
        i.id_investigador,
        i.nombre,
        ig.rol

    FROM investigador_grupo ig

    INNER JOIN investigadores i
        ON i.id_investigador = ig.id_investigador

    WHERE ig.id_grupo = ?

    ORDER BY i.nombre
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    while($inv = $stmt->fetch(PDO::FETCH_ASSOC)){

    ?>

        <div class="col-md-4 mb-3">

            <div class="card h-100">

                <div class="card-body">

                    <a
                        href="../investigadores/perfil.php?id=<?= $inv['id_investigador']; ?>"
                        class="text-decoration-none">

                        <?= htmlspecialchars($inv['nombre']); ?>

                    </a>

                    <?php if(!empty($inv['rol'])){ ?>

                        <div class="small text-muted mt-2">
                            <?= htmlspecialchars($inv['rol']); ?>
                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php';?>