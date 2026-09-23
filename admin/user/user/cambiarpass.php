
<!--<!-- Font Awesome CDN pública este va en el index.php o el documento donde se incluya, en head
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />-->
<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample6" aria-expanded="false" aria-controls="collapseExample">
									Cambiar contrase&ntilde;a
								</button>					
								<div class="collapse" id="collapseExample6">
									<div class="card card-body">
										<form id="registroForm1" class="row g-3" Action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?pas=1&id=".$_SESSION['id']); ?>" METHOD="POST">
											<div class="input-group mb-3">
												<span class="input-group-text">Contrase&ntilde;a actual: </span>
												<input type="password" class="form-control" id="actual" placeholder="" name="actual" required >
													<span class="input-group-text toggle-password" data-target="actual">
														<i class="fa-solid fa-eye"></i>
													</span>
											</div>
										
											<div class="input-group mb-3">
												<span class="input-group-text">Contrase&ntilde;a nueva </span>
												<input type="password" class="form-control"  placeholder="" id="pass"  name="nueva" required>												
												<span class="input-group-text toggle-password" data-target="pass">
														<i class="fa-solid fa-eye"></i>
													</span>
											</div>
											<div class="input-group mb-3">
												<span class="input-group-text">Repite tu Contrase&ntilde;a nueva </span>
												<input type="password" class="form-control"  placeholder="" id="passConfirmacion" required>												
											<span class="input-group-text toggle-password" data-target="passConfirmacion">
														<i class="fa-solid fa-eye"></i>
													</span>
											</div>
											 <p id="mensajeError1" class="text-danger d-none">Las contraseñas no coinciden. Intente de nuevo.</p>
											<input type="submit" class="btn btn-primary" id="btnVerificarCorreo" value="Cambiar">
										</form>
										<script>
										document.addEventListener("DOMContentLoaded", function() {
										
										let pass = document.getElementById("pass");
										
										let passConfirmacion = document.getElementById("passConfirmacion");
										
										let mensajeError1 = document.getElementById("mensajeError1");
										let btnVerificarCorreo = document.getElementById("btnVerificarCorreo");
										let form = document.getElementById("registroForm1");
									
										document.getElementById("passConfirmacion").addEventListener("paste", function(event) {
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

											

											if (passConfirmacion && pass.value.trim() !== passConfirmacion.value.trim()) {
												mensajeError1.classList.remove("d-none");
												errores = true;
											} else {
												mensajeError1.classList.add("d-none");
											}

											return !errores; // Retorna true si no hay errores
										}

										
										if (passConfirmacion) passConfirmacion.addEventListener("input", validarCampos);

										btnVerificarCorreo.addEventListener("click", function(event) {
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
																	title: 'Correo o contraseña no coinciden'
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
									</div>
								</div>
								<?php
								if(isset($_GET["pas"])){
									if($_GET["pas"] == 1){
										//var_dump($_POST);
										$id_p=$_GET["id"];
										$sql="SELECT password FROM users WHERE id ='$id_p' ";
										 $sql;
										include'conexion.php';
										$result=$connect->query($sql);
										if($result->num_rows  == 1){
											$row=$result->fetch_assoc();
											 $guardada = $row["password"];
										}
										 $actual = $_POST["actual"];
										$nueva = $_POST["nueva"];
										
										if(isset($_POST["nueva"])){ $nueva1= htmlspecialchars(stripslashes(trim($_POST["nueva"])));}
										$nueva = password_hash($nueva1, PASSWORD_DEFAULT); // Genera el hash seguro
										if(password_verify($actual, $guardada)) {																																	// 1. Generar token
											$token = rand(100000, 999999); // token de 6 dígitos

											// 2. Guardar en una nueva tabla temporal (o puedes crear columnas nuevas si lo prefieres)
											include 'conexion.php';
											$stmt = $connect->prepare("UPDATE users SET temp_password = ?, reset_token = ?, token_expiry = NOW() + INTERVAL 30 MINUTE WHERE id = ?");
											$stmt->bind_param("ssi", $nueva, $token, $id_p);
											$stmt->execute();

											// 3. Enviar correo
											include '../../assets/enviar_correo.php';
											$destinatario = $_SESSION["mail"]; // obtén este correo desde la BD o sesión
											
											$partes_ruta = pathinfo($_SERVER["PHP_SELF"]); 
											$url=  $_SERVER["HTTP_HOST"].$partes_ruta['dirname'];
											$asunto = "Confirmación de cambio de contraseña";
											$mensaje = "Tu código de verificación es: <strong>$token</strong><br><br>
											Para autorizar el cambio, da clic en el siguiente enlace:<br>
											<a href='https://$url/confirmar_cambio.php?id=$id_p&token=$token'>Confirmar cambio de contraseña</a>";

											enviarCorreo($destinatario, $asunto, $mensaje);

											echo "<script>
												Swal.fire({
													icon: 'info',
													title: 'Revisa tu correo',
													text: 'Te enviamos un código para confirmar el cambio de contraseña.',
												});
											</script>";	
												
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
										</script>";}
									}
								}
								
				
								?>
