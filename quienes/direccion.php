<?php
require_once __DIR__ . '/../config/config.php';
?>

<div class="container py-5">

    <h1 class="mb-4">
        Direcci&oacute;n
    </h1>

    <div class="row g-4">
        <!-- PRESENTACION 1 -->
        <div class="col-12 col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-naranja">

					<h2 class="card-title">
						<i class="bi bi-person-circle"></i>
					</h2>

					<p>Director</p>
					<p>Dr. Michel Grutter de la Mora</p>

				</div>
			</div>
		</div>
		<!-- PRESENTACION 2 -->
        <div class="col-12 col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
					<h2 class="card-title"><i class="bi bi-envelope-at-fill"></i></h2><br>
                    <p>Email</p>
                    <p>grutter@atmosfera.unam.mx</p>
				</div>
			</div>
		</div>


        <!-- PRESENTACION 3 -->
       <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
					<h2 class="card-title"><i class="bi bi-telephone"></i></h2>
                    <p>Tel&eacute;no</p>
                    <p>(55) 5622 4076</p>
                </div>
            </div>
        </div>

        <!-- DIRECCION -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body" id="mision">
                    <h2 class="card-title">Dr. Michel Grutter de la Mora</h2>
					<h3> Departamento y Grupo de Investigación:</h3> <p>Grupo de Espectroscopía y Percepción Remota</p>
					<h3>Semblanza:</h3>
					<p>El Dr. Michel Grutter de la Mora es Investigador Titular en la UNAM y encabeza el grupo de Espectroscopía y Percepción Remota 
					en el Instituto de Ciencias de la Atmósfera y Cambio Climático.
					Estudió química en la Universidad de Texas y sus estudios de maestría y doctorado los realizó en la Universidad de Basilea en Suiza, investigando 
					con espectroscopía molecular la composición del medio interestelar.
					En su trayectoria de más de 25 años en la UNAM ha implementado una gran variedad de metodologías para el estudio de la composición de la 
					atmósfera terrestre y su variabilidad mediante novedosas técnicas de percepción remota, tanto desde la superficie como de plataformas 
					satelitales.
					Entre los objetivos de sus investigaciones está el estudio del cambio en las concentraciones de contaminantes atmosféricos y de los gases
					de efecto invernadero, que se presentan en el tiempo debido a los ciclos naturales y la actividad humana.
					Ha publicado más de un centenar de artículos científicos en revistas internacionales y capítulos en libros que han sido citados en más de 
					mil doscientos trabajos.
					También participa activa y continuamente en la impartición de conferencias en congresos y diferentes foros en el ámbito nacional e 
					internacional. Ha sido miembro del comité científico de la iniciativa “International Global Atmospheric Chemistry” (IGAC) del 2016 a 2020, 
					de la “Coalición de Clima y Aire Limpio” de las Naciones Unidas (2021 a 2022) y del 2023 a la fecha forma parte del “Scientific Steering 
					Committee” de la comisión internacional iCACGP (International Commission on Atmospheric Chemistry and Global Pollution). Actualmente
					participa de otros comités científicos como es el “Programa Mexicano del Carbono” y el equipo de validación de la misión satelital 
					“Tropospheric Monitor of Pollution” (TEMPO), entre otros.
					El Dr. Grutter imparte cursos de manera regular en la Escuela Nacional y el Posgrado en Ciencias de la Tierra de la UNAM.</p>
                </div>
            </div>
        </div> 
		<!-- IMG DIRECTOR -->
		<div class="col-12 col-md-6">
			<div class="card shadow-sm h-100">
				<div class="card-body card-fondo-verde d-flex align-items-center justify-content-center">
					
					<img 
						src="img/director.jpg"
						class="img-fluid"
						alt="director del ICAyCC"
					>

				</div>
			</div>
		</div>



    </div>
</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>