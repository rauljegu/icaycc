
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="RdJG_SD">
		<title>Admin ICAyCC</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		  <link href="../assets/estilo.css" rel="stylesheet">
	</head>
	<body>
				<?php
include_once 'connect.php'; // include connection
include 'functions.php'; //include functions
$login = new Login;
$login->LoginSystem();
$login->SessionCheck();
$login->UserType();
 $_SESSION["role"];
?>
	<div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark  " style="background-color: #002B7A" >
			<?php $menu =0; include'../activo.php'; include'../menu.php';  ?>
		</nav>
		<?php
			include'../modal_inicio.php';
			
		?>

		<div class="container mt-4 content" >
			
			<?php		
			
			//	header("Location: index.php?response=" . urlencode(json_encode(["status" => "success", "message" => "Registrado, en breve recibirá un correo con más información."])));
				if (isset($_GET['response'])) {
					$responseJson = urldecode($_GET['response']);
					$response = json_decode($responseJson, true);

					if ($response) {
						
						header("Location: index.php?response=$response");
						/*
						echo "<script>
							document.addEventListener('DOMContentLoaded', function() {
								const Toast = Swal.mixin({
									toast: true,
									position: 'center',
									showConfirmButton: false,
									timer: 3000,
									timerProgressBar: true,
									didOpen: (toast) => {
										toast.onmouseenter = Swal.stopTimer;
										toast.onmouseleave = Swal.resumeTimer;
									}
								});

								Toast.fire({
									icon: '" . ($response['status'] === 'success' ? 'success' : 'error') . "',
									title: '" . addslashes($response['message']) . "'
								});

								// Redirigir después de mostrar el toast
								setTimeout(() => {
									window.location.href = 'index.php';
								}, 3100);
							});
						</script>";
					*/}
				}
						 
				?>
		</div>
		<?php include'../footer.php'; ?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="funciones.js"></script>
	</body>
</html>

	