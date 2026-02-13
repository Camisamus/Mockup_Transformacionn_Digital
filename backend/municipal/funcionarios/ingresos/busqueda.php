<?php include '../../include/header-ingresos-funcionarios.php'; ?>

<div class="bg-white border-bottom px-4 py-3 sticky-top z-index-100">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">Búsqueda Avanzada</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em;">Localización de Gestión Documental</p>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    <div class="row">
        <!-- Columna de Filtros -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="font-weight-bold text-dark mb-0">Criterios de Búsqueda</h6>
                </div>
                <div class="card-body p-4">
                    <form>
                        <div class="form-group">
                            <label class="small font-weight-bold text-muted text-uppercase">Folio / ID</label>
                            <input type="text" class="form-control" placeholder="Ej: 2024-8851">
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold text-muted text-uppercase">Texto / Contenido</label>
                            <input type="text" class="form-control" placeholder="Palabras clave...">
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold text-muted text-uppercase">Rango de Fechas</label>
                            <div class="d-flex" style="gap: 5px;">
                                <input type="date" class="form-control form-control-sm">
                                <input type="date" class="form-control form-control-sm">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="small font-weight-bold text-muted text-uppercase">Tipo Documento</label>
                            <select class="form-control">
                                <option value="">Todos</option>
                                <option>Oficio</option>
                                <option>Memorándum</option>
                                <option>Circular</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold text-muted text-uppercase">Estado</label>
                            <div class="custom-control custom-checkbox mb-1">
                                <input type="checkbox" class="custom-control-input" id="estado1" checked>
                                <label class="custom-control-label small" for="estado1">En Proceso</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-1">
                                <input type="checkbox" class="custom-control-input" id="estado2" checked>
                                <label class="custom-control-label small" for="estado2">Completados</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="estado3">
                                <label class="custom-control-label small" for="estado3">Archivados</label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-block font-weight-bold mt-4" onclick="buscarDocumentos()">
                            <span class="material-symbols-outlined align-middle mr-1">search</span> Buscar Documentos
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna de Resultados -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="font-weight-bold text-muted mb-0">Resultados de la búsqueda</h6>
                <span class="badge badge-light border">3 documentos encontrados</span>
            </div>

            <div class="card border-0 shadow-sm" id="resultadosContainer">
                 <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size: 13px;">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3 pl-4" style="font-size: 11px;">Folio</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Asunto</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Tipo</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Fecha</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3" style="font-size: 11px;">Estado</th>
                                <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-right pr-4" style="font-size: 11px;">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Resultado 1 -->
                            <tr>
                                <td class="align-middle pl-4 font-weight-bold">#2024-8851</td>
                                <td class="align-middle">Solicitud de Compra Insumos Computacionales</td>
                                <td class="align-middle text-muted">Memorándum</td>
                                <td class="align-middle">10/02/2026</td>
                                <td class="align-middle"><span class="badge badge-warning">En Visación</span></td>
                                <td class="align-middle text-right pr-4">
                                     <a href="ver.php" class="btn btn-sm btn-light border"><span class="material-symbols-outlined align-middle" style="font-size: 16px;">visibility</span></a>
                                </td>
                            </tr>
                            <!-- Resultado 2 -->
                             <tr>
                                <td class="align-middle pl-4 font-weight-bold">#2023-5520</td>
                                <td class="align-middle">Compra Insumos Computacionales (Anterior)</td>
                                <td class="align-middle text-muted">Memorándum</td>
                                <td class="align-middle">15/06/2023</td>
                                <td class="align-middle"><span class="badge badge-success">Completado</span></td>
                                <td class="align-middle text-right pr-4">
                                     <a href="ver.php" class="btn btn-sm btn-light border"><span class="material-symbols-outlined align-middle" style="font-size: 16px;">visibility</span></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                 </div>
                 <div class="card-footer bg-white text-center py-3">
                     <button class="btn btn-link btn-sm text-muted">Cargar más resultados...</button>
                 </div>
            </div>
            
            <!-- Estado Vacío (Oculto por defecto) -->
            <div class="text-center py-5 d-none" id="emptyState">
                <span class="material-symbols-outlined text-muted mb-3" style="font-size: 48px; opacity: 0.3;">search_off</span>
                <h5 class="font-weight-bold text-muted">No se encontraron documentos</h5>
                <p class="text-muted small">Intenta ajustar los filtros de búsqueda.</p>
            </div>

        </div>
    </div>
</div>

<script>
    function buscarDocumentos() {
        let btn = document.querySelector('button[onclick="buscarDocumentos()"]');
        let originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Buscando...';
        
        // Simulación de búsqueda
        setTimeout(() => {
            btn.disabled = false;
            btn.innerHTML = originalText;
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Búsqueda actualizada',
                showConfirmButton: false,
                timer: 1500
            });
        }, 800);
    }
</script>

<?php include '../../include/footer-funcionarios.php'; ?>
