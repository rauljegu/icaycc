<div class="card-body bg-light text-dark">                       					  
	<div class="d-grid gap-2">					
		<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#buscarPA" aria-expanded="false" aria-controls="collapseExample">
			Buscar Personal Acádemico
		</button>					
		<div class="collapse" id="buscarPA">
			<div class="card card-body">
				<input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar por nombre o correo ">
				<table class="table table-bordered">
					<thead class="table-dark">
						<tr>
							<th>Nombre</th>
							<th>Correo</th>
							<th>Grado Académico</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="tablaCuerpo">
						<?php 
							while ($rowasi = $resultasi->fetch_assoc()): 
							$correo = $rowasi['correo'] ?? '';
							$grado_academico = $rowasi['grado_academico'] ?? '';
							$nombre = trim(($rowasi['nombres'] ?? '') . ' ' . ($rowasi['apellido_paterno'] ?? '') . ' ' . ($rowasi['apellido_materno'] ?? ''));
							$nombrec = $rowasi['nombre'] ?? '';
						?>
						<tr>
							<td><?php echo htmlspecialchars($nombre."/".$nombrec); ?></td>
							<td><?php echo htmlspecialchars($correo); ?></td>
							<td><?php echo htmlspecialchars($grado_academico); ?></td>
							<td>
								<a class='btn btn-info' href='personal/editar_personal.php?id=<?=$rowasi["id_personal"];?>' style='text-decoration:none'>Editar</a>												
								<?php if($rowasi['activo']== 1 ){ ?>
											<a class='btn btn-warning' href='personal.php?ok=2&id=<?=$rowasi["id_personal"];?>' style='text-decoration:none'>Desactivar</a>												
								<?php } else { ?>
											<a class='btn btn-success' href='personal.php?ok=1&id=<?=$rowasi["id_personal"];?>' style='text-decoration:none'>Activar</a>
								<?php } ?>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#crearPPA" aria-expanded="false" aria-controls="collapseExample">
			A&ntilde;adir Nuevo Personal Académico
		</button>
		<div class="collapse" id="crearPPA">
			<div class="card card-body">
				<form id="registroForm" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?eq=3"); ?>">
				<input type="text" class="form-control" name="tipo_personal" value="1" readonly hidden>
					<div class="input-group mb-3">
						<span class="input-group-text">Nombre(s) Apellidos</span>
						<input type="text" class="form-control" name="name" placeholder="Nombre" required>
						<input type="text" class="form-control" name="paterno" placeholder="Ap. Paterno" required>
						<input type="text" class="form-control" name="materno" placeholder="Ap. Materno">
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
							<option value="">Seleccione un grado académico</option>
							<option value="Licenciatura">Licenciatura</option>
							<option value="Maestría">Maestría</option>
							<option value="Doctorado">Doctorado</option>
							<option value="Sin estudios profesionales">Sin estudios profesionales</option>
						</select>
					</div>
					<!--Categoria-->
					<div class="col-4">
						<label for="categoria" class="form-label">Categoría</label>
						<select name="categoria" id="categoria" class="form-select" required>
							<option value="0" selected>Seleccione una categoría</option>
							<?php
								//$cate= $row1["id_categoria_personal"];
								$sqlcat="SELECT id_categoria, nombre FROM categoria_personal WHERE activo = 1";
								include '../../includes/connect.php';
								$connect = $conn;
								//echo $sqlcat;
								$resultcat = $conn->query($sqlcat);
								if ($resultcat->num_rows > 0) {
									while($rowcat= $resultcat->fetch_assoc()) { ?>																										
										<option value="<?=$rowcat["id_categoria"]?>" >
											<?php echo $rowcat["nombre"]; ?>
										</option>
							<?php 	}
								}  
								?>																							
						</select>
					</div>
					<!--Nivel-->
					<div class="col-4">
						<label for="nivel" class="form-label">Nivel</label>
						<select name="nivel" id="nivel" class="form-select" required>
							<option value="0"selected>Seleccione un nivel</option>
							<?php								
								$sqlniv="SELECT id_nivel, nivel FROM nivel
								WHERE activo = 1";
								include '../../includes/connect.php';
								$connect = $conn;
								//echo $sqlniv;
								$resultniv = $conn->query($sqlniv);
								if ($resultniv->num_rows > 0) {
									while($rowniv= $resultniv->fetch_assoc()) { ?>																										
										<option value="<?=$rowniv["id_nivel"]?>" >
											<?php echo $rowniv["nivel"]; ?>
										</option>
							<?php 	}
								} 
								?>																							
						</select>
					</div>
					<!--Subnivel-->
					<div class="col-4">
						<label for="subnivel" class="form-label">Subnivel</label>
						<select name="subnivel" id="subnivel" class="form-select" required>
							<option value="0" selected>Seleccione un subbnivel</option>
							<?php
								$sqlsniv="SELECT id_sub_nivel, subnivel FROM sub_nivel WHERE activo = 1";
								include '../../includes/connect.php';
								$connect = $conn;
								//echo $sqlsniv;
								$resultsniv = $conn->query($sqlsniv);
								if ($resultsniv->num_rows > 0) {
									while($rowsniv= $resultsniv->fetch_assoc()) { ?>																										
										<option value="<?=$rowsniv["id_sub_nivel"]?>" >
											<?php echo $rowsniv["subnivel"]; ?>
										</option>
							<?php 	}
								} 
								?>																							
						</select>
					</div>
					<!-- Perfiles académicos -->
					<div class="col-12">
						<div class="row g-3">
							<h3>Perfiles acad&eacute;micos</h3>
							<!-- Google Scholar -->
							<div class="col-12 col-md-6 col-xl-3">
								<label for="scholar" class="form-label">Google Scholar</label>
								<input type="text" name="scholar" id="scholar" class="form-control" placeholder="Google Scholar">
							</div>
							<!-- ID SIIA -->
							<div class="col-12 col-md-6 col-xl-3">
								<label for="scholar" class="form-label">ID SIIA</label>
								<input type="text" name="siia" id="siia" class="form-control" placeholder="ID SIIA">
							</div>
							<!-- ResearchGate -->
							<div class="col-12 col-md-6 col-xl-3">
								<label for="researchgate" class="form-label">ResearchGate</label>
								<input type="text" name="researchgate" id="researchgate" class="form-control" placeholder="ResearchGate">
							</div>
							<!-- ORCID -->
							<div class="col-12 col-md-6 col-xl-3">
								<label for="orcid" class="form-label">ORCID</label>
								<input type="text" name="orcid" id="orcid" class="form-control" placeholder="ORCID">
							</div>
							<!-- Scopus -->
							<div class="col-12 col-md-6 col-xl-3">
								<label for="scopus" class="form-label">Scopus</label>
								<input type="text" name="scopus" id="scopus" class="form-control" placeholder="Scopus">
							</div>
						</div>
					</div>

					<div class="col-12">
						<span class="input-group-text"><h3>Semblanza</h3></span>
						<textarea name="semblanza" class="form-control" placeholder="Rese&ntilde;a"></textarea>
					</div>
					<!--Departamento -->
					<h3>Adscripci&oacute;n</h3>
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
							<?php	} 
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
							<?php	} 
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
							<?php	} 
								} 
							?>																							
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
