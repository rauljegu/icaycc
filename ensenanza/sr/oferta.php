<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/config.php';
require_once ROOT_PATH . '/includes/slider-revolution.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Prueba Slider Revolution</title>

    <style>

        body {
            margin: 0;
            padding: 0;
        }

        .titulo-slider {
            padding: 30px 0 15px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1 class="titulo-slider">
       Oferta
    </h1>

</div>

<?php

				mostrarSliderRevolution(
					'https://www.atmosfera.unam.mx/educacion-continua/',
					'Destacados'
				);
?>



</body>

</html>