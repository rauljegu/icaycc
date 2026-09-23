<?php 
function user($a) {
			switch($a){
				case "0":
					 return array("panel-success","<h3 class='panel-title'><a href='index.php'>Administrar Roles</a> > Lista de superusuarios. </h3>","0","Superusuarios");
					
				break;
				case "1":
					 return array("panel-info","<h3 class='panel-title'><a href='index.php'>Administrar Roles</a> > Lista de administradores. </h3>","1","Adminstradores");
				break;
				case "2":
					return array("panel-danger","<h3 class='panel-title'><a href='index.php'>Administrar Roles</a> > Lista de usuarios. </h3>","2","Usuarios");
				break;
			}
	
	}
function create_user($a) {
			switch($a){
				case "0":
					 return array("panel-success","<h3 class='panel-title'><a href='index.php'>Administrar Roles</a> > Crear superusuario. </h3>","0","Superusuarios");
					
				break;
				case "1":
					 return array("panel-info","<h3 class='panel-title'><a href='index.php'>Administrar Roles</a> > Crear administrador. </h3>","1","Adminstradores");
				break;
				case "2":
					return array("panel-danger","<h3 class='panel-title'><a href='index.php'>Administrar Roles</a> > Crear usuario.. </h3>","2","Usuarios");
				break;
			}
	
	}
function insert_user($a){
			switch($a){
				case "0":
					$r = 0;			
				break;
				case "1":
					 $r = 1;	
				break;
				case "2":
					$r = 2;	
				break;
			}
			//echo $_POST['pas'];
			//var_dump($_POST);
			$sql = "INSERT INTO users SET 
			name = '".$_POST['nombre']."',
			materno = '".$_POST['mat']."',
			paterno = '".$_POST['pat']."',
			login = '".$_POST['usr']."',
			password = '".MD5($_POST['pass'])."',
			role = '$r',
			correo = '".$_POST['mail']."',
			departamento = '19',
			activo = 1
			";
				//echo $sql;
				include'conexion.php';
         //Envio la consulta sql
         $resultado = $conn->query($sql); // si hay conexion TRUE // si no hay conexion // FALSE
         // ! negando el resultado !TRUE =  FALSO ;; !FALSO = TRUE
         //COMPRUEBO mi consulta
         if(!$resultado){ //SI: NO TRUE (FALSE)
                          $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
                          } else {
                                  // SI: NO FALSE (TRUE)
                                echo '<script type="text/javascript">alert("Usuaurio creado correctamente");window.location.href="usuario.php?id='.$r.'";</script>';
                                  }
          //mysqli_close($conn);
	}
function edit_user($a) {
			switch($a){
				case "0":
					 return array("panel-success","<h3 class='panel-title'><a href='index.php'>Administrar Roles</a> > <a href='usuario.php?id=0'>Lista de superusuarios.</a> > Editar superusuario </h3>","0","Superusuarios");
					
				break;
				case "1":
					 return array("panel-info","<h3 class='panel-title'><a href='index.php'>Administrar Roles</a> > <a href='usuario.php?id=1'>Lista de administradores.</a> > Editar administrador </h3>","1","Adminstradores");
				break;
				case "2":
					return array("panel-danger","<h3 class='panel-title'><a href='index.php'>Administrar Roles</a> ><a href='usuario.php?id=1'>Lista de usuarios.</a> > Editar usuario </h3>","2","Usuarios");
				break;
			}
	
	}
function update_user($a){
			switch($a){
				case "0":
					$r = 0;			
				break;
				case "1":
					 $r = 1;	
				break;
				case "2":
					$r = 2;	
				break;
			}
			//echo $_POST['pas'];
			//var_dump($_POST);
			$sql = "UPDATE users SET 
			name = '".$_POST['nombre']."',
			login = '".$_POST['login']."',
			correo = '".$_POST['correo']."',
			activo = '".$_POST['activo']."'
			where id = '".$_POST['id']."'
			";
				//echo $sql;
				include'conexion.php';
         //Envio la consulta sql
         $resultado = $conn->query($sql); // si hay conexion TRUE // si no hay conexion // FALSE
         // ! negando el resultado !TRUE =  FALSO ;; !FALSO = TRUE
         //COMPRUEBO mi consulta
         if(!$resultado){ //SI: NO TRUE (FALSE)
                          $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
                          } else {
                                  // SI: NO FALSE (TRUE)
                                echo '<script type="text/javascript">alert("Registro editado correctamente");window.location.href="usuario.php?id='.$r.'";</script>';
                                  }
          //mysqli_close($conn);
	}
function registro(){
   function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
    $server = limpiar($_POST["server"]);
    $modelo = limpiar($_POST["modelo"]);
    $etiqueta = limpiar($_POST["etiqueta"]);
    $rack = limpiar($_POST["rack"]); if($rack == !null){ $r= "rack = '$rack',";}
    $nivel = limpiar($_POST["nivel"]); if($nivel == !null){ $n= "nivel = '$nivel',";}
    $posicion = limpiar($_POST["posicion"]);if($posicion == !null){ $p= "posicion = '$posicion',";}
    $ippublica = limpiar($_POST["ippublica"]);
    $iplocal = limpiar($_POST["iplocal"]);if($iplocal == !null){ $ipl= "iplocal = '$iplocal',";}
    $ubicacion = limpiar($_POST["ubicacion"]);
    $puerto = limpiar($_POST["puerto"]);
    $status = limpiar($_POST["status"]);
    $tipo = limpiar($_POST["tipo"]);
    $externo1 = limpiar($_POST["externo1"]);
    $contenido = limpiar($_POST["contenido"]);
    $servicetag = limpiar($_POST["servicetag"]);


    $sql="INSERT INTO servers SET
    server = '$server',
    modelo = '$modelo',
    etiqueta = '$etiqueta',
    servicetag = '$servicetag',".
    $r.
    $n.
	$p."
    ippublica = '$ippublica',
    iplocal = '$iplocal',

    ubicacion = '$ubicacion',
    puerto = '$puerto',
    status = '$status',
    tipo = '$tipo',
    externo1 = '$externo1',
    contenido = '$contenido'
    ;";
  // echo "<br>".$sql;

    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
				$s="SELECT * FROM servers ORDER BY id_servers";
				//echo $sql;
				$result = $conn->query($s);
				$filas = $result->num_rows;	
				$filas = intval($filas);
				//$filas = $filas +1;
		
		
			$sq = "UPDATE locales_asignadas SET activo = 0 WHERE id_ipl = '$iplocal'";
			include'conexion.php';
			$res = $conn->query($sq);	
			$sql1="INSERT INTO locales_asignadas SET
			id_servers = '$filas',
			id_ipl = '$iplocal',
			activo = 1,
			fecha = '".date('Y-m-d')."';";
			include'conexion.php';
			if($iplocal == !null){
				$resultado1 = $conn->query($sql1);
				if(!$resultado1){
					$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
				} else {
					include'conexion.php';
					$sql2="UPDATE  locales SET
					asignada = 1 WHERE 
					id_ipl = '$iplocal' ;";
					include'conexion.php';
					$resultado2 = $conn->query($sql2);
					if(!$resultado1){
						$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
					} else {		
							  echo '<script type="text/javascript">alert("Servidor registrado correctamente");window.location.href="servers.php";</script>';
							 // header("refresh: 3; url = formulario.php");
					}
				}	
			}			
    }
 }
function actualizar_registro(){
   function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
	$server = limpiar($_POST["server"]);
    $modelo = limpiar($_POST["modelo"]);
    $etiqueta = limpiar($_POST["etiqueta"]);
	$rack = limpiar($_POST["rack"]); if($rack == !null){ $r= "rack = '$rack',";}
    $nivel = limpiar($_POST["nivel"]); if($nivel == !null){ $n= "nivel = '$nivel',";}
    $posicion = limpiar($_POST["posicion"]);if($posicion == !null){ $p= "posicion = '$posicion',";}
	 $servicetag = limpiar($_POST["servicetag"]);
    $ippublica = limpiar($_POST["ippublica"]);
    $iplocal = limpiar($_POST["iplocal"]);/*if($iplocal == !null){ $ipl= "iplocal = '$iplocal',";}*/
    $dominio = limpiar($_POST["dominio"]);
    $puerto = limpiar($_POST["puerto"]);
    $status = limpiar($_POST["status"]);
    $tipo = limpiar($_POST["tipo"]);
    $contenido = limpiar($_POST["contenido"]);
	   $ubicacion = limpiar($_POST["ubicacion"]);
	
	
	$u="UPDATE locales SET asignada = 0 WHERE '".$_GET["ipante"]."'";
	include'conexion.php';
	$res = $conn->query($u);
    $sql="UPDATE servers SET
	server = '$server',
    modelo = '$modelo',
    etiqueta = '$etiqueta',
    servicetag = '$servicetag',".
    $r.
    $n.
	$p."
    ippublica = '$ippublica',
    iplocal = '$iplocal',

    ubicacion = '$ubicacion',
    puerto = '$puerto',
    status = '$status',
    tipo = '$tipo',
    externo1 = '$externo1',
    contenido = '$contenido'
	WHERE id_servers = '".$_GET["id"]."'
    ;";
   // echo "<br>".$sql;

    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
			$s="SELECT * FROM servers ORDER BY id_servers";
			//echo $sql;
			$result = $conn->query($s);
			$filas = $result->num_rows;	
			$filas = intval($filas);
				//$filas = $filas +1;
		
		
			$sq = "UPDATE locales_asignadas SET activo = 0 WHERE id_ipl = '".$_GET["ipante"]."' OR id_servers ='".$_GET["id"]."' ";
			include'conexion.php';
			$res = $conn->query($sq);	
			$sql1="INSERT INTO locales_asignadas SET
			id_servers = '".$_GET["id"]."',
			id_ipl = '$iplocal',
			activo = 1,
			fecha = '".date('Y-m-d')."';";
			include'conexion.php';
			if($iplocal == !null){
				$resultado1 = $conn->query($sql1);
				if(!$resultado1){
					$error = $conn->error; echo "EXISTE UN ERROR EN Locales asignadas: ".$error;
				} else {
					include'conexion.php';
					$sql2="UPDATE  locales SET
					asignada = 1 WHERE 
					id_ipl = '$iplocal' ;";
					include'conexion.php';
					$resultado2 = $conn->query($sql2);
					if(!$resultado1){
						$error = $conn->error; echo "EXISTE UN ERROR EN locales:  ".$error;
					} else {		
							   echo '<script type="text/javascript">alert("Server Actualizado correctamente");window.location.href="servers.php?id='.$_GET["id"].'";</script>';
								// header("refresh: 3; url = formulario.php");
					}
				}	
			}	else {
				 echo '<script type="text/javascript">alert("Server Actualizado correctamente");window.location.href="servers.php?id='.$_GET["id"].'";</script>';
			}
				
    }
 }

 
 
 /////REGISTRO EQUIPOS
  function registro_equipo(){
   function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
    $nombre = limpiar($_POST["nombre"]);
    $responsable = limpiar($_POST["responsable"]);
    $etiqueta = limpiar($_POST["etiqueta"]);
    $modelo = limpiar($_POST["modelo"]);
    $servicetag = limpiar($_POST["servicetag"]);
    $fecha = limpiar($_POST["fecha"]);


    $sql="INSERT INTO equipos SET
    nombre = '$nombre',
    responsable = '$responsable',
    etiqueta = '$etiqueta',
    modelo = '$modelo',
    servicetag = '$servicetag',
    fecha = '$fecha'
    ;";
   echo "<br>".$sql;


    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
		//profesor();
      echo '<script type="text/javascript">alert("Equipo registrado correctamente");window.location.href="ips.php";</script>';
     // header("refresh: 3; url = formulario.php");
    }
 }
 ////////////Actualizar equipo
 
   function actualizar_equipo(){
   function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
    $nombre = limpiar($_POST["nombre"]);
    $responsable = limpiar($_POST["responsable"]);
    $etiqueta = limpiar($_POST["etiqueta"]);
    $modelo = limpiar($_POST["modelo"]);
    $servicetag = limpiar($_POST["servicetag"]);
    $fecha = limpiar($_POST["fecha"]);
    $id = limpiar($_GET["id"]);


    $sql="UPDATE equipos SET
    nombre = '$nombre',
    responsable = '$responsable',
    etiqueta = '$etiqueta',
    modelo = '$modelo',
    servicetag = '$servicetag',
    fecha = '$fecha' 
	WHERE id_equipo ='$id'
    ;";
   echo "<br>".$sql;


    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
		//profesor();
      echo '<script type="text/javascript">alert("Equipo registrado correctamente");window.location.href="equipos.php";</script>';
     // header("refresh: 3; url = formulario.php");
    }
 }
 
 /////ASIGNAR IP LOCALES 
  function asignar_ipl(){
   function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
    $equipo = limpiar($_POST["equipo"]);
    $server = limpiar($_POST["server"]);
    $ip = limpiar($_POST["ip"]);
    $fecha = limpiar($_POST["fecha"]);
	$sq = "UPDATE locales_asignadas SET activo = 0 WHERE id_ipl = '$ip'";
	include'conexion.php';
    $res = $conn->query($sq);
	
	
	if($equipo == null){
		$sq2 = "UPDATE locales_asignadas SET activo = 0 WHERE id_servers = '$server'";
	include'conexion.php';
    $res2 = $conn->query($sq2);
    $sql="INSERT INTO locales_asignadas SET
    id_servers = '$server',
    id_ipl = '$ip',
	activo = 1,
    fecha = '$fecha'
    ;";
	echo "<br>".$sql;
	$u="UPDATE servers SET iplocal = '$ip' WHERE id_servers = $server";
	include'conexion.php';
    $resu = $conn->query($u);
	
	}
	if($server == null){
	$sq2 = "UPDATE locales_asignadas SET activo = 0 WHERE id_equipo = '$equipo'";
	include'conexion.php';
    $res2 = $conn->query($sq2);
    $sql="INSERT INTO locales_asignadas SET
    id_equipo = '$equipo',
    id_ipl = '$ip',
	activo = 1,
    fecha = '$fecha'
    ;";
	echo "<br>".$sql;
	$u="UPDATE equipos SET id_locales = '$ip' WHERE id_equipo= $equipo";
	include'conexion.php';
    $resu = $conn->query($u);
	}

    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
		 include'conexion.php';
		$sql1="UPDATE  locales SET
		asignada = 1 WHERE 
		id_ipl = '$ip' ;";
		include'conexion.php';
		$resultado1 = $conn->query($sql1);
		if(!$resultado1){
		$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
		}
		//profesor();
      echo '<script type="text/javascript">alert("Ip Local asignada correctamente");window.location.href="ipsl.php";</script>';
     // header("refresh: 3; url = formulario.php");
    }
 }
 
 function liberar(){
	include'conexion.php';
	$sql="UPDATE  locales SET
	asignada = 0 WHERE 
	id_ipl = '".$_GET["ip"]."' ;";
	$resultado = $conn->query($sql);
	if(!$resultado){
		$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
	} else {
			$sq="UPDATE  locales_asignadas SET
			activo = 0 WHERE 
			id_ipl = '".$_GET["ip"]."' 
			 
			;";
			include'conexion.php';
			$resultado1 = $conn->query($sq);
			if(!$resultado1){
				$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
			} else {
				$sq="UPDATE  locales_asignadas SET
				activo = 0 WHERE 
				id_ipl = '".$_GET["ip"]."' ;";
				include'conexion.php';
				$resultado1 = $conn->query($sq);
				if(!$resultado1){
					$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
				} else {
					if($_GET["pc"] == null){
						$pc="UPDATE servers SET iplocal = null WHERE id_servers ='".$_GET["ser"]."'";
						include'conexion.php';
						$res = $conn->query($pc);
						if(!$res){
							$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
							} else {
								 echo '<script type="text/javascript">alert("Ip Local Liberada correctamente");window.location.href="ipsl.php";</script>';
							}	
					} else {
						$pc="UPDATE equipos SET id_locales = null WHERE id_equipo ='".$_GET["pc"]."'";
						include'conexion.php';
						$res = $conn->query($pc);
						if(!$res){
							$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
							} else {
								 echo '<script type="text/javascript">alert("Ip Local Liberada correctamente");window.location.href="ipsl.php";</script>';
							}
					}
					
					
				}	
			}
	} 
 }
 
function dominio(){
   function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
    $dominio = limpiar($_POST["dominio"]);
	$fecha = date("Y-m-d");
    $sql="INSERT INTO dominios SET
    dominio = '$dominio',
    fecha = '$fecha'
    ;";
   echo "<br>".$sql;


    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
		//profesor();
      echo '<script type="text/javascript">alert("Dominio registrado correctamente");window.location.href="ips.php";</script>';
     // header("refresh: 3; url = formulario.php");
    }
 }
 
function asignar_dominio(){
	function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
    if(isset($_POST["dominio"])){$dominio = limpiar($_POST["dominio"]); } else { $dominio = $_GET["dominio"];}
    if(isset($_GET["server"])){$server = limpiar($_GET["server"]) ;} else { $server = $_POST["server"];}
   // $server = limpiar($_GET["server"]);
	$fecha = date("Y-m-d");
    $sql="INSERT INTO dominios_asignados SET
    id_dominios = '$dominio',
    id_servers = '$server',
    activo = 1,
    fecha = '$fecha'
    ;";
   echo "<br>".$sql;


    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
		//profesor();
      echo '<script type="text/javascript">alert("Dominio asignado correctamente");window.location.href="servers.php";</script>';
     // header("refresh: 3; url = formulario.php");
    }		
}


function quitar_dominio(){
	function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
    if(isset($_POST["dominio"])){$dominio = limpiar($_POST["dominio"]); } else { $dominio = $_GET["dominio"];}
    if(isset($_GET["server"])){$server = limpiar($_GET["server"]) ;} else { $server = $_POST["server"];}
   // $server = limpiar($_GET["server"]);
	$fecha = date("Y-m-d");
    $sql="UPDATE dominios_asignados SET
    activo = 0
	WHERE
	id_dominios = '$dominio' AND
    id_servers = '$server'
    
    ;";
   echo "<br>".$sql;


    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
		//profesor();
      echo '<script type="text/javascript">alert("Dominio retirado correctamente");window.location.href="servers.php";</script>';
     // header("refresh: 3; url = formulario.php");
    }		
}
?>