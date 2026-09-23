<?php include 'settings.php'; //echo "status: ".$_SESSION["vacia"];//include settings 
	//var_dump($_POST);
	//include 'funciones.php'; //include funciones ?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">
	<title>Manager Site 5</title>
	<!-- Bootstrap core CSS -->
	<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/starter-template.css" rel="stylesheet">
	 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<script src="../../assets/js/ie-emulation-modes-warning.js"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	</head>
	<body>
	<?php include'funciones_ser.php';
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
				 if($_GET["eq"] == 1 ){registro();}
				}
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
				 if($_GET["eq"] == 2 ){dominio();}
				}		
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
				 if($_GET["eq"] == 3 ){asignar_dominio();}
				}		
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
				 if($_GET["eq"] == 4 ){actualizar_registro();}
				}		
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
				 if($_GET["eq"] == 5 ){quitar_dominio();}
				}		
		?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<?php $menu=1; include 'activo.php';  include 'menu.php'; ?>
	</nav>
	<div class="container">
	<br/>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-8">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Servidores</h3>
					</div>
					<div class="panel-body">				
						<div class="list-group">
							<a href="#" class="list-group-item active">
								ACCIONES
							</a>
							<button type="button" class="list-group-item btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
								Nuevo server
							</button>
							<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=1"); ?>" method="POST">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Registrar</h4>
											</div>
											<div class="modal-body">											
												<div class="panel panel-warning ">
													<div class="panel-heading">
														<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
														<h2 class="panel-title">Datos</h2>
													</div>
													<div class="panel-body">
														<h3 id="nombreAPP">Información del equipo</h3>														
														<p id="name" class="formulario registro">Nombre: <input type="text" name="server"></p>
														<p>Modelo: <input type="text" name="modelo"></p>
														<p>Etiqueta (No. inventario): <input type="number" name="etiqueta"></p>
														<p>Service TAG: <input type="text" name="servicetag"></p>
														<h3 id="nombreAPP">Ubicación</h3>
														<p><input type="radio" name="ubicacion" value="interno" data-toggle="collapse" data-target="#interno"> Interno (Site A5)</p>
														<p><input type="radio" name="ubicacion" value="externo" data-toggle="collapse" data-target="#externo"> Externo</p>
														<div class="collapse" id="externo">
															<p>Específique: <input type="text" name="externo1"></p>
														</div>
														<div class="collapse" id="interno">
															<?php 
																	include 'conexion.php';
																	$sql="SELECT * FROM ubicacion WHERE activo =1";
																	$result = $conn->query($sql);
																	//$filas = $result->num_rows;
																	if ($result->num_rows > 0) {
																		while($row= $result->fetch_assoc()) {
																			$rack = $rack."<option value='".$row["rack"]."'>".$row["rack"]."</option>";
																																																							
																		}
																	}
															?>		
															<p>RACK: <select name="rack" >
																	<option ></option>																	
																	<option value="NA">NA</option>
																	<?=$rack;?>
																</select>
															</p>
															<p>Nivel: <select name="nivel" >
																	<option ></option>
																	<option value="0">NA</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																</select>
															</p>
															<p>Posición: <select name="posicion" >
																	<option ></option>
																	<option value="0">NA</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																</select>
															</p>
														</div>
														<p>Puerto: <input type="text" name="puerto"></p>
														<h3 id="nombreAPP">Configuración</h3>
														<p>Dirección IP Pública: <input type="text" name="ippublica"></p>
														<p>IP local: <select  name="iplocal" >
																<option ></option>
															<?php
																include 'conexion.php';
																
																$sql="SELECT * FROM locales WHERE id_ipl NOT IN( SELECT id_ipl FROM locales_asignadas WHERE activo = 1)";
																$result = $conn->query($sql);
																//$filas = $result->num_rows;
																if ($result->num_rows > 0) {
																	while($row= $result->fetch_assoc()) {
																		echo '<option value="'.$row["id_ipl"].'">192.168.12.'.$row["direcciones"].'</option>';
																	}
																}
																$conn-> close;
															?>
															</select>
														</p>																											
														<p>Status: <select name="status" required>
																<option ></option>
																<option value="ON">ON</option>
																<option value="OFF">OFF</option>
															</select>
														</p>
														<h3 id="nombreAPP">Descripción</h3>
														<p>Tipo: <input type="text" name="tipo" ></p>
														<p>Contenido: <textarea name="contenido"></textarea></p>
													</div>
												</div>											
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
												<input  class="btn btn-primary" type="submit" value="REGISTRAR">
											</div>
										</form>
									</div>
								</div>
							</div>
							<button type="button" class="list-group-item btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal0">
								Nuevo dominio
							</button>
							<!-- Modal -->
							<div class="modal fade" id="myModal0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=2"); ?>" method="POST">	
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Registrar dominio</h4>
											</div>
											<div class="modal-body">
											
												<div class="panel panel-warning ">
													<div class="panel-heading">
														<h2 class="panel-title">Datos</h2>
													</div>
													<div class="panel-body">
														<p id="name" class="formulario registro">dominio<input type="text" name="dominio"></p>
													</div>
												</div>
											
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
												<input  class="btn btn-primary" type="submit" value="REGISTRAR DOMINIO">
											</div>
										</form>
									</div>
								</div>
							</div>																			
						</div>			
						<?php
						//echo $numero;
						$sql="SELECT * FROM servers ORDER BY id_servers";
						//echo $sql;
						$result = $conn->query($sql);
						$filas = $result->num_rows;
						if ($result->num_rows > 0) {	
							while($row= $result->fetch_assoc()) { $serv= $row["id_servers"];
						?>
						<div class="table-responsive">
							<div class="panel panel-primary">
								<!-- Default panel contents -->
								<div class="panel-heading">	
									<?php echo  "<p>#".$serv." ".$row["server"]." Status: ".$row["status"]."</p>";?>
									<!--<button type="button" style="position:right"class="btn btn-warning "><a style="text-decoration:none;color:#fff;" href="editar_server.php?id=<?php echo $row["id_servers"]; ?>">-->
									<button type="button" class=" btn btn-warning" data-toggle="modal" data-target="#myModal1<?=$serv;?>">									
										<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Editar
									</button>
									<button type="button" class=" btn btn-warning" data-toggle="modal" data-target="#myModal<?=$serv;?>">	
										<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Asignar Dominio
									</button>
									<button type="button" class=" btn btn-warning" data-toggle="modal" data-target="#myModal2<?=$serv;?>">	
										<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Quitar Dominio
									</button>
								</div>
								<table class="table table-hover table-condensed">
									<tr class="info">
										<th colspan="7"><center>Ubicacion <?= $row["ubicacion"]?>/ Configuración</center></th>
									</tr>									
								<?php 
								if($row["ubicacion"]== "externo"){
									echo "
									<tr class='info'>	
										<th colspan='3'>Lugar físico</th>
										<th>Ip Publica</th>
										<th>Ip Local</th>
										<th>Dominio</th>
										<th>Puerto</th>
									</tr>
									<tr>
										<td colspan='3'>".$row['externo1']."</td>
										";	
									?>
										<td><?php echo $row["ippublica"]; ?></td>
										<td><?php 
												include 'conexion.php';
												$sql1="SELECT id_ipl FROM locales_asignadas WHERE id_servers = ".$row['id_servers']." AND activo = 1;";
												$result1 = $conn->query($sql1);
												$filas = $result1->num_rows;
												if ($result1->num_rows > 0) {
													while($row1= $result1->fetch_assoc()) { 
														echo "192.168.12.".$ip=$row1['id_ipl'];
													}
												} $conn->close;
											?>
										</td>
										<td><?php 
												include 'conexion.php';
												/*$sql2="SELECT dominio FROM dominios WHERE id_dominios = ".$row['dominio'];*/
												$sql2="SELECT dominio FROM dominios INNER JOIN dominios_asignados ON dominios.id_dominios = dominios_asignados.id_dominios WHERE dominios_asignados.id_servers='$serv' AND dominios_asignados.activo = 1";
												$result2 = $conn->query($sql2);
												$filas = $result2->num_rows;
												if ($result2->num_rows > 0) { echo"<ul>";
													while($row2= $result2->fetch_assoc()) { 
														echo "
																	<li>https://".$row2['dominio']."</li>";
													} echo "</ul>";
												} $conn->close;
											?>
										</td>
										<td><?php echo $row["puerto"]; ?></td>									
								<?php
									echo 
									"</tr>";
								} else { 
									 echo"
									<tr class='info'>
										<th>RACK</th>
										<th>Nivel</th>
										<th>Posicion</th>
										<th>Ip Publica</th>
										<th>Ip Local</th>
										<th>Dominio</th>
										<th>Puerto</th>
									</tr>
									<tr>	
										<td>".$row["rack"]."</td>
										<td>".$row["nivel"]."</td>
										<td>".$row["posicion"]."</td>									
										<td>".$row["ippublica"]."</td>
										<td>";
												include 'conexion.php';
												$sql1="SELECT id_ipl FROM locales_asignadas WHERE id_servers = ".$row['id_servers']." AND activo = 1;";
												$result1 = $conn->query($sql1);
												$filas = $result1->num_rows;
												if ($result1->num_rows > 0) {
													while($row1= $result1->fetch_assoc()) { 
														echo "192.168.12.".$ip=$row1['id_ipl'];
													}
												} $conn->close;
									echo"	
										</td>
										<td>"; 
												include 'conexion.php';
												/*$sql2="SELECT dominio FROM dominios WHERE id_dominios = ".$row['dominio'];*/
												$sql2="SELECT dominio FROM dominios INNER JOIN dominios_asignados ON dominios.id_dominios = dominios_asignados.id_dominios WHERE dominios_asignados.id_servers='$serv' AND dominios_asignados.activo = 1";
												$result2 = $conn->query($sql2);
												$filas = $result2->num_rows;
												if ($result2->num_rows > 0) { echo "<ul>";
													while($row2= $result2->fetch_assoc()) { 
														echo "<li>https://".$row2['dominio']."</li>";
													} echo "</ul>";
												} $conn->close;
									echo"
										</td>
										<td>".$row["puerto"]."</td>
									</tr>";
								}
								?>	
									<tr class="success">
										<th colspan="7"><center>Info del equipo y descripcion</center></th>
									</tr>
									<tr class="success">
										<th colspan="3">Contenido</th>
										<th>Tipo</th>
										<th>Modelo</th>
										<th>Etiqueta</th>
										<th >Service Tag</th>
									</tr>
									<tr>
										<td colspan="3"><?php echo $row["contenido"]; ?></td>
										<td><?php echo $row["tipo"]; ?></td>
										<td><?php echo $row["modelo"]; ?></td>
										<td><?php echo $row["etiqueta"]; ?></td>
										<td><?php echo $row["servicetag"]; ?></td> 
									</tr>									
								</table>
							</div>
						</div> <!-- DIV responsive -->		
						<div class="modal fade" id="myModal<?=$serv;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=3&server=".$serv); ?>" method="POST">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Asignar dominio</h4>
										</div>
										<div class="modal-body">
											
											<div class="panel panel-warning ">
												<div class="panel-heading">
													<h2 class="panel-title"># <?= $serv." ".$row["server"]?></h2>
												</div>
												<div class="panel-body">
													<p>Seleccione un dominio: <select  name="dominio" required>
															<option ></option>
															<?php
															include 'conexion.php';
															$sql11="SELECT * FROM dominios WHERE id_dominios NOT IN (SELECT id_dominios FROM dominios_asignados WHERE id_servers ='$serv')" ;
															$result11 = $conn->query($sql11);
															//$filas = $result->num_rows;
															if ($result11->num_rows > 0) {
																while($row11= $result11->fetch_assoc()) {
																	echo '<option value="'.$row11["id_dominios"].'">'.$row11["dominio"].'</option>';
																}
															}
															$conn-> close;
															?>
														</select>
													</p>
													
												</div>
											</div>
											
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
											<input  class="btn btn-primary" type="submit" value="ASIGNAR DOMINIO">
										</div>
									</form>
								</div>
							</div>
						</div>	
						<div class="modal fade" id="myModal1<?=$serv;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=4&id=".$serv); ?>" method="POST">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Editar</h4>
											</div>
											<div class="modal-body">
											<?php
												$sqled="SELECT * FROM servers WHERE id_servers = '".$serv."' ORDER BY id_servers";
												//echo $sql;
												$resulted = $conn->query($sqled);
												$filased = $resulted->num_rows;
												if ($resulted->num_rows > 0) {
													while($rowed= $resulted->fetch_assoc()) { if(empty($rowed["iplocal"])){ $iplocal = NULL;} else { $iplocal= $rowed["iplocal"];}
											?>
												<div class="panel panel-warning ">
													<div class="panel-heading">
														<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
														<h2 class="panel-title">Datos</h2>
													</div>
													<div class="panel-body">
														<h3 id="nombreAPP">Información del equipo</h3>														
														<p id="name" class="formulario registro">Nombre: <input type="text" name="server" value="<?=$rowed["server"];?>"></p>
														<p>Modelo: <input type="text" name="modelo" value="<?=$rowed["modelo"];?>"></p>
														<p>Etiqueta (No. inventario): <input type="text" name="etiqueta" value="<?=$rowed["etiqueta"]?>"></p>
														<p>Service TAG: <input type="text" name="servicetag" value="<?=$rowed["servicetag"];?>"></p>
														<h3 id="nombreAPP">Ubicación</h3>
														<p><input type="radio" name="ubicacion" value="interno" <?php if($rowed["ubicacion"] == "interno"){echo "checked";}?> data-toggle="collapse" data-target="#interno1"> Interno (Site A5)</p>
														<p><input type="radio" name="ubicacion" value="externo" <?php if($rowed["ubicacion"] == "externo"){echo "checked";}?> data-toggle="collapse" data-target="#externo1"> Externo</p>
														<div class="collapse <?php if($rowed["ubicacion"] == "externo"){echo "in";}?>" id="externo1">
															<p>Específique: <input type="text" name="externo1" value="<?=$rowed["externo1"];?>"></p>
														</div>
														<div class="collapse <?php if($rowed["ubicacion"] == "interno"){echo "in";}?>" id="interno1">
															<p>RACK: <select name="rack" >
																	<option value="<?php echo $rowed["rack"]; ?>"><?php echo $rowed["rack"]; ?></option>
																	<?php
																	include 'conexion.php';
																	$sql1="SELECT * FROM ubicacion WHERE activo =1";
																	$result1 = $conn->query($sql1);
																	//$filas = $result->num_rows;
																	if ($result1->num_rows > 0) {
																		while($row1= $result1->fetch_assoc()) {
																			$rack1 = $rack."<option value='".$row1["rack"]."'>".$row1["rack"]."</option>";
																																																							
																		}
																	} $conn-->close;
															?>																
																	
																	
																	<option ></option>
																	<option value="NA">NA</option>
																	<?=$rack;?>
																</select>
															</p>
															<p>Nivel: <select name="nivel" >
																	<option value="<?php echo $rowed["nivel"]; ?>">
																	<?php
																		echo $rowed["nivel"];																
																	?>
																	</option>
																	<option ></option>
																	<option value="0">NA</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																</select>
															</p>
															<p>Posición: <select name="posicion" >
																	<option value="<?php echo $rowed["posicion"]; ?>"><?php echo $rowed["posicion"];?></option>
																	<option ></option>
																	<option value="0">NA</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																</select>
															</p>
														</div>
														<p>Puerto: <input type="text" name="puerto" value="<?=$rowed["puerto"]?>"></p>
														<h3 id="nombreAPP">Configuración</h3>
														<p>Dirección IP Pública: <input type="text" name="ippublica" value="<?=$rowed["ippublica"]?>"></p>
														<p>IP local: <select  name="iplocal" >
																<option  value="<?php echo $iplocal; ?>">192.168.12.<?php echo $iplocal; ?></option>
																<option ></option>
															<?php
																include 'conexion.php';
																
																$sql2="SELECT * FROM locales WHERE id_ipl NOT IN( SELECT id_ipl FROM locales_asignadas WHERE activo = 1)";
																$result2 = $conn->query($sql2);
																//$filas = $result->num_rows;
																if ($result2->num_rows > 0) {
																	while($row2= $result2->fetch_assoc()) {
																		echo '<option value="'.$row2["id_ipl"].'">192.168.12.'.$row2["direcciones"].'</option>';
																	}
																}
																$conn-> close;
															?>
															</select></p>																																							
														<p>Status: <select name="status" required>
																<option value="<?php echo $row["status"]; ?>"><?php echo ($rowed["status"] == "ON") ?  "ON" : (($rowed["status"] == "OFF") ? "OFF" : "Otro");?></option>
																<option ></option>
																<option value="ON">ON</option>
																<option value="OFF">OFF</option>
															</select>
														</p>
														<h3 id="nombreAPP">Descripción</h3>
														<p>Tipo: <input type="text" name="tipo" value="<?=$rowed["tipo"]?>"></p>
														<p>Contenido: <textarea name="contenido"><?=$rowed["contenido"]?></textarea></p>
													</div>
												</div>
											<?php
													}
												}
											?>			
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
												<input  class="btn btn-primary" type="submit" value="Actualizar">
											</div>
										</form>
									</div>
								</div>
							</div>	
						<div class="modal fade" id="myModal2<?=$serv;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=5&server=".$serv); ?>" method="POST">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Quitar dominio</h4>
										</div>
										<div class="modal-body">											
											<div class="panel panel-warning ">
												<div class="panel-heading">
													<h2 class="panel-title"># <?= $serv." ".$row["server"]?></h2>
												</div>
												<div class="panel-body">
													<p>Seleccione un dominio: <select  name="dominio" required>
															<option ></option>
															<?php
															include 'conexion.php';
															$sql11="SELECT * FROM dominios WHERE id_dominios  IN (SELECT id_dominios FROM dominios_asignados WHERE id_servers ='$serv')" ;
															$result11 = $conn->query($sql11);
															//$filas = $result->num_rows;
															if ($result11->num_rows > 0) {
																while($row11= $result11->fetch_assoc()) {
																	echo '<option value="'.$row11["id_dominios"].'">'.$row11["dominio"].'</option>';
																}
															}
															$conn-> close;
															?>
														</select>
													</p>													
												</div>
											</div>											
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
											<input  class="btn btn-primary" type="submit" value="QUITAR DOMINIO">
										</div>
									</form>
								</div>
							</div>
						</div>	
											<?php 
							}
						} ?>
					</div><!-- /.panel-body -->
				</div><!-- /.panel pane-success -->
			</div><!-- /.col -->
		</div>	<!-- /.row -->
	</div><!-- /.container -->


	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
	<script src="../../assets/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>
