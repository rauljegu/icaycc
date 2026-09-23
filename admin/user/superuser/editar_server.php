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

    <title>Actualizar server</title>

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
	<!--<script src="funciones.js">

</script>-->
  </head>

  <body>

   
    <nav class="navbar navbar-inverse navbar-fixed-top">
     <?php  $menu = 1; include'activo.php'; include 'menu.php';?>
    </nav>


    <div class="container">
	<br/>
		<div class="row">
		
			<div class="col-xs-12 col-sm-6 col-md-12">
				<div class="panel panel-success ">
					<div class="panel-heading">
						<!--<h3 class="panel-title"><a href="index.php">Administrar usuarios</a> > Lista de administradores. </h3>-->
						<h2 class="panel-title">Editando Server <?= $_GET["id"]; ?></h2>
					</div>
					<div class="panel-body">
						<?php
							$registro = $_GET["id"];
							//echo $numero;
							$sql="SELECT * FROM servers WHERE id_servers = '".$registro."' ORDER BY id_servers $limite $inicio $idr";
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
											<div class="panel-heading">
												<p><center>Información del equipo y ubicación</center></p>										
											</div>
										<!-- Default panel contents -->
										
											<table class="table table-hover table-condensed">
												<form action="<?php echo  htmlspecialchars('editar_server.php?actualizar=1&id='.$row["id_servers"].'&ipante='.$row["iplocal"]); ?>" method="POST">
												<tr class="info">
													<th ><center>Nombre</center></th>
													<th ><center>Tipo</center></th>
													<th ><center>Modelo</center></th>
													<th ><center>Etiqueta</center></th>
												</tr>
												<tr>
													<td><div class="panel-heading"><input type='text' style='color:black' name='server' value='<?php echo $row["server"]; ?>'></div></td>
													<td><div class="panel-heading"><input style='color:black' type='text' name='tipo' value='<?php echo $row["tipo"]; ?>'></div></td> 
													<td><div class="panel-heading"><input style='color:black' type='text' name='modelo' value='<?php echo $row["modelo"]; ?>'></div></td>
													<td><div class="panel-heading"><input style='color:black' type='text' name='etiqueta' value='<?php echo $row["etiqueta"]; ?>'></div></td>
													
												</tr>																							
												<tr class="info">
													<th>RACK</th>
													<th>Nivel</th>
													<th>Posicion</th>
													<th>Status</th>
												</tr>
												<tr >
													<td>
														<select name="rack" required>
														<option value="<?php echo $row["rack"]; ?>">
														<?php
																echo ($row["rack"] == "A") ?  "A" : (($row["rack"] == "B") ? "B" : "Otro");
																
														?>
														</option>
														<option value="A">A</option>
														<option value="B">B</option>
									
														</select>
													</td>
													<td>
														<select name="nivel" required>
														<option value="<?php echo $row["nivel"]; ?>">
														<?php
																echo $row["nivel"];
																
														?>
														</option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
									
														</select>
													</td>
													<td>
														<select name="posicion" required>
														<option value="<?php echo $row["posicion"]; ?>">
														<?php
																echo $row["posicion"];
																
														?>
														</option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
									
														</select>
													</td>
													<td>
														<select name="status" required>
														<option value="<?php echo $row["status"]; ?>">
														<?php
																echo ($row["status"] == "ON") ?  "ON" : (($row["status"] == "OFF") ? "OFF" : "Otro");
																
														?>
														</option>
														<option value="ON">ON</option>
														<option value="OFF">OFF</option>
									
														</select>
													</td>
												</tr>											
												<tr class="info">		
													<th>RFC</th>
													<th>No. de trabajador</th>
													<th>No. de cuenta</th>
													<th></th>
												</tr>
												<tr class="success">
													<th colspan="4"><center>Configuración y descripción</center></th>
												</tr>
												<tr class="success">	
													<th colspan="2">IP Pública</th>
													<th colspan="2">IP Local</th>
												</tr>
												<tr>												
													<td colspan="2"><input type="mail" name="ippublica" value="<?php echo $row["ippublica"]; ?>"></td>
													<td colspan="2">
														
														<p> IP local: <select  name="iplocal" required>
														<option  value="<?php echo $row["iplocal"]; ?>">192.168.12.<?php echo $row["iplocal"]; ?></option>
														<option ></option>
														<?php
														include 'conexion.php';
														$sql1="SELECT * FROM locales WHERE asignada = 0 ";
														$result1 = $conn->query($sql1);
														//$filas = $result->num_rows;
														if ($result1->num_rows > 0) {
															while($row1= $result1->fetch_assoc()) {
																echo '<option value="'.$row1["id_ipl"].'">192.168.12.'.$row1["direcciones"].'</option>';
															}
														}
														$conn-> close;
														?>
														</select></p>
													</td>
												</tr>
												<tr class="success">	
													<th colspan="4"> Dominios</th>
												</tr>											
												<tr>	
													 <td colspan="4">
													  <select  name="dominio" required>
														<option value="<?php echo $row["dominio"]; ?>">
														<?php 
														include 'conexion.php';
														$sql2="SELECT dominio FROM dominios WHERE id_dominios = ".$row['dominio'];
														$result2 = $conn->query($sql2);
														$filas = $result2->num_rows;
														if ($result2->num_rows > 0) {
															while($row2= $result2->fetch_assoc()) { 
															 echo $row2['dominio'];
															}
														}
														?>
														
														</option>
														<option ></option>
														<?php
														include 'conexion.php';
														$sql3="SELECT * FROM dominios";
														$result3 = $conn->query($sql3);
														//$filas = $result->num_rows;
														if ($result3->num_rows > 0) {
														while($row3= $result3->fetch_assoc()) {
														echo '<option value="'.$row3["id_dominios"].'">'.$row3["dominio"].'</option>';
														}
														}
														$conn-> close;
														?>
													</select>
													 
													 
													 </td>
												</tr>	
												
												<tr class="success">	
													<th colspan="4"> Contenido</th>
												</tr>											
												<tr>	
													 <td colspan="2"><input type="text" name="contenido" value="<?php echo $row["contenido"]; ?>"></td>
												</tr>
												<tr class="success">	
													<th colspan="2"> Tipo</th>
													<th colspan="2"> Puerto</th>
												</tr>											
												<tr>	
													 <td colspan="2"><input type="text" name="tipo" value="<?php echo $row["tipo"]; ?>"></td>
													 <td colspan="2"><input type="text" name="puerto" value="<?php echo $row["puerto"]; ?>"></td>
												</tr>
												
												
			
												<tr class="warning">												
													<th colspan="4">
														<center>
															<div class="col-auto">
																<button type="submit" class="btn btn-primary mb-3">Actualizar</button>
															</div>	
														</center>	
													</th>											
												</tr>								
											</form>
											</table>									
	
										</div><!-- primary-->
							
								
										
							<?php	
									} ?> 
								</div>	<!-- responsive	--><?php
								
								}	
							?>								
								
						<?php
							if( ($_SERVER["REQUEST_METHOD"] == "POST" ) && (isset($_GET["curso"])) ){
								$id = $_GET["id"];
								curso($id);
							}
							if( ($_SERVER["REQUEST_METHOD"] == "POST" ) && (isset($_GET["ac"])) ){
								$id = $_GET["id"];
								grupo($id);
							}
							if( ($_SERVER["REQUEST_METHOD"] == "POST" ) && (isset($_GET["actualizar"])) ){
								 $id = $_GET["id"];
								actualizar_registro($id);
							}
							if( (isset($_GET["quitar"])) && (isset($_GET["id_as"])) ) {
								quitar_rol_curso($_GET["id_as"]);
							}
						?>	
					</div><!--panel body -->
				</div><!-- succes-->
			</div><!--	col-->
		</div><!--row-->
    </div> <!--conteiner-->


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
