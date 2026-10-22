<?php //include 'settings.php'; 
	$name =basename($_SERVER["PHP_SELF"]);	
	if(isset($_GET["id"])){
		$id = $_GET["id"];
	}
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
    
   
    <link href="../../assets/estilo.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-dark fixed-top" >
        <div class="container-fluid" id="menu-container">
            <?php 	include 'menu.php';
					include 'funciones1.php'; 
						if($_SERVER["REQUEST_METHOD"] == "POST" ){
									 if($_GET["eq"] == 1 ){actualizar();}
						}
			?>
        </div>
    </nav>

    <div class="container mt-5 pt-5 content">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card bg-primary text-white">
                    <div class="card-header">Editar Personal</div>
                    <div class="card-body bg-light text-dark">
                        <?php
                       include '../../includes/connect.php';
							$connect = $conn;
                       
                        $sql="SELECT foto, correo FROM personal WHERE id_personal ='".$id."'";
						//  echo $sql;
                        $result = $conn->query($sql);
						//$row= $result->fetch_assoc(); 
						if($result->num_rows > 0) { //echo "hola";
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="text-center">
                            <img id="fotoPerfil" src="../../../investigadores/img/<?=$row["foto"];?>" class="img-thumbnail" width="150" alt="Foto de perfil">
                            <br>
                        </div> 
						<?php   }
						} else { /*echo "Algo paso".$sql;*/ } ?>
						<form id="formFoto" action="ep_subir_foto.php" method="POST" enctype="multipart/form-data" novalidate>
							<input type="file" name="foto" id="inputFoto" accept="image/*" class="form-control mt-2" onchange="cambiarFoto()">
							<input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
							<!--<input type="hidden" name="mail" value="<?php echo $row['correo']; ?>">-->
							<button type="submit" class="btn btn-primary mt-2">Subir Foto</button>
						</form>
						<div id="overlay" class="d-none">
							<div class="spinner-border text-light" role="status"></div>
							<p class="mt-3 text-light">Subiendo imagen…</p>
						</div>

						<form id="registroForm" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=1&id=".$id); ?>">
						<?php
						$sql1="SELECT * FROM personal WHERE id_personal ='".$id."'";
						include '../../includes/connect.php';
							$connect = $conn;
						//echo $sql1;
						$result1 = $conn->query($sql1);
						if ($result1->num_rows > 0) {
                            while($row1= $result1->fetch_assoc()) { ?>
								<h3 class="mt-3">Nombre: <?=$row1["nombres"]." ".$row1["apellido_paterno"]." ".$row1["apellido_materno"];?></h3>
								    <div class="input-group mb-3">
										<span class="input-group-text">Nombre(s) Apellidos</span>
										<input type="text" class="form-control" name="name" value="<?=$row1["nombres"];?>" required>
										<input type="text" class="form-control" name="paterno" value="<?=$row1["apellido_paterno"];?>" required>
										<input type="text" class="form-control" name="materno" value="<?=$row1["apellido_materno"];?>" >
										<div class="invalid-feedback">Todos los campos de nombre y apellidos son obligatorios.</div>
									</div>

									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Correo/usuario @</span>
										<input type="email" class="form-control" placeholder="user@server.com" aria-label="Username"
											aria-describedby="basic-addon1" name="correo" value="<?=$row1["correo"];?>" 
											 pattern="[a-zA-Z0-9._%+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
										<div class="invalid-feedback">Ingrese un correo válido.</div>
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Tel&eacute;fono:</span>
										<input type="telefono" class="form-control" placeholder="5512344567" aria-label="telefono"
											aria-describedby="basic-addon1" name="telefono" value="<?=$row1["telefono"];?>" 
											  required>										
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Extensi&oacute;n:</span>
										<input type="telefono" class="form-control" placeholder="01234" aria-label="telefono"
											aria-describedby="basic-addon1" name="extension" value="<?=$row1["extension"];?>" 
											  required>										
									</div>
									
									
									<!-- Grado académico -->
									<div class="col-12">
										<label for="grado" class="form-label">Grado académico</label>
										<select name="grado" id="grado" class="form-select" required>
											<option value="">Seleccione un grado académico</option>
											<option value="Lic."
												<?= ($row1["grado_academico"] == "Lic.") ? "selected" : ""; ?>>
												Licenciatura
											</option>
											<option value="Mtro(a)."
												<?= ($row1["grado_academico"] == "Mtro(a).") ? "selected" : ""; ?>>
												Maestría
											</option>
											<option value="Dr(a)."
												<?= ($row1["grado_academico"] == "Dr(a).") ? "selected" : ""; ?>>
												Doctorado
											</option>
											<option value="Sin estudios profesionales"
												<?= ($row1["grado_academico"] == "Sin estudios profesionales") ? "selected" : ""; ?>>
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
													   value="<?= htmlspecialchars($row1["scholar"] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
											</div>
											
											<!-- ID SIIA -->
											<div class="col-12 col-md-6 col-xl-3">
												<label for="scholar" class="form-label">ID SIIA</label>
												<input type="text"
													   name="siia"
													   id="siia"
													   class="form-control"
													   placeholder="ID SIIA"
													   value="<?= htmlspecialchars($row1["siia"] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
											</div>

											<!-- ResearchGate -->
											<div class="col-12 col-md-6 col-xl-3">
												<label for="researchgate" class="form-label">ResearchGate</label>
												<input type="text"
													   name="researchgate"
													   id="researchgate"
													   class="form-control"
													   placeholder="ResearchGate"
													   value="<?= htmlspecialchars($row1["researchgate"] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
											</div>

											<!-- ORCID -->
											<div class="col-12 col-md-6 col-xl-3">
												<label for="orcid" class="form-label">ORCID</label>
												<input type="text"
													   name="orcid"
													   id="orcid"
													   class="form-control"
													   placeholder="ORCID"
													   value="<?= htmlspecialchars($row1["orcid"] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
											</div>

											<!-- Scopus -->
											<div class="col-12 col-md-6 col-xl-3">
												<label for="scopus" class="form-label">Scopus</label>
												<input type="text"
													   name="scopus"
													   id="scopus"
													   class="form-control"
													   placeholder="Scopus"
													   value="<?= htmlspecialchars($row1["scopus"] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
											</div>

										</div>
									</div>
									
									<div class="col-12">
											<span class="input-group-text">Semblanza</span>
											<textarea name="semblanza" class="form-control" placeholder="Rese&ntilde;a"><?=$res=$row1["semblanza"];?></textarea>
									</div>
									<!--Departamento -->
									<div class="col-12">
										<label for="Departamento" class="form-label">Departamento</label>
										<select name="departamento" id="Departamento" class="form-select" required>
											<option value="0">Seleccione un departamento</option>
											<?php
												$sql2="SELECT id_departamento, nombre FROM departamentos WHERE id_departamento 
												IN (SELECT id_departamento FROM investigador_departamento WHERE id_investigador = $id)";
												include '../../includes/connect.php';
												$connect = $conn;
												//echo $sql2;
												$result2 = $conn->query($sql2);
												if ($result2->num_rows > 0) {
													while($row2= $result2->fetch_assoc()) { ?>																										
														<option value="<?=$row2["id_departamento"]?>" selected>
															<?php echo $row2["nombre"]; ?>
														</option>
											<?php 	}
												} 
													$sql3="SELECT id_departamento, nombre FROM departamentos WHERE id_departamento 
													NOT IN (SELECT id_departamento FROM investigador_departamento WHERE id_investigador = $id) ORDER BY nombre ASC";
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
												$sql4="SELECT id_grupo, nombre FROM grupos WHERE id_grupo 
												IN (SELECT id_grupo FROM investigador_grupo WHERE id_investigador = $id)";
												include '../../includes/connect.php';
												$connect = $conn;
												//echo $sql4;
												$result4 = $conn->query($sql4);
												if ($result4->num_rows > 0) {
													while($row4= $result4->fetch_assoc()) { ?>																										
														<option value="<?=$row4["id_grupo"]?>" selected>
															<?php echo $row4["nombre"]; ?>
														</option>
											<?php 	}
												} 
													$sql5="SELECT id_grupo, nombre FROM grupos WHERE id_grupo 
													NOT IN (SELECT id_grupo FROM investigador_grupo WHERE id_investigador = $id)  ORDER BY nombre ASC";
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
												$sql6="SELECT id_unidades, nombre FROM unidades WHERE id_unidades
												IN (SELECT id_unidades FROM personal_unidades WHERE id_personal = $id)";
												include '../../includes/connect.php';
												$connect = $conn;
												//echo $sql6;
												$result6 = $conn->query($sql6);
												if ($result6->num_rows > 0) {
													while($row6= $result6->fetch_assoc()) { ?>																										
														<option value="<?=$row6["id_unidades"]?>" selected>
															<?php echo $row6["nombre"]; ?>
														</option>
											<?php 	}
												} 
													$sql7="SELECT id_unidades, nombre FROM unidades WHERE id_unidades 
													NOT IN (SELECT id_unidades FROM personal_unidades WHERE id_personal = $id) ORDER BY nombre ASC";
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
	<?php include'footer.php';?>

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
