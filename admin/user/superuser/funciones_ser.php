<?php

function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
//////SERVERS
function registro(){
   
    $server = limpiar($_POST["server"]);
    $modelo = limpiar($_POST["modelo"]);
    $etiqueta = limpiar($_POST["etiqueta"]);
    $rack = limpiar($_POST["rack"]); if($rack == !null){ $r= "rack = '$rack',";}
    $nivel = limpiar($_POST["nivel"]); if($nivel == !null){ $n= "nivel = '$nivel',";}
    $posicion = limpiar($_POST["posicion"]);if($posicion == !null){ $p= "posicion = '$posicion',";}
    $ippublica = limpiar($_POST["ippublica"]);
    $iplocal = limpiar($_POST["iplocal"]);if($iplocal == !null){ $ipl= "iplocal = '$iplocal',";} else { $iplocal = NULL; }
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
    ippublica = '$ippublica',".
    $ipl."
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
			if($iplocal == !NULL){
				//Se obtiene el id_servers recien creado para actulizar las iplocales 
				$s="SELECT * FROM servers ORDER BY id_servers";
				//echo $sql;
				$result = $conn->query($s);
				$filas = $result->num_rows;	
				$filas = intval($filas);
				//Se inserta la asignacion de IP local
				$sql1="INSERT INTO locales_asignadas SET
				id_servers = '$filas',
				id_ipl = '$iplocal',
				activo = 1,
				fecha = '".date('Y-m-d')."';";
				include'conexion.php';
					$resultado1 = $conn->query($sql1);
					if(!$resultado1){
						$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
					} else {
								
								//  echo '<script type="text/javascript">alert("Servidor registrado correctamente");window.location.href="servers.php";</script>';
								 // header("refresh: 3; url = formulario.php");
						
					}	
				
			}
		 echo "
				<script>
				const Toast = Swal.mixin({
					toast: true,
					position: 'center',
					showConfirmButton: false,
					timer: 500,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'success',
					title: 'Servidor registrado'
				});
			</script>";
    }
 }
  function actualizar_registro(){
 
	$server = limpiar($_POST["server"]);
    $modelo = limpiar($_POST["modelo"]);
    $etiqueta = limpiar($_POST["etiqueta"]);
	$rack = limpiar($_POST["rack"]); if($rack == !null){ $r= "rack = '$rack',";}
    $nivel = limpiar($_POST["nivel"]); if($nivel == !null){ $n= "nivel = '$nivel',";}
    $posicion = limpiar($_POST["posicion"]);if($posicion == !null){ $p= "posicion = '$posicion',";}
	$servicetag = limpiar($_POST["servicetag"]);
    $ippublica = limpiar($_POST["ippublica"]);
    $iplocal = limpiar($_POST["iplocal"]);if($iplocal == !NULL){ $ipl= "iplocal = '$iplocal',";} else { $ipl= "iplocal = NULL,"; }
    $dominio = limpiar($_POST["dominio"]);
    $puerto = limpiar($_POST["puerto"]);
    $status = limpiar($_POST["status"]);
    $tipo = limpiar($_POST["tipo"]);
    $contenido = limpiar($_POST["contenido"]);
	$ubicacion = limpiar($_POST["ubicacion"]);
	

    $sql="UPDATE servers SET
	server = '$server',
    modelo = '$modelo',
    etiqueta = '$etiqueta',
    servicetag = '$servicetag',".
    $r.
    $n.
	$p."
    ippublica = '$ippublica',".
    $ipl."
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
			
		
			
				//Se actuliza la tabla locales asignadas donde el servidor exista en 0 para asegurar no existan repeticiones 
				$sq = "UPDATE locales_asignadas SET activo = 0 WHERE  id_servers ='".$_GET["id"]."' ";
				include'conexion.php';
				$res = $conn->query($sq);
			if(!empty($iplocal)){
				//insertamos la ip asignada en la lista de asignacion 		
				$sql1="INSERT INTO locales_asignadas SET
				id_servers = '".$_GET["id"]."',
				id_ipl = '$iplocal',
				activo = 1,
				fecha = '".date('Y-m-d')."';";
				include'conexion.php';
				
					$resultado1 = $conn->query($sql1);
					if(!$resultado1){
						$error = $conn->error; echo "EXISTE UN ERROR EN Locales asignadas: ".$error;
					} else {
						 echo "
								<script>
								const Toast = Swal.mixin({
									toast: true,
									position: 'center',
									showConfirmButton: false,
									timer: 1500,
									timerProgressBar: true,
									didOpen: (toast) => {
										toast.onmouseenter = Swal.stopTimer;
										toast.onmouseleave = Swal.resumeTimer;
									}
								});

								Toast.fire({
									icon: 'success',
									title: 'Ip Local asignada y Servidor actualizado'
								});
							</script>";
					}		
			}		
     echo "
		<script>
		const Toast = Swal.mixin({
			toast: true,
			position: 'center',
			showConfirmButton: false,
			timer: 3500,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.onmouseenter = Swal.stopTimer;
				toast.onmouseleave = Swal.resumeTimer;
			}
		});

		Toast.fire({
			icon: 'success',
			title: ' Servidor actualizado'
		});
	</script>";
	}
 }

 
 ///////////DOMINIOS
function dominio(){
    $dominio = limpiar($_POST["dominio"]);
	$fecha = date("Y-m-d");
    $sql="INSERT INTO dominios SET
    dominio = '$dominio',
    fecha = '$fecha'
    ;";
   //echo "<br>".$sql;
    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
		 echo "
				<script>
				const Toast = Swal.mixin({
					toast: true,
					position: 'center',
					showConfirmButton: false,
					timer: 1500,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'success',
					title: 'Dominio registrado'
				});
			</script>";
    }
 }
 function asignar_dominio(){
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
   //echo "<br>".$sql;


    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
		echo "
				<script>
				const Toast = Swal.mixin({
					toast: true,
					position: 'center',
					showConfirmButton: false,
					timer: 1500,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'success',
					title: 'Dominio asignado'
				});
			</script>";
    }		
}
function quitar_dominio(){
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
		echo "
				<script>
				const Toast = Swal.mixin({
					toast: true,
					position: 'center',
					showConfirmButton: false,
					timer: 1500,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'success',
					title: 'Dominio Retirado'
				});
			</script>";
    }		
}

 
?>