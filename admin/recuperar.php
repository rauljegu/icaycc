<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="RdJG_SD">
		<title>RutaCPCera, recupoera tu pswd</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
		  <link href="assets/estilo.css" rel="stylesheet">
	</head>
	<body>
		<div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 3000;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark  " style="background-color: #002B7A" >
			<?php $menu =0; include'activo.php'; include'menu.php';  ?>
		</nav>
		<?php
			include'modal_inicio.php';
			include'modal_registro.php';
		?>
		<div class="container mt-4 content" >
			<div class="row">
				<div class="col-md-8">
					<br>
					<h2 id="acerca">Recupera tu contraseña</h2>
					<br>
					 <form id="loginForm1" class="form-signin" Action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?pas=1"); ?>" method="POST" autocomplete="off">
                    <div class="card border-info">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Ingrese su correo:</span>
                                <input name="login" type="text" id="inputEmail0" class="form-control" placeholder="Usuario" autocomplete="off" required autofocus>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Ingrese su correo nuevamente:</span>
                                <input type="text" id="inputEmail1" class="form-control" placeholder="Usuario" autocomplete="new-password" required>
                            </div>
							 <p id="mensajeError2" class="text-danger d-none">Los correos no coinciden. Intente de nuevo.</p>
                        </div>
                   
                    
                        <button class="btn btn-primary " id="btnVerificarCorreo0" type="submit" name="submit">Recuperar</button>                        
                 
					 </div>
                </form>
				<br>	
				<br>	
			
			<script>
					document.addEventListener("DOMContentLoaded", function() {
					
					let inputEmail0 = document.getElementById("inputEmail0");
					
					let inputEmail1 = document.getElementById("inputEmail1");
					
					let mensajeError2 = document.getElementById("mensajeError2");
					let btnVerificarCorreo0 = document.getElementById("btnVerificarCorreo0");
					let form = document.getElementById("loginForm1");
				
					document.getElementById("inputEmail1").addEventListener("paste", function(event) {
					event.preventDefault();
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
												title: 'Por favor escribe nuevamente tu correo'
											})
					});
					


					// 2. Validar en tiempo real	
					function validarCampos() {
						let errores = false;

						

						if (inputEmail1 && inputEmail0.value.trim() !== inputEmail1.value.trim()) {
							mensajeError2.classList.remove("d-none");
							errores = true;
						} else {
							mensajeError2.classList.add("d-none");
						}

						return !errores; // Retorna true si no hay errores
					}

					
					if (inputEmail1) inputEmail1.addEventListener("input", validarCampos);

					btnVerificarCorreo0.addEventListener("click", function(event) {
						if (!validarCampos()) {
							event.preventDefault(); // Evita el envío si hay errores
							const Toast = Swal.mixin({
												toast: true,
												position: 'center',
												showConfirmButton: false,
												timer: 4500,
												timerProgressBar: true,
												didOpen: (toast) => {
													toast.onmouseenter = Swal.stopTimer;
													toast.onmouseleave = Swal.resumeTimer;
												}
											});

											Toast.fire({
												icon: 'warning',
												title: 'Correos no coinciden'
											})
											}/* else {
							form.submit();
						}*/
					});
				});

									
</script>
<?php
	if(isset($_GET["pas"])){
		if($_GET["pas"] == 1){
		//var_dump($_POST);
		if(isset($_POST["login"])){ $mail= htmlspecialchars(stripslashes(trim($_POST["login"])));}
			$sql="SELECT login,id FROM users WHERE login ='$mail' ";
			$sql;
			include'conexion.php';
			$result=$conn->query($sql);
			if($result->num_rows  == 1){
				$row=$result->fetch_assoc();
				$user = $row["login"];
				$id_p = $row["id"];
				// 1. Generar token
				$token = rand(100000, 999999); // token de 6 dígitos
				// 2. Guardar en una nueva tabla temporal (o puedes crear columnas nuevas si lo prefieres)
				include 'conexion.php';
				$stmt = $conn->prepare("UPDATE users SET  reset_token = ?, token_expiry = NOW() + INTERVAL 30 MINUTE WHERE id = ?");
				$stmt->bind_param("si",  $token, $id_p);
				$stmt->execute();
				// 3. Enviar correo
				include 'assets/enviar_correo.php';
				$destinatario = $user; // obtén este correo desde la BD o sesión
				//$destinatario = "rauljegu@gmail.com"; // obtén este correo desde la BD o sesión
				$partes_ruta = pathinfo($_SERVER["PHP_SELF"]); 
				$url=  $_SERVER["HTTP_HOST"].$partes_ruta['dirname'];
				$asunto = "Confirmación de cambio de contraseña";
				$mensaje = "Tu código de verificación es: <strong>$token</strong><br><br>
				Para autorizar el cambio ingresalo en el formulario:<br>"
				;
				enviarCorreo($destinatario, $asunto, $mensaje);
				echo "<script>
				Swal.fire({
				icon: 'info',
				title: 'Revisa tu correo',
				text: 'Te enviamos un código a tu correo.',
				});
				</script>";	
			?>
			<br>
			<br>
			<form id="registroForm3" class="row g-3" Action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?pas=2"); ?>" METHOD="POST">
				<div class="input-group mb-3">
					<span class="input-group-text">Contrase&ntilde;a nueva </span>
					<input type="text" class="form-control"  placeholder="" id="pass1"  name="nueva" required>												
					<span class="input-group-text toggle-password" data-target="pass1">
							<i class="fa-solid fa-eye"></i>
						</span>
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text">Repite tu Contrase&ntilde;a nueva </span>
					<input type="text" class="form-control"  placeholder="" id="passConfirmacion1" required>												
					<span class="input-group-text toggle-password" data-target="passConfirmacion1">
						<i class="fa-solid fa-eye"></i>
					</span>
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text">Ingresa tu c&oacute;digo de verificaci&oacute;n  </span>
					<input type="text" class="form-control"  placeholder="" name="token" required>												
				</div>
				<input type="text" class="form-control"  placeholder="" id="pass3"  name="id" value="<?=$id_p;?>" required hidden>		
				 <p id="mensajeError3" class="text-danger d-none">Las contraseñas no coinciden. Intente de nuevo.</p>
				<input type="submit" class="btn btn-primary" id="btnVerificarCorreo3" value="Actualizar">
			</form>
			<br>
			<br>
			<script>
					document.addEventListener("DOMContentLoaded", function() {
					
					let pass1 = document.getElementById("pass1");
					
					let passConfirmacion1 = document.getElementById("passConfirmacion1");
					
					let mensajeError3 = document.getElementById("mensajeError3");
					let btnVerificarCorreo3 = document.getElementById("btnVerificarCorreo3");
					let form = document.getElementById("registroForm3");
				
					document.getElementById("passConfirmacion1").addEventListener("paste", function(event) {
					event.preventDefault();
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
												title: 'Por favor reescribe tu contraseña'
											})
					});
					


					// 2. Validar en tiempo real	
					function validarCampos() {
						let errores = false;

						

						if (passConfirmacion1 && pass1.value.trim() !== passConfirmacion1.value.trim()) {
							mensajeError3.classList.remove("d-none");
							errores = true;
						} else {
							mensajeError3.classList.add("d-none");
						}

						return !errores; // Retorna true si no hay errores
					}

					
					if (passConfirmacion1) passConfirmacion1.addEventListener("input", validarCampos);

					btnVerificarCorreo3.addEventListener("click", function(event) {
						if (!validarCampos()) {
							event.preventDefault(); // Evita el envío si hay errores
							const Toast = Swal.mixin({
												toast: true,
												position: 'center',
												showConfirmButton: false,
												timer: 4500,
												timerProgressBar: true,
												didOpen: (toast) => {
													toast.onmouseenter = Swal.stopTimer;
													toast.onmouseleave = Swal.resumeTimer;
												}
											});

											Toast.fire({
												icon: 'warning',
												title: 'Contraseñas no coinciden'
											})
											}/* else {
							form.submit();
						}*/
					});
				});

										
									
document.addEventListener("DOMContentLoaded", function() {
    const toggles = document.querySelectorAll('.toggle-password');
    toggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const inputId = toggle.getAttribute('data-target');
            const input = document.getElementById(inputId);
            const icon = toggle.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});
</script>
			
			
			<?php
			} else {  echo "
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
						icon: 'warning',
						title: 'La Contraseña actual no coincide'
						}).then(() => {
						// Redirección después de que el toast se haya mostrado
						window.location.href = 'index.php';
						});;
						</script>";
					}
		}
		if($_GET["pas"] == 2){
		//	var_dump($_POST);
			if(isset($_POST["nueva"])){ $nueva1= htmlspecialchars(stripslashes(trim($_POST["nueva"])));}
			$nueva = password_hash($nueva1, PASSWORD_DEFAULT); // Genera el hash seguro
			if(isset($_POST["id"])){ $id= htmlspecialchars(stripslashes(trim($_POST["id"])));}
			if(isset($_POST["token"])){ $token= htmlspecialchars(stripslashes(trim($_POST["token"])));}
			include 'conexion.php';

			// Buscar en la tabla
			$stmt = $conn->prepare("SELECT reset_token, token_expiry FROM users WHERE id = ? AND reset_token = ?");
			$stmt->bind_param("is", $id, $token);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows === 1) {
				$row = $result->fetch_assoc();
				$expiry = $row['token_expiry'];
				$now = date("Y-m-d H:i:s");

				if ($now <= $expiry) {
					// Actualiza contraseña final
					$stmt2 = $conn->prepare("UPDATE users SET password = ?, temp_password = NULL, reset_token = NULL, token_expiry = NULL WHERE id = ?");
					$stmt2->bind_param("si", $nueva, $id);
					$stmt2->execute();

					echo "<script>
						Swal.fire({
							icon: 'success',
							title: 'Contraseña actualizada',
							text: 'Tu nueva contraseña ha sido confirmada.',
						}).then(() => {
							window.location.href = 'index.php';
						});
					</script>";
				} else {
					echo "<script>
						Swal.fire({
							icon: 'error',
							title: 'Token expirado',
							text: 'Solicita nuevamente el cambio de contraseña.',
						});
					</script>";
				}
			} else {
				echo "<script>
					Swal.fire({
						icon: 'error',
						title: 'Token inválido',
						text: 'Verifica el enlace de confirmación.',
					});
				</script>";
			}
		}	
	}	 
				?>
				</div>
			</div>
		</div>
		<?php include'footer.php'; ?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="funciones.js"></script>
	</body>
</html>
