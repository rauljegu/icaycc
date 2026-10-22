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
	if(isset($_POST["siia"])){
		$siia = limpiar($_POST["siia"]); 
		$a = "siia = '$siia',";
	} else { 
		$a = "";
	} 
	$sql="UPDATE  personal SET $a
	nombres = '$name',
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

		/**ASIGNAR ACTUALIZAR ADSCRIPCION**/		
		if(isset($_POST["departamento"],$_POST["grupo"])){
			$dep = limpiar($_POST["departamento"]);
			$grupo = limpiar($_POST["grupo"]);
			if(!empty($dep)){
				$sqdep="SELECT id FROM investigador_departamento WHERE id_investigador = '$id'";
				$resultado1 = $conn->query($sqdep);
				if($resultado1->num_rows > 0) {
					$sql2="UPDATE investigador_departamento SET 
						id_departamento = '$dep'
						WHERE id_investigador = '$id'";
					$resultado2 = $conn->query($sql2);
					if(!$resultado2){
						$error1 = $conn->error; $e = "EXISTE UN ERROR EN: ".$error1;
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
					} else { $error1 = null; }
				} else {
					$sql2="INSERT INTO investigador_departamento SET 
					id_investigador = '$id',
					id_departamento = '$dep'";
					$resultado2 = $conn->query($sql2);
					if(!$resultado2){
									 $error2 = $conn->error; $e = "EXISTE UN ERROR EN: ".$error2;
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
					} else { $error2 = null; }
				}		
			}
			
			if(!empty($grupo)){
				$sqgrupo="SELECT id FROM investigador_grupo WHERE id_investigador = '$id'";
				$resultado1 = $conn->query($sqgrupo);
				if($resultado1->num_rows > 0) {
					$sql2="UPDATE investigador_grupo SET 
						id_grupo = '$grupo'
						WHERE id_investigador = '$id'";
					$resultado2 = $conn->query($sql2);
					if(!$resultado2){
						$error3 = $conn->error; $e = "EXISTE UN ERROR EN: ".$error3;
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
					} else { $error3 = null; }
				} else {
					$sql2="INSERT INTO investigador_grupo SET 
					id_investigador = '$id',
					id_grupo = '$grupo'";
					$resultado2 = $conn->query($sql2);
					if(!$resultado2){
									 $error4 = $conn->error; $e = "EXISTE UN ERROR EN: ".$error4;
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
					} else { $error4 = null; }
				}		
			}	
		}
		if(isset($_POST["unidades"])){
			$uni = limpiar($_POST["unidades"]);
			if(!empty($uni)){
				$squni="SELECT id FROM personal_unidades WHERE id_personal = '$id'";
				$resultado1 = $conn->query($squni);
				if($resultado1->num_rows > 0) {
					$sql2="UPDATE personal_unidades SET 
						id_unidades = '$uni'
						WHERE id_personal = '$id'";
					$resultado2 = $conn->query($sql2);
					if(!$resultado2){
						$error5 = $conn->error; $e = "EXISTE UN ERROR EN: ".$error5;
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
					} else { $error5 = null; }// ERROR ACTUALIZAR UNIDADES
				} else {
					$sql2="INSERT INTO personal_unidades SET 
					id_personal = '$id',
					id_unidades = '$uni'";
					$resultado2 = $conn->query($sql2);
					if(!$resultado2){
									 $error6 = $conn->error; $e = "EXISTE UN ERROR EN: ".$error6;
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
					} else { $error6 = null; } //ERROR INSERT UNIDADES
				} // FIN ACTUALIZAR / INSERT UNIDADES
			} // FIN EMPTY UNIDADES
		} //FIN ISSET UNIDADES
		
		if(
			(empty($error1)) &&
			(empty($error2)) &&
			(empty($error3)) &&
			(empty($error4)) &&
			(empty($error5)) &&
			(empty($error6))
			
			){
		
		
		
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
				

}
function desactivar(){
	$ub = limpiar($_GET["id"]);
	$sql="UPDATE personal SET activo = 0 WHERE id_personal = $ub";
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
					title: 'Desactivado'
				}).then(() => {
					 window.location.href = window.location.pathname;
				});
			</script>";
	}$conn->close;

}
function activar(){
	$ub = limpiar($_GET["id"]);
	$sql="UPDATE personal SET activo = 1 WHERE id_personal = $ub";
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
					title: 'Activado'
				}).then(() => {
					 window.location.href = window.location.pathname;
				});
			</script>";
	}$conn->close;

}
?>