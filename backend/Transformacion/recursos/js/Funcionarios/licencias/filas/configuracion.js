// ─── CONFIG ──────────────────────────────────────────────────────────────
const TRAMITES_API = '../../../api/licencias/tramites.php';
const DISPONIBILIDAD_API = '../../../api/licencias/disponibilidad.php';
const YEAR = new Date().getFullYear();
const MESES = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
const DIAS_SEMANA = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
const DIAS_LARGO = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

let currentView = 'year';   // 'year' | 'month'
let currentMonth = new Date().getMonth(); // 0-11
let selectedWeek = null;    // { weekNum, start, end, dates[] }
let allWeeks = [];          // array de todas las semanas del año
let bloqueDiccionario = {};  // Mapeo id -> hora
let vulnerabilidades = [];   // Listado de vulnerabilidades

// ─── INIT ─────────────────────────────────────────────────────────────────
async function init() {
    await Promise.all([
        cargarBloques(),
        cargarVulnerabilidades()
    ]);
    buildWeeks();
    renderYear();
}

async function cargarBloques() {
    try {
        const r = await fetch(DISPONIBILIDAD_API, {
            method: 'POST',
            body: JSON.stringify({ ACCION: 'GET_BLOQUES' })
        });
        const data = await r.json();
        if (data.status === 'success') {
            bloqueDiccionario = data.data;
        }
    } catch (e) { console.error("Error cargando bloques", e); }
}

async function cargarVulnerabilidades() {
    try {
        const r = await fetch(DISPONIBILIDAD_API, {
            method: 'POST',
            body: JSON.stringify({ ACCION: 'GET_VULNERABILIDADES' })
        });
        const data = await r.json();
        if (data.status === 'success') {
            vulnerabilidades = data.data;
        }
    } catch (e) { console.error("Error cargando vulnerabilidades", e); }
}

// ─── GENERACIÓN DE SEMANAS ────────────────────────────────────────────────
function buildWeeks() {
    allWeeks = [];
    let d = new Date(YEAR, 0, 1);
    const dow = d.getDay();
    if (dow !== 1) {
        d.setDate(d.getDate() - (dow === 0 ? 6 : dow - 1));
    }
    let weekNum = 1;
    while (true) {
        const start = new Date(d);
        const dates = [];
        for (let i = 0; i < 7; i++) {
            dates.push(new Date(d));
            d.setDate(d.getDate() + 1);
        }
        const end = new Date(dates[6]);
        const mainYear = dates[3].getFullYear();
        if (mainYear > YEAR) break;
        if (mainYear === YEAR || start.getFullYear() === YEAR) {
            allWeeks.push({ weekNum, start, end, dates });
            weekNum++;
        }
    }
}

function formatDate(d) {
    return d.getDate() + ' ' + MESES[d.getMonth()].substring(0, 3) + '.';
}

function formatDateFull(d) {
    return d.getDate() + ' de ' + MESES[d.getMonth()] + ' ' + d.getFullYear();
}

function formatDateDB(d) {
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

// ─── RENDER GRIDS ─────────────────────────────────────────────────────────
function renderYear() {
    const grid = document.getElementById('weekGrid');
    const labelsRow = document.getElementById('monthLabelsRow');
    grid.innerHTML = '';
    labelsRow.innerHTML = '';
    grid.className = 'week-grid view-year';

    const monthLabelData = [];
    let lastMonth = -1;
    allWeeks.forEach((w, i) => {
        const m = w.dates[3].getMonth();
        if (m !== lastMonth) {
            monthLabelData.push({ label: MESES[m].substring(0, 3), index: i });
            lastMonth = m;
        }
    });

    let prev = 0;
    monthLabelData.forEach((ml, li) => {
        const gap = ml.index - prev;
        if (gap > 0) {
            const sp = document.createElement('span');
            sp.className = 'month-label-item';
            sp.style.width = (gap * 31) + 'px';
            labelsRow.appendChild(sp);
        }
        const span = document.createElement('span');
        span.className = 'month-label-item';
        span.textContent = ml.label;
        labelsRow.appendChild(span);
        prev = ml.index + 1;
    });

    allWeeks.forEach(w => {
        grid.appendChild(createCell(w));
    });
}

function renderMonth() {
    const grid = document.getElementById('weekGrid');
    const labelsRow = document.getElementById('monthLabelsRow');
    grid.innerHTML = '';
    labelsRow.innerHTML = '';
    grid.className = 'week-grid view-month';

    document.getElementById('currentMonthLabel').textContent = MESES[currentMonth] + ' ' + YEAR;
    const monthWeeks = allWeeks.filter(w => w.dates[3].getMonth() === currentMonth);

    monthWeeks.forEach(w => {
        const cell = createCell(w);
        cell.innerHTML = `
                <div class="week-num">S${w.weekNum}</div>
                <div class="week-range-mini">${formatDate(w.start)}<br>${formatDate(w.end)}</div>
            `;
        grid.appendChild(cell);
    });

    if (monthWeeks.length === 0) {
        grid.innerHTML = '<div class="text-muted text-center py-4 w-100"><small>No hay semanas para este mes</small></div>';
    }
}

function createCell(w) {
    const cell = document.createElement('div');
    cell.className = 'week-cell' + (selectedWeek && selectedWeek.weekNum === w.weekNum ? ' selected' : '');
    cell.setAttribute('data-week', w.weekNum);

    cell.addEventListener('mouseenter', (e) => showTooltip(e, w));
    cell.addEventListener('mousemove', (e) => moveTooltip(e));
    cell.addEventListener('mouseleave', hideTooltip);
    cell.addEventListener('click', () => selectWeek(w));

    return cell;
}

// ─── TOOLTIP ──────────────────────────────────────────────────────────────
const tooltip = document.getElementById('weekTooltip');

function showTooltip(e, w) {
    tooltip.innerHTML = `
            <div style="font-weight:700;margin-bottom:4px;color:#80caff;">Semana ${w.weekNum}</div>
            <div>📅 ${formatDateFull(w.start)}</div>
            <div>&nbsp;&nbsp;&nbsp;→ ${formatDateFull(w.end)}</div>
        `;
    tooltip.style.display = 'block';
    moveTooltip(e);
}

function moveTooltip(e) {
    let x = e.clientX + 14;
    let y = e.clientY + 14;
    if (x + 180 > window.innerWidth) x = e.clientX - 184;
    tooltip.style.left = x + 'px';
    tooltip.style.top = y + 'px';
}

function hideTooltip() { tooltip.style.display = 'none'; }

// ─── SELECCIÓN DE SEMANA ──────────────────────────────────────────────────
async function selectWeek(w) {
    selectedWeek = w;
    document.querySelectorAll('.week-cell').forEach(c => {
        c.classList.toggle('selected', parseInt(c.getAttribute('data-week')) === w.weekNum);
    });

    document.getElementById('weekDetailPanel').classList.add('show');
    document.getElementById('weekRangeLabel').textContent =
        'Semana ' + w.weekNum + ' · ' + formatDateFull(w.start) + ' – ' + formatDateFull(w.end);
    document.getElementById('infoAlert').style.display = 'none';

    renderDayHeaders(w);
    await renderWeekRules(w);
}

function renderDayHeaders(w) {
    const thead = document.getElementById('weekDayHeaders');
    let html = '<tr><th class="border-0 font-weight-bold text-muted text-uppercase py-3 pl-4" style="width:90px;">Bloque</th>';
    w.dates.forEach((d, i) => {
        html += `<th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-center day-col-header">
                        ${DIAS_LARGO[i]}<br><small>${formatDate(d)}</small>
                     </th>`;
    });
    thead.innerHTML = html;
}

async function renderWeekRules(w) {
    const tbody = document.getElementById('rulesTable');
    tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary"></div> Cargando disponibilidad...</td></tr>';

    const tra_id = document.querySelector('#tramiteList .active')?.getAttribute('data-id');
    if (!tra_id) {
        tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-muted">Seleccione un trámite para ver disponibilidad</td></tr>';
        return;
    }

    // Cargar datos de la semana
    const dataSemana = {}; // fecha -> bloques[]
    const bloquesConDatos = new Set(); // Guardar qué bloques tienen datos en algún día

    const promesas = w.dates.map(async (d) => {
        const fdb = formatDateDB(d);
        try {
            const r = await fetch(DISPONIBILIDAD_API, {
                method: 'POST',
                body: JSON.stringify({ ACCION: 'GET_DISPONIBILIDAD', fecha: fdb, tra_id: tra_id })
            });
            const res = await r.json();
            const items = res.data || [];
            dataSemana[fdb] = items;
            items.forEach(it => bloquesConDatos.add(parseInt(it.tlh_bloque_horario)));
        } catch (e) {
            dataSemana[fdb] = [];
        }
    });

    await Promise.all(promesas);

    tbody.innerHTML = '';

    // Si no hay bloques con datos, mostrar mensaje
    if (bloquesConDatos.size === 0) {
        tbody.innerHTML = '<tr><td colspan="8" class="text-center py-5 text-muted"><span class="material-symbols-outlined d-block mb-2" style="font-size:48px; opacity:0.3;">event_busy</span>No hay horarios configurados para esta semana</td></tr>';
        return;
    }

    // Ordenar bloques con datos y renderizar
    const bloquesOrdenados = Array.from(bloquesConDatos).sort((a, b) => a - b);

    bloquesOrdenados.forEach(b => {
        let row = `<tr><td class="align-middle pl-4 font-weight-bold">${bloqueDiccionario[b] || '??:??'}</td>`;
        w.dates.forEach(d => {
            const fdb = formatDateDB(d);
            const items = (dataSemana[fdb] || []).filter(x => parseInt(x.tlh_bloque_horario) === b);

            let content = `<div class="slot-container" onclick="abrirModalRegla(${b}, '${fdb}')">`;
            if (items.length > 0) {
                items.forEach(it => {
                    content += `<div class="vuln-line vuln-color-${it.tlh_prioidad}" data-cupos="${it.tlh_cupo}"></div>`;
                });
            } else {
                content += `<span class="text-muted small">+</span>`;
            }
            content += `</div>`;
            row += `<td class="align-middle text-center p-1">${content}</td>`;
        });
        row += `</tr>`;
        tbody.innerHTML += row;
    });
}

// ─── CONTROL DE VISTA ─────────────────────────────────────────────────────
function setView(v) {
    currentView = v;
    document.getElementById('btnViewYear').className = v === 'year' ? 'btn btn-primary font-weight-bold' : 'btn btn-outline-secondary font-weight-bold';
    document.getElementById('btnViewMonth').className = v === 'month' ? 'btn btn-primary font-weight-bold' : 'btn btn-outline-secondary font-weight-bold';
    document.getElementById('monthNav').style.setProperty('display', v === 'month' ? 'flex' : 'none', 'important');
    document.getElementById('monthLabelsRow').style.display = v === 'year' ? '' : 'none';
    if (v === 'year') renderYear(); else renderMonth();
}

function prevMonth() { if (currentMonth > 0) { currentMonth--; renderMonth(); } }
function nextMonth() { if (currentMonth < 11) { currentMonth++; renderMonth(); } }

function selectTramite(element) {
    document.querySelectorAll('#tramiteList a').forEach(el => {
        el.classList.remove('active', 'font-weight-bold');
        el.classList.add('text-dark');
    });
    element.classList.add('active', 'font-weight-bold');
    element.classList.remove('text-dark');
    document.getElementById('tramiteTitle').textContent = element.querySelector('span').textContent.trim();
    if (selectedWeek) renderWeekRules(selectedWeek);
}

// ─── MODAL REGLA ─────────────────────────────────────────────────────────
async function abrirModalRegla(bloqueId = null, fecha = null) {
    if (!selectedWeek) {
        Swal.fire('Info', 'Primero seleccione una semana en el calendario', 'info');
        return;
    }

    const tra_id = document.querySelector('#tramiteList .active')?.getAttribute('data-id');
    const optionsVuln = vulnerabilidades.map(v => `<option value="${v.tlv_id}">${v.tlv_nombre}</option>`).join('');

    // Si viene bloqueId y fecha, es edición/gestión de todos los registros de ese slot
    if (bloqueId && fecha) {
        const hora = bloqueDiccionario[bloqueId];

        // Obtener datos actuales de este bloque desde la carga de la semana (ya están en memoria en dataSemana)
        // Pero para estar seguros de tener los IDs (tlh_id) correctos para editar, lo ideal es que el renderizado los incluya
        // o volver a consultar este bloque específico.

        // Vamos a consultar la disponibilidad fresca para este bloque y trámite
        try {
            const r = await fetch(DISPONIBILIDAD_API, {
                method: 'POST',
                body: JSON.stringify({ ACCION: 'GET_DISPONIBILIDAD', fecha: fecha, tra_id: tra_id })
            });
            const res = await r.json();
            const itemsBlock = (res.data || []).filter(x => parseInt(x.tlh_bloque_horario) === bloqueId);

            let tableHtml = `
                <div class="text-left font-size-sm">
                    <p class="mb-3"><strong>Fecha:</strong> ${fecha} | <strong>Hora:</strong> ${hora}</p>
                    <table class="table table-sm table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>Restricción / Vulnerabilidad</th>
                                <th style="width:80px;">Cupos</th>
                                <th style="width:40px;"></th>
                            </tr>
                        </thead>
                        <tbody id="swal_table_body">`;

            itemsBlock.forEach((it, idx) => {
                const vulnName = vulnerabilidades.find(v => v.tlv_id == it.tlh_prioidad)?.tlv_nombre || 'Desconocida';
                tableHtml += `
                    <tr data-id="${it.tlh_id || ''}" data-vuln="${it.tlh_prioidad}">
                        <td class="align-middle">${vulnName}</td>
                        <td><input type="number" class="form-control form-control-sm swal-edit-cupo" value="${it.tlh_cupo}"></td>
                        <td class="text-center align-middle">
                            <button class="btn btn-link btn-sm text-danger p-0" onclick="this.closest('tr').remove()"><span class="material-symbols-outlined font-size-sm">delete</span></button>
                        </td>
                    </tr>`;
            });

            tableHtml += `
                        </tbody>
                    </table>
                    <hr>
                    <div class="form-row align-items-end mt-3">
                        <div class="form-group col-7 mb-0">
                            <label class="small font-weight-bold">Añadir nueva restricción</label>
                            <select id="swal_new_vuln" class="form-control form-control-sm">${optionsVuln}</select>
                        </div>
                        <div class="form-group col-3 mb-0">
                            <label class="small font-weight-bold">Cupos</label>
                            <input type="number" id="swal_new_cupos" class="form-control form-control-sm" value="5">
                        </div>
                        <div class="col-2 mb-0">
                            <button class="btn btn-primary btn-sm btn-block" onclick="agregarFilaModal()">+</button>
                        </div>
                    </div>
                </div>`;

            window.agregarFilaModal = () => {
                const vid = document.getElementById('swal_new_vuln').value;
                const vtext = document.getElementById('swal_new_vuln').options[document.getElementById('swal_new_vuln').selectedIndex].text;
                const vcupos = document.getElementById('swal_new_cupos').value;
                const body = document.getElementById('swal_table_body');

                // Evitar duplicados visuales en la tabla si se desea, o permitir múltiples
                const tr = document.createElement('tr');
                tr.setAttribute('data-id', '');
                tr.setAttribute('data-vuln', vid);
                tr.innerHTML = `
                    <td class="align-middle">${vtext}</td>
                    <td><input type="number" class="form-control form-control-sm swal-edit-cupo" value="${vcupos}"></td>
                    <td class="text-center align-middle">
                        <button class="btn btn-link btn-sm text-danger p-0" onclick="this.closest('tr').remove()"><span class="material-symbols-outlined font-size-sm">delete</span></button>
                    </td>`;
                body.appendChild(tr);
            };

            Swal.fire({
                title: 'Gestión de Cupos por Bloque',
                html: tableHtml,
                width: '600px',
                showCancelButton: true,
                confirmButtonText: 'Guardar Cambios',
                confirmButtonColor: '#006FB3',
                preConfirm: () => {
                    const rows = Array.from(document.querySelectorAll('#swal_table_body tr'));
                    return rows.map(tr => ({
                        ACCION: 'GUARDAR_DISPONIBILIDAD',
                        tlh_id: tr.getAttribute('data-id'),
                        tlh_fecha: fecha,
                        tlh_bloque_horario: bloqueId,
                        tra_id: tra_id, // Usamos tra_id para la lógica de negocio del componente
                        tlh_tramite: tra_id, // Pero el modelo pide tlh_tramite
                        tlh_prioidad: tr.getAttribute('data-vuln'),
                        tlh_cupo: tr.querySelector('.swal-edit-cupo').value
                    }));
                }
            }).then(result => {
                if (result.isConfirmed) {
                    guardarMultiple(result.value);
                }
            });

        } catch (e) {
            console.error(e);
            Swal.fire('Error', 'No se pudo cargar el detalle del bloque', 'error');
        }
    } else {
        // Modo "Agregar Horario" (Masivo/Nuevo)
        const optionsDías = selectedWeek.dates.map((d, i) => `
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input swal-chk-dia" id="chk_${i}" value="${formatDateDB(d)}" checked>
                <label class="custom-control-label small" for="chk_${i}">${DIAS_SEMANA[i]}</label>
            </div>
        `).join('');

        const optionsHoras = Object.keys(bloqueDiccionario).map(b => `
            <option value="${b}">${bloqueDiccionario[b]}</option>
        `).join('');

        Swal.fire({
            title: 'Agregar Horarios a la Semana',
            html: `
                <div class="text-left">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-uppercase d-block mb-2">Seleccionar Días</label>
                        <div class="border rounded p-2 bg-light">${optionsDías}</div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label class="small font-weight-bold text-uppercase">Hora de Inicio</label>
                            <select id="swal_bloque" class="form-control form-control-sm">${optionsHoras}</select>
                        </div>
                        <div class="form-group col-6">
                            <label class="small font-weight-bold text-uppercase">Cupos</label>
                            <input type="number" id="swal_cupos" class="form-control form-control-sm" value="5">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small font-weight-bold text-uppercase">Restricción / Vulnerabilidad</label>
                        <select id="swal_prioidad" class="form-control form-control-sm">${optionsVuln}</select>
                    </div>
                </div>`,
            showCancelButton: true,
            confirmButtonText: 'Generar Horarios',
            confirmButtonColor: '#28a745',
            preConfirm: () => {
                const fechas = Array.from(document.querySelectorAll('.swal-chk-dia:checked')).map(el => el.value);
                if (fechas.length === 0) {
                    Swal.showValidationMessage('Debe seleccionar al menos un día');
                    return false;
                }
                return {
                    ACCION: 'GUARDAR_MASIVO',
                    fechas: fechas,
                    tlh_bloque_horario: document.getElementById('swal_bloque').value,
                    tra_id: tra_id,
                    tlh_tramite: tra_id,
                    tlh_prioidad: document.getElementById('swal_prioidad').value,
                    tlh_cupo: document.getElementById('swal_cupos').value
                };
            }
        }).then(result => {
            if (result.isConfirmed) {
                ejecutarGuardado(result.value);
            }
        });
    }
}

async function guardarMultiple(registros) {
    // Si queremos eliminar registros que fueron quitados de la tabla, 
    // tendríamos que implementar una lógica de borrado real. 
    // Por ahora, solo guardamos lo que hay en la tabla.

    let errores = 0;
    for (const data of registros) {
        try {
            const r = await fetch(DISPONIBILIDAD_API, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const res = await r.json();
            if (res.status !== 'success') errores++;
        } catch (e) { errores++; }
    }

    if (errores === 0) {
        Swal.fire('Guardado', 'Los cambios en el bloque se guardaron correctamente', 'success');
        if (selectedWeek) renderWeekRules(selectedWeek);
    } else {
        Swal.fire('Completado', `Se guardó con ${errores} errores puntuales`, 'warning');
        if (selectedWeek) renderWeekRules(selectedWeek);
    }
}

function ejecutarGuardado(payload) {
    fetch(DISPONIBILIDAD_API, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success' || data.status === 'warning') {
                Swal.fire(data.status === 'success' ? 'Guardado' : 'Completado con avisos', data.message, data.status);
                if (selectedWeek) renderWeekRules(selectedWeek);
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(e => Swal.fire('Error', 'No se pudo conectar con el servidor', 'error'));
}

// ──────────────────────────────────────────────────────────────────────────
init();
