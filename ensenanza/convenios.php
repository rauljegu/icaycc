<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/slider-revolution.php';
$sql = "
SELECT
    d.*,
    i.nombre AS responsable_nombre, 
	i.correo,
	i.telefono,
	i.semblanza,
	i.extension,
	i.grado_academico,
	i.foto
FROM unidades d

LEFT JOIN personal i
    ON i.id_personal = d.responsable

WHERE d.id_unidades = 4
";
//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$unidad = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container py-5">

    <h1 class="mb-4">
      Unidad de <?= htmlspecialchars($unidad['nombre']); ?> (Convenios)
    </h1>
    <div class="row g-4">      
		<div class="col-12">
			<div class="d-flex flex-column">
				<h3 class="card-title">FORMATOS DE INSTRUMENTOS CONSENSUALES</h3>
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
							<a
								href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/10/unam_comodataria.doc"
								target="_blank"
								rel="noopener noreferrer"
								class="btn btn-primary boton-fondo-verde"
							>
								CONTRATO COMODATO-COMODATARIA
							</a>
					   
					</div>
				</div>
				
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
							<a
								href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/10/unam_comodante.docx"
								target="_blank"
								rel="noopener noreferrer"
								class="btn btn-primary boton-fondo-verde"
							>
								CONTRATO COMODATO-COMODANTE
							</a>
					   
					</div>
				</div>
				
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
							<a
								href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/10/unam_donacion.docx"
								target="_blank"
								rel="noopener noreferrer"
								class="btn btn-primary boton-fondo-verde"
							>
								CONTRATO DONACI&Oacute;N
							</a>
					   
					</div>
				</div>
				
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
							<a
								href="https://www.atmosfera.unam.mx/wp-content/uploads/2016/12/BASES-3-1.doc"
								target="_blank"
								rel="noopener noreferrer"
								class="btn btn-primary boton-fondo-verde"
							>
								BASES DE COLABORACI&Oacute;N
							</a>
					   
					</div>
				</div>
				
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
							<a
								href="https://www.atmosfera.unam.mx/wp-content/uploads/2022/09/ConveniodeColaboracion_1.docx"
								target="_blank"
								rel="noopener noreferrer"
								class="btn btn-primary boton-fondo-verde"
							>
								CONVENIO DE COLABORACI&Oacute;N
							</a>
					   
					</div>
				</div>
				
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
							<a
								href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/ConvEspecifico-1.doc"
								target="_blank"
								rel="noopener noreferrer"
								class="btn btn-primary boton-fondo-verde"
							>
								CONVENIO ESPEC&Iacute;FICO DE COLABORACI&Oacute;N
							</a>
					   
					</div>
				</div>
				
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
							<a
								href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/ConvGeneral-1.doc"
								target="_blank"
								rel="noopener noreferrer"
								class="btn btn-primary boton-fondo-verde"
							>
								CONVENIO GENERAL
							</a>
					   
					</div>
				</div>
				
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
							<a
								href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/ConvGeneralAcademico.doc"
								target="_blank"
								rel="noopener noreferrer"
								class="btn btn-primary boton-fondo-verde"
							>
								CONVENIO GENERAL DE COLABORACI&Oacute;N ACAD&Eacute;MICA
							</a>
					   
					</div>
				</div>
				
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
							<a
								href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/ConvModificatorio.doc"
								target="_blank"
								rel="noopener noreferrer"
								class="btn btn-primary boton-fondo-verde"
							>
								CONVENIO MODIFICATORIO
							</a>
					   
					</div>
				</div>
				
			</div>						
		</div>
		<!-------------------------------------------------
		--
		-- 						Contacto                  --
		-------------------------------------------------->
		<h3 class="text-center">Contacto</h3>
		<!-- PRESENTACION 2 -->
        <div class="col-12 col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">
					<h2 class="card-title"><i class="bi bi-envelope-at-fill"></i></h2><br>
                    <p>Email</p>
                    <a href="mailto:<?= htmlspecialchars($unidad['correo']); ?>" style="text-decoration:none;color:#fff">
						<?= htmlspecialchars($unidad['correo']); ?>
					</a>
				</div>
			</div>
		</div>


        <!-- PRESENTACION 3 -->
       <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-verde">
					<h2 class="card-title"><i class="bi bi-telephone"></i></h2>
                    Tel. <?= htmlspecialchars($unidad['telefono']); ?><br>
					Ext.   <p> <?= htmlspecialchars($unidad['extension']); ?></p>
					Laboratorio: 5556224076
                </div>
            </div>
        </div>
			 <!-- PRESENTACION 1 -->
        <div class="col-12 col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">

					<h2 class="card-title">
						<i class="bi bi-geo-alt"></i>
					</h2>

					<p>Circuito Exterior s/n, Coyoacan, Ciudad Universitaria, 04510 Ciudad de México, CDMX.</p>

				</div>
			</div>
		</div>
		<!-------------------------------------------------
		--
		-- 						PROCEDIMIETO             --
		-------------------------------------------------->
		<h3 class="text-center">Procedimiento para la elaboraci&oacute;n de Instrumentos Consensuales</h3>
		<div class="col-12 col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">

					<h2 class="card-title">
						<i class="bi bi-1-square-fill"></i>
					</h2>
					<hr>
					<p>Establecer e&ntilde; tipo de instrumento ( convenio de colaboraci&oacute;n&comma; convenio espec&iacute;fico de colaboraci&oacute;n&comma; bases de colaboraci&oacute;n&comma; contrato de donaci&oacute;n&comma; etc)</p>

				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">

					<h2 class="card-title">
						<i class="bi bi-2-square-fill"></i>
					</h2>
					<hr>
					<p>Definir las caracter&iacute;sticas del convenio y adecuarla a los formatos estableciods por la UNAM</p>

				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">

					<h2 class="card-title">
						<i class="bi bi-3-square-fill"></i>
					</h2>
					<hr>
					<p>El responsable t&eacute;cnico de la UNAM y de la contraparte del proyecto deber&aacute;n revisar el contenido del documento previamente a su validaci&oacute;n j&uacute;ridica</p>

				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-6">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">

					<h2 class="card-title">
						<i class="bi bi-4-square-fill"></i>
					</h2>
					<hr>
					<p>Enviar la validación jurídica a la instancia de la UNAM y de la contraparte correspondiente</p>

				</div>
			</div>
		</div>

		<div class="col-12 col-md-6">
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex flex-column justify-content-center align-items-center text-center card-fondo-medium">

					<h2 class="card-title">
						<i class="bi bi-5-square-fill"></i>
					</h2>
					<hr>
					<p>Entregar la documentación legal que sustente la representación de la contraparte, entre otros.</p>

				</div>
			</div>
		</div>
		<!-------------------------------------------------
		--
		-- 						FAQS                  --
		-------------------------------------------------->
		<h3 class="text-center">Preguntas Frecuentes</h3>
        <div class="col-12 col-md-6">
			 <div
				class="accordion"
				id="accordionPreguntas"
                        >
				<!-- CARACTERISTICAS -->
				<div class="accordion-item">

					<h2
						class="accordion-header"
						id="headingCaracteristicas"
					>

						<button
							class="accordion-button collapsed"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="#collapseCaracteristicas"
							aria-expanded="false"
							aria-controls="collapseCaracteristicas"
						>
							1. ¿Qué características debe contener el convenio?
						</button>

					</h2>


					<div
						id="collapseCaracteristicas"
						class="accordion-collapse collapse"
						aria-labelledby="headingCaracteristicas"
						data-bs-parent="#accordionPreguntas"
					>

						<div class="accordion-body">
							<ul>
								<li>Nombre del proyecto.</li>
								<li>Con quién se realizará la colaboración (Proemio).</li>
								<li>Los actos previos que dan origen al convenio (Antecedentes).</li>
								<li>Lugar y fecha de formalización del convenio (Suscripción).</li>
								<li>Objetivo del convenio.</li>
								<li>Compromisos de cada una de las partes.</li>
								<li>Anexo técnico en el que se describen las actividades y los plazos en las que éstas se desarrollarán.</li>
								<li>Fechas de inicio y de término del convenio (Vigencia).</li>
								<li>A quién pertenecerá la Propiedad intelectual, en su aspecto patrimonial.</li>
							</ul>	
						 </div>

					</div>

				</div>

				<!-- CÓMO-->
				<div class="accordion-item">
					<h2
						class="accordion-header"
						id="headingComo"
					>
						<button
							class="accordion-button collapsed"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="#collapseComo"
							aria-expanded="false"
							aria-controls="collapseComo"
						>
							2. ¿Cómo es el proceso de validaci&oacute;n jur&iacute;dica?
						</button>
					</h2>

					<div
						id="collapseComo"
						class="accordion-collapse collapse"
						aria-labelledby="headingComo"
						data-bs-parent="#accordionPreguntas"
					>
						<div class="accordion-body">
							<p>La validaci&oacute;n y el dictamen jur&iacute;dico pueden ser solicitados a dos dependencias universitarias distintas&comma; dependiendo la naturaleza del proyecto: 
								a la Coordinaci&oacute;n de la Investigaci&oacute;n Cient&iacute;fica o a la Direcci&oacute;n General de Asuntos Jur&iacute;dicos.</p>
							<p>La revisi&oacute;n que realiza el jur&iacute;dico se centra en que el instrumento contenga todo lo referido en los &ldquo;Lineamientos generales para la elaboraci&oacute;n 
								de instrumentos consensuales en los que la universidad sea parte&rdquor; publicados en Gaceta UNAM el 27 de junio de 2005&comma; as&iacute; como en el &ldquo;Acuerdo por 
								el que se establece el procedimiento de validaci&oacute;n&comma; registro y dep&oacute;sito de los convenios&comma; contratos y dem&aacute;s instrumentos consensuales en los que 
								la universidad sea parte&rdquor; publicados en Gaceta UNAM el 30 de mayo de 2005 y otros reglamentos federales y universitarios&comma; seg&uacute;n sea el caso.</p>
							<p>La revisi&oacute;n se refiere s&oacute;lo a la forma y contenido jur&iacute;dico del instrumento&comma; por lo que los compromisos sustantivos que se asumen con la celebraci&oacute;n del mismo&comma; 
								son responsabilidad exclusiva de las entidades universitarias que en el intervienen.</p>
						</div>
					</div>
				</div>
				
				<!-- SIN J VALIDACION -->
				<div class="accordion-item">
					<h2
						class="accordion-header"
						id="headingSinValidacion"
					>
						<button
							class="accordion-button collapsed"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="#collapseSinValidacion"
							aria-expanded="false"
							aria-controls="collapseSinValidacion"
						>
							3. ¿Puedo firmar el convenio sin que el jur&iacute;dico lo valide?
						</button>
					</h2>

					<div
						id="collapseSinValidacion"
						class="accordion-collapse collapse"
						aria-labelledby="headingSinValidacion"
						data-bs-parent="#accordionPreguntas"
					>
						<div class="accordion-body">
						<p>No. Es importante seguir los lineamientos establecidos por la UNAM en el &ldquo;Acuerdo por el que se establece el procedimiento de validaci&oacute;n&comma; 
							registro y dep&oacute;sito de los convenios&comma; contratos y dem&aacute;s instrumentos consensuales en los que la universidad sea parte&rdquor;.</p>
						</div>
					</div>
				</div>

				<!-- QUIEN DEBE FIRMAR-->
				<div class="accordion-item">

					<h2
						class="accordion-header"
						id="headingDebeFirmar"
					>
						<button
							class="accordion-button collapsed"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="#collapseDebeFirmar"
							aria-expanded="false"
							aria-controls="collapseDebeFirmar"
						>
							4. ¿Qui&eacute;n debe firmar el convenio?
						</button>

					</h2>


					<div
						id="collapseDebeFirmar"
						class="accordion-collapse collapse"
						aria-labelledby="headingDebeFirmar"
						data-bs-parent="#accordionPreguntas"
					>

						<div class="accordion-body">
							<p>En el caso de los institutos del Subsistema de la Investigación Científica, el poder de firma recae en el Coordinador de la Investigación Científica 
								con la asistencia del Director de la dependencia responsable del proyecto. Existen instrumentos consensuales que deben firmar el Rector, el Secretario General,
								o el Director General del Patrimonio Universitario, dependiendo la naturaleza de los compromisos.</p>
							<p>Encontrarás los detalles en: Acuerdo que Delega y Distribuye Competencias para la Suscripción de Convenios, Contratos y demás Instrumentos Consensuales en los
							que la Universidad sea parte, publicado en Gaceta UNAM el 23 de enero de 2003.</p>
							<a href="http://www.economia.unam.mx/publicaciones/nueva/normatividad/pdfs/acuerdodelegadistribuyecompetencias.pdf"
									target="_blank"
									rel="noopener noreferrer"
									class="btn btn-primary boton-fondo-verde"
							>
								VER
							</a>
						</div>

					</div>

				</div>

				<!-- DOCUMENTOS -->
				<div class="accordion-item">

					<h2
						class="accordion-header"
						id="headingDocumentos"
					>

						<button
							class="accordion-button collapsed"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="#collapseDocumentos"
							aria-expanded="false"
							aria-controls="collapseDocumentos"
						>
							5. Documentos que debo conocer para formalizaci&oacute;n de un instrumento consensual.
						</button>

					</h2>

					<div
						id="collapseDocumentos"
						class="accordion-collapse collapse"
						aria-labelledby="headingDocumentos"
						data-bs-parent="#accordionPreguntas"
					>

						<div class="accordion-body">
							<ol>
								<li>
									<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/LINEAMIENTOS-GENERALES-PARA-LA-ELABORACI%C3%93N-DEINSTRUMENTOS-CONSENSUALES.pdf"
									target="_blank"
									rel="noopener noreferrer"
									class="btn btn-primary boton-fondo-verde"
									>
										Lineamientos generales para la elaboración de instrumentos consensuales en los que la universidad sea parte
									</a>
								</li>
								<li>
									<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2018/10/acuerdo-para-depo%CC%81sito-y-registro.pdf"
									target="_blank"
									rel="noopener noreferrer"
									class="btn btn-primary boton-fondo-verde"
									>
										Acuerdo por el que se establece el procedimiento de validación, registro y depósito de los Convenios, Contratos y demás instrumentos 
										consensuales en que la Universidad sea parte
									</a>
								</li>
								<li>
									<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/ACUERDO-QUE-DELEGA-Y-DISTRIBUYE-COMPETENCIAS-PARALA-SUSCRIPCI%C3%93N-DE-CONVENIOS-CONTRATOS-Y-DEM%C3%81S-INSTRUMENTOSCONSENSUALES.pdf"
									target="_blank"
									rel="noopener noreferrer"
									class="btn btn-primary boton-fondo-verde"
									>
										Acuerdo que delega y distribuye competencias para la suscripción de Convenios, Contratos y demás Instrumentos Consensuales en los que la Universidad sea parte
									</a>
								</li>
								<li>
									<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/REGLAMENTO-DE-INGRESOS-EXTRAORDINARIOS.pdf"
									target="_blank"
									rel="noopener noreferrer"
									class="btn btn-primary boton-fondo-verde"
									>
										Reglamento de Ingresos Extraordinarios
									</a>
								</li>
								<li>
									<a href="https://www.atmosfera.unam.mx/wp-content/uploads/2017/06/reglamento_transparencia2016.pdf"
									target="_blank"
									rel="noopener noreferrer"
									class="btn btn-primary boton-fondo-verde"
									>
										Reglamento de Transparencia y Acceso a la Información Pública para la UNAM
									</a>
								</li>
							</ol>
						</div>
					</div>
				</div>
		
            </div>
		</div>	
		
    </div>
</div>


<?php require_once ROOT_PATH . '/includes/footer.php'; ?>