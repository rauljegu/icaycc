
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="RdJG_SD">
		<title>Gaceta Salud Digital</title>
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
			include'../modal_registro.php';
		?>

		<div class="container mt-4 content" >
			<div class="row">
				<div class="col-md-8">
					<br>
					<h2 id="acerca">Acerca de la Gaceta</h2>
					<br>
					<h3>Órgano de divulgación del Departamento de Salud Digital</h3>
					<p>Su objetivo principal es divulgar los avances en la Salud Digital y de la Transformación Digital en Salud a la comunidad de profesionales de atención de la salud 
						y a todos los profesionales interesados.</p>
					<h3 id="actual">Número más reciente</h3>
					<table class="table table-bordered align-middle">
					<?php 
						include'conexion.php';
						$sql="SELECT * FROM publicados 
						INNER JOIN datos_gaceta ON publicados.id_publicados=datos_gaceta.id_publicados WHERE publicados.activo = 1
						ORDER BY publicados.id_publicados DESC LIMIT 1";
						//echo $sql;
						$result=$conn->query($sql);
						if($result->num_rows > 0 ){
							while($row=$result->fetch_assoc()){
								?>
								<thead>
								</thead>
								<tbody>
								<tr>
									<td><a href="./user/publicados/<?php echo $row["archivo"]?>" target="_blank"><img src="../img/gaceta_azul.png" width="100em"></a></td>
									<td>
										<p><a class="btn btn-primary" href="./user/publicados/<?php echo $row["archivo"]?>" target="_blank">Gaceta Salud Digital</a></p>
										<p>Vol.<?=$row["volumen"];?> Núm. <?=$row["numero"];?> (<?=$row["year"];?>)</p>
										<p>Órgano de divulgación del Departamento de Salud Digital</p>
									</td>
								</tr>
								</tbody>
								<?php
							}
						
						}
				   ?>
				   </table>
				</div>
			</div>
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

	