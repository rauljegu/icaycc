<?php 
	$perdep="SELECT p.id_personal AS NoPersonal, p.nombre, p.id_tipo_personal, id.id AS ips, tp.tipo, id.rol  
	FROM personal p 
	INNER JOIN investigador_departamento id ON p.id_personal = id.id_investigador
	LEFT JOIN tipo_personal tp ON p.id_tipo_personal=tp.id_tipo_personal
	WHERE p.activo = 1 AND id.id_departamento = $iddepto 
	ORDER BY id.rol ASC,`p`.`nombre` ASC;
;";
	$resultperdep= $connect->query($perdep);
	if ($resultperdep === false) {
		die("Error en la consulta: " . $connect->error);
	}
?>


<div class="card-body bg-light text-dark">                       					  
	<div class="d-grid gap-2">					
		<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#Integrantes<?=$iddepto;?>" aria-expanded="false" aria-controls="Integrantes<?=$iddepto;?>">
			 Integrantes del Departamento
		</button>					
		<div class="collapse" id="Integrantes<?=$iddepto;?>">
			<div class="card card-body">
				<!--<input type="text" id="buscadorA<?=$iddepto;?>" class="form-control mb-3" placeholder="Buscar por nombre o correo ">-->
				<input type="text" id="buscadorA<?=$iddepto;?>" data-filter-table="tablaCuerpoA<?=$iddepto;?>" data-filter-columns="0,1,2" class="form-control mb-3" placeholder="Buscar por nombre, tipo o rol">
				<table class="table table-bordered">
					<thead class="table-dark">
						<tr>
							<th>Nombre</th>
							<th>Tipo</th>
							<th>Rol</th>							
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="tablaCuerpoA<?=$iddepto;?>">
						<?php 
							while ($rowperdep = $resultperdep->fetch_assoc()): 
							$tipo = $rowperdep['tipo'] ?? '';
							$rol = $rowperdep['rol'] ?? '';
							$nombrec = $rowperdep['nombre'] ?? '';
						?>
						<tr>
							<td><?php echo ucfirst(htmlspecialchars($nombrec)); ?></td>
							<td><?php echo ucfirst(htmlspecialchars($tipo)); ?></td>
							<td><?php echo ucfirst(htmlspecialchars($rol)); ?></td>
							<td>
								<a class='btn btn-danger' href='adscripciones.php?ok=6&area=4&id=<?=$rowperdep["ips"];?>' style='text-decoration:none'>Quitar</a>												
								
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
<button class="btn btn-primary" type="button"
    data-bs-toggle="collapse"
    data-bs-target="#aia<?=$iddepto;?>"
    aria-expanded="false"
    aria-controls="aia<?=$iddepto;?>">
    Añadir Acad&eacute;mico al Departamento
</button>

<div class="collapse" id="aia<?=$iddepto;?>">
    <div class="card card-body">

        <form action="adscripciones.php?ok=8&area=4&sa=<?=$iddepto;?>&in=2&tp=1" method="POST">

           <!-- <input type="text" id="buscadorB<?=$iddepto;?>" class="form-control mb-3" placeholder="Buscar por nombre">-->
			<input type="text"    id="buscadorB<?=$iddepto;?>" data-filter-table="tablaCuerpoB<?=$iddepto;?>" data-filter-columns="1,2" class="form-control mb-3" placeholder="Buscar por nombre o tipo">	
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

                <tbody id="tablaCuerpoB<?=$iddepto;?>">
                    <?php
                    $npt = "SELECT p.nombre, p.id_personal, tp.tipo 
					FROM personal p 
					LEFT JOIN tipo_personal tp ON p.id_tipo_personal=tp.id_tipo_personal 
					WHERE p.id_personal 
					NOT IN ( SELECT id.id_investigador FROM investigador_departamento id WHERE id.id_departamento = $iddepto ) 
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
    data-bs-target="#aiad<?=$iddepto;?>"
    aria-expanded="false"
    aria-controls="aiad<?=$iddepto;?>">
    Añadir Administrativo al Departamento
</button>

<div class="collapse" id="aiad<?=$iddepto;?>">
    <div class="card card-body">

        <form action="adscripciones.php?ok=8&area=4&sa=<?=$iddepto;?>&in=3&tp=2" method="POST">

           <!-- <input type="text" id="buscadorC<?=$iddepto;?>" class="form-control mb-3" placeholder="Buscar por nombre">-->
			<input type="text" id="buscadorC<?=$iddepto;?>" data-filter-table="tablaCuerpoC<?=$iddepto;?>" data-filter-columns="1,2" class="form-control mb-3" placeholder="Buscar por nombre o tipo">
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

                <tbody id="tablaCuerpoC<?=$iddepto;?>">
                    <?php
                    $npt = "SELECT p.nombre, p.id_personal, tp.tipo 
					FROM personal p 
					LEFT JOIN tipo_personal tp ON p.id_tipo_personal=tp.id_tipo_personal 
					WHERE p.id_personal 
					NOT IN ( SELECT id.id_investigador FROM investigador_departamento id WHERE id.id_departamento = $iddepto ) 
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
