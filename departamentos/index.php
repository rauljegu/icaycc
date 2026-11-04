
<?php
require_once __DIR__ . '/../config/config.php';

$sql = "
    SELECT
        d.id_departamento,
        d.nombre,
        d.tipo,
        p.nombre AS responsable,
        COUNT(DISTINCT id.id_investigador) AS total

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

$stmt = $pdo->query($sql);
?>

<div class="container py-5">

    <!-- TÍTULO -->
    <h1 class="mb-4">
        Departamentos de Investigación
    </h1>

    <!-- IMAGEN INTRODUCTORIA -->
    <section class="departamentos-esquema mb-5">

        <img
            src="<?= rtrim(BASE_URL, '/') ?>/assets/img/departamentos.png"
            alt="Esquema de los departamentos, grupos y unidades del ICAyCC"
            class="img-fluid d-block mx-auto"
        >

    </section>

    <!-- TARJETAS DE DEPARTAMENTOS -->
    <section class="departamentos-listado">

        <div class="row row-cols-1 row-cols-md-2 g-4">

            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>

                <div class="col">

                    <div class="card shadow-sm h-100 departamento-card">

                        <div class="card-body d-flex flex-column">

                            <span class="badge bg-secondary mb-3 align-self-start">
                                <?= htmlspecialchars(ucfirst($row['tipo'])); ?>
                            </span>

                            <h5 class="card-title">
                                <?= htmlspecialchars($row['nombre']); ?>
                            </h5>

                            <?php if(!empty($row['responsable'])){ ?>

                                <p class="small text-muted mb-3">
                                    <strong>Responsable:</strong><br>
                                    <?= htmlspecialchars($row['responsable']); ?>
                                </p>

                            <?php } ?>

                            <p class="mb-3">
                                <strong>
                                    <?= (int)$row['total']; ?>
                                </strong>
                                integrantes registrados
                            </p>

                            <div class="mt-auto">

                                <a
                                    href="detalle.php?id=<?= (int)$row['id_departamento']; ?>"
                                    class="btn btn-icaycc w-100"
                                >
                                    Ver información
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </section>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
