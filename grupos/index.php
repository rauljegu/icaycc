<?php

require_once __DIR__ . '/../config/config.php';

?>

<div class="container py-5">

    <h1 class="titulo-seccion mb-4">
        Grupos de Investigación
    </h1>

    <div class="row">

    <?php

    $sql = "
    SELECT
        g.id_grupo,
        g.nombre,
        COUNT(ig.id_investigador) AS integrantes
    FROM grupos g

    LEFT JOIN investigador_grupo ig
        ON ig.id_grupo = g.id_grupo

    GROUP BY
        g.id_grupo,
        g.nombre

    ORDER BY g.nombre
    ";

    $stmt = $pdo->query($sql);

    while($grupo = $stmt->fetch(PDO::FETCH_ASSOC)){

    ?>

        <div class="col-md-6 col-lg-4 mb-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <span class="badge badge-grupo mb-2">
                        Grupo de Investigación
                    </span>

                    <h5>
                        <?= htmlspecialchars($grupo['nombre']); ?>
                    </h5>

                    <p class="text-muted">
                        <?= $grupo['integrantes']; ?>
                        integrantes
                    </p>

                </div>

                <div class="card-footer bg-white border-0">

                    <a
                        href="detalle.php?id=<?= $grupo['id_grupo']; ?>"
                        class="btn btn-icaycc w-100">

                        Ver grupo

                    </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php';?>