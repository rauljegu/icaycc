<?php 
		use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\SMTP;
		//error_reporting(E_ALL);
//ini_set('display_errors', 1);
function limpiar($datos){
	$datos = trim($datos);
	$datos = stripslashes($datos);
	$datos = htmlspecialchars($datos);
	return $datos;
}
function loader(){
//echo" <script>
								// Asegurar que el spinner se muestre al iniciar la carga
							//	let spinner = document.getElementById('loading-spinner');
								//console.log(spinner);
								//spinner.style.display = 'flex'; 	
							//</script>";
			echo '				<div id="loading-spinner" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>';
}							
function activar(){
	$id= limpiar($_GET["id"]);
	$c= limpiar($_GET["c"]);
	$sql="UPDATE  users SET 
	activo = 1	WHERE id = '$id'";
	include'conexion.php';
    $resultado = $conn->query($sql);
    if(!$resultado){
      $error = $conn->error; $e = "EXISTE UN ERROR EN: ".$error;
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
					icon: 'warning',
					title: '".addslashes($e)."'
				});
			</script>";
    } else {
			        require("src/PHPMailer.php");
					require("src/SMTP.php");
					require("src/Exception.php");

					
					$partes_ruta = pathinfo($_SERVER["PHP_SELF"]); 
					//$url=  $_SERVER["HTTP_HOST"].$partes_ruta['dirname'];
					$url=  $_SERVER["HTTP_HOST"];
					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->SMTPDebug = 0; // 0 para producción
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = 'ssl';
					$mail->Host = "smtp.gmail.com";
					$mail->Port = 465;
					$mail->IsHTML(true);
					$mail->Username = '';
					$mail->Password = '';
					$mail->CharSet = 'UTF-8';
					$mail->SetFrom("no-reply@rutacpcera.org", "MANAGER RUTACPCERA");
					$mail->Subject = "Se activo tu Perfil en Manager RUTACPCERA";
					$mail->Body = "
						
						<p>Tu perfil  se ha activado. Ya puedes ingresar a: </p>
						<p><a style='text-decoration:none' href='https://$url/manager/' target='_blank'>El sitio de Manager la RutaCPCera</a> https://$url/manager/</p>	
						<p>Si usted tiene algún problema técnico, le pedimos contactarnos al correo: rutacpcerad@gmail.com</p>
					";
					$mail->AddAddress($c);

					if (!$mail->Send()) {
						error_log("Error al enviar el correo: " . $mail->ErrorInfo);
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
											title: 'Perfil Activado Correctamente'}).then(() => {
																									window.location.href='solicitudes.php'; // Recargar la página después del toast
											});
								</script>";
			
		
					}	
			
	}
}
function eliminar(){
	$id= limpiar($_GET["id"]);
	$c= limpiar($_GET["c"]);
	$sqld="DELETE  FROM datos_users WHERE id_user = '$id'";
	include'conexion.php';
    $resultadod = $conn->query($sqld);
	
	$sql="DELETE  FROM users 	WHERE id = '$id'";
	include'conexion.php';
    $resultado = $conn->query($sql);
	
    if(!$resultado){
      $error = $conn->error; $e = "EXISTE UN ERROR EN: ".$error;
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
											title: 'Autor(a) Eliminado@ Correctamente'}).then(() => {
																									window.location.href='solicitudes.php'; // Recargar la página después del toast
											});
								</script>";
	}
}
function desactivar(){
	$id= limpiar($_GET["id"]);
	$c= limpiar($_GET["c"]);
	
	$sql="UPDATE  users SET 
	activo = 0	WHERE id = '$id'";
	include'conexion.php';
    $resultado = $conn->query($sql);
	
    if(!$resultado){
      $error = $conn->error; $e = "EXISTE UN ERROR EN: ".$error;
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
											title: 'CPCerx Desactivad@ Correctamente'}).then(() => {
																									window.location.href='solicitudes.php'; // Recargar la página después del toast
											});
								</script>";
	}
}
?>
