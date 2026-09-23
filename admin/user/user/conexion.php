<?php

$base = __DIR__;

/* ===========================
   CONEXION 108 COLOQUIOS
   =========================== */

require $base . '/../../includes/connect.php';

if (!isset($conn) || !$conn) {
    die("Error conexión 108");
}

$connect = $conn;  // Guardamos conexión 108


/* ===========================
   CONEXION 212 RUTA
   =========================== */

require $base . '/../../../assets/conexion.php';

if (!isset($conn) || !$conn) {
    die("Error conexión 212");
}

$connect0 = $conn; // Guardamos conexión 212
?>