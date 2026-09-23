<?php 
function limpiar($datos){
	$datos = trim($datos);
	$datos = stripslashes($datos);
	$datos = htmlspecialchars($datos);
	return $datos;
}
function actualizar(){
	$id= limpiar($_GET["id"]);
	$name = limpiar($_POST["name"]);
	$paterno = limpiar($_POST["paterno"]);
	$materno = limpiar($_POST["materno"]);
	$correo = limpiar($_POST["correo"]);
	$extension = limpiar($_POST["extension"]);
	$telefono = limpiar($_POST["telefono"]);
	$grado = limpiar($_POST["grado"]);
	$semblanza = limpiar($_POST["semblanza"]);
	$scholar = limpiar($_POST["scholar"]);
	$research = limpiar($_POST["researchgate"]);
	$orcid = limpiar($_POST["orcid"]);
	$scopus = limpiar($_POST["scopus"]);
	
	$sql="UPDATE  personal SET 
	nombre = '$name',
	apellido_paterno = '$paterno',
	apellido_materno = '$materno',
	telefono = '$telefono',
	extension = '$extension',
	grado_academico = '$grado',
	semblanza = '$semblanza',
	scholar = '$scholar',
	researchgate = '$research',
	orcid = '$orcid',
	scopus = '$scopus',
	
	correo = '$correo'
	WHERE id_personal = '$id'";
	 include '../../includes/connect.php';
							$connect = $conn;
    $resultado = $conn->query($sql);
    if(!$resultado){
       $error = $conn->error; $e = "EXISTE UN ERROR EN: ".$error;
	   echo "
				<script>
				const Toast = Swal.mixin({
					toast: true,
					position: 'center',
					showConfirmButton: false,
					timer: 10000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.onmouseenter = Swal.stopTimer;
						toast.onmouseleave = Swal.resumeTimer;
					}
				});

				Toast.fire({
					icon: 'warning',
					title: '".addslashes($e)."'
				});
			</script>";
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
			title: 'Datos Actualizados Correctamente'
			});
			</script>";
	}	
				

}
function leer(){
	$ub = limpiar($_GET["id"]);
	$sql="UPDATE rechazados SET leido = 1 WHERE id_recibidos = $ub";
	 include '../../includes/connect.php';
							$connect = $conn;
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; $e = "EXISTE UN ERROR EN: ".$error;
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
					icon: 'warning',
					title: '".addslashes($e)."'
				});
			</script>";
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
					title: 'Leido'
				}).then(() => {
        window.location.href='mensajes.php'; // Recargar la página después del toast
    });
			</script>";
	}$conn->close;

}
?>