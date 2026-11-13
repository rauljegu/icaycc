<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/slider-revolution.php';
$sql = "
SELECT
   *
FROM licenciatura

";
//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$lic = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<div class="container py-5">

    <h1 class="mb-4">
        <?=htmlspecialchars($lic['nombre']);?>
    </h1>

    <div class="row g-4">
		
		<div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body" >
                    <h2 class="card-title"> Orientaci&oacute;n en Ciencias Atmosf&eacute;ricas</h2>
					 <?=htmlspecialchars($lic['descripcion']);?>
					
                </div>
            </div>
        </div> 
		<div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body card-fondo-verde
                            d-flex align-items-center justify-content-center">

                    <img
                        src="img/lic.jpg"
                        class="img-fluid"
                        alt="Secretaría Académica"
                    >

                </div>
            </div>
        </div> 
		

		
		
		
		
		
		<div class="row g-3" style="background:#F2FAFF;" id="recursos">
			<h3 class="text-center" >INFORMACI&Oacute;N</h3>
			<!-- PRESENTACION 2 -->
			<div class="col-12 col-md-4" id="plan">
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
						<h2 class="card-title"><i class="bi bi-card-checklist"></i></h2><br>
						<p><?=htmlspecialchars($lic['plan']);?></p>
						<a href="http://oferta.unam.mx/planestudios/Ciencias_Tierra_ENCiT_Plan_estudios.pdf"
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
						<p><?=htmlspecialchars($lic['licenciatura']);?></p>
						<a href="http://oferta.unam.mx/ciencias-de-la-tierra.html"
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
						<p><?=htmlspecialchars($lic['licenciatura']);?></p>
						<a href="http://www.encit.unam.mx/informacion-general"
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
		
		
		<div class="row g-2" style="background:#F2FAFF;">
			
		
		

			<div class="col-12 col-md-6">
				<div class="card shadow-sm h-100">
					<div class="card-body flex-column justify-content-center align-items-center  card-fondo-medium">
						<h3>PERFIL DE INGRESO</h3>
							<p><?=htmlspecialchars($lic['p_ingreso']);?></p>
					</div>
				</div>
			</div>
	
		
		
			<div class="col-12 col-md-6">
				<div class="card shadow-sm h-100">
					<div class="card-body  flex-column justify-content-center align-items-center  card-fondo-medium">
						<h3>PERFIL DE EGRESO</h3>
							<p><?=htmlspecialchars($lic['p_egreso']);?></p>
					</div>
				</div>
			</div>
		</div>
			
        <div class="col-12" ID="becas">
			
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

</div>


<?php 
//finalizarSlidersRevolution();
require_once ROOT_PATH . '/includes/footer.php'; ?>