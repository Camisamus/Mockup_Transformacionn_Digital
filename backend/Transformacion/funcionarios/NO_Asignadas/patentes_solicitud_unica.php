<?php
$pageTitle = "Solicitud �nica de Tr�mites";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Solicitud �nica de Tr�mites</h2>
            <p class="text-muted mb-0">Gestione m�ltiples tr�mites de patentes en una sola solicitud unificada</p>
        </div>
    </div>

    <!-- Step 1: Selecci�n de Tr�mites -->
    <div class="section-card" id="step1_Section">
        <div class="section-title">Paso 1: Selecci�n de Tr�mites</div>
        <div class="alert alert-info">
            <small><i data-feather="info" class="me-1"></i> Seleccione uno o m�s tr�mites para realizar en una sola
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

    <!-- Step 2: Preguntas de Variaci�n -->
    <div class="section-card d-none" id="step2_Section">
        <div class="section-title">Paso 2: Detalles Espec�ficos</div>
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <button class="btn btn-sm btn-outline-secondary me-2" onclick="changeStep(2)">
                    <i data-feather="edit" class="me-1"></i> Editar Respuestas
                </button>
            </div>
        </div>

        <!-- Actions Card -->
        <div class="card shadow-sm border-0 mb-4 bg-white">
            <div class="card-body p-3">
                <div class="row g-2 justify-content-md-end">
                    <div class="col-12 col-md-auto">
                        <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm" onclick="window.print()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            Exportar Formulario (PDF)
                        </button>
                    </div>
                    <div class="col-12 col-md-auto">
                        <button class="btn btn-toolbar btn-outline-secondary w-100 shadow-sm">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-12 col-md-auto">
                        <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm"
                            onclick="alert('Borrador guardado')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Guardar Borrador
                        </button>
                    </div>
                    <div class="col-12 col-md-auto">
                        <button class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="alert('Solicitud enviada')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="22 2 11 13"></polyline>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                            Enviar Solicitud
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div id="contenedorSecciones"></div>
    </div>
</div>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY_HERE&libraries=places"></script>

<!-- Scripts -->
<script src="https://unpkg.com/feather-icons"></script>

<script>feather.replace()</script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/patentes_solicitud_unica.js"></script>

<?php include '../../api/footer.php'; ?>