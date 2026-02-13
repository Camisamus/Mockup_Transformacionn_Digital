<?php include '../../include/header-ingresos-funcionarios.php'; ?>

<div class="bg-white border-bottom px-4 py-3 sticky-top z-index-100">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">Mis Ingresos</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em;">Historial de Documentos Generados</p>
        </div>
        <div class="d-flex" style="gap: 10px;">
             <div class="input-group input-group-sm" style="width: 250px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><span class="material-symbols-outlined" style="font-size: 16px;">search</span></span>
                </div>
                <input type="text" class="form-control border-left-0 bg-light" placeholder="Filtrar mis documentos...">
            </div>
            <a href="crear.php" class="btn btn-primary btn-sm font-weight-bold d-flex align-items-center">
                <span class="material-symbols-outlined mr-1" style="font-size: 18px;">add</span> Nuevo Ingreso
            </a>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
             <div class="card border-0 shadow-sm p-3">
                 <div class="d-flex justify-content-between align-items-center">
                     <div>
                         <p class="text-muted text-uppercase font-weight-bold mb-0" style="font-size: 10px;">En Proceso</p>
                         <h4 class="font-weight-bold mb-0">12</h4>
                     </div>
                     <span class="material-symbols-outlined text-info" style="font-size: 32px; opacity: 0.2;">pending</span>
                 </div>
             </div>
        </div>
        <div class="col-md-4">
             <div class="card border-0 shadow-sm p-3">
                 <div class="d-flex justify-content-between align-items-center">
                     <div>
                         <p class="text-muted text-uppercase font-weight-bold mb-0" style="font-size: 10px;">Completados</p>
                         <h4 class="font-weight-bold mb-0">45</h4>
                     </div>
                     <span class="material-symbols-outlined text-success" style="font-size: 32px; opacity: 0.2;">check_circle</span>
                 </div>
             </div>
        </div>
        <div class="col-md-4">
             <div class="card border-0 shadow-sm p-3">
                 <div class="d-flex justify-content-between align-items-center">
                     <div>
                         <p class="text-muted text-uppercase font-weight-bold mb-0" style="font-size: 10px;">Rechazados</p>
                         <h4 class="font-weight-bold mb-0">2</h4>
                     </div>
                     <span class="material-symbols-outlined text-danger" style="font-size: 32px; opacity: 0.2;">cancel</span>
                 </div>
             </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size: 13px;">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3 pl-4" style="font-size: 11px;">Estado</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Folio</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Asunto</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Tipo</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Fecha Creación</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Ubicación Actual</th>
                        <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-right pr-4" style="font-size: 11px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Item 1 -->
                    <tr>
                        <td class="align-middle pl-4">
                            <span class="badge badge-warning">En Visación</span>
                        </td>
                        <td class="align-middle font-weight-bold">
                           #2024-8851
                        </td>
                        <td class="align-middle">
                            <span class="text-dark d-block text-truncate" style="max-width: 300px;">Solicitud de Compra Insumos Computacionales</span>
                        </td>
                        <td class="align-middle text-muted">Memorándum</td>
                        <td class="align-middle text-muted">10/02/2026</td>
                        <td class="align-middle small">
                             <div class="d-flex align-items-center">
                                <span class="material-symbols-outlined mr-1 text-muted" style="font-size: 14px;">person</span> María Arancibia (Tránsito)
                            </div>
                        </td>
                        <td class="align-middle text-right pr-4">
                             <a href="ver.php" class="btn btn-sm btn-light border" title="Ver Detalle"><span class="material-symbols-outlined align-middle" style="font-size: 14px;">visibility</span></a>
                        </td>
                    </tr>
                    
                    <!-- Item 2 -->
                    <tr>
                        <td class="align-middle pl-4">
                            <span class="badge badge-success">Completado</span>
                        </td>
                        <td class="align-middle font-weight-bold">
                           #2024-8700
                        </td>
                        <td class="align-middle">
                            <span class="text-dark d-block text-truncate" style="max-width: 300px;">Informe Mensual de Actividades</span>
                        </td>
                        <td class="align-middle text-muted">Informe</td>
                        <td class="align-middle text-muted">01/02/2026</td>
                        <td class="align-middle small">
                             <span class="text-success font-weight-bold">Finalizado</span>
                        </td>
                        <td class="align-middle text-right pr-4">
                             <a href="ver.php" class="btn btn-sm btn-light border" title="Ver Detalle"><span class="material-symbols-outlined align-middle" style="font-size: 14px;">visibility</span></a>
                             <button class="btn btn-sm btn-light border text-danger" title="Descargar PDF"><span class="material-symbols-outlined align-middle" style="font-size: 14px;">picture_as_pdf</span></button>
                        </td>
                    </tr>

                     <!-- Item 3 -->
                    <tr>
                        <td class="align-middle pl-4">
                            <span class="badge badge-danger">Rechazado</span>
                        </td>
                        <td class="align-middle font-weight-bold">
                           #2024-8690
                        </td>
                        <td class="align-middle">
                            <span class="text-dark d-block text-truncate" style="max-width: 300px;">Solicitud de Vacaciones (Errónea)</span>
                        </td>
                        <td class="align-middle text-muted">Solicitud</td>
                        <td class="align-middle text-muted">28/01/2026</td>
                        <td class="align-middle small">
                            <span class="text-danger font-weight-bold">Rechazado por Jefatura</span>
                        </td>
                        <td class="align-middle text-right pr-4">
                             <a href="ver.php" class="btn btn-sm btn-light border" title="Ver Detalle"><span class="material-symbols-outlined align-middle" style="font-size: 14px;">visibility</span></a>
                             <button class="btn btn-sm btn-light border text-primary" title="Editar / Corregir"><span class="material-symbols-outlined align-middle" style="font-size: 14px;">edit</span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../include/footer-funcionarios.php'; ?>
