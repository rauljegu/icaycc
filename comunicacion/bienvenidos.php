<?php
require_once __DIR__ . '/../config/config.php';

$sql = "
SELECT
   *
FROM visitas d

";
//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$vis = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
    <h1 class="mb-4">Bienvenida a Estudiantes</h1>
    <div class="row g-4">
        <!-- MENÚS Y CONTENIDO -->
		<div class="col-12">
			<div class="d-flex flex-column">
				<!-- ========================= -->
				<!-- MENÚ HORIZONTAL -->
				<!-- ========================= -->
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<?php include 'pestanas_bienv.php'; ?>
				</div>
				<!-- ========================= -->
				<!-- CONTENIDO DE LAS TABS -->
				<!-- ========================= -->
				<div class="tab-content" id="nav-tabContent">
					<?php include 'contenido_pestanas_bienv.php';?>
				</div>
			</div>
		</div>		
		<!-------------------------------------------------
		--
		-- 						ENLACES  A SECCIONES                --
		-------------------------------------------------->
		 <h1 class="mb-4">Ligas de interés</h1>
		<!-- PRESENTACION 2 -->
        <div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="<?= BASE_URL ?>wp-content/uploads/2018/09/1Medidas-de-seguridad-en-el-laboratorio-8-03-18.pdf"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Medidas de seguridad en el Laboratorio
											</a>                 
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="https://www.unam.mx/comunidad/estudiantes/becas-y-otros-apoyos"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Becas y otros apoyos
											</a>                 
				</div>
			</div>
		</div>
		<!-- PRESENTACION 2 -->
        <div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="https://www.defensoria.unam.mx/"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Defensoría de los Derechos Universitarios
											</a>                 
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="https://coordinaciongenero.unam.mx/"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Coordinación para la Igualdad de Género UNAM
											</a>                 
				</div>
			</div>
		</div><!-- PRESENTACION 2 -->
        <div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="https://saludmental.unam.mx/comite.htm"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Comité Técnico para la Atención de la Salud Mental
											</a>                 
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="https://www.unam.mx/comunidad/estudiantes/becas-y-otros-apoyos"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Dirección General de Cooperacióne Internacionalización
											</a>                 
				</div>
			</div>
		</div><!-- PRESENTACION 2 -->
        <div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="http://www.pctierra.unam.mx/"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Posgrado en Ciencias de la Tierra
											</a>                 
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="https://www.encit.unam.mx/"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Escuela Nacional de Ciencias de la Tierra
											</a>                 
				</div>
			</div>
		</div><!-- PRESENTACION 2 -->
        <div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="https://www.dgsgm.unam.mx/bicipuma.html"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Bicipuma
											</a>                 
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="https://cultura.unam.mx/"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Coordinación de Difusión Cultural
											</a>                 
				</div>
			</div>
		</div><!-- PRESENTACION 2 -->
        <div class="col-12 col-md-12">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
						<a
							href="https://www.gaceta.unam.mx/"
							target="_blank"
							rel="noopener noreferrer"
							class="btn btn-primary boton-fondo-verde"
						>
							Gaceta Digital UNAM
											</a>                 
				</div>
			</div>
		</div>
		




    </div>

</div>



<?php require_once ROOT_PATH . '/includes/footer.php'; ?>