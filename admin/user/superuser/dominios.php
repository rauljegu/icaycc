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

  <body><?php 	
			include 'funciones_dom.php';
			if(isset($_GET["eq"])){
				if($_GET["eq"]== 1 ){
					acdes();
					}
			}		
			if($_SERVER["REQUEST_METHOD"] == "POST" ){
					 if($_GET["eq"] == 2 ){dominio();}
					}
			if($_SERVER["REQUEST_METHOD"] == "POST" ){
					 if($_GET["eq"] == 3 ){asignar_dominio();}
					}
			if($_SERVER["REQUEST_METHOD"] == "POST" ){
					 if($_GET["eq"] == 4 ){quitar_dominio();}
					}		
					?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
     <?php $menu=3; include 'activo.php';  include 'menu.php'; ?>
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
								Nuevo dominio
							</button>
							<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Registrar dominio</h4>
										</div>
										<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=2"); ?>" method="POST">
											<div class="modal-body">
												
												<div class="panel panel-warning ">
													<div class="panel-heading">
														<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
														<h2 class="panel-title">Datos</h2>
													</div>
													<div class="panel-body">														
															<p id="name" class="formulario registro">Dominio: <input type="text" name="dominio"></p>																																											
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
							<!---->		
						</div>	
							<!-- Input de búsqueda -->
							<p><input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar"></p>
							<div class="panel panel-primary">							
								<div class="panel-heading">	
									<h2 class="mb-3">Lista de Dominios</h2>
								</div>
								<!-- Default panel contents -->
								<table class="table table-hover table-condensed">
									<tr class="info">
										<th colspan="3"><center>Dominio</center></th>
										<th colspan="4"><center>Info del equipo y descripcion</center></th>
										<th colspan="2"><center>Acciones</center></th>
									</tr>				
									<?php
										//echo $numero;
										$sql="SELECT * FROM dominios ORDER BY id_dominios ";
										//echo $sql;
										$result = $conn->query($sql);
										$filas = $result->num_rows;
										if ($result->num_rows > 0) {
								?>
										<div id=""class="table-responsive">
								<?php	
											while($row= $result->fetch_assoc()) {
								?>									
											<tbody id="tablaCuerpo">
												<tr>
													<td colspan="3"><?php echo $row["dominio"]; ?></td>
													<td colspan="4">
												<?php 
													include 'conexion.php';
													$sql1="SELECT * FROM servers INNER JOIN dominios_asignados
														ON servers.id_servers=dominios_asignados.id_servers WHERE dominios_asignados.id_dominios = ".$row['id_dominios']." AND activo= 1;";
													//ECHO $sql1;
													$result1 = $conn->query($sql1);
													$filas = $result1->num_rows;
													if ($result1->num_rows > 0) {
														while($row1= $result1->fetch_assoc()) { 
															echo $row1["server"].' <br/>Etiqueta: '.$row1["etiqueta"].' <br/>Ip Pública:'.$row1["ippublica"].' <br/>Ip Local:'.$row1["iplocal"].'</br></br>';
														}
													} else { echo ' <h4>No tiene servidor asiganado aún</h4>';}?>
													</td>
													<td>
														<button type="button" class=" btn btn-warning" data-toggle="modal" data-target="#myModal<?=$serv=$row["id_dominios"];?>">	
															<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Asignar Dominio
														</button>
														<br/>
														<br/>
														<button type="button" class=" btn btn-warning" data-toggle="modal" data-target="#myModal0<?=$serv=$row["id_dominios"];?>">	
															<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Quitar Dominio
														</button>
														<br/>
														<br/>
														<?php if($row["activo"] == 1 ){ ?>
														<button type="button" class=" btn btn-warning"><a  style="text-decoration:none;color:#fff;"href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=1&ac=1&dom=".$row["id_dominios"]);?>">	
															<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Desactivar Dominio</a>
														</button>
														<?php } else {?>
														<button type="button" class=" btn btn-warning"><a  style="text-decoration:none;color:#fff;"href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=1&ac=2&dom=".$row["id_dominios"]);?>">	
															<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Activar Dominio</a>
														</button>	
														<?php } ?>	
													</td>												
												</tr>
											</tbody>						
											<div class="modal fade" id="myModal<?=$serv;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=3&dominio=".$serv); ?>" method="POST">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Asignar dominio</h4>
															</div>
															<div class="modal-body">
																<div class="panel panel-warning ">
																	<div class="panel-heading">
																		<h2 class="panel-title"># <?= $serv." ".$row["dominio"];?></h2>
																	</div>
																	<div class="panel-body">
																		<p>Seleccione un server: <select  name="server" required>
																				<option ></option>
																				<?php
																				include 'conexion.php';
																				$sql11="SELECT * FROM servers WHERE id_servers NOT IN (SELECT id_servers FROM dominios_asignados WHERE id_dominios='$serv' AND activo = 1)" ;
																				$result11 = $conn->query($sql11);
																				//$filas = $result->num_rows;
																				if ($result11->num_rows > 0) {
																					while($row11= $result11->fetch_assoc()) {
																						echo '<option value="'.$row11["id_servers"].'">'.$row11["server"].'</option>';
																					}
																				} else {echo '<option>No hay servers disponibles</option>';}
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
											<div class="modal fade" id="myModal0<?=$serv;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']."?eq=4&dominio=".$serv); ?>" method="POST">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Quitar dominio</h4>
															</div>
															<div class="modal-body">																
																<div class="panel panel-warning ">																
																	<div class="panel-heading">
																		<h2 class="panel-title"># <?= $serv." ".$row["dominio"];?></h2>
																	</div>
																	<div class="panel-body">
																		<p>Seleccione un server: <select  name="server" required>
																				<option ></option>
																				<?php
																				include 'conexion.php';
																				$sql11="SELECT * FROM servers WHERE id_servers  IN (SELECT id_servers FROM dominios_asignados WHERE id_dominios='$serv' AND activo = 1)" ;
																				$result11 = $conn->query($sql11);
																				//$filas = $result->num_rows;
																				if ($result11->num_rows > 0) {
																					while($row11= $result11->fetch_assoc()) {
																						echo '<option value="'.$row11["id_servers"].'">'.$row11["server"].'</option>';
																					}
																				} else {echo '<option>No hay servers asignados</option>';}
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
											
									<?php	} ?> 
										</div> <!-- DIV responsive -->
								<?php  	}  ?>
								</table>
							</div> 
					</div><!-- panel-body -->
				</div><!--panel-success-->
			</div><!-- col-->
		</div><!--row-->	
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
<script>
	// Filtrado en tiempo real
	document.getElementById("buscador").addEventListener("keyup", function() {
	let filtro = this.value.toLowerCase();
	let filas = document.querySelectorAll("#tablaCuerpo tr");

	filas.forEach(fila => {
		let textoFila = fila.textContent.toLowerCase(); // Obtener todo el texto de la fila

		if (textoFila.includes(filtro)) {
			fila.style.display = "";
		} else {
			fila.style.display = "none";
		}
	});
	});
</script>
