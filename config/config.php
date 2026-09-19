<?php

define('ROOT_PATH', dirname(__DIR__));

//define('BASE_URL', '/icaycc/');
define('BASE_URL', '/');

$path = dirname($_SERVER['PHP_SELF']);
$directory = basename($path);
$directory; 
if ($directory != "") { $enlace="../";} else {$enlace = "/";} 
require_once ROOT_PATH . '/includes/conexion.php';

require_once ROOT_PATH . '/includes/header.php';

require_once ROOT_PATH . '/includes/menu.php';