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

    <title>Lista de usuarios</title>

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
     <?php  $menu = 3; include'activo.php'; include 'menu.php';?>
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
			//$div = intdiv($numero,10);
			//echo $div;
			//$resto = $numero%10;
			$inicio = "	LIMIT 10";
			$limite = "  ASC";
			//echo $li;
			if(isset($_GET["reg"])){
				$reg= $_GET["reg"];
				$inicio = "	LIMIT 10";
				
				if((isset($_GET["back"])) && ($_GET["back"] == 1)){
					$limite = " ASC";
					$reg1 = $reg - 10;
					if(($reg1 == 1)||($reg1 <10)){$idr="";} else { 
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
						<h2 class="panel-title">Lista de Profesores/Académicos</h2>
					</div>
					<div class="panel-body">
						
							<?php
								//echo $numero;
								$sql="SELECT * FROM registros ORDER BY id_registro $limite $inicio $idr";
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
										<?php $name = $row["nombre"];?>
										<div class="panel-heading">
											<?php echo  "<p>#".$row["id_registro"]." ".$row["nombre"]." ".$row["apellido_paterno"]." ".$row["apellido_materno"]."</p>";?>
											<button type="button" style="position:right"class="btn btn-warning "><a style="text-decoration:none;color:#fff;" href="editar_registro.php?id=<?php echo $row["id_registro"]; ?>">
												<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Editar</a>
											</button>
											
										</div>
										
										<table class="table table-hover table-condensed">
											<tr class="info">
												
												<th colspan="7"><center>Información personal</center></th>
											</tr>
											<tr class="info">
								
												<th>Género</th>
												<th>(Otro)</th>
												<th>Fecha de nacimiento</th>
												<th>CURP</th>
												<th>RFC</th>
												<th>No. de trabajador</th>
												<th>No. de cuenta</th>
											</tr>
											<tr>
												
												<td><?php echo $row["genero"]; ?></td>
												<td><?php echo $row["genero_otro"]; ?></td>
												<td><?php echo $row["fecha_nac"]; ?></td>
												<td><?php echo $row["curp"]; ?></td>
												<td><?php echo $row["rfc"]; ?></td>
												<td><?php echo $row["num_trabajador"]; ?></td>
												<td><?php echo $row["num_cuenta"]; ?></td>
											</tr>
											<tr class="success">
												
												<th colspan="7"><center>Información de contacto</center></th>
											</tr>
											<tr class="success">
												
												
												<th>Correo 1</th>
												<th>Correo 2</th>
												<th>Telefono 1</th>
												<th>Telefono 2</th>
												<th>Talla bata</th>
												<th colspan="2"></th>
											</tr>
											<tr>
												
												  <td><?php echo $row["correo1"]; ?></td>
												  <td><?php echo $row["correo2"]; ?></td>
												  <td><?php echo $row["tel1"]; ?></td>
												  <td><?php echo $row["tel2"]; ?></td>
												  <td><?php echo $row["talla_bata"]; ?></td>
												  <td colspan="2"></td>
											</tr>
											<tr class="warning">
												
												<th colspan="7"><center>Trayectoria académica</center></th>
											</tr>
											<tr class="warning">
												
												<th>Licenciatura</th>
												<th>Maestria</th>
												<th>Doctorado</th>
												<th>Especialidad</th>
												<th>Postdoctorado</th>
												<th>APPAUNAM</th>
												<th>Ultimo grado obtenido</th>
												
											</tr>	
											<tr>
												
												<td><?php $lic = explode(".", $row["licenciatura"]);
														 $largo = count($lic);
														for ($i=0; $i<$largo; $i++){
															if(!empty($lic[$i])){
																echo "<li>".$lic[$i]."</li>";
															}
														}
													?>
												</td>
												<td><?php  
														$lic = explode(".", $row["maestria"]);
														 $largo = count($lic);
														for ($i=0; $i<$largo; $i++){
															if(!empty($lic[$i])){
																echo "<li>".$lic[$i]."</li>";
															}
														}
													?>	
												</td>
												<td><?php  
														$lic = explode(".", $row["doctorado"]);
														$largo = count($lic);
														for ($i=0; $i<$largo; $i++){
															if(!empty($lic[$i])){
																echo "<li>".$lic[$i]."</li>";
															}
														}
													?>
												</td>
												<td><?php 
														$lic = explode(".", $row["Especialidad"]);
														$largo = count($lic);
														for ($i=0; $i<$largo; $i++){
															if(!empty($lic[$i])){
																echo "<li>".$lic[$i]."</li>";
															}
														}
													?>
												</td>
												<td><?php  
														$lic = explode(".", $row["posdoc"]);
														$largo = count($lic);
														for ($i=0; $i<$largo; $i++){
															if(!empty($lic[$i])){
																echo "<li>".$lic[$i]."</li>";
															}
														}
													?>
												</td>
												<td><?php echo $row["appaunam"]; ?></td>
												<td><?php echo $row["ultimo_grado"]; ?></td>
												
											</tr>
											<tr class="warning">
												
												<th colspan="7"><center>Trayectoria de profesor IB</center></th>
											</tr>
											<tr class="warning">
												
												<th>Año de ingreso</th>
												<th >Nombramiento</th>
												<th >Año de Nombramiento</th>
												<th colspan="2">Cursos</th>
												<th>Rol</th>
												<th>Acciones</th>
												
											</tr>
											<tr>
												
												<td ><?php echo $row["ingreso"]; ?></td>
												<td>
												<?php 
														$nomb = explode(".", $row["nombramiento"]);
														$ln = count($nomb);
														for($i=0; $i<$ln; $i++){
															if(!empty($nomb[$i])){
																//echo "<li>".$nomb[$i]."</li>";
																
																$nomb1= explode("-",$nomb[$i]);
																echo $nomb1[0]."<br/>";
															}
														}
													?>	
												</td><td>
												<?php 
														$nomb = explode(".", $row["nombramiento"]);
														$ln = count($nomb);
														for($i=0; $i<$ln; $i++){
															if(!empty($nomb[$i])){
																//echo "<li>".$nomb[$i]."</li>";
																
																$nomb1= explode("-",$nomb[$i]);
																echo $nomb1[1]."<br/>";
															}
														}
													?>	
												</td>
												<?php 
												include 'conexion.php';
												  $sql1= "SELECT * FROM `asignaturas` WHERE id_registro = ".$row["id_registro"]."";
												  $result1 = $conn->query($sql1);
												  if ($result1 -> num_rows>0){
													  echo '<td colspan="2"><ul>';
													while($row1=$result1->fetch_assoc()){
													  echo	"<li>".$row1["asignatura"]."<a href='visualizar.php?quitar=1&id_as=".$row1["id_asignatura"]."'> quitar Asignatura</a></li>";																											 
													}
													echo '</ul></td>';
												  }else { ?>
												
												<td colspan="2"></td>
												  <?php } ?>
												  
												  <?php 
												include 'conexion.php';
												  $sql1= "SELECT * FROM `asignaturas` WHERE id_registro = ".$row["id_registro"]."";
												  $result1 = $conn->query($sql1);
												  if ($result1 -> num_rows>0){
													  echo '<td><ul>';
													while($row1=$result1->fetch_assoc()){
													  echo	"<li>".$row1["rol"]."<a href='visualizar.php?quitar=1&id_as=".$row1["id_asignatura"]."'> quitar rol</a></li>";																											 
													}
													echo '</ul></td>';
												  }else { ?>
												
												<td></td>
												  <?php } ?>
												  
												<td><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#<?php echo $row["id_registro"];?>" aria-expanded="false" aria-controls="collapseExample">Asignar Cursos</button>
												</td>
											</tr>
											<tr class="warning">
												
												<th colspan="7"><center>Grupos</center></th>
											</tr>
											<tr class="warning">
												
												<th colspan="2">Grupo</th>
												<th colspan="2">Inicio</th>
												<th colspan="2">Fin</th>												
												<th colspan="2">Acciones</th>												
											</tr>	
											<?php 
												include 'conexion.php';
												  $sql3= "SELECT * FROM `grupos` WHERE id_registro = ".$row["id_registro"]."";
												  $result3 = $conn->query($sql3);
												  if ($result3 -> num_rows>0){
													
													while($row3=$result3->fetch_assoc()){
														 echo"<tr>";
													  echo '<td colspan="2">'.$row3["grupo"].'</td><td colspan="2">'.$row3["inicio"].'</td><td colspan="2">'.$row3["fin"].'</td>';
													
													}	?>
															<td colspan="2"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#<?php echo $row["id_registro"].'_'.$row["id_registro"];?>" aria-expanded="false" aria-controls="collapseExample">Asignar Grupo</button></td>
													</tr>
												<?php  }else { ?>
												<tr>
												<td colspan="2">No Aplica o No asignado</td>
												<td colspan="2">No Aplica o No asignado</td>
												<td colspan="2">No Aplica o No asignado</td>
												<td colspan="2"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#<?php echo $row["id_registro"].'_'.$row["id_registro"];?>" aria-expanded="false" aria-controls="collapseExample">Asignar Grupo</button></td>
												  </tr><?php } ?>											
										</table>
										<!--ASIGNAR CURSO-->
										<div class="panel panel-warning collapse" id="<?php echo $reg = $row["id_registro"];?>">
											<div class="panel-heading">
												<h2 class="panel-title">Asignar Curso</h2>
											</div>
											<div class="panel-body">
												<form action="visualizar.php?id=<?php echo $row["id_registro"];?>&ac=1" method="POST">
													<div class="form-group">
														<p><label  class="form-check">Asignatura:</label><select name="asignatura">												   
														<option  value="<?php echo date('Y', strtotime('+1 year'));?>-0"> 
															Informática biomédica 1 (<?php echo date('Y', strtotime('+1 year'));?>-0)</option>
														<option  value="<?php echo date('Y', strtotime('+1 year'));?>-1" > 
															Informática biomédica 2 (<?php echo date('Y', strtotime('+1 year'));?>-1)</option> 
														<option  value="<?php echo date('Y', strtotime('+2 year'));?>-0" > 
															Informática biomédica 1 (<?php echo date('Y', strtotime('+2 year'));?>-0)</option> 
														<option  value="<?php echo date('Y', strtotime('+2 year'));?>-1" > 
															Informática biomédica 2 (<?php echo date('Y', strtotime('+2 year'));?>-1)</option> 
															</select></p>
													</div>
													<div class="form-check">
														<p><label  class="col-form-label">Rol:</label><select name="rol">
															<option value="Profesor" >Profesor</option>
															<option value="Ayudante" >Ayudante</option>	 														   
															<option value="Instructor" >Instructor</option>	
														</select></p>														 													
													</div>
													<div class="col-auto">
														<button type="submit" class="btn btn-primary mb-3">Agreagar</button>
													</div>	
												</form>
											</div>
										</div>	
										<!--ASIGNAR GRUPO-->	
										<div class="panel panel-warning collapse" id="<?php echo  $row["id_registro"].'_'.$row["id_registro"];?>">
											<div class="panel-heading">
												<h2 class="panel-title">Asignar Grupo</h2>
											</div>
											<div class="panel-body">
												<form action="visualizar.php?id=<?php echo $row["id_registro"];?>&ac=2" method="POST">
													<div class="form-group">
														<p><label  class="form-check">Grupo:</label>
														<input type="number" name="grupo"></p>
													</div>
													<div class="form-group">
														<p><label  class="form-check">Inicio:</label>
														<input type="date" name="inicio"></p>
													</div>
													<div class="form-group">
														<p><label  class="form-check">Fin:</label>
														<input type="date" name="fin"></p>
													</div>
													<div class="col-auto">
														<button type="submit" class="btn btn-primary mb-3">Agreagar</button>
													</div>	
												</form>
											</div>
										</div>		
									</div>
							<?php	
									} //echo '<p>'.$reg.' prueba</p>'; 
									if($numero > 10){ ?>
									<ul class="pager">
										<?php if($reg >10){?> 
										<li><a href="visualizar.php?reg=<?php echo $reg-$filas;?>&back=1">Anterior</a></li>
										
										
										<?php }if ($reg < 10){?> 
										<li><a href="visualizar.php?reg=<?php echo $reg;?>&back=1">Anterior</a></li> 
										
										
										<?php }if($filas == 10) { ?>
										<li><a href="visualizar.php?reg=<?php echo $reg;?>">Siguiente</a></li>
										<?php } ?>
									  </ul>
							<?php	
									}
								}	
							?>
						
							
								
						</div>
						<?php
							if(($_SERVER["REQUEST_METHOD"] == "POST" ) && (isset($_GET["ac"]))){
								if($_GET["ac"] == 1){
								$id = $_GET["id"];
								curso($id);
								}
								if($_GET["ac"] == 2){
								$id = $_GET["id"];
								grupo($id);
								//var_dump($_POST);
								}
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

  </body>
</html>
