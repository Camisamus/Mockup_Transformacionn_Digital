<?php
$pageTitle = "Consulta Masiva de Rendiciones";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Consulta Masiva de Rendiciones</h2>
            <p class="text-muted mb-0">B�squeda y generaci�n de reportes de rendiciones de subvenciones</p>
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

    <!-- Filtros de B�squeda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Filtros de B�squeda</h5>
            <p class="text-muted small mb-4">Aplique filtros para refinar los resultados de rendici�n</p>

            <form id="formFiltros" onsubmit="event.preventDefault(); buscarRendiciones();">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="filtro_subvencion" class="form-label small fw-bold">Subvenci�n</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_subvencion"
                            placeholder="Ej: SUB-2024-001">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_rendicion" class="form-label small fw-bold">Rendici�n</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_rendicion"
                            placeholder="Ej: REN-2024-001">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_estado" class="form-label small fw-bold">Estado</label>
                        <select class="form-select form-select-sm" id="filtro_estado">
                            <option value="">Todos los estados</option>
                            <option value="aprobada">Aprobada</option>
                            <option value="observada">Observada</option>
                            <option value="cerrada">Cerrada</option>
                            <option value="pendiente">Pendiente</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_rut" class="form-label small fw-bold">RUT Beneficiario</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_rut"
                            placeholder="XX.XXX.XXX-X">
                    </div>

                    <div class="col-md-6">
                        <label for="filtro_fiscalizador" class="form-label small fw-bold">Fiscalizador</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_fiscalizador"
                            placeholder="Nombre fiscalizador">
                    </div>
                    <div class="col-md-6">
                        <label for="filtro_informe_juridico" class="form-label small fw-bold">Informe
                            Jur�dico</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_informe_juridico"
                            placeholder="N� o detalle de informe">
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
                <table class="table table-hover align-middle" id="tablaRendiciones">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Subvenci�n</th>
                            <th>Rendici�n</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Jur�dico</th>
                            <th>N� Ingreso</th>
                            <th>RUT</th>
                            <th>Fiscalizador</th>
                            <th>Monto Rendido</th>
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
<script src="../../recursos/js/funcionarios/NO_Asignadas/subvenciones_consulta_masiva_rendiciones.js"></script>


<?php include '../../api/footer.php'; ?>