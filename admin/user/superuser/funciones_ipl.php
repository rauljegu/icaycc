<?php
function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
}
function asignar_ipl(){
    $equipo = limpiar($_POST["equipo"]);
    $server = limpiar($_POST["server"]);
    $ip = limpiar($_POST["ip"]);
    $fecha = limpiar($_POST["fecha"]);
	$sq = "UPDATE locales_asignadas SET activo = 0 WHERE id_ipl = '$ip'";
	include'conexion.php';
    $res = $conn->query($sq);
	if($equipo == null){
		$sql="INSERT INTO locales_asignadas SET
		id_servers = '$server',
		id_ipl = '$ip',
		activo = 1,
		fecha = '$fecha'
		;";
		//echo "<br>".$sql;
		$u="UPDATE servers SET iplocal = '$ip' WHERE id_servers = $server";
		include'conexion.php';
		$resu = $conn->query($u);
			if(!$resu){
				$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
			} else {
					$script = "
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
									title: 'Nueva Ip Local Asignada a Servidor'
								}).then(() => {
								";
			}
	}
	if($server == null){
		$sql="INSERT INTO locales_asignadas SET
		id_equipo = '$equipo',
		id_ipl = '$ip',
		activo = 1,
		fecha = '$fecha'
		;";
		//echo "<br>".$sql;
		$u="UPDATE equipos SET id_locales = '$ip' WHERE id_equipo= $equipo";
		include'conexion.php';
		$resu = $conn->query($u);
		if(!$resu){
			$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
		} else {
		$script ="
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
						title: 'Nueva Ip Local Asignada Correctamente a equipo'
					}).then(() => {";
		}
	}

    include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
		$script .= "
					setTimeout(() => {
						Toast.fire({
							icon: 'success',
							title: 'Ip Local Asignada Correctamente'
						});
						 }, 500);
						 }); </script>
						 "; // Espera 500ms después del primer toast	
						 echo $script;
    }
 }

function liberar(){
	$ip = limpiar($_GET["ip"]);
	$ser = limpiar($_GET["ser"]);
	$pc = limpiar($_GET["pc"]);

	$sq="UPDATE  locales_asignadas SET
	activo = 0 WHERE 
	id_ipl = '$ip' ;";
	include'conexion.php';
	$resultado = $conn->query($sq);
	if(!$resultado){
		$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
	} else {
		$script ="
		<script>
		 const Toast = Swal.mixin({
			toast: true,
			position: 'top',
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
			title: 'IP Completamente Liberada'
		}).then(() => {
		";		
		if(empty($pc)){
			$p="UPDATE servers SET iplocal = NULL WHERE id_servers ='$ser'";
			include'conexion.php';
			$res = $conn->query($p);
			if(!$res){
				$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
			} else {
					$script .= "
							
						setTimeout(() => {
							Toast.fire({
								icon: 'success',
								title: 'Server desasignado de IPlocal'
							});
						 }, 500);"; // Espera 500ms después del primer toast	
						
					// echo '<script type="text/javascript">alert("Ip Local Liberada correctamente");window.location.href="ipsl.php";</script>';
			}	
		} else {
			$p="UPDATE equipos SET id_locales = NULL WHERE id_equipo ='$pc'";
			include'conexion.php';
			$res = $conn->query($p);
			if(!$res){
				$error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
			} else {
					$script .= "
							
						setTimeout(() => {	
							Toast.fire({
								icon: 'success',
								title: 'Equipo desasignado de Ip Local'
							}); }, 500);"; // Espera 500ms después del primer toast
					// echo '<script type="text/javascript">alert("Ip Local Liberada correctamente");window.location.href="ipsl.php";</script>';
			}
		}
		$script .= "}); </script>";
		echo $script;
	}
 }

function registro_equipo(){
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
					title: 'Equipo Registrado'
				});
			</script>";
    }
 }

?>