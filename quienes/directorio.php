<?php
require_once __DIR__ . '/../config/config.php';

// Las consultas y la presentación se mantienen separadas.
require_once __DIR__ . '/llamados.php';
?>
<div class="container py-5">
    <h1 class="mb-4">DIRECTORIO</h1>

    <div class="nav nav-tabs flex-wrap" id="directorio-tab" role="tablist" aria-label="Secciones del directorio">
        <?php include __DIR__ . '/pestanas_directorio.php'; ?>
    </div>

    <div class="tab-content pt-3" id="directorio-tabContent">
        <?php include __DIR__ . '/contenido_pestanas_directorio.php'; ?>
    </div>
</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
