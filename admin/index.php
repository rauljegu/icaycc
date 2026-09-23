<?php

require_once __DIR__ . '/../config/config.php';

?>
<!--<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="index">
		<meta name="author" content="RdJG">
		<title>ADMIN ICAYCC</title>
		<link rel="icon" type="image/png"  href="../assets/logos/fav/favicon.ico">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		  <link href="assets/estilo.css" rel="stylesheet">
	</head>
	<body>
		<div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark  " style="background-color: #002B7A" >
			<?php //$menu =0; include'activo.php'; include'menu.php';  ?>
		</nav>-->
		<?php
			include'modal_inicio.php';
			include'modal_registro.php';
		?>
		<!--<div class="container mt-4 content" >-->
			<div class="container py-5">

				<!-- ENCABEZADO -->

				<div class="text-center mb-5">
					<img
					src="../assets/img/logo_icaycc_colores.svg"
					alt="ICAyCC"
					class="img-fluid mb-4"
					style="max-height:180px;">


					<p class="lead text-muted">
					Universidad Nacional Autónoma de México
					</p>
				<button type="button" class="btn btn-icaycc w-100" data-bs-toggle="modal" data-bs-target="#myModal1">
					Inicio de Sesión
				</button>
				</div>
			<?php		
				if (isset($_GET['response'])) {
					$responseJson = urldecode($_GET['response']);
					$response = json_decode($responseJson, true);

					if ($response) {
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
									icon: '" . ($response['status'] === 'success' ? 'success' : 'warning') . "',
									title: '" . addslashes($response['message']) . "'
								});

								// Redirigir después de mostrar el toast
								//setTimeout(() => {
								//	window.location.href = 'index.php';
								//}, 3100);
							});
						</script>";
					}
				}
						 
				?>
		</div>
	<?php //include('includes/footer.php'); 


require_once ROOT_PATH . '/includes/footer.php';

?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="funciones.js"></script>
	</body>
</html>