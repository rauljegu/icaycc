<?php //include 'settings.php'; 
	$name =basename($_SERVER["PHP_SELF"]);	
	 include '../../includes/connect.php';
	$connect = $conn;
	// Obtener lista de personal
	$asi="SELECT * FROM personal ORDER BY activo DESC, nombres ASC, nombre ASC, apellido_paterno ASC, apellido_materno ASC; ";
	$resultasi = $connect->query($asi);
	

	if ($resultasi === false) {
		die("Error en la consulta: " . $connect->error);
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Perfil de usuario">
	<meta name="author" content="RdJG">
    <title>Secciones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
   
    <link href="../../assets/estilo.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-dark fixed-top" >
        <div class="container-fluid" id="menu-container">
            <?php 	include 'menu.php';
					include 'funciones1.php'; 
						if(isset($_GET["ok"]) ){
							if($_GET["ok"] == 1 ){
								echo'<div id="loading-spinner" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
									<div class="spinner-border text-light" role="status">
									<span class="visually-hidden">Cargando...</span>
									</div>
									</div>';
								activar();
							}
							if($_GET["ok"] == 2 ){
								echo'<div id="loading-spinner" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1500;">
									<div class="spinner-border text-light" role="status">
									<span class="visually-hidden">Cargando...</span>
									</div>
									</div>';
								desactivar();
								//echo "Desactivado";
							}
						}
			?>
        </div>
    </nav>

<div class="container mt-5 pt-5 content">
			<div class="row">
				<div class="col-md-12 mx-auto">
					<div class="card bg-primary text-white">
						<div class="card-header">Secretarias</div>
						<div class="card-body bg-light text-dark">                       					  
						<!--	<div class="d-grid gap-2">					
								<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample6" aria-expanded="false" aria-controls="collapseExample">
									Buscar Personal
								</button>					
								<div class="collapse" id="collapseExample6">
									<div class="card card-body">
									<input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar por nombre o correo ">
										<table class="table table-bordered">
											<thead class="table-dark">
												<tr>
													<th>Nombre</th>
													<th>Correo</th>
													<th>Grado Académico</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody id="tablaCuerpo">
												<?php 
												while ($rowasi = $resultasi->fetch_assoc()): 
													$correo = $rowasi['correo'];
													$grado_academico = $rowasi['grado_academico'];
													$nombre = $rowasi['nombres']." ".$rowasi['apellido_paterno']." ".$rowasi['apellido_materno'];
													$nombrec = $rowasi['nombre'];
													
													
										
												?>
												<tr class="<?php echo $rowClass; ?>">
													<td><?php echo htmlspecialchars($nombre."/".$nombrec); ?></td>
													<td><?php echo htmlspecialchars($correo); ?></td>
													<td><?php echo htmlspecialchars($grado_academico); ?></td>
													<td>
														
														<a class='btn btn-info' href='editar_personal.php?id=<?=$rowasi["id_personal"];?>' style='text-decoration:none'>Editar</a>												
														<?php if($rowasi['activo']== 1 ){ ?>
															<a class='btn btn-warning' href='personal.php?ok=2&id=<?=$rowasi["id_personal"];?>' style='text-decoration:none'>Desactivar</a>												
														<?php } else { ?>
															<a class='btn btn-success' href='personal.php?ok=1&id=<?=$rowasi["id_personal"];?>' style='text-decoration:none'>Activar</a>
														<?php } ?>
													</td>
												</tr>
												<?php endwhile; ?>
											</tbody>
										</table>

									
									</div>
								</div>
							</div>
						--></div>
					</div>
					<br>
					<br>
				</div>
				<div class="col-md-12 mx-auto">			
					<div class="card bg-primary text-white">
						<div class="card-header">Departamentos</div>
						<div class="card-body bg-light text-dark">
						<!--	<div class="d-grid gap-2">
								<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample0" aria-expanded="false" aria-controls="collapseExample">
									Crear Nuevo Perfil de Personal
								</button>
							
							<div class="collapse" id="collapseExample0">
								<div class="card card-body">
									<form id="registroForm"  action="<?php echo htmlspecialchars("registro.php"); ?>" method="POST" autocomplete="off">		 
										<h2>Añade Usuario</h2>					 
										<div class="col-md-12">
											<div class="input-group mb-3">
												<span class="input-group-text">Nombres:</span>
												<input type="text" class="form-control" id="nombre" name="nombre">
											</div> 
											<div class="input-group mb-3">
												<span class="input-group-text">Primer Apellido:</span>
												<input type="text" class="form-control" id="paterno" name="paterno">
											</div> 
											<div class="input-group mb-3">
												<span class="input-group-text">Segundo Apellido:</span>
												<input type="text" class="form-control" id="materno" name="materno">
											</div>
											<div class="input-group mb-3">
												<span class="input-group-text">Correo de contacto:</span>
												<input type="email" class="form-control" id="correo" name="correo" required>
											</div>
											<div class="input-group mb-3">
												<span class="input-group-text" hidden>Contraseña:</span>
												<input type="password" class="form-control" id="pass" name="pass" autocomplete="new-password" value="Abc/1234"  required readonly hidden>
											</div>  
											<label for="rol" class="form-label">Roles</label>
											<div class="input-group mb-3">
												<select class="form-select" id="rol" name="rol" aria-label="rol">
													<option selected>Selecciona un rol</option>
													<?php// include'conexion.php';
														$rol="SELECT * FROM roles WHERE tipo =  2 OR tipo =  3 OR tipo =  5 ";
														//echo $rol;
														$resultrol = $conn->query($rol);
														if($resultrol->num_rows > 0) {
															$optionrol="";
																while ($rowrol = $resultrol->fetch_assoc()){
																		$optionrol .= " <option value=".$rowrol["tipo"].">".$rowrol["rol"]."</option>";
																}
														}	
													echo $optionrol;
													?>
												</select>
											</div>
											<div class="input-group mb-3">
												<input  type="submit" class="form-control btn btn-primary" value="Añadir">
											</div>									
										</div> 									
									</form>
								</div>
							</div>					
							<br>
						
								<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample100" aria-expanded="false" aria-controls="collapseExample">
									Ver Revisores
								</button>					
								<div class="collapse" id="collapseExample100">
									<div class="card card-body">
									<div class="table-responsive-xxl">
									</div>
									</div>
								</div>							
							</div>
						--></div>
					</div>
					<br>
					<br>
					<br>
					<br>
					<br>
				</div>
			</div>
		</div>
	<?php include'footer.php';?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
		 <script>
			// Filtrado en tiempo real
			document.getElementById("buscador").addEventListener("keyup", function() {
				let filtro = this.value.toLowerCase();
				let filas = document.querySelectorAll("#tablaCuerpo tr");

				filas.forEach(fila => {
					let nombre = fila.cells[0].textContent.toLowerCase();
					let correo = fila.cells[1].textContent.toLowerCase();

					if (nombre.includes(filtro) || correo.includes(filtro)) {
						fila.style.display = "";
					} else {
						fila.style.display = "none";
					}
				});
			});
			 // Mostrar notificación si hay éxito en el registro
			const urlParams = new URLSearchParams(window.location.search);
			if (urlParams.has('success')) {
				Swal.fire({
					toast: true,
					position: "top-end",
					icon: "success",
					title: "Asistencia registrada con éxito",
					showConfirmButton: false,
					timer: 3000
				});
			}
			if (urlParams.has('error')) {
				Swal.fire({
					toast: true,
					position: "top-end",
					icon: "error",
					title: "Error al registrar asistencia",
					showConfirmButton: false,
					timer: 3000
				});
			}
		</script>

