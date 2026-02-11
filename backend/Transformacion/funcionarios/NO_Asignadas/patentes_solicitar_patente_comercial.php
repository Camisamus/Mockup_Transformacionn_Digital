<?php
$pageTitle = "Solicitud de Patente Commercial";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Formulario de Solicitud de Patente Comercial</h2>
            <p class="text-muted mb-0">Gestione nuevas solicitudes de patentes para actividades comerciales</p>
        </div>
    </div>

    <!-- Tipo de Tr�mite -->
    <div class="section-card mb-4" id="tipoTramiteSection">
        <div class="section-title">Tipo de Tr�mite</div>
        <div class="row g-3">
            <div class="col-md-4">
                <select class="form-select" id="tipoTr�mite">
                    <option value="">Seleccione...</option>
                </select>
            </div>
            <div class="col-12 d-none" id="variacionesSection">
                <label class="form-label mb-2">Especifique:</label>
                <div id="variacionesContainer" class="d-flex flex-wrap gap-3">
                    <!-- Checkboxes will be injected here -->
                </div>
            </div>
        </div>
        <div class="mt-3 text-end">
            <button id="btnIniciarTramite" class="btn btn-primary d-none">Iniciar Tr�mite</button>
        </div>
    </div>

    <div id="form-sections" class="d-none">
        <!-- Actions Card -->
        <div class="card shadow-sm border-0 mb-4 bg-white">
            <div class="card-body p-3">
                <div class="row g-2 justify-content-md-end">
                    <div class="col-12 col-md-auto">
                        <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm"
                            onclick="exportElementToPDF('form-sections', 'formulario_patente')">
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
                        <button class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="alert('Solicitud Enviada')">
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

        <!-- A. Individualizaci�n -->
        <div class="section-card">
            <div class="section-title">A. Individualizaci�n del Contribuyente</div>
            <div class="row g-3">
                <!-- Row 1 -->
                <div class="col-md-6">
                    <label class="form-label">RUT N°</label>
                    <input type="text" class="form-control" id="rutContribuyente" placeholder="12.345.678-9">
                </div>
                <div class="col-md-6">
                    <label class="form-label">ROL PATENTE</label>
                    <input type="text" class="form-control" id="rolPatente">
                </div>

                <!-- Row 2 -->
                <div class="col-12">
                    <label class="form-label">NOMBRE O RAZ�N SOCIAL</label>
                    <input type="text" class="form-control" id="nombreRazonSocial">
                </div>

                <!-- Row 3 -->
                <div class="col-12">
                    <label class="form-label">REPRESENTANTE LEGAL</label>
                    <input type="text" class="form-control" id="representanteLegal">
                </div>

                <!-- Row 4 -->
                <div class="col-12">
                    <label class="form-label">DIRECCI�N COMERCIAL</label>
                    <input type="text" class="form-control" id="direccionComercial">
                </div>

                <!-- Row 5 -->
                <div class="col-12">
                    <label class="form-label">DIRECCI�N PARTICULAR</label>
                    <input type="text" class="form-control" id="direccionParticular">
                </div>

                <!-- Row 6 -->
                <div class="col-md-6">
                    <label class="form-label">TEL�FONO</label>
                    <input type="tel" class="form-control" id="telefono" placeholder="+56 9 1234 5678">
                </div>
                <div class="col-md-6">
                    <label class="form-label">ROL AVAL�O</label>
                    <input type="text" class="form-control" id="rolAvaluo">
                </div>

                <!-- Row 7 -->
                <div class="col-12">
                    <label class="form-label">E-MAIL</label>
                    <input type="email" class="form-control" id="email" placeholder="correo@ejemplo.cl">
                </div>
            </div>
        </div>

        <!-- B. Actividad Econ�mica -->
        <div class="section-card">
            <div class="section-title">B. Actividad Econ�mica y Calidad del Negocio Amparado por esta Patente</div>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">GIRO</label>
                    <input type="text" class="form-control" id="giro">
                </div>
                <div class="col-md-6">
                    <label class="form-label">C�DIGO ACTIVIDAD S.I.I</label>
                    <input type="text" class="form-control" id="codigoSII">
                </div>
                <div class="col-md-6">
                    <label class="form-label">CASA MATRIZ</label>
                    <input type="text" class="form-control" id="casaMatriz">
                </div>
                <div class="col-md-6">
                    <label class="form-label">SUCURSAL</label>
                    <input type="text" class="form-control" id="sucursal">
                </div>
                <div class="col-md-6">
                    <label class="form-label">INDICAR MUNICIPALIDAD DE CASA MATRIZ SI ES SUCURSAL</label>
                    <input type="text" class="form-control" id="muniCasaMatriz">
                </div>
            </div>
        </div>

        <!-- C. Patentes Anteriores -->
        <div class="section-card">
            <div class="section-title">C. Detalle Todas las Patentes del Contribuyente</div>

            <!-- Table 1: Vi�a del Mar -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label fw-bold m-0">Patente(s) Comuna Vi�a del Mar</label>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-success"
                            onclick="exportTableToExcel('tablaVina', 'patentes_vina')">Exportar Excel</button>
                        <button class="btn btn-outline-danger"
                            onclick="exportElementToPDF('tablaVina', 'patentes_vina')">Exportar PDF</button>
                    </div>
                </div>
                <table class="table table-bordered table-sm" id="tablaVina">
                    <thead class="table-light">
                        <tr>
                            <th>ROL PATENTE</th>
                            <th>N° TRABAJADORES</th>
                            <th>COMUNA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" id="vinaRol_0"></td>
                            <td><input type="number" class="form-control form-control-sm" id="vinaTrabajadores_0">
                            </td>
                            <td><input type="text" class="form-control form-control-sm" value="Vi�a del Mar" readonly
                                    disabled></td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-sm btn-outline-secondary" id="btnAddVina">+ Agregar Patente Vi�a del
                    Mar</button>
            </div>

            <!-- Table 2: Otras Comunas -->
            <div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label fw-bold m-0">Patente(s) Otras Comunas</label>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-success"
                            onclick="exportTableToExcel('tablaOtras', 'patentes_otras')">Exportar Excel</button>
                        <button class="btn btn-outline-danger"
                            onclick="exportElementToPDF('tablaOtras', 'patentes_otras')">Exportar PDF</button>
                    </div>
                </div>
                <table class="table table-bordered table-sm" id="tablaOtras">
                    <thead class="table-light">
                        <tr>
                            <th>ROL PATENTE</th>
                            <th>COMUNA</th>
                            <th>N° TRABAJADORES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" id="otraRol_0"></td>
                            <td><input type="text" class="form-control form-control-sm" id="otraComuna_0"></td>
                            <td><input type="number" class="form-control form-control-sm" id="otraTrabajadores_0">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-sm btn-outline-secondary" id="btnAddOtras">+ Agregar Patente Otra
                    Comuna</button>
            </div>
        </div>

        <!-- D. Propaganda -->
        <div class="section-card">
            <div class="section-title">D. Declaraci�n de Propaganda</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">LUMINOSA</label>
                    <input type="text" class="form-control" id="propagandaLuminosa">
                </div>
                <div class="col-md-4">
                    <label class="form-label">NO LUMINOSA</label>
                    <input type="text" class="form-control" id="propagandaNoLuminosa">
                </div>
                <div class="col-md-4">
                    <label class="form-label">TOTAL MTS CUADRADOS</label>
                    <input type="number" class="form-control" id="propagandaTotalM2">
                </div>
            </div>
        </div>

        <!-- E. Capital Propio -->
        <div class="section-card">
            <div class="section-title">E. Monto del Capital Propio de la Empresa</div>
            <div class="row">
                <div class="col-12">
                    <label class="form-label">Suma de Capital Propio ($)</label>
                    <input type="number" class="form-control" id="capitalPropio" placeholder="0">
                </div>
            </div>
        </div>

        <!-- Firma -->
        <div class="section-card">
            <div class="text-dark fw-bold mb-3">Firma del Contribuyente o Representante Legal</div>
            <div class="border border-2 border-secondary border-dashed p-5 text-center text-muted rounded bg-light"
                id="seccionFirma">
                [Espacio para firma digital]
            </div>
        </div>

        <!-- F. Documentaci�n -->
        <div class="section-card mb-5">
            <div class="section-title">F. Documentaci�n Necesaria</div>
            <div class="mb-2">Adjunte los documentos requeridos:</div>
            <div class="list-group" id="documentosList">
                <!-- Dynamic Documents Here -->
            </div>
        </div>

    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/patentes_solicitar_patente_comercial.js"></script>


<?php include '../../api/footer.php'; ?>