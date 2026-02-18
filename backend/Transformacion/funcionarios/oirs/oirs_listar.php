<?php
$pageTitle = "Listado OIRS";
require_once '../../api/auth_check.php';
include 'header-oirs-funcionarios.php';
?>

<div class="container-fluid p-4">

    <!-- Filtros de Búsqueda -->
    <div class="card search-card mb-4 border-0">
        <div class="card-body p-4">
            <div class="row align-items-end">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="filter-label">Búsqueda Rápida (ID / RUT / Nombre)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent text-muted">
                                <span class="material-symbols-outlined" style="font-size: 18px;">search</span>
                            </span>
                        </div>
                        <input type="text" class="form-control form-control-cool pl-0 border-left-0"
                            style="background-color: #f8f9fa;" placeholder="Escribe para buscar...">
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="filter-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control form-control-cool">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="filter-label">Estado de la Solicitud</label>
                    <select class="form-control form-control-cool">
                        <option>Todos los estados</option>
                        <option>Recibida / Nueva</option>
                        <option>En Proceso</option>
                        <option>Finalizada / Resuelta</option>
                        <option>Vencida / Fuera de Plazo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary btn-block font-weight-bold" id="btnAdvanced"
                        style="font-size: 11px; height: 38px;">
                        MÁS FILTROS
                    </button>
                </div>
            </div>

            <!-- Filtros Avanzados (Colapsable) -->
            <div class="advanced-filters" id="advancedPanel">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Sector Territorial</label>
                        <select class="form-control form-control-cool">
                            <option>Todos los sectores</option>
                            <option>Plan de Viña</option>
                            <option>Santa Inés</option>
                            <option>Miraflores</option>
                            <option>Reñaca</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Temática Principal</label>
                        <select class="form-control form-control-cool">
                            <option>Todas las temáticas</option>
                            <option>Aseo y Ornato</option>
                            <option>Infraestructura Urbana</option>
                            <option>Seguridad Pública</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Subtemática</label>
                        <select class="form-control form-control-cool">
                            <option>Todas las subtemáticas</option>
                            <option>Bacheo / Hoyos</option>
                            <option>Luminarias</option>
                            <option>Microbasurales</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Prioridad</label>
                        <select class="form-control form-control-cool">
                            <option>Todas</option>
                            <option>Urgente</option>
                            <option>Alta</option>
                            <option>Normal</option>
                        </select>
                    </div>
                </div>
                <div class="text-right mt-2">
                    <button class="btn btn-link text-muted small font-weight-bold shadow-none" id="btnReset">Limpiar
                        todo</button>
                    <button class="btn btn-primary px-4 font-weight-bold ml-2" style="font-size: 12px;">APLICAR
                        FILTROS</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================
         TABLA DE RESULTADOS
         ======================================== -->
    <div id="tabla-resultados-oirs"></div>

</div>

<script src="../../recursos/js/funcionarios/oirs/oirs_listar.js"></script>
<script src="../../recursos/js/funcionarios/oirs/oirs_tabla_flujo.js"></script>
<script>
    $(document).ready(function () {
        // Initialize table with 'listar' view
        OirsTable.init('listar');

        // Mantener event handlers anteriores si eran necesarios para filtros locales
        // o si se migran a oirs_tabla_flujo.js
    });
</script>
<?php include 'footer-funcionarios.php'; ?>