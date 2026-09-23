<?php
	require 'conexion.php';

	$columns = ['id_registro','nombre','apellido_paterno','apellido_materno', 'correo1','correo2','num_trabajador','num_cuenta'];
	$table = 'registros';
	
	if(isset($_POST['campo'])){
		$campo = $conn->real_escape_string($_POST['campo']);
	} else { $campo = null;}
	
	$where ="";
	if($campo != null){
		$where = " WHERE (";
		
		$count = count($columns);
		for($i = 0; $i < $count; $i++){
			$where .= $columns[$i]. " LIKE '%".$campo."%' OR ";
		}
		$where = substr_replace($where,"",- 3);
		$where .= ") ";
	}
	$sql = "SELECT ".implode(", ", $columns) . " FROM " . $table.$where." LIMIT 5";
	//echo $sql;
	$resultados = $conn->query($sql);
	$num_rows= $resultados->num_rows;
	$html = '';
	if($num_rows > 0){
		while($row = $resultados->fetch_assoc()){
			$html .= '<tr>';
			$html .= '<td>'.$row['nombre'].'</td>';
			$html .= '<td>'.$row['apellido_paterno'].'</td>';
			$html .= '<td>'.$row['apellido_materno'].'</td>';
			$html .= '<td>'.$row['correo1'].'</td>';
			$html .= '<td>'.$row['correo2'].'</td>';
			$html .= '<td>'.$row['num_trabajador'].'</td>';
			$html .= '<td>'.$row['num_cuenta'].'</td>';
			$html .='<td><button type="button" style="position:right"class="btn btn-warning "><a style="text-decoration:none;color:#fff;" href="editar_registro.php?id='.$row["id_registro"].'">
			<span class="glyphicon glyphicon-pencil " aria-hidden="true"></span> Editar</a>
			</button></td>';
			$html .= '</tr>';
		}
	} else {
		$html .= '<tr><td colspan="7"><center>Sin coincidencias</center></td></tr>';
	}
	echo json_encode($html,JSON_UNESCAPED_UNICODE);
?>