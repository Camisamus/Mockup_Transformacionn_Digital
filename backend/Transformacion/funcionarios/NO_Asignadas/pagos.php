<?php
$pageTitle = "Detalle de Patente - Pagos";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid">
    <!-- Search Filters Section -->
    <div class="card-section mb-4">
        <h5 class="mb-3" style="font-weight: 600; color: #212529;">Buscar Patente</h5>
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label" for="searchRut">N° RUT</label>
                <input type="text" class="form-control" id="searchRut" placeholder="12.345.678-9">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="searchRol">ROL PATENTE</label>
                <input type="text" class="form-control" id="searchRol" placeholder="5543-2">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-100" onclick="alert('Buscando patente...')">
                    <i data-feather="search" style="width: 16px; height: 16px;"></i>
                    BUSCAR
                </button>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Detalle de Patente: Rol 5543-2</h1>
            <div class="status-badges">
                <span class="badge-vigente">
                    <i data-feather="check-circle" style="width: 16px; height: 16px;"></i>
                    Vigente
                </span>
                <span class="badge-comercial">
                    <i data-feather="briefcase" style="width: 16px; height: 16px;"></i>
                    Comercial/Definitiva
                </span>
                <span class="badge-periodo">
                    <i data-feather="calendar" style="width: 16px; height: 16px;"></i>
                    Periodo 2-2025
                </span>
            </div>
        </div>
        <div class="action-buttons">
            <button class="btn-print" onclick="window.print()">
                <i data-feather="printer" style="width: 16px; height: 16px;"></i>
                Imprimir Ficha
            </button>
            <button class="btn-pay" onclick="alert('Redirigiendo a caja...')">
                <i data-feather="credit-card" style="width: 16px; height: 16px;"></i>
                Ingresar Pago
            </button>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="content-grid">
        <!-- Left Column -->
        <div class="main-content">
            <!-- Datos del Contribuyente -->
            <div class="card-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i data-feather="user"></i>
                        Datos del Contribuyente
                    </h2>
                    <a href="#" class="edit-link">Editar</a>
                </div>
                <div class="contributor-info">
                    <div class="contributor-avatar">
                        <i data-feather="shopping-bag" style="width: 32px; height: 32px;"></i>
                    </div>
                    <div class="contributor-details">
                        <div class="contributor-name" style="text-transform: uppercase;">Comercial Andes SpA</div>
                        <div class="info-row">
                            <span class="info-label">RUT</span>
                            <span class="info-value">76.432123-K</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">REPRESENTANTE</span>
                            <span class="info-value">Juan Pérez G.</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">DIRECCI¿N COMERCIAL</span>
                            <span class="info-value">Av. Libertador Bernardo O'Higgins 1234, Local 5</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clasificación y Rubro -->
            <div class="card-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i data-feather="tag"></i>
                        Clasificación y Rubro
                    </h2>
                    <a href="#" class="edit-link">Ver Historial</a>
                </div>
                <div class="classification-grid">
                    <div class="classification-item">
                        <span class="classification-label">Código Actividad</span>
                        <span class="classification-value">471100</span>
                    </div>
                    <div class="classification-item">
                        <span class="classification-label">Fecha Otorgamiento</span>
                        <span class="classification-value">15/03/2018</span>
                    </div>
                </div>
                <div>
                    <span class="classification-label">Descripción de Actividad/Giro Comercial</span>
                    <div class="activity-description">
                        Venta al por menor en comercios no especializados con predominio de la venta de alimentos,
                        bebidas o tabaco (supermercados y minimarkets).
                    </div>
                </div>
            </div>

            <!-- Desglose Financiero Actual -->
            <div class="card-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i data-feather="dollar-sign"></i>
                        Desglose Financiero Actual
                    </h2>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>2° Semestre 2025</option>
                        <option>1° Semestre 2025</option>
                        <option>2° Semestre 2024</option>
                    </select>
                </div>
                <div class="financial-breakdown">
                    <div class="financial-row">
                        <span class="financial-label">Capital Propio Declarado</span>
                        <span class="financial-value">$ 15.450.000</span>
                    </div>
                    <div class="financial-row">
                        <span class="financial-label">Valor Patente (0.5%)</span>
                        <span class="financial-value">$ 77.250</span>
                    </div>
                    <div class="financial-row">
                        <span class="financial-label">Derechos de Aseo</span>
                        <span class="financial-value">$ 28.990</span>
                    </div>
                    <div class="financial-row">
                        <span class="financial-label">Derechos de Publicidad</span>
                        <span class="financial-value">$ 45.000</span>
                    </div>
                    <div class="financial-row highlight">
                        <span class="financial-label">IPC + Intereses</span>
                        <span class="financial-value">$ 1.250</span>
                    </div>
                </div>

                <div class="total-card">
                    <div class="total-label">TOTAL A PAGAR</div>
                    <div class="total-amount">$ 152.490</div>
                    <div class="total-footer">
                        <div class="due-date">
                            Vencimiento<br>
                            <strong>31/07/2025</strong>
                        </div>
                        <button class="btn-cashier" onclick="alert('Redirigiendo a caja...')">
                            Ir a Caja
                            <i data-feather="arrow-right" style="width: 16px; height: 16px;"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Historial de Cuenta Corriente -->
            <div class="card-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i data-feather="list"></i>
                        Historial de pagos
                    </h2>
                    <button class="btn btn-sm btn-outline-secondary" onclick="alert('Exportar historial')">
                        <i data-feather="download" style="width: 14px; height: 14px;"></i>
                        Exportar Excel
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>PERIODO</th>
                                <th>CONCEPTO</th>
                                <th>FOLIO</th>
                                <th>VENCIMIENTO</th>
                                <th>MONTO</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1-2025</td>
                                <td>Patente Comercial + Aseo</td>
                                <td>405992</td>
                                <td>31/01/2025</td>
                                <td>$ 145.200</td>
                                <td><span class="status-paid">Pagado</span></td>
                            </tr>
                            <tr>
                                <td>2-2024</td>
                                <td>Patente Comercial + Aseo</td>
                                <td>388102</td>
                                <td>31/07/2024</td>
                                <td>$ 141.500</td>
                                <td><span class="status-paid">Pagado</span></td>
                            </tr>
                            <tr>
                                <td>1-2024</td>
                                <td>Patente Comercial + Aseo</td>
                                <td>365501</td>
                                <td>31/01/2024</td>
                                <td>$ 138.900</td>
                                <td><span class="status-paid-fine">Pagado c/Multa</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="sidebar">
            <!-- Acciones R¿pidas -->
            <div class="quick-actions">
                <h3 class="quick-actions-title">ACCIONES R¿PIDAS</h3>
                <div class="action-item" onclick="window.location.href='patentes_certificado_no_deuda.php'">
                    <div class="action-icon blue">
                        <i data-feather="file-text" style="width: 20px; height: 20px;"></i>
                    </div>
                    <div class="action-text">
                        <div class="action-title">Certificado Deuda</div>
                        <div class="action-subtitle">Descargar PDF</div>
                    </div>
                </div>
                <div class="action-item" onclick="window.location.href='patentes_declaracion_propaganda.php'">
                    <div class="action-icon purple">
                        <i data-feather="award" style="width: 20px; height: 20px;"></i>
                    </div>
                    <div class="action-text">
                        <div class="action-title">Declaración propaganda</div>
                        <div class="action-subtitle">Ir a formulario</div>
                    </div>
                </div>
                <div class="action-item" onclick="window.location.href='patentes_revision_cobro.php'">
                    <div class="action-icon purple">
                        <i data-feather="file-text" style="width: 20px; height: 20px;"></i>
                    </div>
                    <div class="action-text">
                        <div class="action-title">Revisión de cobro</div>
                        <div class="action-subtitle">Ir a formulario</div>
                    </div>
                </div>
                <div class="action-item" onclick="alert('Función requiere autorización')">
                    <div class="action-icon orange">
                        <i data-feather="lock" style="width: 20px; height: 20px;"></i>
                    </div>
                    <div class="action-text">
                        <div class="action-title">Bloquear Patente</div>
                        <div class="action-subtitle">Requiere autorización</div>
                    </div>
                </div>
            </div>

            <!-- Auditoría Reciente -->
            <div class="audit-section">
                <h3 class="audit-title">AUDITOR¿A RECIENTE</h3>
                <div class="audit-item">
                    <div class="audit-time">Hace 2 horas</div>
                    <div class="audit-action">Emisión Certificado Deuda</div>
                    <div class="audit-user">Usuario: M. Gonz¿lez</div>
                </div>
                <div class="audit-item">
                    <div class="audit-time">14 Jul, 10:30 AM</div>
                    <div class="audit-action">Actualización Capital Propio</div>
                    <div class="audit-user">Usuario: Sistema SII</div>
                </div>
                <div class="audit-item">
                    <div class="audit-time">02 Ene, 09:15 AM</div>
                    <div class="audit-action">Pago Semestre 1-2025</div>
                    <div class="audit-user">Caja: Tesorer¿a</div>
                </div>
            </div>


        </div>
    </div>

</div>

<!-- Scripts -->
<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>


<?php include '../../api/footer.php'; ?>