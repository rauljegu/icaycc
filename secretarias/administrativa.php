<?php
require_once __DIR__ . '/../config/config.php';
?>

<div class="container py-5">

    <h1 class="mb-4">
        Secretar&iacute;a Administrativa
    </h1>

    <div class="row g-4">

        <!-- DESCRIPCIÓN -->
        <div class="col-12 col-md-6">

            <div class="card shadow-sm h-100">

                <div class="card-body" id="mision">

                    <p>
                        La <b>Secretaría Administrativa</b> está integrada por los 
						Departamentos de Bienes y Suministros, el Departamento de Presupuesto, 
						el Departamento de Personal, y Servicios Generales.
						<br>
						Es la responsable de apoyar a la Dirección del Instituto 
						de Ciencias de la Atmósfera y Cambio Climático en la
						planeación, organización, ejecución, coordinación y 
						supervisión de los recursos humanos, financieros, 
						materiales tecnológicos, y servicios de apoyo que 
						requieren las diferentes áreas que la integran, a fin de 
						proporcionar oportunamente los servicios administrativos 
						que se requieran para el desarrollo de las funciones 
						sustantivas del Instituto.
                    </p>

                </div>

            </div>

        </div>


        <!-- IMAGEN -->
        <div class="col-12 col-md-6">

            <div class="card shadow-sm h-100">

                <div class="card-body card-fondo-verde
                            d-flex align-items-center justify-content-center">

                    <img
                        src="img/administrativa.jpg"
                        class="img-fluid"
                        alt="Secretaría Administrativa"
                    >

                </div>

            </div>

        </div>


        <!-- MENÚS Y CONTENIDO -->
        <div class="col-12">

            <div class="d-flex flex-column flex-lg-row align-items-stretch">

                <!-- ========================= -->
                <!-- MENÚ VERTICAL / HORIZONTAL -->
                <!-- ========================= -->

                <div
                    class="nav nav-tabs flex-row flex-lg-column
                           me-lg-3 mb-3 mb-lg-0"
                    id="nav-tab"
                    role="tablist"
                    aria-orientation="vertical"
                >

                    <button
                        class="nav-link active boton-fondo-verde"
                        id="nav-Secretaria-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Secretaria"
                        type="button"
                        role="tab"
                        aria-controls="nav-Secretaria"
                        aria-selected="true"
                    >
                        SECRETARIA ADMINISTRATIVA
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-personal-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-personal"
                        type="button"
                        role="tab"
                        aria-controls="nav-personal"
                        aria-selected="false"
                    >
                        DEPARTAMENTO DE PERSONAL
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Presupuesto-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Presupuesto"
                        type="button"
                        role="tab"
                        aria-controls="nav-Presupuesto"
                        aria-selected="false"
                    >
                        DEPARTAMENTO DE PRESUPUESTO
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Bienes-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Bienes"
                        type="button"
                        role="tab"
                        aria-controls="nav-Bienes"
                        aria-selected="false"
                    >
                        BIENES Y SUMINISTROS
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Generales-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Generales"
                        type="button"
                        role="tab"
                        aria-controls="nav-Generales"
                        aria-selected="false"
                    >
                       SERVICIOS GENERALES
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Fundanet-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Fundanet"
                        type="button"
                        role="tab"
                        aria-controls="nav-Fundanet"
                        aria-selected="false"
                    >
                       FUNDANET
                    </button>


                </div>


                <!-- ========================= -->
                <!-- CONTENIDO DE LAS TABS -->
                <!-- ========================= -->

                <div
                    class="tab-content flex-grow-1"
                    id="nav-tabContent"
                >


                    <!-- ================================= -->
                    <!-- SECRETARÍA ADMINISTRATIVA -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade show active"
                        id="nav-Secretaria"
                        role="tabpanel"
                        aria-labelledby="nav-Secretaria-tab"
                        tabindex="0"
                    >

                        <div class="d-grid gap-4">


                            <!-- CARD 1 -->
                            <div class="card shadow-sm">

                                <div class="row g-0">

                                    <div class="col-md-4">
										<?php
											$imagenSecretaria = __DIR__ . '/img/secretaria_adm.jpg';

											if (file_exists($imagenSecretaria)) {
												$imagenSecretaria = 'img/secretaria_adm.jpg';
											} else {
												$imagenSecretaria = BASE_URL . 'assets/img/avatar.png';
											}
											?>
                                        <img
                                            src="<?= $imagenSecretaria; ?>"
                                            class="img-fluid rounded-start
                                                   w-100 h-100 object-fit-cover"
                                            alt="Secretaría Administrativa"
                                        >

                                    </div>


                                    <div class="col-md-8">

                                        <div class="card-body">

                                            <h3 class="card-title text-center">
                                               Lic. Vanessa Ayala Perea
                                            </h3>

                                            <hr>

                                            <p class="card-text">

                                                <strong>Contacto:</strong><br>

                                                Teléfono:
                                                 56160859<br>

                                                Ext.
                                                24065

                                            </p>


                                            <p class="card-text">

                                                <strong>Correo:</strong><br>

                                                <a href="mailto:vayala@atmosfera.unam.mx">
                                                    vayala@atmosfera.unam.mx
                                                </a>

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>        
                            
                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- DEPARTAMENTO DE PERSONAL -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-personal"
                        role="tabpanel"
                        aria-labelledby="nav-personal-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionPersonal"
                        >


                            <!-- JEFE DE DPTO RRHH -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPersonal"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePersonal"
                                        aria-expanded="false"
                                        aria-controls="collapsePersonal"
                                    >
                                        Jefa del Departamento de Recursos Humanos
                                    </button>

                                </h2>


                                <div
                                    id="collapsePersonal"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPersonal"
                                    data-bs-parent="#accordionPersonal"
                                >

                                    <div class="accordion-body">

										<div class="d-grid gap-4">
											<!-- CARD 1 -->
											<div class="card shadow-sm">
												<div class="row g-0">
													<div class="col-md-4">
													<?php
														$imgDptoRH = __DIR__ . '/img/j_personal.jpg';

														if (file_exists($imgDptoRH)) {
															$imgDptoRH = 'img/j_personal.jpg';
														} else {
															$imgDptoRH = BASE_URL . 'assets/img/avatar.png';
														}
														?>
														<img
															src="<?= $imgDptoRH ?>"
															class="img-fluid rounded-start
																   w-100 h-100 object-fit-cover"
															alt="J Personal"
														>
													</div>
													<div class="col-md-8">
														<div class="card-body">
															<h3 class="card-title text-center">
															   Lic. Rocío de los Ángeles Sandoval González
															</h3>
															<hr>
															<p class="card-text">
																<strong>Contacto:</strong><br>                                             
																Ext. 4544765
															</p>
															<p class="card-text">
																<strong>Correo:</strong><br>
																<a href="mailto:dpersonal@atmosfera.unam.mx">
																	dpersonal@atmosfera.unam.mx
																</a>
															</p>
														</div>

													</div>
												</div>
											</div>                                   
										</div>                                          
                                    </div>
                                </div>
                            </div>

							<!-- Catalogo de servicios-->
							<div class="accordion-item">

								<h2
									class="accordion-header"
									id="headingCatoalogo"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseCatalogo"
										aria-expanded="false"
										aria-controls="collapseCatalogo"
									>
										Cat&aacute;logo de servicios. Procesos de Personal
									</button>

								</h2>


								<div
									id="collapseCatalogo"
									class="accordion-collapse collapse"
									aria-labelledby="headingCatoalogo"
									data-bs-parent="#accordionPersonal"
								>

									<div class="accordion-body">

										<p class="text-end">
											<strong>OBJETIVO DEL CATÁLOGO</strong>
										</p>

										<p>
											Dar a conocer los servicios que proporciona la Secretaría Administrativa, a través del proceso 
											de <b>Personal</b>. Este catálogo precisa quiénes son los usuarios y los requisitos que deben cubrir 
											para que se les brinde el servicio; indica también cuándo y qué se entregará como servicio.
										</p>
										<p>
											El proceso de Personal orienta, atiende y gestiona ante las diferentes instancias, los asuntos 
											laborales del personal, verifica que los servicios solicitados se proporcionen en apego a la 
											normatividad aplicable, a fin de satisfacer las necesidades de los usuarios y contribuir al 
											cumplimiento de las funciones sustantivas del <i>Instituto de Ciencias de la Atmósfera y 
											Cambio Climático</i>, en la perspectiva de una mejora continua.
										</p>
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2024/09/CS-01-Catalogo-de-servicios-ICAyCC-Personal-R05-2024-09-09.pdf"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											Cat&Aacute;logo Servicios Personal
										</a>
									</div>

								</div>

							</div>
							
							<!-- BECAS DE LINCECIATURA -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingBecaslic"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseBecaslic"
                                        aria-expanded="false"
                                        aria-controls="collapseBecaslic"
                                    >
                                        Becas de Licenciatura
                                    </button>

                                </h2>


                                <div
                                    id="collapseBecaslic"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingBecaslic"
                                    data-bs-parent="#accordionPersonal"
                                >

                                    <div class="accordion-body">

                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2023/02/Solicitud-beca-Licenciatura-ICAyCC-240223.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                FORMATO DE SOLICITUD
                                            </a>


                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/04/Carta-Compromiso-Licenciatura.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                CARTA COMPROMISO
                                            </a>
											<a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/09/1a-Reglas-Operacion-Licenciatura-ICAyCC-2022revACR.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                REGLAS DE OPERACI&Oacute;N
                                            </a>
										</div>

                                    </div>

                                </div>

                            </div>

							<!-- APOYO ESPECIAL FONDO IE -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingApoyoEsp"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseApoyoEsp"
                                        aria-expanded="false"
                                        aria-controls="collapseApoyoEsp"
                                    >
                                        Apoyo especial del Fondo IE ICAyCC para titulaci&oacute;n u obtenci&oacute;n del grado
                                    </button>

                                </h2>


                                <div
                                    id="collapseApoyoEsp"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingApoyoEsp"
                                    data-bs-parent="#accordionPersonal"
                                >

                                    <div class="accordion-body">
										<p>El apoyo a estudiantes mediante un Fondo especial proveniente 
										de ingresos extraordinarios del Instituto de Ciencias de la Atmósfera 
										y Cambio Climático tiene por objeto impulsar al estudiante para la 
										obtención del título de licenciatura o grado de maestría o 
										doctorado durante la etapa final.</p>
										
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2024/06/Solicitud-Beca-Fondo-Especial-10062024.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                FORMATO DE SOLICITUD
                                            </a>


                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/04/Formato_carta_compromiso-fondo-especial.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                CARTA COMPROMISO
                                            </a>
											<a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/09/2a-Reglas-operacion-Fondo-especial-IE-ICAyCC-2022revACR.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                REGLAS DE OPERACI&Oacute;N
                                            </a>
										</div>

                                    </div>

                                </div>

                            </div>

							<!-- HONORARIOS -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingHonorarios"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseHonorarios"
                                        aria-expanded="false"
                                        aria-controls="collapseHonorarios"
                                    >
                                       Honorarios y Asimilados a Salarios
                                    </button>

                                </h2>


                                <div
                                    id="collapseHonorarios"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingHonorarios"
                                    data-bs-parent="#accordionPersonal"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2026/06/servicios-profesionales-ICAyCC-MG-rev.doc"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR FORMATO HONORARIOS
                                            </a>


                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2026/06/Salarios-asimilados-ICAyCC-MG-rev.doc"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                 DESCARGAR FORMATO ASIMILADO A SALARIOS
                                            </a>


                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/ejemplo_pagos_hon-asim.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                EJEMPLO PARA PAGO DE HONORARIOS Y ASIMILADOS A SALARIOS
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

							<!-- LICENCIA CON GOCE DE SUELDO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingDefinitividadLCS"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseDefinitividadLCS"
                                        aria-expanded="false"
                                        aria-controls="collapseDefinitividadLCS"
                                    >
                                        Licencia con goce de sueldo
                                    </button>

                                </h2>


                                <div
                                    id="collapseDefinitividadLCS"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingDefinitividadLCS"
                                    data-bs-parent="#accordionPersonal"
                                >

                                    <div class="accordion-body">

                                        <p class="text-end">
                                            <strong>EPA, Arts. 97 b) y c); 98 b) y 100</strong>
                                        </p>

                                        <p>
                                            Para asistir a eventos académicos y reuniones culturales, 
											así como para impartir conferencias o cursos en otras instituciones. 
											No podrán exceder de 45 días en un año.
                                        </p>
										<p><strong>Requisitos:</strong></p>
										<ol>
											<li>Se llena el formato con los datos del académico solicitante y se anexa la documentación requerida.</li>
											<li>Se entrega en la Dirección (por lo menos 25 días hábiles antes del evento).</li>
											<li>Se entrega en la Secretaria Administrativa copia del expediente con el acuse de recibido de la Dirección.</li>
											<li>Se pone a consideración del Consejo Consultivo Interno y del Consejo Técnico de la Investigación Científica (Ver calendario de reuniones).</li>
										</ol>
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2026/01/Licencia-Comisio%CC%81n-ICAyCC-MG.docx"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
											
                                    </div>

                                </div>

                            </div>
						
							<!-- TRABAJO DE CAMPO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingTrabajoCampo"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseTrabajoCampo"
                                        aria-expanded="false"
                                        aria-controls="collapseTrabajoCampo"
                                    >
                                        Trabajo de campo (personal académico)
                                    </button>

                                </h2>


                                <div
                                    id="collapseTrabajoCampo"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingTrabajoCampo"
                                    data-bs-parent="#accordionPersonal"
                                >

                                    <div class="accordion-body">

                                        <p>
                                            Para realizar actividades fuera de
                                            las instalaciones del Instituto,
                                            dentro de un proyecto de investigación.
                                        </p>

                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2026/01/Trabajo-de-Campo-ICAyCC-MG.doc"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR FORMATO
                                            </a>


                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2023/02/CA1123-FormatoDesignacionBenef1.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                SEGURO DE VIDA
                                            </a>
										</div>
											<p>Información para la cobertura del seguro de viaje por comisión oficial</p>
                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2023/02/informacion-para-la-cobertura-del-seguro-de-viaje-por-comision-oficial.docx"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR FORMATO
                                            </a>
											<p>Solicitud de Autorización para Salida de Campo en contingencia COVID-19</p>
                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/08/Salida-de-Campo-COVID-ICAYCC.docx"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR FORMATO
                                            </a><p>Procedimiento para la solicitud de trabajo de campo</p>
                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/02/ProcedimientoSolicitudTrabajoCampo.docx"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR FORMATO
                                            </a>

                                        

                                    </div>

                                </div>

                            </div>

							<!--Dia economico -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingDiaeco"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseDiaeco"
                                        aria-expanded="false"
                                        aria-controls="collapseDiaeco"
                                    >
                                      Formato d&iacute;a econ&oacute;mico y vacaci&oacute;n adicional
                                    </button>

                                </h2>


                                <div
                                    id="collapseDiaeco"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingDiaeco"
                                    data-bs-parent="#accordionPersonal"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2024/04/FORMATO-ADICIONALES_ICAyCC.xlsm"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR FORMATO
                                            </a>
                                 
                                        </div>

                                    </div>

                                </div>

                            </div>
							<!--PRACTICAS DE CAMPO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPracticas"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePracticas"
                                        aria-expanded="false"
                                        aria-controls="collapsePracticas"
                                    >
                                      Prácticas de campo (estudiantes)
                                    </button>

                                </h2>


                                <div
                                    id="collapsePracticas"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPracticas"
                                    data-bs-parent="#accordionPersonal"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/09/formato_dgpu_practicas_de_campo.xls"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR FORMATO
                                            </a>
                                 
                                        </div>

                                    </div>

                                </div>

                            </div>

                       </div>
                    </div>


                    <!-- ================================= -->
                    <!-- DEPARTAMENTO DE PRESUPUESTO -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Presupuesto"
                        role="tabpanel"
                        aria-labelledby="nav-Presupuesto-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionPresupuesto"
                        >

							<!-- JEFE DE DPTO PRESUPUESTO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPersonal"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePresupuesto"
                                        aria-expanded="false"
                                        aria-controls="collapsePresupuesto"
                                    >
                                        Jefe del Departamento de Presupuesto
                                    </button>

                                </h2>


                                <div
                                    id="collapsePresupuesto"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPersonal"
                                    data-bs-parent="#accordionPresupuesto"
                                >

                                    <div class="accordion-body">

										<div class="d-grid gap-4">
											<!-- CARD 1 -->
											<div class="card shadow-sm">
												<div class="row g-0">
													<div class="col-md-4">
													<?php
														$imgDptoPresupuesto = __DIR__ . '/img/j_presupuesto.jpg';

														if (file_exists($imgDptoPresupuesto)) {
															$imgDptoPresupuesto = 'img/j_presupuesto.jpg';
														} else {
															$imgDptoPresupuesto = BASE_URL . 'assets/img/avatar.png';
														}
														?>
														<img
															src="<?= $imgDptoPresupuesto ?>"
															class="img-fluid rounded-start
																   w-100 h-100 object-fit-cover"
															alt="J Personal"
														>
													</div>
													<div class="col-md-8">
														<div class="card-body">
															<h3 class="card-title text-center">
															   Lic. Mario Curiel Fonseca
															</h3>
															<hr>
															<p class="card-text">
																<strong>Contacto:</strong><br>                                             
																Teléfono: 5622 4800 o 56224240 ext. 81989
															</p>
															<p class="card-text">
																<strong>Correo:</strong><br>
																<a href="mailto:mcuriel@atmosfera.unam.mx">
																	mcuriel@atmosfera.unam.mx
																</a>
															</p>
														</div>

													</div>
												</div>
											</div>                                   
										</div>                                          
                                    </div>
                                </div>
                            </div>

							<!-- Catalogo de servicios-->
							<div class="accordion-item">

								<h2
									class="accordion-header"
									id="headingCatoalogoPP"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseCatalogoPP"
										aria-expanded="false"
										aria-controls="collapseCatalogoPP"
									>
										Cat&aacute;logo de servicios. Procesos de Presupuesto
									</button>

								</h2>


								<div
									id="collapseCatalogoPP"
									class="accordion-collapse collapse"
									aria-labelledby="headingCatoalogoPP"
									data-bs-parent="#accordionPresupuesto"
								>

									<div class="accordion-body">

										<p class="text-end">
											<strong>OBJETIVO DEL CATÁLOGO</strong>
										</p>

										<p>
											Dar a conocer los servicios que proporciona la Secretaría Administrativa, a través del proceso 
											de <b>Presupuesto</b>. Este catálogo precisa quiénes son los usuarios y los requisitos que deben cubrir 
											para que se les brinde el servicio; indica también cuándo y qué se entregará como servicio.
										</p>
										<p>
											El proceso de Presupuesto realiza las actividades de registro, control, ejercicio y conciliación
											de los recursos presupuestales, gestiona y verifica que los servicios solicitados se 
											proporcionen en apego a la normatividad aplicable, a fin de satisfacer las necesidades de los 
											usuarios y contribuir al cumplimiento de las funciones sustantivas del <b>Instituto de Ciencias
											de la Atmósfera y Cambio Climático</b>, en la perspectiva de una mejora continua.
										</p>
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2024/09/CS-02-Catalogo-de-Servicios-ICAyCC-Presupuesto-R04_2024-09-09.pdf"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											Cat&Aacute;logo Servicios ICAyCC – Presupuesto
										</a>
									</div>

								</div>

							</div>
							
							<!-- CSF-->
							<div class="accordion-item">

								<h2
									class="accordion-header"
									id="headingCSF"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseCSF"
										aria-expanded="false"
										aria-controls="collapseCSF"
									>
										Constancia de Situaci&oacute;n Fiscal
									</button>

								</h2>


								<div
									id="collapseCSF"
									class="accordion-collapse collapse"
									aria-labelledby="headingCSF"
									data-bs-parent="#accordionPresupuesto"
								>

									<div class="accordion-body">

										<p class="text-end">
											<strong>OBJETIVO DEL CATÁLOGO</strong>
										</p>

										<p>
											Dar a conocer los servicios que proporciona la Secretaría Administrativa, a través del proceso 
											de <b>Presupuesto</b>. Este catálogo precisa quiénes son los usuarios y los requisitos que deben cubrir 
											para que se les brinde el servicio; indica también cuándo y qué se entregará como servicio.
										</p>
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2025/09/Constancia-Situacio%CC%81n-Fiscal-UNAM-15-08-2025.pdf"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR CSF
										</a>
									</div>

								</div>

							</div>



                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- BIENES Y SUMINISTROS -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Bienes"
                        role="tabpanel"
                        aria-labelledby="nav-Bienes-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionBienes"
                        >
							<!-- JEFE DEL DPTO. ADQ-->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingAdq"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseAdq"
                                        aria-expanded="false"
                                        aria-controls="collapseAdq"
                                    >
                                        Jefe del Departamento de adquisiciones
                                    </button>

                                </h2>


                                <div
                                    id="collapseAdq"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingAdq"
                                    data-bs-parent="#accordionBienes"
                                >

                                    <div class="accordion-body">

                                       <p><strong> Luis Manuel González Coronado</strong></p>
									   <p>		Ext.: 45431<br>Email: luism@atmosfera.unam.mx</p>

                                    </div>

                                </div>

                            </div>
							
							<!-- Catalogo de servicios-->
							<div class="accordion-item">

								<h2
									class="accordion-header"
									id="headingCatoalogoBS"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseCatalogoBS"
										aria-expanded="false"
										aria-controls="collapseCatalogoBS"
									>
										Cat&aacute;logo de servicios. Procesos de Bienes y Suministros
									</button>

								</h2>


								<div
									id="collapseCatalogoBS"
									class="accordion-collapse collapse"
									aria-labelledby="headingCatoalogoBS"
									data-bs-parent="#accordionBienes"
								>

									<div class="accordion-body">

										<p class="text-end">
											<strong>OBJETIVO DEL CATÁLOGO</strong>
										</p>

										<p>
											Dar a conocer los servicios que proporciona la Secretaría Administrativa, a través del proceso 
											de <b>Bienes y suministros</b>. Este catálogo precisa quiénes son los usuarios y los requisitos que deben cubrir 
											para que se les brinde el servicio; indica también cuándo y qué se entregará como servicio.
										</p>
										<p>
											El proceso de Bienes y suministros administra la adquisición, suministro y resguardo de los
											bienes e insumos y verifica que los servicios solicitados se proporcionen en apego a la
											normatividad aplicable, a fin de satisfacer las necesidades de los usuarios, para contribuir al
											cumplimiento de las funciones sustantivas del <i>Instituto de Ciencias de la Atmósfera y 
											Cambio Climático</i>, en la perspectiva de una mejora continua.
										</p>
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2024/09/CS-03-Catalogo-de-Servicios-ICAyCC-Bienes-y-Suministros-R02_2024-09-09.pdf"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											Cat&Aacute;logo Bienes y Suministros  ICAyCC
										</a>
									</div>

								</div>

							</div>

							<!-- SOLICITUD INTERNA DE COMPRA-->
							<div class="accordion-item">
								<h2
									class="accordion-header"
									id="headingSIC"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseSIC"
										aria-expanded="false"
										aria-controls="collapseSIC"
									>
										Solicitud Interna de Compra
									</button>

								</h2>
								<div
									id="collapseSIC"
									class="accordion-collapse collapse"
									aria-labelledby="headingSIC"
									data-bs-parent="#accordionBienes"
								>
									<div class="accordion-body">										
										<p>Formato por medio del cual las diferentes áreas del Centro de Ciencias de la Atmósfera pueden 
										solicitar materiales o equipos con características específicas al área de Bienes y Suministros, 
										con la finalidad de realizar la compra de los mismos.
										</p>
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2018/02/SOLICITUD-INTERNA-DE-COMPRA-7.xlsm"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
									</div>
								</div>
							</div>

							<!-- VALE DE SALIDA ALAMCEN-->
							<div class="accordion-item">
								<h2
									class="accordion-header"
									id="headingVale"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseVale"
										aria-expanded="false"
										aria-controls="collapseVale"
									>
										Vale de salida del almac&eacute;n
									</button>	

								</h2>
								<div
									id="collapseVale"
									class="accordion-collapse collapse"
									aria-labelledby="headingVale"
									data-bs-parent="#accordionBienes"
								>
									<div class="accordion-body">										
										<p>Formato destinado para solicitar bienes de uso recurrente que se encuentran en el almacén.</p>
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2021/12/F01-PBS-0201-Vale-de-salida-de-almac%C3%A9n.xls"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
									</div>
								</div>
							</div>


							<!-- BAJA DE BIENES INVENTARIABLES-->
							<div class="accordion-item">
								<h2
									class="accordion-header"
									id="headingBajaBienes"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseBajaBienes"
										aria-expanded="false"
										aria-controls="collapseBajaBienes"
									>
										Baja de Bienes Inventariables
									</button>
								</h2>
								<div
									id="collapseBajaBienes"
									class="accordion-collapse collapse"
									aria-labelledby="headingBajaBienes"
									data-bs-parent="#accordionBienes"
								>
									<div class="accordion-body">										
										<p>Se utiliza para solicitar la baja de bienes asignados a las diversas áreas, así como también
											para solicitar reasignación de los mismos cuando éstos han cambiado de responsable.
										</p>
										<p>Solicitud de baja o actualización de bienes inventariables.</p>
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2025/09/F01-PBS-0302-Solicitud-de-baja-o-actualizacio%CC%81n-de-bienes-inventariables.xlsx"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
									</div>
								</div>
							</div>

							<!-- SOLICITUD DE ABASTECIMIENTO-->
							<div class="accordion-item">
								<h2
									class="accordion-header"
									id="headingAbastecimiento"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseAbastecimiento"
										aria-expanded="false"
										aria-controls="collapseAbastecimiento"
									>
										Solicitud de Abastecimiento
									</button>
								</h2>
								<div
									id="collapseAbastecimiento"
									class="accordion-collapse collapse"
									aria-labelledby="headingAbastecimiento"
									data-bs-parent="#accordionBienes"
								>
									<div class="accordion-body">																			
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2018/02/ABASTECIMIENTO-4.xlsm"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
									</div>
								</div>
							</div>
	
							<!-- SIC contrato compra-venta-->
							<div class="accordion-item">
								<h2
									class="accordion-header"
									id="headingSIC"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseSIC"
										aria-expanded="false"
										aria-controls="collapseSIC"
									>
										SIC contrato compra-venta
									</button>
								</h2>
								<div
									id="collapseSIC"
									class="accordion-collapse collapse"
									aria-labelledby="headingSIC"
									data-bs-parent="#accordionBienes"
								>
									<div class="accordion-body">																			
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2018/02/ABASTECIMIENTO-4.xlsm"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
									</div>
								</div>
							</div>
							
							<!-- Carta Adjudicacion directa por excepcion -->
							<div class="accordion-item">
								<h2
									class="accordion-header"
									id="headingAdjudicacion"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseAdjudicacion"
										aria-expanded="false"
										aria-controls="collapseAdjudicacion"
									>
										Carta adjudicacion directa por excepci&oacute;n 
									</button>
								</h2>
								<div
									id="collapseAdjudicacion"
									class="accordion-collapse collapse"
									aria-labelledby="headingAdjudicacion"
									data-bs-parent="#accordionBienes"
								>
									<div class="accordion-body">																			
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2024/01/carta-de-inexistencia.pdf"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
									</div>
								</div>
							</div>
						</div>	
						
				   </div>


                    <!-- ================================= -->
                    <!-- SERVICIOS GENERALES -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Generales"
                        role="tabpanel"
                        aria-labelledby="nav-Generales-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionGenerales"
                        >
							<!-- Solicitud de Servicio -->
							<div class="accordion-item">
								<h2
									class="accordion-header"
									id="headingSolicitudUnicaServicio"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseSUS"
										aria-expanded="false"
										aria-controls="collapseSUS"
									>
										Solicitud &uacute;nica de servicio
									</button>
								</h2>
								<div
									id="collapseSUS"
									class="accordion-collapse collapse"
									aria-labelledby="headingSolicitudUnicaServicio"
									data-bs-parent="#accordionGenerales"
								>
									<div class="accordion-body">																			
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2021/12/F01-PSG-0101-Solicitud-%C3%BAnica-de-servicios.xls"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
									</div>
								</div>
							</div>

							
							<!-- Catalogo de servicios procesos generales-->
							<div class="accordion-item">

								<h2
									class="accordion-header"
									id="headingCatoalogoSG"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseCatalogoSG"
										aria-expanded="false"
										aria-controls="collapseCatalogoSG"
									>
										Cat&aacute;logo de servicios. Procesos de servicios generales
									</button>

								</h2>


								<div
									id="collapseCatalogoSG"
									class="accordion-collapse collapse"
									aria-labelledby="headingCatoalogoSG"
									data-bs-parent="#accordionGenerales"
								>

									<div class="accordion-body">

										<p class="text-end">
											<strong>OBJETIVO DEL CATÁLOGO</strong>
										</p>

										<p>
											Dar a conocer los servicios que proporcionan la secretaría administrativa, a través del
											proceso de <b>Servicios generales</b>. Este catálogo precisa quiénes son los usuarios y qué
											requisitos deben cumplir para que se les brinde el servicio, indica también cuándo y qué se
											entregará como servicio.
										</p>
										<p>
											l proceso de Servicios generales, proporciona mantenimiento a la infraestructura y
											equipamiento de las entidades y dependencias, mediante el cumplimiento de los programas
											anuales establecidos, así como atender las solicitudes de diversos servicios que presenten
											los usuarios, en apego a la normatividad vigente, con el fin de optimizar los recursos para
											otorgar un servicio satisfactorio, para contribuir al cumplimiento de las funciones sustantivas
											del <b>Instituto de Ciencias de la Atmósfera y Cambio Climático</b>, en la perspectiva de una mejora continua.
										</p>
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2024/09/CS-04-Catalogo-de-Servicios-ICAyCC-Servs-Grales-R03_2024-09-09.pdf"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											Cat&Aacute;logo Servicios Generales ICAyCC
										</a>
									</div>

								</div>

							</div>

							<!-- Vale de entrada -->
							<div class="accordion-item">
								<h2
									class="accordion-header"
									id="headingValeEntradaSalida"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseVES"
										aria-expanded="false"
										aria-controls="collapseVES"
									>
										Vale de entrada y salida  de equipo y mobiliario
									</button>
								</h2>
								<div
									id="collapseVES"
									class="accordion-collapse collapse"
									aria-labelledby="headingValeEntradaSalida"
									data-bs-parent="#accordionGenerales"
								>
									<div class="accordion-body">																			
										<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2021/12/F01-PSG-0101-Solicitud-%C3%BAnica-de-servicios.xls"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
									</div>
								</div>
							</div>

                        </div>

                    </div>


                    
                   
                  
                    <!-- ================================= -->
                    <!-- FUNDANET -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Fundanet"
                        role="tabpanel"
                        aria-labelledby="nav-Fundanet-tab"
                        tabindex="0"
                    >

                        <div class="d-grid gap-4">
                            <!-- CARD 1 -->
                            <div class="card shadow-sm">
                                <div class="row g-0">
									<a href="https://academicosinforme.atmosfera.unam.mx:4431/IFundanet/"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											Sistema de Gesti&oacute;n Curricular
									</a>
                                </div>
                            </div>                                    
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>

</div>


<?php require_once ROOT_PATH . '/includes/footer.php'; ?>