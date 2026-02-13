<?php include '../../include/header-ingresos-funcionarios.php'; ?>

<div class="bg-white border-bottom px-4 py-3 sticky-top z-index-100">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">Documentos Por Visar</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em;">Gestión de Firmas Pendientes</p>
        </div>
        <div class="d-flex" style="gap: 10px;">
            <button class="btn btn-success btn-sm font-weight-bold px-3" onclick="visarSeleccionados()">
                <span class="material-symbols-outlined align-middle mr-1">done_all</span> Visar Seleccionados
            </button>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
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
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Folio / Documento</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Solicitante</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Fecha Ingreso</th>
                         <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Espera</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-right pr-4" style="font-size: 11px;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Item 1 -->
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
                                <span class="text-muted text-truncate" style="max-width: 350px;">Memorándum: Solicitud de Compra Insumos Computacionales</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-2 text-primary font-weight-bold" style="width: 28px; height: 28px; font-size: 10px;">MA</div>
                                <span class="text-dark">María Arancibia</span>
                            </div>
                        </td>
                        <td class="align-middle text-dark">
                            10/02/2026
                        </td>
                         <td class="align-middle text-danger font-weight-bold">
                            2 días
                        </td>
                        <td class="align-middle text-right pr-4">
                            <button class="btn btn-sm btn-success px-3 font-weight-bold" onclick="event.stopPropagation(); visarDocumento()">Visar</button>
                        </td>
                    </tr>
                    
                    <!-- Item 2 -->
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
                                <span class="font-weight-bold text-dark">#2024-8720</span>
                                <span class="text-muted text-truncate" style="max-width: 350px;">Oficio: Respuesta a Contraloría sobre Auditoría Interna</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-2 text-primary font-weight-bold" style="width: 28px; height: 28px; font-size: 10px;">JP</div>
                                <span class="text-dark">Juan Pérez</span>
                            </div>
                        </td>
                        <td class="align-middle text-dark">
                            09/02/2026
                        </td>
                         <td class="align-middle text-warning font-weight-bold">
                            3 días
                        </td>
                        <td class="align-middle text-right pr-4">
                            <button class="btn btn-sm btn-success px-3 font-weight-bold" onclick="event.stopPropagation(); visarDocumento()">Visar</button>
                        </td>
                    </tr>

                     <!-- Item 3 -->
                    <tr class="bg-white clickable-row" data-href="ver.php">
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
                                <span class="font-weight-bold text-dark">#2024-8650</span>
                                <span class="text-muted text-truncate" style="max-width: 350px;">Solicitud: Permiso Administrativo Funcionario</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-2 text-primary font-weight-bold" style="width: 28px; height: 28px; font-size: 10px;">PT</div>
                                <span class="text-dark">Pedro Tapia</span>
                            </div>
                        </td>
                        <td class="align-middle text-dark">
                            08/02/2026
                        </td>
                         <td class="align-middle text-muted font-weight-bold">
                            4 días
                        </td>
                        <td class="align-middle text-right pr-4">
                            <button class="btn btn-sm btn-success px-3 font-weight-bold" onclick="event.stopPropagation(); visarDocumento()">Visar</button>
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

    function visarDocumento() {
        Swal.fire({
            title: '¿Visar Documento?',
            text: "Se procederá con la firma digital del documento.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Visar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Visado', 'El documento ha sido firmado exitosamente.', 'success');
            }
        });
    }

    function visarSeleccionados() {
        // Lógica para verificar selección
        let checked = $('.custom-control-input:checked').length;
        if(checked === 0) {
            Swal.fire('Atención', 'Seleccione al menos un documento.', 'warning');
            return;
        }

        Swal.fire({
            title: '¿Visar ' + checked + ' Documentos?',
            text: "Se procederá con la firma masiva de los documentos seleccionados.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Visar Todos',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Visado Masivo', 'Los documentos han sido procesados.', 'success');
            }
        });
    }
</script>

<?php include '../../include/footer-funcionarios.php'; ?>
