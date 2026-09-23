<?php include 'settings.php'; //echo "status: ".$_SESSION["vacia"];//include settings 
	//var_dump($_POST);
	include 'funciones.php'; //include funciones ?>

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
if($_SERVER["REQUEST_METHOD"] == "POST" ){
		 if($_GET["eq"] == 1 ){registro_equipo();}
		}?>
   
    <nav class="navbar navbar-inverse navbar-fixed-top">
     <?php $menu=2; include 'activo.php';  include 'menu.php'; ?>
    </nav>


    <div class="container">
	<br/>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-8">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">IPs</h3>
					</div>
					<div class="panel-body">
						
						<div class="list-group">
							<a href="#" class="list-group-item active">
								ACCIONES
							</a>
							<!-- <a href="usuario.php?id=0" class="list-group-item ">
							Ver Servidores
							</a>
							<a href="usuario_crear.php?id=0" class="list-group-item">Registrar Server</a>-->
							<!-- Button trigger modal -->
							<button type="button" class="list-group-item btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
								Asignar Nueva Ip
							</button>

							<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Asignar</h4>
									  </div>
									  <div class="modal-body">
										...
										<div class="panel panel-warning ">
											<div class="panel-heading">
												<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
												<h2 class="panel-title">Datos</h2>
											</div>
											<div class="panel-body">	
											<h3 id="nombreAPP">Información del equipo</h3>
											<form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
											<p> Nombre<select  name="equipos" required>
											<option ></option>
											<?php
											include 'conexion.php';
											$sql="SELECT nombre, id_equipo FROM equipos";
											$result = $conn->query($sql);
											//$filas = $result->num_rows;
											if ($result->num_rows > 0) {
												while($row= $result->fetch_assoc()) {
													echo '<option value="'.$row["id_equipo"].'">'.$row["nombre"].'</option>';
												}
											}
											$conn-> close;
											?>
											</select>
											</p>
											<p>Ip Pública <input type="text" name="publica"></p>
											<p>IP Local <input type="text" name="etiqueta"></p>
											<p>Fecha de asignación <input type="date" name="fecha" ></p>
											<!--<h3 id="nombreAPP">Ubicación</h3>
											<p>RACK: <select name="rack" required>
											<option ></option>
											<option value="A">A</option>
											<option value="B">B</option>
											</select></p>-->
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
								$sql="SELECT * FROM servers ORDER BY id_servers $limite $inicio $idr";
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
										<?php $name = $row["server"];?>
										<div class="panel-heading">	
											<?php echo  "<p>#".$row["id_servers"]." ".$row["server"]." Status: ".$row["status"]."</p>";?>
											<button type="button" style="position:right"class="btn btn-warning "><a style="text-decoration:none;color:#fff;" href="editar_server.php?id=<?php echo $row["id_servers"]; ?>">
												<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Editar</a>
											</button>
											
										</div>
											<table class="table table-hover table-condensed">
											<tr class="info">
												
												<th colspan="7"><center>Ubicacion y Configuración</center></th>
											</tr>
											<tr class="info">
								
												<th>RACK</th>
												<th>Nivel</th>
												<th>Posicion</th>
												<th>Ip Publica</th>
												<th>Ip Local</th>
												<th>Dominio</th>
												<th>Puerto</th>
											</tr>
											<tr>
												
												<td><?php echo $row["rack"]; ?></td>
												<td><?php echo $row["nivel"]; ?></td>
												<td><?php echo $row["posicion"]; ?></td>
												<td><?php echo $row["ippublica"]; ?></td>
												<td><?php echo $row["iplocal"]; ?></td>
												<td><?php echo $row["dominio"]; ?></td>
												<td><?php echo $row["puerto"]; ?></td>
											</tr>
											<tr class="success">
												
												<th colspan="7"><center>Info del equipo y descripcion</center></th>
											</tr>
											<tr class="success">
												
												
												<th colspan="3">Contenido</th>
												<th>Tipo</th>
												<th>Modelo</th>
												
												<th>Etiqueta</th>
												<th ></th>
											</tr>
											<tr>
												
												  <td colspan="3"><?php echo $row["contenido"]; ?></td>
												  <td><?php echo $row["tipo"]; ?></td>
												  <td><?php echo $row["modelo"]; ?></td>
												 
												  <td><?php echo $row["etiqueta"]; ?></td>
												  <td></td>
											</tr>
																				
										</table>
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
