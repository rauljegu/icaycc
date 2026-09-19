<?php
require_once __DIR__ . '/../config/config.php';
?>

<div class="container py-5">

    <h1 class="mb-4">
        Transparencia
    </h1>

    <div class="row g-4">
        <!-- DIRECCION -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body" id="mision">
                    <!--<h2 class="card-title"></h2>-->
					
					<p>La transparencia para las instituciones públicas es una obligación legal; el ejercicio de los recursos públicos obliga a rendir 
					cuentas a la sociedad, a informar sobre las razones de su actuar y los resultados que obtienen.
					La transparencia en la UNAM fortalece la confianza de los alumnos, de los académicos y de los trabajadores, 
					así como de la sociedad en general en la institución.</p>
                </div>
            </div>
        </div> 
		<!-- IMG DIRECTOR -->
		<div class="col-12 col-md-6">
			<div class="card shadow-sm h-100">
				<div class="card-body card-fondo-verde d-flex align-items-center justify-content-center">
					
					<img 
						src="img/transparencia.jpg"
						class="img-fluid"
						alt="transparencia"
					>

				</div>
			</div>
		</div>
		<!--MENUS-->
		<div class="d-flex align-items-start">

			<!-- MENÚ VERTICAL -->
			<div class="nav nav-tabs flex-column me-3" id="nav-tab" role="tablist" aria-orientation="vertical">
				<button class="nav-link active boton-fondo-verde"	id="nav-Directorio-tab" data-bs-toggle="tab"	data-bs-target="#nav-Directorio"
						type="button" role="tab" aria-controls="nav-Directorio" aria-selected="true">
					Directorio
				</button>
				<button class="nav-link boton-fondo-verde"	id="nav-Colegiados-tab" data-bs-toggle="tab"	data-bs-target="#nav-Colegiados"
						type="button" role="tab" aria-controls="nav-Colegiados" aria-selected="false">
					&Oacute;rganos Colegiados
				</button>
				<button class="nav-link boton-fondo-verde"	id="nav-Normativa-tab" data-bs-toggle="tab"	data-bs-target="#nav-Normativa"
						type="button" role="tab" aria-controls="nav-Normativa" aria-selected="false">
					Normativa
				</button>
			</div>

			<!-- CONTENIDO -->
			<div class="tab-content flex-grow-1" id="nav-tabContent">

				<div class="tab-pane fade show active"
					 id="nav-Directorio"
					 role="tabpanel"
					 aria-labelledby="nav-Directorio-tab"
					 tabindex="0">
					<div class="d-grid gap-2">
						<button class="btn btn-primary boton-fondo-verde" type="button">
							<a href="<?= BASE_URL ?>quienes/directorio.php#institucional">
								Institucional
							</a>
						</button>
						<button class="btn btn-primary boton-fondo-verde" type="button">
							<a href="<?= BASE_URL ?>quienes/directorio.php#academicos">
								Acad&eacute;mico
							</a>
						</button>
						<button class="btn btn-primary boton-fondo-verde" type="button">
							<a href="<?= BASE_URL ?>quienes/directorio.php#administrativo">	
								Administrativo
							</a>	
						</button>
						<button class="btn btn-primary boton-fondo-verde" type="button">
							<a href="<?= BASE_URL ?>quienes/sources/directorio.pdf">	
								PDF
							</a>	
						</button>
					</div>
				</div>
				<div class="tab-pane fade"
					 id="nav-Colegiados"
					 role="tabpanel"
					 aria-labelledby="nav-Colegiados-tab"
					 tabindex="0">
					<div class="d-grid gap-2">
						<button class="btn btn-primary boton-fondo-verde" type="button">
							<a href="<?= BASE_URL ?>secretarias/academica.php#colegiados">	
								Consejo Técnico de la Investigaci&oacute;n Cient&iacute;fica
							</a>
						</button>
						<button class="btn btn-primary boton-fondo-verde" type="button">
							<a href="<?= BASE_URL ?>secretarias/academica.php#colegiados">		
								Consejo Consultivo Interno
							</a>
						</button>
						<button class="btn btn-primary boton-fondo-verde" type="button">
							<a href="<?= BASE_URL ?>secretarias/academica.php#colegiados">		
								Comisi&oacute;n Dictaminadora
							</a>	
						</button>
						<button class="btn btn-primary boton-fondo-verde" type="button">
							<a href="<?= BASE_URL ?>secretarias/academica.php#colegiados">		
								Comisi&oacute;n Evaluadora
							</a>
						</button>
					</div>
				</div>
				<div class="tab-pane fade"
					 id="nav-Normativa"
					 role="tabpanel"
					 aria-labelledby="nav-Normativa-tab"
					 tabindex="0">
					<div class="d-grid gap-2">
						<button class="btn btn-primary boton-fondo-verde" type="button">
							<a href="<?= BASE_URL ?>secretarias/academica.php#normatividad">	
								Normatividad
							</a>
							</button>
					</div>
				</div>
			</div>
		</div>

	</div>
				
	<!-- =========================================================
	INFORMACIÓN DE TRANSPARENCIA
	========================================================= -->

	<!-- ACADÉMICOS / CONTRATACIONES -->
	<div class="row g-5 mt-4">
		<h2 class="text-center mb-4">
			Portal Universitario de Transparencia
		</h2>

		<!-- ACADÉMICOS -->
		<div class="col-12 col-md-6">
			<div class="px-3">
				<hr class="w-50 mx-auto">
				<h3 class="text-center fs-6 mb-4"> Académicos</h3>
				<ul>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/licencia-personal-academico">
							Académicos con licencia
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/sabatico-personal-academico">
							Académicos con sabático
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/evaluaciones-cuerpo-docente">
							Evaluación de docentes
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/informacion-curricular">
							Información curricular de funcionarios
						</a>
					</li>
				</ul>

			</div>
		</div>

		<!-- CONTRATACIONES -->
		<div class="col-12 col-md-6">
			<div class="px-3">

				<hr class="w-50 mx-auto">

				<h3 class="text-center fs-6 mb-4">
					Contrataciones de adquisiciones y obras
				</h3>

				<ul>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/resultados-licitacion">
							Licitación pública o invitación a cuando menos tres personas
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/resultados-adjudicacion-directa">
							Adjudicación directa
						</a>
					</li>
				</ul>

			</div>
		</div>
	</div>



	<!-- REMUNERACIONES / PRESUPUESTO -->
	<div class="row g-5 mt-2">

		<!-- REMUNERACIONES -->
		<div class="col-12 col-md-6">
			<div class="px-3">
				<hr class="w-50 mx-auto">
				<h3 class="text-center fs-6 mb-4">
					Remuneraciones
				</h3>
				<ul>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/remuneracion-profesores">
							Remuneraciones de los académicos y su tabulador
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/remuneracion-personal">
							Remuneraciones del personal administrativo y de confianza
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/tabulador-personal">
							Tabuladores de sueldos y salarios de puestos de confianza,
							de funcionarios y de puestos de base
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/gastos-viaticos-representacion">
							Viáticos
						</a>
					</li>
				</ul>
			</div>
		</div>

		<!-- PRESUPUESTO -->
		<div class="col-12 col-md-6">
			<div class="px-3">
				<hr class="w-50 mx-auto">
				<h3 class="text-center fs-6 mb-4">
					Presupuesto y avances programáticos o presupuestales de la UNAM
				</h3>
				<ul>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/informacion-presupuesto-anual">
							Presupuesto anual
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/ejercicio-egresos-presupuestarios">
							Egresos presupuestarios
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/informacion-cuenta-publica">
							Cuenta pública
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/dictaminacion-estados-financieros">
							Dictaminación estados financieros
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/informacion-contable">
							Información contable
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/informes-financieros">
							Informes financieros
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/ingresos-recibidos">
							Ingresos recibidos
						</a>
					</li>
					<li>
						<a href="https://www.transparencia.unam.mx/obligaciones/LGTAIP/consulta/responsables-ingresos">
							Responsables de ingresos
						</a>
					</li>
				</ul>

			</div>
		</div>
	</div>


	<div class="row mt-5">
		<div class="col-12">
			<div class="text-center">
				<hr class="w-50 mx-auto">
				<h3 class="fs-6 mb-4">
					Datos de contacto de la Unidad de Transparencia
				</h3>
				<p class="mb-1">
					Domicilio: Lado norponiente del Estadio Olímpico,
					Ciudad Universitaria, 04510, Ciudad de México
				</p>
				<p class="mb-1">
					Números telefónicos: 56220472 y 56220473
				</p>
				<p>
					Correo electrónico:
					<a href="mailto:unidaddetransparencia@unam.mx">
						unidaddetransparencia@unam.mx
					</a>
				</p>
			</div>
		</div>
	</div>


		<!-- =========================================================
		     PRESENTACIÓN DE SOLICITUDES
		     ========================================================= -->

	<div class="row g-5 mt-5">
		<!-- PLATAFORMA NACIONAL DE TRANSPARENCIA -->
		<div class="col-12 col-md-6">
			<div class="transparencia-seccion transparencia-solicitudes">
				<div class="transparencia-titulo">
					Presentación de solicitudes de acceso a la información
				</div>
				<div class="transparencia-imagen">

					<a href="https://www.plataformadetransparencia.org.mx/Inicio">
						<img
							src="https://www.plataformadetransparencia.org.mx/assets/img/public/v3/logo_pnt.svg"
							class="img-fluid"
							alt="Plataforma Nacional de Transparencia"
						>
					</a>
				</div>
			</div>
		</div>

		<!-- UNIDAD DE TRANSPARENCIA -->
		<div class="col-12 col-md-6">
			<div class="transparencia-seccion transparencia-solicitudes">
				<div class="transparencia-imagen">
					<a href="#">
						<img
							src="<?= BASE_URL ?>assets/img/logo_icaycc_colores.svg"
							class="img-fluid"
							alt="Unidad de Transparencia"
						>
					</a>
				</div>
			</div>
		</div>
	</div>


</div>


<?php require_once ROOT_PATH . '/includes/footer.php'; ?>