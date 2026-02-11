<?php
$pageTitle = "Historial OIRS";
require_once '../../api/auth_check.php';
include 'header.php';
?>

<style>
    .status-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .badge-resuelta {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .badge-cerrada {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
    }

    .oirs-row:hover {
        background-color: rgba(0, 51, 153, 0.02) !important;
        cursor: pointer;
    }

    .bg-primary-soft {
        background-color: #e7f1ff;
    }

    .advanced-filters {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }

    .advanced-filters.show {
        max-height: 500px;
        padding-top: 1rem;
        border-top: 1px dashed #dee2e6;
        margin-top: 1rem;
    }
</style>

<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Historial de Solicitudes Atendidas</h2>
            <p class="text-muted mb-0">Listado de OIRS gestionadas por usted</p>
        </div>
        <div class="toolbar">
            <button type="button" class="btn btn-toolbar btn-success">
                <i data-feather="download" class="me-2"></i>
                Exportar Historial
            </button>
        </div>
    </div>

    <!-- Filtros de Búsqueda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="row align-items-end g-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted text-uppercase">Buscar en Historial</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0"><i data-feather="search"
                                style="width: 14px;"></i></span>
                        <input type="text" class="form-control bg-light border-0" placeholder="Folio, RUT o Nombre...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Rango de Fecha</label>
                    <select class="form-select form-select-sm bg-light border-0">
                        <option>Último mes</option>
                        <option>Últimos 3 meses</option>
                        <option>Este año</option>
                        <option>Personalizado</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Resultado Gestión</label>
                    <select class="form-select form-select-sm bg-light border-0">
                        <option>Todas las gestiones</option>
                        <option>Resuelta</option>
                        <option>Informativa</option>
                        <option>Derivada</option>
                    </select>
                </div>
                <div class="col-md-2 text-end">
                    <button class="btn btn-sm btn-outline-primary fw-bold w-100" id="btnAdvancedToggle">
                        FILTROS
                    </button>
                </div>
            </div>

            <!-- Filtros Avanzados -->
            <div class="advanced-filters" id="advancedPanel">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Temática</label>
                        <select class="form-select form-select-sm bg-light border-0">
                            <option>Todas</option>
                            <option>Aseo y Ornato</option>
                            <option>Seguridad</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Tipo de Atención</label>
                        <select class="form-select form-select-sm bg-light border-0">
                            <option>Todos</option>
                            <option>Consulta</option>
                            <option>Reclamo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Sector</label>
                        <select class="form-select form-select-sm bg-light border-0">
                            <option>Todos</option>
                            <option>Plan</option>
                            <option>Reñaca</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resultados -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Solicitudes Gestionadas</h5>
            <span class="badge bg-light border text-dark" style="font-size: 11px;">156 registros</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="px-4 py-3">Folio / Fecha Gestión</th>
                            <th class="px-4 py-3">Contribuyente</th>
                            <th class="px-4 py-3">Temática / Tipo</th>
                            <th class="px-4 py-3">Estado Final</th>
                            <th class="px-4 py-3 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="small" id="tableBody">
                        <tr class="oirs-row" onclick="location.href='oirs_consulta.php?folio=OIRS-2024-8500'">
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">#OIRS-2024-8500</span>
                                    <span class="text-muted" style="font-size: 11px;">Resuelto: 05/02/2024</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-soft text-primary rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold"
                                        style="width: 32px; height: 32px; font-size: 10px;">AM</div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Andrés Morales</span>
                                        <span class="text-muted" style="font-size: 11px;">12.334.556-7</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column">
                                    <span>Tránsito</span>
                                    <span class="badge bg-light border text-muted x-small align-self-start"
                                        style="font-size: 9px;">Consulta</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="status-badge badge-resuelta">Finalizada</span>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <button class="btn btn-sm btn-icon text-muted me-1"><i data-feather="eye"
                                        style="width: 16px;"></i></button>
                                <button class="btn btn-sm btn-icon text-muted"><i data-feather="printer"
                                        style="width: 16px;"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top p-4">
            <nav class="d-flex justify-content-between align-items-center">
                <span class="small text-muted fw-bold">Página 1 de 8</span>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#"><i data-feather="chevron-left"
                                style="width: 14px;"></i></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i data-feather="chevron-right"
                                style="width: 14px;"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/oirs/oirs_historial.js"></script>

<?php include '../../api/footer.php'; ?>