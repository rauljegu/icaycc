<?php include 'settings.php'; //echo "status: ".$_SESSION["vacia"];//include settings ?>
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
		<?php 

			include 'funciones1.php';
			if($_SERVER["REQUEST_METHOD"] == "POST" ){
					 if($_GET["ac"] == 1 ){ubicaciones();}
					}				
			if($_SERVER["REQUEST_METHOD"] == "POST" ){
					 if($_GET["ac"] == 2 ){update_ubicaciones();}
					}
			
					 if($_GET["ac"] == 3 ){ac();
					
	
					 
					 }
						
			
					 if($_GET["ac"] == 4 ){desactivar_ubicaciones();}
							
	
		?>			
		<nav class="navbar navbar-inverse navbar-fixed-top">
		 <?php $menu=0; include 'activo.php';  include 'menu.php'; ?>
		</nav>
		<div class="container">
		<br/>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-8">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Superusuarios</h3>
						</div>
						<div class="panel-body">
							<div class="list-group">
							  <a href="#" class="list-group-item active">
								ACCIONES
							  </a>
							  <a href="usuario.php?id=0" class="list-group-item ">
								Ver Superusuarios
							  </a>
							  <a href="usuario_crear.php?id=0" class="list-group-item">Crear Superusuarios</a>
							  <a href="#" class="list-group-item" data-toggle="collapse" data-target="#ubicaciones">Ubicaciones internas</a>
							</div>
							<div class=" collapse" id="ubicaciones">
								<div class="panel panel-warning">
									<div class="panel-heading">
										<h3 class="panel-title">Registrar nueva ubicación</h3>
									</div>
									<div class="panel-body">
										<form method="POST"  action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF'].'?ac=1'); ?>">
											<p>Anaquel, Mesa o RACK: <input type="text" name="rack"></p>
											<!--<p># Niveles <input type="number" min="1" name="niveles"></p>
											<p># de Posiciones <input type="number" min="1" name="posicion"></p>-->
											<button type="submit" class="btn btn-default">Registrar</button>
										</form>
									</div>
								</div>																			
								<div class="panel panel-warning">
									<div class="panel-heading">
										<h3 class="panel-title">Lista de ubicaciónes</h3>
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-hover table-condensed">
												<tr class="info">
													<th>Anaquel, Mesa o RACK</th>
													<th>Acciones</th>
												</tr> 
													
										<?php
											$sql="SELECT * FROM ubicacion ";
											include 'conexion.php';
											$result= $conn->query($sql);
											//$filas = $result->num_rows;
											if ($result->num_rows > 0) {
												while($row= $result->fetch_assoc()) {
														if($row["activo"] == 0) { $class = "danger"; } else { $class = "success";}
													?>
													<tr class="<?=$class;?>">
														<td><?php echo $row['rack'] ?></td>														
														<td>
															<button type="button" class="btn btn-warning " data-toggle="modal" data-target="#myModal<?=$row['id_ubicacion'];?>">
																Editar
															</button>												
															<?php
																if($row["activo"] == 0 ){
															?>
															<button type="button" style="position:right"class="btn btn-warning "><a style="text-decoration:none;color:#fff;" href="<?php echo  htmlspecialchars($_SERVER["PHP_SELF"].'?ac=3&ub='.$row["id_ubicacion"]); ?>">
																<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Activar</a>
															</button>
															<?php } else { ?>
															<button type="button" style="position:right"class="btn btn-warning "><a style="text-decoration:none;color:#fff;" href="<?php echo  htmlspecialchars($_SERVER["PHP_SELF"].'?ac=4&ub='.$row["id_ubicacion"]); ?>">
																<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Desactivar</a>
															</button>
															<?php } ?>
														</td>
													</tr>
													<!-- Modal -->
													<div class="modal fade" id="myModal<?=$row['id_ubicacion'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Editar Ubicacion</h4>
															  </div>
															  <div class="modal-body">
																...
																<div class="panel panel-warning ">
																	<div class="panel-heading">
																		<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
																		<h2 class="panel-title">Datos</h2>
																	</div>
																	<div class="panel-body">
																		<form method="POST"  action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF'].'?ac=2&ub='.$row["id_ubicacion"]); ?>">
																		<p>Anaquel, Mesa o RACK: <input type="text" name="rack" value="<?=$row["rack"]?>" ></p>
																		<p># Niveles <input type="number" min="1" name="niveles" value="<?=$row["niveles"]?>"></p>
																		<p># de Posiciones <input type="number" min="1" name="posicion" value="<?=$row["posicion"]?>"></p>
												
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
													<!---->
													<?php
												}	
											
											}	
										?>
												
											</table>
										</div> <!--responsive table -->
									</div>
								</div>									
							</div><!--collapse-->
						</div><!-- /.panel body -->
					</div><!-- /.panel-succes -->
				</div><!-- /.col -->
			</div><!-- /.row -->
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
