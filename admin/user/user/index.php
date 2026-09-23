<?php //include 'settings.php'; 
	$name =basename($_SERVER["PHP_SELF"]);	
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Perfil de usuario">
	<meta name="author" content="RdJG">
    <title>Perfil de Usuario</title>
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
                    <div class="card-header">Mi Perfil ICAyCC</div>
                    <div class="card-body bg-light text-dark">
                        <?php
                       include '../../includes/connect.php';
							$connect = $conn;
                       
                        $sql="SELECT foto FROM personal WHERE correo ='".$_SESSION['mail']."'";
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
						<form id="formFoto" action="subir_foto.php" method="POST" enctype="multipart/form-data" novalidate>
							<input type="file" name="foto" id="inputFoto" accept="image/*" class="form-control mt-2" onchange="cambiarFoto()">
							<input type="hidden" name="id_usuario" value="<?php echo $_SESSION['name']; ?>">
							<input type="hidden" name="mail" value="<?php echo $_SESSION['mail']; ?>">
							<button type="submit" class="btn btn-primary mt-2">Subir Foto</button>
						</form>
						<div id="overlay" class="d-none">
							<div class="spinner-border text-light" role="status"></div>
							<p class="mt-3 text-light">Subiendo imagen…</p>
						</div>

						<form id="registroForm" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=1&id=".$_SESSION['id']); ?>">
						<?php
						$sql1="SELECT * FROM personal WHERE correo ='".$_SESSION['mail']."'";
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
											<option value="Mtra(a)"
												<?= ($row1["grado_academico"] == "Mtro(a).") ? "selected" : ""; ?>>
												Maestría
											</option>
											<option value="Dr(a.)"
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
    <script>
      document.getElementById("formFoto").addEventListener("submit", function (e) {
    e.preventDefault();
    
    let formData = new FormData(this);
	fetch("subir_foto.php", {
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
	<script>
const form = document.getElementById('formFoto');
const spinner = document.getElementById('overlay');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    // Mostrar spinner
    spinner.classList.remove('d-none');

    try {
        const response = await fetch('subir_foto.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

       
    } catch (error) {
        alert('Error de conexión');
    } finally {
        // Ocultar spinner
        spinner.classList.add('d-none');
    }
});
</script>


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<script>
document.getElementById('registroForm').addEventListener('submit', function(event) {
    let form = event.target;
    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
});
</script>
