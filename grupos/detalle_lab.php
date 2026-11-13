<?php

require_once __DIR__ . '/../config/config.php';

$id = intval($_GET['id']);

$sql = "
SELECT *
FROM laboratorios
WHERE id_laboratorio = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$lab = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<div class="container py-5">

    <h1>
        <?= htmlspecialchars($lab['nombre']); ?>
    </h1>

    <?php if(!empty($lab['descripcion'])){ ?>

        <p class="lead">
            <?= nl2br(htmlspecialchars($lab['descripcion'])); ?>
        </p>

    <?php } ?>

     <hr>

    <?php

    $sql = "
    SELECT COUNT(*)
    FROM investigador_laboratorio
    WHERE id_laboratorio=?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $total = $stmt->fetchColumn();

    ?>

    <p>
        <strong><?= $total; ?></strong>
        Acad&eacute;micos adscritos
    </p>

    <h3>
        Integrantes
    </h3>

    <div class="row">

    <?php

    $sql = "
    SELECT
        i.id_personal,
        i.nombre,
        il.rol

    FROM investigador_laboratorio il

    INNER JOIN personal i
        ON i.id_personal = il.id_investigador

    WHERE il.id_laboratorio = ?

    ORDER BY i.nombre
    ";
//echo $sql;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    while($inv = $stmt->fetch(PDO::FETCH_ASSOC)){

    ?>

        <div class="col-md-4 mb-3">

            <div class="card h-100">

                <div class="card-body">

                    <a
                        href="../investigadores/perfil.php?id=<?= $inv['id_personal']; ?>"
                        class="text-decoration-none">

                        <?= htmlspecialchars($inv['nombre']); ?>

                    </a>

                    <?php if(!empty($inv['rol'])){ ?>

                        <div class="small text-muted mt-2">
                            <?= htmlspecialchars(ucfirst($inv['rol'])); ?>
                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php';?>