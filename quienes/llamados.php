<?php
/*
 * Consultas del directorio ICAyCC.
 * Requiere una conexión PDO disponible en $pdo.
 */

/* --------------------------------------------------
 * INSTITUCIONAL
 * Solo se recupera a la persona indicada como responsable
 * en las tablas direccion, secretarias y unidades.
 * -------------------------------------------------- */
$sqlInstitucional = "
    SELECT
        'Dirección' AS tipo_area,
        COALESCE(o.area, 'Dirección') AS area_organigrama,
        d.nombre AS nombre_area,
        NULL AS tipo,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        c.nombre AS cargo
    FROM direccion d
    INNER JOIN personal p ON p.id_personal = d.responsable
    LEFT JOIN organigrama o ON o.id_organigrama = d.id_organigrama
    LEFT JOIN cargos c ON c.id_cargo = p.cargo
    WHERE d.activo = 1 AND p.activo = 1

    UNION ALL

    SELECT
        'Secretaría' AS tipo_area,
        COALESCE(o.area, 'Secretaría') AS area_organigrama,
        s.nombre AS nombre_area,
        s.tipo AS tipo,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        c.nombre AS cargo
    FROM secretarias s
    INNER JOIN personal p ON p.id_personal = s.responsable
    LEFT JOIN organigrama o ON o.id_organigrama = s.id_organigrama
    LEFT JOIN cargos c ON c.id_cargo = p.cargo
    WHERE s.activo = 1 AND p.activo = 1

    UNION ALL

    SELECT
        'Coordinación / Unidad' AS tipo_area,
        COALESCE(o.area, 'Coordinación / Unidad') AS area_organigrama,
        u.nombre AS nombre_area,
        u.tipo AS tipo,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        c.nombre AS cargo
    FROM unidades u
    INNER JOIN personal p ON p.id_personal = u.responsable
    LEFT JOIN organigrama o ON o.id_organigrama = u.id_organigrama
    LEFT JOIN cargos c ON c.id_cargo = p.cargo
    WHERE u.activo = 1 AND p.activo = 1

    ORDER BY area_organigrama, nombre_area, nombre
";

/* --------------------------------------------------
 * ACADÉMICOS: DEPARTAMENTOS
 * El responsable se toma de departamentos.responsable y se
 * incluye primero, aunque no tenga registro en investigador_departamento.
 * -------------------------------------------------- */
$sqlAcademicosDepartamentos = "
    SELECT
        d.id_departamento,
        d.nombre AS departamento,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        cp.nombre AS categoria,
        n.nivel,
        sn.subnivel,
        (
            SELECT GROUP_CONCAT(DISTINCT g.nombre ORDER BY g.nombre SEPARATOR ', ')
            FROM investigador_grupo ig
            INNER JOIN grupos g ON g.id_grupo = ig.id_grupo AND g.activo = 1
            WHERE ig.id_investigador = p.id_personal
        ) AS grupos,
        1 AS es_responsable
    FROM departamentos d
    INNER JOIN personal p ON p.id_personal = d.responsable
    LEFT JOIN categoria_personal cp ON cp.id_categoria = p.id_categoria_personal
    LEFT JOIN nivel n ON n.id_nivel = p.id_nivel
    LEFT JOIN sub_nivel sn ON sn.id_sub_nivel = p.id_sub_nivel
    WHERE d.activo = 1 AND p.activo = 1

    UNION ALL

    SELECT DISTINCT
        d.id_departamento,
        d.nombre AS departamento,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        cp.nombre AS categoria,
        n.nivel,
        sn.subnivel,
        (
            SELECT GROUP_CONCAT(DISTINCT g.nombre ORDER BY g.nombre SEPARATOR ', ')
            FROM investigador_grupo ig
            INNER JOIN grupos g ON g.id_grupo = ig.id_grupo AND g.activo = 1
            WHERE ig.id_investigador = p.id_personal
        ) AS grupos,
        0 AS es_responsable
    FROM departamentos d
    INNER JOIN investigador_departamento idp ON idp.id_departamento = d.id_departamento
    INNER JOIN personal p ON p.id_personal = idp.id_investigador
    LEFT JOIN categoria_personal cp ON cp.id_categoria = p.id_categoria_personal
    LEFT JOIN nivel n ON n.id_nivel = p.id_nivel
    LEFT JOIN sub_nivel sn ON sn.id_sub_nivel = p.id_sub_nivel
    WHERE d.activo = 1
      AND p.activo = 1
      AND p.id_tipo_personal = 1
      AND (d.responsable IS NULL OR p.id_personal <> d.responsable)

    ORDER BY departamento, es_responsable DESC, nombre
";

/* --------------------------------------------------
 * ACADÉMICOS: UNIDADES
 * El responsable se toma de unidades.responsable y se
 * incluye primero, aunque no tenga registro en personal_unidades.
 * -------------------------------------------------- */
$sqlAcademicosUnidades = "
    SELECT
        u.id_unidades,
        u.nombre AS unidad,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        cp.nombre AS categoria,
        n.nivel,
        sn.subnivel,
        (
            SELECT GROUP_CONCAT(DISTINCT g.nombre ORDER BY g.nombre SEPARATOR ', ')
            FROM investigador_grupo ig
            INNER JOIN grupos g ON g.id_grupo = ig.id_grupo AND g.activo = 1
            WHERE ig.id_investigador = p.id_personal
        ) AS grupos,
        1 AS es_responsable
    FROM unidades u
    INNER JOIN personal p ON p.id_personal = u.responsable
    LEFT JOIN categoria_personal cp ON cp.id_categoria = p.id_categoria_personal
    LEFT JOIN nivel n ON n.id_nivel = p.id_nivel
    LEFT JOIN sub_nivel sn ON sn.id_sub_nivel = p.id_sub_nivel
    WHERE u.activo = 1 AND p.activo = 1

    UNION ALL

    SELECT DISTINCT
        u.id_unidades,
        u.nombre AS unidad,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        cp.nombre AS categoria,
        n.nivel,
        sn.subnivel,
        (
            SELECT GROUP_CONCAT(DISTINCT g.nombre ORDER BY g.nombre SEPARATOR ', ')
            FROM investigador_grupo ig
            INNER JOIN grupos g ON g.id_grupo = ig.id_grupo AND g.activo = 1
            WHERE ig.id_investigador = p.id_personal
        ) AS grupos,
        0 AS es_responsable
    FROM unidades u
    INNER JOIN personal_unidades pu ON pu.id_unidades = u.id_unidades
    INNER JOIN personal p ON p.id_personal = pu.id_personal
    LEFT JOIN categoria_personal cp ON cp.id_categoria = p.id_categoria_personal
    LEFT JOIN nivel n ON n.id_nivel = p.id_nivel
    LEFT JOIN sub_nivel sn ON sn.id_sub_nivel = p.id_sub_nivel
    WHERE u.activo = 1
      AND p.activo = 1
      AND p.id_tipo_personal = 1
      AND (u.responsable IS NULL OR p.id_personal <> u.responsable)

    ORDER BY unidad, es_responsable DESC, nombre
";

/* --------------------------------------------------
 * ADMINISTRATIVO: ÁREAS DEL ORGANIGRAMA
 * La tabla personal_direccion registra la adscripción del
 * personal a un área del organigrama.
 * -------------------------------------------------- */
$sqlAdministrativoAreas = "
    SELECT
        o.id_organigrama,
        o.area,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        c.nombre AS cargo
    FROM personal_direccion pd
    INNER JOIN organigrama o
        ON o.id_organigrama = pd.id_organigrama
    INNER JOIN personal p
        ON p.id_personal = pd.id_personal
    LEFT JOIN cargos c
        ON c.id_cargo = p.cargo
    WHERE p.activo = 1
      AND p.id_tipo_personal = 2
      AND o.activo = 1
    ORDER BY o.area, p.nombre
";

/* --------------------------------------------------
 * ADMINISTRATIVO: SECRETARÍAS Y SUS SUBÁREAS
 * -------------------------------------------------- */
$sqlAdministrativoSecretarias = "
    SELECT
        s.id_secretarias,
        COALESCE(o.area, 'Secretaría') AS area,
        s.nombre AS secretaria,
        s.tipo AS tipo_secretaria,
        sa.subarea AS subtipo_area,
        sad.departamento AS departamento_secretaria,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        c.nombre AS cargo
    FROM personal_secretarias ps
    INNER JOIN personal p
        ON p.id_personal = ps.id_personal
    INNER JOIN secretarias s
        ON s.id_secretarias = ps.id_secretarias
    LEFT JOIN organigrama o
        ON o.id_organigrama = s.id_organigrama
    LEFT JOIN subareas sa
        ON sa.id_subarea = ps.id_subarea
    LEFT JOIN subareas_departamentos sad
        ON sad.id_dep_subarea = ps.id_dep_subarea
       AND sad.id_subarea = sa.id_subarea
    LEFT JOIN cargos c
        ON c.id_cargo = p.cargo
    WHERE p.activo = 1
      AND p.id_tipo_personal = 2
      AND s.activo = 1
    ORDER BY o.area, s.nombre, sa.subarea, sad.departamento, p.nombre
";

/* --------------------------------------------------
 * ADMINISTRATIVO: UNIDADES Y SUS SUBÁREAS
 * -------------------------------------------------- */
$sqlAdministrativoUnidades = "
    SELECT
        u.id_unidades,
        COALESCE(o.area, 'Unidad') AS area,
        u.nombre AS unidad,
        u.tipo AS tipo_unidad,
        sa.subarea AS subtipo_area,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        c.nombre AS cargo
    FROM personal_unidades pu
    INNER JOIN personal p
        ON p.id_personal = pu.id_personal
    INNER JOIN unidades u
        ON u.id_unidades = pu.id_unidades
    LEFT JOIN organigrama o
        ON o.id_organigrama = u.id_organigrama
    LEFT JOIN subareas sa
        ON sa.id_subarea = pu.id_subarea
    LEFT JOIN cargos c
        ON c.id_cargo = p.cargo
    WHERE p.activo = 1
      AND p.id_tipo_personal = 2
      AND u.activo = 1
    ORDER BY o.area, u.nombre, sa.subarea, p.nombre
";

/* --------------------------------------------------
 * ADMINISTRATIVO: PERSONAL ADSCRITO A DEPARTAMENTOS
 * La tabla investigador_departamento no tiene campo rol;
 * se identifican los administrativos por id_tipo_personal = 2.
 * -------------------------------------------------- */
$sqlAdministrativoDepartamentos = "
    SELECT DISTINCT
        d.id_departamento,
        d.nombre AS departamento,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        c.nombre AS cargo
    FROM investigador_departamento idp
    INNER JOIN departamentos d ON d.id_departamento = idp.id_departamento
    INNER JOIN personal p ON p.id_personal = idp.id_investigador
    LEFT JOIN cargos c ON c.id_cargo = p.cargo
    WHERE d.activo = 1
      AND p.activo = 1
      AND p.id_tipo_personal = 2
    ORDER BY d.nombre, p.nombre
";

/* --------------------------------------------------
 * ADMINISTRATIVO: PERSONAL ADSCRITO A GRUPOS
 * Se incluyen los registros de personal administrativo vinculados
 * mediante investigador_grupo, sin depender del valor de rol.
 * -------------------------------------------------- */
$sqlAdministrativoGrupos = "
    SELECT DISTINCT
        g.id_grupo,
        g.nombre AS grupo,
        p.id_personal,
        p.nombre,
        p.foto,
        p.telefono,
        p.extension,
        p.correo,
        c.nombre AS cargo,
        ig.rol AS rol_grupo
    FROM investigador_grupo ig
    INNER JOIN grupos g ON g.id_grupo = ig.id_grupo
    INNER JOIN personal p ON p.id_personal = ig.id_investigador
    LEFT JOIN cargos c ON c.id_cargo = p.cargo
    WHERE g.activo = 1
      AND p.activo = 1
      AND p.id_tipo_personal = 2
    ORDER BY g.nombre, p.nombre
";

/* --------------------------------------------------
 * COMISIONES Y COMITÉS
 * El orden principal se define por comites_comisiones.ic_cc.
 * Las tablas de relación conservan el id_cc de cada integrante.
 * -------------------------------------------------- */
$sqlComisiones = "
    SELECT
        cc.ic_cc AS id_comision,
        cc.nombre AS comision,
        cc.descripcion,
        cc.enlace,
        cc.correo AS correo_comision,
        cc.telefono AS telefono_comision,
        p.id_personal,
        p.nombre,
        p.grado_academico,
        p.correo AS correo_persona
    FROM comites_comisiones cc
    LEFT JOIN (
        SELECT id_cc, id_personal, id_cs AS orden_integrante FROM comision_de_seguridad
        UNION ALL
        SELECT id_cc, id_personal, id_cig AS orden_integrante FROM `comisión _interna _de_género`
        UNION ALL
        SELECT id_cc, id_personal, id_cruoa AS orden_integrante FROM comision_ruoa
        UNION ALL
        SELECT id_cc, id_personal, id_ccomputo AS orden_integrante FROM comite_computo
        UNION ALL
        SELECT id_cc, id_personal, id_cddc AS orden_integrante FROM comite_difusion_divulgacion_ciencia
        UNION ALL
        SELECT id_cc, id_personal, id_cd AS orden_integrante FROM comite_docencia
        UNION ALL
        SELECT id_cc, id_personal, id_ce AS orden_integrante FROM comite_etica
        UNION ALL
        SELECT id_cc, id_personal, id_sb AS orden_integrante FROM subcomite_becas
        UNION ALL
        SELECT id_cc, id_personal, id_ce AS orden_integrante FROM comite_editorial
        UNION ALL
        SELECT id_cc, id_personal, id_cp AS orden_integrante FROM comite_planeacion
        UNION ALL
        SELECT id_cc, id_personal, id_cr AS orden_integrante FROM comite_repositorios
    ) integrantes ON integrantes.id_cc = cc.ic_cc
    LEFT JOIN personal p ON p.id_personal = integrantes.id_personal
    WHERE cc.activo = 1
    ORDER BY cc.ic_cc ASC, integrantes.orden_integrante ASC
";

/** Ejecuta una consulta y devuelve todas sus filas. */
function directorioConsultar(PDO $pdo, string $sql): array
{
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/** Imprime texto escapado, sin generar avisos por valores NULL. */
function directorioE($valor): string
{
    return htmlspecialchars((string)($valor ?? ''), ENT_QUOTES, 'UTF-8');
}

/** Devuelve la prioridad institucional del cargo (1 = mayor prioridad). */
function directorioPrioridadCargo($cargo): int
{
    $cargo = strtolower(trim((string)($cargo ?? '')));
    $cargo = strtr($cargo, [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
        'ü' => 'u', 'ñ' => 'n'
    ]);

    // Las expresiones más específicas se evalúan antes que las generales.
    $prioridades = [
        1  => ['director', 'directora'],
        2  => ['coordinador', 'coordinadora'],
        3  => ['jefe de departamento', 'jefa de departamento'],
        4  => ['jefe administrativo', 'jefa administrativa'],
        5  => ['jefe de seccion', 'jefa de seccion'],
        6  => ['jefe de oficina', 'jefa de oficina'],
        7  => ['jefe de area', 'jefa de area'],
        8  => ['jefe de servicios', 'jefa de servicios'],
        9  => ['secretario', 'secretaria'],
        10 => ['asistente', 'asitente'],
        11 => ['tecnico', 'tecnica'],
        12 => ['oficial'],
        14 => ['fotocopista'],
        15 => ['laboratorista'],
        16 => ['auxiliar de laboratorio', 'auxiliar de loratorio'],
        17 => ['almacenista'],
        18 => ['intendencia'],
        19 => ['vigilancia'],
        20 => ['stunam'],
        13 => ['auxiliar'],
    ];

    // Evita clasificar 'Subdirector' como 'Director'.
    if (strpos($cargo, 'subdirector') !== false || strpos($cargo, 'subdirectora') !== false) {
        return 99;
    }

    foreach ($prioridades as $prioridad => $terminos) {
        foreach ($terminos as $termino) {
            if (strpos($cargo, $termino) !== false) {
                return $prioridad;
            }
        }
    }

    return 99;
}

/** Normaliza texto para comparar nombres de secretarías, áreas y cargos. */
function directorioNormalizarTexto($texto): string
{
    $texto = trim((string)($texto ?? ''));
    $texto = strtr($texto, [
        'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
        'Ü' => 'u', 'Ñ' => 'n',
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
        'ü' => 'u', 'ñ' => 'n'
    ]);
    return strtolower($texto);
}

/**
 * Prioridad de cargos específica para cada organigrama de Secretaría.
 * Los rangos se basan en el listado proporcionado y no afectan otras secciones.
 */
function directorioPrioridadCargoSecretaria($cargo, $secretaria, $subtipo = '', $departamento = ''): int
{
    $cargoNorm = directorioNormalizarTexto($cargo);
    // En el catálogo institucional algunos cargos se guardan con formas
    // inclusivas como "Jefa(e)" y "Secretaria(o)".
    $cargoNorm = str_replace(['jefa(e)', 'jefe(a)', 'secretaria(o)'], ['jefe', 'jefe', 'secretaria'], $cargoNorm);
    $cargoNorm = preg_replace('/^jefa(?=\s)/u', 'jefe', $cargoNorm);
    $secretariaNorm = directorioNormalizarTexto($secretaria);
    $subtipoNorm = directorioNormalizarTexto($subtipo);
    $departamentoNorm = directorioNormalizarTexto($departamento);
    $contexto = $secretariaNorm . ' ' . $subtipoNorm . ' ' . $departamentoNorm;

    // El cargo genérico "Jefa(e) del departamento" se prioriza dentro
    // de su subárea, aunque la base de datos lo tenga ligado a un departamento
    // interno (Presupuesto, Adquisiciones o Recursos Humanos).
    if (strpos($cargoNorm, 'jefe del departamento') !== false) {
        if (
            (strpos($subtipoNorm, 'recursos financieros') !== false && (strpos($departamentoNorm, 'presupuesto') !== false || $departamentoNorm === '')) ||
            (strpos($subtipoNorm, 'bienes y suministros') !== false && (strpos($departamentoNorm, 'adquis') !== false || $departamentoNorm === '')) ||
            (strpos($subtipoNorm, 'recursos humanos') !== false && (strpos($departamentoNorm, 'recursos humanos') !== false || $departamentoNorm === ''))
        ) {
            return 1;
        }
    }

    // Cada organigrama conserva únicamente los cargos y el orden indicados.
    if (strpos($secretariaNorm, 'secretaria academica') !== false) {
        $orden = ['asistente', 'secretaria'];
    } elseif (strpos($secretariaNorm, 'secretaria tecnica') !== false) {
        $orden = ['secretaria'];
    } elseif (strpos($secretariaNorm, 'secretaria administrativa') !== false) {
        if (strpos($contexto, 'recursos financieros') !== false) {
            $orden = [
                'jefe del departamento de presupuesto',
                'jefe de seccion',
                'jefe de oficina',
                'auxiliar contable',
                'secretaria'
            ];
        } elseif (strpos($contexto, 'bienes y suministros') !== false) {
            $orden = [
                'jefe del departamento de adquisiciones',
                'jefe administrativo',
                'jefe de seccion',
                'almacenista',
                'tecnico',
                'secretaria'
            ];
        } elseif (strpos($contexto, 'recursos humanos') !== false) {
            $orden = [
                'jefe del departamento de recursos humanos',
                'secretaria'
            ];
        } elseif (strpos($contexto, 'area de servicios') !== false) {
            $orden = [
                'jefe de area',
                'jefe de servicios',
                'tecnico'
            ];
        } elseif (strpos($contexto, 'servicios generales') !== false) {
            $orden = [
                'jefe de oficina',
                'oficial de transporte especializado',
                'fotocopista'
            ];
        } elseif (strpos($contexto, 'vigilancia') !== false) {
            $orden = ['vigilancia'];
        } elseif (strpos($contexto, 'intendencia') !== false) {
            $orden = ['intendencia'];
        } else {
            // Personal adscrito directamente a Secretaría Administrativa.
            $orden = ['secretaria'];
        }
    } else {
        $orden = [];
    }

    foreach ($orden as $prioridad => $termino) {
        if ($cargoNorm === $termino || strpos($cargoNorm, $termino) !== false) {
            return $prioridad + 1;
        }
    }

    // Los cargos no contemplados en el organigrama quedan al final.
    return 99;
}

/** Etiqueta el cargo de jefatura con el nombre del departamento del organigrama. */
function directorioEtiquetaCargoSecretaria($cargo, $subtipo): string
{
    $cargoOriginal = trim((string)$cargo);
    $cargoNorm = directorioNormalizarTexto($cargoOriginal);
    $subtipoNorm = directorioNormalizarTexto($subtipo);

    if (strpos($cargoNorm, 'jefe del departamento') !== false) {
        if (strpos($subtipoNorm, 'recursos financieros') !== false) {
            return 'Jefe del departamento de presupuesto';
        }
        if (strpos($subtipoNorm, 'bienes y suministros') !== false) {
            return 'Jefe del departamento de adquisiciones';
        }
        if (strpos($subtipoNorm, 'recursos humanos') !== false) {
            return 'Jefa del departamento de Recursos Humanos';
        }
    }

    return $cargoOriginal !== '' ? $cargoOriginal : 'Sin cargo especificado';
}

/** Ordena las subáreas según el organigrama tabulado de Secretaría Administrativa. */
function directorioOrdenarSubareasSecretaria(array $subareas, $secretaria): array
{
    if (strpos(directorioNormalizarTexto($secretaria), 'secretaria administrativa') === false) {
        return $subareas;
    }

    $orden = [
        'sin subtipo especificado',
        'recursos financieros',
        'bienes y suministros',
        'recursos humanos',
        'area de servicios',
        'servicios generales',
        'vigilancia',
        'intendencia'
    ];

    uksort($subareas, static function ($a, $b) use ($orden): int {
        $aNorm = directorioNormalizarTexto($a);
        $bNorm = directorioNormalizarTexto($b);
        $aPos = array_search($aNorm, $orden, true);
        $bPos = array_search($bNorm, $orden, true);
        $aPos = ($aPos === false) ? 99 : $aPos;
        $bPos = ($bPos === false) ? 99 : $bPos;
        return $aPos === $bPos ? strcasecmp((string)$a, (string)$b) : ($aPos <=> $bPos);
    });

    return $subareas;
}

/** Agrupa personas por cargo siguiendo la jerarquía propia de su Secretaría. */
function directorioAgruparPorCargoSecretaria(array $personas, $secretaria, $subtipo = '', $departamento = ''): array
{
    usort($personas, static function (array $a, array $b) use ($secretaria, $subtipo, $departamento): int {
        $prioridadA = directorioPrioridadCargoSecretaria($a['cargo'] ?? '', $secretaria, $subtipo, $departamento);
        $prioridadB = directorioPrioridadCargoSecretaria($b['cargo'] ?? '', $secretaria, $subtipo, $departamento);
        if ($prioridadA !== $prioridadB) {
            return $prioridadA <=> $prioridadB;
        }
        $cargoA = (string)($a['cargo'] ?? '');
        $cargoB = (string)($b['cargo'] ?? '');
        $comparacionCargo = strcasecmp($cargoA, $cargoB);
        return $comparacionCargo !== 0
            ? $comparacionCargo
            : strcasecmp((string)($a['nombre'] ?? ''), (string)($b['nombre'] ?? ''));
    });

    $agrupados = [];
    foreach ($personas as $persona) {
        $cargo = trim((string)($persona['cargo'] ?? ''));
        $etiqueta = $cargo !== '' ? $cargo : 'Sin cargo especificado';
        $agrupados[$etiqueta][] = $persona;
    }
    return $agrupados;
}

/** Agrupa personas por nombre de cargo y conserva el orden de prioridad. */
function directorioAgruparPorCargo(array $personas): array
{
    usort($personas, static function (array $a, array $b): int {
        $prioridadA = directorioPrioridadCargo($a['cargo'] ?? '');
        $prioridadB = directorioPrioridadCargo($b['cargo'] ?? '');

        if ($prioridadA !== $prioridadB) {
            return $prioridadA <=> $prioridadB;
        }

        $cargoA = (string)($a['cargo'] ?? '');
        $cargoB = (string)($b['cargo'] ?? '');
        $comparacionCargo = strcasecmp($cargoA, $cargoB);
        return $comparacionCargo !== 0
            ? $comparacionCargo
            : strcasecmp((string)($a['nombre'] ?? ''), (string)($b['nombre'] ?? ''));
    });

    $agrupados = [];
    foreach ($personas as $persona) {
        $cargo = trim((string)($persona['cargo'] ?? ''));
        $etiqueta = $cargo !== '' ? $cargo : 'Sin cargo especificado';
        $agrupados[$etiqueta][] = $persona;
    }

    return $agrupados;
}

/** Datos de contacto comunes para todas las pestañas. */
function directorioAbreviarGrado($grado): string
{
    $grado = trim((string)($grado ?? ''));
    if ($grado === '') {
        return '';
    }

    // Normaliza vocales acentuadas sin depender de la extensión mbstring.
    $normalizado = strtr($grado, ['Á' => 'á', 'É' => 'é', 'Í' => 'í', 'Ó' => 'ó', 'Ú' => 'ú']);
    $normalizado = strtolower($normalizado);
    $normalizado = strtr($normalizado, ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u']);

    if (strpos($normalizado, 'doctorado') === 0 || strpos($normalizado, 'doctor') === 0) {
        return 'Dr(a).';
    }
    if (strpos($normalizado, 'maestria') === 0 || strpos($normalizado, 'maestro') === 0 || strpos($normalizado, 'maestra') === 0) {
        return 'Mtra(o).';
    }
    if (strpos($normalizado, 'licenciatura') === 0 || strpos($normalizado, 'licenciado') === 0 || strpos($normalizado, 'licenciada') === 0) {
        return 'Lic.';
    }

    return $grado;
}

/** Construye una ruta pública segura para la fotografía del personal académico. */
function directorioFotoAcademico($foto): string
{
    $foto = trim((string)($foto ?? ''));
    if ($foto === '') {
        return '/assets/img/avatar.png';
    }

    // El campo almacena únicamente el nombre del archivo.
    return '/investigadores/img/' . rawurlencode(basename($foto));
}

/** Datos de contacto comunes para todas las pestañas. */
function directorioContacto(array $persona): void
{
    $telefono = trim((string)($persona['telefono'] ?? ''));
    $extension = trim((string)($persona['extension'] ?? ''));
    $correo = trim((string)($persona['correo'] ?? ''));
    ?>
    <div class="small text-muted mt-2">
        <?php if ($telefono !== ''): ?>
            <span class="me-3"><i class="bi bi-telephone me-1"></i><?= directorioE($telefono); ?></span>
        <?php endif; ?>
        <?php if ($extension !== ''): ?>
            <span class="me-3">Ext. <?= directorioE($extension); ?></span>
        <?php endif; ?>
        <?php if ($correo !== ''): ?>
            <a href="mailto:<?= directorioE($correo); ?>"><i class="bi bi-envelope me-1"></i><?= directorioE($correo); ?></a>
        <?php endif; ?>
    </div>
    <?php
}
