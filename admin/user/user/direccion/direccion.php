<div class="card-body bg-light text-dark">                       					  
	<div class="d-grid gap-2">					
		<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#IntegrantesD" aria-expanded="false" aria-controls="IntegrantesD">
			 Integrantes
		</button>					
		<div class="collapse" id="IntegrantesD">
			<div class="card card-body">
				<input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar por nombre o correo ">
				<table class="table table-bordered">
					<thead class="table-dark">
						<tr>
							<th>Tipo</th>
							<th>Nombre</th>
							<th>Cargo</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="tablaCuerpo">
						<?php 
							while ($rowdir = $resultdir->fetch_assoc()): 
							$cargo = $rowdir['Cargo'] ?? '';
							$rol = $rowdir['rol'] ?? '';
							//$nombre = trim(($rowasi['nombres'] ?? '') . ' ' . ($rowasi['apellido_paterno'] ?? '') . ' ' . ($rowasi['apellido_materno'] ?? ''));
							$nombrec = $rowdir['nombre'] ?? '';
						?>
						<tr>
							<td><?php echo ucfirst(htmlspecialchars($rol)); ?></td>
							<td><?php echo ucfirst(htmlspecialchars($nombrec)); ?></td>
							<td><?php echo ucfirst(htmlspecialchars($cargo)); ?></td>
							<td>
								<a class='btn btn-danger' href='adscripciones.php?ok=6&area=5&id=<?=$rowdir["ips"];?>' style='text-decoration:none'>Quitar</a>												
								
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>

<button class="btn btn-primary" type="button"
    data-bs-toggle="collapse"
    data-bs-target="#aiaD"
    aria-expanded="false"
    aria-controls="aiaD">
    Añadir integrante administrativo
</button>

<div class="collapse" id="aiaD">
    <div class="card card-body">

        <form action="adscripciones.php?ok=8&area=5&sa=1&in=3&tp=2" method="POST">

            <input type="text" id="buscador1"
                class="form-control mb-3"
                placeholder="Buscar por nombre">
				<div class="text-start">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-person-plus"></i>
                    Añadir seleccionados
                </button>
            </div>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Seleccionar</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                      
                    </tr>
                </thead>

                <tbody id="tablaCuerpo1">
                    <?php
                    $npd = "SELECT p.nombre, p.id_personal,
                                   c.nombre AS cargo
                            FROM personal p
                            LEFT JOIN cargos c
                                ON p.cargo = c.id_cargo
                            WHERE p.id_personal NOT IN (
                                SELECT ps.id_personal
                                FROM personal_secretarias ps
                                WHERE ps.id_secretarias = 3
                            )
                            AND p.id_tipo_personal = 2 AND p.activo = 1
                            ORDER BY p.nombre ASC";

                    $resultnpd = $connect->query($npd);

                    while ($rownpd = $resultnpd->fetch_assoc()):
                        $cargo = $rownpd['cargo'] ?? '';
                        $id = $rownpd['id_personal'];
                        $nombrec = $rownpd['nombre'] ?? '';
                    ?>

                    <tr>
                        <td>
                            <input type="checkbox"
                                name="personal[]"
                                value="<?= (int)$id; ?>">
                        </td>

                        <td>
                            <?= ucfirst(htmlspecialchars($nombrec)); ?>
                        </td>

                        <td>
                            <?= ucfirst(htmlspecialchars($cargo)); ?>
                        </td>

                        
                    </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>

            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-person-plus"></i>
                    Añadir seleccionados
                </button>
            </div>

        </form>

    </div>
</div>
				
		<br>
	</div>
</div>
