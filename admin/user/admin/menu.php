 <?php
 include'settings.php';
		

// Consulta devuelve solicitude de autor 		
		include '../../includes/connect.php';
		$connect = $conn;
		$sql01="SELECT COUNT(`activo`) AS sol FROM `users` WHERE `activo` = 0;";
		$result01 = $connect->query($sql01);
		if ($result01->num_rows > 0) { 
			while($row01= $result01->fetch_assoc()) {
				$solicitud= $row01["sol"];
			}
		}
		
	$connect->close();		
//COnsulta devuelve preguntas 
	include '../../includes/connect.php';
	$connect = $conn;
	$sql02 = "SELECT *, COUNT(id_com) as sol FROM comentarios WHERE seleccionada = 0 
			AND comentario != '' AND leida = 0 ORDER BY id_com DESC LIMIT 0, 25;";
	$result02 = $connect->query($sql02);
	if ($result02->num_rows > 0) { 
		while($row02= $result02->fetch_assoc()) {
				$preg= $row02["sol"];
			}	
	}
 ?>
 <div class="container">
    <nav  class="navbar navbar-expand-lg navbar-dark" style="background-color: #002B7A">
   
        <div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="<?=$a;?>../../../assets/logos/rutah.png" alt="Manager Coloquios CPC RutaCPCera" width="100em" >
			</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto nav-pills">
                    <li class="nav-item ">
                        <a class="nav-link<?php echo isset($active0) ? $active0 : ''; ?>" href="index.php">Mi perfil</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link <?php echo isset($active1) ? $active1 : ''; ?>" href="administrar.php">Configuraci&oacute;n</a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link <?php echo isset($active2) ? $active2 : ''; ?>" href="solicitudes.php">Solicitudes</a>
						<?php if($solicitud >0 ) { ?>
						<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
							<?=$solicitud;?>
							<span class="visually-hidden">unread messages</span>
						</span>
							<?php } ?>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link <?php echo isset($active3) ? $active3 : ''; ?>" href="visor_comentarios.php">Preguntas</a>
						<?php if($preg >0 ) { ?>
						<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
							<?=$preg;?>
							<span class="visually-hidden">unread messages</span>
						</span>
						<?php } ?>
                    </li>
					<li class="nav-item position-relative">
                        <a class="nav-link <?php echo isset($active4) ? $active4 : ''; ?>" href="yt.php">Clave YT</a>
                    </li>
					<li class="nav-item position-relative">
                        <a class="nav-link <?php echo isset($active5) ? $active5 : ''; ?>" href="reg.php">Registrar</a>	
                    </li>
				<!--	<li class="nav-item position-relative">
                        <a class="nav-link <?php echo isset($active6) ? $active6 : ''; ?>" href="publicados.php">Publicados</a>
                    </li>
					<li class="nav-item position-relative">
                        <a class="nav-link <?php echo isset($active7) ? $active7 : ''; ?>" href="rechazados.php">Rechazados</a>
                    </li>
					<li class="nav-item position-relative">
                        <a class="nav-link <?php echo isset($active8) ? $active8 : ''; ?>" href="asignaciones.php">Diseño</a>
                    </li>-->
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Bienvenid@ <?php $ufunc->UserName(); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../includes/logout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<script>

let preg = <?php echo $preg; ?>;
let solicitud = <?php echo $solicitud; ?>;
let name = '<?php echo $name; ?>';

function verificarNuevoRegistro() {
    let params = new URLSearchParams();
   // params.append('pre', pre);
    params.append('preg', preg);
    params.append('solicitud', solicitud);

    fetch('check_new_record.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: params.toString()
    })
    .then(response => response.json())
    .then(data => {
        if (data.nuevo) {
            Swal.fire({
                icon: 'info',
                title: 'Nuevo Registro',
                text: data.mensaje,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            })
			;

            // Actualizar los valores de ultimoPen y ultimoPen1
           // ultimoPen1 = data.preg || preg;
          //  ultimoPen2 = data.solicitud || solicitud;
			preg = data.ultimoPen1 ?? preg;
			solicitud = data.ultimoPen2 ?? solicitud;

        }
    })
    .catch(error => console.error('Error al verificar nuevos registros:', error));
}

// Ejecutar cada 15 segundos
setInterval(verificarNuevoRegistro, 15000);


//ACTUALIZAR EL menu
function actualizarMenu() {
    let params = new URLSearchParams();
    params.append('name', name);

    fetch('menu.php?' + params.toString()) // Parámetros en la URL
        .then(response => response.text())
        .then(data => {
            document.getElementById('menu-container').innerHTML = data; // Reemplaza el menú viejo
			 name = data.name || name;
        })
        .catch(error => console.error('Error al actualizar el menú:', error));
}

// Ejecutar cada 20 segundos
setInterval(actualizarMenu, 20000);


</script>



