<?php
function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
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
function actualizar_equipo(){
 

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
					timer: 3500,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'success',
					title: 'Equipo Actualizado correctamente'
				});
			</script>";
    }
 	
}
function asignar_ipl(){
    $equipo = limpiar($_POST["equipo"]);
    $server = limpiar($_POST["server"]);
    $ip = limpiar($_POST["ip"]);
    $fecha = limpiar($_POST["fecha"]);
	
	if($equipo == null){
		$sq = "UPDATE locales_asignadas SET activo = 0 WHERE id_ipl = '$ip' AND id_servers = '$server'";
		//echo $sq;
		include'conexion.php';
		$res = $conn->query($sq);
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
		$sq = "UPDATE locales_asignadas SET activo = 0 WHERE id_ipl = '$ip' OR id_equipo = '$equipo'";
		//echo $sq;
		include'conexion.php';
		$res = $conn->query($sq);
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

?>