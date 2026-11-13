<?php


/*
|--------------------------------------------------------------------------
| AUXILIARES PARA SLIDER REVOLUTION 7
|--------------------------------------------------------------------------
*/

if (!function_exists('sr7ExtraerBloque')) {

    /**
     * Extrae un objeto delimitado por llaves, respetando cadenas y escapes.
     */
    function sr7ExtraerBloque($texto, $posicionInicio)
    {
        $longitud = strlen($texto);
        $nivel = 0;
        $comilla = null;
        $escape = false;

        for ($i = $posicionInicio; $i < $longitud; $i++) {

            $c = $texto[$i];

            if ($comilla !== null) {

                if ($escape) {
                    $escape = false;
                    continue;
                }

                if ($c === '\\') {
                    $escape = true;
                    continue;
                }

                if ($c === $comilla) {
                    $comilla = null;
                }

                continue;
            }

            if ($c === '"' || $c === "'") {
                $comilla = $c;
                continue;
            }

            if ($c === '{') {
                $nivel++;
            } elseif ($c === '}') {
                $nivel--;

                if ($nivel === 0) {
                    return substr(
                        $texto,
                        $posicionInicio,
                        $i - $posicionInicio + 1
                    );
                }
            }
        }

        return false;
    }
}


if (!function_exists('sr7ResolverUrl')) {

    function sr7ResolverUrl($recurso, $urlBase)
    {
        $recurso = trim(
            html_entity_decode(
                $recurso,
                ENT_QUOTES,
                'UTF-8'
            )
        );

        if ($recurso === '') {
            return '';
        }

        if (preg_match('/^https?:\/\//i', $recurso)) {
            return $recurso;
        }

        $partes = parse_url($urlBase);

        if (empty($partes['scheme']) || empty($partes['host'])) {
            return '';
        }

        $origen = $partes['scheme'] . '://' . $partes['host'];

        if (strpos($recurso, '//') === 0) {
            return $partes['scheme'] . ':' . $recurso;
        }

        if ($recurso[0] === '/') {
            return $origen . $recurso;
        }

        $ruta = isset($partes['path']) ? $partes['path'] : '/';
        $directorio = substr($ruta, 0, strrpos($ruta, '/') + 1);

        return $origen . $directorio . $recurso;
    }
}


if (!function_exists('sr7ProcesarModuloRemoto')) {

    /**
     * Procesa un módulo SR7 identificado por su alias.
     *
     * Devuelve true cuando la página utiliza SR7, incluso si no
     * encuentra el alias solicitado. Así evita continuar por la
     * ruta antigua de SR6.
     */
    function sr7ProcesarModuloRemoto(
        $html,
        $url,
        $aliasSolicitado,
        $aliasNormalizado
    ) {

        if (stripos($html, '<sr7-module') === false) {
            return false;
        }

        $GLOBALS['SR7_REMOTE_STATE'] =
            isset($GLOBALS['SR7_REMOTE_STATE'])
                ? $GLOBALS['SR7_REMOTE_STATE']
                : [
                    'bootstrap' => false,
                    'css' => [],
                    'scripts' => [],
                    'modulos' => []
                ];

        $estado =& $GLOBALS['SR7_REMOTE_STATE'];

        /*
        |--------------------------------------------------------------------------
        | LOCALIZAR MÓDULO POR data-alias
        |--------------------------------------------------------------------------
        */

        $moduloHTML = '';
        $moduleId = '';

        preg_match_all(
            '/<sr7-module\b[^>]*>/i',
            $html,
            $etiquetas,
            PREG_OFFSET_CAPTURE
        );

        foreach ($etiquetas[0] as $etiqueta) {

            $tag = $etiqueta[0];
            $inicio = $etiqueta[1];

            if (
                !preg_match(
                    '/\bdata-alias\s*=\s*(["\'])(.*?)\1/i',
                    $tag,
                    $aliasMatch
                )
            ) {
                continue;
            }

            $aliasEncontrado = strtolower(
                preg_replace(
                    '/[^a-z0-9]/i',
                    '',
                    $aliasMatch[2]
                )
            );

            if ($aliasEncontrado !== $aliasNormalizado) {
                continue;
            }
/*
            if (
                !preg_match(
                    '/\bid\s*=\s*(["\'])(.*?)\1/i',
                    $tag,
                    $idMatch
                )
            ) {
                continue;
            }

            $moduleId = $idMatch[2];*/
			if (
				!preg_match(
					'/(?:^|\s)id\s*=\s*(["\'])(.*?)\1/i',
					$tag,
					$idMatch
				)
			) {
				continue;
			}

			$moduleId = $idMatch[2];
            /*
             * Buscar el cierre correspondiente del elemento.
             */

            $resto = substr($html, $inicio);

            preg_match_all(
                '/<\/?sr7-module\b[^>]*>/i',
                $resto,
                $tagsModulo,
                PREG_OFFSET_CAPTURE
            );

            $nivel = 0;
            $finModulo = false;

            foreach ($tagsModulo[0] as $tagModulo) {

                $textoTag = $tagModulo[0];

                if (preg_match('/^<\s*\//i', $textoTag)) {
                    $nivel--;
                } else {
                    $nivel++;
                }

                if ($nivel === 0) {
                    $finModulo =
                        $inicio +
                        $tagModulo[1] +
                        strlen($textoTag);

                    break;
                }
            }

            if ($finModulo === false) {
                continue;
            }

            $moduloHTML = substr(
                $html,
                $inicio,
                $finModulo - $inicio
            );

            break;
        }

        if ($moduloHTML === '') {

            echo '<div class="alert alert-warning">';
            echo '<strong>Slider SR7 no encontrado.</strong><br>';
            echo 'Alias solicitado: <code>' .
                htmlspecialchars($aliasSolicitado, ENT_QUOTES, 'UTF-8') .
                '</code>';
            echo '</div>';

            return true;
        }

        /*
        |--------------------------------------------------------------------------
        | OBTENER SCRIPTS INLINE
        |--------------------------------------------------------------------------
        */

        preg_match_all(
            '/<script\b[^>]*>(.*?)<\/script>/is',
            $html,
            $scriptsInline
        );

        $scriptBootstrap = '';
        $scriptConfiguracion = '';
        $scriptPMH = '';
        $asignacionesRecursos = [];

        foreach ($scriptsInline[1] as $script) {

            /*
             * Bootstrap general de SR7.
             */

            if (
                !$estado['bootstrap'] &&
                stripos($script, 'window._tpt') !== false &&
                stripos($script, 'SR7.devMode') !== false
            ) {
                $scriptBootstrap = trim($script);
            }

            /*
             * Configuración JSON del módulo solicitado.
             */

            if ($scriptConfiguracion === '') {

                $patron = '/SR7\.JSON\s*\[\s*(["\'])' .
                    preg_quote($moduleId, '/') .
                    '\1\s*\]\s*=/i';

                if (preg_match($patron, $script, $configMatch, PREG_OFFSET_CAPTURE)) {

                    $posicionObjeto = strpos(
                        $script,
                        '{',
                        $configMatch[0][1] + strlen($configMatch[0][0])
                    );

                    if ($posicionObjeto !== false) {

                        $objeto = sr7ExtraerBloque(
                            $script,
                            $posicionObjeto
                        );

                        if ($objeto !== false) {

                            $scriptConfiguracion =
                                'SR7.JSON[' .
                                json_encode($moduleId) .
                                '] = ' .
                                $objeto .
                                ';';
                        }
                    }
                }
            }

            /*
             * Bloque de preparación de dimensiones del módulo.
             */

         /*   if (
                $scriptPMH === '' &&
                stripos($script, 'SR7.PMH') !== false &&
                stripos($script, $moduleId) !== false
            ) {
                $scriptPMH = trim($script);
            }*/

				if (
					$scriptPMH === '' &&
					preg_match(
						'/SR7\.PMH\s*\[\s*(["\'])' .
						preg_quote($moduleId, '/') .
						'\1\s*\]/i',
						$script
					)
				) {
					$scriptPMH = trim($script);
				}

            /*
             * Referencias a recursos de addons declaradas por SR7.
             */

            if (
                preg_match_all(
                    '/SR7\.E\.resources\.[a-zA-Z0-9_$]+\s*=\s*(?:"(?:\\\\.|[^"])*"|\'(?:\\\\.|[^\'])*\')\s*;/',
                    $script,
                    $recursos
                )
            ) {
                foreach ($recursos[0] as $recurso) {
                    $asignacionesRecursos[$recurso] = true;
                }
            }
        }

        if ($scriptConfiguracion === '') {

            echo '<div class="alert alert-danger">';
            echo '<strong>Error SR7:</strong> No se encontró la configuración ';
            echo 'SR7.JSON del módulo <code>' .
                htmlspecialchars($moduleId, ENT_QUOTES, 'UTF-8') .
                '</code>.';
            echo '</div>';

            return true;
        }

        /*
        |--------------------------------------------------------------------------
        | DETECTAR RECURSOS CSS
        |--------------------------------------------------------------------------
        */

        if (
            preg_match_all(
                '/<link\b[^>]*\bhref=["\']([^"\']+)["\'][^>]*>/i',
                $html,
                $links
            )
        ) {

            foreach ($links[1] as $href) {

                if (
                    stripos($href, 'sr7.css') === false &&
                    !preg_match(
                        '/(?:revslider.*addon|revolution\.addon|bubblemorph)/i',
                        $href
                    )
                ) {
                    continue;
                }

                $recurso = sr7ResolverUrl($href, $url);

                if ($recurso !== '') {
                    $estado['css'][$recurso] = true;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | DETECTAR RECURSOS JAVASCRIPT
        |--------------------------------------------------------------------------
        |
        | Se conserva el orden en que aparecen en el documento remoto.
        */

        if (
            preg_match_all(
                '/<script\b[^>]*\bsrc=["\']([^"\']+)["\'][^>]*>\s*<\/script>/i',
                $html,
                $scriptsExternos
            )
        ) {

            foreach ($scriptsExternos[1] as $src) {

                if (
                    stripos($src, 'tptools.js') === false &&
                    stripos($src, 'sr7.js') === false &&
                    !preg_match(
                        '/(?:revslider.*addon|revolution\.addon|bubblemorph)/i',
                        $src
                    )
                ) {
                    continue;
                }

                $recurso = sr7ResolverUrl($src, $url);

                if ($recurso !== '') {
                    $estado['scripts'][$recurso] = true;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR Y MOSTRAR MÓDULO
        |--------------------------------------------------------------------------
        */

        if (!$estado['bootstrap']) {

            if ($scriptBootstrap !== '') {

                echo '<script>';
                echo $scriptBootstrap;
                echo '</script>';

                $estado['bootstrap'] = true;
            }
        }

        foreach (array_keys($estado['css']) as $css) {

            if (!isset($GLOBALS['SR7_REMOTE_CSS_PRINTED'][$css])) {

                echo '<link rel="stylesheet" href="' .
                    htmlspecialchars($css, ENT_QUOTES, 'UTF-8') .
                    '">' . PHP_EOL;

                $GLOBALS['SR7_REMOTE_CSS_PRINTED'][$css] = true;
            }
        }

        /*
         * Las referencias a recursos de addons deben existir antes
         * de cargar el motor SR7.
         */

       /* foreach (array_keys($asignacionesRecursos) as $asignacion) {
            echo '<script>' . $asignacion . '</script>' . PHP_EOL;
        }*/

		if (!isset($GLOBALS['SR7_REMOTE_RESOURCE_ASSIGNMENTS'])) {
			$GLOBALS['SR7_REMOTE_RESOURCE_ASSIGNMENTS'] = [];
		}

		foreach (array_keys($asignacionesRecursos) as $asignacion) {

			if (
				!isset(
					$GLOBALS['SR7_REMOTE_RESOURCE_ASSIGNMENTS'][$asignacion]
				)
			) {
				echo '<script>' . $asignacion . '</script>' . PHP_EOL;

				$GLOBALS['SR7_REMOTE_RESOURCE_ASSIGNMENTS'][$asignacion] = true;
			}
		}

        echo '<script>';
        echo $scriptConfiguracion;
        echo '</script>' . PHP_EOL;

        /*
         * No modificamos el ID original: SR7.JSON, SR7.PMH y el DOM
         * deben conservar exactamente el mismo identificador.
         */

        echo $moduloHTML . PHP_EOL;

        if ($scriptPMH !== '') {
            echo '<script>';
            echo $scriptPMH;
            echo '</script>' . PHP_EOL;
        }

        $estado['modulos'][$moduleId] = true;

        return true;
    }
}


/*
|--------------------------------------------------------------------------
| FINALIZAR CARGA DE SLIDER REVOLUTION 7
|--------------------------------------------------------------------------
|
| Debe llamarse una sola vez, después de todas las llamadas a
| mostrarSliderRevolution().
*/

if (!function_exists('finalizarSlidersRevolution')) {


function finalizarSlidersRevolution()
{
    if (
        empty($GLOBALS['SR7_REMOTE_STATE']) ||
        empty($GLOBALS['SR7_REMOTE_STATE']['modulos'])
    ) {
        return;
    }

    $estado = $GLOBALS['SR7_REMOTE_STATE'];

    // Cargar los scripts externos de SR7.
    foreach (array_keys($estado['scripts']) as $script) {

        if (!isset($GLOBALS['SR7_REMOTE_JS_PRINTED'][$script])) {

            echo '<script src="' .
                htmlspecialchars($script, ENT_QUOTES, 'UTF-8') .
                '"></script>' . PHP_EOL;

            $GLOBALS['SR7_REMOTE_JS_PRINTED'][$script] = true;
        }
    }

    // Iniciar el motor SR7 después de cargar sus dependencias.
    echo '<script>
        if (
            window.SR7 &&
            SR7.F &&
            typeof SR7.F.init === "function"
        ) {
            SR7.F.init();
        }
    </script>' . PHP_EOL;
}

}

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
/**tmporal

echo '<pre>';

foreach (['Destacados', 'featured', '<rs-module-wrap', '<rs-module'] as $buscar) {

    echo "\n========== $buscar ==========\n";

    $posicion = 0;
    $contador = 0;

    while (($posicion = stripos($html, $buscar, $posicion)) !== false) {

        $inicio = max(0, $posicion - 250);
        $fragmento = substr($html, $inicio, 800);

        echo "\nCoincidencia " . (++$contador) . ":\n";
        echo htmlspecialchars($fragmento) . "\n";

        $posicion += strlen($buscar);

        if ($contador >= 5) {
            break;
        }
    }

    if ($contador === 0) {
        echo "Sin coincidencias.\n";
    }
}

echo '</pre>';
/*---------*/

/*tempral 2*-

echo '<pre>';

preg_match_all(
    '/<sr7-module\b[^>]*>/i',
    $html,
    $modulos
);

foreach ($modulos[0] as $i => $modulo) {
    echo "MÓDULO " . ($i + 1) . "\n";
    echo htmlspecialchars($modulo) . "\n\n";
}

echo '</pre>';
/*----------*/
/*---temporal 3


echo '<pre>';

// CSS relacionados con Slider Revolution
echo "===== CSS =====\n";

preg_match_all(
    '/<link\b[^>]*\bhref=["\']([^"\']+)["\'][^>]*>/i',
    $html,
    $css
);

foreach (array_unique($css[1]) as $urlCSS) {
    if (preg_match('/revslider|revolution|sr7|rbtools/i', $urlCSS)) {
        echo htmlspecialchars($urlCSS) . "\n";
    }
}

// JavaScript externos
echo "\n===== JAVASCRIPT EXTERNOS =====\n";

preg_match_all(
    '/<script\b[^>]*\bsrc=["\']([^"\']+)["\'][^>]*>/i',
    $html,
    $js
);

foreach (array_unique($js[1]) as $urlJS) {
    if (preg_match('/revslider|revolution|sr7|rbtools|three/i', $urlJS)) {
        echo htmlspecialchars($urlJS) . "\n";
    }
}

// Scripts inline relacionados con SR7
echo "\n===== SCRIPTS INLINE SR7 =====\n";

preg_match_all(
    '/<script\b[^>]*>(.*?)<\/script>/is',
    $html,
    $scripts
);

foreach ($scripts[1] as $i => $script) {
    if (
        stripos($script, 'SR7') !== false &&
        stripos($script, 'SR7.JSON') === false
    ) {
        echo "\nSCRIPT " . ($i + 1) . "\n";
        echo htmlspecialchars(substr(trim($script), 0, 1500));
        echo "\n";
    }
}

echo '</pre>';
/*temporal 4 

echo '<pre>';

foreach (['welcome', 'featured'] as $id) {

    $buscar = "SR7.JSON['" . $id . "']";
    $pos = strpos($html, $buscar);

    echo "\n========== CONFIGURACIÓN $id ==========\n";

    if ($pos !== false) {
        $fragmento = substr($html, $pos, 2500);
        echo htmlspecialchars($fragmento);
    } else {
        echo "No encontrada";
    }

    echo "\n";
}

// Scripts inline que contienen inicialización general SR7
echo "\n========== INICIALIZACIÓN GENERAL ==========\n";

preg_match_all(
    '/<script\b[^>]*>(.*?)<\/script>/is',
    $html,
    $scripts
);

foreach ($scripts[1] as $i => $script) {

    if (
        stripos($script, 'SR7') !== false &&
        stripos($script, 'SR7.JSON') === false &&
        stripos($script, 'SR7.PMH') === false
    ) {
        echo "\nSCRIPT " . ($i + 1) . "\n";
        echo htmlspecialchars(substr(trim($script), 0, 2000));
        echo "\n";
    }
}

echo '</pre>';
/*temporal 5
preg_match_all(
    '/<script\b[^>]*>(.*?)<\/script>/is',
    $html,
    $scripts
);

foreach ($scripts[1] as $i => $script) {

    if (stripos($script, 'SR7.JSON') !== false) {

        echo '<pre>';
        echo "SCRIPT: " . ($i + 1) . "\n";
        echo "Tamaño: " . strlen($script) . " bytes\n";
        echo "Configuraciones encontradas:\n";

        preg_match_all(
            '/SR7\.JSON\s*\[\s*["\']([^"\']+)["\']\s*\]/i',
            $script,
            $ids
        );

        print_r(array_unique($ids[1]));

        echo "Inicio del script:\n";
        echo htmlspecialchars(substr(trim($script), 0, 300));
        echo "\n</pre>";
    }
}
/*-------------*/
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
		| DETECTAR Y PROCESAR SR7
		|--------------------------------------------------------------------------
		*/

		if (
			sr7ProcesarModuloRemoto(
				$html,
				$url,
				$alias,
				$aliasNormalizado
			)
		) {
			return;
		}
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
		/*-------------------------------------------------------------------------
		Temporal
		---------------------------------------------------------------------------
		
		echo '<pre>';
echo "HTTP: " . $httpCode . PHP_EOL;
echo "URL: " . htmlspecialchars($url) . PHP_EOL;
echo "Tamaño HTML: " . strlen($html) . PHP_EOL;
echo "Comentarios encontrados: " . count($comentarios[1]) . PHP_EOL;

foreach ($comentarios[1] as $comentario) {
    if (
        stripos($comentario, 'START') !== false ||
        stripos($comentario, 'REVOLUTION') !== false
    ) {
        echo htmlspecialchars(trim($comentario)) . PHP_EOL;
    }
}

echo '</pre>';

/*tmporal 2
echo '<pre>';

echo "Módulos rs-module-wrap encontrados:\n\n";

preg_match_all(
    '/<rs-module-wrap\b[^>]*>/i',
    $html,
    $modulos
);

foreach ($modulos[0] as $i => $modulo) {
    echo "MÓDULO " . ($i + 1) . ":\n";
    echo htmlspecialchars($modulo) . "\n\n";
}

echo "Referencias a los alias:\n";

foreach (['featured', 'revapi', 'Destacados'] as $buscar) {
    echo $buscar . ': ' .
        (stripos($html, $buscar) !== false ? 'ENCONTRADO' : 'NO ENCONTRADO') .
        "\n";
}

echo '</pre>';
*/
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

            echo '<script>';

            echo $startSizeScript;

            echo '</script>';

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

            echo '<script>';

            echo $initScript;

            echo '</script>';

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