						<div class="card-body bg-light text-dark">
							<div class="d-grid gap-2">
								<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#buscarPAdm" aria-expanded="false" aria-controls="collapseExample">
									Buscar Personal Administrativo
								</button>					
								<div class="collapse" id="buscarPAdm">
									<div class="card card-body">
									<input type="text" id="buscador1" class="form-control mb-3" placeholder="Buscar por nombre o correo ">
										<table class="table table-bordered">
											<thead class="table-dark">
												<tr>
													<th>Nombre</th>
													<th>Correo</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody id="tablaCuerpo1">
												<?php 
												while ($rowadm = $resultadm->fetch_assoc()): 
													$correo1 = $rowadm['correo'] ?? '';
													$grado_academico1 = $rowadm['grado_academico'] ?? '';
													$nombre1 = trim(($rowadm['nombres'] ?? '') . ' ' . ($rowadm['apellido_paterno'] ?? '') . ' ' . ($rowadm['apellido_materno'] ?? ''));
													$nombrec1 = $rowadm['nombre'] ?? '';
													
													
										
												?>
												<tr>
													<td><?php echo htmlspecialchars($nombre1."/".$nombrec1); ?></td>
													<td><?php echo htmlspecialchars($correo1); ?></td>												
													<td>
														
														<a class='btn btn-info' href='personal/editar_personal_admin.php?id=<?=$rowadm["id_personal"];?>' style='text-decoration:none'>Editar</a>												
														<?php if($rowadm['activo']== 1 ){ ?>
															<a class='btn btn-warning' href='personal.php?ok=2&id=<?=$rowadm["id_personal"];?>' style='text-decoration:none'>Desactivar</a>												
														<?php } else { ?>
															<a class='btn btn-success' href='personal.php?ok=1&id=<?=$rowadm["id_personal"];?>' style='text-decoration:none'>Activar</a>
														<?php } ?>
													</td>
												</tr>
												<?php endwhile; ?>
											</tbody>
										</table>

									
									</div>
								</div>
							
								<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#crearPAdm" aria-expanded="false" aria-controls="collapseExample">
									A&ntilde;adir Nuevo Personal Administrativo
								</button>
							
							<div class="collapse" id="crearPAdm">
								<div class="card card-body">
								

						<form id="registroForm" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=4"); ?>">
									<input type="text" class="form-control" name="tipo_personal" value="2" readonly hidden>
								
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
											 pattern="[a-zA-Z0-9._%+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" >
										<div class="invalid-feedback">Ingrese un correo válido.</div>
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Tel&eacute;fono:</span>
										<input type="telefono" class="form-control" placeholder="5512344567" aria-label="telefono"
											aria-describedby="basic-addon1" name="telefono"
											  >										
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">Extensi&oacute;n:</span>
										<input type="telefono" class="form-control" placeholder="01234" aria-label="telefono"
											aria-describedby="basic-addon1" name="extension"
											  >										
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
								
														
						<input type="submit" class="btn btn-primary"value="Actualizar">
						</form>
						<br>
								</div>
							</div>					
							<br>
						
				
							</div>
						</div>
