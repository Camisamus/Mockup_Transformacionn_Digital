<?php include '../../include/header-ingresos-funcionarios.php'; ?>

<div class="bg-white border-bottom px-4 py-3 sticky-top z-index-100">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">Bandeja de Entrada</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em;">Documentos y Tareas Pendientes</p>
        </div>
        <div class="d-flex" style="gap: 10px;">
            <div class="input-group input-group-sm" style="width: 250px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><span class="material-symbols-outlined" style="font-size: 16px;">search</span></span>
                </div>
                <input type="text" class="form-control border-left-0 bg-light" placeholder="Buscar por Folio, Asunto...">
            </div>
            <a href="crear.php" class="btn btn-primary btn-sm font-weight-bold d-flex align-items-center">
                <span class="material-symbols-outlined mr-1" style="font-size: 18px;">add</span> Nuevo Ingreso
            </a>
        </div>
    </div>
</div>

<div class="container-fluid p-4">

    <!-- Filtros Rápidos -->
    <div class="d-flex mb-3" style="gap: 10px;">
        <button class="btn btn-sm btn-dark font-weight-bold rounded-pill px-3">Todos</button>
        <button class="btn btn-sm btn-light border font-weight-bold rounded-pill px-3 text-muted">Por Visar <span class="badge badge-warning ml-1">3</span></button>
        <button class="btn btn-sm btn-light border font-weight-bold rounded-pill px-3 text-muted">Mis Tareas <span class="badge badge-danger ml-1">1</span></button>
        <button class="btn btn-sm btn-light border font-weight-bold rounded-pill px-3 text-muted">En Copia / Informativos</button>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size: 13px;">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3 pl-4" style="font-size: 11px; width: 50px;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                <label class="custom-control-label" for="checkAll"></label>
                            </div>
                        </th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Prioridad</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Folio / Asunto</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Remitente</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Mi Rol</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Plazo</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-right pr-4" style="font-size: 11px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Item 1: Urgente / Por Visar -->
                    <tr class="bg-white clickable-row" data-href="ver.php">
                        <td class="align-middle pl-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check1">
                                <label class="custom-control-label" for="check1"></label>
                            </div>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-danger px-2 py-1">ALTA</span>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex flex-column">
                                <span class="font-weight-bold text-dark">#2024-8851</span>
                                <span class="text-muted text-truncate" style="max-width: 300px;">Solicitud de Compra Insumos Computacionales - Depto. Tránsito</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-2 text-primary font-weight-bold" style="width: 28px; height: 28px; font-size: 10px;">MA</div>
                                <span class="text-dark">María Arancibia</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-light border text-primary"><span class="material-symbols-outlined align-middle mr-1" style="font-size: 14px;">rule</span> Visador</span>
                        </td>
                        <td class="align-middle text-danger font-weight-bold">
                            Hace 2 horas
                        </td>
                        <td class="align-middle text-right pr-4">
                            <button class="btn btn-sm btn-success px-3 font-weight-bold" onclick="event.stopPropagation(); visarRapido()">Visar</button>
                        </td>
                    </tr>

                    <!-- Item 2: Normal / Responsable -->
                    <tr class="bg-white clickable-row" data-href="ver.php">
                        <td class="align-middle pl-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check2">
                                <label class="custom-control-label" for="check2"></label>
                            </div>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-info px-2 py-1">NORMAL</span>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex flex-column">
                                <span class="font-weight-bold text-dark">#2024-8842</span>
                                <span class="text-muted text-truncate" style="max-width: 300px;">Informe Mensual de Gestión - Enero 2024</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-2 text-primary font-weight-bold" style="width: 28px; height: 28px; font-size: 10px;">JP</div>
                                <span class="text-dark">Juan Pérez</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-light border text-dark"><span class="material-symbols-outlined align-middle mr-1" style="font-size: 14px;">assignment_ind</span> Responsable</span>
                        </td>
                        <td class="align-middle text-dark">
                            3 días restantes
                        </td>
                        <td class="align-middle text-right pr-4">
                            <button class="btn btn-sm btn-outline-primary px-3 font-weight-bold">Responder</button>
                        </td>
                    </tr>

                    <!-- Item 3: Informativo -->
                    <tr class="bg-light clickable-row" data-href="ver.php" style="opacity: 0.8;">
                        <td class="align-middle pl-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check3">
                                <label class="custom-control-label" for="check3"></label>
                            </div>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-light border px-2 py-1">BAJA</span>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex flex-column">
                                <span class="font-weight-bold text-muted">#2024-8810</span>
                                <span class="text-muted text-truncate" style="max-width: 300px;">Circular N° 15: Instrucciones sobre nueva política de austeridad</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-2 text-muted font-weight-bold" style="width: 28px; height: 28px; font-size: 10px;">RR</div>
                                <span class="text-muted">Recursos Humanos</span>
                            </div>
                        </td>
                        <td class="align-middle">
                             <span class="badge badge-light border text-muted"><span class="material-symbols-outlined align-middle mr-1" style="font-size: 14px;">visibility</span> Informativo</span>
                        </td>
                        <td class="align-middle text-muted">
                            -
                        </td>
                        <td class="align-middle text-right pr-4">
                            <button class="btn btn-link btn-sm text-muted p-0"><span class="material-symbols-outlined">archive</span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-top py-3">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-end mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });

    function visarRapido() {
        Swal.fire({
            title: '¿Visar Documento?',
            text: "Confirmas la aprobación inmediata de este documento.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Visar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Visado Exitoso',
                    'El documento ha sido marcado como visado.',
                    'success'
                );
            }
        });
    }
</script>

<?php include '../../include/footer-funcionarios.php'; ?>
