<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/slider-revolution.php';
$sql = "
SELECT
   *
FROM posgrado 

";
//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$pos = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<div class="container py-5">

    <h1 class="mb-4">
        <?=htmlspecialchars($pos['nombre']);?>
    </h1>

    <div class="row g-4">
		
		<div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body" >
                    <h2 class="card-title"> Orientaci&oacute;n en Ciencias Atmosf&eacute;ricas</h2>
					 <?=htmlspecialchars($pos['descripcion']);?>
					
                </div>
            </div>
        </div> 
		<div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body card-fondo-verde
                            d-flex align-items-center justify-content-center">

                    <img
                        src="img/pos.jpg"
                        class="img-fluid"
                        alt="Posgrado"
                    >

                </div>
            </div>
        </div> 	
		<div class="row g-3" style="background:#F2FAFF;" id="aspirantes">
			<h3 class="text-center" >ASPIRANTES</h3>
			<!-- PRESENTACION 2 -->
			<div class="col-12 col-md-4" id="plan">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title"><i class="bi bi-card-checklist"></i></h2><br>
						<p><?=htmlspecialchars($pos['temarios']);?></p>
						<a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_temarios']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER M&Aacute;S
						</a>
                    </div>
				</div>
			</div>
			


			<!-- PRESENTACION 3 -->
		   <div class="col-12 col-md-4">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<h2 class="card-title">	<i class="bi bi-mortarboard"></i></h2><br>
						<p><?=htmlspecialchars($pos['tutores']);?></p>
						<a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_tutores']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER M&Aacute;S
						</a>
					</div>
				</div>
			</div>
				 <!-- PRESENTACION 1 -->
			<div class="col-12 col-md-4">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title">	<i class="bi bi-geo-alt"></i></h2><br>
						<p><?=htmlspecialchars($pos['tutores_ext']);?></p>
						<a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_tutores_e']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER M&Aacute;S
						</a>
					</div>
				</div>
			</div>

			<p></p>
		</div>				
		<div class="row g-2">
			
		
			<div class="col-12 col-md-12">
				<div class="card shadow-sm h-100">
					<div class="card-body flex-column justify-content-center align-items-center  card-fondo-medium">
						<h3>PROCESO DE ADMINSI&Oacute;N</h3>
							<a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_admision']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							M&Aacute;S INFORMACI&Oacute;N
						</a>
					</div>
				</div>
			</div>
	
		</div>
		<div class="row g-3" style="background:#F2FAFF;" id="estudiantes">
			<h3 class="text-center" >ESTUDIANTES</h3>
			<!-- PRESENTACION 2 -->
			<div class="col-12 col-md-4" id="plan">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title"><i class="bi bi-card-checklist"></i></h2><br>
						<p><?=htmlspecialchars($pos['asignaturas']);?></p>
						<a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_asignaturas']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER M&Aacute;S
						</a>
                    </div>
				</div>
			</div>
			


			<!-- PRESENTACION 3 -->
		   <div class="col-12 col-md-4">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<h2 class="card-title">	<i class="bi bi-mortarboard"></i></h2><br>
						<p><?=htmlspecialchars($pos['calendario']);?></p>
						<a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_calendario']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER M&Aacute;S
						</a>
					</div>
				</div>
			</div>
				 <!-- PRESENTACION 1 -->
			<div class="col-12 col-md-4">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title">	<i class="bi bi-geo-alt"></i></h2><br>
						<p><?=htmlspecialchars($pos['formatos']);?></p>
						<a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_formatos']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER M&Aacute;S
						</a>
					</div>
				</div>
			</div>

			<p></p>
		</div>				
		<div class="row g-5 mt-4">
				<!-- Info graduarse -->
				<div class="col-12 col-md-6">
					<div class="px-3">
						<hr class="w-50 mx-auto">
						<h3 class="text-center fs-6 mb-4"> Informaci&oacute;n para graduarse</h3>
						<ul>
							<li>
								<a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_pasos']);?>"
									target="_blank"
									rel="noopener noreferrer"
									
								>
									Pasos a seguir
								</a>
							</li>
							<li>
								<a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_ftt']);?>"
									target="_blank"
									rel="noopener noreferrer"
									
								>
									Formato para tr&aacute;mite de titulaci&oacute;n
								</a>
							</li>
							<li>
								<a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_fva']);?>"
									target="_blank"
									rel="noopener noreferrer"
									
								>
									Formato de voto aprobatorio
								</a>
							</li>
							<li>
								<a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_fvamh']);?>"
									target="_blank"
									rel="noopener noreferrer"
									
								>
									Formato de voto aprobatorio con menci&oacute;n honor&iacute;fica
								</a>
							</li>
							<li>
								<a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_fct']);?>"
									target="_blank"
									rel="noopener noreferrer"
									
								>
									Formato de car&aacute;tula de tesis
								</a>
							</li>
							
						</ul>

					</div>
				</div>

				<!-- credencial -->
				<div class="col-12 col-md-6">
					<div class="px-3">

						<hr class="w-50 mx-auto">

						<h3 class="text-center fs-6 mb-4">
							Credencial
						</h3>

						<ul>
							<li>
								<a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_credendcial']);?>"
									target="_blank"
									rel="noopener noreferrer"
									
								>
									Procedimiento para la obtención de credencial
								</a>
							</li>
							<!--<li>
								<a href="<?= BASE_URL ?>ensenanza/docs/<?=htmlspecialchars($pos['enlace_']);?>"
									target="_blank"
									rel="noopener noreferrer"
									class="btn btn-primary boton-fondo-verde"
								>
									Consultar
								</a>
							</li>-->
						</ul>

					</div>
				</div>
			</div>
		</div>
		<p></p>
		<div class="row g-2" style="background:#F2FAFF;" id="becas">	
        <div class="col-12" >
			
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
                        id="nav-Becas-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Becas"
                        type="button"
                        role="tab"
                        aria-controls="nav-Becas"
                        aria-selected="true"
                    >
                        <h3 class="text-center">BECAS</h3>
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
                    <!-- BECAS -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade show active"
                        id="nav-Becas"
                        role="tabpanel"
                        aria-labelledby="nav-Becas-tab"
                        tabindex="0"
                    >

						<div class="d-grid gap-4">
                            <!-- CARD 1 -->
                            <div class="card shadow-sm">
                                <div class="row g-0">
									<a href="http://www.pctierra.unam.mx/es/contenido/becas"
										target="_blank" rel="noopener noreferrer"  class="btn btn-primary boton-fondo-verde"
										>
											POSGRADO EN CIENCIAS DE LA TIERRA
									</a>
									<br/>
									<a href="https://internationalweek.unaminternacional.unam.mx/"
										target="_blank" rel="noopener noreferrer"  class="btn btn-primary boton-fondo-verde"
										>
											BECAS UNAM
									</a>
									<br/>
									<a href="https://vsrp.kaust.edu.sa/"
										target="_blank" rel="noopener noreferrer"  class="btn btn-primary boton-fondo-verde"
										>
											BECAS KAUST
									</a>
									<a href="https://www.becasmexico.com.mx/"
										target="_blank" rel="noopener noreferrer"  class="btn btn-primary boton-fondo-verde"
										>
											BECAS M&Eacute;XICO
									</a>
									<br/>
									<a href="https://www.becarios.unam.mx/Portal2018/?page_id=111"
										target="_blank" rel="noopener noreferrer"  class="btn btn-primary boton-fondo-verde"
										>
											BECAS ALTO RENDIMIENTO
									</a>
									<br/>
									<a href="https://www.fordfoundation.org/our-work-around-the-world/mexico-and-central-america/"
										target="_blank" rel="noopener noreferrer"  class="btn btn-primary boton-fondo-verde"
										>
											BECAS FORD
									</a>
                                </div>
                            </div>                                    
                        </div>
                    </div>
                </div>

            </div>

        </div>

	
    </div>
    
		<div class="row g-3" style="background:#F2FAFF;" id="comite">
			<h3 class="text-center" >COMIT&Eacute; ACAD&Eacute;MICO</h3>
			<!-- PRESENTACION 2 -->
			<div class="col-12 col-md-4" id="plan">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title"><i class="bi bi-card-checklist"></i></h2><br>
						<p><?=htmlspecialchars($pos['ca_fechas_reuniones']);?></p>
						<a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_aca_fechas_reuniones']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER M&Aacute;S
						</a>
                    </div>
				</div>
			</div>
			


			<!-- PRESENTACION 3 -->
		   <div class="col-12 col-md-4">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<h2 class="card-title">	<i class="bi bi-mortarboard"></i></h2><br>
						<p><?=htmlspecialchars($pos['ca_formatos']);?></p>
						<a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_ca_formatos']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER M&Aacute;S
						</a>
					</div>
				</div>
			</div>
				 <!-- PRESENTACION 1 -->
			<div class="col-12 col-md-4">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title">	<i class="bi bi-geo-alt"></i></h2><br>
						<p><?=htmlspecialchars($pos['ca_actas']);?></p>
						<a href="<?= BASE_URL ?>ensenanza/<?=htmlspecialchars($pos['enlace_ca_actas']);?>"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							VER M&Aacute;S
						</a>
					</div>
				</div>
			</div>

			<p></p>
		</div>				

	
	</div>

</div>


<?php 
//finalizarSlidersRevolution();
require_once ROOT_PATH . '/includes/footer.php'; ?>