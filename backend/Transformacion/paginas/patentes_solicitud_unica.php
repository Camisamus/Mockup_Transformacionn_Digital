<?php
$pageTitle = "Solicitudes";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


    <div class="container-fluid">
        <!-- Step 1: Selección de Trámites -->
        <div class="section-card" id="step1_Section">
            <div class="section-title">Paso 1: Selección de Trámites</div>
            <div class="alert alert-info">
                <small><i data-feather="info" class="me-1"></i> Seleccione uno o más trámites para realizar en una sola
                    solicitud.</small>
            </div>

            <div id="tramitesContainer" class="row g-3">
                <!-- Checkboxes injected by JS -->
            </div>

            <div class="mt-4 text-end">
                <button id="btnIrPaso2" class="btn btn-primary" disabled>
                    Continuar <i data-feather="arrow-right" class="ms-1"></i>
                </button>
            </div>
        </div>

        <!-- Drafts Section -->
        <div class="section-card d-none" id="borradoresSection">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="section-title mb-0 text-secondary"><i data-feather="save" class="me-2"></i>Borradores
                    Guardados</div>
                <span class="badge bg-secondary" id="borradoresCount">0</span>
            </div>
            <div id="borradoresContainer" class="list-group list-group-flush">
                <!-- Drafts injected by JS -->
            </div>
        </div>

        <!-- Step 2: Preguntas de Variación -->
        <div class="section-card d-none" id="step2_Section">
            <div class="section-title">Paso 2: Detalles Específicos</div>
            <p class="text-muted mb-3">Seleccione de las siguientes preguntas Todas aquellas cuya respuesta sea
                afirmativa.</p>

            <div id="preguntasContainer" class="d-flex flex-column gap-3">
                <!-- Questions injected by JS -->
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <button class="btn btn-outline-secondary" onclick="changeStep(1)">
                    <i data-feather="arrow-left" class="me-1"></i> Volver
                </button>
                <button id="btnGenerarFormulario" class="btn btn-success">
                    Continuar <i data-feather="check-circle" class="ms-1"></i>
                </button>
            </div>
        </div>

        <!-- Step 3: Formulario Generado -->
        <div id="step3_Section" class="d-none">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-sm btn-outline-secondary me-2" onclick="changeStep(2)">
                    <i data-feather="edit" class="me-1"></i> Editar Respuestas
                </button>
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-danger" onclick="window.print()">
                        <i data-feather="file" class="me-1"></i> PDF
                    </button>
                </div>
            </div>

            <!-- Form Container -->
            <div id="contenedorSecciones"></div>

            <!-- Botones Finales -->
            <div class="d-flex justify-content-end mb-5 mt-4 gap-2">
                <button class="btn btn-secondary">Cancelar</button>
                <button class="btn btn-outline-primary" onclick="alert('Borrador guardado')">Guardar Borrador</button>
                <button class="btn btn-primary btn-lg" onclick="alert('Solicitud enviada')">Enviar Solicitud</button>
            </div>
        </div>
    </div>

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY_HERE&libraries=places"></script>

    <!-- Scripts -->
    <script src="https://unpkg.com/feather-icons"></script>
    
    <script>feather.replace()</script>
    <script src="../recursos/js/patentes_solicitud_unica.js"></script>

<?php include '../api/footer.php'; ?>

