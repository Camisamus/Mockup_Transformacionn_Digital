<?php
$pageTitle = "Gestor de Cupos";
require_once '../../../api/general/auth_check.php';

// Cargar trámites desde la BD
$tramiteController = new \App\Controllers\licencias_tramitecontroller($db);
$tramiteResult = $tramiteController->getAll();
$tramites = $tramiteResult['data'] ?? [];

include '../../../api/general/header.php';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap"
    rel="stylesheet">

<style>
    :root {
        --primary-color: #006FB3;
        --secondary-color: #004c7f;
        --accent-color: #00C2FF;
        --bg-glass: rgba(255, 255, 255, 0.7);
        --border-glass: rgba(255, 255, 255, 0.3);
        --shadow-soft: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        --font-main: 'Inter', sans-serif;
        --font-title: 'Outfit', sans-serif;
    }

    body {
        background-color: #f0f4f8;
        font-family: var(--font-main);
    }

    /* === Header Premium === */
    .premium-header {
        background: var(--bg-glass);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid var(--border-glass);
        box-shadow: var(--shadow-soft);
        border-radius: 16px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .nav-controls {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .week-nav-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        display: flex;
        align-items: center;
        padding: 4px 12px;
        min-width: 280px;
        justify-content: space-between;
    }

    .btn-nav-arrow {
        border: none;
        background: none;
        color: #64748b;
        padding: 4px;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .btn-nav-arrow:hover {
        background: #f1f5f9;
        color: var(--primary-color);
    }

    .week-label {
        font-weight: 600;
        color: #1e293b;
        font-size: 14px;
        margin: 0 8px;
    }

    /* === Tabla de Cupos === */
    .cupos-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: var(--shadow-soft);
        overflow: hidden;
    }

    .table-cupos {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-cupos th {
        background: #f8fafc;
        color: #64748b;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 16px;
        border-bottom: 1px solid #e2e8f0;
        text-align: center;
    }

    .table-cupos td {
        padding: 8px 12px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .col-horario {
        width: 100px;
        font-weight: 700;
        color: var(--primary-color);
        font-family: var(--font-title);
        font-size: 15px;
        text-align: center;
    }

    .col-categoria {
        width: 150px;
        font-size: 13px;
        color: #475569;
        font-weight: 500;
    }

    .table-cupos tbody tr:nth-child(even) {
        background-color: #f1f5f9;
    }

    .table-cupos tbody tr:hover {
        background-color: #e2e8f0 !important;
    }

    .group-row {
        border-top: 2px solid #e2e8f0;
    }

    .cupo-input {
        width: 60px;
        height: 36px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        text-align: center;
        font-weight: 600;
        color: #1e293b;
        transition: all 0.2s;
        background: #fff;
    }

    .cupo-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 111, 179, 0.1);
        outline: none;
        transform: scale(1.05);
    }

    /* === Botones Premium === */
    .btn-premium {
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: none;
    }

    .btn-save {
        background: var(--primary-color);
        color: #fff;
        box-shadow: 0 4px 12px rgba(0, 111, 179, 0.25);
    }

    .btn-save:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
    }

    .btn-export {
        background: #fff;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    /* === Stats Cards === */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-top: 2rem;
    }

    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: var(--shadow-soft);
    }

    .stat-label {
        font-size: 11px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        margin-bottom: 4px;
        display: block;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        font-family: var(--font-title);
    }

    .custom-select-premium {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 14px;
        background: #fff;
    }
</style>

<div class="container-fluid p-4">

    <!-- Header Controles -->
    <div class="premium-header">
        <div class="d-flex align-items-center" style="gap: 20px;">

            <div class="nav-controls">
                <div class="week-nav-card">
                    <button class="btn-nav-arrow" onclick="navWeek(-1)">
                        <span class="material-symbols-outlined">
                            < </span>
                    </button>
                    <div class="d-flex align-items-center">
                        <span class="week-label" id="weekRangeLabel">Cargando...</span>
                    </div>
                    <button class="btn-nav-arrow" onclick="navWeek(1)">
                        <span class="material-symbols-outlined">> </span>
                    </button>
                </div>
            </div>
            <select id="tramiteSelect" class="custom-select-premium" style="min-width: 250px;"
                onchange="cambiarTramite(this.value)">
                <?php foreach ($tramites as $tramite): ?>
                    <option value="<?= htmlspecialchars($tramite['tra_id']) ?>">
                        <?= htmlspecialchars($tramite['tra_nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="d-flex align-items-center" style="gap: 12px;">
            <button class="btn-premium btn-export"
                style="background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0;"
                onclick="abrirModalCopiarSemana()">
                <span class="material-symbols-outlined">content_copy</span> Copiar Semana
            </button>
            <button class="btn-premium btn-save" onclick="guardarCambiosMasivo()">
                <span class="material-symbols-outlined">save</span> Guardar Cambios
            </button>
        </div>
    </div>

    <!-- Tabla Principal -->
    <div class="cupos-card">
        <div class="table-responsive">
            <table class="table-cupos">
                <thead>
                    <tr id="thead_days">
                        <th>Horario</th>
                        <th>Categoría</th>
                        <th>Lun</th>
                        <th>Mar</th>
                        <th>Mié</th>
                        <th>Jue</th>
                        <th>Vie</th>
                        <th>Sáb</th>
                        <th>Dom</th>
                    </tr>
                </thead>
                <tbody id="rulesTableBody">
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Stats -->
    <div class="stats-row">
        <div class="stat-card">
            <span class="stat-label">Capacidad Total Semana</span>
            <span class="stat-value" id="stat_total">0</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Cupos Prioritarios</span>
            <span class="stat-value" id="stat_prioritarios">0</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Día de Mayor Carga</span>
            <span class="stat-value" id="stat_dia_max">-</span>
        </div>
        <div class="stat-card" style="background: linear-gradient(135deg, #001f3f, #004c7f); color: #fff;">
            <span class="stat-label" style="color: rgba(255,255,255,0.7);">Promedio Diario</span>
            <span class="stat-value" style="color: #fff;" id="stat_promedio">0</span>
        </div>
    </div>

</div>

<div id="loadingOverlay"
    style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); display: none; align-items: center; justify-content: center; z-index: 9999;">
    <div class="spinner-border text-primary"></div>
</div>

<script>
    const API_URL = '../../../api/licencias/disponibilidad.php';
    const DIAS_CORTOS = ['LUN', 'MAR', 'MIÉ', 'JUE', 'VIE', 'SÁB', 'DOM'];
    const DIAS_NORMALES = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

    let currentTramiteId = <?= !empty($tramites) ? $tramites[0]['tra_id'] : 'null' ?>;
    let currentWeekDate = new Date();
    let vulnerabilidades = [];
    let bloqueDiccionario = {};
    let dataDeLaSemana = {};

    async function init() {
        showLoading(true);
        await Promise.all([cargarVulnerabilidades(), cargarBloques()]);
        renderWeek();
        showLoading(false);
    }

    async function cargarVulnerabilidades() {
        const r = await fetch(API_URL, { method: 'POST', body: JSON.stringify({ ACCION: 'GET_VULNERABILIDADES' }) });
        const res = await r.json();
        vulnerabilidades = res.data || [];
    }

    async function cargarBloques() {
        const r = await fetch(API_URL, { method: 'POST', body: JSON.stringify({ ACCION: 'GET_BLOQUES' }) });
        const res = await r.json();
        bloqueDiccionario = res.data || {};
    }

    function getWeekDays(date) {
        const d = new Date(date);
        const day = d.getDay();
        const diff = d.getDate() - day + (day === 0 ? -6 : 1);
        const monday = new Date(d.setDate(diff));
        const days = [];
        for (let i = 0; i < 7; i++) { days.push(new Date(monday)); monday.setDate(monday.getDate() + 1); }
        return days;
    }

    function formatDateDB(d) {
        const year = d.getFullYear();
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const day = String(d.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
    function formatDateDisplay(d) {
        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        return `${d.getDate()} ${meses[d.getMonth()].substring(0, 3)}`;
    }

    async function renderWeek() {
        const days = getWeekDays(currentWeekDate);
        document.getElementById('weekRangeLabel').textContent = `Semana: ${formatDateDisplay(days[0])} - ${formatDateDisplay(days[6])}, ${days[0].getFullYear()}`;

        const thead = document.getElementById('thead_days');
        let theadHtml = `<th>Horario</th><th>Categoría</th>`;
        days.forEach((d, i) => { theadHtml += `<th>${DIAS_CORTOS[i]} ${d.getDate()}</th>`; });
        thead.innerHTML = theadHtml;

        dataDeLaSemana = {};
        await Promise.all(days.map(async (d) => {
            const fecha = formatDateDB(d);
            dataDeLaSemana[fecha] = [];
            try {
                const r = await fetch(API_URL, { method: 'POST', body: JSON.stringify({ ACCION: 'GET_DISPONIBILIDAD', fecha: fecha, tra_id: currentTramiteId }) });
                const res = await r.json();
                dataDeLaSemana[fecha] = res.data || [];
            } catch (e) { console.error("Error fetching", fecha, e); }
        }));

        renderTablaCupos(days);
        actualizarStats();
    }

    function renderTablaCupos(days) {
        const tbody = document.getElementById('rulesTableBody');
        tbody.innerHTML = '';
        for (let b = 17; b <= 39; b++) {
            const hora = bloqueDiccionario[b];
            if (!hora) continue;
            vulnerabilidades.forEach((v, vIdx) => {
                let row = `<tr class="${vIdx === 0 ? 'group-row' : ''}">`;
                if (vIdx === 0) row += `<td class="col-horario" rowspan="${vulnerabilidades.length}">${hora}</td>`;
                row += `<td class="col-categoria">${v.tlv_nombre}</td>`;
                days.forEach(d => {
                    const fecha = formatDateDB(d);
                    const reg = (dataDeLaSemana[fecha] || []).find(r => r.tlh_bloque_horario == b && r.tlh_prioidad == v.tlv_id);
                    row += `<td><input type="number" class="cupo-input" data-fecha="${fecha}" data-bloque="${b}" data-vuln="${v.tlv_id}" data-id="${reg ? reg.tlh_id : ''}" value="${reg ? reg.tlh_cupo : ''}" onchange="this.classList.add('dirty')"></td>`;
                });
                row += `</tr>`;
                tbody.innerHTML += row;
            });
        }
    }

    function actualizarStats() {
        let total = 0, prioritarios = 0;
        const diasTotales = {};
        document.querySelectorAll('.cupo-input').forEach(input => {
            const val = parseInt(input.value) || 0;
            total += val;
            if (input.dataset.vuln == 1) prioritarios += val;
            diasTotales[input.dataset.fecha] = (diasTotales[input.dataset.fecha] || 0) + val;
        });
        document.getElementById('stat_total').textContent = total.toLocaleString();
        document.getElementById('stat_prioritarios').textContent = prioritarios.toLocaleString();
        document.getElementById('stat_promedio').textContent = Math.round(total / 7);
    }

    function navWeek(dir) { currentWeekDate.setDate(currentWeekDate.getDate() + (dir * 7)); renderWeek(); }
    function irHoy() { currentWeekDate = new Date(); renderWeek(); }
    function cambiarTramite(id) { currentTramiteId = id; renderWeek(); }

    async function guardarCambiosMasivo() {
        const dirtyInputs = document.querySelectorAll('.cupo-input.dirty');
        if (dirtyInputs.length === 0) { Swal.fire('Info', 'No hay cambios para guardar', 'info'); return; }
        showLoading(true);
        let errores = 0;
        for (const input of dirtyInputs) {
            const payload = { ACCION: 'GUARDAR_DISPONIBILIDAD', tlh_id: input.dataset.id, tlh_fecha: input.dataset.fecha, tlh_bloque_horario: input.dataset.bloque, tra_id: currentTramiteId, tlh_tramite: currentTramiteId, tlh_prioidad: input.dataset.vuln, tlh_cupo: input.value || 0 };
            try {
                const r = await fetch(API_URL, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(payload) });
                if ((await r.json()).status === 'success') input.classList.remove('dirty'); else errores++;
            } catch (e) { errores++; }
        }
        showLoading(false);
        Swal.fire(errores === 0 ? 'Éxito' : 'Aviso', errores === 0 ? 'Cambios guardados' : `Hubo ${errores} errores`, errores === 0 ? 'success' : 'warning');
        if (errores === 0) renderWeek();
    }

    async function abrirModalCopiarSemana() {
        // Calcular lunes de la semana pasada por defecto
        const lastWeek = new Date(currentWeekDate);
        lastWeek.setDate(lastWeek.getDate() - 7);
        const daysLast = getWeekDays(lastWeek);
        const defaultDate = formatDateDB(daysLast[0]);

        const { value: selectedDate } = await Swal.fire({
            title: 'Copiar Semana Anterior',
            html: `
                <div class="text-left mb-3">
                    <p class="small text-muted">Seleccione el <b>Lunes</b> de la semana que desea copiar como origen.</p>
                    <input type="date" id="swal_fecha_origen" class="form-control" value="${defaultDate}">
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Copiar Ahora',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const date = document.getElementById('swal_fecha_origen').value;
                if (!date) { Swal.showValidationMessage('Debe seleccionar una fecha'); return false; }
                const d = new Date(date + 'T00:00:00');
                if (d.getDay() !== 1) { Swal.showValidationMessage('La fecha seleccionada debe ser un Lunes'); return false; }
                return date;
            }
        });

        if (selectedDate) {
            showLoading(true);
            const currentMonday = formatDateDB(getWeekDays(currentWeekDate)[0]);
            try {
                const r = await fetch(API_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        ACCION: 'CLONAR_SEMANA',
                        semana_origen: selectedDate,
                        semana_destino: currentMonday,
                        tra_id: currentTramiteId
                    })
                });
                const res = await r.json();
                showLoading(false);
                if (res.status === 'success') {
                    Swal.fire('Copiado', 'La semana se ha copiado correctamente', 'success');
                    renderWeek();
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            } catch (e) {
                showLoading(false);
                Swal.fire('Error', 'No se pudo procesar la solicitud', 'error');
            }
        }
    }

    function exportarConfig() { Swal.fire('Info', 'Función en desarrollo', 'info'); }
    function showLoading(show) { document.getElementById('loadingOverlay').style.display = show ? 'flex' : 'none'; }

    init();
</script>

<?php include '../../../api/general/footer.php'; ?>