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

$sql1 = "
SELECT
    *
FROM comites c

INNER JOIN integrantes_comites ic
    ON c.id_comites = ic.id_integrantes_comites

INNER JOIN personal p
    ON p.id_personal = ic.responsable

WHERE c.id_comites = 9
";

try {

    $stmt1 = $pdo->query($sql1);

    if ($stmt1 !== false) {
        $comite = true;
    } else {
        $comite = false;
    }

} catch (PDOException $e) {

    // La consulta falló: por ejemplo, porque las tablas aún no existen.
    $comite = false;

    // Opcional: registrar el error en el log del servidor.
    error_log("Error al consultar el comité: " . $e->getMessage());

}

// El código continúa normalmente a partir de aquí.

$sql2 = "
SELECT
    s.*,
    i.nombre AS responsable_nombre, 
	i.correo,
	i.telefono,
	i.semblanza,
	i.extension,
	i.grado_academico,
	i.foto
FROM secretarias s

LEFT JOIN personal i
    ON i.id_personal = s.responsable

WHERE s.id_secretarias = 2
";
//echo $sql2;
try {

    $stmt2 = $pdo->query($sql2);

    if ($stmt2 !== false) {
		//$stmt2 = $pdo2->prepare($sql2);
		//$stmt2->execute();

		$sec = $stmt2->fetch(PDO::FETCH_ASSOC);
    } else {
        $sec = false;
    }

} catch (PDOException $e) {

    // La consulta falló: por ejemplo, porque las tablas aún no existen.
    $sec = false;

    // Opcional: registrar el error en el log del servidor.
    error_log("Error al consultar el comité: " . $e->getMessage());

}

?>

<div class="container py-5">

    <h1 class="mb-4">
        <?=htmlspecialchars($unidad['nombre']);?>
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
				<iframe src="sr/oferta.php" width="100%" height="400px"></iframe>

		</div>
		
		
		
		
		
		<div class="row g-4" style="background:#F2FAFF;" id="recursos">
			<h3 class="text-center" >Recursos para Docentes</h3>
			<!-- PRESENTACION 2 -->
			<div class="col-12 col-md-3">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title"><i class="bi bi-person-wheelchair"></i></h2><br>
						<p>Recomendaciones a docentes para la atenci&oacute;n a distancia a estudiantes con discapacidad</p>
						<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2020/08/Recomendaciones-para-docentes-DDU.DGACO_.UNAPDI.pdf"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							DESCARGAR
						</a>
                    </div>
				</div>
			</div>
			


			<!-- PRESENTACION 3 -->
		   <div class="col-12 col-md-3">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<h2 class="card-title"><i class="bi bi-display"></i></h2><br>
						<p>Recomendaciones para la transici&oacute;n a la docencia no presencial</p>
						<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2020/08/UNAM-%E2%80%A2-Recomendaciones-para-la-transicio%CC%81n-a-la-docencia-no-presencial.pdf"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							DESCARGAR
						</a>
					</div>
				</div>
			</div>
				 <!-- PRESENTACION 1 -->
			<div class="col-12 col-md-3">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title">	<i class="bi bi-gender-ambiguous"></i></h2><br>
						<p>Recomendaciones de la Comisi&oacute;n de Derechos Humanos y G&eacute;nero para las Unidades de Educaci&oacute;n Continua</p>
						<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2020/08/REDEC-%E2%80%A2-Comisi%C3%B3n-de-Derechos-Humanos-y-G%C3%A9nero-%E2%80%A2-Recomendaciones-para-las-Unidades-de-Educaci%C3%B3n-Continua-.pdf"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							DESCARGAR
						</a>
					</div>
				</div>
			</div>
			<!-- PRESENTACION 1 -->
			<div class="col-12 col-md-3">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title">	<i class="bi bi-book"></i></h2><br>
						<p>Código de ética para una cultura de la igualdad de INFORMES Y ATENCIÓN</p>
						<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2020/08/CODIGO-DE-ETICA-PARA-LA-IGUALDAD-DE-GENERO_CCA_EC.pdf"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							DESCARGAR
						</a>
					</div>
				</div>
			</div>
			<p></p>
		</div>
		
		<h3 class="text-center" >INFORMES Y ATENCI&Oacute;N</h3>
		<div class="row g-3" style="background:#F2FAFF;">
			<div class="col-12 col-md-4">
				<div class="card shadow-sm h-100">
					<div class="card-body  flex-column justify-content-center align-items-center  card-fondo-medium">
						<h3 class="card-title text-center">	<i class="bi bi-journal-bookmark-fill"></i></h3><br>
						<p class="text-center"><?=htmlspecialchars($unidad['nombre']);?></p>
						<p>Comit&eacute;</p>
						<?php
							if (isset($stmt1) && $stmt1 !== false) {
								while ($comite = $stmt1->fetch(PDO::FETCH_ASSOC)) {
							?>
									<p><?= htmlspecialchars($comite['integrante'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
							<?php
								}
							}
							?>
					</div>
				</div>
			</div>
		
		

			<div class="col-12 col-md-4">
				<div class="card shadow-sm h-100">
					<div class="card-body flex-column justify-content-center align-items-center  card-fondo-medium">
						<h3 class="card-title text-center">	<i class="bi bi-pencil-square"></i></h3><br>
						<p class="text-center">Inscripciones</p>
						<p>Dr. Agust&iacute;n Garc&iacute;a Reynoso</p>
						<p><?=htmlspecialchars($unidad['grado_academico']." ".$unidad['responsable_nombre']);?></p>
						<p><?=htmlspecialchars($unidad['nombre']);?></p>
						<p>Tel&eacute;fono: 5622-4070</p>
						<p>educación.continua@atmosfera.unam.mx</p>
					</div>
				</div>
			</div>
	
		
		
			<div class="col-12 col-md-4">
				<div class="card shadow-sm h-100">
					<div class="card-body  flex-column justify-content-center align-items-center  card-fondo-medium">
						<h3 class="card-title text-center">	<i class="bi bi-house-door-fill"></i></h3><br>
						<p class="text-center">Secretar&iacute;a Administrativa</p>
						<p><?=htmlspecialchars($sec['grado_academico']." ".$sec['responsable_nombre']);?></p>
						<p><?=htmlspecialchars($sec['correo']);?></p>
						<p>Tel. <?=htmlspecialchars($sec['nombre']);?> Ext. <?=htmlspecialchars($sec['extension']);?> </p>
					</div>
				</div>
			</div>
		</div>
			
      
	
    </div>

</div>


<?php 
//finalizarSlidersRevolution();
require_once ROOT_PATH . '/includes/footer.php'; ?>