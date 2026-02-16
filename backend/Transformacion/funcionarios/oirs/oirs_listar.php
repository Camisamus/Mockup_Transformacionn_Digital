<?php
$pageTitle = "Listado OIRS";
require_once '../../api/auth_check.php';
include 'header-oirs-funcionarios.php';
?>

<div class="container-fluid p-4">

    <!-- Filtros de Búsqueda -->
    <div class="card search-card mb-4 border-0">
        <div class="card-body p-4">
            <div class="row align-items-end">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="filter-label">Búsqueda Rápida (ID / RUT / Nombre)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent text-muted">
                                <span class="material-symbols-outlined" style="font-size: 18px;">search</span>
                            </span>
                        </div>
                        <input type="text" class="form-control form-control-cool pl-0 border-left-0"
                            style="background-color: #f8f9fa;" placeholder="Escribe para buscar...">
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="filter-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control form-control-cool">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="filter-label">Estado de la Solicitud</label>
                    <select class="form-control form-control-cool">
                        <option>Todos los estados</option>
                        <option>Recibida / Nueva</option>
                        <option>En Proceso</option>
                        <option>Finalizada / Resuelta</option>
                        <option>Vencida / Fuera de Plazo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary btn-block font-weight-bold" id="btnAdvanced"
                        style="font-size: 11px; height: 38px;">
                        MÁS FILTROS
                    </button>
                </div>
            </div>

            <!-- Filtros Avanzados (Colapsable) -->
            <div class="advanced-filters" id="advancedPanel">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Sector Territorial</label>
                        <select class="form-control form-control-cool">
                            <option>Todos los sectores</option>
                            <option>Plan de Viña</option>
                            <option>Santa Inés</option>
                            <option>Miraflores</option>
                            <option>Reñaca</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Temática Principal</label>
                        <select class="form-control form-control-cool">
                            <option>Todas las temáticas</option>
                            <option>Aseo y Ornato</option>
                            <option>Infraestructura Urbana</option>
                            <option>Seguridad Pública</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Subtemática</label>
                        <select class="form-control form-control-cool">
                            <option>Todas las subtemáticas</option>
                            <option>Bacheo / Hoyos</option>
                            <option>Luminarias</option>
                            <option>Microbasurales</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Prioridad</label>
                        <select class="form-control form-control-cool">
                            <option>Todas</option>
                            <option>Urgente</option>
                            <option>Alta</option>
                            <option>Normal</option>
                        </select>
                    </div>
                </div>
                <div class="text-right mt-2">
                    <button class="btn btn-link text-muted small font-weight-bold shadow-none" id="btnReset">Limpiar
                        todo</button>
                    <button class="btn btn-primary px-4 font-weight-bold ml-2" style="font-size: 12px;">APLICAR
                        FILTROS</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Resultados -->
    <div class="card search-card border-0 mb-4 overflow-hidden">
        <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
            <h3 class="h6 font-weight-bold text-dark mb-0">Resultados encontrados <span
                    class="badge badge-light border ml-2">12 Solicitudes</span></h3>
            <div class="d-flex align-items-center" style="gap: 15px;">
                <span class="small text-muted">Ordenar por: <span class="text-dark font-weight-bold">Más
                        recientes</span></span>
                <span class="material-symbols-outlined text-muted" style="font-size: 20px;">sort</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light text-muted"
                        style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.05em;">
                        <tr>
                            <th class="px-4 py-3 border-0">FOLIO / FECHA</th>
                            <th class="px-4 py-3 border-0">CONTRIBUYENTE</th>
                            <th class="px-4 py-3 border-0">TEMÁTICA</th>
                            <th class="px-4 py-3 border-0">ESTADO</th>
                            <th class="px-4 py-3 border-0 text-right">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <!-- Fila 1 -->
                        <tr class="oirs-row">
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold text-dark mb-1">#OIRS-2024-8851</span>
                                    <span class="text-muted small">Hoy, 09:45 AM</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-soft text-primary rounded-circle d-flex align-items-center justify-content-center mr-3"
                                        style="width: 32px; height: 32px; font-weight: bold; font-size: 11px; background: #e7f1ff;">
                                        RC</div>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold">Rodrigo Canales</span>
                                        <span class="text-muted x-small" style="font-size: 11px;">15.441.229-K</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="text-dark mb-1">Aseo y Ornato</span>
                                    <span class="badge badge-light border text-muted x-small align-self-start"
                                        style="font-size: 9px;">Microbasural</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <span class="status-badge badge-ingresada">Recibida</span>
                            </td>
                            <td class="px-4 py-4 align-middle text-right">
                                <button class="btn btn-link action-btn text-muted p-0" title="Ver Detalles">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">visibility</span>
                                </button>
                                <button class="btn btn-link action-btn text-muted p-0" title="Editar">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">edit</span>
                                </button>
                                <button class="btn btn-link action-btn text-primary p-0" title="Responder">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">reply</span>
                                </button>
                            </td>
                        </tr>

                        <!-- Fila 2 -->
                        <tr class="oirs-row">
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold text-dark mb-1">#OIRS-2024-8832</span>
                                    <span class="text-muted small">Ayer, 16:20 PM</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mr-3"
                                        style="width: 32px; height: 32px; font-weight: bold; font-size: 11px;">MM</div>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold">María Mejías</span>
                                        <span class="text-muted x-small" style="font-size: 11px;">10.122.990-2</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="text-dark mb-1">Obras Públicas</span>
                                    <span class="badge badge-light border text-muted x-small align-self-start"
                                        style="font-size: 9px;">Bacheo Calle</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <span class="status-badge badge-proceso">Asignada</span>
                            </td>
                            <td class="px-4 py-4 align-middle text-right">
                                <button class="btn btn-link action-btn text-muted p-0"><span
                                        class="material-symbols-outlined"
                                        style="font-size: 20px;">visibility</span></button>
                                <button class="btn btn-link action-btn text-muted p-0"><span
                                        class="material-symbols-outlined" style="font-size: 20px;">edit</span></button>
                                <button class="btn btn-link action-btn text-primary p-0"><span
                                        class="material-symbols-outlined" style="font-size: 20px;">reply</span></button>
                            </td>
                        </tr>

                        <!-- Fila 3 -->
                        <tr class="oirs-row v-overdue">
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold text-dark mb-1">#OIRS-2024-8790</span>
                                    <span class="text-muted small">05 Feb 2024</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex align-items-center">
                                    <div class="bg-danger-soft text-danger rounded-circle d-flex align-items-center justify-content-center mr-3"
                                        style="width: 32px; height: 32px; font-weight: bold; font-size: 11px; background: #fff5f5;">
                                        JS</div>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold">Juan Salazar</span>
                                        <span class="text-muted x-small" style="font-size: 11px;">8.332.110-3</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="text-dark mb-1">Seguridad Pública</span>
                                    <span class="badge badge-light border text-muted x-small align-self-start"
                                        style="font-size: 9px;">Ruidos Molestos</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <span class="status-badge badge-vencida">Fuera de Plazo</span>
                            </td>
                            <td class="px-4 py-4 align-middle text-right">
                                <button class="btn btn-link action-btn text-muted p-0"><span
                                        class="material-symbols-outlined"
                                        style="font-size: 20px;">visibility</span></button>
                                <button class="btn btn-link action-btn text-muted p-0"><span
                                        class="material-symbols-outlined" style="font-size: 20px;">edit</span></button>
                                <button class="btn btn-link action-btn text-primary p-0"><span
                                        class="material-symbols-outlined" style="font-size: 20px;">reply</span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top p-4">
            <nav class="d-flex justify-content-between align-items-center">
                <span class="small text-muted font-weight-bold">Mostrando 1 a 3 de 12 registros</span>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link border-0 bg-transparent" href="#"><span
                                class="material-symbols-outlined" style="font-size: 18px;">chevron_left</span></a></li>
                    <li class="page-item active"><a
                            class="page-link border-0 rounded-circle mx-1 d-flex align-items-center justify-content-center"
                            style="width: 28px; height: 28px;" href="#">1</a></li>
                    <li class="page-item"><a
                            class="page-link border-0 rounded-circle mx-1 d-flex align-items-center justify-content-center text-dark"
                            style="width: 28px; height: 28px;" href="#">2</a></li>
                    <li class="page-item"><a
                            class="page-link border-0 rounded-circle mx-1 d-flex align-items-center justify-content-center text-dark"
                            style="width: 28px; height: 28px;" href="#">3</a></li>
                    <li class="page-item"><a class="page-link border-0 bg-transparent text-primary" href="#"><span
                                class="material-symbols-outlined" style="font-size: 18px;">chevron_right</span></a></li>
                </ul>
            </nav>
        </div>
    </div>

</div>
<script src="../../recursos/js/funcionarios/oirs/oirs_listar.js"></script>
<?php include 'footer-funcionarios.php'; ?>