<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/slider-revolution.php';
$sql = "
SELECT
    d.*,
    i.nombre AS responsable_nombre, 
	i.correo,
	i.telefono,
	i.semblanza,
	i.extension,
	i.grado_academico,
	i.foto
FROM unidades d

LEFT JOIN personal i
    ON i.id_personal = d.responsable

WHERE d.id_unidades = 1
";
//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$unidad = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container py-5">

    <h1 class="mb-4">
       Unidad de <?= htmlspecialchars($unidad['nombre']); ?>
    </h1>

    <div class="row g-4">
        <!-- MENÚS Y CONTENIDO -->
		<div class="col-12">
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
						id="nav-hacemos-tab"
						data-bs-toggle="tab"
						data-bs-target="#nav-hacemos"
						type="button"
						role="tab"
						aria-controls="nav-hacemos"
						aria-selected="true"
					>
						¿Qu&eacute; hacemos?
					</button>


					<button
						class="nav-link boton-fondo-verde"
						id="nav-quienes-tab"
						data-bs-toggle="tab"
						data-bs-target="#nav-quienes"
						type="button"
						role="tab"
						aria-controls="nav-quienes"
						aria-selected="false"
					>
					   ¿Qui&eacute;nes lo hacemos?
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
					<!-- Que hacemos -->
					<!-- ================================= -->

					<div
						class="tab-pane fade show active"
						id="nav-hacemos"
						role="tabpanel"
						aria-labelledby="nav-hacemos-tab"
						tabindex="0"
					>

						<div class="d-grid gap-4 mt-4">

							<div class="card shadow-sm">

								<div class="card-body card-text">
									<div style="white-space: pre-line;">
										<?= htmlspecialchars($unidad['descripcion']); ?>
									   <p> <?= htmlspecialchars($unidad['nombre']); ?></p>
									   <p> <?= htmlspecialchars($unidad['grado_academico'].' '.$unidad['responsable_nombre']); ?></p>
									   <p> Teléfono: <?= htmlspecialchars($unidad['telefono']); ?></p>
									   <p> Correo: <?= htmlspecialchars($unidad['correo']); ?></p>
									</div>
								</div>

							</div>

						</div>

					</div>



					<!-- ================================= -->
					<!-- Que hacemos -->
					<!-- ================================= -->

					<div
						class="tab-pane fade  "
						id="nav-quienes"
						role="tabpanel"
						aria-labelledby="nav-quienes-tab"
						tabindex="0"
					>

						<div class="d-grid gap-4 mt-4">

							<!-- CARD 1 -->
							<div class="card shadow-sm">

								<div class="row g-0">

									<!-- IMAGEN -->
									<div class="col-md-4">
										<?php
											$imagen = __DIR__ . '/img/vinculacion.jpg';

											if (file_exists($imagen)) {
												$imagen = 'img/secretaria_adm.jpg';
											} else {
												$imagen = BASE_URL . 'assets/img/avatar.png';
											}
											?>
                                        <img
                                            src="<?= $imagen; ?>"
                                            class="img-fluid rounded-start
                                                   w-100 h-100 object-fit-cover"
                                            alt="Vinculaci&oacute;n"
                                        >
										

									</div>


									<!-- INFORMACIÓN -->
									<div class="col-md-8">

										<div class="card-body">

											<h3 class="card-title text-center">
												<?= htmlspecialchars($unidad['grado_academico']." ".$unidad["responsable_nombre"]); ?>
											</h3>
											<h4 class="text-center">Responsable de la Unidad <?=$unidad['nombre'];?></h4>

											<hr>
											<p class="card-text">
												<?=$unidad["semblanza"];?>
											</p>
											<p class="card-text">

												<strong>Contacto:</strong><br>

												Tel. <?= htmlspecialchars($unidad['telefono']); ?><br>
												Ext.   <p> <?= htmlspecialchars($unidad['extension']); ?></p>

											</p>


											<p class="card-text">

												<strong>Correo:</strong><br>

												<a
													href="mailto:<?= htmlspecialchars($unidad['correo']); ?>"
												>
												   <?= htmlspecialchars($unidad['correo']); ?>
												</a>

											</p>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>


					
				</div>

			</div>

			<!-- ========================= -->
			<!-- SLIDER LABORATORIOS -->
			<!-- FUERA DEL COMPONENTE TABS -->
			<!-- ========================= -->

			<div class="mt-5" id="servicios">

				<?php
				mostrarSliderRevolution(
					'https://www.atmosfera.unam.mx/secretaria-academica/vinculacion/',
					'Laboratorios'
				);
				?>

			</div>

		</div>
		

		<!-- PRESENTACION 2 -->
        <div class="col-12 col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
					<h2 class="card-title"><i class="bi bi-envelope-at-fill"></i></h2><br>
                    <p>Email</p>
                    <a href="mailto:<?= htmlspecialchars($unidad['correo']); ?>" style="text-decoration:none;color:#fff">
						<?= htmlspecialchars($unidad['correo']); ?>
					</a>
				</div>
			</div>
		</div>


        <!-- PRESENTACION 3 -->
       <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
					<h2 class="card-title"><i class="bi bi-telephone"></i></h2>
                    Tel. <?= htmlspecialchars($unidad['telefono']); ?><br>
					Ext.   <p> <?= htmlspecialchars($unidad['extension']); ?></p>
					Laboratorio: 5556224076
                </div>
            </div>
        </div>
			 <!-- PRESENTACION 1 -->
        <div class="col-12 col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">

					<h2 class="card-title">
						<i class="bi bi-geo-alt"></i>
					</h2>

					<p>Circuito Exterior s/n, Coyoacan, Ciudad Universitaria, 04510 Ciudad de México, CDMX.</p>

				</div>
			</div>
		</div>

		<!-------------------------------------------------
		--
		-- 						ENLACES                  --
		-------------------------------------------------->
		<!-- PRESENTACION 2 -->
        <div class="col-12 col-md-6">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="<?= BASE_URL ?>ensenanza/convenios.php"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							CONVENIOS DE COLABORACI&Oacute;N
											</a>
                   
				</div>
			</div>
		</div>


        <!-- PRESENTACION 3 -->
       <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
					<a
							href="https://tlaloc.atmosfera.unam.mx/cca-ucar/derechosautor/derechoAutor/"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							REGISTRO DE DERECHOS DE AUTOR
											</a>
                </div>
            </div>
        </div>
			
      
	
    </div>

</div>


<?php require_once ROOT_PATH . '/includes/footer.php'; ?>