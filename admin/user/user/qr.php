<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/libs/phpqrcode/qrlib.php";

$codigo = $_GET['c'] ?? '';

if (!$codigo) {
    die("Código no válido");
}

QRcode::png(
    $codigo,      // CONTENIDO DEL QR (solo el código)
    false,        // salida directa
    QR_ECLEVEL_L, // nivel de corrección
    6,            // tamaño
    2             // margen
);
