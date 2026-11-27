<?php
    // La configuración y la validación de sesión deben ejecutarse antes de cualquier HTML.
    $name = basename($_SERVER['PHP_SELF']);
    require_once 'settings.php';
    require_once '../../includes/connect.php';
	$directorio = basename(__DIR__);
    $connect = $conn;
	// Obtener lista de personal
	$dir="SELECT p.id_personal AS NoPersonal, p.nombre, p.cargo, c.nombre AS Cargo, p.id_tipo_personal, ps.id_direccion AS ips, ps.rol 
	FROM personal p 
	INNER JOIN personal_direccion ps ON p.id_personal = ps.id_personal 
	INNER JOIN cargos c ON p.cargo = c.id_cargo 
	WHERE c.activo = 1 AND ps.rol != 'responsable' AND p.id_tipo_personal = 2 AND p.activo = 1 ORDER BY `p`.`nombre` ASC
;";
	$resultdir = $connect->query($dir);

	$aca="SELECT p.id_personal AS NoPersonal, p.nombre, p.cargo, c.nombre AS Cargo, p.id_tipo_personal, ps.id_personal_secretarias AS ips, ps.id_secretarias, ps.rol
	FROM personal p
	INNER JOIN personal_secretarias ps
	ON p.id_personal = ps.id_personal
    INNER JOIN cargos c
    ON p.cargo = c.id_cargo
	WHERE ps.id_secretarias = 1 AND c.activo = 1 AND ps.rol != 'responsable' AND p.id_tipo_personal = 2 AND p.activo = 1 
	ORDER BY ps.rol ASC, `p`.`nombre` ASC
;";
	$resultaca = $connect->query($aca);

	$tec="SELECT p.id_personal AS NoPersonal, p.nombre, p.cargo, c.nombre AS Cargo, p.id_tipo_personal, ps.id_personal_secretarias AS ips, ps.id_secretarias, ps.rol
	FROM personal p
	INNER JOIN personal_secretarias ps
	ON p.id_personal = ps.id_personal
    INNER JOIN cargos c
    ON p.cargo = c.id_cargo
	WHERE ps.id_secretarias = 3 AND c.activo = 1 AND ps.rol != 'responsable' AND p.id_tipo_personal = 2 AND p.activo = 1
	ORDER BY p.nombre ASC";
	$resulttec = $connect->query($tec);

	$ins="SELECT * FROM personal WHERE id_tipo_personal = 3 ORDER BY activo DESC, nombre ASC, apellido_paterno ASC, apellido_materno ASC, nombre ASC; ";
	$resultins = $connect->query($ins);
	

	if ($resultdir === false) {
		die("Error en la consulta: " . $connect->error);
	}
	if ($resultaca === false) {
		die("Error en la consulta: " . $connect->error);
	}
	if ($resulttec === false) {
		die("Error en la consulta: " . $connect->error);
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Perfil de usuario">
	<meta name="author" content="RdJG">
    <title>Personal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
   
    <link href="../../assets/estilo.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-dark fixed-top" >
        <div class="container-fluid" id="menu-container">
            <?php 	include 'menu.php';
					include 'funciones1.php'; 
						if(isset($_GET["ok"]) ){
							if($_GET["ok"] == 6 ){
								echo "quitar integrante ".$_GET["id"];
								$area = $_GET["area"];
								switch($area){
									case 1: $tab = "secretaria"; Break;
									case 2: $tab = "unidad"; Break;
									case 3: $tab = "grupo"; Break;
									case 4: $tab = "departamento"; Break;
									case 5: $tab = "direccion"; Break;
									case 6: $tab = "laboratorio"; Break;								
								}
								  eliminarAdscripcionPersonal($tab);
							//	insertar_ins();
							}
							if($_GET["ok"] == 8 ){
								
								$area = $_GET["area"];
								$sa = $_GET["sa"];
								$in = $_GET["in"];
								$tp = $_GET["tp"];
								switch($area){
									case 1: $tab = "secretaria"; Break;
									case 2: $tab = "unidad"; Break;
									case 3: $tab = "grupo"; Break;
									case 4: $tab = "departamento"; Break;
									case 5: $tab = "direccion"; Break;
									case 6: $tab = "laboratorio"; Break;								
								}
								switch($in){
									case 1: $rol ='responsable'; break;
									case 2: $rol ='integrante'; break;
									case 3: $rol ='administrativo'; break;
									case 4: $rol ='colaborador'; break;
									
								}
									agregar_personal_adscripcion( $tab, $sa,$_POST['personal'] ?? [],$rol, $tp);
									//agregar_personal_adscripcion( $tab, $sa,$ids,'integrante', $tp);
									//echo $tab." ".$sa." ".$tp;
								
							}
						}
			?>
        </div>
    </nav>


<div class="container mt-5 pt-5 content">

    <div class="row">
        <div class="col-md-12 mx-auto">

            <div class="accordion" id="acordeonInstitucional">

                <!-- DIRECCIÓN -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingDireccion">
                        <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseDireccion"
                                aria-expanded="false"
                                aria-controls="collapseDireccion">
                            Dirección
                        </button>
                    </h2>

                    <div id="collapseDireccion"
                         class="accordion-collapse collapse"
                         aria-labelledby="headingDireccion"
                         data-bs-parent="#acordeonInstitucional">

                        <div class="accordion-body">
                            <?php  include  'direccion/direccion.php'; ?>
                        </div>
                    </div>
                </div>

                <!-- SECRETARÍAS -->
                <div class="accordion-item">
                    <h1 class="accordion-header" id="headingSecretarias">
                        <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseSecretarias"
                                aria-expanded="false"
                                aria-controls="collapseSecretarias">
                            Secretarías
                        </button>
                    </h1>

                    <div id="collapseSecretarias"
                         class="accordion-collapse collapse"
                         aria-labelledby="headingSecretarias"
                         data-bs-parent="#acordeonInstitucional">

                        <div class="accordion-body">
                            <div class="card mb-3 bg-primary text-white">
                                <div class="card-header">
                                    <h2>Secretaría Académica</h2>
                                </div>
								
                                <?php include  'secretaria/academica.php'; ?>
                            </div>
							<br>
							<br>
							<br>
                            <div class="card mb-3 bg-primary text-white">
                                <div class="card-header">
                                   <h2> Secretaría Administrativa</h2>
                                </div>
                                <?php // include  'secretaria/administrativa.php'; ?>
                            </div>
							<br>
							<br>
							<br>

                            <div class="card mb-3 bg-primary text-white">
                                <div class="card-header">
                                   <h2> Secretaría Técnica</h2>
                                </div>
                                <?php  include  'secretaria/tecnica.php'; ?>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- DEPARTAMENTOS -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingDepartamentos">
                        <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseDepartamentos"
                                aria-expanded="false"
                                aria-controls="collapseDepartamentos">
                            Departamentos
                        </button>
                    </h2>

                    <div id="collapseDepartamentos"
                         class="accordion-collapse collapse"
                         aria-labelledby="headingDepartamentos"
                         data-bs-parent="#acordeonInstitucional">

                        <div class="accordion-body">
                            <?php 
							// include  'departamentos/contenido.php'; 
							$departamentos = "SELECT id_departamento, nombre AS departamento FROM departamentos WHERE activo = 1 ";
							$resultdepartamentos = $connect->query($departamentos);
							if ($resultdepartamentos === false) {
								die("Error en la consulta: " . $connect->error);
							}
							?>
							<?php 
							while ($rowdpto = $resultdepartamentos->fetch_assoc()):
							$nombre = $rowdpto['departamento'] ?? '';
							$iddepto = $rowdpto['id_departamento'] ?? '';
							?>
							 <div class="card mb-3 bg-primary text-white">
                                <div class="card-header">
                                    <h2><?php echo ucfirst(htmlspecialchars($nombre)); ?></h2>
                                </div>
								
                                <?php include  'departamento/contenido.php'; ?>
                            </div>
							<br>
							<br>
							<br>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
				<script>
document.addEventListener("input", function(e) {

    // Identificar si el elemento es un buscador
    const buscador = e.target.closest("[data-filter-table]");

    if (!buscador) return;

    // Obtener la tabla correspondiente
    const idTabla = buscador.dataset.filterTable;
    const tabla = document.getElementById(idTabla);

    if (!tabla) return;

    // Obtener las columnas que se van a buscar
    const columnas = buscador.dataset.filterColumns
        .split(",")
        .map(Number);

    const filtro = buscador.value.trim().toLowerCase();

    // Recorrer las filas
    tabla.querySelectorAll("tr").forEach(fila => {

        const coincide = columnas.some(indice => {

            const celda = fila.cells[indice];

            return celda &&
                celda.textContent.toLowerCase().includes(filtro);

        });

        fila.style.display = coincide ? "" : "none";

    });

});
</script>
                <!-- GRUPOS -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingGrupos">
                        <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseGrupos"
                                aria-expanded="false"
                                aria-controls="collapseGrupos">
                            Grupos
                        </button>
                    </h2>

                    <div id="collapseGrupos"
                         class="accordion-collapse collapse"
                         aria-labelledby="headingGrupos"
                         data-bs-parent="#acordeonInstitucional">

                        <div class="accordion-body">
                            <?php // include  'grupos/contenido.php'; 
							$grupos = "SELECT id_grupo, nombre AS grupo FROM grupos WHERE activo = 1 ORDER BY nombre ASC";
							$resultgrupos = $connect->query($grupos);
							if ($resultgrupos === false) {
								die("Error en la consulta: " . $connect->error);
							}
							?>
							<?php 
							while ($rowgpo = $resultgrupos->fetch_assoc()):
							$nombre = $rowgpo['grupo'] ?? '';
							$idgpo = $rowgpo['id_grupo'] ?? '';
							?>
							 <div class="card mb-3 bg-primary text-white">
                                <div class="card-header">
                                    <h2><?php echo ucfirst(htmlspecialchars($nombre)); ?></h2>
                                </div>
								
                                <?php include  'grupos/contenido.php'; ?>
                            </div>
							<br>
							<br>
							<br>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>

                <!-- UNIDADES DE APOYO -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingUnidades">
                        <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseUnidades"
                                aria-expanded="false"
                                aria-controls="collapseUnidades">
                            Unidades de apoyo
                        </button>
                    </h2>

                    <div id="collapseUnidades"
                         class="accordion-collapse collapse"
                         aria-labelledby="headingUnidades"
                         data-bs-parent="#acordeonInstitucional">

                        <div class="accordion-body">
                            <?php // include  'unidades/contenido.php'; ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

	<?php include'footer.php';?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
		 <script>
			// Filtrado en tiempo real
			document.getElementById("buscador").addEventListener("keyup", function() {
				let filtro = this.value.toLowerCase();
				let filas = document.querySelectorAll("#tablaCuerpo tr");

				filas.forEach(fila => {
					let nombre = fila.cells[0].textContent.toLowerCase();
					let correo = fila.cells[1].textContent.toLowerCase();

					if (nombre.includes(filtro) || correo.includes(filtro)) {
						fila.style.display = "";
					} else {
						fila.style.display = "none";
					}
				});
			});
		</script>
		<script>
			// Filtrado en tiempo real
			document.getElementById("buscador1").addEventListener("keyup", function() {
				let filtro = this.value.toLowerCase();
				let filas = document.querySelectorAll("#tablaCuerpo1 tr");

				filas.forEach(fila => {
					let nombre1 = fila.cells[0].textContent.toLowerCase();
					let correo1 = fila.cells[1].textContent.toLowerCase();

					if (nombre1.includes(filtro) || correo1.includes(filtro)) {
						fila.style.display = "";
					} else {
						fila.style.display = "none";
					}
				});
			});
			
		</script>
		<script>
			// Filtrado en tiempo real
			document.getElementById("buscador2").addEventListener("keyup", function() {
				let filtro = this.value.toLowerCase();
				let filas = document.querySelectorAll("#tablaCuerpo2 tr");

				filas.forEach(fila => {
					let nombre2 = fila.cells[0].textContent.toLowerCase();
					let correo2 = fila.cells[1].textContent.toLowerCase();

					if (nombre2.includes(filtro) || correo2.includes(filtro)) {
						fila.style.display = "";
					} else {
						fila.style.display = "none";
					}
				});
			});
			
		</script>
		<script>
			// Filtrado en tiempo real
			document.getElementById("buscador3").addEventListener("keyup", function() {
				let filtro = this.value.toLowerCase();
				let filas = document.querySelectorAll("#tablaCuerpo3 tr");

				filas.forEach(fila => {
					let nombre2 = fila.cells[0].textContent.toLowerCase();
					let correo2 = fila.cells[1].textContent.toLowerCase();

					if (nombre2.includes(filtro) || correo2.includes(filtro)) {
						fila.style.display = "";
					} else {
						fila.style.display = "none";
					}
				});
			});
			
		</script>
		<script>
			// Filtrado en tiempo real
			document.getElementById("buscador4").addEventListener("keyup", function() {
				let filtro = this.value.toLowerCase();
				let filas = document.querySelectorAll("#tablaCuerpo4 tr");

				filas.forEach(fila => {
					let nombre2 = fila.cells[0].textContent.toLowerCase();
					let correo2 = fila.cells[1].textContent.toLowerCase();

					if (nombre2.includes(filtro) || correo2.includes(filtro)) {
						fila.style.display = "";
					} else {
						fila.style.display = "none";
					}
				});
			});
			
		</script>
				<script>
			// Filtrado en tiempo real
			document.getElementById("buscador5").addEventListener("keyup", function() {
				let filtro = this.value.toLowerCase();
				let filas = document.querySelectorAll("#tablaCuerpo5 tr");

				filas.forEach(fila => {
					let nombre2 = fila.cells[0].textContent.toLowerCase();
					let correo2 = fila.cells[1].textContent.toLowerCase();

					if (nombre2.includes(filtro) || correo2.includes(filtro)) {
						fila.style.display = "";
					} else {
						fila.style.display = "none";
					}
				});
			});
			
		</script>

