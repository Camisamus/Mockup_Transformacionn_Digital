<?php include '../../include/header-ingresos-funcionarios.php'; ?>

<div class="bg-white border-bottom px-4 py-3 sticky-top z-index-100">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">INGRESO N° 2024-8851</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em;">Gestión Documental Digital</p>
        </div>
        <div class="d-flex" style="gap: 10px;">
            <a href="bandeja.php" class="btn btn-outline-secondary btn-sm font-weight-bold">
                <span class="material-symbols-outlined align-middle mr-1">arrow_back</span> Volver
            </a>
            <button class="btn btn-warning btn-sm font-weight-bold text-white px-3" onclick="crearSubtarea()">
                <span class="material-symbols-outlined align-middle mr-1">fork_right</span> Derivar / Crear Subtarea
            </button>
            <button class="btn btn-info btn-sm font-weight-bold text-white px-3" onclick="descargarExpediente()">
                <span class="material-symbols-outlined align-middle mr-1">download</span> Descargar Expediente
            </button>
            <button class="btn btn-success btn-sm font-weight-bold px-3" onclick="visarDocumento()">
                <span class="material-symbols-outlined align-middle mr-1">verified</span> Visar Documento
            </button>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    <div class="row">
        <!-- Columna Izquierda: Detalle del Documento -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-dark mb-0">Antecedentes del Ingreso</h6>
                    <span class="badge badge-info px-3 py-2">EN PROCESO DE VISACIÓN</span>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label class="small font-weight-bold text-muted text-uppercase mb-1">Título / Referencia</label>
                            <p class="h6 text-dark font-weight-bold">Solicitud de Compra Insumos Computacionales - Depto. Tránsito</p>
                        </div>
                        <div class="col-md-4 text-right">
                            <label class="small font-weight-bold text-muted text-uppercase mb-1">Fecha Ingreso</label>
                            <p class="h6 text-dark font-weight-bold">10/02/2026</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="small font-weight-bold text-muted text-uppercase mb-1">Tipo de Documento</label>
                            <p class="mb-0">Memorándum Interno</p>
                        </div>
                        <div class="col-md-4">
                            <label class="small font-weight-bold text-muted text-uppercase mb-1">Remitente</label>
                            <p class="mb-0">María Arancibia (Jefa Dpto. Tránsito)</p>
                        </div>
                        <div class="col-md-4">
                             <label class="small font-weight-bold text-muted text-uppercase mb-1">Plazo Respuesta</label>
                            <p class="mb-0 text-danger font-weight-bold">15/02/2026 (5 días restantes)</p>
                        </div>
                    </div>

                    <div class="bg-light p-4 rounded mb-4">
                        <label class="small font-weight-bold text-muted text-uppercase mb-2">Contenido / Providencia</label>
                        <p class="text-dark mb-0" style="white-space: pre-line; font-size: 14px;">
                            Estimado Alcalde,
                            
                            Junto con saludar, solicito a usted autorizar la compra de 5 computadores All-in-One para el departamento de tránsito, debido a la obsolescencia de los equipos actuales.
                            
                            Adjunto cotizaciones de mercado público.
                            
                            Atentamente,
                            María Arancibia.
                        </p>
                    </div>

                    <h6 class="font-weight-bold text-dark mb-3">Adjuntos y Referencias</h6>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="card p-2 border shadow-sm">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined text-danger mr-2" style="font-size: 32px;">picture_as_pdf</span>
                                    <div class="d-flex flex-column overflow-hidden">
                                        <a href="#" class="small font-weight-bold text-truncate text-dark stretched-link">Memo_8851.pdf</a>
                                        <small class="text-muted">Documento Principal</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                             <div class="card p-2 border shadow-sm">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined text-muted mr-2" style="font-size: 32px;">attachment</span>
                                    <div class="d-flex flex-column overflow-hidden">
                                        <a href="#" class="small font-weight-bold text-truncate text-dark stretched-link">Cotizaciones_MP.pdf</a>
                                        <small class="text-muted">Anexo</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-4 mb-2">
                             <div class="card p-2 border shadow-sm">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined text-primary mr-2" style="font-size: 32px;">link</span>
                                    <div class="d-flex flex-column overflow-hidden">
                                        <a href="#" class="small font-weight-bold text-truncate text-dark stretched-link">Enlace a Mercado Público</a>
                                        <small class="text-muted">Enlace Externo</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Sección de Respuesta del Responsable -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="font-weight-bold text-dark mb-0">Mi Gestión / Respuesta</h6>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
                        <span class="material-symbols-outlined mr-2">warning</span>
                        <div>
                            <strong>Instrucción recibida:</strong> Generar Informe Técnico.
                            <br>
                            <small>Fecha límite: 15/02/2026</small>
                        </div>
                    </div>
                    
                    <form>
                        <div class="form-group">
                            <label class="small font-weight-bold text-muted text-uppercase">Respuesta / Informe</label>
                            <textarea class="form-control" rows="5" placeholder="Redacte su respuesta o informe técnico aquí..."></textarea>
                        </div>
                        <div class="form-group">
                             <label class="small font-weight-bold text-muted text-uppercase">Adjuntar Respuesta (Opcional)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="respuestaFile">
                                <label class="custom-file-label" for="respuestaFile">Seleccionar archivo...</label>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary font-weight-bold">
                                <span class="material-symbols-outlined align-middle mr-1">send</span> Enviar Respuesta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Flujo y Subtareas -->
        <div class="col-lg-4">
            
            <!-- Flujo de Visación -->
             <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="font-weight-bold text-dark mb-0">Flujo de Visación</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <span class="material-symbols-outlined text-success mr-3">check_circle</span>
                            <div class="flex-grow-1">
                                <span class="d-block font-weight-bold text-dark" style="font-size: 13px;">Juan Pérez (Operaciones)</span>
                                <small class="text-muted">Visado el 10/02/2026 10:30</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center bg-light">
                             <span class="material-symbols-outlined text-warning mr-3">pending</span>
                            <div class="flex-grow-1">
                                <span class="d-block font-weight-bold text-dark" style="font-size: 13px;">Ud. (Administración)</span>
                                <small class="text-warning font-weight-bold">Pendiente de Visación</small>
                            </div>
                            <button class="btn btn-sm btn-success py-0 px-2" style="font-size: 11px;" onclick="visarDocumento()">Visar</button>
                        </li>
                        <li class="list-group-item d-flex align-items-center text-muted" style="opacity: 0.6;">
                            <span class="material-symbols-outlined mr-3">radio_button_unchecked</span>
                            <div class="flex-grow-1">
                                <span class="d-block font-weight-bold" style="font-size: 13px;">Ana Ruiz (Jurídica)</span>
                                <small>En espera</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Árbol de Subtareas -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-dark mb-0">Subtareas / Derivaciones</h6>
                     <button class="btn btn-link btn-sm p-0" onclick="crearSubtarea()">
                        <span class="material-symbols-outlined text-primary">add_circle</span>
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordionSubtareas">
                        <!-- Subtarea 1 -->
                        <div class="card border-0 border-bottom rounded-0">
                            <div class="card-header bg-white p-3" id="headingSub1" data-toggle="collapse" data-target="#collapseSub1" aria-expanded="true" style="cursor: pointer;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                         <span class="material-symbols-outlined text-muted mr-2" style="font-size: 18px;">subdirectory_arrow_right</span>
                                        <div>
                                            <span class="font-weight-bold d-block text-dark" style="font-size: 12px;">Consultar Stock Bodega</span>
                                            <small class="text-muted">Asignado a: Pedro Tapia</small>
                                        </div>
                                    </div>
                                    <span class="badge badge-success" style="font-size: 10px;">Completada</span>
                                </div>
                            </div>
                            <div id="collapseSub1" class="collapse" aria-labelledby="headingSub1" data-parent="#accordionSubtareas">
                                <div class="card-body bg-light p-3 small">
                                    <p class="font-weight-bold mb-1">Respuesta:</p>
                                    <p class="mb-2">No hay stock disponible de computadores AIO en bodega.</p>
                                    <a href="#" class="text-primary font-weight-bold"><span class="material-symbols-outlined align-middle" style="font-size: 14px;">attachment</span> informe_bodega.pdf</a>
                                </div>
                            </div>
                        </div>

                        <!-- Subtarea 2 -->
                         <div class="card border-0 rounded-0">
                            <div class="card-header bg-white p-3" id="headingSub2" data-toggle="collapse" data-target="#collapseSub2" aria-expanded="false" style="cursor: pointer;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                         <span class="material-symbols-outlined text-muted mr-2" style="font-size: 18px;">subdirectory_arrow_right</span>
                                        <div>
                                            <span class="font-weight-bold d-block text-dark" style="font-size: 12px;">Validar Presupuesto</span>
                                            <small class="text-muted">Asignado a: Finanzas</small>
                                        </div>
                                    </div>
                                    <span class="badge badge-warning" style="font-size: 10px;">Pendiente</span>
                                </div>
                            </div>
                            <div id="collapseSub2" class="collapse" aria-labelledby="headingSub2" data-parent="#accordionSubtareas">
                                <div class="card-body bg-light p-3 small">
                                    <p class="text-muted mb-0">Esperando respuesta del departamento de Finanzas...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Gestión de Archivos (Visual)
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function descargarExpediente() {
        Swal.fire({
            title: 'Generando Expediente',
            html: 'Compilando documentos y firmas... <br><b>Por favor espere.</b>',
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                Swal.fire({
                    icon: 'success',
                    title: 'Descarga Iniciada',
                    text: 'El expediente digital (PDF) se ha descargado correctamente.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    }

    function visarDocumento() {
        Swal.fire({
            title: '¿Visar Documento?',
            text: "Al visar, confirmas que has revisado y aprobado el contenido. El documento pasará al siguiente visador o responsable.",
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
                    'El documento ha sido marcado como visado por ti.',
                    'success'
                );
            }
        });
    }

    function crearSubtarea() {
        Swal.fire({
            title: 'Crear Subtarea / Derivación',
            html: `
                <div class="text-left">
                    <div class="form-group">
                        <label class="small font-weight-bold text-uppercase">Asignar a:</label>
                        <select class="form-control" id="subtareaAssignee">
                            <option>Seleccionar funcionario...</option>
                            <option>Finanzas</option>
                            <option>Jurídica</option>
                            <option>Adquisiciones</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="small font-weight-bold text-uppercase">Instrucción Específica:</label>
                        <textarea class="form-control" rows="3" placeholder="Ej: Validar disponibilidad presupuestaria..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="small font-weight-bold text-uppercase">Fecha Límite:</label>
                        <input type="date" class="form-control">
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Crear Subtarea',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#006FB3',
            preConfirm: () => {
                // Lógica para guardar la subtarea
                return true;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Subtarea Creada', 'La derivación ha sido asignada correctamente.', 'success');
            }
        });
    }
</script>

<?php include '../../include/footer-funcionarios.php'; ?>
