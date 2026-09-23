<?php include 'settings.php'; //echo "status: ".$_SESSION["vacia"];//include settings 
	//var_dump($_POST);
//	include 'funciones.php'; //include funciones ?>

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
  <body><?php include 'funciones_ipl.php';
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
				 if($_GET["eq"] == 1 ){registro_equipo();}
				}
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
				 if($_GET["eq"] == 2 ){asignar_ipl();}
				}
	
				 if(isset($_GET["eq"]) ){ 
					$eq = $_GET["eq"];	 
					if($eq == 3 ){liberar();}
				} 
		?>			
    <nav class="navbar navbar-inverse navbar-fixed-top">
     <?php $menu=2; include 'activo.php';  include 'menu.php'; ?>
    </nav>
    <div class="container">
	<br/>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-8">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">IP Locales</h3>
					</div>
					<div class="panel-body">	
						<div class="list-group">
							<a href="#" class="list-group-item active">
								ACCIONES
							</a>
							<button type="button" class="list-group-item btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
								Registrar equipo
							</button>
							<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF'].'?eq=1'); ?>" method="POST">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Registrar equipo</h4>
											</div>
											<div class="modal-body">
												...
												<div class="panel panel-warning ">
													<div class="panel-heading">
														<h2 class="panel-title">Equipo</h2>
													</div>
													<div class="panel-body">	
														<h3 id="nombreAPP">Información del equipo</h3>
														<p id="name" class="formulario registro">Nombre del equipo: <input type="text" name="nombre"></p>
														<p class="formulario registro">Responsable: <input type="text" name="responsable"></p>
														<p>Modelo: <input type="text" name="modelo"></p>
														<p>Etiqueta: <input type="text" name="etiqueta"></p>
														<p>Service TAG: <input type="text" name="servicetag"></p>
														<p>Fecha de registro: <input type="date" name="fecha" value="<?php echo $f=date("Y-m-d"); ?>" ></p>
													</div>
												</div>
												...
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
												<input  class="btn btn-primary" type="submit" value="Registrar">
											</div>
										</form>
									</div>
								</div>
							</div>
							<button type="button" class="list-group-item btn btn-primary btn-lg" data-toggle="collapse" data-target="#asignada">
								IPs Asignadas
							</button>
							<button type="button" class="list-group-item btn btn-primary btn-lg" data-toggle="collapse" data-target="#libre">
								IPs Libres
							</button>							
						</div>	
						<div class="table-responsive collapse" id="asignada">						
						<?php
							//echo $numero;
							$sql="SELECT * FROM locales_asignadas WHERE activo = 1 ORDER BY id_ipl  ";
							//echo $sql;
							$result = $conn->query($sql);
							//$filas = $result->num_rows;
							if ($result->num_rows > 0) {	
								while($row= $result->fetch_assoc()) {
							?>							
								<div class="panel panel-primary">
									<!-- Default panel contents -->
									<?php $name = $row["server"];?>
									<div class="panel-heading">	
										<button type="button" style="position:right"class="btn btn-warning "><a style="text-decoration:none;color:#fff;" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=3&ip=".$row["id_ipl"]."&ser=".$row["id_servers"]."&pc=".$row["id_equipo"]); ?>">
											<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Liberar</a>
										</button>	
									</div>
										<table class="table table-hover table-condensed">
											<tr class="danger">
												<th>IP</th>
												<th>Equipo/Server</th>
												<th>Etiqueta</th>
												<th>Service TAG</th>
												<th>Fecha de asignación</th>
											</tr>
											<tr>
												<td><?php echo "192.168.12.".$row["id_ipl"]; ?></td>
												<?php	
												if($row["id_servers"] == null)	{											
													$sql1="SELECT * FROM equipos WHERE id_equipo = ".$row['id_equipo'].";";
													$result1 = $conn->query($sql1);
													$filas = $result1->num_rows;
													if ($result1->num_rows > 0) {
														while($row1= $result1->fetch_assoc()) { ?>
															<td><?php echo $row1["nombre"]; ?></td>
															<td><?php echo $row1["etiqueta"]; ?></td>
															<td><?php echo $row1["servicetag"]; ?></td>
													<?php	}
													}
												}
												if($row["id_equipo"] == null)	{											
													$sql1="SELECT * FROM servers WHERE id_servers = ".$row['id_servers'].";";
													$result1 = $conn->query($sql1);
													$filas = $result1->num_rows;
													if ($result1->num_rows > 0) {
														while($row1= $result1->fetch_assoc()) { ?>
															<td><?php echo $row1["server"]; ?></td>
															<td><?php echo $row1["etiqueta"]; ?></td>
															<td><?php echo $row1["servicetag"]; ?></td>
												<?php	}
													}
												}													
												?>
												<td><?php echo $row["fecha"]; ?></td>
											</tr>							
										</table>
								</div>
							
					<?php 		}
							} else { echo "<p> No se han asignado IPs Locales aún </p>"; 
							}
								?>
						</div> <!-- DIV responsive ASIGNADA FIN -->	
						<div class="table-responsive collapse" id="libre">
							<?php
							$sqla="SELECT * FROM locales WHERE id_ipl NOT IN( SELECT id_ipl FROM locales_asignadas WHERE activo = 1)";
							//echo $sqla;
							$resulta = $conn->query($sqla);
							//$filasa = $resulta->num_rows;
							if ($resulta->num_rows > 0) {
								while($rowa= $resulta->fetch_assoc()) {
									$i = $rowa["id_ipl"];
							?>							
								<div class="panel panel-primary">
									<!-- Default panel contents -->									
									<div class="panel-heading">	
										<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?=$rowa["id_ipl"]?>">
											<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span>Asignar IP
										</button>
									</div>
									<table class="table table-hover table-condensed">
										<tr class="success">
											<th>IP</th>
										</tr>
										<tr>
											<td><?php echo "192.168.12.".$rowa["id_ipl"]; ?></td>
										</tr>
									</table>
								</div>
								<!-- Modal -->
								<div class="modal fade" id="myModal<?=$rowa["id_ipl"]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=2"); ?>" method="POST">
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
															<p> IP local<select  name="ip" required>
																	<option value="<?=$rowa['id_ipl'];?>" >192.168.12.<?=$rowa['id_ipl'];?></option>																
																</select>
															</p>
															<p> Equipo: <select  name="equipo" >
																	<option ></option>
																	<?php
																	include 'conexion.php';
																	$sq="SELECT nombre, id_equipo FROM equipos WHERE id_locales IS  NULL";
																	echo $sq;
																	$resul = $conn->query($sq);
																	//$filas = $result->num_rows;
																	if ($resul->num_rows > 0) {
																		while($ro= $resul->fetch_assoc()) {
																			echo '<option value="'.$ro["id_equipo"].'">'.$ro["nombre"].'</option>';
																		}
																	}
																	//$conn-> close;
																	?>
																</select>
															</p>
															<p> Server: <select  name="server" >
																	<option ></option>
																	<?php
																	include 'conexion.php';
																	$s="SELECT server, id_servers FROM servers WHERE iplocal IS NULL ";
																	$resu = $conn->query($s);
																	//$filas = $result->num_rows;
																	if ($resu->num_rows > 0) {
																		while($r= $resu->fetch_assoc()) {
																			echo '<option value="'.$r["id_servers"].'">'.$r["server"].'</option>';
																		}
																	}
																	//$conn-> close;
																	?>
																</select>
															</p>															
															<p>Fecha de asignación <input type="date" name="fecha" value="<?php echo $d=date("Y-m-d");?>"></p>
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
							
					<?php 		} 	} ?>
						</div> <!-- DIV responsive -->
					</div><!-- /.panel body -->
				</div>  <!-- /.panel panel success-->
			</div> <!-- /.col -->
		</div> <!-- /.row -->
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
