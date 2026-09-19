<?php

require_once __DIR__ . '/../config/config.php';

$id = intval($_GET['id']);

$sql = "
SELECT
    d.*,
    i.nombre AS responsable_nombre
FROM departamentos d

LEFT JOIN personal i
    ON i.id_personal = d.responsable

WHERE d.id_departamento = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$departamento = $stmt->fetch(PDO::FETCH_ASSOC);



?>

<div class="container py-5">

    <h1>
        <?= htmlspecialchars($departamento['nombre']); ?>
    </h1>

    <?php if(!empty($departamento['responsable_nombre'])){ ?>

        <p class="lead">
            <strong>Responsable:</strong>
            <?= htmlspecialchars($departamento['responsable_nombre']); ?>
        </p>

            <div class="card shadow-sm">

    <div class="card-body text-start">

        <div style="white-space: pre-line;">
            <?= htmlspecialchars($departamento['descripcion']); ?>
        </div>

    </div>

</div>

    <?php } ?>

    <hr>

    <?php

    $sql = "
    SELECT COUNT(*)
    FROM investigador_departamento
    WHERE id_departamento=?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $total = $stmt->fetchColumn();

    ?>

    <p>
        <strong><?= $total; ?></strong>
        acad&eacute;micos adscritos
    </p>

    <h3 class="mb-4">
        Integrantes 
    </h3>

    <div class="row">

    <?php

    $sql = "
    SELECT
        i.id_personal,
        i.nombre
    FROM personal i

    INNER JOIN investigador_departamento id
        ON id.id_investigador = i.id_personal

    WHERE id.id_departamento = ?

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
                        href="../investigadores/perfil.php?id=<?= $inv['id_personal']; ?>"
                        class="text-decoration-none">

                        <?= htmlspecialchars($inv['nombre']); ?>

                    </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>