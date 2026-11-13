<?php
/* Agenda pública ICAyCC. Incluir después de definir la función e() y cargar config.php. */
$eventos = [];
$agendaDatosCalendario = [];

$mesesAgenda = [
    1=>'ENE',2=>'FEB',3=>'MAR',4=>'ABR',5=>'MAY',6=>'JUN',
    7=>'JUL',8=>'AGO',9=>'SEP',10=>'OCT',11=>'NOV',12=>'DIC'
];

/* PORTADA: únicamente los cinco eventos cuyo inicio aún no ha llegado. */
$sqlProximos = "
    SELECT id_evento, titulo, descripcion, categoria, fecha_inicio, fecha_fin,
           lugar, direccion, enlace, imagen
    FROM eventos
    WHERE activo = 1
      AND fecha_inicio >= NOW()
    ORDER BY fecha_inicio ASC
    LIMIT 5
";
$proximos = $pdo->query($sqlProximos)->fetchAll(PDO::FETCH_ASSOC);

foreach ($proximos as $ev) {
    $inicio = new DateTime($ev['fecha_inicio']);
    $resumen = trim(preg_replace('/\\s+/', ' ', strip_tags($ev['descripcion'] ?? '')));
    if (mb_strlen($resumen, 'UTF-8') > 190) {
        $resumen = mb_substr($resumen, 0, 187, 'UTF-8') . '...';
    }
    $detalle = $inicio->format('H:i') . ' h';
    if (!empty($ev['lugar'])) $detalle .= ' · ' . $ev['lugar'];
    if ($resumen !== '') $detalle .= ' · ' . $resumen;

    $eventos[] = [
        'id' => (int)$ev['id_evento'],
        'dia' => $inicio->format('d'),
        'mes' => $mesesAgenda[(int)$inicio->format('n')],
        'titulo' => $ev['titulo'],
        'detalle' => $detalle,
        'enlace' => $ev['enlace']
    ];
}

/* CALENDARIO: todos los eventos activos que no han finalizado, sin LIMIT. */
$sqlCalendario = "
    SELECT id_evento, titulo, fecha_inicio, fecha_fin, lugar, enlace
    FROM eventos
    WHERE activo = 1
      AND fecha_fin >= NOW()
    ORDER BY fecha_inicio ASC
";
$agendaCalendario = $pdo->query($sqlCalendario)->fetchAll(PDO::FETCH_ASSOC);

foreach ($agendaCalendario as $ev) {
    $inicio = new DateTime($ev['fecha_inicio']);
    $fin = new DateTime($ev['fecha_fin']);
    $agendaDatosCalendario[] = [
        'id' => (int)$ev['id_evento'],
        'titulo' => $ev['titulo'],
        'inicio' => $inicio->format('Y-m-d H:i:s'),
        'fin' => $fin->format('Y-m-d H:i:s'),
        'lugar' => $ev['lugar'] ?? '',
        'enlace' => $ev['enlace'] ?? ''
    ];
}
?>
