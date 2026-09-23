<?php

include('conexion.php');

$fileContacts = $_FILES['fileContacts']; 
$fileContacts = file_get_contents($fileContacts['tmp_name']); 

$fileContacts = explode("\n", $fileContacts);
$fileContacts = array_filter($fileContacts); 
//var_dump($fileContacts);
unset($fileContacts[0],$fileContacts[1]);
//return $fileContacts;
//var_dump($fileContacts);
 function limpiar($datos){
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
// preparar contactos (convertirlos en array)
foreach ($fileContacts as $registro) 
{
	$Registros[] = explode(",", limpiar($registro));
}

// insertar contactos
foreach ($Registros as $contactData) 
{
	 $validador = $contactData[6];
	$sql="SELECT * FROM registros WHERE curp = '$validador'";
	//echo $sql."\n";
	$result = $conn->query($sql);
	if ($result->num_rows == 0) {
	include('conexion.php');
	$sql1="INSERT INTO registros SET
							nombre = '{$contactData[0]}',
							apellido_paterno = '{$contactData[1]}',
							apellido_materno = '{$contactData[2]}',
							genero = '{$contactData[3]}',
							genero_otro ='{$contactData[4]}',
							fecha_nac ='{$contactData[5]}',
							curp ='{$contactData[6]}',
							rfc ='{$contactData[7]}',
							num_trabajador ='{$contactData[8]}',
							num_cuenta ='{$contactData[9]}',
							talla_bata  ='{$contactData[10]}',
							correo1 ='{$contactData[11]}',
							correo2 ='{$contactData[12]}',
							tel1  ='{$contactData[13]}',
							tel2  ='{$contactData[14]}',
							licenciatura  ='{$contactData[15]}',
							maestria  ='{$contactData[16]}',
							doctorado  ='{$contactData[17]}',
							Especialidad =  '{$contactData[18]}',
							appaunam  = '{$contactData[19]}',
							ultimo_grado  ='{$contactData[20]}',
							ingreso  ='{$contactData[21]}',
							nombramiento ='{$contactData[22]}'
						 ";
						// echo $sql1;
		$resultado = $conn->query($sql1);						 
		if(!$resultado){ //SI: NO TRUE (FALSE)
                          $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
                          } else {
									// SI: NO FALSE (TRUE)
									//   echo 'exito \n';
									$sqlp = "INSERT INTO users SET 
									name = '{$contactData[0]}',
									materno = '{$contactData[2]}',
									paterno = '{$contactData[1]}',
									login = '{$contactData[6]}',
									password = 'b91acdbb05474e6108a3a84ded903de7',
									role = '3',
									correo = '{$contactData[11]}',
									departamento = '19',
									activo = 1
									";
									include'conexion.php';
								 //Envio la consulta sql
								 $resultadop = $conn->query($sqlp); // si hay conexion TRUE // si no hay conexion // FALSE
								 // ! negando el resultado !TRUE =  FALSO ;; !FALSO = TRUE
								 //COMPRUEBO mi consulta
								 if(!$resultadop){ //SI: NO TRUE (FALSE)
												  $error = $conn->error; echo "EXISTE UN ERROR EN: ".$error;
												  } else {
														  // SI: NO FALSE (TRUE)
													   // echo '<script type="text/javascript">alert("Registro editado correctamente");window.location.href="usuario.php?id='.$r.'";</script>';
														  }
													 
							 
                                  }				 
						 
	}
}


?>