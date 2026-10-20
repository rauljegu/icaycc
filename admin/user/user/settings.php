<?php
include '../../includes/functions.php'; //include functions
include '../../includes/connect.php'; //include connection
$ufunc = new UserFunctions;
$ufunc1 = new UserFunctionsid;
$chss = new Login;
$chss->SessionCheck();
//Check user role is true
 
if (!isset($_SESSION['login']) || $_SESSION['role'] != "0") {
  header("Location:../../includes/logout.php");
 
} 
 if(isset($_GET["name"])){$name=$_GET["name"];}
 
switch($name){
	case "index.php": $menu=0;   $name='index.php'; include'activo.php'; break;
	case "secciones.php": $menu=1;   $name='secciones.php'; include'activo.php'; break;
	case "personal.php": $menu=2;   $name='personal.php'; include'activo.php'; break;
	case "editar_personal.php": $menu=2;   $name='editar_personal.php'; include'activo.php'; break;
	
	
}
?>

