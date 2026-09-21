<?php

// ========================================
// Configuración
// ========================================

require_once __DIR__ . '/../config/config.php';

// ========================================
// Validar ID
// ========================================

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    echo '<script>
        window.location.replace("' . BASE_URL . 'unidades/");
    </script>';
    exit;
}

$id = (int) $_GET['id'];

// ========================================
// Destinos
// ========================================

$destinos = [

    1 => 'unidades/instrumentacion.php',
    2 => 'unidades/computo.php',
    3 => 'comunicacion/index.php',
    4 => 'ensenanza/vinculacion.php',
    5 => 'unidades/docencia.php',
    6 => 'unidades/uniatmos.php',
    7 => 'unidades/laboratorios.php',
    8 => 'ensenanza/continua.php',
    9 => 'unidades/biblioteca.php',
    10 => 'unidades/editorial.php'

];

// ========================================
// Validar destino
// ========================================

if (!isset($destinos[$id])) {
    echo '<script>
        window.location.replace("' . BASE_URL . 'unidades/");
    </script>';
    exit;
}

// ========================================
// Redirección
// ========================================

$url = BASE_URL . $destinos[$id];

echo '<script>
    window.location.replace("' . $url . '");
</script>';

exit;