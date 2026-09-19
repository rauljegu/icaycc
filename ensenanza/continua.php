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

WHERE d.id_unidades = 8
";
//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$unidad = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container py-5">

    <h1 class="mb-4">
        <?=$unidad['nombre'];?>
    </h1>

    <div class="row g-4">
		<div class="mt-5" id="servicios">

				<?php
				mostrarSliderRevolution(
					'https://www.atmosfera.unam.mx/educacion-continua/',
					'Edicación continua'
				);
				?>

		</div>
		<div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body" >
                    <h2 class="card-title">ICAyCC - UNAM</h2>
					
					<p>El <b>Instituto de Ciencias de la Atmósfera y Cambio Climático</b> de la Universidad Nacional Autónoma de México es una institución líder en investigación 
					de frontera en ciencias atmosféricas y ambientales, multidisciplinaria e integral, partícipe en las soluciones de problemas nacionales en su área y
					generadora de científicos de alto nivel.</p>
					<p>Dentro de la educación continua, el académico puede ofertar cursos de corta duración, congresos, paneles de expertos, foros, 
					simposios, mesas redondas, seminarios, conferencias, sesiones académicas, coloquios, talleres, diplomados, videoconferencias y jornadas. 
					Registrar estas actividades como parte de la educación continua tiene diversos beneficios. 
					Por ejemplo, se extienden constancias con valor curricular por parte de la UNAM, se pueden generar recursos extraordinarios y son actividades 
					que son tomadas en cuenta por las evaluaciones del PRIDE. Además, estas actividades son susceptibles de hacer una equivalencia de créditos en los 
					planes de estudio de licenciaturas, maestrías y doctorados de la UNAM.</p>
					<a
							href="https://www.atmosfera.unam.mx/wp-content/uploads/2026/08/Calendario-de-Sesiones-de-Educacio%CC%81n-Continua-2026-2027.pdf"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER CALENDARIO
											</a>
                </div>
            </div>
        </div> 
		<div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body" id="mision">
                    <h2 class="card-title"><?=$unidad['nombre'];?></h2>
					
					<p><?=$unidad['descripcion'];?> a:</p>
					
                    <a href="mailto:educacion_continua@atmosfera.unam.mx" style="text-decoration:none;">
						educacion_continua@atmosfera.unam.mx
					</a>
                    <a href="mailto:<?= htmlspecialchars($unidad['correo']); ?>" style="text-decoration:none;">
						<?= htmlspecialchars($unidad['correo']); ?>
					</a><br>
					<a
							href="https://www.atmosfera.unam.mx/wp-content/uploads/2023/09/Formato-de-educacio%CC%81n-continua-2023.docx"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							DESCARGAR FORMATO
											</a>
                </div>
            </div>
        </div> 
		
		 <!-- MENÚS Y CONTENIDO -->
        <div class="col-12">
			<h3 class="text-center">Actas del Comité de Educación Continua</h3>
            <div class="d-flex flex-column flex-lg-row align-items-stretch">

                <!-- ========================= -->
                <!-- MENÚ VERTICAL / HORIZONTAL -->
                <!-- ========================= -->

                <div
                    class="nav nav-tabs flex-row flex-lg-column
                           me-lg-3 mb-3 mb-lg-0"
                    id="nav-tab"
                    role="tablist"
                    aria-orientation="vertical"
                >

                    <button
                        class="nav-link active boton-fondo-verde"
                        id="nav-Actas24-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Actas24"
                        type="button"
                        role="tab"
                        aria-controls="nav-Actas24"
                        aria-selected="true"
                    >
                        Actas 2024
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Actas25-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Actas25"
                        type="button"
                        role="tab"
                        aria-controls="nav-Actas25"
                        aria-selected="false"
                    >
                        Actas 2025
                    </button>
            
                </div>


                <!-- ========================= -->
                <!-- CONTENIDO DE LAS TABS -->
                <!-- ========================= -->

                <div
                    class="tab-content flex-grow-1"
                    id="nav-tabContent"
                >


                    <!-- ================================= -->
                    <!-- Actas 24-->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade show active"
                        id="nav-Actas24"
                        role="tabpanel"
                        aria-labelledby="nav-Actas24-tab"
                        tabindex="0"
                    >

					<div class="d-grid gap-4">
                            <!-- CARD 1 -->
                            <div class="card shadow-sm">
                                <div class="row g-0">
									<a href="https://www.atmosfera.unam.mx/educacion-continua/#1749661993010-e98ae8f1-650e"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											ACTAS 2024
									</a>
                                </div>
                            </div>                                    
                        </div>

                    </div>

					<!-- ================================= -->
                    <!-- Actas 25 -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Actas25"
                        role="tabpanel"
                        aria-labelledby="nav-Actas25-tab"
                        tabindex="0"
                    >

                        <div class="d-grid gap-4">
                            <!-- CARD 1 -->
                            <div class="card shadow-sm">
                                <div class="row g-0">
									<a href="https://www.atmosfera.unam.mx/educacion-continua/#1749661993010-1d7fa9cd-62b2x"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											ACTAS 2025
									</a>
                                </div>
                            </div>                                    
                        </div>
                    </div>

                                                
  
                </div>

            </div>

        </div>

		<div class="mt-5" id="oferta">
			<h3 class="text-center" >Oferta Educativa</h3>
				<?php/*
				mostrarSliderRevolution(
					'https://www.atmosfera.unam.mx/educacion-continua/',
					'Destacados'
				);*/
				?>

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


<?php 
//finalizarSlidersRevolution();
require_once ROOT_PATH . '/includes/footer.php'; ?>