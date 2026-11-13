
<?php
/**
 * Adaptación de rutas multimedia de WordPress.
 *
 * Elimina el dominio original de las URL que apuntan
 * a wp-content/uploads y las adapta a la ruta local
 * del proyecto ICAyCC.
 */

/**
 * Obtiene la ruta base del proyecto.
 *
 * Ejemplos:
 * Proyecto en raíz: /
 * Proyecto en subdirectorio: /icaycc/
 */
if (!defined('PROJECT_BASE_URL')) {
    define(
        'PROJECT_BASE_URL',
        rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/') . '/'
    );
}

/**
 * Sustituye las URL absolutas de WordPress por rutas locales.
 *
 * Funciona tanto con una URL individual como con HTML completo.
 */
function wordpressMediaUrl($contenido) {

    if (!is_string($contenido) || $contenido === '') {
        return $contenido;
    }

    // Dominios originales de WordPress
    $dominios = [
        'https://atmosfera.unam.mx',
        'http://atmosfera.unam.mx',
        'https://www.atmosfera.unam.mx',
        'http://www.atmosfera.unam.mx'
    ];

    // Eliminar el dominio, conservando la ruta
    $contenido = str_ireplace(
        $dominios,
        '',
        $contenido
    );

    // Adaptar wp-content/uploads a la ubicación del proyecto
    $contenido = preg_replace(
        '~(?<![a-zA-Z0-9:/])(/wp-content/uploads/)~',
        PROJECT_BASE_URL . 'wp-content/uploads/',
        $contenido
    );

    return $contenido;
}
