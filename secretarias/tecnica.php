<?php
require_once __DIR__ . '/../config/config.php';
?>

<div class="container py-5">

    <h1 class="mb-4">
        Secretar&iacute;a T&eacute;cnica
    </h1>

    <div class="row g-4">

        <!-- DESCRIPCIÓN -->
        <div class="col-12 col-md-6">

            <div class="card shadow-sm h-100">

                <div class="card-body" id="mision">

                    <p>
                        Las funciones de la <b>Secretaría T&eacute;cnica</b> se concentran
						en atender, coordinar y supervisar las actividades relacionadas con 
						el apoyo técnico que requiere el personal académico y administrativo
						para el desarrollo de sus actividades, así como verificar el buen 
						funcionamiento de los equipos de los laboratorios de investigación y 
						el de cómputo básico y de alto rendimiento.
						<br>
						Llevar control de los eventos que se realizan en el auditorio, 
						en la sala de videoconferencias y en los salones de clase.
						<br>
						Desarrollar y dar seguimiento a los proyectos y necesidades de 
						reacondicionamientos, rehabilitaciones y construcción de nuevos
						espacios de trabajo que surgen de las necesidades a corto y 
						mediano plazo. Revisar lineamientos, políticas y disposiciones 
						normativas institucionales y del propio Instituto.
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
                        src="img/tecnica.jpg"
                        class="img-fluid"
                        alt="Secretaría técnica"
                    >

                </div>

            </div>

        </div>

		<!-- SIRA -->
        <div class="col-12 col-md-6">

            <div class="card shadow-sm h-100">

                <div class="card-body card-fondo-verde
                            d-flex align-items-center justify-content-center">
					<a href="https://sira.atmosfera.unam.mx:44302/mrbsicaycc/"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
						<img
							src="img/sira.jpg"
							class="img-fluid"
							alt="SIRA"
						>
					</a>
                </div>

            </div>

        </div>
		
		<!-- SERVICIOS COMPUTO -->
        <div class="col-12 col-md-6">

            <div class="card shadow-sm h-100">

                <div class="card-body card-fondo-verde
                            d-flex align-items-center justify-content-center">
					<a href="http://132.248.8.92/sistick/user_request.php"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
						<img
							src="img/servicios_comp.jpg"
							class="img-fluid"
							alt="Servicios Computo"
						>
					</a>
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
                        SECRETARIA T&Eacute;CNICA
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-bajaBienes-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-bajaBienes"
                        type="button"
                        role="tab"
                        aria-controls="nav-bajaBienes"
                        aria-selected="false"
                    >
                        BAJA DE BIENES INVENTARIABLES (EQUIPO DE C&Oacute;MPUTO)
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Manejo-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Manejo"
                        type="button"
                        role="tab"
                        aria-controls="nav-Manejo"
                        aria-selected="false"
                    >
                        MANEJO DE RESIDUOS
                    </button>


                    <button
                        class="nav-link boton-fondo-verde"
                        id="nav-Reglamentos-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-Reglamentos"
                        type="button"
                        role="tab"
                        aria-controls="nav-Reglamentos"
                        aria-selected="false"
                    >
                        REGLAMENTOS
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
                    <!-- SECRETARÍA TECNICA -->
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

                                        <img
                                            src="<?= BASE_URL ?>assets/img/secretaria_tec.jpg"
                                            class="img-fluid rounded-start
                                                   w-100 h-100 object-fit-cover"
                                            alt="Secretaría Técnica"
                                        >

                                    </div>


                                    <div class="col-md-8">

                                        <div class="card-body">

                                            <h3 class="card-title text-center">
                                               Dra. Norma González López
                                            </h3>

                                            <hr>

                                            <p class="card-text">

                                                <strong>Contacto:</strong><br>

                                               Tel. 56224061 <br> 55 56 224800 <br> Ext. 81994

                                            </p>


                                            <p class="card-text">

                                                <strong>Correo:</strong><br>

                                                <a href="mailto:secretaria_tecnica@atmosfera.unam.mx">
                                                    secretaria_tecnica@atmosfera.unam.mx
                                                </a>

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>        
                            
                        </div>

                    </div>

					<!-- ================================= -->
                    <!-- BAJA DE BIENES -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-bajaBienes"
                        role="tabpanel"
                        aria-labelledby="nav-bajaBienes-tab"
                        tabindex="0"
                    >

                        <div class="d-grid gap-4">
                            <!-- CARD 1 -->
                            <div class="card shadow-sm">
                                <div class="row g-0">
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
                    </div>

                    <!-- ================================= -->
                    <!-- MANEJO DE RESIDUOS -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Manejo"
                        role="tabpanel"
                        aria-labelledby="nav-Manejo-tab"
                        tabindex="0"
                    >

                        <div
                            class="accordion"
                            id="accordionManejo"
                        >

													
							<!--PROCEDIMIENTO RECOLECCION -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingManejo"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseManejo"
                                        aria-expanded="false"
                                        aria-controls="collapseManejo"
                                    >
                                      Procedimiento para recolecci&oacute;m de resiudos peligrosos para tratamiento y disposici&oacute;n final
                                    </button>

                                </h2>


                                <div
                                    id="collapseManejo"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingManejo"
                                    data-bs-parent="#accordionManejo"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/MANUAL_RECOLECCION-DE-RESIDUOS.pdf"
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
							
							<!--GUIA TECNICA DE ACCION RESIDUOS BIOLOGICOS -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingGTRB"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseGTRB"
                                        aria-expanded="false"
                                        aria-controls="collapseGTRBcollapseGTRB"
                                    >
                                      Gu&iacute;a t&eacute;cnica de acci&oacute;n residuos biol&oacute;gicos
                                    </button>

                                </h2>


                                <div
                                    id="collapseGTRB"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingGTRB"
                                    data-bs-parent="#accordionManejo"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/10/Gu%C3%ADa-t%C3%A9cnica-de-acci%C3%B3n-para-residuos-biol%C3%B3gicos-2012-1.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR PDF
                                            </a>
                                 
                                        </div>

                                    </div>

                                </div>

                            </div>
							
							<!--GUIA TECNICA DE ACCION RESIDUOS QUIMICOS -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingGTRQ"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseGTRQ"
                                        aria-expanded="false"
                                        aria-controls="collapseGTRQ"
                                    >
                                      Gu&iacute;a t&eacute;cnica de acci&oacute;n residuos qu&iacute;micos
                                    </button>

                                </h2>


                                <div
                                    id="collapseGTRQ"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingGTRQ"
                                    data-bs-parent="#accordionManejo"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/10/Gu%C3%ADa-t%C3%A9cnica-de-acci%C3%B3n-para-residuos-qu%C3%ADmicos-2012-2.pdf"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
                                            >
                                                DESCARGAR PDF
                                            </a>
                                 
                                        </div>

                                    </div>

                                </div>

                            </div>
							
							<!--ETIQUETA SOLICITUD TRATAMIENTO Y DISPOSICION FINAL -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingESTDF"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseESTDF"
                                        aria-expanded="false"
                                        aria-controls="collapseESTDF"
                                    >
                                     Etiqueta solicitud tratamiento y disposici&oacute;n final
                                    </button>

                                </h2>


                                <div
                                    id="collapseESTDF"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingESTDF"
                                    data-bs-parent="#accordionManejo"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/Etiqueta-solicitud-de-tratamiento-de-disposicion.pdf"
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
							
							<!--ETIQUETA RESIDUOS QUIMICO -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingErq"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseERQ"
                                        aria-expanded="false"
                                        aria-controls="collapseERQ"
                                    >
                                     Etiqueta residuos qu&iacute;micos
                                    </button>

                                </h2>


                                <div
                                    id="collapseERQ"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingErq"
                                    data-bs-parent="#accordionManejo"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/Etiqueta-de-residuos-Quimicos.pdf"
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
							
							<!--ETIQUETA RESIDUOS BIOLOGICOS INFECCIOSOS -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingERBI"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseERBI"
                                        aria-expanded="false"
                                        aria-controls="collapseERBI"
                                    >
                                     Etiqueta residuos biol&oacute;gicos infeccioso
                                    </button>

                                </h2>


                                <div
                                    id="collapseERBI"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingERBI"
                                    data-bs-parent="#accordionManejo"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/Etiqueta-de-residuo-biologicos-infeccioso.pdf"
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
							
							<!--ETIQUETA ACEPTACION RESIDUOS  -->
                            <div class="accordion-item">

                                <h2
                                    class="accordion-header"
                                    id="headingEAR"
                                >

                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseEAR"
                                        aria-expanded="false"
                                        aria-controls="collapseEAR"
                                    >
                                     Etiqueta aceptaci&oacute;n residuos 
                                    </button>

                                </h2>


                                <div
                                    id="collapseEAR"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingEAR"
                                    data-bs-parent="#accordionManejo"
                                >

                                    <div class="accordion-body">
                                      
                                        <div class="d-flex flex-wrap gap-2">

                                            <a
                                                href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/Etiqueta-de-aceptacion-de-residuos-1.pdf"
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
                    <!-- REGLAMENTOS -->
                    <!-- ================================= -->

                    <div
                        class="tab-pane fade"
                        id="nav-Reglamentos"
                        role="tabpanel"
                        aria-labelledby="nav-Reglamentos-tab"
                        tabindex="0"
                    >

                        <div class="d-grid gap-4">
                            <!-- CARD 1 -->
                            <div class="card shadow-sm">
                                <div class="row g-0">
								<p>Reglamento de Caseta y Plataforma de Onstrumentaci&oacute;n RUOA </p>
									<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2023/09/Reglamento_plataforma_instrumentacion_ICAyCC.pdf"
												target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-primary boton-fondo-verde"
										>
											DESCARGAR PDF
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