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

    <title>Consultar</title>

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
     <?php  $menu = 2; include'activo.php'; include 'menu.php';?>
    </nav>


    <div class="container">
	<br/>
		<div class="row">
		<?php  /*$a = $_GET["a"]; $id=$_GET["id"]; $datos = edit_user($a);// var_dump($datos); 
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
		 registro();
		}*/
		totales($numero);
		if($numero <= 10 ){
			$limite = "  ASC";
			$inicio = "	LIMIT 10";
			$idr ="";
			//$limite = " ORDER BY id_registro ASC LIMIT 10 OFFSET 1";
		}
		
		if($numero >10 ){
			$div = intdiv($numero,10);
			//echo $div;
			$resto = $numero%10;
			$inicio = "	LIMIT 10";
			$limite = "  ASC";
			//echo $li;
			if(isset($_GET["reg"])){
				$reg= $_GET["reg"];
				$inicio = "	LIMIT 10";
				
				if((isset($_GET["back"])) && ($_GET["back"] == 1)){
					$limite = " ASC";
					$reg1 = $reg - 10;
					if($reg1 == 1){$idr="";} else { 
					$idr = "OFFSET $reg1";}
				} else { $limite = "ASC"; 
						 
						 $idr = "OFFSET $reg";
				}
			}
		}
	//	var_dump(intdiv(256, 10));
	//	var_dump(256%10);
		?>
			<div class="col-xs-12 col-sm-6 col-md-12">
				<div class="panel panel-success ">
					<div class="panel-heading">
						<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
						<h2 class="panel-title">Resultados en Profesores/Académicos</h2>
					</div>
					<div class="panel-body">
						<p>Buscar: <input type="text" name="campo" id="campo"></p>
						<input type="text" name="tabla" id="tabla" value="registros" hidden></p>
							
						<div class="table-responsive">

									<div class="panel panel-primary">
										<!-- Default panel contents -->
										<div class="panel-heading">
											<p>COINCIDENCIAS CON TU BUSQUEDA</p>
										</div>
										<table class="table table-hover table-condensed">
											<thead>
												<tr class="info">
													<th>Nombre</th>
													<th>Ap. Paterno</th>
													<th>Ap. Materno</th>
													<th>Correo 1</th>
													<th>Correo 2</th>
													<th># Trabajador</th>
													<th># Cuenta</th>
													<th>Acciones</th>
												</tr>	
											</thead>
											<tbody id="content">
											</tbody>		
										</table>
										
									</div>
							<?php	
									
									if($numero > 10){ ?>
									<ul class="pager">
										<?php if($reg >10){?> 
										<li><a href="visualizar.php?reg=<?php echo $reg;?>&back=1">Anterior</a></li>
										<?php } if($filas == 10) { ?>
										<li><a href="visualizar.php?reg=<?php echo $reg;?>">Siguiente</a></li>
										<?php } ?>
									  </ul>
							<?php	
									}
								
							?>
						
							
								
						</div>
						<?php
							if($_SERVER["REQUEST_METHOD"] == "POST" ){
								$id = $_GET["id"];
								curso($id);
							}
							if( (isset($_GET["quitar"])) && (isset($_GET["id_as"])) ) {
								quitar_rol_curso($_GET["id_as"]);
							}
						?>	
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
	<script>
			//getData()
			
			document.getElementById("campo").addEventListener("keyup",getData)
			
			function getData(){
				let input = document.getElementById("campo").value
				let input1 = document.getElementById("tabla").value
				let content = document.getElementById("content")
				let url = "load.php";
				let formData = new FormData()
				formData.append('campo',input)
				formData.append('tabla',input1)
				console.log(formData)
				fetch(url,{
					method: "POST",
					body: formData
				}).then(response => response.json())
				.then(data => {
					content.innerHTML = data
				}).catch(err => console.log(err))
				
			}
		</script>
  </body>
</html>
