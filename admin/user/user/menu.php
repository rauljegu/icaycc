<?php
		include'settings.php';
?>
 <div class="container">
    <nav  class="navbar navbar-expand-lg navbar-dark" >
   
        <div class="container-fluid">
			<h2 style="color:#fff">ICAyCC</h2>
			<p>    </p>
            <!--<a class="navbar-brand" href="#">Gaceta SD</a>-->
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
                        <a class="nav-link <?php echo isset($active1) ? $active1 : ''; ?>" href="secciones.php">Secciones</a>
                    </li>
					<li class="nav-item ">
                        <a class="nav-link <?php echo isset($active2) ? $active2 : ''; ?>" href="personal.php">Personal</a>
                    </li>
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
