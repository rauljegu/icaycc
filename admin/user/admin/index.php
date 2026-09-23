<?php //include 'settings.php'; 
$name =basename($_SERVER["PHP_SELF"]);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Perfil de usuario">
		<title>Perfil de Usuario</title>
		<!-- Font Awesome CDN pública -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


		<!-- Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- SweetAlert2 -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		
		<link href="css/starter-template.css" rel="stylesheet">
		<link href="../../assets/estilo.css" rel="stylesheet">
	</head>
	<body>
		<?php 	
			
		?>
		<nav class="navbar navbar-dark fixed-top" style="background-color: #002B7A;">
			<div class="container-fluid" id="menu-container">
				<?php  include 'menu.php';
					include 'funciones1.php'; 
					//echo $_SESSION["mail"];
					if($_SERVER["REQUEST_METHOD"] == "POST" ){
						if($_GET["eq"] == 1 ){actualizar();}
					}				?>
			</div>
		</nav>
		<div class="container mt-5 pt-5 content" >
			<div class="row">
				<div class="col-md-8 mx-auto">
					<div class="card bg-primary text-white">
						<div class="card-header">Perfil de Usuario</div>
						<div class="card-body bg-light text-dark">
							<?php
							include '../../includes/connect.php';
							$connect = $conn;
							$sql="SELECT * FROM datos_users WHERE id_user ='".$_SESSION['id']."'";
						   //echo $sql;
							$result = $conn->query($sql);
							if($result->num_rows > 0) { //echo "hola";
								while($row = $result->fetch_assoc()) {
							?>
									<div class="text-center">
										<img id="fotoPerfil" src="img/perfil/<?=$row["foto"];?>" class="img-thumbnail" width="150" alt="Foto de perfil">
										<br>
									</div> 
							<?php   }
							} else { /*echo "Algo paso".$sql;*/ } ?>
							<form id="formFoto" action="subir_foto.php" method="POST" enctype="multipart/form-data" novalidate>
								<input type="file" name="foto" id="inputFoto" accept="image/*" class="form-control mt-2" onchange="cambiarFoto()">
								<input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id']; ?>">
								<button type="submit" class="btn btn-primary mt-2">Subir Foto</button>
							</form>
							<form id="registroForm" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=1&id=".$_SESSION['id']); ?>">
							<?php
								$sql1="SELECT * FROM users WHERE id ='".$_SESSION['id']."'";
								$result1 = $conn->query($sql1);
								if ($result1->num_rows > 0) {
									while($row1= $result1->fetch_assoc()) { ?>
										<h3 class="mt-3">Nombre: <?=$row1["name"]." ".$row1["paterno"]." ".$row1["materno"];?></h3>
										<div class="input-group mb-3">
											<span class="input-group-text">Nombre(s) Apellidos</span>
											<input type="text" class="form-control" name="name" value="<?=$row1["name"];?>" required>
											<input type="text" class="form-control" name="paterno" value="<?=$row1["paterno"];?>" required>
											<input type="text" class="form-control" name="materno" value="<?=$row1["materno"];?>" >
											<div class="invalid-feedback">Todos los campos de nombre y apellidos son obligatorios.</div>
										</div>
										<div class="input-group mb-3">
											<span class="input-group-text" id="basic-addon1">Correo/usuario @</span>
											<input type="email" class="form-control" placeholder="user@server.com" aria-label="Username"
												aria-describedby="basic-addon1" name="correo" value="<?=$row1["correo"];?>" 
												 pattern="[a-zA-Z0-9._%+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
											<div class="invalid-feedback">Ingrese un correo válido.</div>
										</div>
										<?php
											$sql2="SELECT * FROM datos_users WHERE id_user ='".$_SESSION['id']."'";                       
											$result2 = $conn->query($sql2);
											//$row2= $result2->fetch_assoc(); 
											if ($result2->num_rows > 0) { 
												while($row2= $result2->fetch_assoc()) {
												?>	<div class="input-group mb-3">
														<span class="input-group-text">Adscripción: </span>
														<input type="text" class="form-control" id="adscripcion" name="adscripcion" value="<?=$ads=$row2["adscripcion"];?>">
													</div>	
													<div class="input-group mb-3">
														<span class="input-group-text">N&uacute;mero de contacto</span>										
														<input type="tel" class="form-control" id="contacto" name="telefono" value="<?=$tel=$row2["telefono"];?>" placeholder="+(00)1234567890" pattern="\+\([0-9]{2}\)[0-9]{10}">
													</div>	
													<div class="col-12">
															<span class="input-group-text">Reseña</span>
															<textarea name="resena" class="form-control"><?=$res=$row2["resena"];?></textarea>
													</div>		
								<?php  			} 
											} else {?> 
												<div class="input-group mb-3">
													<span class="input-group-text">Adscripción: </span>
													<input type="text" class="form-control" id="adscripcion" placeholder="Completa tu perfil"  name="adscripcion" value="<?=$ads;?>"required>
												</div>	
												<div class="input-group mb-3">
													<span class="input-group-text">N&uacute;mero de contacto</span>										
													<input type="tel" class="form-control" id="contacto" name="telefono" value="<?=$tel;?>" placeholder="+(00)1234567890" pattern="\+\([0-9]{2}\)[0-9]{10}"required>
												</div>	
												<div class="col-12">
														<span class="input-group-text">Reseña</span>
														<textarea name="resena" class="form-control" placeholder="Rese&ntilde;a"><?=$res;?></textarea>
												</div>
								<?php  		} 
									}	
								} ?>
								<input type="submit" class="btn btn-primary"value="Actualizar">
							</form>	
							
								<br>
								<br>
								<?php include'cambiarpass.php';?>								
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include'footer.php';?>
	<script src='funciones.js'>
	</script>

	<!-- Bootstrap 5 JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

	</body>
</html>
