<?php 
	$pergpo="SELECT p.id_personal AS NoPersonal, p.nombre, p.id_tipo_personal, ig.id AS ips, tp.tipo, ig.rol  
	FROM personal p 
	INNER JOIN investigador_grupo ig ON p.id_personal = ig.id_investigador
	LEFT JOIN tipo_personal tp ON p.id_tipo_personal=tp.id_tipo_personal
	WHERE p.activo = 1 AND ig.id_grupo = $idgpo 
	ORDER BY ig.rol ASC,`p`.`nombre` ASC;
;";
	$resultpergpo= $connect->query($pergpo);
	if ($resultpergpo === false) {
		die("Error en la consulta: " . $connect->error);
	}
?>


<div class="card-body bg-light text-dark">                       					  
	<div class="d-grid gap-2">					
		<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#IntegrantesG<?=$idgpo;?>" aria-expanded="false" aria-controls="IntegrantesG<?=$idgpo;?>">
			 Integrantes del Grupo
		</button>					
		<div class="collapse" id="IntegrantesG<?=$idgpo;?>">
			<div class="card card-body">
				<!--<input type="text" id="buscadorA<?=$idgpo;?>" class="form-control mb-3" placeholder="Buscar por nombre o correo ">-->
				<input type="text" id="buscadorGA<?=$idgpo;?>" data-filter-table="tablaCuerpoGA<?=$idgpo;?>" data-filter-columns="0,1,2" class="form-control mb-3" placeholder="Buscar por nombre, tipo o rol">
				<table class="table table-bordered">
					<thead class="table-dark">
						<tr>
							<th>Nombre</th>
							<th>Tipo</th>
							<th>Rol</th>							
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="tablaCuerpoGA<?=$idgpo;?>">
						<?php 
							while ($rowpergpo = $resultpergpo->fetch_assoc()): 
							$tipo = $rowpergpo['tipo'] ?? '';
							$rol = $rowpergpo['rol'] ?? '';
							$nombrec = $rowpergpo['nombre'] ?? '';
						?>
						<tr>
							<td><?php echo ucfirst(htmlspecialchars($nombrec)); ?></td>
							<td><?php echo ucfirst(htmlspecialchars($tipo)); ?></td>
							<td><?php echo ucfirst(htmlspecialchars($rol)); ?></td>
							<td>
								<a class='btn btn-danger' href='adscripciones.php?ok=6&area=4&id=<?=$rowpergpo["ips"];?>' style='text-decoration:none'>Quitar</a>												
								
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
<button class="btn btn-primary" type="button"
    data-bs-toggle="collapse"
    data-bs-target="#aiaG<?=$idgpo;?>"
    aria-expanded="false"
    aria-controls="aiaG<?=$idgpo;?>">
    Añadir Acad&eacute;mico al Grupo
</button>

<div class="collapse" id="aiaG<?=$idgpo;?>">
    <div class="card card-body">

        <form action="adscripciones.php?ok=8&area=4&sa=<?=$idgpo;?>&in=2&tp=1" method="POST">

           <!-- <input type="text" id="buscadorB<?=$idgpo;?>" class="form-control mb-3" placeholder="Buscar por nombre">-->
			<input type="text"    id="buscadorGB<?=$idgpo;?>" data-filter-table="tablaCuerpoGB<?=$idgpo;?>" data-filter-columns="1,2" class="form-control mb-3" placeholder="Buscar por nombre o tipo">	
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
                        <th>Tipo</th>
                      
                    </tr>
                </thead>

                <tbody id="tablaCuerpoGB<?=$idgpo;?>">
                    <?php
                    $npt = "SELECT p.nombre, p.id_personal, tp.tipo 
					FROM personal p 
					LEFT JOIN tipo_personal tp ON p.id_tipo_personal=tp.id_tipo_personal 
					WHERE p.id_personal 
					NOT IN ( SELECT ig.id_investigador FROM investigador_grupo ig WHERE ig.id_grupo = $idgpo ) 
					AND p.activo = 1 AND p.id_tipo_personal = 1 ORDER BY p.nombre ASC;";

                    $resultnpt = $connect->query($npt);

                    while ($rownpt = $resultnpt->fetch_assoc()):
                        $tipo = $rownpt['tipo'] ?? '';
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
                            <?= ucfirst(htmlspecialchars($tipo)); ?>
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
	
<button class="btn btn-primary" type="button"
    data-bs-toggle="collapse"
    data-bs-target="#aiadG<?=$idgpo;?>"
    aria-expanded="false"
    aria-controls="aiadG<?=$idgpo;?>">
    Añadir Administrativo al Grupo
</button>

<div class="collapse" id="aiadG<?=$idgpo;?>">
    <div class="card card-body">

        <form action="adscripciones.php?ok=8&area=4&sa=<?=$idgpo;?>&in=3&tp=2" method="POST">

           <!-- <input type="text" id="buscadorC<?=$idgpo;?>" class="form-control mb-3" placeholder="Buscar por nombre">-->
			<input type="text" id="buscadorGC<?=$idgpo;?>" data-filter-table="tablaCuerpoGC<?=$idgpo;?>" data-filter-columns="1,2" class="form-control mb-3" placeholder="Buscar por nombre o tipo">
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
                        <th>Tipo</th>
                      
                    </tr>
                </thead>

                <tbody id="tablaCuerpoGC<?=$idgpo;?>">
                    <?php
                    $npt = "SELECT p.nombre, p.id_personal, tp.tipo 
					FROM personal p 
					LEFT JOIN tipo_personal tp ON p.id_tipo_personal=tp.id_tipo_personal 
					WHERE p.id_personal 
					NOT IN ( SELECT ig.id_investigador FROM investigador_grupo ig WHERE ig.id_grupo = $idgpo ) 
					AND p.activo = 1 AND p.id_tipo_personal = 2 ORDER BY p.nombre ASC;";

                    $resultnpt = $connect->query($npt);

                    while ($rownpt = $resultnpt->fetch_assoc()):
                        $tipo = $rownpt['tipo'] ?? '';
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
                            <?= ucfirst(htmlspecialchars($tipo)); ?>
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
