<?php include '../../include/header-transito-funcionarios.php'; ?>

<div class="bg-white border-bottom px-4 py-3 sticky-top z-index-100">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">Dashboard de Reservas</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em;">Vista Semanal</p>
        </div>
        <div class="d-flex align-items-center" style="gap: 15px;">
             <!-- Selector de Trámite -->
            <div class="d-flex align-items-center bg-light rounded px-3 py-1 border">
                <span class="material-symbols-outlined text-muted mr-2" style="font-size: 20px;">filter_alt</span>
                <select class="form-control form-control-sm border-0 bg-transparent font-weight-bold text-dark" style="width: 200px; box-shadow: none;" id="tramiteSelector" onchange="updateDashboard()">
                    <option value="renovacion">Renovación de Licencia</option>
                    <option value="primera">Primera Licencia</option>
                    <option value="control">Control 6 Años</option>
                    <option value="duplicado">Duplicado</option>
                </select>
            </div>
            
            <div class="btn-group">
                <button class="btn btn-outline-secondary btn-sm"><span class="material-symbols-outlined align-middle">chevron_left</span></button>
                <button class="btn btn-white btn-sm px-3 font-weight-bold border-secondary disabled text-dark">10 Feb - 14 Feb</button>
                <button class="btn btn-outline-secondary btn-sm"><span class="material-symbols-outlined align-middle">chevron_right</span></button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    
    <!-- Stats del periodo -->
    <div class="row mb-4">
        <div class="col-md-3">
             <div class="card border-0 shadow-sm p-3 border-left-primary" style="border-left: 4px solid var(--gob-primary) !important;">
                 <h6 class="text-muted text-uppercase mb-1" style="font-size: 11px;">Total Cupos Semana</h6>
                 <h3 class="font-weight-bold mb-0">120</h3>
             </div>
        </div>
        <div class="col-md-3">
             <div class="card border-0 shadow-sm p-3 border-left-success" style="border-left: 4px solid var(--gob-success) !important;">
                 <h6 class="text-muted text-uppercase mb-1" style="font-size: 11px;">Reservas Confirmadas</h6>
                 <h3 class="font-weight-bold mb-0">85</h3>
             </div>
        </div>
         <div class="col-md-3">
             <div class="card border-0 shadow-sm p-3 border-left-warning" style="border-left: 4px solid var(--gob-warning) !important;">
                 <h6 class="text-muted text-uppercase mb-1" style="font-size: 11px;">Disponibilidad %</h6>
                 <h3 class="font-weight-bold mb-0">29%</h3>
             </div>
        </div>
        <div class="col-md-3">
             <div class="card border-0 shadow-sm p-3">
                 <h6 class="text-muted text-uppercase mb-1" style="font-size: 11px;">Lista de Espera</h6>
                 <h3 class="font-weight-bold mb-0 text-muted">12</h3>
             </div>
        </div>
    </div>

    <!-- Calendar Grid -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 100px;">Horario</th>
                        <th>Lunes 10</th>
                        <th>Martes 11</th>
                        <th>Miércoles 12</th>
                        <th>Jueves 13</th>
                        <th>Viernes 14</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 09:00 -->
                    <tr>
                        <td class="align-middle font-weight-bold text-muted">09:00</td>
                        <?php for($i=0; $i<5; $i++): ?>
                        <td class="p-1 align-middle">
                            <div class="card m-1 border-0 shadow-sm bg-light hover-shadow cursor-pointer" onclick="verDetalleDia()">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="badge badge-success" style="font-size: 10px;">Disp: 5</span>
                                        <small class="text-muted">Total: 20</small>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                                    </div>
                                    <div class="mt-2 text-left" style="font-size: 10px; line-height: 1.2;">
                                        <span class="d-block text-muted">3ra Edad: 4/5</span>
                                        <span class="d-block text-muted">Prioritario: 10/10</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php endfor; ?>
                    </tr>
                    
                    <!-- 10:00 -->
                    <tr>
                        <td class="align-middle font-weight-bold text-muted">10:00</td>
                         <?php for($i=0; $i<5; $i++): ?>
                        <td class="p-1 align-middle">
                             <!-- Ejemplo Lleno -->
                            <div class="card m-1 border-0 shadow-sm bg-white hover-shadow cursor-pointer" onclick="verDetalleDia()">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="badge badge-danger" style="font-size: 10px;">Lleno</span>
                                        <small class="text-muted">Total: 20</small>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                                    </div>
                                    <div class="mt-2 text-left" style="font-size: 10px; line-height: 1.2;">
                                        <span class="d-block text-muted">3ra Edad: 5/5</span>
                                        <span class="d-block text-muted">Prioritario: 10/10</span>
                                        <span class="d-block text-muted">Vecinos: 5/5</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php endfor; ?>
                    </tr>

                    <!-- 11:00 -->
                    <tr>
                        <td class="align-middle font-weight-bold text-muted">11:00</td>
                        <td class="p-1 align-middle bg-light text-muted small">Descanso</td>
                        <td class="p-1 align-middle" colspan="4">
                             <div class="alert alert-secondary m-1 p-2 small border-0">Bloque no habilitado para este trámite</div>
                        </td>
                    </tr>
                    
                     <!-- 12:00 (Solo Duplicados logic simulation) -->
                     <tr id="row-1200">
                        <td class="align-middle font-weight-bold text-muted">12:00</td>
                        <td class="p-1 align-middle" colspan="5">
                             <div class="card m-1 border border-dashed shadow-none bg-light text-center py-3">
                                 <small class="text-muted">Este horario está reservado para <b>Duplicados</b>.</small>
                             </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover { box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; transform: translateY(-2px); transition: all 0.2s; }
    .cursor-pointer { cursor: pointer; }
</style>

<script>
    function updateDashboard() {
        let tramite = document.getElementById('tramiteSelector').value;
        // Simulación de cambio de vista
        Swal.fire({
            title: 'Cargando disponibilidad...',
            text: 'Obteniendo cupos para ' + tramite,
            timer: 800,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Aquí iría la lógica real para cambiar las filas según la configuración del trámite
    }

    function verDetalleDia() {
        window.location.href = 'agenda.php';
    }
</script>

<?php include '../../include/footer-funcionarios.php'; ?>
