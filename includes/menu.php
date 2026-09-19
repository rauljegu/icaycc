<nav class="navbar navbar-expand-lg navbar-dark navbar-icaycc">
    <div class="container">
        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="https://unam.mx" target="_blank">
            <img
                src="<?= BASE_URL ?>assets/img/unam.png"
                alt="ICAyCC" height="40" class="me-2">
        </a>
		<!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>">
            <img
                src="<?= BASE_URL ?>assets/img/logo_icaycc_blanco.svg"
                alt="ICAyCC" height="40" class="me-2">
        </a>
        <!-- BOTÓN MENÚ MÓVIL -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu"
            aria-controls="menu"
            aria-expanded="false"
            aria-label="Abrir menú de navegación"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENÚ -->
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <!-- =========================
                     INICIO
                ========================== -->
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="<?= BASE_URL ?>"
                    >
                        Inicio
                    </a>
                </li>

                <!-- =========================
                     QUIENES SOMOS
                ========================== -->

                <li class="nav-item dropdown">

                    <a
                        class="nav-link dropdown-toggle"
                        href="<?= BASE_URL ?>quienes/"
                        id="menuQuienes"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Qui&eacute;nes Somos
                    </a>


                    <ul
                        class="dropdown-menu"
                        aria-labelledby="menuQuienes"
                    >


                        <!-- VISIÓN / MISIÓN -->

                        <li>

                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>quienes/index.php#mision"
                            >
                                Visi&oacute;n / Misi&oacute;n
                            </a>

                        </li>


                        <!-- HISTORIA -->

                        <li>

                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>quienes/index.php#historia"
                            >
                                Historia
                            </a>

                        </li>


                        <!-- =====================
                             DIRECCIÓN + SUBMENÚ
                        ====================== -->

                        <li class="dropdown-submenu">

                            <button
                                type="button"
                                class="dropdown-item dropdown-submenu-toggle"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >

                                <span>
                                    Direcci&oacute;n
                                </span>

                            </button>


                            <ul class="dropdown-menu">


                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>quienes/direccion.php"
                                    >
                                        Direcci&oacute;n
                                    </a>

                                </li>


                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>quienes/sources/reglamento.pdf"
										target="_blank"
                                    >
                                        Reglamento interno
                                    </a>

                                </li>


                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>quienes/sources/manual.pdf"
										target="_blank"
                                    >
                                        Manual de organizaci&oacute;n
                                    </a>

                                </li>


                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>quienes/sources/plan.pdf"
										target="_blank"
                                    >
                                        Plan de desarrollo
                                    </a>

                                </li>

                            </ul>

                        </li>


                        <!-- ACADÉMICOS -->

                        <li>

                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>quienes/directorio.php#academicos"
                            >
                                Acad&eacute;micos
                            </a>

                        </li>


                        <!-- COMISIONES -->

                        <li>

                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>quienes/directorio.php#comisiones"
                            >
                                Comisiones
                            </a>

                        </li>


                        <!-- TRANSPARENCIA -->

                        <li>

                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>quienes/transparencia.php"
                            >
                                Transparencia
                            </a>

                        </li>

                    </ul>

                </li>

                <!-- =========================
                     SECRETARÍAS
                ========================== -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        id="menuSecretarias"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Secretar&iacute;as
                    </a>


                    <ul
                        class="dropdown-menu"
                        aria-labelledby="menuSecretarias"
                    >

                        <li>

                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>secretarias/academica.php"
                            >
                                Acad&eacute;mica
                            </a>

                        </li>

                        <li>

                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>secretarias/administrativa.php"
                            >
                                Administrativa
                            </a>

                        </li>

                        <li>

                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>secretarias/tecnica.php"
                            >
                                T&eacute;cnica
                            </a>

                        </li>

                    </ul>

                </li>

                <!-- =========================
                     DEPARTAMENTOS
                ========================== -->
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="<?= BASE_URL ?>departamentos/"
                    >
                        Departamentos
                    </a>
                </li>

                <!-- =========================
                     GRUPOS
                ========================== -->
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="<?= BASE_URL ?>grupos/"
                    >
                        Grupos
                    </a>
                </li>

				<!-- =========================
                     UNIDADES DE APOYO
                ========================== -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="<?= BASE_URL ?>unidades/"
                        id="menuApoyo"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                       Unidades de Apoyo
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="menuApoyo">
                        <li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>unidades/index.php"
                            >
                                Unidades de Apoyo
                            </a>
                        </li>
						<li>
                            <a
                                class="dropdown-item"
                                href="https://portal-bcct.bibliotecas.unam.mx/"
								target="_blank"
                            >
                                Biblioteca
                            </a>
                        </li>
						<!-- ===============================
							 VINCULACIÓN Y EDUCACIÓN CONTINUA
						================================ -->
						<li class="dropdown-submenu">
							<button
								type="button"
								class="dropdown-item dropdown-submenu-toggle"
								aria-expanded="false"
								aria-haspopup="true"
							>
								<span>
									Vinculaci&oacute;n y Educaci&oacute;n Continua
								</span>
							</button>

							<!-- ==========================
								 SEGUNDO NIVEL
							=========================== -->
							<ul class="dropdown-menu">

								<!-- ==========================
									 VINCULACIÓN
								=========================== -->
								<li class="dropdown-submenu">

									<button
										type="button"
										class="dropdown-item dropdown-submenu-toggle"
										aria-expanded="false"
										aria-haspopup="true"
									>
										<span>
											Vinculaci&oacute;n
										</span>
									</button>


									<!-- SUBMENÚ VINCULACIÓN -->
									<ul class="dropdown-menu">

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/vinculacion.php"
											>
												Vinculaci&oacute;n
											</a>
										</li>

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/convenios.php"
											>
												Convenios de Colaboraci&oacute;n
											</a>
										</li>

										<li>
											<a
												class="dropdown-item"
												href="https://tlaloc.atmosfera.unam.mx/icaycc-ucar/derechosautor/derechoAutor/"
											>
												Registro de Derechos de Autor
											</a>
										</li>
										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/vinculacion.php#servicios"
											>
												Contacto y Servicios
											</a>
										</li>

									</ul>

								</li>

								<!-- ==========================
									 EDUCACIÓN CONTINUA
								=========================== -->
								<li class="dropdown-submenu">

									<button
										type="button"
										class="dropdown-item dropdown-submenu-toggle"
										aria-expanded="false"
										aria-haspopup="true"
									>
										<span>
											Educaci&oacute;n Continua
										</span>
									</button>


									<!-- SUBMENÚ EDUCACIÓN CONTINUA -->
									<ul class="dropdown-menu">

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/continua.php"
											>
												Educaci&oacute;n Continua
											</a>
										</li>

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/continua.php#oferta"
											>
												Oferta Educativa
											</a>
										</li>
										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/continua.php#informes"
											>
												Informes
											</a>
										</li>

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/continua.php#recursos"
											>
												Recusrsos para Docentes
											</a>
										</li>

									</ul>

								</li>
																
								<!-- ==========================
									 POSGRADO
								=========================== -->
								<li class="dropdown-submenu">

									<button
										type="button"
										class="dropdown-item dropdown-submenu-toggle"
										aria-expanded="false"
										aria-haspopup="true"
									>
										<span>
											Posgrado en Ciencias de la Tierra
										</span>
									</button>


									<!-- SUBMENÚ INTÉGRATE -->
									<ul class="dropdown-menu">

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/posgrado.php"
											>
												Posgrado
											</a>
										</li>

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/posgrado.php#materiales"
											>
												Materiales
											</a>
										</li>

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/tutores.php"
											>
												Tutores ICAyCC
											</a>
										</li>
										
										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/posgrado.php#becas"
											>
												Becas
											</a>
										</li>
										<li>
											<a
												class="dropdown-item"
												href="https://alumnos.iquimica.unam.mx/"
												target="_blank"
											>
												Bolsa de Trabajo: Enlace Qu&iacute;mico
											</a>
										</li>

									</ul>

								</li>
								
								<!-- ==========================
									 LICENCIATURA
								=========================== -->
								<li class="dropdown-submenu">

									<button
										type="button"
										class="dropdown-item dropdown-submenu-toggle"
										aria-expanded="false"
										aria-haspopup="true"
									>
										<span>
											Licenciatura en Ciencias de la Tierra
										</span>
									</button>


									<!-- SUBMENÚ INTÉGRATE -->
									<ul class="dropdown-menu">

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/licenciatura.php"
											>
												Licenciatura
											</a>
										</li>

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/licenciatura.php#plan"
											>
												Plan de Estudios en Ciencias Atmosf&eacute;ricas
											</a>
										</li>
										
										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/licenciatura.php#becas"
											>
												Becas
											</a>
										</li>
										
									</ul>

								</li>
								<!-- ==========================
									 INTÉGRATE AL ICAyCC
								=========================== -->
								<li class="dropdown-submenu">

									<button
										type="button"
										class="dropdown-item dropdown-submenu-toggle"
										aria-expanded="false"
										aria-haspopup="true"
									>
										<span>
											Int&eacute;grate al ICAyCC
										</span>
									</button>

									<!-- SUBMENÚ INTÉGRATE -->
									<ul class="dropdown-menu">
										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/integrate.php"
											>
												Int&eacute;grate al ICAyCC
											</a>
										</li>

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/integrate.php#servicio"
											>
												Servicio Social
											</a>
										</li>

										<li>
											<a
												class="dropdown-item"
												href="<?= BASE_URL ?>ensenanza/integrate.php#practicas"
											>
												Pr&aacute;cticas Profesionales
											</a>
										</li>

									</ul>

								</li>

							</ul>

						</li>						
						<!-- =====================
                             COMUNICACIÓN + SUBMENÚ
                        ====================== -->
                        <li class="dropdown-submenu">
                            <button
                                type="button"
                                class="dropdown-item dropdown-submenu-toggle"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                <span>
                                    Comunicaci&oacute;n
                                </span>
                            </button>

                            <ul class="dropdown-menu">                         
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/index.php"
										target="_blank"
                                    >
                                        Comunicaci&oacute;n
                                    </a>
                                </li>

                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/medios.php"
										target="_blank"
                                    >
                                       ICAyCC en los medios
                                    </a>
                                </li>

                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/asf.php"
										target="_blank"
                                    >
                                        Atm&oacute;mosfera sin Fronteras
                                    </a>
                                </li>
								
								<li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/eventos.php"
										target="_blank"
                                    >
                                       Eventos
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>contacto.php"
										target="_blank"
                                    >
                                       Contacto
                                    </a>
                                </li>

                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/visitas.php"
										target="_blank"
                                    >
                                        Visitas Guiadas
                                    </a>
                                </li>
								
								<li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/bienvenidos.php"
										target="_blank"
                                    >
                                        Bienvenixs Estudiantes
                                    </a>
                                </li>
								<li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/atmosferia.php"
										target="_blank"
                                    >
                                        ATMOSFERIA
                                    </a>
                                </li>
								
								<li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/index.php#descargables"
										target="_blank"
                                    >
                                        Descargables
                                    </a>
                                </li>

                            </ul>

                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>unidades/computo.php"
                            >
                                C&oacute;mputo y Superc&oacute;mputo
                            </a>
                        </li>
						<li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>unidades/instrumentacion.php"
                            >
                               Instrumentaci&oacute;n y Observaci&oacute;n Atmosf&eacute;rica
                            </a>
                        </li>
						<li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>unidades/uniatmos.php"
                            >
                               UNIATMOS
                            </a>
                        </li>
                    </ul>

                </li>

				<!-- =========================
                       COMISIONES Y COMITÉS
                ========================== -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="<?= BASE_URL ?>comisiones/"
                        id="menuComites"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                       Comisiones y Comit&eacute;s
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="menuComites">
						

                        <li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>comisiones/seguridad.php"
                            >
                                Comisi&oacute;n de Seguridad
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>comisiones/genero.php"
                            >
                                Comisi&oacute;n Interna de G&eacute;nero
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>comisiones/ruoa.php"
                            >
                                Comisi&oacute;n Cient&iacute;fica de la RUOA
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>comisiones/ruoa.php"
                            >
                                Comit&eacute; de C&oacute;mputo
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>comisiones/divulgacion.php"
                            >
                                Comit&eacute; de Divulgaci&oacute;n y Difusi&oacute;n de la Ciencia
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>comisiones/docencia.php"
                            >
                                Comit&eacute; de Docencia
                            </a>
                        </li>
						<!-- =====================
                             COMITE DE ETICA
                        ====================== -->
                        <li class="dropdown-submenu">
                            <button
                                type="button"
                                class="dropdown-item dropdown-submenu-toggle"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                <span>
                                   Comit&eacute; de &Eacute;tica
                                </span>
                            </button>

                            <ul class="dropdown-menu">                         
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comisiones/etica.php"
                                    >
                                        Comit&eacute; de &Eacute;tica
                                    </a>
                                </li>

                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/sources/guia.pdf"
										target="_blank"
                                    >
                                       Gu&iacute;a de Integraci&oacute; del Comit&eacute; de &Eacute;tica
                                    </a>
                                </li> 
								<li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL ?>comunicacion/sources/codigo.pdf"
										target="_blank"
                                    >
                                      C&oacute;digo de Conducta del ICAyCC
									 </a> 
                                </li>

                             

                            </ul>

                        </li>
						<li>
                            <a
                                class="dropdown-item"
                                href="<?= BASE_URL ?>comisiones/becas.php"
                            >
                                Subcomit&eacute; de Becas y SUPERA
                            </a>
                        </li>
                    </ul>
						
                </li>
            </ul>
        </div>
    </div>
</nav>