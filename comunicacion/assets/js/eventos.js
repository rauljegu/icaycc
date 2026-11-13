(() => {
    'use strict';

    const root = document.getElementById('agendaPublica');
    if (!root || !window.ICAYCC_AGENDA_INICIAL) return;

    const initial = window.ICAYCC_AGENDA_INICIAL;
    const $ = (id) => document.getElementById(id);
    const mesSelect = $('agendaMes');
    const anioSelect = $('agendaAnio');
    const buscar = $('agendaBuscar');
    const limpiar = $('agendaLimpiar');
    const grid = $('agendaCuadricula');
    const lista = $('agendaListaEventos');
    const vistaMes = $('agendaVistaMensual');
    const vistaLista = $('agendaVistaLista');
    const estado = $('agendaEstado');

    let mes = Number(initial.mes);
    let anio = Number(initial.anio);
    let eventos = initial.eventos || [];
    let diaSeleccionado = null;
    let modo = 'mes';
    let debounce = null;

    const meses = Object.values(initial.meses);
    const esc = (s) => String(s ?? '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
    const fechaLocal = (y,m,d) => `${y}-${String(m).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
    const fechaBonita = (iso) => {
        const [y,m,d] = iso.slice(0,10).split('-').map(Number);
        return `${d} de ${meses[m-1]} de ${y}`;
    };
    const tituloMes = () => `${meses[mes-1]} ${anio}`;

    function renderCabecera() {
        $('agendaTituloMes').textContent = tituloMes();
        $('agendaMesAnterior').textContent = meses[(mes + 10) % 12];
        $('agendaMesSiguiente').textContent = meses[mes % 12];
        mesSelect.value = String(mes);
        anioSelect.value = String(anio);
    }

    function renderCalendario() {
        const primero = new Date(anio, mes - 1, 1);
        const desplazamiento = (primero.getDay() + 6) % 7; // lunes como primer día
        const diasMes = new Date(anio, mes, 0).getDate();
        const celdas = Math.ceil((desplazamiento + diasMes) / 7) * 7;
        const conteo = new Map();
        eventos.forEach(ev => {
            const d = ev.dia;
            conteo.set(d, (conteo.get(d) || 0) + 1);
        });

        let html = '';
        for (let i = 0; i < celdas; i++) {
            const numero = i - desplazamiento + 1;
            const fecha = new Date(anio, mes - 1, numero);
            const y = fecha.getFullYear(), m = fecha.getMonth() + 1, d = fecha.getDate();
            const iso = fechaLocal(y,m,d);
            const fuera = m !== mes;
            const cantidad = conteo.get(iso) || 0;
            const seleccionado = diaSeleccionado === iso;
            const hoy = initial.hoy === iso;
            html += `<button type="button" class="agenda-dia${fuera?' fuera-mes':''}${seleccionado?' seleccionado':''}${hoy?' es-hoy':''}${cantidad?' tiene-eventos':''}" data-fecha="${iso}" ${fuera?'disabled':''} aria-label="${d} ${meses[m-1]}${cantidad?`, ${cantidad} eventos`:''}">
                <span>${d}</span>${cantidad?'<i class="agenda-punto"></i>':''}
            </button>`;
        }
        grid.innerHTML = html;
    }

    function tarjetaLista(ev) {
        return `<a class="agenda-evento-lista" href="${esc(ev.url)}">
            <img src="${esc(ev.imagen)}" alt="" loading="lazy" onerror="this.style.display='none'">
            <span class="agenda-evento-lista-info">
                <small>${esc(fechaBonita(ev.inicio))}</small>
                <small class="agenda-hora"><i class="bi bi-clock"></i> ${esc(ev.hora_inicio)} - ${esc(ev.hora_fin)}</small>
                <strong>${esc(ev.titulo)}</strong>
                ${ev.lugar?`<small class="agenda-lugar">${esc(ev.lugar)}</small>`:''}
            </span>
        </a>`;
    }

    function renderLista() {
        let filtrados = eventos;
        if (diaSeleccionado) filtrados = eventos.filter(ev => ev.dia === diaSeleccionado);
        lista.innerHTML = filtrados.length
            ? filtrados.map(tarjetaLista).join('')
            : `<p class="agenda-vacio">${diaSeleccionado?'No hay eventos para el día seleccionado.':'No hay eventos para este mes.'}</p>`;
    }

    function tarjetaHorario(ev) {
        return `<a class="agenda-horario-card" href="${esc(ev.url)}" style="--evento-imagen:url('${String(ev.imagen).replace(/['\\]/g,'')}')">
            <span class="agenda-horario-overlay"></span>
            <span class="agenda-horario-contenido">
                <small>${esc(fechaBonita(ev.inicio))} · ${esc(ev.hora_inicio)} h</small>
                ${ev.lugar?`<span><i class="bi bi-geo-alt"></i> ${esc(ev.lugar)}</span>`:''}
                <strong>${esc(ev.titulo)}</strong>
            </span>
        </a>`;
    }

    function renderHorario() {
        vistaLista.innerHTML = eventos.length
            ? `<div class="agenda-horario-grid">${eventos.map(tarjetaHorario).join('')}</div>`
            : '<p class="agenda-vacio">No hay eventos para los criterios seleccionados.</p>';
    }

    function render() {
        renderCabecera();
        renderCalendario();
        renderLista();
        renderHorario();
    }

    async function cargar() {
        estado.textContent = 'Cargando eventos…';
        const params = new URLSearchParams({
            ajax: 'eventos', mes: String(mes), anio: String(anio), q: buscar.value.trim()
        });
        try {
            const response = await fetch(`${root.dataset.ajaxUrl}?${params.toString()}`, {
                headers: {'X-Requested-With':'XMLHttpRequest'}
            });
            if (!response.ok) throw new Error('Error de consulta');
            const data = await response.json();
            if (!data.ok) throw new Error(data.mensaje || 'Error');
            eventos = data.eventos || [];
            diaSeleccionado = null;
            render();
            estado.textContent = eventos.length ? `${eventos.length} evento(s) encontrado(s).` : 'No se encontraron eventos.';
        } catch (error) {
            estado.textContent = 'No fue posible cargar los eventos. Intenta nuevamente.';
            console.error(error);
        }
    }

    function cambiarMes(delta) {
        const fecha = new Date(anio, mes - 1 + delta, 1);
        mes = fecha.getMonth() + 1;
        anio = fecha.getFullYear();
        cargar();
    }

    $('agendaAnterior').addEventListener('click', () => cambiarMes(-1));
    $('agendaSiguiente').addEventListener('click', () => cambiarMes(1));
    mesSelect.addEventListener('change', () => { mes = Number(mesSelect.value); cargar(); });
    anioSelect.addEventListener('change', () => { anio = Number(anioSelect.value); cargar(); });

    buscar.addEventListener('input', () => {
        clearTimeout(debounce);
        debounce = setTimeout(cargar, 300);
    });
    limpiar.addEventListener('click', () => {
        buscar.value = '';
        cargar();
        buscar.focus();
    });

    grid.addEventListener('click', (e) => {
        const boton = e.target.closest('[data-fecha]');
        if (!boton) return;
        diaSeleccionado = diaSeleccionado === boton.dataset.fecha ? null : boton.dataset.fecha;
        renderCalendario();
        renderLista();
    });

    function seleccionarVista(tipo) {
        modo = tipo;
        const mensual = tipo === 'mes';
        vistaMes.hidden = !mensual;
        vistaLista.hidden = mensual;
        $('agendaVistaMes').classList.toggle('active', mensual);
        $('agendaVistaMes').classList.toggle('btn-primary', mensual);
        $('agendaVistaMes').classList.toggle('btn-outline-primary', !mensual);
        $('agendaVistaHorario').classList.toggle('active', !mensual);
        $('agendaVistaHorario').classList.toggle('btn-primary', !mensual);
        $('agendaVistaHorario').classList.toggle('btn-outline-primary', mensual);
        $('agendaVistaMes').setAttribute('aria-pressed', String(mensual));
        $('agendaVistaHorario').setAttribute('aria-pressed', String(!mensual));
    }
    $('agendaVistaMes').addEventListener('click', () => seleccionarVista('mes'));
    $('agendaVistaHorario').addEventListener('click', () => seleccionarVista('horario'));

    render();
})();
