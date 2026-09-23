<?php // include 'settings.php'; 
$name =basename($_SERVER["PHP_SELF"]);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Configuraciones">
		<title>Configuraciones</title>
		
		<!-- Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- SweetAlert2 -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		
		<link href="css/starter-template.css" rel="stylesheet">
		 <link href="../../assets/estilo.css" rel="stylesheet">
	</head>
	<body>
		<div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>
		<nav class="navbar navbar-dark fixed-top" style="background-color: #002B7A;">
			<div class="container-fluid" id="menu-container">
				<?php  	include'menu.php'; 
						include'funciones.php'; 
						//echo $ultimo;
						$a=0;
						if(isset($_GET["p"])){
							$perfil = $_GET["p"];
							echo '<script>
											document.addEventListener("DOMContentLoaded", function() {
											var boton = document.querySelector("[data-bs-target=\'#collapseExample'.$perfil.'\']");
            
											function activarBoton() {
												if (boton) {
													boton.click();
												}
											}

											// Espera 2 segundos antes de hacer clic en el botón
											setTimeout(activarBoton, 1550);
											});
								</script>';
						} else { $perfil = "";}
						if(isset($_GET["alerta"])){
							if($_GET["alerta"] == 1){
								 echo "
										<script>
										const Toast = Swal.mixin({
											toast: true,
											position: 'center',
											showConfirmButton: false,
											timer: 1500,
											timerProgressBar: true,
											didOpen: (toast) => {
												toast.onmouseenter = Swal.stopTimer;
												toast.onmouseleave = Swal.resumeTimer;
											}
										});

										Toast.fire({
											icon: 'success',
											title: 'Perfil Añadido'
										});
										</script>";
							}
						}
						if(isset($_GET["ok"])){
									 if($_GET["ok"] == 0 ){tipopub();}
						}
						if(isset($_GET["ok"])){
									 if($_GET["ok"] == 1 ){tema();}
						}
						if(isset($_GET["ok"])){
							if($_GET["ok"] == 2 ){
								if($_GET["b"] > 0 ){
									$b=$_GET["b"];										
								} else {
										$b=0;
										}
							revisor($b);
							}
						}
						if(isset($_GET["ok"])){
							if(isset($_GET["b"])){$b=$_GET["b"];}	
									 if($_GET["ok"] == 3 ){editor($b);}
						}
						if(isset($_GET["ok"])){
							if(isset($_GET["b"])){$b=$_GET["b"];}	
									 if($_GET["ok"] == 4 ){disenador($b);}
						}
						if(isset($_GET["ac"])){
									 if($_GET["ac"] == 0 ){desactivar_conf();}
						}
						if(isset($_GET["ac"])){
									 if($_GET["ac"] == 1 ){activar_conf();}
						}
						if(isset($_GET["ac"])){
									 if($_GET["ac"] == 2 ){qtema();}
						}
				?>
			</div>
		</nav>
		<div class="container mt-5 pt-5 content">
			<div class="row">
				<div class="col-md-6 mx-auto">
					<div class="card bg-primary text-white">
						<div class="card-header">Configuraciones</div>
						<div class="card-body bg-light text-dark">                       					  
							<div class="d-grid gap-2">					
								<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample6" aria-expanded="false" aria-controls="collapseExample">
									Ver Tipos de Publicaciones
								</button>					
								<div class="collapse" id="collapseExample6">
									<div class="card card-body">
										<table class="table">
											<thead>
												<tr>
													<th>Tipo de Publicación</th>
													<th>Descripción</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody>
											<?php
												include'conexion.php';
												$tp="SELECT * FROM tipo_publicacion";
												//echo $tp;
												$resulttp=$conn->query($tp);
												if($resulttp->num_rows > 0){
													while($rowtp=$resulttp->fetch_assoc()){?>
													<tr>
														<td><?php echo $rowtp["tipo"]; ?></td>
														<td><?php echo $rowtp["descripcion"]; ?></td>
														<td><?php if($rowtp["activo"] == 1){ ?> 
															<a class='btn btn-danger' href='administrar.php?ac=0&t=1&id=<?=$rowtp["id_tipopub"];?>' style='text-decoration:none'>Desactivar</a>
															<?php } else { ?> 
															<a class='btn btn-success' href='administrar.php?ac=1&t=1&id=<?=$rowtp["id_tipopub"];?>' style='text-decoration:none'>Activar</a>	
															<?php } ?>
														</td>
													</tr>	
												<?php		
													}
												} else {?>  
												<tr>
													<td colspan="4"><center>No hay Tipos de publicaciones.</center></td>
												</tr>
											<?php 
												}
											?>	
											</tbody>
										</table>
									</div>
								</div>
								<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample7" aria-expanded="false" aria-controls="collapseExample">
									Añadir Tipos de Publicaciones
								</button>	
								<div class="collapse" id="collapseExample7">
									<div class="card card-body">
										<form id="loginForm" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?ok=0"); ?>" >		 
											<h2>Añade Tipo de Publicacion </h2>					 
											<div class="col-md-6">
												<label for="tipo" class="form-label">Tipo de publicacíon</label>
												<input type="text" class="form-control" id="tipo" name="tipo" >
											</div> 
											<div class="col-md-6">
												<label for="descripcion" class="form-label">Descripción</label>
												<textarea class="form-control" id="descripcion" name="descripcion" ></textarea>
											</div>	
											<input type="submit" class="btn btn-primary" value="Añadir">																		 										
										</form>
									</div>
								</div>
							</div>
							<br>   						
							<div class="d-grid gap-2">					
								<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample8" aria-expanded="false" aria-controls="collapseExample">
									Ver Temas
								</button>					
								<div class="collapse" id="collapseExample8">
									<div class="card card-body">
										<table class="table">
											<thead>
												<tr>
													<th>Temas</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody>
											<?php
											include'conexion.php';
												$tem="SELECT * FROM temas";
												//echo $tp;
												$resulttem=$conn->query($tem);
												if($resulttem->num_rows > 0){
													while($rowtem=$resulttem->fetch_assoc()){?>
												<tr>
													<td><?php echo $rowtem["tema"]; ?></td>
													<td><?php if($rowtem["activo"] == 1){ ?> 
														<a class='btn btn-danger' href='administrar.php?ac=0&t=2&id=<?=$rowtem["id_tema"];?>' style='text-decoration:none'>Desactivar</a>
														<?php } else { ?> 
														<a class='btn btn-success' href='administrar.php?ac=1&t=2&id=<?=$rowtem["id_tema"];?>' style='text-decoration:none'>Activar</a>	
														<?php } ?>
													</td>
												</tr>	
												<?php		
													}
												} else {
											?>  <tr>
													<td colspan="4"><center>No hay Temas Registrados.</center></td>
												</tr>
											<?php 
											}
											?>	
											</tbody>
										</table>
									</div>
								</div>
								<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample9" aria-expanded="false" aria-controls="collapseExample">
										Añadir Temas
								</button>	
								<div class="collapse" id="collapseExample9">
									<div class="card card-body">
										<form id="loginForm1" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?ok=1"); ?>" >		 
											<h2>Añade un Tema </h2>					 
											<div class="col-md-6">
												<label for="temas" class="form-label">Temas</label>
												<input type="text" class="form-control" id="temas" name="tema" >
											</div> 									
											<input type="submit" class="btn btn-primary" value="Enviar">																		 										
										</form>
									</div>
								</div>												
							</div>
						</div>
					</div>
					<br>
					<br>
				</div>
				<div class="col-md-6 mx-auto">			
					<div class="card bg-primary text-white">
						<div class="card-header">Activar Perfiles</div>
						<div class="card-body bg-light text-dark">
							<div class="d-grid gap-2">
								<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample0" aria-expanded="false" aria-controls="collapseExample">
									Crear Usuario
								</button>
							</div>
							<div class="collapse" id="collapseExample0">
								<div class="card card-body">
									<form id="registroForm"  action="<?php echo htmlspecialchars("registro.php"); ?>" method="POST" autocomplete="off">		 
										<h2>Añade Usuario</h2>					 
										<div class="col-md-12">
											<div class="input-group mb-3">
												<span class="input-group-text">Nombres:</span>
												<input type="text" class="form-control" id="nombre" name="nombre">
											</div> 
											<div class="input-group mb-3">
												<span class="input-group-text">Primer Apellido:</span>
												<input type="text" class="form-control" id="paterno" name="paterno">
											</div> 
											<div class="input-group mb-3">
												<span class="input-group-text">Segundo Apellido:</span>
												<input type="text" class="form-control" id="materno" name="materno">
											</div>
											<div class="input-group mb-3">
												<span class="input-group-text">Correo de contacto:</span>
												<input type="email" class="form-control" id="correo" name="correo" required>
											</div>
											<div class="input-group mb-3">
												<span class="input-group-text" hidden>Contraseña:</span>
												<input type="password" class="form-control" id="pass" name="pass" autocomplete="new-password" value="Abc/1234"  required readonly hidden>
											</div>  
											<label for="rol" class="form-label">Roles</label>
											<div class="input-group mb-3">
												<select class="form-select" id="rol" name="rol" aria-label="rol">
													<option selected>Selecciona un rol</option>
													<?php include'conexion.php';
														$rol="SELECT * FROM roles WHERE tipo =  2 OR tipo =  3 OR tipo =  5 ";
														//echo $rol;
														$resultrol = $conn->query($rol);
														if($resultrol->num_rows > 0) {
															$optionrol="";
																while ($rowrol = $resultrol->fetch_assoc()){
																		$optionrol .= " <option value=".$rowrol["tipo"].">".$rowrol["rol"]."</option>";
																}
														}	
													echo $optionrol;
													?>
												</select>
											</div>
											<div class="input-group mb-3">
												<input  type="submit" class="form-control btn btn-primary" value="Añadir">
											</div>									
										</div> 									
									</form>
								</div>
							</div>					
							<br>
							<div class="d-grid gap-2">
								<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample100" aria-expanded="false" aria-controls="collapseExample">
									Ver Revisores
								</button>					
								<div class="collapse" id="collapseExample100">
									<div class="card card-body">
									<div class="table-responsive-xxl">
										<table class="table table-sm">
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Primer Apellido</th>
													<th>Segundo Apellido</th>
													<th>Correo</th>
													<th>Temas</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody>
											<?php
												$sql="SELECT `name`,`correo`,`paterno`,`materno`,`id`,temas,revisores.activo,revisores.id_revisor FROM users  
													INNER JOIN revisores  
													ON users.id=revisores.id_user 
													WHERE users.role = 2 
													AND users.id  IN (SELECT id_user FROM revisores);";
													//echo$sql;
												$result=$conn->query($sql);
												if($result->num_rows > 0){
													while($row=$result->fetch_assoc()){?>
												<tr>
													<td><?php echo $row["name"]; ?></td>
													<td><?php echo $row["paterno"]; ?></td>
													<td><?php echo $row["materno"]; ?></td>
													<td><?php echo $row["correo"]; ?></td>
													<td><?php //echo $row["temas"];										
													$temas = is_string($row['temas']) ? explode(", ", $row['temas']) : $row['temas']; 
													// Si temas está vacío, asignar un array vacío para evitar errores
													$tems = !empty($temas) ? $temas : [];
													$t = count($tems); // Contar solo si es un array válido
													if(!empty($t)){
														for( $i=0; $i <= $t; $i++) {														
															 $tt = $tems[$i];
															 include'conexion.php';
															 $temss="SELECT * FROM temas WHERE tema = '$tt'";
															// echo $temss;
															 $res=$conn->query($temss);
															 if($res->num_rows > 0) {
																 while($rowtt=$res->fetch_assoc()){
																	 echo "<p>".$rowtt['tema']."</p>";
																	 echo"<a class='btn btn-danger' href='administrar.php?ac=2&id=".$rowtt["id_tema"]."&rev=".$row["id_revisor"]."' style='text-decoration:none'>Quitar tema</a>";
																 }
															 }	 
														}
													}
													?>
													</td>
													<td><?php if($row["activo"] == 1){ ?> 
														<a class='btn btn-danger' href='administrar.php?ac=0&t=3&id=<?=$row["id"];?>' style='text-decoration:none'>Desactivar</a>
														<?php } else { ?> 
														<a class='btn btn-success' href='administrar.php?ac=1&t=3&id=<?=$row["id"];?>' style='text-decoration:none'>Activar</a>	
														<?php } ?>
													</td>
												</tr>	
												<?php		
													}
												} else {
											?> 
												<tr>
													<td colspan="6"><center>No hay Revisores con temas seleccionados.</center></td>
												</tr>
											<?php 
											}
											?>	
											</tbody>
										</table>	
									</div>
									</div>
								</div>							
									<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
										Asignar Temas a Revisores
									</button>						
								<div class="collapse" id="collapseExample1">
									<div class="card card-body">
										<form class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?ok=2&b=0"); ?>" >		 
											<h2>Asignar Tema.</h2>					 
											<?php include'conexion.php';
												$revisor="SELECT id, name, paterno, materno FROM users WHERE role = 2 AND id IN(SELECT id_user FROM revisores)ORDER BY paterno ASC";
												//echo $revisor;
												$resultrevisor = $conn->query($revisor);
												if($resultrevisor->num_rows > 0) {
													$optionrevisor=""; ?>
													<div class="col-md-6">	
														<label for="revisor" class="form-label">Selecciona un perfil</label>
														<select class="form-select" id="revisor" name="revisor" aria-label="tipo">
														<option selected>Selecciona una opci&oacute;n</option>
											  <?php
															while ($rowrevisor = $resultrevisor->fetch_assoc()){
																	$optionrevisor .= " <option value=".$rowrevisor["id"].">".$rowrevisor["name"]." ".$rowrevisor["paterno"]." ".$rowrevisor["materno"]."</option>";
															}	
													echo $optionrevisor;
											 ?>
														</select>
													</div> 
													<div class="col-12">														
														<label for="temas<?=++$a;?>" class="form-label">Tema</label>
														<div id="temas-container">
															<div class="input-group mb-2">
																<?php 
																	include'conexion.php';
																	$temas ="SELECT tema FROM temas t
																			WHERE activo = 1 
																			AND NOT EXISTS (
																				SELECT 1 
																				FROM revisores r 
																				WHERE r.temas LIKE CONCAT('%', t.tema, '%')
																							)";
																							//echo $temas;
																	$rtemas =$conn->query($temas);
																	$topt="";
																	if($rtemas->num_rows > 0 ){																											?>
																		<select type="text" class="form-select" id="temas1"  name="temas[]"  placeholder="Agregar tema">														
																		<?php				
																				while($rowtemas=$rtemas->fetch_assoc() ){																	
																					$topt .= "<option style='color:green;'value='".$rowtemas["tema"]."'>".$rowtemas["tema"]."</option>";
																				}
																			}
																			echo $topt;
																		?>			
																		</select>
																<button type="button" class="btn btn-danger remove-tema" style="display:none;">X</button>
															</div>
														</div>
														<button type="button" id="add-tema" class="btn btn-secondary mt-2">Agregar Tema</button>
													</div>
													<input type="submit" class="btn btn-primary" value="Activar">	
										<?php 
													} else { ?>		
																<p>Primero debe crear un usuario con el perfil revisor en Configuraciones > A&ntilde;adir usuario</p>	
											<?php   } ?>										
										</form>
									</div>
								</div>
							</div>
							<br>						
							<div class="d-grid gap-2">
								<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
									Ver Editores
								</button>
								<div class="collapse" id="collapseExample2">
									<div class="card card-body table-responsive-sm">
									<div class="table-responsive-sm">
										<table class="table table-sm">
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Primer Apellido</th>
													<th>Segundo Apellido</th>
													<th>Correo</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sql="SELECT `correo`,`name`,`paterno`,`materno`,`id`,editores.activo FROM users  
															INNER JOIN editores  
															ON users.id=editores.id_user 
															WHERE users.role = 3 
															AND users.id  IN (SELECT id_user FROM editores);";
													$result=$conn->query($sql);
													if($result->num_rows > 0){
														while($row=$result->fetch_assoc()){?>
															<tr>
																<td><?php echo $row["name"]; ?></td>
																<td><?php echo $row["paterno"]; ?></td>
																<td><?php echo $row["materno"]; ?></td>
																<td><?php echo $row["correo"]; ?></td>
																<td><?php if($row["activo"] == 1){ ?> 
																	<a class='btn btn-danger' href='administrar.php?ac=0&t=4&id=<?=$row["id"];?>' style='text-decoration:none'>Desactivar</a>
																	<?php } else { ?> 
																	<a class='btn btn-success' href='administrar.php?ac=1&t=4&id=<?=$row["id"];?>' style='text-decoration:none'>Activar</a>	
																	<?php } ?>
																</td>
															</tr>	
													<?php		
														}
													} else {
													?>  
														<tr>
															<td colspan="5"><center>No hay Editores aún.</center></td>
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
							<br>
							<div class="d-grid gap-2">
								<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
									Ver Diseñadores
								</button>													
								<div class="collapse" id="collapseExample4">
									<div class="card card-body">
										<table class="table">
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Primer Apellido</th>
													<th>Segundo Apellido</th>
													<th>Correo</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody>
											<?php
												$sql="SELECT * FROM diseniadores INNER JOIN users ON diseniadores.id_user=users.id";
												$result=$conn->query($sql);
												if($result->num_rows >0){
													while($row=$result->fetch_assoc()){?>
												<tr>
													<td><?php echo $row["name"]; ?></td>
													<td><?php echo $row["paterno"]; ?></td>
													<td><?php echo $row["materno"]; ?></td>
													<td><?php echo $row["correo"]; ?></td>
													<td><?php if($row["activo"] == 1){ ?> 
																	<a class='btn btn-danger' href='administrar.php?ac=0&t=5&id=<?=$row["id"];?>' style='text-decoration:none'>Desactivar</a>
														<?php   } else { ?> 
																			<a class='btn btn-success' href='administrar.php?ac=1&t=5&id=<?=$row["id"];?>' style='text-decoration:none'>Activar</a>	
														<?php 	} ?>
													</td>
												</tr>	
												<?php		
													}
												} else {
											?>  
												<tr>
													<td colspan="5"><center>No hay Editores aún.</center></td>
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
					<br>
					<br>
					<br>
					<br>
					<br>
				</div>
			</div>
		</div>
	   <?php include'footer.php'; ?>
		<!-- Bootstrap 5 JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
<script src='fadmi.js'></script>

