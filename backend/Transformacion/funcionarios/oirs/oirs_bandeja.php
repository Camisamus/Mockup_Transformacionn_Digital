<?php
$pageTitle = "Bandeja OIRS";
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
</style>

<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Bandeja de Entrada OIRS</h2>
            <p class="text-muted mb-0">Solicitudes Recientes y Pendientes</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="location.href='oirs_ingresar.php'">
                        <i data-feather="plus" class="me-2"></i> Nuevo Ingreso
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-outline-secondary w-100 shadow-sm"
                        onclick="location.reload()">
                        <i data-feather="refresh-cw" class="me-2"></i> Actualizar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Indicadores Rápidos (Resumen) -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-4 border-primary">
                <div class="card-body p-3">
                    <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 10px;">Enviadas Hoy</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="fw-bold mb-0">12</h3>
                        <span class="text-primary"><i data-feather="file-text"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-4 border-warning">
                <div class="card-body p-3">
                    <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 10px;">Pendientes</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="fw-bold mb-0">45</h3>
                        <span class="text-warning"><i data-feather="clock"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-4 border-danger">
                <div class="card-body p-3">
                    <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 10px;">Vencidas</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="fw-bold mb-0">8</h3>
                        <span class="text-danger"><i data-feather="alert-circle"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-4 border-success">
                <div class="card-body p-3">
                    <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 10px;">Resueltas Mes</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="fw-bold mb-0">156</h3>
                        <span class="text-success"><i data-feather="check-circle"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Resultados -->
    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Últimas Solicitudes</h5>
            <div class="d-flex align-items-center gap-3">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <span class="input-group-text bg-light border-0"><i data-feather="search"
                            style="width: 14px;"></i></span>
                    <input type="text" class="form-control bg-light border-0" placeholder="Buscar folio o RUT...">
                </div>
                <a href="oirs_listar.php" class="btn btn-link btn-sm text-primary fw-bold text-decoration-none">Ver
                    Todo</a>
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
                    <tbody class="small">
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
                                <button class="btn btn-sm btn-icon text-muted me-1" title="Ver"><i data-feather="eye"
                                        style="width: 16px;"></i></button>
                                <button class="btn btn-sm btn-icon text-muted me-1" title="Editar"><i
                                        data-feather="edit-2" style="width: 16px;"></i></button>
                                <button class="btn btn-sm btn-icon text-primary" title="Responder"><i
                                        data-feather="corner-up-left" style="width: 16px;"></i></button>
                            </td>
                        </tr>
                        <tr class="oirs-row" onclick="location.href='oirs_consulta.php?folio=OIRS-2024-8832'">
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">#OIRS-2024-8832</span>
                                    <span class="text-muted" style="font-size: 11px;">10/02/2024 16:20 PM</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light text-muted rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold"
                                        style="width: 32px; height: 32px; font-size: 10px;">MM</div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">María Mejías</span>
                                        <span class="text-muted" style="font-size: 11px;">10.122.990-2</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column">
                                    <span>Obras Públicas</span>
                                    <span class="badge bg-light border text-muted x-small align-self-start"
                                        style="font-size: 9px;">Bacheo Calle</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="status-badge badge-proceso">Asignada</span>
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
                        <tr class="oirs-row bg-danger-soft bg-opacity-10"
                            onclick="location.href='oirs_consulta.php?folio=OIRS-2024-8790'">
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">#OIRS-2024-8790</span>
                                    <span class="text-muted" style="font-size: 11px;">05/02/2024 11:30 AM</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-danger-soft text-danger rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold"
                                        style="width: 32px; height: 32px; font-size: 10px;">JS</div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Juan Salazar</span>
                                        <span class="text-muted" style="font-size: 11px;">8.332.110-3</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column">
                                    <span>Seguridad Pública</span>
                                    <span class="badge bg-light border text-muted x-small align-self-start"
                                        style="font-size: 9px;">Ruidos Molestos</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="status-badge badge-vencida">Fuera de Plazo</span>
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
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top p-4">
            <nav class="d-flex justify-content-between align-items-center">
                <span class="small text-muted fw-bold">Mostrando 3 registros recientes</span>
                <a href="oirs_listar.php" class="small fw-bold text-decoration-none">Ver todos los resultados <i
                        data-feather="chevron-right" style="width: 14px;"></i></a>
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

<script src="../../recursos/js/funcionarios/oirs/oirs_bandeja.js"></script>

<?php include '../../api/footer.php'; ?>