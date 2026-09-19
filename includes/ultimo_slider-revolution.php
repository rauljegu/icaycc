<?php

if (!function_exists('mostrarSliderRevolution')) {

    function mostrarSliderRevolution($url, $alias)
    {

        /*
        |--------------------------------------------------------------------------
        | CONTADOR
        |--------------------------------------------------------------------------
        */

        static $contador = 0;

        $contador++;


        /*
        |--------------------------------------------------------------------------
        | DESCARGAR PÁGINA
        |--------------------------------------------------------------------------
        */

        $ch = curl_init($url);

        curl_setopt_array($ch, [

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_FOLLOWLOCATION => true,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_CONNECTTIMEOUT => 10,

            /*
             * Temporalmente desactivado durante desarrollo.
             */

            CURLOPT_SSL_VERIFYPEER => false,

            CURLOPT_SSL_VERIFYHOST => false,

            CURLOPT_USERAGENT =>
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) ' .
                'AppleWebKit/537.36 (KHTML, like Gecko) ' .
                'Chrome/140.0 Safari/537.36'

        ]);


        $html = curl_exec($ch);

        $httpCode = curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

        $curlError = curl_error($ch);

        curl_close($ch);


        /*
        |--------------------------------------------------------------------------
        | ERROR DE DESCARGA
        |--------------------------------------------------------------------------
        */

        if (
            $html === false ||
            empty($html)
        ) {

            echo '<div class="alert alert-danger">';

            echo '<strong>Error al descargar la página remota.</strong><br>';

            echo 'HTTP: ' .
                htmlspecialchars(
                    (string)$httpCode
                );

            if (!empty($curlError)) {

                echo '<br>';

                echo 'cURL: ' .
                    htmlspecialchars(
                        $curlError
                    );

            }

            echo '</div>';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | NORMALIZAR ALIAS
        |--------------------------------------------------------------------------
        */

        $aliasNormalizado = strtolower(
            preg_replace(
                '/[^a-z0-9]/i',
                '',
                $alias
            )
        );


        /*
        |--------------------------------------------------------------------------
        | BUSCAR COMENTARIOS
        |--------------------------------------------------------------------------
        */

        $comentarios = [];

        preg_match_all(
            '/<!--(.*?)-->/is',
            $html,
            $comentarios
        );


        /*
        |--------------------------------------------------------------------------
        | VARIABLES
        |--------------------------------------------------------------------------
        */

        $sliderHTML = '';

        $sliderTitle = '';

        $moduleIdOriginal = '';

        $initScript = '';

        $startSizeScript = '';

        $slidersEncontrados = [];


        /*
        |--------------------------------------------------------------------------
        | BUSCAR SLIDER
        |--------------------------------------------------------------------------
        */

        if (!empty($comentarios[1])) {

            foreach ($comentarios[1] as $comentario) {

                $comentarioLimpio =
                    trim($comentario);


                /*
                 * Debe ser comentario de Revolution.
                 */

                if (
                    stripos(
                        $comentarioLimpio,
                        'START'
                    ) === false
                ) {
                    continue;
                }


                if (
                    stripos(
                        $comentarioLimpio,
                        'REVOLUTION SLIDER'
                    ) === false
                ) {
                    continue;
                }


                /*
                 * Obtener nombre.
                 */

                if (
                    !preg_match(
                        '/START\s+(.*?)\s+REVOLUTION\s+SLIDER/is',
                        $comentarioLimpio,
                        $nombreMatch
                    )
                ) {
                    continue;
                }


                $titulo =
                    trim(
                        $nombreMatch[1]
                    );


                $slidersEncontrados[] =
                    $titulo;


                $tituloNormalizado =
                    strtolower(
                        preg_replace(
                            '/[^a-z0-9]/i',
                            '',
                            $titulo
                        )
                    );


                /*
                 * ¿Es el slider solicitado?
                 */

                if (
                    $tituloNormalizado !==
                    $aliasNormalizado
                ) {
                    continue;
                }


                $sliderTitle =
                    $titulo;


                /*
                 * Buscar posición.
                 */

                $posicion =
                    stripos(
                        $html,
                        'START ' . $titulo
                    );


                if (
                    $posicion === false
                ) {
                    continue;
                }


                /*
                 * Buscar módulo.
                 */

                $inicio =
                    stripos(
                        $html,
                        '<rs-module-wrap',
                        $posicion
                    );


                if (
                    $inicio === false
                ) {
                    continue;
                }


                /*
                 * Buscar cierre.
                 */

                $fin =
                    stripos(
                        $html,
                        '</rs-module-wrap>',
                        $inicio
                    );


                if (
                    $fin === false
                ) {
                    continue;
                }


                /*
                 * Extraer HTML.
                 */

                $longitud =
                    (
                        $fin +
                        strlen(
                            '</rs-module-wrap>'
                        )
                    ) -
                    $inicio;


                $sliderHTML =
                    substr(
                        $html,
                        $inicio,
                        $longitud
                    );


                break;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SLIDER NO ENCONTRADO
        |--------------------------------------------------------------------------
        */

        if (
            empty($sliderHTML)
        ) {

            echo '<div class="alert alert-warning">';

            echo '<strong>Slider no encontrado.</strong><br>';

            echo 'Alias solicitado: ';

            echo '<code>' .
                htmlspecialchars($alias) .
                '</code>';


            if (!empty($slidersEncontrados)) {

                echo '<hr>';

                echo '<strong>Sliders encontrados:</strong>';

                echo '<ul class="mb-0">';


                foreach (
                    $slidersEncontrados
                    as $slider
                ) {

                    echo '<li>' .
                        htmlspecialchars($slider) .
                        '</li>';

                }


                echo '</ul>';

            }


            echo '</div>';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | OBTENER ID DEL MÓDULO
        |--------------------------------------------------------------------------
        */

        if (
            preg_match(
                '/<rs-module(?:\s|>)[^>]*\bid=["\']([^"\']+)["\']/i',
                $sliderHTML,
                $moduleMatch
            )
        ) {

            $moduleIdOriginal =
                $moduleMatch[1];

        }


        if (
            empty($moduleIdOriginal)
        ) {

            echo '<div class="alert alert-danger">';

            echo 'No se pudo determinar el ID del slider.';

            echo '</div>';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | GENERAR ID ÚNICO
        |--------------------------------------------------------------------------
        */

        $moduleIdNuevo =
            'rs_remote_' .
            $contador;


        /*
        |--------------------------------------------------------------------------
        | CAMBIAR ID DEL MÓDULO
        |--------------------------------------------------------------------------
        */

        $sliderHTML =
            preg_replace(
                '/(<rs-module\b[^>]*\bid=["\'])' .
                preg_quote(
                    $moduleIdOriginal,
                    '/'
                ) .
                '(["\'])/i',
                '$1' .
                $moduleIdNuevo .
                '$2',
                $sliderHTML,
                1
            );


        /*
        |--------------------------------------------------------------------------
        | CAMBIAR ID DEL WRAPPER
        |--------------------------------------------------------------------------
        */

        $sliderHTML =
            preg_replace(
                '/(<rs-module-wrap\b[^>]*\bid=["\'])' .
                preg_quote(
                    $moduleIdOriginal . '_wrapper',
                    '/'
                ) .
                '(["\'])/i',
                '$1' .
                $moduleIdNuevo .
                '_wrapper' .
                '$2',
                $sliderHTML,
                1
            );


        /*
        |--------------------------------------------------------------------------
        | BUSCAR setREVStartSize
        |--------------------------------------------------------------------------
        */

        $posStartSize =
            stripos(
                $html,
                "setREVStartSize({c: '" . $moduleIdOriginal . "'"
            );


        if (
            $posStartSize !== false
        ) {

            $antes =
                substr(
                    $html,
                    0,
                    $posStartSize
                );


            $inicioScript =
                strripos(
                    $antes,
                    '<script'
                );


            $finScript =
                stripos(
                    $html,
                    '</script>',
                    $posStartSize
                );


            if (
                $inicioScript !== false &&
                $finScript !== false
            ) {

                $mayor =
                    strpos(
                        $html,
                        '>',
                        $inicioScript
                    );


                if (
                    $mayor !== false
                ) {

                    $startSizeScript =
                        trim(
                            substr(
                                $html,
                                $mayor + 1,
                                $finScript -
                                ($mayor + 1)
                            )
                        );

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | BUSCAR SCRIPT DE INICIALIZACIÓN REAL
        |--------------------------------------------------------------------------
        |
        | No debemos buscar únicamente RS_MODULES.modules["ID"], porque
        | Slider Revolution puede utilizar un ID interno diferente al ID
        | HTML del módulo (por ejemplo revslider482 para rev_slider_48_2).
        |
        | Primero obtenemos revapiXX desde el setREVStartSize y después
        | buscamos el <script> que realmente contiene la inicialización
        | del slider.
        */

        $revApiOriginal = '';

        if (
            !empty($startSizeScript) &&
            preg_match(
                '/\\b(revapi\\d+)\\b/i',
                $startSizeScript,
                $apiMatchStart
            )
        ) {
            $revApiOriginal = $apiMatchStart[1];
        }

        /*
         * Obtener todos los scripts inline de la página remota.
         */

        $scriptsInline = [];

        preg_match_all(
            '/<script\\b[^>]*>(.*?)<\\/script>/is',
            $html,
            $scriptsInline
        );

        if (
            !empty($revApiOriginal) &&
            !empty($scriptsInline[1])
        ) {

            foreach ($scriptsInline[1] as $script) {

                if (
                    stripos($script, $revApiOriginal) === false
                ) {
                    continue;
                }

                /*
                 * El script de setREVStartSize también contiene revapiXX,
                 * por eso exigimos que exista la inicialización real.
                 */

                $esInicializacion =
                    preg_match(
                        '/\\b' .
                        preg_quote($revApiOriginal, '/') .
                        '\\s*\\.\\s*revolution\\s*\\(/i',
                        $script
                    ) ||
                    preg_match(
                        '/\\b' .
                        preg_quote($revApiOriginal, '/') .
                        '\\s*=\\s*.*(?:jQuery|\\$)/is',
                        $script
                    );

                if (!$esInicializacion) {
                    continue;
                }

                $initScript = trim($script);
                break;
            }
        }

        /*
         * Respaldo: buscar una inicialización asociada directamente
         * con el módulo HTML.
         */

        if (
            empty($initScript) &&
            !empty($scriptsInline[1])
        ) {

            foreach ($scriptsInline[1] as $script) {

                if (
                    stripos($script, $moduleIdOriginal) === false
                ) {
                    continue;
                }

                if (
                    stripos($script, '.revolution') === false
                ) {
                    continue;
                }

                $initScript = trim($script);
                break;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | ADAPTAR SCRIPT AL NUEVO ID
        |--------------------------------------------------------------------------
        */

        if (
            !empty($initScript)
        ) {

            $initScript =
                str_replace(
                    '"' .
                    $moduleIdOriginal .
                    '"',
                    '"' .
                    $moduleIdNuevo .
                    '"',
                    $initScript
                );


            $initScript =
                str_replace(
                    "'" .
                    $moduleIdOriginal .
                    "'",
                    "'" .
                    $moduleIdNuevo .
                    "'",
                    $initScript
                );


            $initScript =
                str_replace(
                    'getElementById("' .
                    $moduleIdOriginal .
                    '")',
                    'getElementById("' .
                    $moduleIdNuevo .
                    '")',
                    $initScript
                );


            $initScript =
                str_replace(
                    "getElementById('" .
                    $moduleIdOriginal .
                    "')",
                    "getElementById('" .
                    $moduleIdNuevo .
                    "')",
                    $initScript
                );


            /*
             * Cambiar revapiXX por una variable única.
             */

            if (
                preg_match(
                    '/\b(revapi\d+)\b/',
                    $initScript,
                    $apiMatch
                )
            ) {

                $revApiOriginal =
                    $apiMatch[1];


                $revApiNuevo =
                    'revapi_remote_' .
                    $contador;


                $initScript =
                    preg_replace(
                        '/\b' .
                        preg_quote(
                            $revApiOriginal,
                            '/'
                        ) .
                        '\b/',
                        $revApiNuevo,
                        $initScript
                    );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | ADAPTAR setREVStartSize
        |--------------------------------------------------------------------------
        */

        if (
            !empty($startSizeScript)
        ) {

            $startSizeScript =
                str_replace(
                    '"' .
                    $moduleIdOriginal .
                    '"',
                    '"' .
                    $moduleIdNuevo .
                    '"',
                    $startSizeScript
                );


            $startSizeScript =
                str_replace(
                    "'" .
                    $moduleIdOriginal .
                    "'",
                    "'" .
                    $moduleIdNuevo .
                    "'",
                    $startSizeScript
                );

        }


        /*
        |--------------------------------------------------------------------------
        | RECURSOS REMOTOS
        |--------------------------------------------------------------------------
        */

        $remoteBase =
            'https://www.atmosfera.unam.mx';


        $jqueryUrl =
            $remoteBase .
            '/wp-includes/js/jquery/jquery.min.js';


        $rbtoolsUrl =
            $remoteBase .
            '/wp-content/plugins/revslider/sr6/assets/js/rbtools.min.js?ver=6.7.13';


        $rs6Url =
            $remoteBase .
            '/wp-content/plugins/revslider/sr6/assets/js/rs6.min.js?ver=6.7.13';


        $rs6CssUrl =
            $remoteBase .
            '/wp-content/plugins/revslider/sr6/assets/css/rs6.css?ver=6.7.13';


        /*
        |--------------------------------------------------------------------------
        | DETECTAR ADDONS UTILIZADOS POR LA PÁGINA ORIGINAL
        |--------------------------------------------------------------------------
        |
        | No asumimos rutas para los addons de Revolution. La página WordPress
        | original ya contiene las URLs exactas de los recursos que utiliza.
        | Las extraemos del HTML y reutilizamos únicamente BubbleMorph.
        |
        */

        $revolutionAddonCssUrls = array();
        $revolutionAddonJsUrls  = array();
        $threeJsUrls            = array();

        $sourceParts = parse_url($url);
        $sourceScheme = !empty($sourceParts['scheme']) ? $sourceParts['scheme'] : 'https';
        $sourceHost = !empty($sourceParts['host']) ? $sourceParts['host'] : '';
        $sourceOrigin = $sourceScheme . '://' . $sourceHost;

        $resolverAddonUrl = function ($assetUrl) use ($sourceOrigin, $sourceScheme, $url) {

            $assetUrl = trim(html_entity_decode($assetUrl, ENT_QUOTES, 'UTF-8'));

            if ($assetUrl === '') {
                return '';
            }

            if (preg_match('/^https?:\/\//i', $assetUrl)) {
                return $assetUrl;
            }

            if (strpos($assetUrl, '//') === 0) {
                return $sourceScheme . ':' . $assetUrl;
            }

            if (strpos($assetUrl, '/') === 0) {
                return $sourceOrigin . $assetUrl;
            }

            $base = $url;
            $qPos = strpos($base, '?');
            if ($qPos !== false) {
                $base = substr($base, 0, $qPos);
            }
            $hashPos = strpos($base, '#');
            if ($hashPos !== false) {
                $base = substr($base, 0, $hashPos);
            }

            $slashPos = strrpos($base, '/');
            $baseDir = $slashPos !== false ? substr($base, 0, $slashPos + 1) : $base . '/';

            return $baseDir . $assetUrl;
        };

        /*
        | Detectamos TODOS los addons de Revolution que la página original
        | declara. Esto evita asumir rutas concretas para BubbleMorph,
        | Particle Wave u otros addons que pueda utilizar otro slider.
        |
        | Ejemplos que buscamos:
        |   revolution.addon.bubblemorph.min.js
        |   revolution.addon.particlewave.min.js
        |   revolution.addon.*.css
        |   archivos equivalentes publicados bajo /addons/ o /revslider/
        */

        $isRevolutionAddon = function ($assetUrl) {
            return (bool) preg_match(
                '/(?:revolution\.addon\.|revslider[^"\'\s]*addon|\/addons\/.*(?:revslider|revolution)|particlewave|bubblemorph)/i',
                $assetUrl
            );
        };

        if (preg_match_all('/<link\b[^>]*\bhref=["\']([^"\']+)["\'][^>]*>/i', $html, $linkMatches)) {

            foreach ($linkMatches[1] as $href) {

                if (!$isRevolutionAddon($href)) {
                    continue;
                }

                $resolved = $resolverAddonUrl($href);

                if ($resolved !== '') {
                    $revolutionAddonCssUrls[$resolved] = true;
                }
            }
        }

        if (preg_match_all('/<script\b[^>]*\bsrc=["\']([^"\']+)["\'][^>]*>\s*<\/script>/i', $html, $scriptMatches)) {

            foreach ($scriptMatches[1] as $src) {

                $resolved = $resolverAddonUrl($src);

                if ($resolved === '') {
                    continue;
                }

                /*
                 * Algunos addons de Revolution, especialmente Particles y
                 * Particle Wave, dependen de THREE.js. Debe cargarse antes
                 * que los addons que lo utilizan.
                 */
                if (preg_match('/(?:^|[\/._-])three(?:\.min)?\.js(?:[?#]|$)/i', $src)) {
                    $threeJsUrls[$resolved] = true;
                    continue;
                }

                if (!$isRevolutionAddon($src)) {
                    continue;
                }

                $revolutionAddonJsUrls[$resolved] = true;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CSS
        |--------------------------------------------------------------------------
        */

        echo '<link rel="stylesheet" href="' .
            htmlspecialchars($rs6CssUrl) .
            '">' .
            PHP_EOL;


        foreach (array_keys($revolutionAddonCssUrls) as $addonCssUrl) {
            echo '<link rel="stylesheet" href="' .
                htmlspecialchars($addonCssUrl) .
                '">' .
                PHP_EOL;
        }


        /*
        |--------------------------------------------------------------------------
        | CARGAR RECURSOS UNA SOLA VEZ
        |--------------------------------------------------------------------------
        */

        if (
            $contador === 1
        ) {

            echo '<script src="' .
                htmlspecialchars($jqueryUrl) .
                '"></script>' .
                PHP_EOL;


            echo '<script src="' .
                htmlspecialchars($rbtoolsUrl) .
                '"></script>' .
                PHP_EOL;


            echo '<script src="' .
                htmlspecialchars($rs6Url) .
                '"></script>' .
                PHP_EOL;

            /* THREE.js debe ir antes de Particles / Particle Wave */
            foreach (array_keys($threeJsUrls) as $threeJsUrl) {
                echo '<script src="' .
                    htmlspecialchars($threeJsUrl) .
                    '"></script>' .
                    PHP_EOL;
            }

            foreach (array_keys($revolutionAddonJsUrls) as $addonJsUrl) {
                echo '<script src="' .
                    htmlspecialchars($addonJsUrl) .
                    '"></script>' .
                    PHP_EOL;
            }

        }


        /*
        |--------------------------------------------------------------------------
        | setREVStartSize
        |--------------------------------------------------------------------------
        */

?>

<script>

if (typeof setREVStartSize === "undefined") {

    function setREVStartSize(i) {

        try {

            var n;


            if (
                i.mh === undefined ||
                i.mh === ""
            ) {

                i.mh = 0;

            }


            if (
                i.l === "fullscreen"
            ) {

                n = Math.max(
                    i.mh,
                    window.innerHeight
                );

            }

            else {

                var e =
                    new Array(
                        i.rl.length
                    );


                for (
                    var r in i.rl
                ) {

                    e[r] =
                        i.rl[r] <
                        window.innerWidth
                            ? 0
                            : i.rl[r];

                }


                n =
                    Math.min(
                        Math.min.apply(
                            Math,
                            e
                        ),
                        Math.max.apply(
                            Math,
                            i.rl
                        )
                    );


                n =
                    n === 0
                        ? Math.max.apply(
                            Math,
                            i.rl
                        )
                        : n;


                var t =
                    i.rl.findIndex(
                        function (i) {

                            return i === n;

                        }
                    );


                var a =
                    Math.min(
                        1,
                        window.innerWidth /
                        i.rl[t]
                    );


                n =
                    Math.max(
                        i.mh,
                        i.gh[t] * a
                    );


                if (
                    i.el !== undefined &&
                    i.el[t] !== undefined
                ) {

                    n =
                        Math.max(
                            n,
                            i.el[t] * a
                        );

                }

            }


            if (
                window.rs_init_css === undefined
            ) {

                window.rs_init_css =
                    document.head.appendChild(
                        document.createElement(
                            "style"
                        )
                    );

            }


            window.rs_init_css.innerHTML +=

                "#" +
                i.c +
                "_wrapper { height: " +
                n +
                "px; }";


        }

        catch (error) {

            console.log(
                "Failure at Presize of Slider:",
                error
            );

        }

    }

}

</script>

<?php


        /*
        |--------------------------------------------------------------------------
        | MOSTRAR SLIDER
        |--------------------------------------------------------------------------
        */

        echo $sliderHTML;


        /*
        |--------------------------------------------------------------------------
        | CORRECCIÓN DE ESCALA PARA SLIDERS CON GRID PEQUEÑA
        |--------------------------------------------------------------------------
        |
        | Algunos sliders de Revolution están definidos como fullwidth, pero
        | su grid original es pequeña (por ejemplo 385x125). Al ejecutarlos
        | fuera de WordPress, Revolution puede escalar el contenido al ancho
        | completo del viewport y conservar únicamente la altura del wrapper.
        |
        | Conservamos el ancho/alto original del grid cuando existe un único
        | valor gw/gh.
        */

        $gridWidth = null;
        $gridHeight = null;

        if (
            !empty($startSizeScript) &&
            preg_match(
                '/\bgw\s*:\s*\[\s*(\d+)\s*\]/i',
                $startSizeScript,
                $gwMatch
            )
        ) {
            $gridWidth = (int) $gwMatch[1];
        }

        if (
            !empty($startSizeScript) &&
            preg_match(
                '/\bgh\s*:\s*\[\s*(\d+)\s*\]/i',
                $startSizeScript,
                $ghMatch
            )
        ) {
            $gridHeight = (int) $ghMatch[1];
        }

        if (
            $gridWidth !== null &&
            $gridHeight !== null
        ) {
?>

<style>

#<?= htmlspecialchars($moduleIdNuevo) ?>_wrapper {
    width: 100% !important;
    max-width: 100% !important;
    height: <?= $gridHeight ?>px !important;
    min-height: <?= $gridHeight ?>px !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    overflow: hidden !important;
}

#<?= htmlspecialchars($moduleIdNuevo) ?> {
    width: <?= $gridWidth ?>px !important;
    max-width: none !important;
    height: <?= $gridHeight ?>px !important;
    min-height: <?= $gridHeight ?>px !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    transform-origin: top center !important;
    position: relative !important;
    left: 50% !important;
}

</style>

<script>
(function() {
    var wrapper = document.getElementById('<?= htmlspecialchars($moduleIdNuevo) ?>_wrapper');
    var module = document.getElementById('<?= htmlspecialchars($moduleIdNuevo) ?>');

    if (!wrapper || !module) return;

    function ajustarSliderResponsivo() {
        var anchoBase = <?= $gridWidth ?>;
        var altoBase = <?= $gridHeight ?>;

        var anchoDisponible = wrapper.parentElement
            ? wrapper.parentElement.clientWidth
            : window.innerWidth;

        anchoDisponible = Math.min(anchoBase, anchoDisponible);

        if (anchoDisponible <= 0) return;

        var escala = anchoDisponible / anchoBase;

        wrapper.style.width = '100%';
        wrapper.style.maxWidth = '100%';
        wrapper.style.height = (altoBase * escala) + 'px';
        wrapper.style.minHeight = (altoBase * escala) + 'px';

        module.style.width = anchoBase + 'px';
        module.style.height = altoBase + 'px';
        module.style.maxWidth = 'none';
        module.style.transformOrigin = 'top center';
        module.style.left = '50%';

        module.style.transform =
            'translateX(-50%) scale(' + escala + ')';
    }

    ajustarSliderResponsivo();
    window.addEventListener('resize', ajustarSliderResponsivo);
})();
</script>

<?php
        }


        /*
        |--------------------------------------------------------------------------
        | RESPALDO JQUERY
        |--------------------------------------------------------------------------
        */

?>

<script>

if (
    typeof revslider_showDoubleJqueryError ===
    "undefined"
) {

    function revslider_showDoubleJqueryError(
        sliderID
    ) {

        console.error(
            "Slider Revolution: problema con jQuery para:",
            sliderID
        );

    }

}

</script>

<?php


        /*
        |--------------------------------------------------------------------------
        | EJECUTAR setREVStartSize
        |--------------------------------------------------------------------------
        */

        if (
            !empty($startSizeScript)
        ) {

            $GLOBALS['revslider_remote_init_scripts'][] =
                '<script>' . $startSizeScript . '</script>' . PHP_EOL;

        }

        else {

?>

<script>

setREVStartSize({

    c: '<?= htmlspecialchars(
        $moduleIdNuevo
    ) ?>',

    rl: [
        1240,
        1024,
        768,
        480
    ],

    el: [
        650,
        768,
        700,
        700
    ],

    gw: [
        1240,
        1024,
        778,
        480
    ],

    gh: [
        650,
        768,
        700,
        700
    ],

    type: 'standard',

    justify: '',

    layout: 'fullwidth',

    mh: '0'

});

</script>

<?php

        }


        /*
        |--------------------------------------------------------------------------
        | INICIALIZAR REVOLUTION
        |--------------------------------------------------------------------------
        */

        if (
            !empty($initScript)
        ) {

            $GLOBALS['revslider_remote_init_scripts'][] =
                '<script>' . $initScript . '</script>' . PHP_EOL;

        }

        else {

            echo '<div class="alert alert-danger mt-3">';

            echo '<strong>Error:</strong> ';

            echo 'Se encontró el slider ';

            echo '<code>' .
                htmlspecialchars(
                    $sliderTitle
                ) .
                '</code>, pero no se encontró su configuración JavaScript.';

            echo '</div>';

        }

        }

}


/**
 * Imprime las inicializaciones pendientes después de que el HTML de todos
 * los sliders haya sido insertado en el documento.
 *
 * Debe llamarse una sola vez, después de las llamadas a
 * mostrarSliderRevolution() y antes del cierre de </body>.
 */
if (!function_exists('finalizarSlidersRevolution')) {
    function finalizarSlidersRevolution()
    {
        if (empty($GLOBALS['revslider_remote_init_scripts'])) {
            return;
        }

        foreach ($GLOBALS['revslider_remote_init_scripts'] as $script) {
            echo $script;
        }

        unset($GLOBALS['revslider_remote_init_scripts']);
    }
}
