<?php
/*
 * Vista del módulo de Actualidad.
 * Incluir dentro del contenedor principal de secciones.php,
 * en el lugar donde debe aparecer la tarjeta de Actualidad.
 */
?>

<div class="col-md-12 mx-auto" id="actualidad-admin">
    <div class="card bg-primary text-white">
        <div class="card-header">
            <i class="fa-solid fa-images me-2"></i>Actualidad
        </div>

        <div class="card-body bg-light text-dark">

            <?php if (!empty($actualidadError)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($actualidadError, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <?php if (is_array($actualidadFlash)): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($actualidadFlash['texto'] ?? 'Operación realizada.', ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <button
                class="btn btn-success mb-3"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseActualidad"
                aria-expanded="<?= $edicionActualidad ? 'true' : 'false' ?>"
                aria-controls="collapseActualidad">
                <i class="fa-solid fa-plus me-2"></i>
                <?= $edicionActualidad ? 'Editar publicación' : 'Nueva publicación' ?>
            </button>

            <div class="collapse <?= $edicionActualidad ? 'show' : '' ?>" id="collapseActualidad">
                <div class="card card-body mb-4">
                    <h5 class="mb-3">
                        <?= $edicionActualidad ? 'Editar publicación' : 'Registrar publicación' ?>
                    </h5>

                    <form method="POST" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="csrf_actualidad"
                               value="<?= htmlspecialchars($_SESSION['csrf_actualidad'], ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" name="id_actualidad"
                               value="<?= (int)($edicionActualidad['id_actualidad'] ?? 0) ?>">

                        <div class="mb-3">
                            <label for="tituloActualidad" class="form-label">Título de la publicación</label>
                            <input
                                type="text"
                                name="titulo"
                                id="tituloActualidad"
                                class="form-control"
                                maxlength="255"
                                value="<?= htmlspecialchars($edicionActualidad['titulo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="imagenActualidad" class="form-label">Imagen del carrusel</label>

                            <?php if ($edicionActualidad && !empty($edicionActualidad['imagen'])): ?>
                                <div class="mb-3">
                                    <div class="small text-secondary mb-2">Imagen actualmente registrada:</div>
                                    <img
                                        src="../../../<?= htmlspecialchars($edicionActualidad['imagen'], ENT_QUOTES, 'UTF-8') ?>"
                                        alt="Imagen actual de la publicación"
                                        class="img-fluid rounded border"
                                        style="max-height:190px">
                                </div>
                            <?php endif; ?>

                            <input
                                type="file"
                                name="imagen"
                                id="imagenActualidad"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                                <?= $edicionActualidad ? '' : 'required' ?>>

                            <div class="form-text">
                                <?= $edicionActualidad
                                    ? 'Si no seleccionas otra imagen, se conservará la actual.'
                                    : 'Formato horizontal recomendado: 1400 × 600 px. JPG, PNG o WebP. Máximo 5 MB.'
                                ?>
                            </div>

                            <div class="mt-3 text-center">
                                <img
                                    id="previewActualidad"
                                    src=""
                                    alt="Vista previa de la nueva imagen"
                                    class="img-fluid rounded"
                                    style="display:none; max-height:220px">
                            </div>
                        </div>

                        <hr>
                        <h6 class="mb-3"><i class="fa-solid fa-calendar-days me-2"></i>Programación</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fechaPublicacion" class="form-label">Fecha de publicación</label>
                                <input
                                    type="date"
                                    name="fecha_publicacion"
                                    id="fechaPublicacion"
                                    class="form-control"
                                    value="<?= htmlspecialchars($edicionActualidad['fecha_publicacion'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fechaDespublicacion" class="form-label">Fecha de despublicación</label>
                                <input
                                    type="date"
                                    name="fecha_despublicacion"
                                    id="fechaDespublicacion"
                                    class="form-control"
                                    value="<?= htmlspecialchars($edicionActualidad['fecha_despublicacion'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <div class="form-text">Último día visible. Dejar vacío para no establecer fecha final.</div>
                            </div>
                        </div>

                        <hr>
                        <h6 class="mb-3"><i class="fa-solid fa-link me-2"></i>Enlaces</h6>

                        <div class="mb-3">
                            <label for="enlaceMas" class="form-label">Enlace Ver más</label>
                            <input
                                type="url"
                                name="enlace_mas"
                                id="enlaceMas"
                                class="form-control"
                                placeholder="https://..."
                                value="<?= htmlspecialchars($edicionActualidad['enlace_mas'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="enlaceCartel" class="form-label">Enlace Cartel</label>
                            <input
                                type="url"
                                name="enlace_cartel"
                                id="enlaceCartel"
                                class="form-control"
                                placeholder="https://..."
                                value="<?= htmlspecialchars($edicionActualidad['enlace_cartel'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ordenActualidad" class="form-label">Orden de aparición</label>
                                <input
                                    type="number"
                                    name="orden"
                                    id="ordenActualidad"
                                    class="form-control"
                                    min="1"
                                    step="1"
                                    value="<?= (int)($edicionActualidad['orden'] ?? 1) ?>"
                                    required>
                                <div class="form-text">Los números menores aparecen primero dentro de cada estado.</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label d-block">Estado</label>
                                <div class="form-check form-switch mt-2">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="activo"
                                        id="activoActualidad"
                                        <?= (($edicionActualidad['activo'] ?? 1) == 1) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="activoActualidad">Publicación activa</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" name="guardar_actualidad" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk me-2"></i>
                                <?= $edicionActualidad ? 'Actualizar publicación' : 'Guardar publicación' ?>
                            </button>

                            <?php if ($edicionActualidad): ?>
                                <a href="secciones.php#actualidad-admin" class="btn btn-secondary">
                                    Cancelar edición
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <hr>
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                <h5 class="mb-0">Publicaciones registradas</h5>
                <span class="badge bg-dark"><?= number_format($totalActualidad) ?> registros</span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Imagen</th>
                            <th>Título</th>
                            <th>Periodo</th>
                            <th class="text-center">Orden</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($resultActualidad->num_rows === 0): ?>
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-4">
                                Todavía no hay publicaciones registradas.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php
                        $hoyActualidad = date('Y-m-d');
                        while ($item = $resultActualidad->fetch_assoc()):
                            if ((int)$item['activo'] === 0) {
                                $estadoActualidad = 'Inactiva';
                                $claseActualidad = 'secondary';
                            } elseif (!empty($item['fecha_despublicacion']) && $item['fecha_despublicacion'] < $hoyActualidad) {
                                $estadoActualidad = 'Finalizada';
                                $claseActualidad = 'warning';
                            } elseif ($item['fecha_publicacion'] > $hoyActualidad) {
                                $estadoActualidad = 'Programada';
                                $claseActualidad = 'info';
                            } else {
                                $estadoActualidad = 'Publicada';
                                $claseActualidad = 'success';
                            }
                        ?>
                            <tr>
                                <td style="width:150px; min-width:120px">
                                    <img
                                        src="../../../<?= htmlspecialchars($item['imagen'], ENT_QUOTES, 'UTF-8') ?>"
                                        alt="Imagen de <?= htmlspecialchars($item['titulo'], ENT_QUOTES, 'UTF-8') ?>"
                                        class="img-fluid rounded"
                                        style="max-width:130px">
                                </td>
                                <td><?= htmlspecialchars($item['titulo'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td>
                                    <small>
                                        <strong>Inicio:</strong>
                                        <?= date('d/m/Y', strtotime($item['fecha_publicacion'])) ?>
                                    </small>
                                    <br>
                                    <small>
                                        <strong>Fin:</strong>
                                        <?= !empty($item['fecha_despublicacion'])
                                            ? date('d/m/Y', strtotime($item['fecha_despublicacion']))
                                            : 'Sin fecha final'
                                        ?>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-dark"><?= (int)$item['orden'] ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $claseActualidad ?>">
                                        <?= $estadoActualidad ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a
                                        href="secciones.php?editar_actualidad=<?= (int)$item['id_actualidad'] ?>&pagina=<?= (int)$actualidadPagina ?>#actualidad-admin"
                                        class="btn btn-sm btn-primary"
                                        title="Editar publicación">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-2">
                <div class="text-secondary small">
                    Mostrando
                    <?= $totalActualidad > 0 ? $actualidadOffset + 1 : 0 ?>
                    -
                    <?= min($actualidadOffset + $actualidadPorPagina, $totalActualidad) ?>
                    de <?= $totalActualidad ?> publicaciones
                </div>

                <?php if ($totalPaginasActualidad > 1): ?>
                    <nav aria-label="Paginación de actualidad">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item <?= $actualidadPagina <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link"
                                   href="?pagina=<?= max(1, $actualidadPagina - 1) ?>#actualidad-admin"
                                   aria-label="Anterior">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </a>
                            </li>

                            <?php
                            $inicioPagActualidad = max(1, $actualidadPagina - 2);
                            $finPagActualidad = min($totalPaginasActualidad, $actualidadPagina + 2);
                            for ($i = $inicioPagActualidad; $i <= $finPagActualidad; $i++):
                            ?>
                                <li class="page-item <?= $i === $actualidadPagina ? 'active' : '' ?>">
                                    <a class="page-link" href="?pagina=<?= $i ?>#actualidad-admin"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?= $actualidadPagina >= $totalPaginasActualidad ? 'disabled' : '' ?>">
                                <a class="page-link"
                                   href="?pagina=<?= min($totalPaginasActualidad, $actualidadPagina + 1) ?>#actualidad-admin"
                                   aria-label="Siguiente">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputImagen = document.getElementById('imagenActualidad');
    const preview = document.getElementById('previewActualidad');
    const fechaInicio = document.getElementById('fechaPublicacion');
    const fechaFin = document.getElementById('fechaDespublicacion');

    if (inputImagen && preview) {
        inputImagen.addEventListener('change', function () {
            const archivo = this.files && this.files[0];

            if (!archivo) {
                preview.removeAttribute('src');
                preview.style.display = 'none';
                return;
            }

            if (!['image/jpeg', 'image/png', 'image/webp'].includes(archivo.type)) {
                if (window.Swal) {
                    Swal.fire({icon: 'warning', title: 'Formato no permitido', text: 'Selecciona una imagen JPG, PNG o WebP.'});
                } else {
                    alert('Selecciona una imagen JPG, PNG o WebP.');
                }
                this.value = '';
                preview.style.display = 'none';
                return;
            }

            preview.src = URL.createObjectURL(archivo);
            preview.style.display = 'inline-block';
        });
    }

    if (fechaInicio && fechaFin) {
        const validarFechas = function () {
            fechaFin.min = fechaInicio.value || '';

            if (fechaFin.value && fechaInicio.value && fechaFin.value < fechaInicio.value) {
                fechaFin.value = '';
                if (window.Swal) {
                    Swal.fire({icon: 'warning', title: 'Fecha incorrecta', text: 'La fecha final no puede ser anterior a la inicial.'});
                }
            }
        };

        fechaInicio.addEventListener('change', validarFechas);
        fechaFin.addEventListener('change', validarFechas);
        validarFechas();
    }
});
</script>
<?php
if (isset($stmtListadoActualidad) && $stmtListadoActualidad instanceof mysqli_stmt) {
    $stmtListadoActualidad->close();
}
?>
