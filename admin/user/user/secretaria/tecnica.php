<div class="card-body bg-light text-dark">                       					  
	<div class="d-grid gap-2">					
		<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#IntegrantesST" aria-expanded="false" aria-controls="IntegrantesST">
			 Integrantes
		</button>					
		<div class="collapse" id="IntegrantesST">
			<div class="card card-body">
				<input type="text" id="buscador4" class="form-control mb-3" placeholder="Buscar por nombre o correo ">
				<table class="table table-bordered">
					<thead class="table-dark">
						<tr>
							<th>Tipo</th>
							<th>Nombre</th>
							<th>Cargo</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="tablaCuerpo4">
						<?php 
							while ($rowtec = $resulttec->fetch_assoc()): 
							$cargo = $rowtec['Cargo'] ?? '';
							$rol = $rowtec['rol'] ?? '';
							//$nombre = trim(($rowasi['nombres'] ?? '') . ' ' . ($rowasi['apellido_paterno'] ?? '') . ' ' . ($rowasi['apellido_materno'] ?? ''));
							$nombrec = $rowtec['nombre'] ?? '';
						?>
						<tr>
							<td><?php echo ucfirst(htmlspecialchars($rol)); ?></td>
							<td><?php echo ucfirst(htmlspecialchars($nombrec)); ?></td>
							<td><?php echo ucfirst(htmlspecialchars($cargo)); ?></td>
							<td>
								<a class='btn btn-danger' href='adscripciones.php?ok=6&area=1&id=<?=$rowtec["ips"];?>' style='text-decoration:none'>Quitar</a>												
								
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>

<button class="btn btn-primary" type="button"
    data-bs-toggle="collapse"
    data-bs-target="#aiaST"
    aria-expanded="false"
    aria-controls="aiaST">
    Añadir integrante administrativo
</button>

<div class="collapse" id="aiaST">
    <div class="card card-body">

        <form action="adscripciones.php?ok=8&area=1&sa=3&in=3&tp=2" method="POST">

            <input type="text" id="buscador5"
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

                <tbody id="tablaCuerpo5">
                    <?php
                    $npt = "SELECT p.nombre, p.id_personal,
                                   c.nombre AS cargo
                            FROM personal p
                            LEFT JOIN cargos c
                                ON p.cargo = c.id_cargo
                            WHERE p.id_personal NOT IN (
                                SELECT ps.id_personal
                                FROM personal_secretarias ps
                                WHERE ps.id_secretarias = 3
                            )
                            AND p.id_tipo_personal = 2
                            ORDER BY p.nombre ASC";

                    $resultnpt = $connect->query($npt);

                    while ($rownpt = $resultnpt->fetch_assoc()):
                        $cargo = $rownpt['cargo'] ?? '';
                        $id = $rownpt['id_personal'];
                        $nombrec = $rownpt['nombre'] ?? '';
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
