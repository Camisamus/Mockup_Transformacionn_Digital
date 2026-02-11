<?php
$pageTitle = "Listado de Atenciones";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Listado de Atenciones</h2>
            <p class="text-muted mb-0">Visualiza y gestiona todas las atenciones registradas</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm">
                        <i data-feather="file-text" class="me-2"></i>
                        Exportar Excel
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm">
                        <i data-feather="file" class="me-2"></i>
                        Exportar PDF
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="location.href='atenciones_nueva_atencion.php'">
                        <i data-feather="plus" class="me-2"></i>
                        Nueva Atención
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros de Búsqueda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-3">Filtros de Búsqueda</h5>
            <form id="formFiltros" onsubmit="event.preventDefault(); buscarAtenciones();">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Fecha Desde</label>
                        <input type="date" class="form-control" id="filtro_fecha_desde">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Fecha Hasta</label>
                        <input type="date" class="form-control" id="filtro_fecha_hasta">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Estado</label>
                        <select class="form-select" id="filtro_estado">
                            <option value="">Todos</option>
                            <option value="completada">Completada</option>
                            <option value="proceso">En Proceso</option>
                            <option value="pendiente">Pendiente</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Tipo de Atención</label>
                        <select class="form-select" id="filtro_tipo">
                            <option value="">Todos</option>
                            <option value="consulta">Consulta</option>
                            <option value="tramite">Trámite</option>
                            <option value="reclamo">Reclamo</option>
                            <option value="seguimiento">Seguimiento</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Organización</label>
                        <input type="text" class="form-control" id="filtro_organizacion"
                            placeholder="Buscar por nombre...">
                    </div>

                    <div class="col-12 d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-dark d-flex align-items-center gap-2 px-4 shadow-sm">
                            <i data-feather="search" style="width: 16px; height: 16px;"></i>
                            Buscar Atenciones
                        </button>
                        <button type="button" class="btn btn-outline-secondary px-4 shadow-sm"
                            onclick="limpiarFiltros()">
                            <i data-feather="refresh-cw" class="me-2" style="width: 14px;"></i>
                            Limpiar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h5 class="fw-bold fs-6 mb-0">Resultados Encontrados (<span id="resultados_count">0</span>)</h5>
                <div class="pagination-info text-muted small">Mostrando listado de atenciones</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaAtenciones">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>N° Atención</th>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Organización</th>
                            <th>Proyecto</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Área</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <!-- Data loaded dynamically -->
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">Use los filtros para buscar
                                atenciones...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/atenciones_listado_atenciones.js"></script>

<?php include '../../api/footer.php'; ?>