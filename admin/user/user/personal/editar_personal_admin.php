<?php 
    // La configuración y la validación de sesión deben ejecutarse antes de cualquier HTML.
    $name = basename($_SERVER['PHP_SELF']);
    require_once '../settings.php';
    require_once '../../../includes/connect.php';
//include 'settings.php'; 
	$name =basename($_SERVER["PHP_SELF"]);	
	if(isset($_GET["id"])){
		$id = $_GET["id"];
	}
		$directorio = basename(__DIR__);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Perfil de usuario">
	<meta name="author" content="RdJG">
    <title>Editar Personal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
   
    <link href="../../../assets/estilo.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-dark fixed-top" >
        <div class="container-fluid" id="menu-container">
            <?php 	include '../menu.php';
					include '../funciones1.php'; 
						if($_SERVER["REQUEST_METHOD"] == "POST" ){
									 if($_GET["eq"] == 1 ){
										 actualizar_ad();
										//echo "aqui se llama la funcion actualizar_ad";
									 }
						}
			?>
        </div>
    </nav>

    <div class="container mt-5 pt-5 content">
        <div class="row">
            <div class="col-md-8 mx-auto">
				<button type="button" class="btn btn-outline-secondary"
					onclick="window.location.href = '../personal.php'; ">
					<i class="fas fa-arrow-left me-2"></i> Regresar
				</button>
                <div class="card bg-primary text-white">
                    <div class="card-header">Editar Personal</div>
                    <div class="card-body bg-light text-dark">
                     

						<form id="registroForm" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=1&id=".$id); ?>">
						<?php
						$sql1="SELECT * FROM personal WHERE id_personal ='".$id."'";
						include '../../../includes/connect.php';
							$connect = $conn;
						//echo $sql1;
						$result1 = $conn->query($sql1);
						if ($result1->num_rows > 0) {
                            while($row1= $result1->fetch_assoc()) { ?>
								<h3 class="mt-3">Nombre: <?=$row1["nombres"]." ".$row1["apellido_paterno"]." ".$row1["apellido_materno"];?></h3>
								    <div class="input-group mb-3">
										<span class="input-group-text">Nombre(s) Apellidos</span>
										<input type="text" class="form-control" name="name" value="<?=$row1["nombres"];?>" placeholder="Nombres" required>
										<input type="text" class="form-control" name="paterno" value="<?=$row1["apellido_paterno"];?>" placeholder="Apellido Paterno" required>
										<input type="text" class="form-control" name="materno" value="<?=$row1["apellido_materno"];?>" placeholder="Apellido Materno" >
										<div class="invalid-feedback">Todos los campos de nombre y apellidos son obligatorios.</div>
									</div>

									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Correo/usuario @</span>
										<input type="email" class="form-control" placeholder="user@server.com" aria-label="Username"
											aria-describedby="basic-addon1" name="correo" value="<?=$row1["correo"];?>" 
											 pattern="[a-zA-Z0-9._%+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" >
										<div class="invalid-feedback">Ingrese un correo válido.</div>
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Tel&eacute;fono:</span>
										<input type="telefono" class="form-control" placeholder="5512345678" aria-label="telefono"
											aria-describedby="basic-addon1" name="telefono" value="<?=$row1["telefono"];?>" 
											  >										
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Extensi&oacute;n:</span>
										<input type="telefono" class="form-control" placeholder="01234" aria-label="telefono"
											aria-describedby="basic-addon1" name="extension" value="<?=$row1["extension"];?>" 
											  >										
									</div>
									
									
									<!-- Grado académico -->
									<div class="col-12">
										<label for="grado" class="form-label">Grado académico</label>
										<select name="grado" id="grado" class="form-select" >
											<option value="">Seleccione un grado académico</option>
											<option value="Licenciatura"
												<?= ($row1["grado_academico"] == "Licenciatura") ? "selected" : ""; ?>>
												Licenciatura
											</option>
											<option value="Maestría"
												<?= ($row1["grado_academico"] == "Maestría") ? "selected" : ""; ?>>
												Maestría
											</option>
											<option value="Doctorado"
												<?= ($row1["grado_academico"] == "Doctorado") ? "selected" : ""; ?>>
												Doctorado
											</option>
											<option value="Sin estudios profesionales"
												<?= ($row1["grado_academico"] == "Sin estudios profesionales") ? "selected" : ""; ?>>
												Sin estudios profesionales
											</option>
										</select>
									</div>
										<h3>Cargos</h3>
									<!--Cargos -->
									<div class="col-12">
										<label for="cargos" class="form-label">Cargo</label>
										<select name="cargo" id="cargos" class="form-select" required>
											<option value="0">Seleccione un cargo</option>
											<?php
												$cargo="SELECT id_cargo, nombre FROM cargos WHERE id_cargo
												IN (SELECT cargo FROM personal WHERE id_personal = $id)";
												include '../../../includes/connect.php';
												$connect = $conn;
												//echo $sql6;
												$resultcargo = $conn->query($cargo);
												if ($resultcargo->num_rows > 0) {
													while($rowcargo= $resultcargo->fetch_assoc()) { ?>																										
														<option value="<?=$rowcargo["id_cargo"]?>" selected>
															<?php echo $rowcargo["nombre"]; ?>
														</option>
											<?php 	}
												} 
													$cargo1="SELECT id_cargo, nombre FROM cargos WHERE id_cargo 
													NOT IN (SELECT cargo FROM personal WHERE id_personal = $id) ORDER BY nombre ASC";
													include '../../../includes/connect.php';
													$connect = $conn;
													//echo $sql7;
														$resultcargo1 = $conn->query($cargo1);
													if ($resultcargo1->num_rows > 0) {
														while($rowcargo1= $resultcargo1->fetch_assoc()) { ?>																										
															<option value="<?=$rowcargo1["id_cargo"]?>">
																<?php echo $rowcargo1["nombre"]; ?>
															</option>
										<?php			} 
													} 
												?>																							
										</select>
									</div>
											
								

						<?php	}
						?>
													<?php 
						} ?>
						<input type="submit" class="btn btn-primary"value="Actualizar">
						</form>
						<br>
						<br>
						<br>
						<?php //include'cambiarpass.php';?>
                    </div>
                </div>
				<button type="button" class="btn btn-outline-secondary"
					onclick="window.location.href = '../personal.php'; ">
					<i class="fas fa-arrow-left me-2"></i> Regresar
				</button>
            </div>
        </div>
    </div>
				<?php		
				if (isset($_GET['response'])) {
					$responseJson = urldecode($_GET['response']);
					$response = json_decode($responseJson, true);

					if ($response) {
						echo "<script>
							document.addEventListener('DOMContentLoaded', function() {
								const Toast = Swal.mixin({
									toast: true,
									position: 'center',
									showConfirmButton: false,
									timer: 3000,
									timerProgressBar: true,
									didOpen: (toast) => {
										toast.onmouseenter = Swal.stopTimer;
										toast.onmouseleave = Swal.resumeTimer;
									}
								});

								Toast.fire({
									icon: '" . ($response['status'] === 'success' ? 'success' : 'warning') . "',
									title: '" . addslashes($response['message']) . "'
								});

								// Redirigir después de mostrar el toast
								//setTimeout(() => {
								//	window.location.href = 'index.php';
							//	}, 1);
							});
						</script>";
					}
				}
						 
				?>
	<?php include'../footer.php';?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<script>
      document.getElementById("formFoto").addEventListener("submit", function (e) {
    e.preventDefault();
    
    let formData = new FormData(this);
	fetch("ep_subir_foto.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            Swal.fire({
                title: "Éxito",
                text: data.mensaje,
                icon: "success",
                confirmButtonText: "Aceptar"
            }).then(() => {
                location.reload(); // 👈 recarga aquí
            });
        } else {
            Swal.fire("Error", data.mensaje, "error");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire("Error", "Hubo un problema al subir la foto.", "error");
    });
});

function cambiarFoto() {
    const input = document.getElementById('inputFoto');
    const img = document.getElementById('fotoPerfil');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

    </script>
