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

  <body><?php include 'funciones_equ.php';
if($_SERVER["REQUEST_METHOD"] == "POST" ){
		 if($_GET["eq"] == 1 ){registro_equipo();}
		}
if($_SERVER["REQUEST_METHOD"] == "POST" ){
		 if($_GET["eq"] == 2 ){actualizar_equipo();}
		}
if($_SERVER["REQUEST_METHOD"] == "POST" ){
		 if($_GET["eq"] == 3 ){asignar_ipl();}
		}?>		
   
    <nav class="navbar navbar-inverse navbar-fixed-top">
     <?php $menu=4; include 'activo.php';  include 'menu.php'; ?>
    </nav>


    <div class="container">
	<br/>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-8">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Equipos</h3>
					</div>
					<div class="panel-body">
						
						<div class="list-group">
							<a href="#" class="list-group-item active">
								ACCIONES
							</a>	
		
							<button type="button" class="list-group-item btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
								Registrar equipo
							</button>

							<!-- Modal -->
							<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Registrar equipo</h4>
									  </div>
									  <div class="modal-body">
										...
										<div class="panel panel-warning ">
											<div class="panel-heading">
												<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
												<h2 class="panel-title">Equipo</h2>
											</div>
											<div class="panel-body">	
											<h3 id="nombreAPP">Información del equipo</h3>
											<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF'].'?eq=1'); ?>" method="POST">
											<p id="name" class="formulario registro">Nombre del equipo: <input type="text" name="nombre"></p>
											<p class="formulario registro">Responsable: <input type="text" name="responsable"></p>
											<p>Modelo: <input type="text" name="modelo"></p>
											<p>Etiqueta: <input type="text" name="etiqueta"></p>
											<p>Service TAG: <input type="text" name="servicetag"></p>
											<p>Fecha de registro: <input type="date" name="fecha" ></p>
											</div>
										</div>
										...
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<input  class="btn btn-primary" type="submit" value="Asignar">
									  </div>
									  </form>
									</div>
								</div>
							</div>
							
						</div>
					
						
						<?php
								//echo $numero;
								$sql="SELECT * FROM equipos ORDER BY id_equipo";
								//echo $sql;
								$result = $conn->query($sql);
								$filas = $result->num_rows;
								if ($result->num_rows > 0) {
									?>
						<div class="table-responsive">
						<?php	
									while($row= $result->fetch_assoc()) {
								?>
									<div class="panel panel-primary">
										<!-- Default panel contents -->
										<?php $name = $row["nombre"];?>
										<div class="panel-heading">	
											<?php echo  "<p>#".$row["id_equipo"]." ".$row["nombre"]."</p>";?>
											<!--<button type="button" style="position:right"class="btn btn-warning "><a style="text-decoration:none;color:#fff;" href="editar_server.php?id=<?php echo $row["id_servers"]; ?>">
												<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Editar</a>
											</button>-->
											<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal1<?php echo $row["id_equipo"];?>">
												<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span>Editar equipo
											</button>
											<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal2<?php echo $row["id_equipo"];?>">
												<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span>Asignar IP Local
											</button>
											
										</div>
											<table class="table table-hover table-condensed">
											
											<tr class="info">
								
												<th colspan="2">Responsable</th>
												<th colspan="2">Fecha de Registro</th>
											</tr>
											<tr>
												
												<td colspan="2"><?php echo $row["responsable"]; ?></td>
												<td colspan="2"><?php echo $row["fecha"]; ?></td>
											</tr>
											<tr class="success">
												
												<th colspan="4"><center>Info del equipo y descripcion</center></th>
											</tr>
											<tr class="success">
												<th>Service Tag</th>
												<th>Modelo</th>
												<th>Etiqueta</th>
												<th >Ip Local</th>
											</tr>
											<tr>											
												  <td><?php echo $row["servicetag"]; ?></td>
												  <td><?php echo $row["modelo"]; ?></td>												 
												  <td><?php echo $row["etiqueta"]; ?></td>
												  <td><?php
														include 'conexion.php';
														$sq="SELECT * FROM locales WHERE id_ipl = '".$row["id_locales"]."'";
														//echo $sq;
														$resul = $conn->query($sq);
														//$filas = $result->num_rows;
														if ($resul->num_rows > 0) {
															while($ro= $resul->fetch_assoc()) {
																echo "192.168.12.".$ro["direcciones"];
															}
														}	
													?>
												  </td>
											</tr>
																				
										</table>
										<div class="modal fade" id="myModal1<?php echo $row["id_equipo"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Editar equipo</h4>
									  </div>
									  <div class="modal-body">
										...
										<div class="panel panel-warning ">
											<div class="panel-heading">
												<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
												<h2 class="panel-title">Equipo</h2>
											</div>
											<div class="panel-body">	
											<h3 id="nombreAPP">Información del equipo</h3>
											<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF'].'?eq=2&id='.$row["id_equipo"]); ?>" method="POST">
											<p id="name" class="formulario registro">Nombre del equipo: <input type="text" name="nombre" value="<?php echo $row["nombre"];?>"></p>
											<p class="formulario registro">Responsable: <input type="text" name="responsable" value="<?php echo $row["responsable"];?>"></p>
											<p>Modelo: <input type="text" name="modelo" value="<?php echo $row["modelo"];?>"></p>
											<p>Etiqueta: <input type="text" name="etiqueta" value="<?php echo $row["etiqueta"];?>"></p>
											<p>Service TAG: <input type="text" name="servicetag" value="<?php echo $row["servicetag"];?>"></p>
											<p>Fecha de registro: <input type="date" name="fecha" value="<?php echo $row["fecha"];?>" ></p>
											</div>
										</div>
										...
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
										<input  class="btn btn-primary" type="submit" value="Actualizar">
									  </div>
									  </form>
									</div>
								</div>
							</div>
							<div class="modal fade" id="myModal2<?=$row["id_equipo"]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=3"); ?>" method="POST">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Asignar</h4>
												</div>
												<div class="modal-body">
													...
													<div class="panel panel-warning ">
														<div class="panel-heading">
															<h2 class="panel-title">Datos</h2>
														</div>
														<div class="panel-body">	
															<h3 id="nombreAPP">Información del equipo</h3>
															<p> Equipo: <input type="text"  name="equipo"  value="<?php echo $row["id_equipo"];?>" readonly>
																	
																</select>
															</p>
															<p> IP local<select  name="ip" required>
																	<option value="<?php echo $row["id_locales"]; ?>"><?php echo "192.168.12.".$row["id_locales"]; ?></option>
																	<option></option>
																	<?php
																	//if(empty($row["id_locales"])){
																	include 'conexion.php';
																	//$sql22="SELECT * FROM locales WHERE id_ipl = $i AND asignada = 0 ";
																	$sql22="SELECT * FROM locales WHERE id_ipl NOT IN( SELECT id_ipl FROM locales_asignadas WHERE activo = 1)";
																	
																	$result22= $conn->query($sql22);
																	//$filas = $result->num_rows;
																	if ($result22->num_rows > 0) {
																		while($row22= $result22->fetch_assoc()) {
																			echo '<option value="'.$row22["id_ipl"].'">192.168.12.'.$row22["direcciones"].'</option>';
																		}
																	}
																	$conn-> close;
									                              // } else { echo "<option>No Se puede asignar IP</option>";}
																	?>
																</select>
															</p>
															
														
															
															<p>Fecha de asignación <input type="date" name="fecha" value="<?=date("Y-m-d");?>" ></p>
														</div>
													</div>
													...
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
													<input  class="btn btn-primary" type="submit" value="Asignar">
												</div>
											</form>
										</div>
									</div>
								</div>


									</div>
								<?php }} ?>
						</div> <!-- DIV responsive -->
					
					
					</div>
				</div>
			</div>


			
		</div>

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
