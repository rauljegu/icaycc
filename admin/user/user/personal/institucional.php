						<div class="card-body bg-light text-dark">
							<div class="d-grid gap-2">
								<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#buscarPIns" aria-expanded="false" aria-controls="collapseExample">
									Buscar Personal Institucional
								</button>					
								<div class="collapse" id="buscarPIns">
									<div class="card card-body">
									<input type="text" id="buscador2" class="form-control mb-3" placeholder="Buscar por nombre o correo ">
										<table class="table table-bordered">
											<thead class="table-dark">
												<tr>
													<th>Nombre</th>
													<th>Correo</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody id="tablaCuerpo2">
												<?php 
												while ($rowins = $resultins->fetch_assoc()): 
													$correo2 = $rowins['correo'] ?? '';
													$grado_academico2 = $rowins['grado_academico'] ?? '';
													$nombre2 = trim(($rowins['nombres'] ?? '') . ' ' . ($rowins['apellido_paterno'] ?? '') . ' ' . ($rowins['apellido_materno'] ?? ''));
													$nombrec2 = $rowins['nombre'] ?? '';
													
													
										
												?>
												<tr>
													<td><?php echo htmlspecialchars($nombre2."/".$nombrec2); ?></td>
													<td><?php echo htmlspecialchars($correo2); ?></td>												
													<td>
														
														<a class='btn btn-info' href='personal/editar_personal_inst.php?id=<?=$rowins["id_personal"];?>' style='text-decoration:none'>Editar</a>												
														<?php if($rowins['activo']== 1 ){ ?>
															<a class='btn btn-warning' href='personal.php?ok=2&id=<?=$rowins["id_personal"];?>' style='text-decoration:none'>Desactivar</a>												
														<?php } else { ?>
															<a class='btn btn-success' href='personal.php?ok=1&id=<?=$rowins["id_personal"];?>' style='text-decoration:none'>Activar</a>
														<?php } ?>
													</td>
												</tr>
												<?php endwhile; ?>
											</tbody>
										</table>

									
									</div>
								</div>
							
								<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample0" aria-expanded="false" aria-controls="collapseExample">
									A&ntilde;adir Nuevo Personal Institucional
								</button>
							
							<div class="collapse" id="collapseExample0">
								<div class="card card-body">
								<h3>Si el personal es Investigador, Profesor o T&eacute;cnico Acad&eacute;mico, cree su perfil como acad&eacute;mico (solo si aún no tiene perfil de acad&eacute;mico)</h3>

						<form id="registroForm" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=3"); ?>">
						
								<input type="text" class="form-control" name="tipo_personal" value="3" readonly hidden>
								    <div class="input-group mb-3">
										<span class="input-group-text">Nombre(s) Apellidos</span>
										<input type="text" class="form-control" name="name"  required>
										<input type="text" class="form-control" name="paterno"  required>
										<input type="text" class="form-control" name="materno">
										<div class="invalid-feedback">Todos los campos de nombre y apellidos son obligatorios.</div>
									</div>

									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Correo/usuario @</span>
										<input type="email" class="form-control" placeholder="user@server.com" aria-label="Username"
											aria-describedby="basic-addon1" name="correo" 
											 pattern="[a-zA-Z0-9._%+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
										<div class="invalid-feedback">Ingrese un correo válido.</div>
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Tel&eacute;fono:</span>
										<input type="telefono" class="form-control" placeholder="5512344567" aria-label="telefono"
											aria-describedby="basic-addon1" name="telefono"
											  required>										
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Extensi&oacute;n:</span>
										<input type="telefono" class="form-control" placeholder="01234" aria-label="telefono"
											aria-describedby="basic-addon1" name="extension"
											  required>										
									</div>
									
									<!-- Grado académico -->
									<div class="col-12">
										<label for="grado" class="form-label">Grado académico</label>
										<select name="grado" id="grado" class="form-select" required>
											<option value="Sin estudios profesionales">Seleccione un grado académico</option>
											<option value="Licenciatura">
												Licenciatura
											</option>
											<option value="Maestría">
												Maestría
											</option>
											<option value="Doctorado">
												Doctorado
											</option>
											<option value="Sin estudios profesionales">
												Sin estudios profesionales
											</option>
										</select>
									</div>
				<h3>Cargos</h3>
					<!--Cargos -->
					<div class="col-12">
						<label for="cargos" class="form-label">Cargo</label>
						<select name="cargo" id="cargos" class="form-select" required>
							<option value="3" selected>Seleccione un cargo</option>
							<?php
								$cargo="SELECT id_cargo, nombre FROM cargos WHERE activo =1";
								include '../../includes/connect.php';
								$connect = $conn;
								//echo $sql6;
								$resultcargo = $conn->query($cargo);
								if ($resultcargo->num_rows > 0) {
									while($rowcargo= $resultcargo->fetch_assoc()) { ?>																										
										<option value="<?=$rowcargo["id_cargo"]?>" >
											<?php echo $rowcargo["nombre"]; ?>
										</option>
							<?php 	}
								} 
								?>																							
						</select>
					</div>
								<h3>Adscripción</h3>
					<!--Secretarias -->
									
									<div class="col-12">
										<label for="Secretarias" class="form-label">Secretarias</label>
										<select name="secretarias" id="Secretarias" class="form-select" required>
											<option value="0">Seleccione una Secretaria</option>
											
											<?php 	 
													$sqlsec="SELECT id_secretarias, nombre FROM secretarias  ORDER BY nombre ASC";
													
													
													//echo $sql2;
														$resultsec = $conn->query($sqlsec);
													if ($resultsec->num_rows > 0) {
														while($rowsec= $resultsec->fetch_assoc()) { ?>																										
															<option value="<?=$rowsec["id_secretarias"]?>">
																<?php echo $rowsec["nombre"]; ?>
															</option>
										<?php			} 
													} 
												?>																							
										</select>
									</div>

										<!--Unidades -->
									<div class="col-12">
										<label for="Unidades" class="form-label">Unidades de Apoyo</label>
										<select name="unidades" id="Unidades" class="form-select" required>
											<option value="0">Seleccione una Unidad de Apoyo</option>
											
											<?php 	
													$sql7="SELECT id_unidades, nombre FROM unidades  ORDER BY nombre ASC";
													
													
													//echo $sql7;
														$result7 = $conn->query($sql7);
													if ($result7->num_rows > 0) {
														while($row7= $result7->fetch_assoc()) { ?>																										
															<option value="<?=$row7["id_unidades"]?>">
																<?php echo $row7["nombre"]; ?>
															</option>
										<?php			} 
													} 
												?>																							
										</select>
									</div>

						
						<input type="submit" class="btn btn-primary"value="Actualizar">
						</form>
						<br>
								</div>
							</div>					
							<br>
						
				
							</div>
						</div>
