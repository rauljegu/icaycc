<?php

 //var_dump($_SESSION);
//session_start();
include '../../includes/functions.php'; //include functions
include '../../includes/connect.php'; //include connection

$ufunc = new UserFunctions;
$ufunc1 = new UserFunctionsid;
$chss = new Login;
$chss->SessionCheck();
//Check user role is true
// var_dump($_SESSION);
if (!isset($_SESSION['login']) || $_SESSION['role'] != "1") {
  //header("Location:../../includes/logout.php");
  
 // echo "log <br>".$_SESSION['login'];
 // echo "rol <br>".$_SESSION['role'];
} 
if(isset($_GET["name"])){$name=$_GET["name"];}
 
switch($name){
	case "index.php": $menu=0;   $name='index.php'; include'activo.php'; break;
	case "administrar.php": $menu=1;   $name='administrar.php'; include'activo.php'; break;
	case "solicitudes.php": $menu=2;   $name='solicitudes.php'; include'activo.php'; break;
	case "visor_comentarios.php": $menu=3;   $name='visor_comentarios.php'; include'activo.php'; break;
	case "yt.php": $menu=4;   $name='yt.php'; include'activo.php'; break;
	case "reg.php": $menu=5;   $name='reg.php'; include'activo.php'; break;
	/*case "publicados.php": $menu=6;   $name='publicados.php'; include'activo.php'; break;
	case "rechazados.php": $menu=7;   $name='rechazados.php'; include'activo.php'; break;
	case "asignaciones.php": $menu=8;   $name='asignaciones.php'; include'activo.php'; break;*/
}
?>
