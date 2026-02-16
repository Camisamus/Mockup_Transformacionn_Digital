<?php
$pageTitle = "Bandeja OIRS";
require_once '../../api/auth_check.php';
include 'header-oirs-funcionarios.php';
?>

<div class="container-fluid p-4">

    <!-- Tarjetas de Indicadores Rápidos -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm"
                style="border-radius: 8px; border-left: 4px solid var(--gob-primary) !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1"
                        style="font-size: 10px; letter-spacing: 0.05em;">Total Solicitudes</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">1.284</h3>
                        <span class="text-success font-weight-bold" style="font-size: 11px;">+12% mes</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm"
                style="border-radius: 8px; border-left: 4px solid var(--gob-warning) !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1"
                        style="font-size: 10px; letter-spacing: 0.05em;">Pendientes</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">42</h3>
                        <span class="text-warning font-weight-bold" style="font-size: 11px;">Crítico</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm" style="border-radius: 8px; border-left: 4px solid #6c757d !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1"
                        style="font-size: 10px; letter-spacing: 0.05em;">Tiempo Promedio</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">3.2d</h3>
                        <span class="text-muted font-weight-bold" style="font-size: 11px;">Días hábiles</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm"
                style="border-radius: 8px; border-left: 4px solid var(--gob-success) !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1"
                        style="font-size: 10px; letter-spacing: 0.05em;">Resueltas (Mes)</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">156</h3>
                        <span class="text-success font-weight-bold" style="font-size: 11px;">94% tasa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Gráficos Placeholder -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4">
                    <h3 class="h6 font-weight-bold text-dark mb-0 d-flex align-items-center">
                        <span class="material-symbols-outlined text-primary mr-2">bar_chart</span>
                        Solicitudes por Estado (Últimos 30 días)
                    </h3>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center bg-light-soft"
                    style="min-height: 300px;">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-muted"
                            style="font-size: 48px; opacity: 0.3;">monitoring</span>
                        <p class="text-muted mt-2" style="font-size: 13px;">[Gráfico de barras: Distribución de estados]
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4">
                    <h3 class="h6 font-weight-bold text-dark mb-0 d-flex align-items-center">
                        <span class="material-symbols-outlined text-primary mr-2">Grain</span>
                        Tipos de Solicitud
                    </h3>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center" style="min-height: 300px;">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-muted"
                            style="font-size: 48px; opacity: 0.3;">Grain</span>
                        <p class="text-muted mt-2" style="font-size: 13px;">[Gráfico Multitud: Reclamos vs Consultas]
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================
         TABLA DE RESULTADOS
         ======================================== -->
    <div class="card search-card border-0 mb-4 overflow-hidden">
        <!-- Tabla -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light text-muted table-header">
                        <tr>
                            <th class="px-4 py-3 border-0">FOLIO / FECHA</th>
                            <th class="px-4 py-3 border-0">CONTRIBUYENTE</th>
                            <th class="px-4 py-3 border-0">TEMÁTICA</th>
                            <th class="px-4 py-3 border-0">ESTADO</th>
                            <th class="px-4 py-3 border-0 text-right">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
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
                                    <div
                                        class="text-primary rounded-circle d-flex align-items-center justify-content-center mr-3 user-avatar user-avatar-primary">
                                        RC
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold">Rodrigo Canales</span>
                                        <span class="text-muted text-xxs">15.441.229-K</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="text-dark mb-1">Aseo y Ornato</span>
                                    <span class="badge badge-light border text-muted align-self-start text-xs">
                                        Microbasural
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <span class="status-badge badge-ingresada">Recibida</span>
                            </td>
                            <td class="px-4 py-4 align-middle text-right">
                                <button class="btn btn-link action-btn text-muted p-0" title="Ver Detalles">
                                    <span class="material-symbols-outlined icon-md">visibility</span>
                                </button>
                                <button class="btn btn-link action-btn text-muted p-0" title="Editar">
                                    <span class="material-symbols-outlined icon-md">edit</span>
                                </button>
                                <button class="btn btn-link action-btn text-primary p-0" title="Responder">
                                    <span class="material-symbols-outlined icon-md">reply</span>
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
                                    <div
                                        class="bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mr-3 user-avatar">
                                        MM
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold">María Mejías</span>
                                        <span class="text-muted text-xxs">10.122.990-2</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="text-dark mb-1">Obras Públicas</span>
                                    <span class="badge badge-light border text-muted align-self-start text-xs">
                                        Bacheo Calle
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <span class="status-badge badge-proceso">Asignada</span>
                            </td>
                            <td class="px-4 py-4 align-middle text-right">
                                <button class="btn btn-link action-btn text-muted p-0" title="Ver Detalles">
                                    <span class="material-symbols-outlined icon-md">visibility</span>
                                </button>
                                <button class="btn btn-link action-btn text-muted p-0" title="Editar">
                                    <span class="material-symbols-outlined icon-md">edit</span>
                                </button>
                                <button class="btn btn-link action-btn text-primary p-0" title="Responder">
                                    <span class="material-symbols-outlined icon-md">reply</span>
                                </button>
                            </td>
                        </tr>

                        <!-- Fila 3 -->
                        <tr class="oirs-row">
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold text-dark mb-1">#OIRS-2024-8790</span>
                                    <span class="text-muted small">05 Feb 2024</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex align-items-center">
                                    <div
                                        class="text-danger rounded-circle d-flex align-items-center justify-content-center mr-3 user-avatar user-avatar-danger">
                                        JS
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold">Juan Salazar</span>
                                        <span class="text-muted text-xxs">8.332.110-3</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <div class="d-flex flex-column">
                                    <span class="text-dark mb-1">Seguridad Pública</span>
                                    <span class="badge badge-light border text-muted align-self-start text-xs">
                                        Ruidos Molestos
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4 align-middle">
                                <span class="status-badge badge-vencida">Fuera de Plazo</span>
                            </td>
                            <td class="px-4 py-4 align-middle text-right">
                                <button class="btn btn-link action-btn text-muted p-0" title="Ver Detalles">
                                    <span class="material-symbols-outlined icon-md">visibility</span>
                                </button>
                                <button class="btn btn-link action-btn text-muted p-0" title="Editar">
                                    <span class="material-symbols-outlined icon-md">edit</span>
                                </button>
                                <button class="btn btn-link action-btn text-primary p-0" title="Responder">
                                    <span class="material-symbols-outlined icon-md">reply</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer con Paginación -->
        <div class="card-footer bg-white border-top p-4">
            <nav class="d-flex justify-content-between align-items-center">
                <span class="small text-muted font-weight-bold">Mostrando 1 a 3 de 12 registros</span>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled">
                        <a class="page-link border-0 bg-transparent" href="#">
                            <span class="material-symbols-outlined icon-sm">chevron_left</span>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link border-0 rounded-circle mx-1 d-flex align-items-center justify-content-center"
                            style="width: 28px; height: 28px;" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link border-0 rounded-circle mx-1 d-flex align-items-center justify-content-center text-dark"
                            style="width: 28px; height: 28px;" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link border-0 rounded-circle mx-1 d-flex align-items-center justify-content-center text-dark"
                            style="width: 28px; height: 28px;" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link border-0 bg-transparent text-primary" href="#">
                            <span class="material-symbols-outlined icon-sm">chevron_right</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        // ========================================
        // TOGGLE FILTROS AVANZADOS
        // ========================================
        $('#btnAdvanced').on('click', function () {
            const $panel = $('#advancedPanel');
            const $btn = $(this);

            $panel.toggleClass('show');
            $btn.toggleClass('active btn-primary btn-outline-primary');
            $btn.text($btn.hasClass('active') ? 'MENOS FILTROS' : 'MÁS FILTROS');
        });

        // ========================================
        // LIMPIAR FILTROS
        // ========================================
        $('#btnReset').on('click', function () {
            $('.form-control-cool').val('');
        });

        // ========================================
        // ACCIONES DE BOTONES
        // ========================================
        $('.action-btn').on('click', function (e) {
            e.stopPropagation();
            Swal.fire({
                title: 'Vista previa',
                text: 'Aquí se abrirá la gestión de la solicitud seleccionada.',
                icon: 'info',
                confirmButtonColor: '#006FB3'
            });
        });

        // ========================================
        // CLICK EN FILA
        // ========================================
        $('.oirs-row').on('click', function () {
            const folio = $(this).data('folio');
            if (folio) {
                window.location.href = 'oirs-ver.php?folio=' + folio;
            }
        });
    });
</script>

<script src="../../recursos/js/funcionarios/oirs/oirs_bandeja.js"></script>
<?php include 'footer-funcionarios.php'; ?>