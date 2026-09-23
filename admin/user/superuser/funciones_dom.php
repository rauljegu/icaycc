<?php
function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
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
function acdes(){
	$dominio = limpiar($_GET["dom"]);
	$accion = limpiar($_GET["ac"]);
	if($accion == 1) {
		$sql="UPDATE dominios SET activo = 0 WHERE id_dominios = '$dominio'";
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
						title: 'Dominio desactivado'
					});
				</script>";
		}
	}
	if($accion == 2) {
		$sql="UPDATE dominios SET activo = 1 WHERE id_dominios = '$dominio'";
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
						title: 'Dominio activado'
					});
				</script>";
		}
	}
}	
?>