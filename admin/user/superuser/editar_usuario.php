<?php include 'settings.php'; //include settings 
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

    <title>Administrar/editar usuarios</title>

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

  <body>

   
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <?php $menu=0; include 'activo.php';  include 'menu.php'; ?>
    </nav>


    <div class="container">
	<br/>
		<div class="row">
		<?php  $a = $_GET["a"]; $id=$_GET["id"]; $datos = edit_user($a);// var_dump($datos); 
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
			$b = $_GET["a"]; update_user($b);
		}
		?>
			<div class="col-xs-12 col-sm-6 col-md-8">
				<div class="panel <?php echo $datos[0]; ?>">
					<div class="panel-heading">
						<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
						<?php echo $datos[1];?>
					</div>
					<div class="panel-body">
						<div class="list-group">
						  <a href="#" class="list-group-item active">
							ACCIONES
						  </a>
						  <a href="usuario.php?id=<?php echo $a;?>" class="list-group-item active">
							Ver <?php echo $datos[3];?>
						  </a>
						  <a href="usuario_crear.php?id=<?php echo $a; ?>" class="list-group-item">Crear <?php echo $datos[3];?></a>
						</div>
						<table class="table table-hover table-condensed">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Correo</th>
									<th>Usuario</th>
									<th>Status</th>
									
								</tr>
							</thead>
							<tbody>
								<?php include 'conexion.php';
										$sql="SELECT * FROM users WHERE id = '$id'";// Ejecuto la consulta y la guardo en una variable
										$result = $conn->query($sql);// Ejecuto la consulta y la guardo en una variable
										if ($result->num_rows > 0) {//Con ->num_rows consulto el numero de registros si es mayor a 0 abro un bucle while para mostrarlos
											while($row= $result->fetch_assoc()) {
								?>
								<tr>
									<form action="editar_usuario.php?accion=1&a=<?php echo $a; ?>" method="post">
									<td><input style="width:30px;" type="text" name="id" value="<?php echo $row["id"]; ?>" readonly></td>
									<td><input type="text" name="nombre" value="<?php echo $row["name"]; ?>"></td>
									<td><input type="text" name="correo" value="<?php echo $row["correo"]; ?>"></td>
									<td><input type="text" name="login" value="<?php echo $row["login"]; ?>"></td>
									
									
									<td><select name="activo">
											<?php $act = $row["activo"]; if($act == 1){ echo "<option value='1'>Activo</option>"; } else { echo "<option value='0'>Inactivo</option>";} ?>
											<option value='1'>Activo</option>
											<option value='0'>Inactivo</option>
										</select>	
									</td>
								</tr>
								<tr>		
									<td colspan="5"><center><input type="submit" value="Actualizar"></center></td>
									</form>
								</tr>
								<?php
											}
										}
									//$conn->close();
								?>		
							</tbody>
						</table>
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
