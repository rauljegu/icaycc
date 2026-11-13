<section id="agendaAdmin" class="mt-4">
<div class="card bg-primary text-white">
  <div class="card-header"><i class="fa-regular fa-calendar-days me-2"></i>Agenda del Instituto</div>
  <div class="card-body bg-light text-dark">
    <?php
      $valorAgenda = function($campo, $predeterminado='') use ($agendaEditar) {
          if (!$agendaEditar) return $predeterminado;
          if (in_array($campo,['fecha_inicio','fecha_fin'],true)) {
              return date('Y-m-d\TH:i', strtotime($agendaEditar[$campo]));
          }
          return $agendaEditar[$campo] ?? $predeterminado;
      };
    ?>
    <?php if (is_array($agendaMensaje)): ?>
      <div class="alert alert-<?= agenda_h($agendaMensaje['tipo']) ?>"><?= agenda_h($agendaMensaje['texto']) ?></div>
    <?php elseif ($agendaMensaje !== ''): ?>
      <div class="alert alert-danger"><?= agenda_h($agendaMensaje) ?></div>
    <?php endif; ?>

    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#formAgenda" aria-expanded="<?= $agendaEditar ? 'true':'false' ?>">
      <i class="fa-solid fa-plus me-2"></i><?= $agendaEditar ? 'Editar evento':'Registrar nuevo evento' ?>
    </button>
    <div class="collapse <?= $agendaEditar ? 'show':'' ?>" id="formAgenda">
      <div class="card card-body mb-4">
        <h5><?= $agendaEditar ? 'Modificar evento':'Nuevo evento' ?></h5>
        <form method="POST" enctype="multipart/form-data" autocomplete="off">
          <input type="hidden" name="csrf_agenda" value="<?= agenda_h($_SESSION['csrf_agenda']) ?>">
          <?php if ($agendaEditar): ?><input type="hidden" name="id_evento" value="<?= (int)$agendaEditar['id_evento'] ?>"><?php endif; ?>
          <div class="mb-3">
            <label class="form-label">Título *</label>
            <input class="form-control" name="titulo" maxlength="255" required value="<?= agenda_h($valorAgenda('titulo')) ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <div id="agendaEditor" class="agenda-editor" style="display:none"><?= agenda_sanitizar_descripcion((string)$valorAgenda('descripcion')) ?></div>
            <textarea id="agendaDescripcion" name="descripcion" class="form-control" rows="8"><?= agenda_h(agenda_sanitizar_descripcion((string)$valorAgenda('descripcion'))) ?></textarea>
            <div class="form-text">Puedes aplicar encabezados, negritas, cursivas, colores, tamaños, alineación, listas, enlaces y tablas. Las imágenes del evento se administran mediante el campo de cartel.</div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Categoría</label>
              <select class="form-select" name="categoria">
                <?php $cats=['Seminario','Conferencia','Curso','Taller','Evento especial','Otro']; $catActual=$valorAgenda('categoria'); ?>
                <option value="">Selecciona una categoría</option>
                <?php foreach($cats as $cat): ?><option value="<?= agenda_h($cat) ?>" <?= $catActual===$cat?'selected':'' ?>><?= agenda_h($cat) ?></option><?php endforeach; ?>
                <?php if($catActual!=='' && !in_array($catActual,$cats,true)): ?><option selected value="<?= agenda_h($catActual) ?>"><?= agenda_h($catActual) ?></option><?php endif; ?>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Organizador</label>
              <input class="form-control" name="organizador" maxlength="255" value="<?= agenda_h($valorAgenda('organizador')) ?>">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3"><label class="form-label">Fecha y hora de inicio *</label><input type="datetime-local" class="form-control" name="fecha_inicio" required value="<?= agenda_h($valorAgenda('fecha_inicio')) ?>"></div>
            <div class="col-md-6 mb-3"><label class="form-label">Fecha y hora de término *</label><input type="datetime-local" class="form-control" name="fecha_fin" required value="<?= agenda_h($valorAgenda('fecha_fin')) ?>"></div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3"><label class="form-label">Lugar</label><input class="form-control" name="lugar" maxlength="255" value="<?= agenda_h($valorAgenda('lugar')) ?>"></div>
            <div class="col-md-6 mb-3"><label class="form-label">Dirección</label><input class="form-control" name="direccion" maxlength="500" value="<?= agenda_h($valorAgenda('direccion')) ?>"></div>
          </div>
          <div class="mb-3"><label class="form-label">Enlace del evento</label><input type="url" class="form-control" name="enlace" placeholder="https://..." value="<?= agenda_h($valorAgenda('enlace')) ?>"></div>
          <div class="mb-3">
            <label class="form-label">Imagen o cartel <?= $agendaEditar ? '(opcional; deja vacío para conservar la actual)':'(opcional)' ?></label>
            <input type="file" class="form-control" name="imagen" accept=".jpg,.jpeg,.png,.webp">
            <div class="form-text">JPG, PNG o WebP. Máximo 5 MB.</div>
            <?php if($agendaEditar && !empty($agendaEditar['imagen'])): ?><div class="mt-2"><img src="../../../<?= agenda_h($agendaEditar['imagen']) ?>" alt="Cartel actual" style="max-width:180px;max-height:130px" class="rounded"></div><?php endif; ?>
          </div>
          <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" name="activo" id="agendaActivo" <?= !$agendaEditar || (int)$agendaEditar['activo']===1?'checked':'' ?>>
            <label class="form-check-label" for="agendaActivo">Evento activo y visible en la agenda pública</label>
          </div>
          <?php if ($agendaEditar && (int)$agendaEditar['activo'] === 0): ?>
            <div class="alert alert-info py-2 small mb-3"><i class="fa-solid fa-circle-info me-1"></i>Este evento está inactivo. Para reactivarlo, marca el interruptor <strong>Evento activo y visible en la agenda pública</strong> y pulsa <strong>Guardar cambios</strong>.</div>
          <?php else: ?>
            <div class="form-text mb-3">Para reactivar un evento que fue desactivado, entra en <strong>Editar</strong>, activa este interruptor y guarda los cambios.</div>
          <?php endif; ?>
          <button class="btn btn-primary" type="submit" name="<?= $agendaEditar ? 'actualizar_evento':'guardar_evento' ?>"><i class="fa-solid fa-floppy-disk me-2"></i><?= $agendaEditar ? 'Guardar cambios':'Registrar evento' ?></button>
          <?php if($agendaEditar): ?><a href="secciones.php#agendaAdmin" class="btn btn-outline-secondary">Cancelar edición</a><?php endif; ?>
        </form>
      </div>
    </div>

    <hr>
    <h5 class="mb-2">Eventos registrados <small class="text-muted">(<?= $total ?>)</small></h5>
    <div class="alert alert-info py-2 small mb-3"><i class="fa-solid fa-circle-info me-1"></i>Los eventos inactivos se pueden reactivar desde <strong>Editar</strong>: activa el interruptor de publicación y selecciona <strong>Guardar cambios</strong>.</div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark"><tr><th>Título</th><th>Fecha</th><th>Estado</th><th style="min-width:175px">Acciones</th></tr></thead>
        <tbody>
        <?php if($agendaEventos->num_rows===0): ?>
          <tr><td colspan="4" class="text-center text-muted">No hay eventos registrados.</td></tr>
        <?php else: while($ev=$agendaEventos->fetch_assoc()):
          $ahora=time();
          if((int)$ev['activo']===0){$estado='Inactivo';$badge='secondary';}
          elseif(strtotime($ev['fecha_fin'])<$ahora){$estado='Finalizado';$badge='warning';}
          elseif(strtotime($ev['fecha_inicio'])>$ahora){$estado='Programado';$badge='info';}
          else{$estado='En curso';$badge='success';}
        ?>
          <tr>
            <td><?= agenda_h($ev['titulo']) ?><div class="small text-muted"><?= agenda_h($ev['categoria']) ?></div></td>
            <td><small><strong>Inicio:</strong> <?= date('d/m/Y H:i',strtotime($ev['fecha_inicio'])) ?><br><strong>Fin:</strong> <?= date('d/m/Y H:i',strtotime($ev['fecha_fin'])) ?></small></td>
            <td><span class="badge bg-<?= $badge ?>"><?= $estado ?></span></td>
            <td>
              <a class="btn btn-sm btn-info mb-1" href="secciones.php?editar_evento=<?= (int)$ev['id_evento'] ?>#agendaAdmin">Editar</a>
              <?php if((int)$ev['activo']===1): ?>
              <form method="POST" class="d-inline" onsubmit="return confirm('¿Desactivar este evento? El registro se conservará.');">
                <input type="hidden" name="csrf_agenda" value="<?= agenda_h($_SESSION['csrf_agenda']) ?>">
                <input type="hidden" name="id_evento" value="<?= (int)$ev['id_evento'] ?>">
                <button class="btn btn-sm btn-warning mb-1" name="desactivar_evento">Desactivar</button>
              </form>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>
    <?php if($agendaTotalPaginas>1): ?>
    <nav aria-label="Paginación de eventos"><ul class="pagination flex-wrap">
      <?php for($p=1;$p<=$agendaTotalPaginas;$p++): ?>
      <li class="page-item <?= $p===$agendaPagina?'active':'' ?>"><a class="page-link" href="secciones.php?pagina_agenda=<?= $p ?>#agendaAdmin"><?= $p ?></a></li>
      <?php endfor; ?>
    </ul></nav>
    <?php endif; ?>
  </div>
</div>
</section>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-lite.min.css">
<style>
.note-editor.note-frame{border-color:#ced4da;border-radius:.375rem}
.note-editor .note-editing-area .note-editable{min-height:260px;color:#212529}
.note-editor .note-toolbar{background:#f8f9fa}
.agenda-description figure.table{max-width:100%;overflow-x:auto}
.agenda-description table{width:100%;border-collapse:collapse}
.agenda-description td,.agenda-description th{border:1px solid #cbd5d8;padding:.4rem .55rem}
</style>
<script>
(function () {
  const CDN = 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/';
  const languageUrl = CDN + 'lang/summernote-es-ES.min.js';

  function loadScript(url) {
    return new Promise(function (resolve, reject) {
      const script = document.createElement('script');
      script.src = url;
      script.onload = resolve;
      script.onerror = reject;
      document.head.appendChild(script);
    });
  }

  function iniciarSummernote() {
    const editor = document.getElementById('agendaEditor');
    const textarea = document.getElementById('agendaDescripcion');
    if (!editor || !textarea || !window.jQuery || !jQuery.fn || !jQuery.fn.summernote) return;

    const $editor = jQuery(editor);
    const $textarea = jQuery(textarea);
    const $form = $editor.closest('form');

    $editor.summernote({
      lang: 'es-ES',
      height: 260,
      minHeight: 220,
      maxHeight: 600,
      tabsize: 2,
      dialogsInBody: true,
      disableDragAndDrop: true,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link']],
        ['view', ['undo', 'redo', 'fullscreen', 'help']]
      ],
      styleTags: ['p', 'blockquote', 'h1', 'h2', 'h3', 'h4'],
      fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia', 'Helvetica', 'Tahoma', 'Times New Roman', 'Trebuchet MS', 'Verdana'],
      fontNamesIgnoreCheck: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia', 'Helvetica', 'Tahoma', 'Times New Roman', 'Trebuchet MS', 'Verdana'],
      callbacks: {
        onPaste: function (e) {
          // Evita que pegar imágenes convierta la descripción en cadenas Base64.
          const clipboard = (e.originalEvent || e).clipboardData;
          if (clipboard && clipboard.items) {
            for (let i = 0; i < clipboard.items.length; i++) {
              if (clipboard.items[i].type && clipboard.items[i].type.indexOf('image/') === 0) {
                e.preventDefault();
                alert('Para agregar el cartel utiliza el campo Imagen del evento.');
                return false;
              }
            }
          }
        }
      }
    });

    if ($form.length) {
      $form.on('submit', function () {
        $textarea.val($editor.summernote('code'));
      });
    }
  }

  function cargarDependencias() {
    const jqPromise = window.jQuery
      ? Promise.resolve()
      : loadScript('https://code.jquery.com/jquery-3.7.1.min.js');

    jqPromise
      .then(function () { return loadScript(CDN + 'summernote-lite.min.js'); })
      .then(function () {
        return loadScript(languageUrl).catch(function () {
          // Si el archivo de idioma no está disponible, se conserva el editor en inglés.
        });
      })
      .then(function () {
        iniciarSummernote();
        const editor = document.getElementById('agendaEditor');
        const textarea = document.getElementById('agendaDescripcion');
        if (editor && textarea && window.jQuery && jQuery.fn && jQuery.fn.summernote) {
          editor.style.display = 'block';
          textarea.style.display = 'none';
        }
      })
      .catch(function (error) {
        console.error('No se pudo cargar Summernote:', error);
        const campo = document.getElementById('agendaDescripcion');
        if (campo) {
          campo.insertAdjacentHTML('afterend', '<div class="form-text text-warning">No se pudo cargar el editor visual. Puedes escribir la descripción como texto; vuelve a intentar más tarde para usar el formato enriquecido.</div>');
        }
      });
  }

  if (document.readyState === 'complete') cargarDependencias();
  else window.addEventListener('load', cargarDependencias, { once: true });
})();
</script>
