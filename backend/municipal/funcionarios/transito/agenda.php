<?php include '../../include/header-transito-funcionarios.php'; ?>

<div class="bg-white border-bottom px-4 py-3 sticky-top z-index-100">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">Agenda Diaria</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em;">Gestión de Asistencia</p>
        </div>
        <div class="d-flex align-items-center" style="gap: 15px;">
             <div class="input-group input-group-sm bg-light rounded px-2 border" style="width: 200px;">
                <input type="date" class="form-control border-0 bg-transparent font-weight-bold" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <button class="btn btn-primary btn-sm px-3 font-weight-bold"><span class="material-symbols-outlined align-middle mr-1">print</span> Imprimir Lista</button>
        </div>
    </div>
</div>

<div class="container-fluid p-4">

    <!-- Bloque 09:00 -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center cursor-pointer" data-toggle="collapse" data-target="#collapse0900">
            <div class="d-flex align-items-center">
                <span class="badge badge-primary px-3 py-2 mr-3 font-weight-bold" style="font-size: 14px;">09:00</span>
                <div>
                     <h6 class="font-weight-bold text-dark mb-0">Renovación de Licencia</h6>
                     <small class="text-muted">Cupos Totales: 20 | Ocupados: 18 | Asistencia: 50%</small>
                </div>
            </div>
            <span class="material-symbols-outlined text-muted">expand_more</span>
        </div>
        <div id="collapse0900" class="collapse show">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size: 13px;">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3 pl-4">Nombre Completo</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3">RUT</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3">Grupo</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3">Contacto</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-center">Estado</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-right pr-4">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Persona 1 -->
                            <tr>
                                <td class="align-middle pl-4 font-weight-bold">Juan Carlos Bodoque</td>
                                <td class="align-middle text-muted">12.345.678-9</td>
                                <td class="align-middle"><span class="badge badge-warning">3ra Edad</span></td>
                                <td class="align-middle text-muted">+569 8765 4321</td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-success">Presente</span>
                                </td>
                                <td class="align-middle text-right pr-4">
                                    <button class="btn btn-sm btn-light border" disabled>Check-in</button>
                                </td>
                            </tr>
                            <!-- Persona 2 -->
                            <tr>
                                <td class="align-middle pl-4 font-weight-bold">Tulio Triviño</td>
                                <td class="align-middle text-muted">10.999.888-K</td>
                                <td class="align-middle"><span class="badge badge-info">Vecino</span></td>
                                <td class="align-middle text-muted">+569 1111 2222</td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-light border">Pendiente</span>
                                </td>
                                <td class="align-middle text-right pr-4">
                                    <button class="btn btn-sm btn-success font-weight-bold px-3" onclick="marcarAsistencia(this)">Check-in</button>
                                    <button class="btn btn-sm btn-outline-danger font-weight-bold ml-1" onclick="marcarAusente(this)">No Show</button>
                                </td>
                            </tr>
                             <!-- Persona 3 -->
                            <tr style="opacity: 0.6; background-color: #f8f9fa;">
                                <td class="align-middle pl-4 font-weight-bold">Policarpo Avendaño</td>
                                <td class="align-middle text-muted">5.555.555-5</td>
                                <td class="align-middle"><span class="badge badge-secondary">Otro</span></td>
                                <td class="align-middle text-muted">no registra</td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-danger">Ausente</span>
                                </td>
                                <td class="align-middle text-right pr-4">
                                    <small class="text-danger font-weight-bold">No Asistió</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bloque 10:00 -->
    <div class="card border-0 shadow-sm mb-4">
         <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center cursor-pointer" data-toggle="collapse" data-target="#collapse1000">
            <div class="d-flex align-items-center">
                <span class="badge badge-secondary px-3 py-2 mr-3 font-weight-bold" style="font-size: 14px;">10:00</span>
                <div>
                     <h6 class="font-weight-bold text-dark mb-0">Primera Licencia</h6>
                     <small class="text-muted">Cupos Totales: 10 | Ocupados: 10</small>
                </div>
            </div>
            <span class="material-symbols-outlined text-muted">expand_more</span>
        </div>
        <div id="collapse1000" class="collapse">
            <div class="card-body p-4 text-center text-muted">
                <p>Lista de personas para las 10:00...</p>
            </div>
        </div>
    </div>
</div>

<script>
    function marcarAsistencia(btn) {
        let row = $(btn).closest('tr');
        Swal.fire({
            title: '¿Confirmar Asistencia?',
            text: "Se registrará la hora de llegada.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Sí, Presente'
        }).then((result) => {
            if (result.isConfirmed) {
                row.find('.badge-light').removeClass('badge-light border').addClass('badge-success').text('Presente');
                $(btn).attr('disabled', true);
                $(btn).next().remove(); // Remove 'No Show' button
                Swal.fire('Registrado', 'La asistencia ha sido marcada.', 'success');
            }
        });
    }

    function marcarAusente(btn) {
        let row = $(btn).closest('tr');
        Swal.fire({
            title: '¿Marcar como Ausente?',
            text: "El usuario no se presentó a la hora.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Sí, Ausente'
        }).then((result) => {
            if (result.isConfirmed) {
                row.find('.badge-light').removeClass('badge-light border').addClass('badge-danger').text('Ausente');
                row.css('opacity', '0.6').css('background-color', '#f8f9fa');
                $(btn).parent().html('<small class="text-danger font-weight-bold">No Asistió</small>');
            }
        });
    }
</script>

<?php include '../../include/footer-funcionarios.php'; ?>
