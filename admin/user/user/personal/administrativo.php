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
								
									<h3>Adscripci&oacute;n</h3>
									<p>(Puede dejar sin llenar esta secci&oacute;n y asignar al personal  despúes por Secretaria, Departamento, Grupo, etc. según corresponda)</p>
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
									<!--Departamento -->
									
									<div class="col-12">
										<label for="Departamento" class="form-label">Departamento</label>
										<select name="departamento" id="Departamento" class="form-select" required>
											<option value="0">Seleccione un departamento</option>
											
											<?php 	 
													$sql3="SELECT id_departamento, nombre FROM departamentos  ORDER BY nombre ASC";
													
													
													//echo $sql2;
														$result3 = $conn->query($sql3);
													if ($result3->num_rows > 0) {
														while($row3= $result3->fetch_assoc()) { ?>																										
															<option value="<?=$row3["id_departamento"]?>">
																<?php echo $row3["nombre"]; ?>
															</option>
										<?php			} 
													} 
												?>																							
										</select>
									</div>
									<!--Grupo -->
									<div class="col-12">
										<label for="Grupo" class="form-label">Grupo</label>
										<select name="grupo" id="Grupo" class="form-select" required>
											<option value="0">Seleccione un Grupo</option>
											
											<?php 
													$sql5="SELECT id_grupo, nombre FROM grupos  ORDER BY nombre ASC";
													
													
													//echo $sql5;
														$result5 = $conn->query($sql5);
													if ($result5->num_rows > 0) {
														while($row5= $result5->fetch_assoc()) { ?>																										
															<option value="<?=$row5["id_grupo"]?>">
																<?php echo $row5["nombre"]; ?>
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
