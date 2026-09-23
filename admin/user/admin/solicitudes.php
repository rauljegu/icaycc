<?php //include 'settings.php'; 
$name =basename($_SERVER["PHP_SELF"]);
/*include'conexion.php';
$sql01="SELECT COUNT(`activo`) AS sol FROM `users` WHERE `activo` = 0;";
		$result01 = $conn->query($sql01);
		if ($result01->num_rows > 0) { 
			while($row01= $result01->fetch_assoc()) {
				$pen1= $row01["sol"];
			}
		} //else { $pen1= "Sin Solicitudes";}
		
	$conn->close();		*/
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Perfil de usuario">
		<title>Solicitudes <?php if($pen1 == 0){ echo "(Sin Solicitudes)"; } else { echo $pen1;}?></title>
		
		<!-- Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- SweetAlert2 -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<link href="../../assets/estilo.css" rel="stylesheet">
	</head>
	<body>
			
		<nav class="navbar navbar-dark fixed-top" style="background-color: #002B7A;">
			<div class="container-fluid" id="menu-container">
				<?php
					include 'menu.php';
					include 'funciones.php'; 
					if(isset($_GET["ok"]) ){
						if($_GET["ok"] == 1 ){
						echo'<div id="loading-spinner" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>';
						activar();
						}
					}	
					if(isset($_GET["ok"]) ){
						if($_GET["ok"] == 2 ){
						echo'<div id="loading-spinner" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>';
						desactivar();
						}
					}	
					if(isset($_GET["ok"]) ){
						if($_GET["ok"] == 3 ){
						echo'<div id="loading-spinner" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>';
						eliminar();
						}
					}
				?>
			</div>
		</nav>
		<div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>
		<div class="container mt-5 pt-5 content">
			<div class="row">
				<div class="col-md-8 mx-auto">
					<div class="card bg-primary text-white">
						<div class="card-header">Solicitudes</div>
						<div class="card-body bg-light text-dark">
							<table class="table">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Primer Apellido</th>
										<th>Segundo Apellido</th>
										<th>Correo</th>
										<th colspan="3">ACCIONES</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include'conexion.php';
									$sql="SELECT * FROM `users` WHERE activo = 0 ORDER BY `paterno` ASC;";
									//Echo $sql;
										$result = $conn->query($sql);
										if ($result->num_rows > 0) { 
											while($row= $result->fetch_assoc()) {
									?>	
									   <?php if($row["activo"] == 0){?>
									   <tr class='table-warning'>
									   <?php } ?>
											<td><?=$row["name"];?></td>
											<td><?=$row["paterno"];?></td>
											<td><?=$row["materno"];?></td>
											<td><?=$row["correo"];?></td>
											<?php if($row["activo"] == 0){ echo "<td colspan='3'>
																					<a class='btn btn-success' href='solicitudes.php?ok=1&id=".$row["id"]."&c=".$row["correo"]."' style='text-decoration:none'>Activar</a>
																					<a class='btn btn-warning' href='solicitudes.php?ok=2&id=".$row["id"]."&c=".$row["correo"]."' style='text-decoration:none'>Desactivar</a>
																					<a class='btn btn-danger' href='solicitudes.php?ok=3&id=".$row["id"]."&c=".$row["correo"]."' style='text-decoration:none'>Eliminar</a>
																				</td>";} ?>
										</tr>
									<?php	
											}
										} else {										
									?>
										<tr>
											<td class="table-secondary" colspan="7"><center>No Tiene Solicitudes de  Nuevos CPCeros</center></td>
										</tr>
									<?php
										}
									?>
								</tbody>
							</table>	
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