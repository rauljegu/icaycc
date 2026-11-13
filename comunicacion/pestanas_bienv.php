<?php 
	$sql1 = "
			SELECT
			*
			FROM bienvenida_pestanas 
			WHERE activo = 1 
			ORDER BY orden ASC
			";
	//echo $sql;
	$stmt1 = $pdo->prepare($sql1);
	$stmt1->execute();
while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
	if($row['id_pest'] ==1){ $active_p="active"; } else { $active_p = ""; }
?>
	<button
		class="nav-link <?=$active_p;?> boton-fondo-verde"
		id="nav-<?=htmlspecialchars($row['id_pest']);?>-tab"
		data-bs-toggle="tab"
		data-bs-target="#nav-<?=htmlspecialchars($row['id_pest']);?>"
		type="button"
		role="tab"
		aria-controls="nav-<?=htmlspecialchars($row['id_pest']);?>"
		aria-selected="true"
		>
		<?=htmlspecialchars($row['nombre']);?>
	</button>
<?php } ?>	
