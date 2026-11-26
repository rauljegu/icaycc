<?php
/**
 * Configuración y control de acceso del administrador.
 * Debe incluirse antes de generar cualquier salida HTML.
 */

if (defined('ADMIN_SETTINGS_LOADED')) {
    return;
}
define('ADMIN_SETTINGS_LOADED', true);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/connect.php';

$ufunc = new UserFunctions();
$ufunc1 = new UserFunctionsid();
$chss = new Login();
$chss->SessionCheck();

// Verificar que exista una sesión válida y que el usuario tenga el rol permitido.
if (
    !isset($_SESSION['login'], $_SESSION['role']) ||
    (string)$_SESSION['role'] !== '0'
) {
    header('Location: ../../includes/logout.php');
    exit;
}

// La página puede indicar su nombre mediante GET; si no, se obtiene del archivo actual.
$name = $_GET['name'] ?? basename($_SERVER['PHP_SELF'] ?? '');

switch ($name) {
    case 'index.php':
        $menu = 0;
        $name = 'index.php';
        include __DIR__ . '/activo.php';
        break;

    case 'secciones.php':
        $menu = 1;
        $name = 'secciones.php';
        include __DIR__ . '/activo.php';
        break;

    case 'personal.php':
    case 'editar_personal.php':
        $menu = 2;
        $name = basename($_SERVER['PHP_SELF'] ?? 'personal.php');
        include __DIR__ . '/activo.php';
        break;
}
