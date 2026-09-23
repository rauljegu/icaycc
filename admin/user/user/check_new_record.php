<?php
session_start();
 include '../../includes/connect.php';
							$connect = $conn;
// Inicializar variables con 0 si no se reciben
//$aviso = isset($_POST['aviso']) ? (int)$_POST['aviso'] : 0;
$ultimoPen1 = isset($_POST['preg']) ? (int)$_POST['preg'] : 0;

// Consultas
$resultnpen1 = $connect->query("SELECT count(id_com) as nuevopen1 FROM comentarios WHERE seleccionada = 0 
								  AND comentario != '' AND leida = 0 ");
/*$resultn = $conn->query("SELECT COUNT(`status`) AS rechazos FROM `recibidos` WHERE `status` = 6 AND user_id =".$_SESSION["id"]." AND id_recibidos  IN 
		(SELECT id_recibidos FROM rechazados WHERE leido = 0 )");*/
//$avisos="SELECT COUNT(`status`) AS nuevo FROM `recibidos` WHERE `status` = 3  AND user_id='".$_SESSION["id"]."';";
//echo $avisos;
//$resultnpen = $connect->query($avisos);
$nuevopen1 = ($rownpen1 = $resultnpen1->fetch_assoc()) ? $rownpen1['nuevopen1'] : 0;
//$nuevopen1 = ($rown = $resultn->fetch_assoc()) ? $rown['rechazos'] : 0;
//$nuevopen = ($rownpen = $resultnpen->fetch_assoc()) ? $rownpen['nuevo'] : 0;

//$nuevo = $nuevopen + $nuevopen1;
// Comparar con valores previos
//if ( $nuevo > $aviso  ) {
  //  echo json_encode([
    //    "nuevo" => true,
      //  "mensaje" => "Nueva notificiación",
        //"aviso" => $nuevo,
       
    //]);
//} else {
  //  echo json_encode(["nuevo" => false]);
//}
// Comparar con valores previos
//if ( $nuevopen1 > $ultimoPen1 || $nuevopen2 > $ultimoPen2) {
if ( $nuevopen1 > $ultimoPen1 ) {
    echo json_encode([
        "nuevo" => true,
        "mensaje" => "Tienes una nueva notificación",
        "ultimoPen1" => $nuevopen1,
     //   "ultimoPen2" => $nuevopen2
    ]);
} else {
    echo json_encode(["nuevo" => false]);
}

$conn->close();
?>


