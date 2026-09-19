<?php
require_once __DIR__ . '/../config/config.php';
?>

<div class="container py-5">

    <h1 class="mb-4">
        Secretar&iacute;a Acad&eacute;mica
    </h1>

    <div class="row g-4">

        <!-- DESCRIPCIÓN -->
        <div class="col-12 col-md-6">

            <div class="card shadow-sm h-100">

                <div class="card-body" id="mision">

                    <p>
                        La <b>Secretaría Académica</b> atiende asuntos
                        académico-administrativos del personal académico del
                        Instituto de Ciencias de la Atmósfera y Cambio Climático,
                        tales como contratos, concursos y promociones, además de
                        gestionar ante las instancias correspondientes
                        (Consejo Técnico de la Investigación Científica y
                        Dirección General de Asuntos del Personal Académico)
                        lo relacionado con el ejercicio de los derechos y
                        obligaciones de los académicos estipulados en el
                        Estatuto del Personal Académico.
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
                        src="img/academica.jpg"
                        class="img-fluid"
                        alt="Secretaría Académica"
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
                        SECRETARIA ACAD&Eacute;MICA
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Tramites-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Tramites"
                        type="button"
                        role="tab"
                        aria-controls="nav-Tramites"
                        aria-selected="false"
                    >
                        TR&Aacute;MITES ACAD&Eacute;MICO-ADMINISTRATIVOS
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Estimulos-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Estimulos"
                        type="button"
                        role="tab"
                        aria-controls="nav-Estimulos"
                        aria-selected="false"
                    >
                        EST&Iacute;MULOS, BECAS Y APOYOS
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Convocatorias-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Convocatorias"
                        type="button"
                        role="tab"
                        aria-controls="nav-Convocatorias"
                        aria-selected="false"
                    >
                        CONVOCATORIAS
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Normatividad-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Normatividad"
                        type="button"
                        role="tab"
                        aria-controls="nav-Normatividad"
                        aria-selected="false"
                    >
                        NORMATIVIDAD
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Colegiados-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Colegiados"
                        type="button"
                        role="tab"
                        aria-controls="nav-Colegiados"
                        aria-selected="false"
                    >
                        CUERPOS COLEGIADOS
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-SISA-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-SISA"
                        type="button"
                        role="tab"
                        aria-controls="nav-SISA"
                        aria-selected="false"
                    >
                        SISTEMA DE INFORMACI&Oacute;N Y
                        SEGUIMIENTO ACAD&Eacute;MICO (SISA)
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-SEEA-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-SEEA"
                        type="button"
                        role="tab"
                        aria-controls="nav-SEEA"
                        aria-selected="false"
                    >
                        SISTEMA DE ESTUDIANTES Y ESTANCIAS
                        ACAD&Eacute;MICAS (SEEA)
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-TA-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-TA"
                        type="button"
                        role="tab"
                        aria-controls="nav-TA"
                        aria-selected="false"
                    >
                        TR&Aacute;MITES ESTUDIANTES
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
                    <!-- SECRETARÍA ACADÉMICA -->
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
											$imagenSecretaria = __DIR__ . '/img/secretaria_aca.jpg';

											if (file_exists($imagenSecretaria)) {
												$imagenSecretaria = 'img/secretaria_aca.jpg';
											} else {
												$imagenSecretaria = BASE_URL . 'assets/img/avatar.png';
											}
											?>

											<img 
												src="<?= $imagenSecretaria ?>" 
												class="img-fluid rounded-start w-100 h-100 object-fit-cover" 
												alt="Secretaría Académica"
											>

                                    </div>


                                    <div class="col-md-8">

                                        <div class="card-body">

                                            <h3 class="card-title text-center">
                                                Dra. Dara Salcedo
                                            </h3>

                                            <hr>

                                            <p class="card-text">

                                                <strong>Contacto:</strong><br>

                                                Teléfono:
                                                (55) 5622 4059<br>

                                                Fax:
                                                (52) (55) 5622 5009

                                            </p>


                                            <p class="card-text">

                                                <strong>Correo:</strong><br>

                                                <a href="mailto:secretaria_academica@atmosfera.unam.mx">
                                                    secretaria_academica@atmosfera.unam.mx
                                                </a>

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- CARD 2 -->
                            <div class="card shadow-sm">

                                <div class="row g-0">

                                    <div class="col-md-4">
									<?php
											$imagenAsistenteSecretaria = __DIR__ . '/img/secretaria_asi_aca.jpg';

											if (file_exists($imagenSecretaria)) {
												$imagenAsistenteSecretaria = 'img/secretaria_asi_aca.jpg';
											} else {
												$imagenAsistenteSecretaria = BASE_URL . 'assets/img/avatar.png';
											}
											?>

                                        <img
                                            src="<?= $imagenAsistenteSecretaria ?>"
                                            class="img-fluid rounded-start
                                                   w-100 h-100 object-fit-cover"
                                            alt="Asistente de la Secretaría Académica"
                                        >

                                    </div>


                                    <div class="col-md-8">

                                        <div class="card-body">

                                            <h3 class="card-title text-center">
                                                Asistente
                                            </h3>

                                            <hr>

                                            <p class="card-text">

                                                <strong>
                                                    Mtra. Erika Martínez Salgado
                                                </strong><br>

                                                Ext.: 24063

                                            </p>


                                            <p class="card-text">

                                                <strong>Correo:</strong><br>

                                                <a href="mailto:ejecutiva_academica@atmosfera.unam.mx">
                                                    ejecutiva_academica@atmosfera.unam.mx
                                                </a>

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- TRÁMITES ACADÉMICO-ADMINISTRATIVOS -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Tramites"
                        role="tabpanel"
                        aria-labelledby="nav-Tramites-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionTramites"
                        >


                            <!-- RENOVACIÓN DE CONTRATO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingRenovacion"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseRenovacion"
                                        aria-expanded="false"
                                        aria-controls="collapseRenovacion"
                                    >
                                        Renovación de Contrato
                                    </button>

                                </h2>


                                <div
                                    id="collapseRenovacion"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingRenovacion"
                                    data-bs-parent="#accordionTramites"
                                >

                                    <div class="accordion-body">

                                        <p>
                                            <strong>
                                                CONTRATO PARA OBRA DETERMINADA
                                                Y RENOVACIONES
                                            </strong>
                                        </p>

                                        <p class="text-end">
                                            <strong>EPA, Art. 51</strong>
                                        </p>

                                        <p>
                                            <strong>Requisitos:</strong>
                                        </p>

                                        <ul>

                                            <li>
                                                Carta de apoyo del Departamento
                                                de adscripción
                                            </li>

                                            <li>
                                                Carta de apoyo del responsable
                                                del grupo al que pertenece
                                                (señalando el objeto del
                                                contrato y precisando productos)
                                            </li>

                                            <li>
                                                Carta de argumentos académicos
                                                [incluir las líneas de
                                                investigación (investigadores)
                                                o actividades de apoyo técnico
                                                (técnicos académicos),
                                                producción científica,
                                                formación de recursos humanos,
                                                docencia, difusión y divulgación
                                                de la ciencia, proyecto(s) y
                                                participación institucional]
                                            </li>

                                            <li>
                                                Programa e informe de actividades
                                                (avalados para el caso de
                                                técnicos académicos)
                                            </li>

                                            <li>
                                                <em>Curriculum vitae</em>
                                                (con fecha de nacimiento y
                                                hojas numeradas)
                                            </li>

                                            <li>
                                                Constancia del último grado
                                                obtenido
                                            </li>

                                            <li>
                                                Probatorios (archivos electrónicos
                                                en una memoria USB o CD)
                                            </li>

                                        </ul>


                                        <hr>


                                        <p>
                                            <strong>
                                                CONTRATO BAJO CONDICIONES
                                                SIMILARES AL ANTERIOR
                                            </strong>
                                        </p>

                                        <p class="text-end">
                                            <strong>EPA, Art. 14</strong>
                                        </p>

                                        <p>
                                            Corresponde a los contratos
                                            subsecuentes al Concurso de
                                            Oposición Abierto.
                                        </p>

                                        <p>
                                            <strong>Requisitos:</strong>
                                        </p>

                                        <ul>

                                            <li>
                                                Carta de apoyo del Departamento
                                                de adscripción
                                            </li>

                                            <li>
                                                Carta de apoyo del responsable
                                                del grupo al que pertenece
                                            </li>

                                            <li>
                                                Carta razonada del interesado
                                                [incluir las líneas de
                                                investigación (investigadores)
                                                o actividades de apoyo técnico
                                                (técnicos académicos),
                                                producción científica,
                                                formación de recursos humanos,
                                                docencia, difusión y divulgación
                                                de la ciencia, proyecto(s) y
                                                participación institucional]
                                            </li>

                                            <li>
                                                Informe de actividades
                                                (avalados para el caso de
                                                técnicos académicos)
                                            </li>

                                            <li>
                                                Programa de actividades
                                                (avalados para el caso de
                                                técnicos académicos)
                                            </li>

                                            <li>
                                                <em>Curriculum vitae</em>
                                                (con fecha de nacimiento y
                                                hojas numeradas)
                                            </li>

                                            <li>
                                                Probatorios de trabajos publicados
                                                (archivos electrónicos en una
                                                memoria USB o CD)
                                            </li>

                                        </ul>

                                    </div>

                                </div>

                            </div>


							<!-- PROMOCIÓN INVESTIGADOR -->
							<div class="accordion-item">

								<h2
									class="accordion-header"
									id="headingPromocionInvestigador"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapsePromocionInvestigador"
										aria-expanded="false"
										aria-controls="collapsePromocionInvestigador"
									>
										Promoción (Investigador)
									</button>

								</h2>


								<div
									id="collapsePromocionInvestigador"
									class="accordion-collapse collapse"
									aria-labelledby="headingPromocionInvestigador"
									data-bs-parent="#accordionTramites"
								>

									<div class="accordion-body">

										<p class="text-end">
											<strong>EPA, Arts. 66, 78 y 79</strong>
										</p>

										<p>
											Tendrán derecho a que se abra 
											un concurso de oposición para promoción:
										</p>
										<ol>
											<li>Los investigadores interinos o a contrato 
											que cumplan tres años de servicios ininterrumpidos, 
											con objeto de que se resuelva si es o no el caso de 
											promoverlos u otorgarles la definitividad en la categoría y nivel que tengan.</li>
											<li>Los investigadores definitivos que cumplan tres años de 
											servicios ininterrumpidos en una misma categoría y nivel, con objeto de que 
											se resuelva si procede su ascenso a otra categoría o nivel. </li>
										</ol>
										<p><strong>Requisitos:</strong></p>
										<ul>
											<li>Opinión del Director</li>
											<li>Carta de apoyo del Departamento de adscripción con semblanza del académico</li>
											<li>Carta de apoyo del responsable del grupo al que pertenece</li>
											<li>Carta razonada del interesado (incluir producción científica, formación de recursos humanos, docencia y número de citas)</li>
											<li>Informe de actividades (desde su promoción anterior a la fecha)</li>
											<li>Programa de actividades (a desarrollar en la categoría y nivel solicitados)</li>
											<li><i>Curriculum vitae</i> (con fecha de nacimiento y hojas numeradas)</li>
											<li>Probatorios (archivos electrónicos en una memoria USB o CD)</li>
										</ul>	
									</div>

								</div>

							</div>
							
							<!-- PROMOCIÓN TÉCNICO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPromocionTecnico"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePromocionTecnico"
                                        aria-expanded="false"
                                        aria-controls="collapsePromocionTecnico"
                                    >
                                        Promoción (Técnico académico)
                                    </button>

                                </h2>


                                <div
                                    id="collapsePromocionTecnico"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPromocionTecnico"
                                    data-bs-parent="#accordionTramites"
                                >

                                    <div class="accordion-body">

                                        <p class="text-end">
                                            <strong>EPA, Art. 19</strong>
                                        </p>

                                        <p>
                                            Los técnicos académicos al cumplir
                                            tres años de servicio ininterrumpido
                                            en una misma categoría y nivel,
                                            tendrán derecho a que se abra un
                                            concurso de oposición para promoción,
                                            con objeto de que se resuelva si es
                                            procedente otorgarles la definitividad
                                            o promoverlos.
                                        </p>
										<p><strong>Requisitos:</strong></p>
										<ul>
											<li>Opinión del Director</li>
											<li>Carta de apoyo del Departamento de adscripción</li>
											<li>Carta de apoyo del responsable del grupo al que pertenece</li>
											<li>Carta razonada del interesado</li>
											<li>Informe de actividades avalado (desde su promoción anterior a la fecha)</li>
											<li>Programa de actividades (a desarrollar en la categoría y nivel solicitados)</li>
											<li>Curriculum vitae (con fecha de nacimiento y hojas numeradas)</li>
											<li>Probatorios (archivos electrónicos en una memoria USB o CD)</li>
										</ul>	
                                    </div>

                                </div>

                            </div>

							<!-- DEFINITIVIDAD INVESTIGADOR -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingDefinitividadInvestigador"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseDefinitividadInvestigador"
                                        aria-expanded="false"
                                        aria-controls="collapseDefinitividadInvestigador"
                                    >
                                        Definitividad (Investigador)
                                    </button>

                                </h2>


                                <div
                                    id="collapseDefinitividadInvestigador"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingDefinitividadInvestigador"
                                    data-bs-parent="#accordionTramites"
                                >

                                    <div class="accordion-body">

                                       <p class="text-end">
											<strong>EPA, Arts. 66, 78 y 79</strong>
										</p>

										<p>
											Tendrán derecho a que se abra 
											un concurso de oposición para promoción:
										</p>
										<ol>
											<li>Los investigadores interinos o a contrato 
											que cumplan tres años de servicios ininterrumpidos, 
											con objeto de que se resuelva si es o no el caso de 
											promoverlos u otorgarles la definitividad en la categoría y nivel que tengan.</li>
											<li>Los investigadores definitivos que cumplan tres años de 
											servicios ininterrumpidos en una misma categoría y nivel, con objeto de que 
											se resuelva si procede su ascenso a otra categoría o nivel. </li>
										</ol>
										<p><strong>Requisitos:</strong></p>
										<ul>
											<li>Opinión del Director</li>
											<li>Carta de apoyo del Departamento de adscripción con semblanza del académico</li>
											<li>Carta de apoyo del responsable del grupo al que pertenece</li>
											<li>Carta razonada del interesado (incluir producción científica, 
											formación de recursos humanos, docencia y número de citas)</li>
											<li>Informe (de toda su trayectoria) y programa de actividades</li>
											<li><i>Curriculum vitae</i> (con fecha de nacimiento y hojas numeradas)</li>
											<li>Probatorios (archivos electrónicos en una memoria USB o CD)</li>
										</ul>	

                                    </div>

                                </div>

                            </div>
	
							<!-- DEFINITIVIDAD TÉCNICO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingDefinitividadTecnico"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseDefinitividadTecnico"
                                        aria-expanded="false"
                                        aria-controls="collapseDefinitividadTecnico"
                                    >
                                        Definitividad (Técnico académico)
                                    </button>

                                </h2>


                                <div
                                    id="collapseDefinitividadTecnico"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingDefinitividadTecnico"
                                    data-bs-parent="#accordionTramites"
                                >

                                    <div class="accordion-body">

                                        <p class="text-end">
                                            <strong>EPA, Art. 19</strong>
                                        </p>

                                        <p>
                                            Los técnicos académicos al cumplir
                                            tres años de servicio ininterrumpido
                                            en una misma categoría y nivel,
                                            tendrán derecho a que se abra un
                                            concurso de oposición para promoción,
                                            con objeto de que se resuelva si es
                                            procedente otorgarles la definitividad
                                            o promoverlos.
                                        </p>
										<p><strong>Requisitos:</strong></p>
										<ul>
											<li>Opinión del Director</li>
											<li>Carta de apoyo del Departamento de adscripción con semblanza del académico</li>
											<li>Carta de apoyo del responsable del grupo al que pertenece</li>
											<li>Carta razonada del interesado</li>
											<li>Informe y Programa de actividades avalados</li>
											<li><i>Curriculum vitae</i> (con fecha de nacimiento y hojas numeradas)</li>
											<li>Probatorios (archivos electrónicos en una memoria USB o CD)</li>
										</ul>

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
                                    data-bs-parent="#accordionTramites"
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
							
							<!-- LICENCIA SIN GOCE DE SUELDO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingDefinitividadLSS"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseDefinitividadLSS"
                                        aria-expanded="false"
                                        aria-controls="collapseDefinitividadLSS"
                                    >
                                        Licencia con goce de sueldo
                                    </button>

                                </h2>


                                <div
                                    id="collapseDefinitividadLSS"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingDefinitividadLSS"
                                    data-bs-parent="#accordionTramites"
                                >

                                    <div class="accordion-body">

                                        <p class="text-end">
                                            <strong>EPA, Arts. 97 d), e)  y g); 98 a) y 100</strong>
                                        </p>

                                        <p>
                                            Podrán concederse por enfermedad; 
											por haber sido designado o electo 
											para desempeñar un cargo público; p
											or desempeñar funciones administrativas 
											dentro de la propia UNAM que no le permitan 
											ejercer las docentes o de investigación; 
											y por motivos personales (en este caso, 
											la suma de los días no debe exceder de 15 durante un semestre o de 30 días durante un año).
                                        </p>
										<p><strong>Requisitos:</strong></p>
										<ul>
											<li>Carta del interesado dirigida al Director</li>	
										</ul>
											
                                    </div>

                                </div>

                            </div>
							
							<!-- COMISIÓN MENOR A 22 DÍAS -->
							<div class="accordion-item">

								<h2
									class="accordion-header"
									id="headingComision22"
								>

									<button
										class="accordion-button collapsed"
										type="button"
										data-bs-toggle="collapse"
										data-bs-target="#collapseComision22"
										aria-expanded="false"
										aria-controls="collapseComision22"
									>
										Comisión (menor a 22 días)
									</button>

								</h2>


								<div
									id="collapseComision22"
									class="accordion-collapse collapse"
									aria-labelledby="headingComision22"
									data-bs-parent="#accordionTramites"
								>

									<div class="accordion-body">

										<p class="text-end">
											<strong>
												EPA, Arts. 97 b) y c);
												98 b) y 100
											</strong>
										</p>

										<p>
											Para asistir a eventos académicos
											o realizar actividades en beneficio
											y de interés para la Dependencia.
											Por acuerdo del Consejo Consultivo
											Interno, al concluir la comisión
											autorizada se deberá presentar por
											escrito un informe de las actividades
											realizadas.
										</p>

										<p>
											<strong>Requisitos:</strong>
										</p>

										<ul>
											<li>Carta del interesado</li>
											<li> Carta(s) de la(s) institución(es) a donde va</li>
											<li>Formato</li>
										</ul>
											<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2026/01/Licencia-Comisio%CC%81n-ICAyCC-C_-22-D-MG.docx"
												target="_blank"
												rel="noopener noreferrer"
												class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
									</div>

								</div>

							</div>
							
							<!-- COMISIÓN A PARTIR DE 22 DÍAS -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingComisionM22"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseComisionM22"
                                        aria-expanded="false"
                                        aria-controls="collapseComisionM22"
                                    >
                                        Comisión (a partir de 22 días)
                                    </button>

                                </h2>


                                <div
                                    id="collapseComisionM22"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingComisionM22"
                                    data-bs-parent="#accordionTramites"
                                >

                                    <div class="accordion-body">

                                        <p class="text-end">
                                            <strong>EPA, Arts. 95 b) y 96)</strong>
                                        </p>

                                        <p>
                                            Para realizar estudios o investigaciones
											en otras instituciones nacionales o extranjeras, 
											siempre que éstos puedan contribuir al desarrollo
											de la docencia o de la investigación y llenen una
											necesidad de la Dependencia.<br>
											Por acuerdo del Consejo Consultivo Interno, 
											al concluir la comisión autorizada se deberá presentar 
											por escrito un informe de las actividades realizadas.
                                        </p>

                                        <p>
                                            <strong>Requisitos:</strong>
                                        </p>

                                        <ul>
                                            <li>Carta del interesado</li>                                           
                                            <li>Carta(s) de aceptación de la(s) institución(es) a donde va</li>
                                            <li>Programa de actividades (avalado para el caso de técnicos académicos)</li>
                                            <li>Para prórroga: Informe de actividades.</li>
                                            <li>Formato</li>
                                        </ul>
											<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2026/01/Licencia-Comisio%CC%81n-ICAyCC-C-a-partir-de-22-MG.docx"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR FORMATO
										</a>
                                    </div>

                                </div>

                            </div>
                           
							<!-- SABÁTICO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingSabatino"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseSabatino"
                                        aria-expanded="false"
                                        aria-controls="collapseSabatino"
                                    >
                                        Sabático
                                    </button>

                                </h2>


                                <div
                                    id="collapseSabatino"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingSabatino"
                                    data-bs-parent="#accordionTramites"
                                >

                                    <div class="accordion-body">

                                        <p class="text-end">
                                            <strong>EPA, Art. 58</strong>
                                        </p>

                                        <p>
                                            Por cada seis años de servicios
                                            ininterrumpidos, los investigadores
                                            ordinarios de tiempo completo
                                            gozarán de un año sabático, que
                                            consiste en separarse de sus labores
                                            durante un año, con goce de sueldo
                                            y sin pérdida de su antigüedad,
                                            para dedicarse al estudio y a la
                                            realización de actividades que les
                                            permitan superarse académicamente.
                                        </p>

                                        <p>
                                            Después del primer año sabático,
                                            los interesados podrán optar por
                                            disfrutar de un semestre sabático
                                            por cada tres años de servicios,
                                            o de un año por cada seis.
                                        </p>

                                        <p>
                                            <strong>Requisitos:</strong>
                                        </p>

                                        <ul>

                                            <li>
                                                Carta del interesado [con una
                                                breve semblanza del Investigador(es)
                                                anfitrión(es) y descripción
                                                académica de la Institución(es)]
                                            </li>

                                            <li>
                                                Dictamen de certificación de año
                                                sabático expedido por la Dirección
                                                General de Personal
                                            </li>

                                            <li>
                                                Carta de la(s) institución(es)
                                            </li>

                                            <li>
                                                Programa de actividades
                                            </li>

                                        </ul>


                                        <hr>


                                        <p>
                                            <strong>CON BECA DGAPA*</strong>
                                        </p>

                                        <p>
                                            Si al solicitar un año sabático o
                                            fracción del mismo el interesado
                                            presenta al Director de la Dependencia
                                            de su adscripción principal un Plan
                                            de Actividades que desarrollará
                                            durante ese intervalo y éstas son de
                                            especial interés para la Universidad,
                                            el Director con la aprobación del
                                            Consejo Técnico respectivo gestionará
                                            que el interesado reciba ayuda o
                                            estímulos para su proyecto.
                                        </p>

                                        <p>
                                            <strong>*Requisitos adicionales:</strong>
                                        </p>

                                        <ul>

                                            <li><em>Curriculum vitae</em></li>

                                            <li>
                                                <em>Curriculum vitae</em> de la
                                                persona con la que va a laborar
                                            </li>

                                            <li>
                                                Documento del subcomité de becas
                                                (formato de DGAPA)
                                            </li>

                                            <li>
                                                Fundamentación académica y resumen
                                                ejecutivo (formato de DGAPA)
                                            </li>

                                            <li>
                                                Solicitud del interesado
                                                (formato de DGAPA)
                                            </li>

                                            <li>
                                                Certificación de año sabático
                                                expedida por la Dirección General
                                                de Personal
                                            </li>

                                            <li>
                                                Constancias oficiales -idioma y
                                                otro(s) apoyo(s)-
                                            </li>

                                            <li>Acta de matrimonio</li>

                                            <li>
                                                Acta de nacimiento de hijos
                                                (si los hubiere)
                                            </li>

                                            <li>
                                                Copias del acta de nacimiento y
                                                del último grado obtenido
                                            </li>

                                        </ul>


                                        <hr>


                                        <p>
                                            <strong>
                                                INFORME DE PERIODO SABÁTICO
                                            </strong>
                                        </p>

                                        <p class="text-end">
                                            <strong>EPA, Art. 58 h)</strong>
                                        </p>

                                        <p>
                                            Al reintegrarse a la Universidad
                                            el interesado entregará al Director
                                            un informe de sus actividades.
                                        </p>

                                        <ul>

                                            <li>Carta del interesado</li>

                                            <li>Informe de actividades</li>

                                        </ul>


                                        <hr>


                                        <p>
                                            <strong>
                                                DIFERICIÓN DE AÑO O SEMESTRE
                                                SABÁTICO
                                            </strong>
                                        </p>

                                        <p class="text-end">
                                            <strong>EPA, Art. 58 d)</strong>
                                        </p>

                                        <p>
                                            A Petición de los interesados,
                                            podrá diferirse el disfrute del año
                                            sabático por no más de dos años.
                                            Los profesores o investigadores
                                            designados funcionarios académicos
                                            y los que desempeñen un cargo de
                                            supervisión o coordinación en alguna
                                            dependencia, deberán diferir el
                                            disfrute del año sabático hasta el
                                            momento en que dejen el cargo.
                                        </p>

                                        <ul>

                                            <li>Carta del interesado</li>

                                        </ul>

                                    </div>

                                </div>

                            </div>
                                                   

                            <!-- INTERCAMBIO NACIONAL -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingIntercambioNacional"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseIntercambioNacional"
                                        aria-expanded="false"
                                        aria-controls="collapseIntercambioNacional"
                                    >
                                        Intercambio académico nacional
                                    </button>

                                </h2>


                                <div
                                    id="collapseIntercambioNacional"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingIntercambioNacional"
                                    data-bs-parent="#accordionTramites"
                                >

                                    <div class="accordion-body">

                                        <p>
                                            <strong>
                                                Trámites necesarios:
                                            </strong>
                                        </p>

                                        <ol>

                                            <li>
                                                La Institución interesada debe
                                                hacer la solicitud a través de
                                                su área de Intercambio, la cual
                                                la tramitará con el área de
                                                Intercambio de la Coordinación
                                                de la Investigación Científica.
                                            </li>

                                            <li>
                                                La Coordinación envía al CCA un
                                                oficio informando el nombre de
                                                la Institución y del Académico
                                                responsable del Proyecto o Curso
                                                y del académico invitado a dicha
                                                Institución o a este Centro.
                                            </li>

                                            <li>
                                                La Secretaría Académica, previo
                                                acuerdo con el académico del
                                                CCA involucrado, contesta a la
                                                Coordinación sobre la disposición,
                                                fechas y condiciones para aceptar
                                                la invitación de dicha Institución,
                                                o recibir a algún profesor invitado.
                                            </li>

                                        </ol>

                                        <p>
                                            El trámite para actividades de
                                            Intercambio Nacional puede ser
                                            iniciado por el Grupo del CCA
                                            interesado. El investigador del CCA
                                            iniciará el trámite con una carta
                                            dirigida al Director, especificando
                                            objetivos, fechas, nombre de la
                                            Institución y académicos involucrados,
                                            así como el apoyo que se solicita
                                            para que la Secretaría Académica lo
                                            tramite con el área de Intercambio
                                            de la Coordinación.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <!-- INTERCAMBIO INTERNACIONAL -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingIntercambioInternacional"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseIntercambioInternacional"
                                        aria-expanded="false"
                                        aria-controls="collapseIntercambioInternacional"
                                    >
                                        Intercambio académico internacional
                                    </button>

                                </h2>


                                <div
                                    id="collapseIntercambioInternacional"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingIntercambioInternacional"
                                    data-bs-parent="#accordionTramites"
                                >

                                    <div class="accordion-body">

                                        <p>
                                            <strong>
                                                Trámites necesarios:
                                            </strong>
                                        </p>

                                        <ol>

                                            <li>
                                                Las actividades de Intercambio
                                                Académico Internacional deben
                                                de estar incluidas previamente
                                                en lo general en el Programa
                                                Anual acordado con el Área de
                                                Intercambio de la Coordinación
                                                de la Investigación Científica
                                                (CIC).
                                            </li>

                                            <li>
                                                Se envía una carta al Director
                                                solicitando la autorización,
                                                ya sea para licencia de un
                                                investigador del centro o
                                                avisando que viene un investigador
                                                invitado.
                                            </li>

                                            <li>
                                                Se captura en línea la información
                                                en las fechas establecidas por
                                                la CIC y se entrega en la
                                                Secretaría Académica para su
                                                trámite, junto con los siguientes
                                                documentos:

                                                <ul>

                                                    <li>
                                                        Justificación Académica.
                                                    </li>

                                                    <li>
                                                        Programa de Trabajo y/o
                                                        Programa del Curso.
                                                    </li>

                                                    <li>
                                                        Carta de invitación o
                                                        aceptación.
                                                    </li>

                                                    <li>
                                                        <em>Curriculum vitae</em>
                                                        (resumen).
                                                    </li>

                                                </ul>

                                            </li>

                                            <li>
                                                La Secretaría Académica lo envía
                                                a la Coordinación para su
                                                autorización y apoyo económico.
                                            </li>

                                        </ol>

                                        <p>
                                            <strong>NOTA.</strong>
                                            En caso de que surja la posibilidad
                                            de un intercambio que no estuviera
                                            programado, éste deberá presentarse
                                            con un mínimo de 60 días antes de
                                            la actividad para que sea considerado
                                            en el Consejo Consultivo Interno y
                                            en el área de Intercambio Académico
                                            de la Coordinación.
                                        </p>

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
                                    data-bs-parent="#accordionTramites"
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
                                    data-bs-parent="#accordionTramites"
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
                                    data-bs-parent="#accordionTramites"
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
                    <!-- ESTÍMULOS -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Estimulos"
                        role="tabpanel"
                        aria-labelledby="nav-Estimulos-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionEstimulos"
                        >


                            <!-- PRIDE -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPride"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePride"
                                        aria-expanded="false"
                                        aria-controls="collapsePride"
                                    >
                                        PRIDE
                                    </button>

                                </h2>


                                <div
                                    id="collapsePride"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPride"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">

                                        <p>
                                            El Programa de Primas al Desempeño
                                            del Personal Académico de Tiempo
                                            Completo (PRIDE) tiene por objeto
                                            reconocer y estimular la labor de
                                            los académicos de tiempo completo
                                            que hayan realizado sus actividades
                                            de manera sobresaliente, mediante
                                            una prima equivalente a un porcentaje
                                            del salario tabular vigente del
                                            académico, en alguno de los siguientes
                                            niveles: «A», «B», «C» y «D».
                                        </p>


                                        <a
                                            href="http://dgapa.unam.mx/index.php/estimulos/pride"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            IR A PÁGINA
                                        </a>


                                        <hr>


                                        <h4>
                                            Para académicos del SIJA
                                        </h4>

                                        <strong>Requisitos:</strong>

                                        <ul>

                                            <li>
                                                Carta dirigida al Director(a)
                                                solicitando su incorporación
                                                al Programa de Estímulos por
                                                Equivalencia
                                            </li>

                                            <li>
                                                Copia de la constancia del último
                                                grado obtenido
                                            </li>

                                            <li>Formato</li>

                                        </ul>


                                        <a
                                            href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/Formato-Solicitud-PRIDE-SIJA-2.docx"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde" 
                                        >
                                            DESCARGAR FORMATO
                                        </a>

                                    </div>

                                </div>

                            </div>


                            <!-- PEI -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPei"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePei"
                                        aria-expanded="false"
                                        aria-controls="collapsePei"
                                    >
                                        PEI
                                    </button>

                                </h2>


                                <div
                                    id="collapsePei"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPei"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">

                                        <p>
                                            El Programa de Estímulos de Iniciación de la Carrera 
											Académica para Personal de Tiempo Completo (PEI) tiene por 
											objetivo apoyar al personal que se inicia en la actividad 
											académica dentro de la UNAM, impulsar el desarrollo de su 
											carrera, incrementar su productividad y fortalecer su 
											permanencia en la Institución.
                                        </p>
										<p><strong>Requisitos:</strong></p>
										<ul>
											<li>Carta dirigida al Director(a) solicitando su ingreso al PEI</li>
											<li>Copia de la constancia del ultimo grado obtenido</li>
										</ul>
										 <a
                                            href="http://dgapa.unam.mx/index.php/estimulos/pei"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            IR A PÁGINA
                                        </a>

                                    </div>

                                </div>

                            </div>


                            <!-- PASPA -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPaspa"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePaspa"
                                        aria-expanded="false"
                                        aria-controls="collapsePaspa"
                                    >
                                        PASPA
                                    </button>

                                </h2>


                                <div
                                    id="collapsePaspa"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPaspa"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">

                                        <p>
                                            El Programa de Apoyos para la
                                            Superación del Personal Académico
                                            de la UNAM (PASPA) contribuye a la
                                            superación del personal académico
                                            y al fortalecimiento de la planta
                                            académica de las entidades, mediante
                                            apoyos para realizar estudios de
                                            posgrado o estancias sabáticas,
                                            posdoctorales y de investigación,
                                            las cuales pueden realizarse en
                                            instituciones mexicanas o extranjeras
                                            de reconocido prestigio en el área
                                            del conocimiento correspondiente.                                      
                                            Las entidades académicas de la UNAM
                                            postulan a los candidatos que
                                            solicitan el apoyo, con base en las
                                            necesidades de superación expresadas
                                            en su plan de desarrollo.
                                        </p>


                                        <a
                                            href="http://dgapa.unam.mx/index.php/formacion-academica"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary"
                                        >
                                            IR A PÁGINA
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
                                    data-bs-parent="#accordionEstimulos"
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
                                    data-bs-parent="#accordionEstimulos"
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

							<!-- BECA DE PROYECTOS-->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingBecaProyectos"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseBecaProyectos"
                                        aria-expanded="false"
                                        aria-controls="collapseBecaProyectos"
                                    >
                                       Beca de Proyectos de Investigaci&oacute;n
									   para Estudios de Especialidad, Maestr&iacute;a,
									   Doctorqado y Cursos Proped&eacute;uticos de ingreso al Posgrado
                                    </button>

                                </h2>


                                <div
                                    id="collapseBecaProyectos"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingBecaProyectos"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">
										<p>Otorgar apoyo económico al estudiante de posgrado para continuar 
										sus estudios en ciencias ambientales y atmosféricas.</p>
										
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2023/02/Solicitud-Posgrado-240223.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                FORMATO DE SOLICITUD
                                            </a>


                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/04/Carta-Compromiso-Posgrado.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                CARTA COMPROMISO
                                            </a>
											<a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/09/3a-Reglas-operacion-Posgrado-ICAyCC-2022revACR.pdf"
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

							<!-- BECA DE  ESTANCIAS POSTDOC -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingBecaEstPostdoc"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseBecaEstPosdoc"
                                        aria-expanded="false"
                                        aria-controls="collapseBecaEstPosdoc"
                                    >
                                       Beca de Proyectos de Investigaci&oacute;n
									   para Estancias Postdoctorales
                                    </button>

                                </h2>


                                <div
                                    id="collapseBecaEstPosdoc"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingBecaEstPostdoc"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">
										<p>Otorgar apoyo económico al investigador posdoctoral para realizar una estancia 
										de investigación en ciencias ambientales y atmosféricas.</p>
										
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2023/02/Solicitud-Posdoctorado-240223.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                FORMATO DE SOLICITUD
                                            </a>


                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/04/Compromiso-Posdoctorado.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                CARTA COMPROMISO
                                            </a>
											<a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/09/4a-Reglas-operacion-Posdoctorado-ICAyCC-2022revACR.pdf"
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
							
							<!-- BECA DE POSTDOC -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingBecaPostdoc"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseBecaPosdoc"
                                        aria-expanded="false"
                                        aria-controls="collapseBecaPosdoc"
                                    >
                                       Becas para Estancias Postdoctorales (DGAPA y CONACyT)
                                    </button>

                                </h2>


                                <div
                                    id="collapseBecaPosdoc"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingBecaPostdoc"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">
										<h2>Programa de Becas Posdoctorales en la UNAM (DGAPA)</h2>
										<p>Fortalecer el quehacer científico y docente de alto nivel, 
										apoyando a recién doctorados para que desarrollen un proyecto 
										de investigación novedoso en la UNAM.</p>
										
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="http://dgapa.unam.mx/index.php/formacion-academica/posdoc"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                IR A P&Aacute;GINA
                                            </a>
                                        
										</div>
										<h2>Estancias Posdoctorales Nacionales (CONACyT)</h2>
										<p>Vincular a los doctores en ciencias al sector académico y de 
											investigación para fortalecer las líneas de generación y/o 
											aplicación al conocimiento, así como la docencia de los 
											programas de posgrado nacionales.</p>
										
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="http://www.conacyt.mx/index.php/becas-y-posgrados/becas-nacionales/estancias-posdoctorales-nacionales"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                IR A P&Aacute;GINA
                                            </a>
                                        
										</div>

                                    </div>

                                </div>

                            </div>
							
							<!-- APOYOS PAPIT PAPIME -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPAPIT"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePAPIT"
                                        aria-expanded="false"
                                        aria-controls="collapsePAPIT"
                                    >
                                       Apoyos PAPIIT - PAPIME
                                    </button>

                                </h2>


                                <div
                                    id="collapsePAPIT"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPAPIT"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">
										<h2>Programa de Apoyo a Proyectos de Investigación e Innovación Tecnológica (PAPIIT)</h2>
										<p>Tiene la finalidad de apoyar y fomentar el desarrollo de la 
										investigación fundamental y aplicada, la innovación tecnológica 
										y la formación de grupos de investigación en y entre las 
										entidades académicas, a través de proyectos de investigación 
										y de innovación tecnológica, cuyo diseño conduzca a la
										generación de conocimientos que se publiquen en medios del
										más alto impacto y calidad, así como a la producción de 
										patentes y transferencia de tecnología.</p>
										
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="http://dgapa.unam.mx/index.php/impulso-a-la-investigacion/papiit"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                IR A P&Aacute;GINA
                                            </a>
                                        
										</div>
										<h2>Programa de Apoyo a Proyectos para la Innovación y Mejoramiento de la Enseñanza (PAPIME)</h2>
										<p>Impulsa la superación y desarrollo del personal académico con 
										el apoyo a proyectos que conduzcan a la innovación y al 
										mejoramiento del proceso enseñanza-aprendizaje y que 
										beneficien directamente a los alumnos tanto del bachillerato
										como de la licenciatura de la UNAM.</p>
										
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="http://dgapa.unam.mx/index.php/fortalecimiento-a-la-docencia/papime"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                IR A P&Aacute;GINA
                                            </a>
                                        
										</div>

                                    </div>

                                </div>

                            </div>

							<!--  PREI -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPREI"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePREI"
                                        aria-expanded="false"
                                        aria-controls="collapsePREI"
                                    >
                                       Programa de Estancias de Investigaci&oacute;n (PREI)
                                    </button>

                                </h2>


                                <div
                                    id="collapsePREI"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPREI"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">										
										<p>Tiene como objetivo contribuir al fortalecimiento de la 
										investigación y de la docencia en las entidades académicas de 
										la UNAM, mediante apoyos complementarios para que 
										distinguidos académicos adscritos a instituciones del extranjero
										realicen una estancia en la Universidad</p>
										
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="http://dgapa.unam.mx/index.php/impulso-a-la-investigacion/prei"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                IR A P&Aacute;GINA
                                            </a>
                                        
										</div>
									

                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- CONVOCATORIAS -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Convocatorias"
                        role="tabpanel"
                        aria-labelledby="nav-Convocatorias-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionConvocatorias"
                        >
							<!-- BECAS POSDOC UNAM -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingPosdoc"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapsePosdoc"
                                        aria-expanded="false"
                                        aria-controls="collapsePosdoc"
                                    >
                                        Programa de becas posdoctorales en la UNAM
                                    </button>

                                </h2>


                                <div
                                    id="collapsePosdoc"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPosdoc"
                                    data-bs-parent="#accordionConvocatorias"
                                >

                                    <div class="accordion-body">

                                        <a
                                            href="https://dgapa.unam.mx/index.php/formacion-academica/posdoc"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            CONVOCATORIAS DGAPA
                                        </a>

                                    </div>

                                </div>

                            </div>
							
							<!-- CONCURSOS OPOSICION ABIERTOS -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingOposicion"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseOposicion"
                                        aria-expanded="false"
                                        aria-controls="collapseOposicion"
                                    >
                                        Concursos de oposici&oacute;n Abiertos
                                    </button>

                                </h2>


                                <div
                                    id="collapseOposicion"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingOposicion"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">

                                        <p>
                                           El concurso de oposición para ingreso, o concurso abierto, es 
										   el procedimiento público a través del cual se puede llegar a 
										   formar parte del personal académico interino o por contrato en la UNAM.
                                        </p>                                      
										<div class="d-flex flex-wrap gap-2">
											<a
												href="https://zafiro.dgapa.unam.mx/cocoa/conv"
												target="_blank"
												rel="noopener noreferrer"
												class="btn btn-primary boton-fondo-verde"
											>
												IR A PÁGINA
											</a>
											<a
												href="https://www.atmosfera.unam.mx/category/convocatorias/"
												target="_blank"
												rel="noopener noreferrer"
												class="btn btn-primary boton-fondo-verde"
											>
												CONVOCATORIAS VIGENTES
											</a>
										</div>
                                    </div>

                                </div>

                            </div>
							
							<!-- SIJA -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingSija"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseSija"
                                        aria-expanded="false"
                                        aria-controls="collapseSija"
                                    >
                                        Subprograma de Incorporación de
                                        Jóvenes Académicos de Carrera (SIJA)
                                    </button>

                                </h2>


                                <div
                                    id="collapseSija"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingSija"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">

                                        <p>
                                            El <strong>Subprograma de
                                            Incorporación de Jóvenes Académicos
                                            de Carrera (SIJA)</strong> tiene por
                                            objetivo cubrir las necesidades y
                                            las vacantes generadas por el
                                            Subprograma de Retiro Voluntario
                                            por Jubilación, así como reforzar
                                            las áreas del conocimiento existentes
                                            y atender las áreas o necesidades
                                            emergentes, de conformidad con los
                                            planes de desarrollo de las entidades
                                            académicas de la UNAM.
                                        </p>

                                        <p>
                                            Está dirigido a jóvenes con edad
                                            menor a 39 años para mujeres y menor
                                            de 37 años para hombres, con al menos
                                            el grado de maestría para incorporarse
                                            como técnicos académicos y con al
                                            menos grado de doctor para incorporarse
                                            como investigadores.
                                        </p>


                                        <a
                                            href="http://dgapa.unam.mx/index.php/estimulos"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            IR A PÁGINA
                                        </a>

                                    </div>

                                </div>

                            </div>

							<!--CATEDRAS    -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingCatedras"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseCatedras"
                                        aria-expanded="false"
                                        aria-controls="collapseCatedras"
                                    >
                                        C&aacute;tedras CONACYT
                                    </button>

                                </h2>


                                <div
                                    id="collapseCatedras"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingCatedras"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">

                                        <p>
                                           Las Cátedras CONACYT forman parte de la plantilla de 
										   servicios profesionales del CONACYT, dirigidas a 
										   investigadores y tecnólogos de alto potencial y talento en 
										   investigación, desarrollo tecnológico e innovación, los cuales 
										   son comisionados a las instituciones que resulten beneficiadas 
										   en los términos de la convocatoria vigente.
                                        </p>                                      
										<div class="d-flex flex-wrap gap-2">
											<a
												href="http://conacyt.gob.mx/index.php/el-conacyt/desarrollo-cientifico/catedrasconacyt"
												target="_blank"
												rel="noopener noreferrer"
												class="btn btn-primary boton-fondo-verde"
											>
												IR A PÁGINA
											</a>
											
										</div>
                                    </div>

                                </div>

                            </div>

                     

                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- NORMATIVIDAD -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Normatividad"
                        role="tabpanel"
                        aria-labelledby="nav-Normatividad-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionNormatividad"
                        >
							<!-- LEGISLACION-->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingLegislacion"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseLegislacion"
                                        aria-expanded="false"
                                        aria-controls="collapseLegislacion"
                                    >
                                        Legislación Universitaria de la UNAM
                                    </button>

                                </h2>


                                <div
                                    id="collapseLegislacion"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingLegislacion"
                                    data-bs-parent="#accordionNormatividad"
                                >

                                    <div class="accordion-body">

                                        <a
                                            href="https://www.abogadogeneral.unam.mx/index.php/legislacion"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            IR A PÁGINA
                                        </a>

                                    </div>

                                </div>

                            </div>

							<!-- ESTATUTO-->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingEstatuto"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseEstatuto"
                                        aria-expanded="false"
                                        aria-controls="collapseEstatuto"
                                    >
                                        Estatuto del Personal Acad&eacute;mico
                                    </button>

                                </h2>


                                <div
                                    id="collapseEstatuto"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingEstatuto"
                                    data-bs-parent="#accordionNormatividad"
                                >

                                    <div class="accordion-body">

                                        <a
                                            href="https://www.abogadogeneral.unam.mx/sites/default/files/archivos/LegUniv/26-EstatutoPersonalAcademico_UNAM_070425.pdf"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            IR A PÁGINA
                                        </a>

                                    </div>

                                </div>

                            </div>
							
							<!-- REG CTIC-->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingRegCTIC"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseRegCTIC"
                                        aria-expanded="false"
                                        aria-controls="collapseRegCTIC"
                                    >
                                        Reglamento del CTIC
                                    </button>

                                </h2>


                                <div
                                    id="collapseRegCTIC"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingRegCTIC"
                                    data-bs-parent="#accordionNormatividad"
                                >

                                    <div class="accordion-body">

                                        <a
                                            href="https://www.abogadogeneral.unam.mx/sites/default/files/archivos/LegUniv/14-ReglamentoInternoConsejoTecnicoInvestigacionCientifica_rem38_021220.pdf"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            IR A PÁGINA
                                        </a>

                                    </div>

                                </div>

                            </div>
							
							<!-- ACUERDOS CTIC-->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingAcuCTIC"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseAcuCTIC"
                                        aria-expanded="false"
                                        aria-controls="collapseAcuCTIC"
                                    >
                                        Acuerdos del CTIC
                                    </button>

                                </h2>


                                <div
                                    id="collapseAcuCTIC"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingAcuCTIC"
                                    data-bs-parent="#accordionNormatividad"
                                >

                                    <div class="accordion-body">
										<p>Seguir ruta: CTIC/ Acerca del Consejo Técnico/ Acuerdos</p>
                                        <a
                                            href="https://sesiones-ctic.cic.unam.mx/acuerdosctic/?PaginacionAcuerdos=1"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            IR A PÁGINA
                                        </a>

                                    </div>

                                </div>

                            </div>
							
							<!-- CRITERIOS -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingCriterios"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseCriterios"
                                        aria-expanded="false"
                                        aria-controls="collapseCriterios"
                                    >
                                       Criterios y Lineamientos para la evaluaci&oacute;n del personal acad&eacute;mico Del
									   Subsistema de la Investigaci&oacute;n Cient&iacute;fica
                                    </button>

                                </h2>


                                <div
                                    id="collapseCriterios"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingCriterios"
                                    data-bs-parent="#accordionNormatividad"
                                >

                                    <div class="accordion-body">
										
                                        <a
                                            href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/4-2-Criterios-generales-para-la-evaluacion.pdf"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            IR A PÁGINA
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- CUERPOS COLEGIADOS -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Colegiados"
                        role="tabpanel"
                        aria-labelledby="nav-Colegiados-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionColegiados"
                        >


                            <!-- CONSEJO TÉCNICO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingConsejoTecnico"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseConsejoTecnico"
                                        aria-expanded="false"
                                        aria-controls="collapseConsejoTecnico"
                                    >
                                        Consejo Técnico de la Investigación
                                        Científica
                                    </button>

                                </h2>


                                <div
                                    id="collapseConsejoTecnico"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingConsejoTecnico"
                                    data-bs-parent="#accordionColegiados"
                                >

                                    <div class="accordion-body">

                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2025/05/CALENDARIO-SESIONES-CTIC-AGO-2025-AGO-2026-3.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary"
                                            >
                                                DESCARGAR CALENDARIO DE SESIONES
                                            </a>


                                            <a
                                                href="https://www.cic.unam.mx/consejo-tecnico-de-la-investigacion/"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary"
                                            >
                                                IR A PÁGINA
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- CONSEJO CONSULTIVO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingConsejoConsultivo"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseConsejoConsultivo"
                                        aria-expanded="false"
                                        aria-controls="collapseConsejoConsultivo"
                                    >
                                        Consejo Consultivo Interno
                                    </button>

                                </h2>


                                <div
                                    id="collapseConsejoConsultivo"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingConsejoConsultivo"
                                    data-bs-parent="#accordionColegiados"
                                >

                                    <div class="accordion-body">

                                        <h4>
                                            <strong>INTEGRANTES</strong>
                                        </h4>

                                        <p>
                                            <strong>Por la Dirección:</strong>
                                        </p>

                                        <p>
                                            Dr. Michel Alexandre Grutter De la
                                            Mora, Presidente
                                        </p>

                                        <p>
                                            Dra. Erika Danaé López Espinoza,
                                            Secretaria Académica
                                        </p>

                                        <p>
                                            Dr. Carlos Gay García, Jefe del
                                            Departamento de Ciencias Atmosféricas
                                        </p>

                                        <p>
                                            Dra. Maria Amparo Martinez Arroyo,
                                            Jefa del Departamento de Ciencias
                                            Ambientales
                                        </p>

                                        <p>
                                            Dr. Luis Antonio Ladino Moreno,
                                            Jefe del Departamento de
                                            Instrumentación Meteorológica
                                        </p>


                                        <p>
                                            <strong>
                                                Por el Colegio del Personal
                                                Académico del ICAyCC:
                                            </strong>
                                        </p>

                                        <p>
                                            <strong>Propietarios</strong>
                                        </p>

                                        <p>
                                            Dr. Alejandro Jaramillo Moreno
                                        </p>

                                        <p>
                                            Dra. Marni Margarita Pazos Espejel
                                        </p>

                                        <p>
                                            Dr. Ricardo Torres Jardón
                                        </p>

                                        <p>
                                            <strong>Suplentes</strong>
                                        </p>

                                        <p>
                                            Dra. Irma aurora Rosas Pérez
                                        </p>

                                        <p>
                                            L. en I. Higicel Domínguez Vargas
                                        </p>

                                        <p>
                                            Dr. Julián Andrés Velasco Vinasco
                                        </p>

                                        <p>
                                            <strong>
                                                Invitados permanentes
                                            </strong>
                                        </p>

                                        <p>
                                            Dr. Michel Alexandre Grutter de la
                                            Mora, Representante de los
                                            académicos ante el CTIC
                                        </p>

                                        <p>
                                            Dr. Oscar Augusto Peralta Rosales,
                                            Investigador Suplente
                                        </p>

                                        <p>
                                            Dra. Lyssette Elena Muñoz Villers,
                                            Representante ante el CAACFMI
                                        </p>

                                        <p>
                                            Dr. Guillermo Montero Martínez,
                                            Suplente
                                        </p>


                                        <p>
                                            <strong>
                                                Consejeros Universitarios
                                            </strong>
                                        </p>

                                        <p>
                                            Dr. Luis Gerardo Ruiz Suárez,
                                            Representante
                                        </p>

                                        <p>
                                            Dra. Elizabeth Vega Rangel,
                                            Suplente
                                        </p>

                                        <a
                                            href="https://www.atmosfera.unam.mx/wp-content/uploads/2026/06/Calendario-Sesiones-Ordinarias-CI-Julio-2026-Enero-2027.pdf"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary"
                                        >
                                            DESCARGAR CALENDARIO DE SESIONES
                                        </a>

                                    </div>

                                </div>

                            </div>

                            <!-- COMISIÓN DICTAMINADORA -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingDictaminadora"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseDictaminadora"
                                        aria-expanded="false"
                                        aria-controls="collapseDictaminadora"
                                    >
                                        Comisión Dictaminadora
                                    </button>

                                </h2>


                                <div
                                    id="collapseDictaminadora"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingDictaminadora"
                                    data-bs-parent="#accordionColegiados"
                                >

                                    <div class="accordion-body">

                                        <h4>
                                            <strong>INTEGRANTES</strong>
                                        </h4>

                                        <p>
                                            <strong>
                                                Por el Consejo Académico del
                                                Área de las Ciencias Físico
                                                Matemáticas y de las Ingenierías
                                            </strong>
                                        </p>

                                        <p>
                                            Dra. Margarita Erna Caballero
                                            Miranda – Instituto de Geofísica
                                        </p>

                                        <p>
                                            Dra. Julia Tagüeña Parga,
                                            Instituto de Energías Renovables
                                        </p>

                                        <p>
                                            <strong>
                                                Por el Consejo Técnico de la
                                                Investigación Científica
                                            </strong>
                                        </p>

                                        <p>
                                            Dra. Patricia Segura Medina –
                                            Instituto Nacional de Enfermedades
                                            Respiratorias
                                        </p>

                                        <p>
                                            Dr. José Francisco Valdés Galicia,
                                            Instituto de Geofísica
                                        </p>

                                        <p>
                                            <strong>
                                                Por el Colegio del Personal
                                                Académico del ICAyCC:
                                            </strong>
                                        </p>

                                        <p>
                                            Dr. Carles Canet Miquel,
                                            Instituto de Geofísica
                                        </p>

                                        <p>
                                            Dra. María del Carmen Leticia
                                            Calderón Ezquerro, ICAyCC
                                        </p>

                                    </div>

                                </div>

                            </div>
							
							<!-- COMISIÓN EVALUADORA -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingEvaluadora"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseEvaluadora"
                                        aria-expanded="false"
                                        aria-controls="collapseEvaluadora"
                                    >
                                        Comisión Evaluadora
                                    </button>

                                </h2>


                                <div
                                    id="collapseEvaluadora"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingEvaluadora"
                                    data-bs-parent="#accordionColegiados"
                                >

                                    <div class="accordion-body">

                                        <h4>
                                            <strong>INTEGRANTES</strong>
                                        </h4>

                                        <p>
                                            <strong>
                                                Por el Consejo Académico del
                                                Área de las Ciencias Físico
                                                Matemáticas y de las Ingenierías
                                            </strong>
                                        </p>

                                        <p>
                                            Dra. Laura Elena Sanvicente Añorve,
                                            Instituto de Ciencias del Mar y
                                            Limnología
                                        </p>

                                        <p>
                                            Dr. Jesús Antonio Del Río Portilla,
                                            Instituto de Energías Renovables
                                        </p>

                                        <p>
                                            M. en I. Rafaela Gutiérrez Lara,
                                            Facultad de Química
                                        </p>

                                        <p>
                                            <strong>
                                                Por el Consejo Técnico de la
                                                Investigación Científica
                                            </strong>
                                        </p>

                                        <p>
                                            Dr. Oswaldo Téllez Valdés,
                                            FES Iztacala
                                        </p>

                                        <p>
                                            Dra. Rocío García Martínez,
                                            Instituto de Ciencias de la
                                            Atmósfera y Cambio Climático
                                        </p>

                                    </div>

                                </div>

                            </div>
							
							<!-- REPRESENTANTES DE INVESTIGADORES -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingRepresentantes"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseRepresentantes"
                                        aria-expanded="false"
                                        aria-controls="collapseRepresentantes"
                                    >
                                        Representantes de Investigadores ante el H. Consejo Universitario
                                    </button>

                                </h2>


                                <div
                                    id="collapseRepresentantes"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingRepresentantes"
                                    data-bs-parent="#accordionColegiados"
                                >

                                    <div class="accordion-body">

                                        <h4>
                                            <strong>INTEGRANTES</strong>
                                        </h4>

                                        <p>
                                            <strong>
                                               Consejero Universitario Propietario:
                                            </strong>
                                        </p>

                                        <p>
                                            Dr. Luis Gerardo Ruiz Suárez, ICAyCC
                                        </p>
                                       

                                        <p>
                                            <strong>
                                               Consejero Universitario Suplente:
                                            </strong>
                                        </p>

                                        <p>
                                            Dra. Elizabeth Vega Rangel, ICAyCC
                                        </p>
                                     

                                    </div>

                                </div>

                            </div>
							
							<!-- Actas CI -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingActasCI"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseActasCI"
                                        aria-expanded="false"
                                        aria-controls="collapseActasCI"
                                    >
                                        Actas del Consejo Interno <?=date("Y")?>
                                    </button>

                                </h2>


                                <div
                                    id="collapseActasCI"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingActasCI"
                                    data-bs-parent="#accordionColegiados"
                                >

                                    <div class="accordion-body">

                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/secretaria-academica/#cuerpos-colegiados"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR ACTA
                                            </a>


                                         

                                        </div>

                                    </div>

                                </div>

                            </div>
							
							<!-- Actas CI ANTERIORS -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingActasCIA"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseActasCIA"
                                        aria-expanded="false"
                                        aria-controls="collapseActasCIA"
                                    >
                                        Actas del Consejo Interno Anteriores a <?=date("Y");?>
                                    </button>

                                </h2>


                                <div
                                    id="collapseActasCIA"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingActasCIA"
                                    data-bs-parent="#accordionColegiados"
                                >

                                    <div class="accordion-body">

                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/secretaria-academica/#cuerpos-colegiados"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                Ver Actas Anteriores <?=date("Y");?>
                                            </a>


                                         

                                        </div>

                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- SISA -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-SISA"
                        role="tabpanel"
                        aria-labelledby="nav-SISA-tab"
                        tabindex="0"
                    >

                        <div class="text-center py-4">

                            <a
                                href="https://sisa.atmosfera.unam.mx/login"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-primary btn-lg boton-fondo-verde"
                            >
                                SISTEMA DE INFORMACI&Oacute;N Y
                                SEGUIMIENTO ACAD&Eacute;MICO
                            </a>

                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- SEEA -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-SEEA"
                        role="tabpanel"
                        aria-labelledby="nav-SEEA-tab"
                        tabindex="0"
                    >

                        <div class="text-center py-4">

                            <a
                                href="https://seea.atmosfera.unam.mx:44301/"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-primary btn-lg boton-fondo-verde"
                            >
                                SISTEMA DE ESTUDIANTES Y ESTANCIAS
                                ACAD&Eacute;MICAS (SEEA)
                            </a>

                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- TRÁMITES ESTUDIANTES -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-TA"
                        role="tabpanel"
                        aria-labelledby="nav-TA-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionEstudiantes"
                        >


                            <!-- SERVICIO SOCIAL -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingServicioSocial"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseServicioSocial"
                                        aria-expanded="false"
                                        aria-controls="collapseServicioSocial"
                                    >
                                        Servicio Social
                                    </button>

                                </h2>


                                <div
                                    id="collapseServicioSocial"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingServicioSocial"
                                    data-bs-parent="#accordionEstudiantes"
                                >

                                    <div class="accordion-body">

                                        <a
                                            href="https://www.atmosfera.unam.mx/integrate-al-icaycc/#dgoae-unam"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary boton-fondo-verde"
                                        >
                                            IR A PÁGINA
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
                                    data-bs-parent="#accordionEstimulos"
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
                                        Apoyo especial del Fondo IE ICAyCC para titulaci&oacute;n u obtebci&oacute;n del grado
                                    </button>

                                </h2>


                                <div
                                    id="collapseApoyoEsp"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingApoyoEsp"
                                    data-bs-parent="#accordionEstimulos"
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

							<!-- BECA DE PROYECTOS-->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingBecaProyectos"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseBecaProyectos"
                                        aria-expanded="false"
                                        aria-controls="collapseBecaProyectos"
                                    >
                                       Beca de Proyectos de Investigaci&oacute;n
									   para Estudios de Especialidad, Maestr&iacute;a,
									   Doctorqado y Cursos Proped&eacute;uticos de ingreso al Posgrado
                                    </button>

                                </h2>


                                <div
                                    id="collapseBecaProyectos"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingBecaProyectos"
                                    data-bs-parent="#accordionEstimulos"
                                >

                                    <div class="accordion-body">
										<p>Otorgar apoyo económico al estudiante de posgrado para continuar 
										sus estudios en ciencias ambientales y atmosféricas.</p>
										
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2023/02/Solicitud-Posgrado-240223.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                FORMATO DE SOLICITUD
                                            </a>


                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/04/Carta-Compromiso-Posgrado.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                CARTA COMPROMISO
                                            </a>
											<a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/09/3a-Reglas-operacion-Posgrado-ICAyCC-2022revACR.pdf"
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

                            <!-- PRÁCTICAS Campo -->
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
                                        Prácticas de Campo
                                    </button>

                                </h2>


                                <div
                                    id="collapsePracticas"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingPracticas"
                                    data-bs-parent="#accordionEstudiantes"
                                >

                                    <div class="accordion-body">
										<div class="d-flex flex-wrap gap-2">
											<a
												href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/09/formato_dgpu_practicas_de_campo.xls"
												target="_blank"
												rel="noopener noreferrer"
												class="btn btn-primary boton-fondo-verde"
											>
												DESCARGAR FORMATO DE SEGURO
											</a>
											<a
												href="https://www.atmosfera.unam.mx/wp-content/uploads/2024/09/practicas_de_campo.pdf"
												target="_blank"
												rel="noopener noreferrer"
												class="btn btn-primary boton-fondo-verde"
											>
											   REGLAMENTO PARA LA REALIZACI&Oacute;N DE PR&Aacute;CTICAS DE CAMPO
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

    </div>

</div>


<?php require_once ROOT_PATH . '/includes/footer.php'; ?>