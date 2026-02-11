<?php
$pageTitle = "Listar OIRS";
require_once '../api/auth_check.php';
include '../api/header.php';
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

    .badge-ingresada {
        background: #e3f2fd;
        color: #007bff;
    }

    .badge-proceso {
        background: #fff3e0;
        color: #ef6c00;
    }

    .badge-resuelta {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .badge-vencida {
        background: #ffebee;
        color: #c62828;
    }

    .oirs-row:hover {
        background-color: rgba(0, 51, 153, 0.02) !important;
        cursor: pointer;
    }

    .bg-primary-soft {
        background-color: #e7f1ff;
    }

    .bg-danger-soft {
        background-color: #fff5f5;
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
            <h2 class="fw-bold fs-4">Listado General de OIRS</h2>
            <p class="text-muted mb-0">Buscador avanzado de solicitudes</p>
        </div>
        <div class="toolbar">
            <button type="button" class="btn btn-toolbar btn-success">
                <i data-feather="download" class="me-2"></i>
                Exportar Excel
            </button>
            <button type="button" class="btn btn-toolbar btn-dark" onclick="location.href='oirs_ingresar.php'">
                <i data-feather="plus" class="me-2"></i>
                Nuevo Ingreso
            </button>
        </div>
    </div>

    <!-- Filtros de Búsqueda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="row align-items-end g-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted text-uppercase">Búsqueda Rápida</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0"><i data-feather="search"
                                style="width: 14px;"></i></span>
                        <input type="text" class="form-control bg-light border-0" placeholder="Folio, RUT o Nombre...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Fecha de Ingreso</label>
                    <input type="date" class="form-control form-control-sm bg-light border-0">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Estado</label>
                    <select class="form-select form-select-sm bg-light border-0">
                        <option>Todos los estados</option>
                        <option>Recibida</option>
                        <option>Asignada / En Proceso</option>
                        <option>Resuelta / Finalizada</option>
                        <option>Fuera de Plazo</option>
                    </select>
                </div>
                <div class="col-md-2 text-end">
                    <button class="btn btn-sm btn-outline-primary fw-bold w-100" id="btnAdvancedToggle">
                        MÁS FILTROS
                    </button>
                </div>
            </div>

            <!-- Filtros Avanzados -->
            <div class="advanced-filters" id="advancedPanel">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Sector Territorial</label>
                        <select class="form-select form-select-sm bg-light border-0">
                            <option>Todos los sectores</option>
                            <option>Plan de Viña</option>
                            <option>Reñaca</option>
                            <option>Cerros Orientales</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Temática</label>
                        <select class="form-select form-select-sm bg-light border-0">
                            <option>Todas las temáticas</option>
                            <option>Aseo y Ornato</option>
                            <option>Seguridad Pública</option>
                            <option>Obras</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Subtemática</label>
                        <select class="form-select form-select-sm bg-light border-0">
                            <option>Todas</option>
                            <option>Bacheo</option>
                            <option>Iluminación</option>
                            <option>Microbasural</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Prioridad</label>
                        <select class="form-select form-select-sm bg-light border-0">
                            <option>Todas</option>
                            <option>Urgente</option>
                            <option>Alta</option>
                            <option>Normal</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3 gap-2">
                    <button class="btn btn-link btn-sm text-muted text-decoration-none fw-bold">Limpiar</button>
                    <button class="btn btn-primary btn-sm px-4 fw-bold">APLICAR FILTROS</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Resultados -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Resultados <span class="badge bg-light border text-dark ms-2"
                    style="font-size: 11px;">12 registros</span></h5>
            <div class="d-flex align-items-center gap-3">
                <span class="small text-muted">Ordenar por: <span class="text-dark fw-bold">Más recientes</span></span>
                <i data-feather="filter" class="text-muted" style="width: 16px;"></i>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="px-4 py-3">Folio / Fecha</th>
                            <th class="px-4 py-3">Contribuyente</th>
                            <th class="px-4 py-3">Temática</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="small" id="tableBody">
                        <!-- Filas simuladas -->
                        <tr class="oirs-row" onclick="location.href='oirs_consulta.php?folio=OIRS-2024-8851'">
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">#OIRS-2024-8851</span>
                                    <span class="text-muted" style="font-size: 11px;">11/02/2024 09:45 AM</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-soft text-primary rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold"
                                        style="width: 32px; height: 32px; font-size: 10px;">RC</div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Rodrigo Canales</span>
                                        <span class="text-muted" style="font-size: 11px;">15.441.229-K</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column">
                                    <span>Aseo y Ornato</span>
                                    <span class="badge bg-light border text-muted x-small align-self-start"
                                        style="font-size: 9px;">Microbasural</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="status-badge badge-ingresada">Recibida</span>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <button class="btn btn-sm btn-icon text-muted me-1"><i data-feather="eye"
                                        style="width: 16px;"></i></button>
                                <button class="btn btn-sm btn-icon text-muted me-1"><i data-feather="edit-2"
                                        style="width: 16px;"></i></button>
                                <button class="btn btn-sm btn-icon text-primary"><i data-feather="corner-up-left"
                                        style="width: 16px;"></i></button>
                            </td>
                        </tr>
                        <!-- Se pueden agregar más filas aquí -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top p-4">
            <nav class="d-flex justify-content-between align-items-center">
                <span class="small text-muted fw-bold">Mostrando 1 a 1 de 12 registros</span>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#"><i data-feather="chevron-left"
                                style="width: 14px;"></i></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i data-feather="chevron-right"
                                style="width: 14px;"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    feather.replace();
</script>

<script src="../recursos/js/oirs_listar.js"></script>

<?php include '../api/footer.php'; ?>