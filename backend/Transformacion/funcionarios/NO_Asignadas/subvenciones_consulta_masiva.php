<?php
$pageTitle = "Consulta Masiva de Subvenciones";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Consulta Masiva de Subvenciones</h2>
            <p class="text-muted mb-0">B�squeda y generaci�n de reportes de subvenciones</p>
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
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm" onclick="window.print()">
                        <i data-feather="file" class="me-2"></i>
                        Exportar PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros de B�squeda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Filtros de B�squeda</h5>
            <p class="text-muted small mb-4">Aplique filtros para refinar los resultados</p>

            <form id="formFiltros" onsubmit="event.preventDefault(); buscarSubvenciones();">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="filtro_numero" class="form-label small fw-bold">N�mero</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_numero"
                            placeholder="Ej: SUB-2024-001">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_fecha_inicio" class="form-label small fw-bold">Fecha (Inicio)</label>
                        <input type="date" class="form-control form-control-sm" id="filtro_fecha_inicio">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_fecha_fin" class="form-label small fw-bold">Fecha (Fin)</label>
                        <input type="date" class="form-control form-control-sm" id="filtro_fecha_fin">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_estado" class="form-label small fw-bold">Estado Actual</label>
                        <select class="form-select form-select-sm" id="filtro_estado">
                            <option value="">Todos los estados</option>
                            <option value="vigente">Vigente</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="cerrada">Cerrada</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="filtro_rut" class="form-label small fw-bold">RUT</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_rut"
                            placeholder="XX.XXX.XXX-X">
                    </div>
                    <div class="col-md-4">
                        <label for="filtro_monto_maximo" class="form-label small fw-bold">Monto M�ximo ($)</label>
                        <input type="number" class="form-control form-control-sm" id="filtro_monto_maximo"
                            placeholder="0">
                    </div>
                    <div class="col-md-4">
                        <label for="filtro_numero_decreto" class="form-label small fw-bold">N�mero de
                            Decreto</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_numero_decreto"
                            placeholder="Ej: DEC-2024-123">
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
                <table class="table table-hover align-middle" id="tablaResultados">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>N�mero</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Monto</th>
                            <th>A�o Decreto</th>
                            <th>N�mero Decreto</th>
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
<script src="../../recursos/js/funcionarios/NO_Asignadas/subvenciones_consulta_masiva.js"></script>


<?php include '../../api/footer.php'; ?>