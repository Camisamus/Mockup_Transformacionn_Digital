<?php include '../../include/header-transito-funcionarios.php'; ?>

<div class="bg-white border-bottom px-4 py-3 sticky-top z-index-100">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">Configuración de Cupos</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em;">Definición de Disponibilidad</p>
        </div>
        <button class="btn btn-primary btn-sm font-weight-bold px-3" onclick="guardarConfiguracion()">
            <span class="material-symbols-outlined align-middle mr-1">save</span> Guardar Cambios
        </button>
    </div>
</div>

<div class="container-fluid p-4">
    
    <div class="row">
        <!-- Selector de Trámite -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 90px;">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="font-weight-bold text-dark mb-0">Seleccionar Trámite</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush" id="tramiteList">
                        <a href="#" class="list-group-item list-group-item-action active font-weight-bold" onclick="selectTramite(this)">Renovación de Licencia</a>
                        <a href="#" class="list-group-item list-group-item-action text-dark" onclick="selectTramite(this)">Obtención Primera Licencia</a>
                        <a href="#" class="list-group-item list-group-item-action text-dark" onclick="selectTramite(this)">Control 6 Años</a>
                        <a href="#" class="list-group-item list-group-item-action text-dark" onclick="selectTramite(this)">Duplicado</a>
                        <a href="#" class="list-group-item list-group-item-action text-dark" onclick="selectTramite(this)">Cambio de Clase</a>
                    </div>
                </div>
                <div class="card-footer bg-light p-3">
                    <button class="btn btn-outline-primary btn-sm btn-block font-weight-bold">
                        <span class="material-symbols-outlined align-middle mr-1">add</span> Nuevo Trámite
                    </button>
                </div>
            </div>
        </div>

        <!-- Panel de Configuración -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-dark mb-0">Reglas de Disponibilidad - <span class="text-primary" id="tramiteTitle">Renovación de Licencia</span></h6>
                    <button class="btn btn-success btn-sm font-weight-bold" onclick="abrirModalRegla()">
                        <span class="material-symbols-outlined align-middle mr-1">add_circle</span> Agregar Horario
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size: 13px;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 pl-4">Días</th>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3">Horario</th>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-center">3ra Edad</th>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-center">Prioritarios</th>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-center">Vecinos</th>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-center">Otros</th>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-right pr-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="rulesTable">
                                <!-- Regla 1 -->
                                <tr>
                                    <td class="align-middle pl-4"><span class="badge badge-light border">Lu-Vi</span></td>
                                    <td class="align-middle font-weight-bold">09:00</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-right pr-4">
                                        <button class="btn btn-link text-primary p-0 mr-2"><span class="material-symbols-outlined" style="font-size: 18px;">edit</span></button>
                                        <button class="btn btn-link text-danger p-0"><span class="material-symbols-outlined" style="font-size: 18px;">delete</span></button>
                                    </td>
                                </tr>
                                <!-- Regla 2 -->
                                <tr>
                                    <td class="align-middle pl-4"><span class="badge badge-light border">Lu-Vi</span></td>
                                    <td class="align-middle font-weight-bold">10:00</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-right pr-4">
                                        <button class="btn btn-link text-primary p-0 mr-2"><span class="material-symbols-outlined" style="font-size: 18px;">edit</span></button>
                                        <button class="btn btn-link text-danger p-0"><span class="material-symbols-outlined" style="font-size: 18px;">delete</span></button>
                                    </td>
                                </tr>
                                <!-- Regla 3 -->
                                <tr>
                                    <td class="align-middle pl-4"><span class="badge badge-light border">Lu-Vi</span></td>
                                    <td class="align-middle font-weight-bold">11:00</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-center">5</td>
                                    <td class="align-middle text-right pr-4">
                                        <button class="btn btn-link text-primary p-0 mr-2"><span class="material-symbols-outlined" style="font-size: 18px;">edit</span></button>
                                        <button class="btn btn-link text-danger p-0"><span class="material-symbols-outlined" style="font-size: 18px;">delete</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-info border-0 d-flex align-items-center mb-0">
                <span class="material-symbols-outlined mr-2">info</span>
                 <div>
                     <strong>Nota:</strong> Los horarios como las 12:00, que no aparecen en esta lista, no tendrán cupos disponibles para el trámite "Renovación de Licencia".
                 </div>
            </div>

        </div>
    </div>
</div>

<script>
    function selectTramite(element) {
        // Visual selection
        document.querySelectorAll('#tramiteList a').forEach(el => {
            el.classList.remove('active', 'font-weight-bold');
            el.classList.add('text-dark');
        });
        element.classList.add('active', 'font-weight-bold');
        element.classList.remove('text-dark');
        
        // Update Title
        document.getElementById('tramiteTitle').textContent = element.textContent;

        // Simulate data loading
        Swal.fire({
            title: 'Cargando reglas...',
            timer: 500,
            timerProgressBar: true,
            didOpen: () => { Swal.showLoading(); }
        });
    }

    function abrirModalRegla() {
        Swal.fire({
            title: 'Configurar Nuevo Horario',
            html: `
                <div class="text-left">
                    <div class="form-group">
                        <label class="small font-weight-bold text-uppercase">Días Hábiles</label>
                        <div class="d-flex" style="gap: 10px;">
                            <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="d1" checked><label class="custom-control-label" for="d1">Lu</label></div>
                            <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="d2" checked><label class="custom-control-label" for="d2">Ma</label></div>
                            <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="d3" checked><label class="custom-control-label" for="d3">Mi</label></div>
                            <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="d4" checked><label class="custom-control-label" for="d4">Ju</label></div>
                            <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="d5" checked><label class="custom-control-label" for="d5">Vi</label></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="small font-weight-bold text-uppercase">Hora Inicio</label>
                        <input type="time" class="form-control" value="09:00">
                    </div>

                    <label class="small font-weight-bold text-uppercase border-bottom pb-2 mb-3 w-100 block">Distribución de Cupos</label>
                    
                    <div class="form-row">
                        <div class="col-6 mb-2">
                             <label class="small text-muted">3ra Edad</label>
                             <input type="number" class="form-control" value="5">
                        </div>
                        <div class="col-6 mb-2">
                             <label class="small text-muted">Prioritarios</label>
                             <input type="number" class="form-control" value="5">
                        </div>
                        <div class="col-6 mb-2">
                             <label class="small text-muted">Vecinos</label>
                             <input type="number" class="form-control" value="5">
                        </div>
                        <div class="col-6 mb-2">
                             <label class="small text-muted">Otros</label>
                             <input type="number" class="form-control" value="5">
                        </div>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Agregar Regla',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#006FB3',
            preConfirm: () => {
                // Add logic to append row to table
                return true;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Agregado', 'La regla de horario ha sido guardada.', 'success');
            }
        });
    }

    function guardarConfiguracion() {
        Swal.fire(
            'Configuración Guardada',
            'Se han actualizado los cupos disponibles para el sistema de agendamiento.',
            'success'
        );
    }
</script>

<?php include '../../include/footer-funcionarios.php'; ?>
