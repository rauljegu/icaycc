<section id="eventos" class="section section-soft">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-7">
        <div class="section-kicker mb-2">Agenda del Instituto</div>
        <h2 class="section-title display-6 mb-2">Próximos eventos</h2>
        <p class="section-intro">Seminarios, conferencias, cursos y actividades académicas.</p>

        <?php if (!empty($eventos)): ?>
          <?php foreach ($eventos as $evento): ?>
            <article class="event-item">
              <div class="event-date"><strong><?= e($evento['dia']) ?></strong><span class="small"><?= e($evento['mes']) ?></span></div>
              <div class="flex-grow-1">
                <h3 class="h5 card-title mb-1"><?= e($evento['titulo']) ?></h3>
                <p class="text-secondary mb-1"><?= e($evento['detalle']) ?></p>
				<a href="<?= BASE_URL ?>comunicacion/evento.php?id=<?= e($evento['id']) ?>" target="_blank" rel="noopener noreferrer" class="small">Consultar información <i class="bi bi-box-arrow-up-right"></i></a>
                <?php if (!empty($evento['enlace'])): ?>
                  <!--<a href="<?= e($evento['enlace']) ?>" target="_blank" rel="noopener noreferrer" class="small">Consultar información <i class="bi bi-box-arrow-up-right"></i></a>-->
              
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-light border">Por el momento no hay eventos próximos programados.</div>
        <?php endif; ?>
        <a class="btn btn-outline-institutional mt-4" href="<?= BASE_URL ?>comunicacion/eventos.php">Consultar agenda completa</a>
      </div>

      <div class="col-lg-5" id="agenda-calendario">
        <div class="p-4 p-lg-5 bg-white rounded-4 shadow-sm h-100">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <div class="section-kicker mb-1">Organiza tu visita</div>
              <h3 class="h4 section-title mb-0">Calendario</h3>
            </div>
            <i class="bi bi-calendar3 fs-2" style="color:var(--icaycc-medium)" aria-hidden="true"></i>
          </div>
          <div class="agenda-calendar rounded-3 p-3" style="background:var(--icaycc-light)">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <button type="button" class="btn btn-sm btn-outline-secondary" id="agendaMesAnterior" aria-label="Mes anterior"><i class="bi bi-chevron-left"></i></button>
              <strong id="agendaMesTitulo" style="color:var(--icaycc-dark)">Calendario ICAyCC</strong>
              <button type="button" class="btn btn-sm btn-outline-secondary" id="agendaMesSiguiente" aria-label="Mes siguiente"><i class="bi bi-chevron-right"></i></button>
            </div>
            <div class="agenda-grid agenda-weekdays">
              <?php foreach (['L','M','M','J','V','S','D'] as $dia): ?><span><?= e($dia) ?></span><?php endforeach; ?>
            </div>
            <div class="agenda-grid" id="agendaDias"></div>
          </div>
          <div class="mt-3" id="agendaDetalleDia" aria-live="polite">
            <p class="small text-secondary mb-0">Selecciona un día marcado para consultar sus actividades.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(() => {
  const eventos = <?= json_encode($agendaDatosCalendario, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
  const nombresMeses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
  const contenedor = document.getElementById('agendaDias');
  const titulo = document.getElementById('agendaMesTitulo');
  const detalle = document.getElementById('agendaDetalleDia');
  if (!contenedor || !titulo || !detalle) return;

  let mesActual = new Date();
  mesActual = new Date(mesActual.getFullYear(), mesActual.getMonth(), 1);
  let diaSeleccionado = null;

  const fechaLocal = (fecha) => {
    const d = new Date(fecha);
    return new Date(d.getFullYear(), d.getMonth(), d.getDate());
  };
  const eventosDelDia = (fecha) => {
    const clave = `${fecha.getFullYear()}-${String(fecha.getMonth()+1).padStart(2,'0')}-${String(fecha.getDate()).padStart(2,'0')}`;
    return eventos.filter(ev => {
      const ini = ev.inicio.substring(0,10);
      const fin = ev.fin.substring(0,10);
      return clave >= ini && clave <= fin;
    });
  };
  const mostrarDetalle = (fecha) => {
    const lista = eventosDelDia(fecha);
    if (!lista.length) {
      detalle.innerHTML = '<p class="small text-secondary mb-0">No hay actividades registradas para este día.</p>';
      return;
    }
    const encabezado = document.createElement('p');
    encabezado.className = 'fw-bold mb-2';
    encabezado.textContent = fecha.getDate() + ' de ' + nombresMeses[fecha.getMonth()];
    detalle.replaceChildren(encabezado);
    lista.forEach(ev => {
      const articulo = document.createElement('div');
      articulo.className = 'agenda-day-event border-start border-3 ps-3 mb-3';
      const h = document.createElement('div');
      h.className = 'fw-semibold';
      h.textContent = ev.titulo;
      articulo.appendChild(h);
      const meta = document.createElement('div');
      meta.className = 'small text-secondary';
      const ini = ev.inicio.substring(11,16);
      const fin = ev.fin.substring(11,16);
      meta.textContent = ini + (fin ? '–' + fin : '') + (ev.lugar ? ' · ' + ev.lugar : '');
      articulo.appendChild(meta);
      if (ev.enlace) {
        const a = document.createElement('a');
        a.href = ev.enlace; a.target = '_blank'; a.rel = 'noopener noreferrer';
        a.className = 'small'; a.textContent = 'Consultar información';
        articulo.appendChild(a);
      }
      detalle.appendChild(articulo);
    });
  };
  const render = () => {
    const year = mesActual.getFullYear(), month = mesActual.getMonth();
    titulo.textContent = nombresMeses[month].charAt(0).toUpperCase()+nombresMeses[month].slice(1)+' '+year;
    contenedor.replaceChildren();
    const primerDia = new Date(year,month,1);
    const desplazamiento = (primerDia.getDay()+6)%7;
    const diasMes = new Date(year,month+1,0).getDate();
    for(let i=0;i<desplazamiento;i++){
      const vacio=document.createElement('span'); vacio.className='agenda-day-empty'; contenedor.appendChild(vacio);
    }
    for(let dia=1;dia<=diasMes;dia++){
      const fecha=new Date(year,month,dia);
      const lista=eventosDelDia(fecha);
      const btn=document.createElement('button');
      btn.type='button'; btn.className='agenda-day';
      btn.textContent=dia;
      btn.setAttribute('aria-label',dia+' de '+nombresMeses[month]+(lista.length?' con eventos':''));
      if(lista.length) btn.classList.add('has-events');
      if(diaSeleccionado && diaSeleccionado.getFullYear()===year && diaSeleccionado.getMonth()===month && diaSeleccionado.getDate()===dia) btn.classList.add('selected');
      btn.addEventListener('click',()=>{diaSeleccionado=fecha;render();mostrarDetalle(fecha);});
      contenedor.appendChild(btn);
    }
  };
  document.getElementById('agendaMesAnterior').addEventListener('click',()=>{mesActual.setMonth(mesActual.getMonth()-1);diaSeleccionado=null;render();detalle.innerHTML='<p class="small text-secondary mb-0">Selecciona un día marcado para consultar sus actividades.</p>';});
  document.getElementById('agendaMesSiguiente').addEventListener('click',()=>{mesActual.setMonth(mesActual.getMonth()+1);diaSeleccionado=null;render();detalle.innerHTML='<p class="small text-secondary mb-0">Selecciona un día marcado para consultar sus actividades.</p>';});
  render();
})();
</script>
