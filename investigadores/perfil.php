<?php

require_once __DIR__ . '/../config/config.php';

$id = intval($_GET['id'] ?? 0);

if($id <= 0){
    die('Investigador no válido');
}

/* ==========================
   DATOS DEL INVESTIGADOR
   ========================== */

$sql = "
SELECT *
FROM personal
WHERE id_personal = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$investigador = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$investigador){
    die('Investigador no encontrado');
}

/* ==========================
   DEPARTAMENTOS
   ========================== */

$sql = "
SELECT d.nombre
FROM departamentos d

INNER JOIN investigador_departamento id
    ON id.id_departamento = d.id_departamento

WHERE id.id_investigador = ?

ORDER BY d.nombre
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ==========================
   GRUPOS
   ========================== */

$sql = "
SELECT g.nombre
FROM grupos g

INNER JOIN investigador_grupo ig
    ON ig.id_grupo = g.id_grupo

WHERE ig.id_investigador = ?

ORDER BY g.nombre
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$grupo = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="container py-5">

    <!-- ====================================== -->
    <!-- INFORMACIÓN GENERAL DEL INVESTIGADOR -->
    <!-- ====================================== -->

    <div class="row g-4 align-items-start">

        <!-- COLUMNA IZQUIERDA: FOTO Y NOMBRE -->
        <div class="col-12 col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <?php
                    $foto = trim($investigador['foto'] ?? '');

                    // Imagen predeterminada
                    $imagen = BASE_URL . 'assets/img/avatar.png';

                    if ($foto !== '') {

                        $nombreArchivo = basename($foto);

                        // Ruta física
                        $rutaFisica = __DIR__ . '/img/' . $nombreArchivo;

                        if (is_file($rutaFisica)) {

                            // Ruta para el navegador
                            $imagen = BASE_URL . 'investigadores/img/'
                                    . rawurlencode($nombreArchivo);
                        }
                    }
                    ?>

                    <img
                        src="<?= htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8') ?>"
                        class="img-fluid rounded-circle mb-3"
                        style="width:180px; height:180px; object-fit:cover;"
                        alt="<?= htmlspecialchars($investigador['nombre'] ?? 'Investigador', ENT_QUOTES, 'UTF-8') ?>"
                    >

                    <h3 class="h4 mb-0">
                        <?= htmlspecialchars(
                            trim(($investigador['grado_academico'] ?? '') . ' ' .
                            ($investigador['nombre'] ?? '')),
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </h3>

                </div>

            </div>

        </div>


        <!-- COLUMNA DERECHA: INFORMACIÓN -->
        <div class="col-12 col-md-8">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h4 class="titulo-seccion">
                        Información General
                    </h4>

                    <hr>

                    <!-- Nombre -->
                    <p>
                        <strong>Nombre:</strong><br>

                        <?= htmlspecialchars(
                            $investigador['nombre'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </p>


                    <!-- Departamentos -->
                    <p>
                        <strong>Departamento(s):</strong><br>

                        <?php if (!empty($departamentos)): ?>

                            <?php foreach ($departamentos as $dep): ?>

                                <?= htmlspecialchars(
                                    $dep['nombre'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?><br>

                            <?php endforeach; ?>

                        <?php else: ?>

                            No registrado

                        <?php endif; ?>
                    </p>


                    <!-- Grupos -->
                    <p>
                        <strong>Grupo:</strong><br>

                        <?php if (!empty($grupo)): ?>

                            <?php foreach ($grupo as $gru): ?>

                                <?= htmlspecialchars(
                                    $gru['nombre'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?><br>

                            <?php endforeach; ?>

                        <?php else: ?>

                            No registrado

                        <?php endif; ?>
                    </p>


                    <!-- Correo -->
                    <?php if (!empty($investigador['correo'])): ?>

                        <p>
                            <strong>Correo:</strong><br>

                            <?= htmlspecialchars(
                                $investigador['correo'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </p>

                    <?php endif; ?>


                    <!-- ORCID -->
                    <?php if (!empty($investigador['orcid'])): ?>

                        <p>
                            <strong>ORCID:</strong><br>

                            <?= htmlspecialchars(
                                $investigador['orcid'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </p>

                    <?php endif; ?>


                    <!-- Semblanza -->
                    <?php if (!empty($investigador['semblanza'])): ?>

                        <h5 class="mt-4">
                            Semblanza
                        </h5>

                        <p class="mb-0">
                            <?= nl2br(
                                htmlspecialchars(
                                    $investigador['semblanza'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                )
                            ) ?>
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>


    <!-- ====================================== -->
    <!-- FUENTES ACADÉMICAS -->
    <!-- ====================================== -->

    <section
        class="mt-4 p-3 p-md-4"
        id="recursos"
        style="background:#F2FAFF;"
    >

        <div class="row g-3">

            <!-- ENCABEZADO -->
            <div class="col-12">

                <h3 class="text-center mb-3">
                    Fuentes Académicas
                </h3>

            </div>


            <?php
            /*
             * Ajusta los nombres de las columnas si en tu
             * tabla personal tienen otros nombres.
             */

            $fuentes = [
                'scholar' => 'Scholar',
                'scopus' => 'Scopus',
                'researchgate' => 'ResearchGate',
                'orcid' => 'ORCID'
            ];
            ?>


            <!-- TARJETAS DE FUENTES -->
            <?php foreach ($fuentes as $campo => $nombreFuente): ?>

                <?php
                $urlFuente = trim($investigador[$campo] ?? '');
                ?>

                <div class="col-12 col-sm-6 col-lg-3">

                    <div class="card shadow-sm h-100">

                        <div class="card-body d-flex
                                    justify-content-center
                                    align-items-center
                                    text-center
                                    card-fondo-medium">

                            <?php if ($urlFuente !== ''): ?>

                                <a
                                    href="<?= htmlspecialchars(
                                        $urlFuente,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn boton-fondo-verde"
                                >
                                    <?= htmlspecialchars(
                                        $nombreFuente,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </a>

                            <?php else: ?>

                                <span class="" style="color:#fff">
                                    <?= htmlspecialchars(
                                        $nombreFuente,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                    <br>
                                    No registrado
                                </span>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </section>


    <!-- ====================================== -->
    <!-- PESTAÑAS: PUBLICACIONES Y TESIS -->
    <!-- ====================================== -->

    <section class="mt-4">

        <!-- MENÚ HORIZONTAL -->
        <ul
            class="nav nav-tabs"
            id="investigadorTab"
            role="tablist"
        >

            <li class="nav-item" role="presentation">

                <button
                    class="nav-link active boton-fondo-verde"
                    id="publicaciones-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#publicaciones"
                    type="button"
                    role="tab"
                    aria-controls="publicaciones"
                    aria-selected="true"
                >
                    Publicaciones
                </button>

            </li>


            <li class="nav-item" role="presentation">

                <button
                    class="nav-link  boton-fondo-verde"
                    id="tesis-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#tesis"
                    type="button"
                    role="tab"
                    aria-controls="tesis"
                    aria-selected="false"
                >
                    Tesis
                </button>

            </li>

        </ul>


        <!-- CONTENIDO DE LAS PESTAÑAS -->
        <div class="tab-content" id="investigadorTabContent">


            <!-- PUBLICACIONES -->
            <div
                class="tab-pane fade show active"
                id="publicaciones"
                role="tabpanel"
                aria-labelledby="publicaciones-tab"
                tabindex="0"
            >

                <div class="card shadow-sm mt-4">

                    <div class="card-body card-text p-2 p-md-3">

                        <iframe
                            id="iframe-publicaciones"
                            title="Publicaciones del investigador"
                            style="background:#FFFFFF;"
                            src="https://produccion.siia.unam.mx/Publicaciones/ProdCientif/BuscadorPublicaciones.aspx?idtercero=<?= rawurlencode((string)($investigador['siia'] ?? '')) ?>"
                            width="100%"
                            height="800"
                            frameborder="0"
                            scrolling="auto"
                        ></iframe>

                    </div>

                </div>

            </div>


            <!-- TESIS -->
            <div
                class="tab-pane fade"
                id="tesis"
                role="tabpanel"
                aria-labelledby="tesis-tab"
                tabindex="0"
            >

                <div class="card shadow-sm mt-4">

                    <div class="card-body card-text p-2 p-md-3">

                        <iframe
                            id="iframe-tesis"
                            title="Tesis del investigador"
                            style="background:#FFFFFF;"
                            src="https://produccion.siia.unam.mx/Publicaciones/ProdCientif/BuscadorTesis.aspx?idtercero=<?= rawurlencode((string)($investigador['siia'] ?? '')) ?>"
                            width="100%"
                            height="800"
                            frameborder="0"
                            scrolling="auto"
                        ></iframe>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>

