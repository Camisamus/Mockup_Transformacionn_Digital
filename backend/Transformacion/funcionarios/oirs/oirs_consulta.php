<?php
$pageTitle = "Consulta OIRS";
require_once '../../api/auth_check.php';
include 'header.php';

$folio = $_GET['folio'] ?? 'OIRS-2024-8851';
?>

<style>
    .oirs-tabs .nav-link {
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 13px;
        color: #64748b;
        padding: 8px 20px;
        transition: all 0.2s;
        background: #f8f9fa;
        margin-right: 8px;
    }

    .oirs-tabs .nav-link.active {
        background: #003399 !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(0, 51, 153, 0.2);
    }

    .oirs-tabs .nav-link:hover:not(.active) {
        background: #e2e8f0;
        color: #1e293b;
    }

    .detail-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #003399;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
        display: block;
    }

    .info-label {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        display: block;
        margin-bottom: 4px;
    }

    .timeline-container {
        position: relative;
        padding-left: 30px;
    }

    .timeline-container::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e2e8f0;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 24px;
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        left: -34px;
        top: 4px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #003399;
        border: 2px solid white;
    }
</style>

<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">OIRS Nº <?= htmlspecialchars($folio) ?></h2>
            <p class="text-muted mb-0">Detalle Completo de la Solicitud</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-secondary w-100">
                        <i data-feather="printer" class="me-2"></i> Resp. Contribuyente
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-secondary w-100">
                        <i data-feather="file-text" class="me-2"></i> Expediente Técnico
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100" onclick="history.back()">
                        <i data-feather="arrow-left" class="me-2"></i> Volver
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-pills oirs-tabs mb-4 px-1" id="oirsTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-detalle">Detalle</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-contribuyente">Contribuyente</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-asignacion">Asignación</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-adjuntos">Adjuntos Municipio</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-historial">Historial</button>
        </li>
    </ul>

    <div class="tab-content" id="oirsTabsContent">
        <!-- DETALLE -->
        <div class="tab-pane fade show active" id="tab-detalle">
            <div class="card detail-card p-4 mb-4">
                <span class="section-title">Información General</span>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="info-label">Tipo Atención</label>
                        <select class="form-select form-select-sm">
                            <option selected>Consulta</option>
                            <option>Denuncia</option>
                            <option>Reclamo</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="info-label">Origen Consulta</label>
                        <select class="form-select form-select-sm">
                            <option selected>Presencial</option>
                            <option>Web</option>
                            <option>App</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="info-label">Condición</label>
                        <select class="form-select form-select-sm">
                            <option selected>Ninguna</option>
                            <option>Adulto Mayor</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="info-label">Prioridad</label>
                        <select class="form-select form-select-sm">
                            <option selected>Normal</option>
                            <option class="text-danger fw-bold">Urgente</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="info-label">Fecha Ingreso</label>
                        <input type="date" class="form-control form-control-sm" value="2024-02-11">
                    </div>
                    <div class="col-md-3">
                        <label class="info-label">Hora</label>
                        <input type="time" class="form-control form-control-sm" value="09:45">
                    </div>
                    <div class="col-md-3">
                        <label class="info-label">Temática</label>
                        <select class="form-select form-select-sm">
                            <option selected>Aseo y Ornato</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="info-label">Subtemática</label>
                        <select class="form-select form-select-sm">
                            <option selected>Microbasural</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="info-label">Descripción</label>
                        <textarea class="form-control form-control-sm"
                            rows="3">Se requiere retiro de microbasural acumulado en la esquina, generando malos olores y presencia de roedores.</textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <span class="section-title">Respuesta al Contribuyente</span>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="info-label">Respuesta Preliminar</label>
                            <textarea class="form-control form-control-sm" rows="3"
                                placeholder="Escriba la respuesta oficial..."></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="info-label">¿Requiere respuesta técnica?</label>
                            <select class="form-select form-select-sm">
                                <option>Sí</option>
                                <option>No</option>
                            </select>
                        </div>
                        <div class="col-md-8 text-end d-flex align-items-end justify-content-end">
                            <button class="btn btn-primary btn-sm fw-bold px-4">
                                <i data-feather="send" class="me-2" style="width: 14px;"></i> Enviar Respuesta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTRIBUYENTE -->
        <div class="tab-pane fade" id="tab-contribuyente">
            <div class="card detail-card p-4">
                <span class="section-title">Datos del Contribuyente</span>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="info-label">RUT</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" value="15.441.229-K">
                            <button class="btn btn-outline-primary"><i data-feather="search"
                                    style="width: 14px;"></i></button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="info-label">Nombre</label>
                        <input type="text" class="form-control form-control-sm" value="Rodrigo">
                    </div>
                    <div class="col-md-4">
                        <label class="info-label">Apellidos</label>
                        <input type="text" class="form-control form-control-sm" value="Canales Pérez">
                    </div>
                    <div class="col-md-6">
                        <label class="info-label">Email</label>
                        <input type="email" class="form-control form-control-sm" value="rodrigo.canales@email.com">
                    </div>
                    <div class="col-md-6">
                        <label class="info-label">Teléfono</label>
                        <input type="text" class="form-control form-control-sm" value="+56 9 9876 5432">
                    </div>
                    <div class="col-md-12">
                        <label class="info-label">Dirección</label>
                        <input type="text" class="form-control form-control-sm"
                            value="Calle Valparaíso 123, Viña del Mar">
                    </div>
                </div>
            </div>
        </div>

        <!-- ASIGNACION -->
        <div class="tab-pane fade" id="tab-asignacion">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card detail-card p-4">
                        <span class="section-title">Nueva Asignación</span>
                        <div class="mb-3">
                            <label class="info-label">Funcionario / Departamento</label>
                            <select class="form-select form-select-sm">
                                <option disabled selected>Seleccione...</option>
                                <option>Juan Pérez (Aseo)</option>
                                <option>María Gómez (Finanzas)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="info-label">Instrucciones</label>
                            <textarea class="form-control form-control-sm" rows="3"
                                placeholder="Mensaje para el funcionario..."></textarea>
                        </div>
                        <button class="btn btn-primary btn-sm fw-bold w-100">
                            <i data-feather="user-plus" class="me-2" style="width: 14px;"></i> Asignar Solicitud
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card detail-card p-4">
                        <span class="section-title">Asignaciones Actuales</span>
                        <div class="list-group list-group-flush small">
                            <div class="list-group-item px-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold">Juan Pérez</span>
                                    <span class="badge bg-warning-soft text-warning fw-bold">Pendiente</span>
                                </div>
                                <p class="text-muted mb-0" style="font-size: 11px;">Asignado el 07/02/2024 - "Favor
                                    evaluar factibilidad técnica"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADJUNTOS -->
        <div class="tab-pane fade" id="tab-adjuntos">
            <div class="card detail-card p-4">
                <span class="section-title">Adjuntos del Municipio</span>
                <div class="mb-4">
                    <label class="info-label">Cargar Nuevo Archivo</label>
                    <input type="file" class="form-control form-control-sm">
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover small">
                        <thead class="bg-light">
                            <tr>
                                <th>Archivo</th>
                                <th>Subido por</th>
                                <th>Fecha</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i data-feather="file" class="text-danger me-2"
                                        style="width: 14px;"></i>Informe_Tecnico.pdf</td>
                                <td>Juan Pérez</td>
                                <td>08/02/2024</td>
                                <td class="text-end text-primary fw-bold" style="cursor: pointer;">Descargar</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- HISTORIAL -->
        <div class="tab-pane fade" id="tab-historial">
            <div class="card detail-card p-4">
                <span class="section-title">Historial de Eventos</span>
                <div class="timeline-container">
                    <div class="timeline-item">
                        <span class="fw-bold d-block small">Ingreso de Solicitud</span>
                        <span class="text-muted d-block" style="font-size: 11px;">11/02/2024 09:45 AM - Por Ventanilla
                            Única</span>
                        <p class="mb-0 mt-1 small">El contribuyente ingresó la solicitud de retiro de microbasural.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="fw-bold d-block small">Asignación de Solicitud</span>
                        <span class="text-muted d-block" style="font-size: 11px;">11/02/2024 10:30 AM - Admin</span>
                        <p class="mb-0 mt-1 small">Derivado a Departamento de Aseo y Ornato.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/oirs/oirs_consulta.js"></script>

<?php include '../../api/footer.php'; ?>