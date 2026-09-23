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
	<!--<script src="funciones.js">

</script>-->
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
						<h2 class="panel-title">Editando Registro <?= $_GET["id"]; ?></h2>
					</div>
					<div class="panel-body">
						<?php
							$registro = $_GET["id"];
							//echo $numero;
							$sql="SELECT * FROM registros WHERE id_registro = '".$registro."' ORDER BY id_registro $limite $inicio $idr";
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
												<p><center>Información personal</center></p>										
											</div>
										<!-- Default panel contents -->
										
											<table class="table table-hover table-condensed">
												<form action="<?php echo  htmlspecialchars('editar_registro.php?actualizar=1&id='.$row["id_registro"]); ?>" method="POST">
												<tr class="info">
													<th colspan="4"><center>Nombre</center></th>
												</tr>
												<tr>
													<td><div class="panel-heading"><input type='text' style='color:black' name='nombre' value='<?php echo $row["nombre"]; ?>'></div></td>
													<td><div class="panel-heading"><input style='color:black' type='text' name='apellido_paterno' value='<?php echo $row["apellido_paterno"]; ?>'></div></td> 
													<td><div class="panel-heading"><input style='color:black' type='text' name='apellido_materno' value='<?php echo $row["apellido_materno"]; ?>'></div></td>
													<td></td>
												</tr>																							
												<tr class="info">
													<th>Género</th>
													<th>(Otro)</th>
													<th>Fecha de nacimiento</th>
													<th>CURP</th>
												</tr>
												<tr >
													<td>
														<select name="genero" required>
														<option value="<?php echo $row["genero"]; ?>">
														<?php
																echo ($row["genero"] == "H") ?  "Masculino" : (($row["genero"] == "M") ? "Femenino" : "Otro");
																
														?>
														</option>
														<option value="H">Masculino</option>
														<option value="M">Femenino</option>
														<option value="Otro">Otro</option>
														</select>
													</td>
													<td> <input type="text" name="genero_otro" placeholder="Si no aplica, omitir" value="<?php echo $row["genero_otro"]; ?>"></td>
													<td><input type="text" name="fecha_nac" placeholder="DDMMAAAA" value="<?php echo $row["fecha_nac"]; ?>"></td>
													<td><input type="text" name="curp" value="<?php echo $row["curp"]; ?>"></td>
												</tr>											
												<tr class="info">		
													<th>RFC</th>
													<th>No. de trabajador</th>
													<th>No. de cuenta</th>
													<th></th>
												</tr>
												<tr>	
													<td><input type="text" name="rfc" value="<?php echo $row["rfc"]; ?>"></td>
													<td><input type="text" name="num_trabajador" value="<?php echo $row["num_trabajador"]; ?>"></td>
													<td><input type="text" name="num_cuenta" value="<?php echo $row["num_cuenta"]; ?>"></td>
													<td></td>
												</tr>
												<tr class="success">
													<th colspan="4"><center>Información de contacto</center></th>
												</tr>
												<tr class="success">	
													<th colspan="2">Correo 1</th>
													<th colspan="2">Correo 2</th>
												</tr>
												<tr>												
													<td colspan="2"><input type="mail" name="correo1" value="<?php echo $row["correo1"]; ?>"></td>
													<td colspan="2"><input type="mail" name="correo2" value="<?php echo $row["correo2"]; ?>"></td>
												</tr>
												<tr class="success">	
													<th>Telefono 1</th>
													<th>Telefono 2</th>
													<th>Talla bata</th>
													<th></th>
												</tr>											
												<tr>	
													 <td><input type="text" name="tel1" value="<?php echo $row["tel1"]; ?>"></td>
													 <td><input type="text" name="tel2" value="<?php echo $row["tel2"]; ?>"></td>
													 <td><input type="text" name="talla_bata" value="<?php echo $row["talla_bata"]; ?>"></td>
													 <td></td>
												</tr>
												<tr class="warning">												
													<th colspan="4"><center>Trayectoria académica</center></th>
												</tr>
												<tr class="warning">												
													<th>Licenciatura</th>
													<th>Maestria</th>
													<th>Doctorado</th>
													<th>Postdoctorado</th>
												</tr>
												<tr>
													<td>
														<?php
															$lic = explode(".", $row["licenciatura"]);
															$largo = count($lic);
															for ($i=0; $i<$largo; $i++){
															if(!empty($lic[$i])){
																$id = $i +1;
																if($id == 1){ //$id1 = "";
																$id1= 'id="lic'.$id.'"';
																} else { $id1= 'id="lic'.$id.'"';}
																//echo '<p> Lic. '.$id.' <input '.$id1.'" onchange="ni2(this.id)"type="text"  value="'.$lic[$i].'"required readonly><p>';
																echo '<p> <input '.$id1.'" onchange="ni2(this.id)"type="text"  value="'.$lic[$i].'"required ></p>';
															} else { $largo = 0;/* echo "Empty";*/ $id= 0;}
														}
														?>
														<!--<p><input id="lic1" onchange="ni2(this.id)"type="text" value="<?php echo $row["licenciatura"]; ?>"  hidden required></p>-->
														<p>Añadir  
														<?php //$largo+1;?> Lic. <input id="lic<?php echo $id+1;?>" onchange="ni2(this.id)"type="text"   ></p>
														<input type="text" id ="lic" name="licenciatura" value="<?php echo $row["licenciatura"].'.'; ?>" hidden>
														
													</td>
													
													<!--<td><select name="maestria" required>
															<option value="<?php echo $row["maestria"]; ?>"><?php echo $row["maestria"]; ?></option>						
														</select>
													</td>-->
													<td>
														<?php
															$mas = explode(".", $row["maestria"]);
															$largo = count($mas);
															for ($i=0; $i<$largo; $i++){
															if(!empty($mas[$i])){
																$id = $i +1;
																if($id == 1){ //$id1 = "";
																$id1= 'id="mas'.$id.'"';
																} else { $id1= 'id="mas'.$id.'"';}
																echo '<p><input '.$id1.'" onchange="nim2(this.id)"type="text"  value="'.$mas[$i].'"required ></p>';
															} else { $largo = 0;/* echo "Empty";*/ $id= 0;}
														}
														?>
														<!--<p><input id="mas1" onchange="nim2(this.id)"type="text" value="<?php echo $row["maestria"]; ?>"  hidden required></p>-->
														<p>Añadir. 
														<?php // $largo+1;?> Mtria.<input id="mas<?php echo $id+1;?>" onchange="nim2(this.id)"type="text"   ></p>
														<input type="text" id ="mas" name="maestria" value="<?php echo $row["maestria"].'.'; ?>" hidden>
														
													</td>					
													<!--<td>
														<select name="doctorado" required>
															<option value="<?php echo $row["doctorado"]; ?>"><?php echo $row["doctorado"]; ?></option>														
													</td>-->
													<td>
														<?php
															$doc = explode(".", $row["doctorado"]);
															$largo = count($doc);
															for ($i=0; $i<$largo; $i++){
															if(!empty($doc[$i])){
																$id = $i +1;
																if($id == 1){ //$id1 = "";
																$id1= 'id="doc'.$id.'"';
																} else { $id1= 'id="doc'.$id.'"';}
																echo '<p> <input '.$id1.'" onchange="nid2(this.id)"type="text"  value="'.$doc[$i].'"required ></p>';
															} else { $largo = 0;/* echo "Empty";*/ $id= 0;}
														}
														?>
														<!--<p><input id="doc1" onchange="nid2(this.id)"type="text" value="<?php echo $row["doctorado"]; ?>"  hidden required></p>-->
														<p>Añadir PhD. 
														<?php //= $largo+1;?> <input id="doc<?php echo $id+1;?>" onchange="nid2(this.id)"type="text"   ></p>
														<input type="text" id ="doc" name="doctorado" value="<?php echo $row["doctorado"].'.'; ?>" hidden>
														
													</td>	
													<td>
													<?php
															$pos = explode(".", $row["posdoc"]);
															$largo = count($pos);
															//var_dump($pos);
															//echo $largo;
															for ($i=0; $i<$largo; $i++){
															if(!empty($pos[$i])){
																$id = $i +1;
																if($id == 1){// $id1 = "";
																$id1= 'id="pos'.$id.'"';
																} else { $id1= 'id="pos'.$id.'"';}
																echo '<p> <input '.$id1.'" onchange="nip2(this.id)"type="text"  value="'.$pos[$i].'"required ></p>';
															} else { $largo = 0;/* echo "Empty";*/ $id= 0;}
														}
														?>
														<!--<p><input id="pos1" onchange="nip2(this.id)"type="text" value="<?php echo $row["posdoc"]; ?>"  hidden required></p>-->
														<p>Añadir P.D. 
														<?php //= $largo+1;?> <input id="pos<?php echo $id+1;?>" onchange="nip2(this.id)"type="text"   ></p>
														<input type="text" id ="pos" name="posdoc" value="<?php echo $row["posdoc"].'.'; ?>" hidden>
													</td>
												</tr>	
												<tr class="warning">
													<th>Especialidad</th>
													<th></th>
													<th>APPAUNAM</th>
													<th>Ultimo grado obtenido</th>
													
												</tr>	
												<tr>
													
														
														<td>
													<?php
															$esp = explode(".", $row["Especialidad"]);
															$largo = count($esp);
															//var_dump($esp);
															//echo $largo;
															for ($i=0; $i<$largo; $i++){
															if(!empty($esp[$i])){
																$id = $i +1;
																if($id == 1){// $id1 = "";
																$id1= 'id="esp'.$id.'"';
																} else { $id1= 'id="esp'.$id.'"';}
																echo '<p> <input '.$id1.'" onchange="nie2(this.id)"type="text"  value="'.$esp[$i].'"required ></p>';
															} else { $largo = 0;/* echo "Empty";*/ $id= 0;}
														}
														?>
														<!--<p><input id="pos1" onchange="nip2(this.id)"type="text" value="<?php echo $row["posdoc"]; ?>"  hidden required></p>-->
														<p>Añadir Especialidad 
														<?php //= $largo+1;?> <input id="esp<?php echo $id+1;?>" onchange="nie2(this.id)"type="text"   ></p>
														<input type="text" id ="esp" name="Especialidad" value="<?php echo $row["Especialidad"].'.'; ?>"hidden >
													</td>
													
													<td></td>
													<td><select name="appaunam" required>
															<option value="<?php echo $row["appaunam"]; ?>"><?php echo $row["appaunam"]; ?></option>
															<option value="Si">Si</option>
															<option value="No">No</option>
														</select>
													</td>
													<td><select name="ultimo_grado" required>
															<option value="<?php echo $row["ultimo_grado"]; ?>"><?php echo $row["ultimo_grado"]; ?></option>
															<option value="Licenciatura">Licenciatura</option>
															<option value="Maestria">Maestría</option>
															<option value="Doctorado">Doctorado</option>
															<option value="Especialidad">Especialidad</option>
														</select>
													</td>
													
												</tr>																																		
												<tr class="warning">
													<th colspan="4"><center>Trayectoria de profesor IB</center></th>
												</tr>
												<tr class="warning">												
													<th colspan="">Año de ingreso</th>												
													<th colspan="">Nombramiento</th>												
													<th colspan="">Año de Nombramiento</th>
													<th colspan=""><p>Añadir Nombramiento</p></th>
												</tr>											
												<tr>												
													<td colspan=""><input type="text" name="ingreso" value="<?php echo $row["ingreso"]; ?>"></td>																								
													
														<div id="nombras">
														<?php 
														$nomb = explode(".", $row["nombramiento"]);
														//var_dump($nomb);
														 $ln = count($nomb);
														$id = 0;
														echo '<td>';
														if($nomb[0]!= ""){
														for($i=0; $i<$ln; $i++){
															$id = $id +1;
															if(!empty($nomb[$i])){																										
																$nomb1= explode("-",$nomb[$i]);
																echo'<input id="nom'.$id.'" type="text" value="'.$nomb1[0].'" onchange="valoresnom(this.id)" required><br/>';
																//echo '<td><input id="anom'.$id.'" type="text" value="'.$nomb1[1].'" onchange="no1(this.id)" type="number"></td>';

															}
														}
														echo '</td><td>';
														$id1 = 0;
														for($i=0; $i<$ln; $i++){
															$id1 = $id1 +1;
															if(!empty($nomb[$i])){																										
																$nomb1= explode("-",$nomb[$i]);
																//echo '<td><input id="nom'.$id.'" type="text" value="'.$nomb1[0].'" required></td>';
																echo '<input id="anom'.$id1.'"  value="'.$nomb1[1].'" onchange="no1(this.id), valoresnom(this.id)" type="number">';

															}
														}
														} else { echo '<td></td>';}
														echo '</td>';
													?>	
												
											
															</div> <?php// }
														//else { $largo = 0;/* echo "Empty";*/ $id= 0;}
													//	}
													?>	
													<td>
														<div id="nombras">
															<p>Nombramiento : <input id="nom<?php echo $id+1;?>"  type="text"  ></p>
															<p>Año de nombramiento : <input id="anom<?php echo $id+1;?>" onchange="no1(this.id)" type="number" ></p>															
														</div>
														<input id="nom"  name="nombramiento" value="<?php echo $row["nombramiento"].'.'; ?>" hidden>
													</td>
												 
													
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
												<tr class="warning">		
													<th colspan="2">Cursos</th>
													<th >Rol</th>
													<th >Acciones</th>												
												</tr>
												<tr>	
													<?php 
														include 'conexion.php';
														$sql1= "SELECT * FROM `asignaturas` WHERE id_registro = ".$row["id_registro"]."";
														$result1 = $conn->query($sql1);
														if ($result1 -> num_rows>0){
															echo '<td colspan="2"><ul>';
															while($row1=$result1->fetch_assoc()){
																echo	"<li>".$row1["asignatura"]."<a href='editar_registro.php?quitar=2&id_as=".$row1["id_asignatura"]."&id=".$row["id_registro"]."'> quitar Asignatura</a></li>";																											 
															}
															echo '</ul></td>';
														} else { ?>
												
															<td colspan="2"></td>
												  <?php } 
														include 'conexion.php';
														$sql1= "SELECT * FROM `asignaturas` WHERE id_registro = ".$row["id_registro"]."";
														$result1 = $conn->query($sql1);
														if ($result1 -> num_rows>0){
															echo '<td ><ul>';
															while($row1=$result1->fetch_assoc()){
																echo	"<li>".$row1["rol"]."<a href='editar_registro.php?quitar=2&id_as=".$row1["id_asignatura"]."&id=".$row["id_registro"]."'> quitar rol</a></li>";																											 
															}
															echo '</ul></td>';
														}	else { ?>												
															<td ></td>
												  <?php } ?>
												  
													<td >
														<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#<?php echo $row["id_registro"];?>" aria-expanded="false" aria-controls="collapseExample">Asignar Cursos</button>
													</td>
												
												</tr>
											<tr class="warning">
												
												<th colspan="7"><center>Grupos</center></th>
											</tr>
											<tr class="warning">
												
												<th colspan="">Grupo</th>
												<th colspan="">Inicio</th>
												<th colspan="">Fin</th>												
												<th colspan="">Acciones</th>												
											</tr>	
											<?php 
												include 'conexion.php';
												  $sql3= "SELECT * FROM `grupos` WHERE id_registro = ".$row["id_registro"]."";
												  $result3 = $conn->query($sql3);
												  if ($result3 -> num_rows>0){
													 
													while($row3=$result3->fetch_assoc()){
													  echo '<tr><td colspan="">'.$row3["grupo"].'</td><td colspan="">'.$row3["inicio"].'</td><td colspan="">'.$row3["fin"].'</td>';
													
													}	?><td colspan=""><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#<?php echo $row["id_registro"].'_'.$row["id_registro"];?>" aria-expanded="false" aria-controls="collapseExample">Asignar Grupo</button></td>									
												</tr>
												<?php  }else { ?>
												<tr>
													<td colspan="">No Aplica o No asignado</td>
													<td colspan="">No Aplica o No asignado</td>
													<td colspan="">No Aplica o No asignado</td>
													<td colspan=""><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#<?php echo $row["id_registro"].'_'.$row["id_registro"];?>" aria-expanded="false" aria-controls="collapseExample">Asignar Grupo</button></td>
												</tr>												
												<?php } ?>												
											</table>									
											<div class="panel panel-warning collapse" id="<?php echo $reg = $row["id_registro"];?>">
												<div class="panel-heading">
													<h2 class="panel-title">Asignar Curso</h2>
												</div>
												<div class="panel-body">
													<form action="editar_registro.php?id=<?php echo $row["id_registro"];?>&curso=1" method="POST">
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
												<form action="editar_registro.php?id=<?php echo $row["id_registro"];?>&ac=2" method="POST">
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
												<li><a href="visualizar.php?reg=<?php echo $reg;?>&back=1">Anterior</a></li>
												<?php } if($filas == 10) { ?>
															<li><a href="visualizar.php?reg=<?php echo $reg;?>">Siguiente</a></li>
										<?php 				} ?>
										</ul>
							<?php	
									}
								}	
							?>								
								</div>
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
<script src="funciones.js">

</script>
