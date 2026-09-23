<?php 
function limpiar($datos){
	$datos = trim($datos);
	$datos = stripslashes($datos);
	$datos = htmlspecialchars($datos);
	return $datos;
}
function ubicaciones(){
	$rack = limpiar($_POST["rack"]);
	$niveles = limpiar($_POST["niveles"]);
	$posicion = limpiar($_POST["posicion"]);
	$sql="INSERT INTO ubicacion SET 
	rack = '$rack'';
	";
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
					timer: 500,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'success',
					title: 'Registrado'
				});
			</script>";
	}
}
function update_ubicaciones(){
	$rack = limpiar($_POST["rack"]);
	$niveles = limpiar($_POST["niveles"]);
	$posicion = limpiar($_POST["posicion"]);
	$ub = limpiar($_GET["ub"]);
	$sql="UPDATE ubicacion SET 
	rack = '$rack'
	WHERE id_ubicacion = $ub
	";
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
					timer: 500,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'success',
					title: 'Ubicación actualizada'
				});
			</script>";
	} 
	$conn->close;
}
function ac(){
	$ub = limpiar($_GET["ub"]);
	$sql1="UPDATE ubicacion SET activo = 1 WHERE id_ubicacion = $ub";
	//echo $sql1;
	include'conexion.php';
    $resultado1 = $conn->query($sql1);
    if(!$resultado1){
      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
    } else {
	 echo "
				<script>
				const Toast = Swal.mixin({
					toast: true,
					position: 'center',
					showConfirmButton: false,
					timer: 1000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'success',
					title: 'Ubicación Activada'
				});
			</script>";
	}$conn->close;
}
function desactivar_ubicaciones(){
	$ub = limpiar($_GET["ub"]);
	$sql="UPDATE ubicacion SET activo = 0 WHERE id_ubicacion = $ub";
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
					timer: 100,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'success',
					title: 'Ubicación Desactivada'
				});
			</script>";
	}$conn->close;

}
?>