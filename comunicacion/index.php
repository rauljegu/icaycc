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

WHERE d.id_unidades = 3
";
//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$unidad = $stmt->fetch(PDO::FETCH_ASSOC);

// Personal
$sql1 = "
  SELECT 
	u.*,
	p.nombre, 
	p.correo,
	p.telefono,
	p.semblanza,
	p.extension,
	p.grado_academico,
	p.foto
    FROM personal p
   LEFT JOIN personal_unidades u
    ON u.id_personal = p.id_personal   

WHERE u.id_unidades = 3 ORDER BY u.rol;
";

$stmt1 = $pdo->prepare($sql1);
$stmt1->execute();
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
					<!-- Quienes -->
					<!-- ================================= -->

					<div
						class="tab-pane fade  "
						id="nav-quienes"
						role="tabpanel"
						aria-labelledby="nav-quienes-tab"
						tabindex="0"
					>

						<div class="d-grid gap-4 mt-4">
							<?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) { ?>
							<!-- CARD 1 -->
							<div class="card shadow-sm">

								<div class="row g-0">

									<!-- IMAGEN -->
									<div class="col-md-4">
										<?php
											//$imagen = __DIR__ . '/img/vinculacion.jpg';
											$imagen = BASE_URL . 'investigadores/img/'.$row['foto'];

											if (file_exists($imagen)) {
												$imagen = 'investigadores/img/'.$row['foto'];
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
												<?= htmlspecialchars($row['grado_academico']." ".$row["nombre"]); ?>
											</h3>
											<h4 class="text-center"><?= ucfirst(htmlspecialchars($row['rol'])); ?> de la Unidad <?=htmlspecialchars($unidad['nombre']);?></h4>

											<hr>
											<p class="card-text">
												<?=$row["semblanza"];?>
											</p>
											<p class="card-text">

												<strong>Contacto:</strong><br>

												Tel. <?= htmlspecialchars($row['telefono']); ?><br>
												Ext.   <p> <?= htmlspecialchars($row['extension']); ?></p>

											</p>


											<p class="card-text">

												<strong>Correo:</strong><br>

												<a
													href="mailto:<?= htmlspecialchars($row['correo']); ?>"
												>
												   <?= htmlspecialchars($row['correo']); ?>
												</a>

											</p>

										</div>

									</div>

								</div>

							</div>
							<?php } ?>
						</div>

					</div>


					
				</div>

			</div>


			

		</div>
		

		<!-- PRESENTACION 2 -->
        <div class="col-12 col-md-4" id="contacto">
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
<!-- ============================================
     REVISTAS
=============================================== -->

<div class="col-12 mt-5" id="revistas">
	<div class="descargables-header text-center">
            <h2>REVISTAS</h2>
       </div>
    <div class="row g-4">

        <!-- REVISTA ATMÓSFERA -->
        <div class="col-12 col-lg-6">

            <div class="revista-card">

                <!-- PORTADA -->
                <div class="revista-imagen">
                    <img
                        src="<?= BASE_URL ?>wp-content/uploads/2022/04/35-4-atm.png"
                        alt="Revista Atmósfera"
                        class="img-fluid"
                    >
                </div>

                <!-- DESCRIPCIÓN -->
                <div class="revista-contenido">

                    <p>
                        <strong>Atmósfera</strong> acepta trabajos sobre
                        investigación teórica, básica, empírica y aplicada
                        en todas las áreas de las ciencias atmosféricas,
                        incluyendo meteorología, climatología, aeronómica,
                        física, química y aerobiología. Asimismo, trabajos
                        interdisciplinarios relacionados con oceanografía,
                        hidrología, ecología, silvicultura, glaciología,
                        agricultura, contaminación ambiental y relativos
                        a la economía y la sociedad como entes afectados
                        por fenómenos atmosféricos. La revista es de acceso
                        abierto y no tiene cargos por publicar.
                    </p>

                    <!-- URL EXTERNA -->
                    <a
                        href="https://www.revistascca.unam.mx/atm/index.php/atm"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="revista-enlace"
                        aria-label="Consultar revista Atmósfera"
                    >
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>


        <!-- REVISTA INTERNACIONAL DE CONTAMINACIÓN AMBIENTAL -->
        <div class="col-12 col-lg-6">

            <div class="revista-card">

                <!-- PORTADA -->
                <div class="revista-imagen">
                    <img
                        src="<?= BASE_URL ?>wp-content/uploads/2019/05/RICA.jpg"
                        alt="Revista Internacional de Contaminación Ambiental"
                        class="img-fluid"
                    >
                </div>

                <!-- DESCRIPCIÓN -->
                <div class="revista-contenido">

                    <p>
                        La Revista Internacional de Contaminación Ambiental
                        publica trabajos originales y de revisión sobre
                        aspectos físicos y químicos de la contaminación,
                        investigaciones sobre la distribución y los efectos
                        biológicos y ecológicos de los contaminantes; así
                        como sobre tecnología e implementación de nuevas
                        técnicas para su medida y control; acepta también
                        estudios sociológicos, económicos y legales sobre
                        el tema. La revista es de acceso abierto y no tiene
                        cargos por publicar.
                    </p>

                    <!-- URL EXTERNA -->
                    <a
                        href="https://www.revistascca.unam.mx/rica/index.php/rica"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="revista-enlace"
                        aria-label="Consultar Revista Internacional de Contaminación Ambiental"
                    >
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- FIN REVISTAS -->
		<!-------------------------------------------------
		--
		-- 						ENLACES  A SECCIONES                --
		-------------------------------------------------->
		<!-- PRESENTACION 2 -->
        <div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="<?= BASE_URL ?>comunicacion/medios.php"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							ICAYCC EN LOS MEDIOS
											</a>
                   
				</div>
			</div>
		</div>


        <!-- PRESENTACION 3 -->
       <div class="col-12 col-md-12">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
					<a
							href="<?= BASE_URL ?>comunicacion/divulgacion.php"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							DIVULGACI&Oacute;N DE LA CIENCIA
											</a>
                </div>
            </div>
        </div>
		<!-- ============================================
     DESCARGABLES - UNIDAD DE COMUNICACIÓN
=============================================== -->

<div class="col-12 mt-5" id="descargables">

    <div class="descargables-container">

        <!-- ENCABEZADO -->
        <div class="descargables-header text-center">
            <h2>Descargables</h2>
        </div>

        <!-- DOCUMENTOS INSTITUCIONALES -->
        <div class="row justify-content-center g-3 py-4">

            <div class="col-12 col-md-5 text-center">
                <!-- Sustituir href por la ruta del archivo -->
                <a href="<?= BASE_URL ?>wp-content/uploads/2023/06/PLANTILLA_GENERAL_PPT.pptx"
                   class="btn boton-fondo-verde btn-sm descargable-documento">
                    <i class="bi bi-file-earmark-pdf"></i>
                    Plantilla para presentaciones institucionales
                </a>
            </div>

            <div class="col-12 col-md-5 text-center">
                <!-- Sustituir href por la ruta del archivo -->
                <a href="<?= BASE_URL ?>wp-content/uploads/2022/08/manual_DE_USO_ICAyCC.pdf"
                   class="btn boton-fondo-verde btn-sm descargable-documento">
                    <i class="bi bi-file-earmark-pdf"></i>
                    Manual de uso
                </a>
            </div>

        </div>


        <!-- ====================================
             LOGOS HORIZONTALES
        ===================================== -->

        <section class="descargables-seccion">

            <h3 class="text-center">
                Logos con fondo transparente
            </h3>

            <div class="row g-4 align-items-center mt-3">

                <!-- LOGO COLOR -->
                <div class="col-12 col-md-4">

                    <div class="logo-descargable">

                        <div class="logo-preview">
                            <img
                                src="<?= BASE_URL ?>wp-content/uploads/2022/08/logoICAyCC-1a-1024x307-1.png"
								
                                alt="Logotipo horizontal a color"
                                class="img-fluid"
                            >
                        </div>

                        <div class="logo-botones">
                            <!-- Agregar ruta PNG -->
                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Color.png" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen PNG
                            </a>

                            <!-- Agregar ruta SVG -->
                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_COLOR.svg" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen SVG
                            </a>
                        </div>

                    </div>

                </div>


                <!-- LOGO NEGRO -->
                <div class="col-12 col-md-4">

                    <div class="logo-descargable">

                        <div class="logo-preview">
                            <img
                                src="<?= BASE_URL ?>wp-content/uploads/2022/08/logoICAyCC-3.png"
                                alt="Logotipo horizontal negro"
                                class="img-fluid"
                            >
                        </div>

                        <div class="logo-botones">
                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Negro.png" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen PNG
                            </a>

                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Negro.svg" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen SVG
                            </a>
                        </div>

                    </div>

                </div>


                <!-- LOGO BLANCO -->
                <div class="col-12 col-md-4">

                    <div class="logo-descargable">

                        <div class="logo-preview logo-preview-oscuro">
                            <img
                                src="<?= BASE_URL ?>wp-content/uploads/2022/08/logoICAyCC-4.png"
                                alt="Logotipo horizontal blanco"
                                class="img-fluid"
                            >
                        </div>

                        <div class="logo-botones">
                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_BLANCO.png" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen PNG
                            </a>

                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_BLANCO.svg" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen SVG
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- ====================================
             LOGOS VERTICALES
        ===================================== -->

        <section class="descargables-seccion mt-5">

            <h3 class="text-center">
                Logos en vertical con fondo transparente
            </h3>

            <div class="row g-4 align-items-center mt-3">

                <!-- LOGO COLOR -->
                <div class="col-12 col-md-4">

                    <div class="logo-descargable">

                        <div class="logo-preview logo-preview-vertical">
                            <img
                                src="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Color_Vertical.png"
                                alt="Logotipo vertical a color"
                                class="img-fluid"
                            >
                        </div>

                        <div class="logo-botones">
                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Color_Vertical.png" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen PNG
                            </a>

                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Color_Vertical.svg" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen SVG
                            </a>
                        </div>

                    </div>

                </div>


                <!-- LOGO NEGRO -->
                <div class="col-12 col-md-4">

                    <div class="logo-descargable">

                        <div class="logo-preview logo-preview-vertical">
                            <img
                                src="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Negro_Vertical.png"
                                alt="Logotipo vertical negro"
                                class="img-fluid"
                            >
                        </div>

                        <div class="logo-botones">
                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Negro_Vertical.png" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen PNG
                            </a>

                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Negro_Vertical.svg" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen SVG
                            </a>
                        </div>

                    </div>

                </div>


                <!-- LOGO BLANCO -->
                <div class="col-12 col-md-4">

                    <div class="logo-descargable">

                        <div class="logo-preview logo-preview-vertical logo-preview-oscuro">
                            <img
                                src="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYC_Blanco_Vertical.png"
                                alt="Logotipo vertical blanco"
                                class="img-fluid"
                            >
                        </div>

                        <div class="logo-botones">
                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYC_Blanco_Vertical.png" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen PNG
                            </a>

                            <a href="<?= BASE_URL ?>wp-content/uploads/2026/01/ICAYCC_Blnco_Vertical.svg" class="btn boton-fondo-verde btn-sm">
                                Descargar imagen SVG
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

</div>

<!-- FIN DESCARGABLES -->	
      
	
    </div>

</div>


<?php require_once ROOT_PATH . '/includes/footer.php'; ?>