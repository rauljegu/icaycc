<?php
$pestanasDirectorio = [
    'institucional' => 'Institucional',
    'academico'     => 'Académicos',
    'administrativo'=> 'Administrativo',
    'comisiones'    => 'Comisiones',
];
$primeraPestana = true;
foreach ($pestanasDirectorio as $idPestana => $nombrePestana):
?>
<button
    class="nav-link boton-fondo-verde <?= $primeraPestana ? 'active' : ''; ?>"
    id="nav-<?= htmlspecialchars($idPestana, ENT_QUOTES, 'UTF-8'); ?>-tab"
    data-bs-toggle="tab"
    data-bs-target="#nav-<?= htmlspecialchars($idPestana, ENT_QUOTES, 'UTF-8'); ?>"
    type="button"
    role="tab"
    aria-controls="nav-<?= htmlspecialchars($idPestana, ENT_QUOTES, 'UTF-8'); ?>"
    aria-selected="<?= $primeraPestana ? 'true' : 'false'; ?>">
    <?= htmlspecialchars($nombrePestana, ENT_QUOTES, 'UTF-8'); ?>
</button>
<?php
    $primeraPestana = false;
endforeach;
?>
