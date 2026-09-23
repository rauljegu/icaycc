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
     <?php  $menu = 1; include'activo.php'; include 'menu.php';?>
    </nav>


    <div class="container">
	<br/>
		<div class="row">
		<?php  /*$a = $_GET["a"]; $id=$_GET["id"]; $datos = edit_user($a);// var_dump($datos); */
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
		 registro();
		}
		?>
			<div class="col-xs-12 col-sm-6 col-md-8">
				<div class="panel panel-warning ">
					<div class="panel-heading">
						<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
						<h2 class="panel-title">Registrar Profesor/Académico</h2>
						
					</div>
					<div class="panel-body">
						
						    
    <h3 id="nombreAPP">Información personal</h3>
    <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      <p id="name" class="formulario registro">Nombre(s): <input type="text" name="nombre"></p>
      <p>Apellido paterno: <input type="text" name="apellido_paterno"></p>
      <p>Apellido materno: <input type="text" name="apellido_materno"></p>
      <p>Género: <select name="genero" required>
        <option ></option>
        <option value="H">Masculino</option>
        <option value="M">Femenino</option>
        <option value="Otro">Otro</option>
        </select></p>
      <p>Otro género: <input type="text" name="genero_otro" placeholder="Si no aplica, omitir"></p>
      <p>Fecha de nacimiento: <input type="text" name="fecha_nac" placeholder="DDMMAAAA"></p>
      <p>CURP: <input type="text" name="curp"></p>
      <p>RFC: <input type="text" name="rfc"></p>
      <p>No. de trabajador: <input type="text" name="num_trabajador"></p>
      <p>No. de cuenta: <input type="text" name="num_cuenta"></p>
      <h3 id="nombreAPP">Información de contacto</h3>
      <p>Talla de bata: <input type="text" name="talla_bata"></p>
      <p>Correo 1: <input type="mail" name="correo1"></p>
      <p>Correo 2: <input type="mail" name="correo2"></p>
      <p>Telefono 1: <input type="text" name="tel1"></p>
      <p>Telefono 2: <input type="text" name="tel2"></p>
      <h3 id="nombreAPP">Trayectoria académica</h3>
      <p>Licenciatura 1:<input id="lic1" onchange="ni(this.id)"type="text" required></p>
      <input id="lic" type="text" name="licenciatura" hidden>
	  <p>Maestría 1:<input id="mas1" onchange="nim(this.id)"type="text" ></p>
      <input id="mas" name="maestria" hidden>
      <p>Doctorado 1:<input id="doc1" onchange="nid(this.id)"type="text" ></p>
	  <input id="doc" name="doctorado" hidden>
      <p>Especialidad 1: <input  id="esp1" onchange="nie(this.id)" type="text" ></p>
      <input  id="esp"  name="Especialidad" hidden></p>
	  <p>PostDoctorado 1: <input  id="pos1" onchange="nip(this.id)" type="text" ></p>
      <input  id="pos"  name="posdoc" hidden></p>
      <p>APPAUNAM: <select name="appaunam" required>
        <option ></option>
        <option value="Si">Si</option>
        <option value="No">No</option>
        </select></p>
      <p>Último grado obtenido: <select name="ultimo_grado" required>
        <option ></option>
        <option value="Licenciatura">Licenciatura</option>
        <option value="Maestria">Maestría</option>
        <option value="Doctorado">Doctorado</option>
        <option value="Especialidad">Especialidad</option>
        <option value="Postdoctorado">Postdoctorado</option>
        </select></p>
      <h3 id="nombreAPP">Trayectoria de profesor</h3>
      <p>Año de ingreso al departamento: <input type="text" name="ingreso"></p>
      <div id="nombras">
		  <p>Nombramiento 1: <input id="nom1"  type="text" ></p>
		  <p>Año de nombramiento 1: <input id="anom1" onchange="no(this.id)" type="number" ></p>	
		
	  </div>
	    <input id="nom"  name="nombramiento" hidden>	
      <p> <input type="submit" value="REGISTRAR"></p>
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
<script src="funciones.js">

</script>
