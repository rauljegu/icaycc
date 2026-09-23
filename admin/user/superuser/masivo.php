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

    <title>Cargar lista de usuarios</title>

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
     <?php  $menu = 4; include'activo.php'; include 'menu.php';?>
    </nav>


    <div class="container">
	<br/>
		<div class="row">
		
			<div class="col-xs-12 col-sm-6 col-md-12">
				<div class="panel panel-success ">
					<div class="panel-heading">
						<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
						<h2 class="panel-title">Multiples Registros <?= $_GET["id"]; ?></h2>
					</div>
					<div class="panel-body">
					 <a class="btn btn-primary form-control" href="registro.csv" download="registro">Descargar Plantilla</a>
						<form action="import.php" method="post" enctype="multipart/form-data" id="filesForm">
							<div class="col-md-4 offset-md-4">
								<input class="form-control" type="file" name="fileContacts" >
								<button type="button" onclick="uploadContacts()" class="btn btn-primary form-control" >Cargar</button>
							</div>
						</form>
					</div>
				</div>
			</div>	
		</div>
    </div>


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
<script type="text/javascript">

    function uploadContacts()
    {

        var Form = new FormData($('#filesForm')[0]);
        $.ajax({

            url: "import.php",
            type: "post",
            data : Form,
            processData: false,
            contentType: false,
            success: function(data)
            {
                alert("Porfesores/Académicos registrados correctamente");
				<!--alert('Registros Agregados!');-->
            }
        });
    }

</script>