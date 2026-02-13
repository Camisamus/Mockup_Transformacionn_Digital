<?php include '../../include/header-ingresos-funcionarios.php'; ?>

<div class="bg-white border-bottom px-4 py-3 sticky-top z-index-100">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">Nuevo Ingreso Administrativo</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em;">Gestión Documental Digital</p>
        </div>
        <div class="d-flex" style="gap: 10px;">
            <button class="btn btn-outline-secondary btn-sm font-weight-bold">
                <span class="material-symbols-outlined align-middle mr-1" style="font-size: 18px;">save</span>
                Guardar Borrador
            </button>
            <button class="btn btn-primary btn-sm font-weight-bold px-4" onclick="confirmarEnvio()">
                <span class="material-symbols-outlined align-middle mr-1" style="font-size: 18px;">send</span>
                Enviar Procesar
            </button>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    <form id="formIngreso">
        
        <div class="row">
            <!-- Columna Izquierda: Datos del Documento -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="font-weight-bold text-dark mb-0">1. Antecedentes del Documento</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="small font-weight-bold text-muted text-uppercase">Título / Referencia</label>
                                <input type="text" class="form-control" placeholder="Ej: Solicitud de Compra Insumos Computacionales">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small font-weight-bold text-muted text-uppercase">Tipo de Ingreso</label>
                                <select class="form-control">
                                    <option value="">Seleccione...</option>
                                    <option value="oficio">Oficio</option>
                                    <option value="memorandum">Memorándum</option>
                                    <option value="carta">Carta</option>
                                    <option value="circular">Circular</option>
                                    <option value="solicitud">Solicitud Interna</option>
                                    <option value="resolucion">Resolución</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small font-weight-bold text-muted text-uppercase">Contenido / Providencia</label>
                            <textarea class="form-control" rows="8" placeholder="Escriba el contenido del documento o la instrucción de la providencia..."></textarea>
                            <small class="text-muted">Este texto servirá como el cuerpo principal del documento digital.</small>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="font-weight-bold text-dark mb-0">2. Adjuntos y Referencias</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-4">
                            <label class="small font-weight-bold text-muted text-uppercase">Documento Principal (PDF)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" accept="application/pdf">
                                <label class="custom-file-label" for="customFile">Seleccionar archivo PDF...</label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="small font-weight-bold text-muted text-uppercase">Anexos (Opcional)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFileAnexos" multiple accept="application/pdf">
                                <label class="custom-file-label" for="customFileAnexos">Seleccionar anexos PDF...</label>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="small font-weight-bold text-muted text-uppercase mb-0">Enlaces Externos</label>
                                <button type="button" class="btn btn-link btn-sm p-0 font-weight-bold" onclick="addLinkRow()">
                                    <span class="material-symbols-outlined align-middle" style="font-size: 16px;">add</span> Agregar Enlace
                                </button>
                            </div>
                            <div id="linksContainer">
                                <!-- Dynamic Links -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Distribución -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm mb-4 sticky-top" style="top: 90px; z-index: 90;">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-bold text-dark mb-0">3. Distribución y Flujo</h6>
                        <span class="badge badge-light border">Simulación DocDigital</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-info border-0 d-flex align-items-center" style="font-size: 12px;">
                            <span class="material-symbols-outlined mr-2">info</span>
                            Los responsables solo recibirán el documento una vez que todos los visadores hayan aprobado.
                        </div>

                        <div class="mb-3">
                            <label class="small font-weight-bold text-muted text-uppercase">Agregar Destinatario</label>
                            <div class="input-group mb-2">
                                <select class="form-control" id="selectFuncionario">
                                    <option value="">Buscar funcionario...</option>
                                    <option value="1">Juan Pérez (Dpto. Operaciones)</option>
                                    <option value="2">María Gómez (Dirección Tránsito)</option>
                                    <option value="3">Pedro Tapia (Administración)</option>
                                    <option value="4">Ana Ruiz (Jurídica)</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" onclick="addRecipient()">
                                        <span class="material-symbols-outlined align-middle">person_add</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="recipientsList" class="my-4">
                            <!-- Lista de destinatarios dinámica -->
                        </div>

                    </div>
                    <div class="card-footer bg-light p-3">
                        <div class="d-flex justify-content-between align-items-center small text-muted">
                            <span>Total Visadores: <strong id="countVisadores">0</strong></span>
                            <span>Total Responsables: <strong id="countResponsables">0</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<!-- Template para Enlaces -->
<template id="linkTemplate">
    <div class="input-group mb-2 link-row fade-in">
        <input type="text" class="form-control form-control-sm" placeholder="URL (https://...)">
        <input type="text" class="form-control form-control-sm" placeholder="Descripción">
        <div class="input-group-append">
            <button class="btn btn-outline-danger btn-sm" type="button" onclick="removeRow(this)">
                <span class="material-symbols-outlined" style="font-size: 16px;">close</span>
            </button>
        </div>
    </div>
</template>

<!-- Template para Destinatario -->
<template id="recipientTemplate">
    <div class="card mb-2 border recipient-card fade-in">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="d-flex align-items-center">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 32px; height: 32px;">
                        <span class="material-symbols-outlined text-muted" style="font-size: 18px;">person</span>
                    </div>
                    <div>
                        <span class="font-weight-bold d-block text-dark recipient-name" style="font-size: 13px;">Nombre Funcionario</span>
                        <span class="text-muted small recipient-dept" style="font-size: 11px;">Departamento</span>
                    </div>
                </div>
                <button type="button" class="btn btn-link text-danger p-0" onclick="removeRecipient(this)">
                    <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                </button>
            </div>
            
            <div class="row no-gutters align-items-center bg-light rounded p-2">
                <div class="col-12 mb-2">
                    <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                        <label class="btn btn-white border btn-sm active shadow-none">
                            <input type="radio" name="role_uid" value="responsable" onchange="toggleRole(this)" checked> Responsable
                        </label>
                        <label class="btn btn-white border btn-sm shadow-none">
                            <input type="radio" name="role_uid" value="visador" onchange="toggleRole(this)"> Visador
                        </label>
                    </div>
                </div>
                
                <div class="col-12 role-options">
                    <div class="form-group mb-2">
                        <select class="form-control form-control-sm border-0 shadow-sm">
                            <option value="ejecutar">Ejecutar lo requerido</option>
                            <option value="informe">Generar Informe</option>
                            <option value="conocimiento">Tomar Conocimiento</option>
                            <option value="responder">Responder al Remitente</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="small text-muted mb-1">Fecha Límite</label>
                        <input type="date" class="form-control form-control-sm border-0 shadow-sm" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .fade-in { animation: fadeIn 0.3s ease-in-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    .btn-white { background-color: #fff; color: #333; }
    .btn-white.active { background-color: var(--gob-primary); color: #fff; border-color: var(--gob-primary) !important; }
</style>

<script>
    // Gestión de Archivos (Visual)
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Gestión de Enlaces
    function addLinkRow() {
        let template = document.getElementById('linkTemplate');
        let clone = template.content.cloneNode(true);
        document.getElementById('linksContainer').appendChild(clone);
    }
    
    function removeRow(btn) {
        $(btn).closest('.link-row').remove();
    }

    // Gestión de Destinatarios
    function addRecipient() {
        let select = document.getElementById('selectFuncionario');
        if(select.value === "") {
            Swal.fire('Error', 'Debe seleccionar un funcionario', 'error');
            return;
        }
        
        let name = select.options[select.selectedIndex].text;
        
        let template = document.getElementById('recipientTemplate');
        let clone = template.content.cloneNode(true);
        
        // Asignar datos (simulado)
        clone.querySelector('.recipient-name').textContent = name;
        
        // Generar ID único para los radios
        let uid = Date.now();
        let radios = clone.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => radio.name = 'role_' + uid);

        document.getElementById('recipientsList').appendChild(clone);
        updateCounts();
        
        select.value = "";
    }

    function removeRecipient(btn) {
        $(btn).closest('.recipient-card').remove();
        updateCounts();
    }

    function toggleRole(radio) {
        let card = $(radio).closest('.recipient-card');
        let options = card.find('.role-options');
        
        if (radio.value === 'visador') {
            options.slideUp();
        } else {
            options.slideDown();
        }
        updateCounts();
    }

    function updateCounts() {
        let totalVisadores = $('input[value="visador"]:checked').length;
        let totalResponsables = $('input[value="responsable"]:checked').length;
        
        $('#countVisadores').text(totalVisadores);
        $('#countResponsables').text(totalResponsables);
    }

    function confirmarEnvio() {
        Swal.fire({
            title: '¿Confirmar Envío?',
            text: "Se iniciará el flujo de firmas. Los responsables serán notificados una vez completada la visación.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#006FB3',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, enviar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Enviado',
                    'El documento ha entrado al flujo de visación.',
                    'success'
                ).then(() => {
                    window.location.href = 'index.php';
                });
            }
        });
    }
    
    // Iniciar con un enlace por defecto (opcional)
    // addLinkRow();
</script>

<?php include '../../include/footer-funcionarios.php'; ?>
