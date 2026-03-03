<?php
$pageTitle = "Licencias";
require_once '../../../api/general/auth_check.php';

// Cargar trámites desde la BD (FQCN para evitar conflicto con use y código ejecutable previo)
$tramiteController = new \App\Controllers\LicenciaTramiteController($db);
$tramiteResult = $tramiteController->getAll();
$tramites = $tramiteResult['data'] ?? [];

include '../../../api/general/header.php';
?>

<style>
    /* === Calendario de Semanas === */
    #weekCalendar {
        user-select: none;
    }

    .week-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        padding: 12px;
    }

    .week-cell {
        border-radius: 6px;
        background: #e9ecef;
        cursor: pointer;
        transition: all 0.18s ease;
        position: relative;
        flex-shrink: 0;
    }

    .week-cell:hover {
        background: #006FB3;
        transform: scale(1.12);
        z-index: 5;
    }

    .week-cell.selected {
        background: #006FB3;
        box-shadow: 0 0 0 2px #004c7f;
    }

    .week-cell.has-rules {
        background: #b8d9f0;
    }

    .week-cell.has-rules:hover,
    .week-cell.has-rules.selected {
        background: #006FB3;
    }

    /* Año completo: cuadros chicos */
    .view-year .week-cell {
        width: 26px;
        height: 26px;
    }

    /* Vista mes: cuadros grandes */
    .view-month .week-grid {
        gap: 8px;
        padding: 16px;
    }

    .view-month .week-cell {
        width: 70px;
        height: 70px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .view-month .week-cell .week-num {
        font-size: 20px;
        font-weight: 700;
        color: #495057;
        line-height: 1;
    }

    .view-month .week-cell:hover .week-num,
    .view-month .week-cell.selected .week-num {
        color: #fff;
    }

    .view-month .week-cell .week-range-mini {
        font-size: 9px;
        color: #888;
        text-align: center;
        line-height: 1.2;
        margin-top: 2px;
    }

    .view-month .week-cell:hover .week-range-mini,
    .view-month .week-cell.selected .week-range-mini {
        color: rgba(255, 255, 255, 0.8);
    }

    /* Tooltip */
    .week-tooltip {
        position: fixed;
        background: #212529;
        color: #fff;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12px;
        pointer-events: none;
        z-index: 9999;
        display: none;
        min-width: 160px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
        line-height: 1.6;
    }

    /* Etiquetas de mes en vista año */
    .month-labels {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
        padding: 0 12px 4px;
    }

    .month-label-item {
        font-size: 10px;
        text-transform: uppercase;
        font-weight: 600;
        color: #adb5bd;
        letter-spacing: 0.5px;
    }

    /* Navegación de mes en vista mes */
    .month-nav-title {
        font-size: 15px;
        font-weight: 700;
        color: #343a40;
        min-width: 140px;
        text-align: center;
    }

    /* Tabla semanal */
    #weekDetailPanel {
        display: none;
    }

    #weekDetailPanel.show {
        display: block;
    }

    .day-col-header {
        text-align: center;
        font-size: 12px;
        padding: 8px 4px;
    }

    /* === Estilos de Disponibilidad (Vulnerabilidades) === */
    .slot-container {
        display: flex;
        flex-direction: column;
        gap: 2px;
        min-height: 40px;
        padding: 4px;
        border: 1px solid #eee;
        border-radius: 4px;
        background: #fff;
        cursor: pointer;
        transition: all 0.2s;
    }

    .slot-container:hover {
        background: #f8f9fa;
        border-color: #006FB3;
    }

    .vuln-line {
        height: 6px;
        border-radius: 3px;
        width: 100%;
        position: relative;
    }

    .vuln-line::after {
        content: attr(data-cupos);
        position: absolute;
        right: 2px;
        top: -6px;
        font-size: 8px;
        font-weight: bold;
        color: #fff;
        text-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
    }

    /* Colores por vulnerabilidad (ejemplos, dinámicos luego) */
    .vuln-color-1 {
        background-color: #FF5733;
    }

    /* 3ra Edad */
    .vuln-color-2 {
        background-color: #33FF57;
    }

    /* Prioritarios */
    .vuln-color-3 {
        background-color: #3357FF;
    }

    /* Vecinos */
    .vuln-color-4 {
        background-color: #F333FF;
    }

    /* Otros / Vulnerables */
    .vuln-color-5 {
        background-color: #FFC300;
    }

    /* Discapacidad */

    .slot-time {
        font-size: 11px;
        color: #6c757d;
        margin-bottom: 2px;
        font-weight: 600;
    }
</style>

<div class="container-fluid p-4">

    <div class="row">
        <!-- Selector de Trámite -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 90px;">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="font-weight-bold text-dark mb-0">Seleccionar Trámite</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush" id="tramiteList">
                        <?php foreach ($tramites as $index => $tramite): ?>
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= $index === 0 ? 'active font-weight-bold' : 'text-dark' ?>"
                                data-id="<?= htmlspecialchars($tramite['tra_id']) ?>"
                                onclick="selectTramite(this); return false;">
                                <span><?= htmlspecialchars($tramite['tra_nombre']) ?></span>
                                <button class="btn btn-link p-0 ml-2 text-danger btn-borrar-tramite"
                                    onclick="borrarTramite(<?= $tramite['tra_id'] ?>, this); event.stopPropagation();"
                                    title="Eliminar trámite">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                </button>
                            </a>
                        <?php endforeach; ?>
                        <?php if (empty($tramites)): ?>
                            <div class="list-group-item text-muted text-center py-4" id="sinTramites">
                                <small>No hay trámites registrados</small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer bg-light p-3">
                    <button class="btn btn-outline-primary btn-sm btn-block font-weight-bold"
                        onclick="agregarTramite()">
                        <span class="material-symbols-outlined align-middle mr-1"></span> Nuevo Trámite
                    </button>
                </div>
            </div>
        </div>

        <!-- Panel de Configuración -->
        <div class="col-md-8">

            <!-- ========== CALENDARIO DE SEMANAS ========== -->
            <div class="card border-0 shadow-sm mb-4" id="weekCalendar">
                <div class="card-header bg-white border-bottom py-2 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-dark mb-0">
                        <span class="material-symbols-outlined align-middle mr-1" style="font-size:18px;">Calendario de
                            Semanas</span>
                    </h6>
                    <div class="d-flex align-items-center" style="gap: 8px;">
                        <!-- Navegación mes (solo en vista mes) -->
                        <div id="monthNav" class="d-flex align-items-center" style="gap:4px; display:none !important;">
                            <button class="btn btn-sm btn-light border" onclick="prevMonth()">
                                <span class="material-symbols-outlined" style="font-size:16px;"><!--  -->
                                    < </span>
                            </button>
                            <span class="month-nav-title" id="currentMonthLabel">Enero</span>
                            <button class="btn btn-sm btn-light border" onclick="nextMonth()">
                                <span class="material-symbols-outlined" style="font-size:16px;">></span>
                            </button>
                        </div>
                        <!-- Toggles de vista -->
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" id="btnViewYear" class="btn btn-primary font-weight-bold"
                                onclick="setView('year')">
                                <span class="material-symbols-outlined align-middle" style="font-size:14px;">Visata
                                    Año</span>
                            </button>
                            <button type="button" id="btnViewMonth" class="btn btn-outline-secondary font-weight-bold"
                                onclick="setView('month')">
                                <span class="material-symbols-outlined align-middle" style="font-size:14px;">Visata
                                    Mes</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Vista AÑO: etiquetas de mes -->
                <div id="monthLabelsRow" class="month-labels pt-3" style="padding-bottom:0;"></div>
                <!-- Grid de semanas -->
                <div class="week-grid view-year" id="weekGrid"></div>

                <!-- Leyenda -->
                <div class="px-3 pb-3 d-flex align-items-center" style="gap: 16px; font-size: 12px; color: #adb5bd;">
                    <span><span
                            style="display:inline-block;width:12px;height:12px;background:#e9ecef;border-radius:3px;margin-right:4px;vertical-align:middle;"></span>Sin
                        reglas</span>
                    <span><span
                            style="display:inline-block;width:12px;height:12px;background:#b8d9f0;border-radius:3px;margin-right:4px;vertical-align:middle;"></span>Con
                        reglas</span>
                    <span><span
                            style="display:inline-block;width:12px;height:12px;background:#006FB3;border-radius:3px;margin-right:4px;vertical-align:middle;"></span>Seleccionada</span>
                </div>
            </div>

            <!-- ========== TABLA DE REGLAS POR SEMANA ========== -->
            <div id="weekDetailPanel" class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-dark mb-0">
                        Reglas de Disponibilidad &mdash;
                        <span class="text-primary"
                            id="tramiteTitle"><?= !empty($tramites) ? htmlspecialchars($tramites[0]['tra_nombre']) : 'Seleccione un trámite' ?></span>
                        &mdash; <span class="text-muted" id="weekRangeLabel" style="font-weight:400;"></span>
                    </h6>
                    <button class="btn btn-success btn-sm font-weight-bold" onclick="abrirModalRegla()">
                        <span class="material-symbols-outlined align-middle mr-1"></span> Agregar Horario
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size: 13px;">
                            <thead class="bg-light" id="weekDayHeaders">
                                <tr>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 pl-4"
                                        style="width:90px;">Horario</th>
                                    <!-- Columnas de días se generan con JS -->
                                </tr>
                            </thead>
                            <tbody id="rulesTable">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="alert alert-info border-0 d-flex align-items-center mb-0" id="infoAlert">
                <span class="material-symbols-outlined mr-2">info</span>
                <div>
                    <strong>Nota:</strong> Selecciona una semana del calendario para ver y configurar sus horarios
                    disponibles.
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Tooltip flotante -->
<div class="week-tooltip" id="weekTooltip"></div>


<script src="../../../recursos/js/funcionarios/licencias/filas/configuracion.js"></script>
<?php include '../../../api/general/footer.php'; ?>