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

    <div class="row">

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body text-center">
				<?php
    $foto = trim($investigador['foto'] ?? '');

    // Imagen predeterminada
    $imagen = BASE_URL . 'assets/img/avatar.png';

    // Comprobar que exista un nombre de archivo
    if ($foto !== '') {

        // Ruta física en el servidor
        $rutaFisica = __DIR__ . '/img/' . basename($foto);

        if (is_file($rutaFisica)) {
            // Ruta que utilizará el navegador
            $imagen = BASE_URL . 'investigadores/img/' . rawurlencode(basename($foto));
        }
    }
?>
				<img
					src="<?= htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8') ?>"
					 class="img-fluid rounded-circle mb-3"
                        style="width:180px;height:180px;object-fit:cover;"
					alt="<?=$investigador['foto'];?>"
				>
                   <!-- <img
                        src="../assets/img/avatar.png"
                        class="img-fluid rounded-circle mb-3"
                        style="width:180px;height:180px;object-fit:cover;"
                        alt="Investigador">-->

                    <h3>
                        <?= htmlspecialchars($investigador['grado_academico'].' '.$investigador['nombre']); ?>
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h4 class="titulo-seccion">
                        Información General
                    </h4>

                    <hr>

                    <p>
                        <strong>Nombre:</strong><br>
                        <?= htmlspecialchars($investigador['nombre']); ?>
                    </p>

                    <p>
                        <strong>Departamento(s):</strong><br>

                        <?php

                        if(count($departamentos)>0){

                            foreach($departamentos as $dep){

                                echo htmlspecialchars($dep['nombre'])."<br>";

                            }

                        }else{

                            echo "No registrado";

                        }

                        ?>

                    </p>
					<p>
                        <strong>Grupo:</strong><br>

                        <?php

                        if(count($grupo)>0){

                            foreach($grupo as $gru){

                                echo htmlspecialchars($gru['nombre'])."<br>";

                            }

                        }else{

                            echo "No registrado";

                        }

                        ?>

                    </p>

                    <?php if(!empty($investigador['correo'])){ ?>

                    <p>
                        <strong>Correo:</strong><br>
                        <?= htmlspecialchars($investigador['correo']); ?>
                    </p>

                    <?php } ?>

                    <?php if(!empty($investigador['orcid'])){ ?>

                    <p>
                        <strong>ORCID:</strong><br>
                        <?= htmlspecialchars($investigador['orcid']); ?>
                    </p>

                    <?php } ?>

                    <?php if(!empty($investigador['semblanza'])){ ?>

                    <h5 class="mt-4">
                        Semblanza
                    </h5>

                    <p>
                        <?= nl2br(htmlspecialchars($investigador['semblanza'])); ?>
                    </p>

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>
				<div class="d-flex flex-column">

				<!-- ========================= -->
				<!-- MENÚ HORIZONTAL -->
				<!-- ========================= -->

				<div
					class="nav nav-tabs"
					id="nav-tab"
					role="tablist"
				>

					<button
						class="nav-link active boton-fondo-verde"
						id="nav-Publicaciones-tab"
						data-bs-toggle="tab"
						data-bs-target="#nav-Publicaciones"
						type="button"
						role="tab"
						aria-controls="nav-Publicaciones"
						aria-selected="true"
					>
						Publicaciones
					</button>


					<button
						class="nav-link boton-fondo-verde"
						id="nav-Tesis-tab"
						data-bs-toggle="tab"
						data-bs-target="#nav-Tesis"
						type="button"
						role="tab"
						aria-controls="nav-Tesis"
						aria-selected="false"
					>
					   Tesis
					</button>

				</div>


				<!-- ========================= -->
				<!-- CONTENIDO DE LAS TABS -->
				<!-- ========================= -->

				<div
					class="tab-content"
					id="nav-tabContent"
				>
					<!-- ================================= -->
					<!-- Publicaciones -->
					<!-- ================================= -->

					<div
						class="tab-pane fade show active"
						id="nav-Publicaciones"
						role="tabpanel"
						aria-labelledby="nav-Publicaciones-tab"
						tabindex="0"
					>

						<div class="d-grid gap-4 mt-4">

							<div class="card shadow-sm">

								<div class="card-body card-text">
									<div style="white-space: pre-line;">
										<iframe 
											id="ifr" 
											style="background: #FFFFFF;" 
											src="https://produccion.siia.unam.mx/Publicaciones/ProdCientif/BuscadorPublicaciones.aspx?idtercero=<?=nl2br(htmlspecialchars($investigador['siia']));?>" 
											width="100%" height="800px" frameborder="0" scrolling="auto"></iframe>
									</div>
								</div>

							</div>

						</div>

					</div>



					<!-- ================================= -->
					<!-- Tesis -->
					<!-- ================================= -->

					<div
						class="tab-pane fade  "
						id="nav-Tesis"
						role="tabpanel"
						aria-labelledby="nav-Tesis-tab"
						tabindex="0"
					>

						<div class="d-grid gap-4 mt-4">

							<!-- CARD 1 -->
							<div class="card shadow-sm">
								<div class="card-body card-text">
									<div style="white-space: pre-line;">
										<iframe 
											id="ifr" 
											style="background: #FFFFFF;" 
											src="https://produccion.siia.unam.mx/Publicaciones/ProdCientif/BuscadorTesis.aspx?idtercero=<?=nl2br(htmlspecialchars($investigador['siia']));?>" 
											width="100%" height="800px" frameborder="0" scrolling="auto"></iframe>
									</div>
								</div>
							</div>

						</div>

					</div>


					
				</div>

			</div>


</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>