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

    <title>Crear usuarios</title>

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
		<?php  $a = $_GET["id"];$datos = create_user($a);// var_dump($datos); 
		if(isset($_GET["insertar"])){$b = $_GET["insertar"]; } else { $b =""; }
		if(isset($_GET["tipo"])){$c = $_GET["tipo"]; } else { $c =""; }
		if($b == 1){
			//echo $_POST["pass"];
			insert_user($c);
          $conn->close();
		}
		?>
			<div class="col-xs-12 col-sm-6 col-md-8">
				<div class="panel <?php echo $datos[0]; ?>">
					<div class="panel-heading">
						<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Crear administradores. </h3>-->
						<?php echo $datos[1];?>
					</div>
					<div class="panel-body">
						<div class="list-group">
						  <a href="#" class="list-group-item active">
							ACCIONES
						  </a>
						  <a href="usuario.php?id=<?php echo $a;?>" class="list-group-item ">
							Ver <?php echo $datos[3];?>
						  </a>
						  <a href="usuario_crear.php?id=<?php echo $a;?>" class="list-group-item active">Crear <?php echo $datos[3];?></a>
						</div>
						<form action="usuario_crear.php?insertar=1&tipo=<?php echo $a; ?>&id=<?php echo $a; ?>" method="POST">
							<div class="form-group">
								<label for="exampleInputEmail1">Nombre(s)</label>
								<input name="nombre" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Apellido paterno</label>
								<input name="pat" type="text" class="form-control" id="exampleInputPassword1" placeholder="Paterno">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Apellido materno</label>
								<input name="mat" type="text" class="form-control" id="exampleInputPassword1" placeholder="Materno">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Usuario</label>
								<input name="usr" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nombre de usuario">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Correo</label>
								<input name="mail" type="mail" class="form-control" id="exampleInputPassword1" placeholder="Correo">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Contrase&ntilde;a</label>
								<input name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
							</div>
							<button type="submit" class="btn btn-default">Submit</button>
						</form>
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
