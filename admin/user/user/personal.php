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
    <title>Personal</title>
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
						<div class="card-header">Personal Registrado</div>
						<div class="card-body bg-light text-dark">                       					  
							<div class="d-grid gap-2">					
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
						</div>
					</div>
					<br>
					<br>
				</div>
				<div class="col-md-12 mx-auto">			
					<div class="card bg-primary text-white">
						<div class="card-header">Nuevo Personal</div>
						<div class="card-body bg-light text-dark">
							<div class="d-grid gap-2">
								<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample0" aria-expanded="false" aria-controls="collapseExample">
									Crear Nuevo Perfil de Personal
								</button>
							
							<div class="collapse" id="collapseExample0">
								<div class="card card-body">
								

						<form id="registroForm" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=3"); ?>">
						
								<h3 class="mt-3">Nombre: <?=$row1["nombres"]." ".$row1["apellido_paterno"]." ".$row1["apellido_materno"];?></h3>
								    <div class="input-group mb-3">
										<span class="input-group-text">Nombre(s) Apellidos</span>
										<input type="text" class="form-control" name="name"  required>
										<input type="text" class="form-control" name="paterno"  required>
										<input type="text" class="form-control" name="materno">
										<div class="invalid-feedback">Todos los campos de nombre y apellidos son obligatorios.</div>
									</div>

									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Correo/usuario @</span>
										<input type="email" class="form-control" placeholder="user@server.com" aria-label="Username"
											aria-describedby="basic-addon1" name="correo" 
											 pattern="[a-zA-Z0-9._%+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
										<div class="invalid-feedback">Ingrese un correo válido.</div>
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Tel&eacute;fono:</span>
										<input type="telefono" class="form-control" placeholder="5512344567" aria-label="telefono"
											aria-describedby="basic-addon1" name="telefono"
											  required>										
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Extensi&oacute;n:</span>
										<input type="telefono" class="form-control" placeholder="01234" aria-label="telefono"
											aria-describedby="basic-addon1" name="extension"
											  required>										
									</div>
									
									
									<!-- Grado académico -->
									<div class="col-12">
										<label for="grado" class="form-label">Grado académico</label>
										<select name="grado" id="grado" class="form-select" required>
											<option value="">Seleccione un grado académico</option>
											<option value="Lic.">
												Licenciatura
											</option>
											<option value="Mtro(a).">
												Maestría
											</option>
											<option value="Dr(a).">
												Doctorado
											</option>
											<option value="Sin estudios profesionales">
												Sin estudios profesionales
											</option>
										</select>
									</div>

									<!-- Perfiles académicos -->
									<div class="col-12">
										<div class="row g-3">

											<!-- Google Scholar -->
											<div class="col-12 col-md-6 col-xl-3">
												<label for="scholar" class="form-label">Google Scholar</label>
												<input type="text"
													   name="scholar"
													   id="scholar"
													   class="form-control"
													   placeholder="Google Scholar"
													  >
											</div>
											
											<!-- ID SIIA -->
											<div class="col-12 col-md-6 col-xl-3">
												<label for="scholar" class="form-label">ID SIIA</label>
												<input type="text"
													   name="siia"
													   id="siia"
													   class="form-control"
													   placeholder="ID SIIA"
													   >
											</div>

											<!-- ResearchGate -->
											<div class="col-12 col-md-6 col-xl-3">
												<label for="researchgate" class="form-label">ResearchGate</label>
												<input type="text"
													   name="researchgate"
													   id="researchgate"
													   class="form-control"
													   placeholder="ResearchGate"
													  >
											</div>

											<!-- ORCID -->
											<div class="col-12 col-md-6 col-xl-3">
												<label for="orcid" class="form-label">ORCID</label>
												<input type="text"
													   name="orcid"
													   id="orcid"
													   class="form-control"
													   placeholder="ORCID"
													  >
											</div>

											<!-- Scopus -->
											<div class="col-12 col-md-6 col-xl-3">
												<label for="scopus" class="form-label">Scopus</label>
												<input type="text"
													   name="scopus"
													   id="scopus"
													   class="form-control"
													   placeholder="Scopus"
													   >
											</div>

										</div>
									</div>
									
									<div class="col-12">
											<span class="input-group-text">Semblanza</span>
											<textarea name="semblanza" class="form-control" placeholder="Rese&ntilde;a"></textarea>
									</div>
									<!--Departamento -->
									<div class="col-12">
										<label for="Departamento" class="form-label">Departamento</label>
										<select name="departamento" id="Departamento" class="form-select" required>
											<option value="0">Seleccione un departamento</option>
											
											<?php 	 
													$sql3="SELECT id_departamento, nombre FROM departamentos  ORDER BY nombre ASC";
													include '../../includes/connect.php';
													$connect = $conn;
													//echo $sql2;
														$result3 = $conn->query($sql3);
													if ($result3->num_rows > 0) {
														while($row3= $result3->fetch_assoc()) { ?>																										
															<option value="<?=$row3["id_departamento"]?>">
																<?php echo $row3["nombre"]; ?>
															</option>
										<?php			} 
													} 
												?>																							
										</select>
									</div>
									<!--Grupo -->
									<div class="col-12">
										<label for="Grupo" class="form-label">Grupo</label>
										<select name="grupo" id="Grupo" class="form-select" required>
											<option value="0">Seleccione un Grupo</option>
											
											<?php 
													$sql5="SELECT id_grupo, nombre FROM grupos  ORDER BY nombre ASC";
													include '../../includes/connect.php';
													$connect = $conn;
													//echo $sql5;
														$result5 = $conn->query($sql5);
													if ($result5->num_rows > 0) {
														while($row5= $result5->fetch_assoc()) { ?>																										
															<option value="<?=$row5["id_grupo"]?>">
																<?php echo $row5["nombre"]; ?>
															</option>
										<?php			} 
													} 
												?>																							
										</select>
									</div>	
									<!--Unidades -->
									<div class="col-12">
										<label for="Unidades" class="form-label">Unidades de Apoyo</label>
										<select name="unidades" id="Unidades" class="form-select" required>
											<option value="0">Seleccione una Unidad de Apoyo</option>
											
											<?php 	
													$sql7="SELECT id_unidades, nombre FROM unidades  ORDER BY nombre ASC";
													include '../../includes/connect.php';
													$connect = $conn;
													//echo $sql7;
														$result7 = $conn->query($sql7);
													if ($result7->num_rows > 0) {
														while($row7= $result7->fetch_assoc()) { ?>																										
															<option value="<?=$row7["id_unidades"]?>">
																<?php echo $row7["nombre"]; ?>
															</option>
										<?php			} 
													} 
												?>																							
										</select>
									</div>

						
						<input type="submit" class="btn btn-primary"value="Actualizar">
						</form>
						<br>
								</div>
							</div>					
							<br>
						
							<!--	<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample100" aria-expanded="false" aria-controls="collapseExample">
									Ver Revisores
								</button>					
								<div class="collapse" id="collapseExample100">
									<div class="card card-body">
									<div class="table-responsive-xxl">
									</div>
									</div>
								</div>	-->						
							</div>
						</div>
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

