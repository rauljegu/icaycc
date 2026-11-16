<?php
require_once __DIR__ . '/../config/config.php';

// Identificador fijo de esta comisión o comité, definido en el menú.
$idComision = 7;

function comisionE($valor): string
{
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}

function comisionAbreviarGrado($grado): string
{
    $grado = trim((string) ($grado ?? ''));
    if ($grado === '') {
        return '';
    }

    $normalizado = strtr($grado, [
        'Á' => 'á', 'É' => 'é', 'Í' => 'í', 'Ó' => 'ó', 'Ú' => 'ú'
    ]);
    $normalizado = strtolower($normalizado);
    $normalizado = strtr($normalizado, [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u'
    ]);

    if (strpos($normalizado, 'doctorado') === 0 || strpos($normalizado, 'doctor') === 0) {
        return 'Dr(a).';
    }
    if (
        strpos($normalizado, 'maestria') === 0 ||
        strpos($normalizado, 'maestro') === 0 ||
        strpos($normalizado, 'maestra') === 0
    ) {
        return 'Mtra(o).';
    }
    if (
        strpos($normalizado, 'licenciatura') === 0 ||
        strpos($normalizado, 'licenciado') === 0 ||
        strpos($normalizado, 'licenciada') === 0
    ) {
        return 'Lic.';
    }

    return $grado;
}

$comision = null;
$integrantes = [];

{
    // Datos generales del comité o comisión.
    $sqlComision = "
        SELECT
            ic_cc,
            nombre,
            descripcion,
            enlace,
            correo,
            telefono
        FROM comites_comisiones
        WHERE ic_cc = ?
          AND activo = 1
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sqlComision);
    $stmt->execute([$idComision]);
    $comision = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($comision) {
        // Integrantes en el orden definido por la llave primaria de la tabla de relación.
        $sqlIntegrantes = "
            SELECT
                p.id_personal,
                p.nombre,
                p.grado_academico,
                p.correo
            FROM comite_etica r
            INNER JOIN personal p
                ON p.id_personal = r.id_personal
            WHERE r.id_cc = ?
            ORDER BY r.id_ce ASC
        ";

        $stmt = $pdo->prepare($sqlIntegrantes);
        $stmt->execute([$idComision]);
        $integrantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<div class="container py-5">

    <?php if (!$comision): ?>

        <div class="alert alert-warning" role="alert">
            No se encontró la comisión o comité solicitado.
        </div>

    <?php else: ?>

        <h1><?= comisionE($comision['nombre']); ?></h1>

        <?php if (!empty($comision['descripcion'])): ?>
            <div class="card shadow-sm mt-4">
                <div class="card-body text-start">
                    <div style="white-space: pre-line;"><?= comisionE($comision['descripcion']); ?></div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (
            !empty($comision['correo']) ||
            !empty($comision['telefono']) ||
            !empty($comision['enlace'])
        ): ?>
            <div class="mt-3">
                <?php if (!empty($comision['correo'])): ?>
                    <p class="mb-1">
                        <strong>Correo:</strong>
                        <a href="mailto:<?= comisionE($comision['correo']); ?>">
                            <?= comisionE($comision['correo']); ?>
                        </a>
                    </p>
                <?php endif; ?>

                <?php if (!empty($comision['telefono'])): ?>
                    <p class="mb-1">
                        <strong>Teléfono:</strong>
                        <?= comisionE($comision['telefono']); ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($comision['enlace'])): ?>
                    <p class="mb-1">
                        <a href="<?= comisionE($comision['enlace']); ?>" target="_blank" rel="noopener">
                            Más información
                        </a>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <hr class="my-4">

        <p>
            <strong><?= count($integrantes); ?></strong>
            <?= count($integrantes) === 1 ? 'integrante registrado' : 'integrantes registrados'; ?>
        </p>

        <h3 class="mb-4">Integrantes</h3>

        <?php if (!$integrantes): ?>

            <p class="text-muted">No hay integrantes registrados para esta comisión o comité.</p>

        <?php else: ?>

            <div class="row">
                <?php foreach ($integrantes as $integrante): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">

                                <?php if (!empty($integrante['grado_academico'])): ?>
                                    <div class="small text-muted fw-semibold mb-1">
                                        <?= comisionE(comisionAbreviarGrado($integrante['grado_academico'])); ?>
                                    </div>
                                <?php endif; ?>

                                <a
                                    href="../investigadores/perfil.php?id=<?= (int) $integrante['id_personal']; ?>"
                                    class="text-decoration-none"
                                >
                                    <?= comisionE($integrante['nombre']); ?>
                                </a>

                                <?php if (!empty($integrante['correo'])): ?>
                                    <div class="small mt-2">
                                        <a href="mailto:<?= comisionE($integrante['correo']); ?>">
                                            <?= comisionE($integrante['correo']); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    <?php endif; ?>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
