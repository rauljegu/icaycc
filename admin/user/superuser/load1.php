<?php
	require 'conexion.php';
	//var_dump($_POST);
	//HACEMOS CONSULTA A LA BASE PARA RECUPERAR LAS CABECERAS DE LA TABLA 
	$sql1= "SELECT * FROM registros LIMIT 1";
	$result = $conn->query($sql1);
		if(!$result){ 
                      $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
        } else {
					//echo '&iexcl;CONECTADO!';
					//$html="";
					if ($result->num_rows > 0) {
						while($row1= $result->fetch_assoc()) {
							//$row1 es un ARRAY que guarda todas las filas de la tabla consultada en formato $row1["nombre_columna"]
							//(donde los indices del ARRAY son los nombres de las columnas, y los valores los datos de cada fila)
							//Para rescatar el ARRAY $row1 es necesario guardarlo en una variable $data
							
							$data = $row1;
						}
						//var_dump($data);
						$cabeceras ="";
						$columns=[];
						foreach($data as $key =>$value){
							$cabeceras .= $key.", ";
							array_push($columns,$key);
						}
						//var_dump($columns);
						 $cabeceras = substr_replace($cabeceras,"",- 2);
						//echo $cabeceras;
						$count = count($columns);
						//echo $count;						
					} else {
						echo "No hay registros";
					}
				}
	
	//$table = 'registros';
	$table = $_POST['tabla'];
	if(isset($_POST['campo'])){
		$campo = $conn->real_escape_string($_POST['campo']);
	} else { $campo = null;}
	//$table = $_POST['tabla'];
	$where ="";
	if($campo != null){
		$where = " WHERE (";
		
		//$count = count($count);
		//echo $count;
		for($i = 0; $i < $count; $i++){
			$where .= $columns[$i]. " LIKE '%".$campo."%' OR ";
		}
		$where = substr_replace($where,"",- 3);
		$where .= ")";
	}
	//$sql = "SELECT ".implode(", ", $columns) . " FROM " . $table.$where;
	$sql = "SELECT ".$cabeceras . " FROM " . $table.$where;
	//echo $sql;
	$resultados = $conn->query($sql);
	$num_rows= $resultados->num_rows;
	$html = '';
	if($num_rows > 0){
		while($row = $resultados->fetch_assoc()){ $cab="";
			$html .= '<tr>';
			foreach($columns as $key =>$value){
																$html.="<td>".$row[$value]."</td>";
						}
						
			$html .= '</tr>';
		}
	} else {
		$html .= '<tr><td colspan="7"><center>Sin coincidencias</center></td></tr>';
	}
	echo json_encode($html,JSON_UNESCAPED_UNICODE);
?>