<?php 
	$sql2 = "
			SELECT
			b.*,
			bp.contenido
			FROM bienvenida_pestanas b
			INNER JOIN bienvenida_pestanas_contenido bp
			ON b.id_pest = bp.id_pest
			WHERE b.activo = 1 
			ORDER BY b.orden ASC
			";
	//echo $sql;
	$stmt2 = $pdo->prepare($sql2);
	$stmt2->execute();
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
	if($row2['id_pest'] ==1){ $active_p2=" show active"; } else { $active_p2 = ""; }
?>
<!-- ================================= -->
<!-- Que hacemos -->
<!-- ================================= -->
<div
	class="tab-pane <?=$active_p2;?>"
	id="nav-<?=htmlspecialchars($row2['id_pest']);?>"
	role="tabpanel"
	aria-labelledby="nav-<?=htmlspecialchars($row2['id_pest']);?>-tab"
	tabindex="0"
>
	<div class="d-grid gap-4 mt-4">
		<div class="card shadow-sm">
			<div class="card-body card-text">
				<div style="white-space: pre-line;">
					 <?=nl2br(htmlspecialchars($row2['contenido']));?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
