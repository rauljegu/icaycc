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
	$adscripcion = limpiar($_POST["adscripcion"]);
	$telefono = limpiar($_POST["telefono"]);
	$resena = limpiar($_POST["resena"]);
	$sql="UPDATE  users SET 
	name = '$name',
	paterno = '$paterno',
	materno = '$materno',
	login = '$correo',
	correo = '$correo'
	WHERE id = '$id'";
	include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; if ($error) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error en la consulta',
            text: 'EXISTE UN ERROR EN: " . addslashes($error) . "',
            confirmButtonText: 'Aceptar'
        });
    </script>";
}
    } else {
			$sql1="SELECT * FROM datos_users WHERE id_user = '$id'";
			$resultado1 = $conn->query($sql1);
			if($resultado1->num_rows > 0) {
				$sql2="UPDATE datos_users SET 
				adscripcion = '$adscripcion',
				resena = '$resena',
				telefono = '$telefono'
				WHERE id_user = '$id'";
				$resultado2 = $conn->query($sql2);
				if(!$resultado2){
								$error = $conn->error; if ($error) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error en la consulta',
            text: 'EXISTE UN ERROR EN: " . addslashes($error) . "',
            confirmButtonText: 'Aceptar'
        });
    </script>";
}
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
					title: 'Datos Actualizados Correctamente'
				});
			</script>";
				}	
			} else { 
				$sql2="INSERT INTO datos_users SET 
				adscripcion = '$adscripcion',
				resena = '$resena',
				telefono = '$telefono',
				id_user = '$id'";
				$resultado2 = $conn->query($sql2);
				if(!$resultado2){
								$error = $conn->error; if ($error) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error en la consulta',
            text: 'EXISTE UN ERROR EN: " . addslashes($error) . "',
            confirmButtonText: 'Aceptar'
        });
    </script>";
}
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
								title: 'Datos Actualizados Correctamente'
							});
						</script>";
				}	
			}	
	}
}
function leer(){
	$ub = limpiar($_GET["id"]);
	$sql="UPDATE rechazados SET leido = 1 WHERE id_recibidos = $ub";
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
					title: 'Leido'
				}).then(() => {
        window.location.href='mensajes.php'; // Recargar la página después del toast
    });
			</script>";
	}$conn->close;

}
?>