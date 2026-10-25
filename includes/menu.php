<nav class="navbar navbar-expand-lg navbar-dark navbar-icaycc sticky-top shadow-sm">
    <div class="container">
       <!-- <a class="navbar-brand d-flex align-items-center" href="https://unam.mx" target="_blank" rel="noopener noreferrer">
            <img src="<?= BASE_URL ?>assets/img/unam.png" alt="UNAM" height="40" class="me-2">
        </a>
        <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>">
            <img src="<?= BASE_URL ?>assets/img/logo_icaycc_blanco.svg" alt="ICAyCC" height="40" class="me-2">
        </a>-->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                aria-controls="menu" aria-expanded="false" aria-label="Abrir menú de navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <!-- INICIO -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>">Inicio</a>
                </li>

                <!-- QUIÉNES SOMOS -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?= BASE_URL ?>quienes/" id="menuQuienes"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">Qui&eacute;nes Somos</a>
                    <ul class="dropdown-menu" aria-labelledby="menuQuienes">
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>quienes/index.php#mision">Visi&oacute;n / Misi&oacute;n</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>quienes/index.php#historia">Historia</a></li>
                        <li class="dropdown-submenu">
                            <button type="button" class="dropdown-item dropdown-submenu-toggle" aria-expanded="false" aria-haspopup="true"><span>Direcci&oacute;n</span></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>quienes/direccion.php">Direcci&oacute;n</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>quienes/sources/reglamento.pdf" target="_blank" rel="noopener noreferrer">Reglamento interno</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>quienes/sources/manual.pdf" target="_blank" rel="noopener noreferrer">Manual de organizaci&oacute;n</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>quienes/sources/plan.pdf" target="_blank" rel="noopener noreferrer">Plan de desarrollo</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>quienes/directorio.php#academicos">Acad&eacute;micos</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>quienes/directorio.php#comisiones">Comisiones</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>quienes/transparencia.php">Transparencia</a></li>

                        <!-- COMISIONES Y COMITÉS: integrados aquí desde el menú comentado -->
                        <li class="dropdown-submenu">
                            <button type="button" class="dropdown-item dropdown-submenu-toggle" aria-expanded="false" aria-haspopup="true"><span>Comisiones y Comit&eacute;s</span></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>comisiones/seguridad.php">Comisi&oacute;n de Seguridad</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>comisiones/genero.php">Comisi&oacute;n Interna de G&eacute;nero</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>comisiones/ruoa.php">Comisi&oacute;n Cient&iacute;fica de la RUOA</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>comisiones/ruoa.php">Comit&eacute; de C&oacute;mputo</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>comisiones/divulgacion.php">Comit&eacute; de Divulgaci&oacute;n y Difusi&oacute;n de la Ciencia</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>comisiones/docencia.php">Comit&eacute; de Docencia</a></li>
                                <li class="dropdown-submenu">
                                    <button type="button" class="dropdown-item dropdown-submenu-toggle" aria-expanded="false" aria-haspopup="true"><span>Comit&eacute; de &Eacute;tica</span></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comisiones/etica.php">Comit&eacute; de &Eacute;tica</a></li>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/sources/guia.pdf" target="_blank" rel="noopener noreferrer">Gu&iacute;a de Integraci&oacute;n del Comit&eacute; de &Eacute;tica</a></li>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/sources/codigo.pdf" target="_blank" rel="noopener noreferrer">C&oacute;digo de Conducta del ICAyCC</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>comisiones/becas.php">Subcomit&eacute; de Becas y SUPERA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- SECRETARÍAS -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="menuSecretarias" role="button" data-bs-toggle="dropdown" aria-expanded="false">Secretar&iacute;as</a>
                    <ul class="dropdown-menu" aria-labelledby="menuSecretarias">
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>secretarias/academica.php">Acad&eacute;mica</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>secretarias/tecnica.php">T&eacute;cnica</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>secretarias/administrativa.php">Administrativa</a></li>
                    </ul>
                </li>

                <!-- DEPARTAMENTOS: tres opciones directas -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?= BASE_URL ?>departamentos/" id="menuDepartamentos" role="button" data-bs-toggle="dropdown" aria-expanded="false">Departamentos</a>
                    <ul class="dropdown-menu" aria-labelledby="menuDepartamentos">
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>departamentos/">Departamentos</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>grupos/">Grupos</a></li>
                        <li class="dropdown-submenu">
                            <button type="button" class="dropdown-item dropdown-submenu-toggle" aria-expanded="false" aria-haspopup="true"><span>Unidades de Apoyo</span></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>unidades/instrumentacion.php">Instrumentaci&oacute;n y Observaci&oacute;n Atmosf&eacute;rica</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>unidades/computo.php">C&oacute;mputo y Superc&oacute;mputo</a></li>
                                <!-- TODO: confirmar la ruta definitiva del Repositorio Institucional -->
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>unidades/repositorio.php">Repositorio Institucional</a></li>
                                <li><a class="dropdown-item" href="https://portal-bcct.bibliotecas.unam.mx/" target="_blank" rel="noopener noreferrer">Biblioteca</a></li>
                                <li><a class="dropdown-item" href="http://uniatmos.atmosfera.unam.mx/ACDM/" target="_blank" rel="noopener noreferrer">UNIATMOS</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- EDUCACIÓN -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="menuEducacion" role="button" data-bs-toggle="dropdown" aria-expanded="false">Educaci&oacute;n</a>
                    <ul class="dropdown-menu" aria-labelledby="menuEducacion">
                        <li class="dropdown-submenu">
                            <button type="button" class="dropdown-item dropdown-submenu-toggle" aria-expanded="false" aria-haspopup="true"><span>Educaci&oacute;n Continua</span></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/continua.php">Educaci&oacute;n Continua</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/continua.php#oferta">Oferta Educativa</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/continua.php#informes">Informes</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/continua.php#recursos">Recursos para Docentes</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <button type="button" class="dropdown-item dropdown-submenu-toggle" aria-expanded="false" aria-haspopup="true"><span>Licenciatura en Ciencias de la Tierra</span></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/licenciatura.php">Licenciatura</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/licenciatura.php#plan">Plan de Estudios en Ciencias Atmosf&eacute;ricas</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/licenciatura.php#becas">Becas</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <button type="button" class="dropdown-item dropdown-submenu-toggle" aria-expanded="false" aria-haspopup="true"><span>Posgrado en Ciencias de la Tierra</span></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/posgrado.php">Posgrado</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/posgrado.php#materiales">Materiales</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/tutores.php">Tutores ICAyCC</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/posgrado.php#becas">Becas</a></li>
                                <li><a class="dropdown-item" href="https://alumnos.iquimica.unam.mx/" target="_blank" rel="noopener noreferrer">Bolsa de Trabajo: Enlace Qu&iacute;mico</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <button type="button" class="dropdown-item dropdown-submenu-toggle" aria-expanded="false" aria-haspopup="true"><span>Int&eacute;grate al ICAyCC</span></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/integrate.php">Int&eacute;grate al ICAyCC</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/integrate.php#servicio">Servicio Social</a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/integrate.php#practicas">Pr&aacute;cticas Profesionales</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- VINCULACIÓN -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?= BASE_URL ?>ensenanza/vinculacion.php" id="menuVinculacion" role="button" data-bs-toggle="dropdown" aria-expanded="false">Vinculaci&oacute;n</a>
                    <ul class="dropdown-menu" aria-labelledby="menuVinculacion">
                        <!-- TODO: confirmar URL de LaNCAC -->
                        <li><a class="dropdown-item" href="#">LaNCAC</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/continua.php#oferta">Oferta Educaci&oacute;n Continua</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/convenios.php">Convenios de Colaboraci&oacute;n</a></li>
                        <li><a class="dropdown-item" href="https://tlaloc.atmosfera.unam.mx/icaycc-ucar/derechosautor/derechoAutor/" target="_blank" rel="noopener noreferrer">Registro de Derechos de Autor</a></li>
                        <!-- Contacto y Servicios se conserva comentado, según solicitud.
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>ensenanza/vinculacion.php#servicios">Contacto y Servicios</a></li>
                        -->
                    </ul>
                </li>

                <!-- COMUNICACIÓN: ahora es opción principal -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?= BASE_URL ?>comunicacion/index.php" id="menuComunicacion" role="button" data-bs-toggle="dropdown" aria-expanded="false">Comunicaci&oacute;n</a>
                    <ul class="dropdown-menu" aria-labelledby="menuComunicacion">
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/index.php">Comunicaci&oacute;n</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/medios.php" target="_blank" rel="noopener noreferrer">ICAyCC en los medios</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/asf.php" target="_blank" rel="noopener noreferrer">Atm&oacute;sfera sin Fronteras</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/eventos.php" target="_blank" rel="noopener noreferrer">Eventos</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>contacto.php" target="_blank" rel="noopener noreferrer">Contacto</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/visitas.php" target="_blank" rel="noopener noreferrer">Visitas Guiadas</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/bienvenidos.php" target="_blank" rel="noopener noreferrer">Bienvenixs Estudiantes</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/atmosferia.php" target="_blank" rel="noopener noreferrer">ATMOSFERIA</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>comunicacion/index.php#descargables" target="_blank" rel="noopener noreferrer">Descargables</a></li>
                    </ul>
                </li>
            </ul>
        </div>
		
		<!-- Redes sociales, después de la lista principal del menú -->
		<div class="navbar-social d-flex align-items-center gap-3 ms-lg-4">
			<a href="https://www.facebook.com/ICAyCC.UNAM/"
			   target="_blank" rel="noopener noreferrer"
			   aria-label="Facebook">
				<i class="bi bi-facebook"></i>
			</a>

			<a href="#" aria-label="X">
				<i class="bi bi-twitter-x"></i>
			</a>

			<a href="#" aria-label="Instagram">
				<i class="bi bi-instagram"></i>
			</a>

			<a href="#" aria-label="YouTube">
				<i class="bi bi-youtube"></i>
			</a>
		</div>

    </div>
</nav>
