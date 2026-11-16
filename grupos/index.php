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
		g.sitio,
        g.nombre,
        COUNT(ig.id_investigador) AS integrantes
    FROM grupos g

    LEFT JOIN investigador_grupo ig
        ON ig.id_grupo = g.id_grupo
	WHERE rol != 'administrativo'
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
					<?php 
						if($grupo["sitio"] == ""){ ?>
                    <a
                        href="detalle.php?id=<?= $grupo['id_grupo']; ?>"
                        class="btn btn-icaycc w-100">

                        Ver grupo

                    </a>
				<?php } else  {?>
					<a
                        href="<?= $grupo['sitio']; ?>"
                        class="btn btn-icaycc w-100" target="_blank">

                        Ver grupo

                    </a>
				<?php } ?>

                </div>

            </div>

        </div>

    <?php } ?>
	 <h1 class="titulo-seccion mb-4">
        Laboratorios
    </h1>
<?php

    $sql = "
    SELECT
        l.id_laboratorio,
		l.sitio,
        l.nombre,
        COUNT(il.id_investigador) AS integrantes
    FROM laboratorios l

    LEFT JOIN investigador_laboratorio il
        ON il.id_laboratorio = l.id_laboratorio

    GROUP BY
        l.id_laboratorio,
        l.nombre

    ORDER BY l.nombre
    ";

    $stmt = $pdo->query($sql);

    while($lab = $stmt->fetch(PDO::FETCH_ASSOC)){

    ?>

        <div class="col-md-6 col-lg-4 mb-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <span class="badge badge-grupo mb-2">
                       Laboratorios
                    </span>

                    <h5>
                        <?= htmlspecialchars($lab['nombre']); ?>
                    </h5>

                    <p class="text-muted">
                        <?= $lab['integrantes']; ?>
                        integrantes
                    </p>

                </div>

                <div class="card-footer bg-white border-0">
					<?php 
						if($lab["sitio"] == ""){ ?>
                    <a
                        href="detalle_lab.php?id=<?= $lab['id_laboratorio']; ?>"
                        class="btn btn-icaycc w-100">

                        Ver Laboratorio

                    </a>
				<?php } else  {?>
					<a
                        href="<?= $lab['sitio']; ?>"
                        class="btn btn-icaycc w-100" target="_blank">

                        Ver Laboratorio

                    </a>
				<?php } ?>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php';?>