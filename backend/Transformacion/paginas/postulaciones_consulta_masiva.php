<?php
$pageTitle = "Consulta Masiva de Postulaciones";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


    <div class="container-fluid py-4">
        <!-- Header & Toolbar -->
        <div class="main-header mb-4">
            <div class="header-title">
                <h2 class="fw-bold fs-4">Consulta Masiva de Postulaciones</h2>
                <p class="text-muted mb-0">Búsqueda y generación de reportes de postulaciones a fondos</p>
            </div>
            <div class="toolbar">
                <button class="btn btn-toolbar" onclick="buscarPostulaciones()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Buscar
                </button>
                <button class="btn btn-toolbar" onclick="crearNueva()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nueva
                </button>
                <button class="btn btn-toolbar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Exportar Excel
                </button>
            </div>
        </div>

        <!-- Filtros de Búsqueda -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold fs-6 mb-1">Filtros de Búsqueda</h5>
                <p class="text-muted small mb-4">Aplique filtros para refinar el listado de postulaciones</p>

                <form id="formFiltros" onsubmit="event.preventDefault(); buscarPostulaciones();">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label for="filtro_id" class="form-label small fw-bold">ID</label>
                            <input type="number" class="form-control form-control-sm" id="filtro_id"
                                placeholder="Ej: 1">
                        </div>
                        <div class="col-md-2">
                            <label for="filtro_rut" class="form-label small fw-bold">RUT Organización</label>
                            <input type="text" class="form-control form-control-sm" id="filtro_rut"
                                placeholder="XX.XXX.XXX-X">
                        </div>
                        <div class="col-md-5">
                            <label for="filtro_nombre_org" class="form-label small fw-bold">Nombre Organización</label>
                            <input type="text" class="form-control form-control-sm" id="filtro_nombre_org"
                                placeholder="Nombre de la organización">
                        </div>
                        <div class="col-md-3">
                            <label for="filtro_estado" class="form-label small fw-bold">Estado</label>
                            <select class="form-select form-select-sm" id="filtro_estado">
                                <option value="">Todos</option>
                                <option value="aprobado">Aprobado</option>
                                <option value="evaluacion">En Evaluación</option>
                                <option value="pendiente">Pendiente</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="filtro_tipo_postulacion" class="form-label small fw-bold">Tipo
                                Postulación</label>
                            <select class="form-select form-select-sm" id="filtro_tipo_postulacion">
                                <option value="">Todos</option>
                                <option value="nueva">Nueva</option>
                                <option value="renovacion">Renovación</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filtro_tipo_proyecto" class="form-label small fw-bold">Tipo Proyecto</label>
                            <select class="form-select form-select-sm" id="filtro_tipo_proyecto">
                                <option value="">Todos</option>
                                <option value="infraestructura">Infraestructura</option>
                                <option value="equipamiento">Equipamiento</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filtro_fecha_inicio" class="form-label small fw-bold">Fecha (Desde)</label>
                            <input type="date" class="form-control form-control-sm" id="filtro_fecha_inicio">
                        </div>
                        <div class="col-md-3">
                            <label for="filtro_fecha_fin" class="form-label small fw-bold">Fecha (Hasta)</label>
                            <input type="date" class="form-control form-control-sm" id="filtro_fecha_fin">
                        </div>

                        <div class="col-12 d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-dark d-flex align-items-center gap-2 px-4 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
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
                    <table class="table table-hover align-middle" id="tablaPostulaciones">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>RUT</th>
                                <th>Organización</th>
                                <th>NÂ° Ingreso</th>
                                <th>Proyecto</th>
                                <th>Tipo Fondo</th>
                                <th>Fecha Ingreso</th>
                                <th>Monto ($)</th>
                                <th>Estado</th>
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

    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        feather.replace();
    </script>
    <script src="../recursos/js/postulaciones_consulta_masiva.js"></script>
    

<?php include '../api/footer.php'; ?>

