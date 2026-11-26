<?php
    // La configuración y la validación de sesión deben ejecutarse antes de cualquier HTML.
    $name = basename($_SERVER['PHP_SELF']);
    require_once 'settings.php';
    require_once '../../includes/connect.php';
	$directorio = basename(__DIR__);
    $connect = $conn;
	// Obtener lista de personal
	$asi="SELECT * FROM personal WHERE id_tipo_personal = 1 OR id_tipo_personal = 4 ORDER BY activo DESC, nombre ASC, apellido_paterno ASC, apellido_materno ASC, nombre ASC; ";
	$resultasi = $connect->query($asi);

	$adm="SELECT * FROM personal WHERE id_tipo_personal = 2 ORDER BY activo DESC, nombre ASC, apellido_paterno ASC, apellido_materno ASC, nombre ASC; ";
	$resultadm = $connect->query($adm);

	$ins="SELECT * FROM personal WHERE id_tipo_personal = 3 ORDER BY activo DESC, nombre ASC, apellido_paterno ASC, apellido_materno ASC, nombre ASC; ";
	$resultins = $connect->query($ins);
	

	if ($resultasi === false) {
		die("Error en la consulta: " . $connect->error);
	}
	if ($resultadm === false) {
		die("Error en la consulta: " . $connect->error);
	}
	if ($resultins === false) {
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
							if($_GET["ok"] == 1 ){
								echo'<div id="loading-spinner" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
									<div class="spinner-border text-light" role="status">
									<span class="visually-hidden">Cargando...</span>
									</div>
									</div>';
								activar();
							}
							if($_GET["ok"] == 2 ){
								echo'<div id="loading-spinner" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
									<div class="spinner-border text-light" role="status">
									<span class="visually-hidden">Cargando...</span>
									</div>
									</div>';
								desactivar();
								//echo "Desactivado";
							}
							if($_GET["ok"] == 3 ){
								
								insertar_ac();
								//echo "Desactivado";
							}
							if($_GET["ok"] == 4 ){
								
								insertar_ad();
								//echo "admin";
							}
							if($_GET["ok"] == 5 ){
								
								insertar_ins();
								//echo "institucional";
							}
						}
			?>
        </div>
    </nav>

<div class="container mt-5 pt-5 content">
			<div class="row">
				<div class="col-md-12 mx-auto">
					<div class="card bg-primary text-white">
						<div class="card-header">Personal Académico</div>
						<?php include'personal/academico.php';?>
					</div>
					<br>
					<br>
				</div>
				<div class="col-md-12 mx-auto">			
					<div class="card bg-primary text-white">
						<div class="card-header">Personal Administrativo</div>
						<?php include'personal/administrativo.php';?>
					</div>
					<br>
					<br>
				</div>
				<div class="col-md-12 mx-auto">			
					<div class="card bg-primary text-white">
						<div class="card-header">Personal Institucional</div>
						<?php include'personal/institucional.php';?>
					</div>
					<br>
					<br>
					<br>
					<br>
					<br>
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
			 // Mostrar notificación si hay éxito en el registro
			const urlParams = new URLSearchParams(window.location.search);
			if (urlParams.has('success')) {
				Swal.fire({
					toast: true,
					position: "top-end",
					icon: "success",
					title: "Asistencia registrada con éxito",
					showConfirmButton: false,
					timer: 3000
				});
			}
			if (urlParams.has('error')) {
				Swal.fire({
					toast: true,
					position: "top-end",
					icon: "error",
					title: "Error al registrar asistencia",
					showConfirmButton: false,
					timer: 3000
				});
			}
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
			 // Mostrar notificación si hay éxito en el registro
			const urlParams1 = new URLSearchParams(window.location.search);
			if (urlParams1.has('success')) {
				Swal.fire({
					toast: true,
					position: "top-end",
					icon: "success",
					title: "Asistencia registrada con éxito",
					showConfirmButton: false,
					timer: 3000
				});
			}
			if (urlParams1.has('error')) {
				Swal.fire({
					toast: true,
					position: "top-end",
					icon: "error",
					title: "Error al registrar asistencia",
					showConfirmButton: false,
					timer: 3000
				});
			}
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
			 // Mostrar notificación si hay éxito en el registro
			const urlParams2 = new URLSearchParams(window.location.search);
			if (urlParams2.has('success')) {
				Swal.fire({
					toast: true,
					position: "top-end",
					icon: "success",
					title: "Asistencia registrada con éxito",
					showConfirmButton: false,
					timer: 3000
				});
			}
			if (urlParams2.has('error')) {
				Swal.fire({
					toast: true,
					position: "top-end",
					icon: "error",
					title: "Error al registrar asistencia",
					showConfirmButton: false,
					timer: 3000
				});
			}
		</script>

