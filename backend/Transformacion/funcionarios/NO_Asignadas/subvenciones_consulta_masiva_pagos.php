<?php
$pageTitle = "Consulta Masiva de Pagos";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Consulta Masiva de Pagos</h2>
            <p class="text-muted mb-0">Búsqueda y generación de reportes de pagos realizados</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-success w-100 shadow-sm"
                        onclick="console.log('Exportar Excel')">
                        <i data-feather="file-text" class="me-2"></i>
                        Exportar Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros de Búsqueda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Filtros de Búsqueda</h5>
            <p class="text-muted small mb-4">Aplique filtros para encontrar transacciones de pagos</p>

            <form id="formFiltros" onsubmit="event.preventDefault(); buscarPagos();">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="filtro_numero_subvencion" class="form-label small fw-bold">N° Subvención</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_numero_subvencion"
                            placeholder="Ej: SUB-2024-001">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_fecha_evento_inicio" class="form-label small fw-bold">Fecha Evento
                            (Desde)</label>
                        <input type="date" class="form-control form-control-sm" id="filtro_fecha_evento_inicio">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_estado_evento" class="form-label small fw-bold">Estado</label>
                        <select class="form-select form-select-sm" id="filtro_estado_evento">
                            <option value="">Todos los estados</option>
                            <option value="terminada">Terminada</option>
                            <option value="pendiente">Pendiente</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_responsable" class="form-label small fw-bold">Responsable</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_responsable"
                            placeholder="Responsable evento">
                    </div>

                    <div class="col-md-12">
                        <label for="filtro_glosa" class="form-label small fw-bold">Glosa / Observaciones</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_glosa"
                            placeholder="Palabras clave en glosa u observaciones">
                    </div>

                    <div class="col-12 d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-dark d-flex align-items-center gap-2 px-4 shadow-sm">
                            <i data-feather="search"></i>
                            Buscar
                        </button>
                        <button type="button" class="btn btn-link text-decoration-none text-muted small"
                            onclick="limpiarFiltros()">
                            Limpiar Filtros
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-bold fs-6">Resultados (<span id="resultados_count">0</span>)</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaPagos">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>N° Subvención</th>
                            <th>Fecha Evento</th>
                            <th>Estado</th>
                            <th>Fecha Digitalización</th>
                            <th>Responsable</th>
                            <th>Glosa</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <!-- Data loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/subvenciones_consulta_masiva_pagos.js"></script>


<?php include '../../api/footer.php'; ?>