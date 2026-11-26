<?php //include 'settings.php'; 
	$name =basename($_SERVER["PHP_SELF"]);	
	$directorio = basename(__DIR__);
	 include '../../includes/connect.php';
	$connect = $conn;
	require_once __DIR__ . '/actualidad_procesar.php';

/* ==========================================
   ADMINISTRACIÓN DE ACTUALIDAD
   ========================================== */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_actualidad'])) {
    $_SESSION['csrf_actualidad'] = bin2hex(random_bytes(32));
}

$mensajeActualidad = '';

/* Directorios */

$directorioFisico = dirname(__DIR__, 3) . '/assets/img/actualidad/';
$directorioRelativo = 'assets/img/actualidad/';

/* ==========================================
   GUARDAR NUEVA PUBLICACIÓN
   ========================================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['guardar_actualidad'])) {

    try {

        /* Validar CSRF */

        if (
            empty($_POST['csrf_actualidad']) ||
            !hash_equals(
                $_SESSION['csrf_actualidad'],
                $_POST['csrf_actualidad']
            )
        ) {
            throw new Exception('Solicitud no válida.');
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $enlaceMas = trim($_POST['enlace_mas'] ?? '');
        $enlaceCartel = trim($_POST['enlace_cartel'] ?? '');

        $fechaPublicacion = $_POST['fecha_publicacion'] ?? '';
        $fechaDespublicacion = $_POST['fecha_despublicacion'] ?? '';

        $orden = filter_var(
            $_POST['orden'] ?? 0,
            FILTER_VALIDATE_INT
        );

        $activo = isset($_POST['activo']) ? 1 : 0;

        /* Validaciones */

        if ($titulo === '') {
            throw new Exception('El título es obligatorio.');
        }

        if (!$orden || $orden < 1) {
            throw new Exception('El orden debe ser un número mayor que cero.');
        }

        if (!$fechaPublicacion) {
            throw new Exception('Selecciona la fecha de publicación.');
        }

        $inicio = DateTime::createFromFormat('!Y-m-d', $fechaPublicacion);

        if (!$inicio || $inicio->format('Y-m-d') !== $fechaPublicacion) {
            throw new Exception('La fecha de publicación no es válida.');
        }

        if ($fechaDespublicacion !== '') {

            $fin = DateTime::createFromFormat(
                '!Y-m-d',
                $fechaDespublicacion
            );

            if (!$fin || $fin->format('Y-m-d') !== $fechaDespublicacion) {
                throw new Exception('La fecha de despublicación no es válida.');
            }

            if ($fechaDespublicacion < $fechaPublicacion) {
                throw new Exception(
                    'La fecha final no puede ser anterior a la inicial.'
                );
            }
        }

        /* Validar enlaces */

        foreach ([$enlaceMas, $enlaceCartel] as $url) {

            if ($url !== '') {

                $partes = parse_url($url);

                if (
                    filter_var($url, FILTER_VALIDATE_URL) === false ||
                    !isset($partes['scheme']) ||
                    !in_array(strtolower($partes['scheme']), ['http', 'https'])
                ) {
                    throw new Exception('Uno de los enlaces no es válido.');
                }
            }
        }

        /* Validar imagen */

        if (
            !isset($_FILES['imagen']) ||
            $_FILES['imagen']['error'] !== UPLOAD_ERR_OK
        ) {
            throw new Exception('Debes seleccionar una imagen válida.');
        }

        if ($_FILES['imagen']['size'] > 5 * 1024 * 1024) {
            throw new Exception('La imagen no debe superar los 5 MB.');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);

        $mime = $finfo->file($_FILES['imagen']['tmp_name']);

        $formatos = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        if (!isset($formatos[$mime])) {
            throw new Exception('Formato de imagen no permitido.');
        }

        if (getimagesize($_FILES['imagen']['tmp_name']) === false) {
            throw new Exception('El archivo no es una imagen válida.');
        }

        /* Crear directorio si no existe */

        if (!is_dir($directorioFisico)) {

            if (!mkdir($directorioFisico, 0755, true)) {
                throw new Exception('No se pudo crear el directorio de imágenes.');
            }
        }

        /* Nombre único */

        $nombreImagen = bin2hex(random_bytes(16))
            . '.' . $formatos[$mime];

        $rutaDestino = $directorioFisico . $nombreImagen;

        if (!move_uploaded_file(
            $_FILES['imagen']['tmp_name'],
            $rutaDestino
        )) {
            throw new Exception('No se pudo guardar la imagen.');
        }

        $rutaImagen = $directorioRelativo . $nombreImagen;

        /* Insertar registro */

        $sql = "
            INSERT INTO actualidad (
                titulo,
                imagen,
                enlace_mas,
                enlace_cartel,
                fecha_publicacion,
                fecha_despublicacion,
                orden,
                activo
            )
            VALUES (?, ?, NULLIF(?, ''), NULLIF(?, ''),
                    ?, NULLIF(?, ''), ?, ?)
        ";

        $stmt = $connect->prepare($sql);

        if (!$stmt) {
            throw new Exception('Error al preparar la consulta.');
        }

        $stmt->bind_param(
            "ssssssii",
            $titulo,
            $rutaImagen,
            $enlaceMas,
            $enlaceCartel,
            $fechaPublicacion,
            $fechaDespublicacion,
            $orden,
            $activo
        );

        if (!$stmt->execute()) {

            unlink($rutaDestino);

            throw new Exception('No se pudo registrar la publicación.');
        }

        $stmt->close();

        $_SESSION['mensaje_actualidad'] = [
            'tipo' => 'success',
            'texto' => 'Publicación registrada correctamente.'
        ];

        header('Location: secciones.php');
        exit;

    } catch (Exception $e) {

        $mensajeActualidad = $e->getMessage();

    }
}

/* ==========================================
   CONSULTAR PUBLICACIONES
   ========================================== */

$sqlActualidad = "
    SELECT *
    FROM actualidad
    ORDER BY orden ASC, fecha_registro DESC
";

$resultActualidad = $connect->query($sqlActualidad);

if (!$resultActualidad) {
    die('Error al consultar actualidad: ' . $connect->error);
}

/* Mensajes */

if (isset($_SESSION['mensaje_actualidad'])) {

    $mensajeActualidad = $_SESSION['mensaje_actualidad'];

    unset($_SESSION['mensaje_actualidad']);

}


	
	// Obtener lista de personal
	$asi="SELECT * FROM personal ORDER BY activo DESC, nombres ASC, nombre ASC, apellido_paterno ASC, apellido_materno ASC; ";
	$resultasi = $connect->query($asi);
	

	if ($resultasi === false) {
		die("Error en la consulta: " . $connect->error);
	}
require_once __DIR__ . '/agenda_admin.php';
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
				<?php include __DIR__ . '/actualidad_admin.php'; ?>
			<?php include __DIR__ . '/agenda_admin_vista.php'; ?>

			</div> <!--FIN ROW-->
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
		<script>

// Vista previa de imagen

document.getElementById('imagenActualidad')
.addEventListener('change', function() {

    const archivo = this.files[0];

    const preview = document.getElementById('previewActualidad');

    if (archivo) {

        preview.src = URL.createObjectURL(archivo);

        preview.style.display = 'inline-block';

    } else {

        preview.style.display = 'none';

    }

});


// Validación de fechas

const fechaInicio = document.getElementById('fechaPublicacion');

const fechaFin = document.getElementById('fechaDespublicacion');

fechaInicio.addEventListener('change', function() {

    fechaFin.min = this.value;

    if (fechaFin.value && fechaFin.value < this.value) {

        fechaFin.value = '';

    }

});

fechaFin.addEventListener('change', function() {

    if (
        this.value &&
        fechaInicio.value &&
        this.value < fechaInicio.value
    ) {

        Swal.fire({
            icon: 'warning',
            title: 'Fecha incorrecta',
            text: 'La fecha final no puede ser anterior a la fecha inicial.'
        });

        this.value = '';

    }

});


// Notificaciones

<?php if (is_array($mensajeActualidad)): ?>

Swal.fire({
    toast: true,
    position: 'top-end',
    icon: <?= json_encode($mensajeActualidad['tipo']) ?>,
    title: <?= json_encode($mensajeActualidad['texto']) ?>,
    showConfirmButton: false,
    timer: 3500
});

<?php elseif ($mensajeActualidad !== ''): ?>

Swal.fire({
    icon: 'error',
    title: 'Error',
    text: <?= json_encode($mensajeActualidad) ?>
});

<?php endif; ?>

</script>

