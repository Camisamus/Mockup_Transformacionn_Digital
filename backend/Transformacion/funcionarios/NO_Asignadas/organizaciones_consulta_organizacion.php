<?php
$pageTitle = "Consulta Organización";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header & Toolbar -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Gestión de Organizaciones</h2>
            <p class="text-muted mb-0">Consulta, crea y modifica organizaciones comunitarias</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar w-100 shadow-sm" onclick="buscarOrganizacion()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Buscar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar w-100 shadow-sm" onclick="nuevaOrganizacion()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Nueva
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar w-100 shadow-sm" onclick="editarFormulario()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Modificar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar w-100 shadow-sm" onclick="generarCertificado()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Certificado PDF
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="guardarCambios()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form id="formOrganizacion">
        <!-- Sección: Información General -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold fs-6 mb-1">Información General</h5>
                <p class="text-muted small mb-4">Datos principales de identificación de la organización</p>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="tipoOrganizacion" class="form-label small fw-bold">Tipo de Organización</label>
                        <select class="form-select" id="tipoOrganizacion">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="codigo" class="form-label small fw-bold">Código</label>
                        <input type="text" class="form-control" id="codigo" placeholder="Código de organización">
                    </div>
                    <div class="col-md-4">
                        <label for="rut" class="form-label small fw-bold">RUT</label>
                        <input type="text" class="form-control" id="rut" placeholder="XX.XXX.XXX-X">
                    </div>

                    <div class="col-md-4">
                        <label for="rpj" class="form-label small fw-bold">RPJ</label>
                        <input type="text" class="form-control" id="rpj" placeholder="RPJ">
                    </div>
                    <div class="col-md-4">
                        <label for="categoria" class="form-label small fw-bold">Categoría</label>
                        <select class="form-select" id="categoria">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="subcategoria" class="form-label small fw-bold">Subcategoría</label>
                        <input type="text" class="form-control" id="subcategoria" placeholder="Subcategoría">
                    </div>

                    <div class="col-md-4">
                        <label for="estado" class="form-label small fw-bold">Estado</label>
                        <select class="form-select" id="estado">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="nombre" class="form-label small fw-bold">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre de la organización">
                    </div>

                    <div class="col-12">
                        <label for="razonSocial" class="form-label small fw-bold">Razón Social</label>
                        <input type="text" class="form-control" id="razonSocial" placeholder="Razón social">
                    </div>

                    <div class="col-md-4">
                        <label for="unidadVecinal" class="form-label small fw-bold">Unidad Vecinal</label>
                        <input type="text" class="form-control" id="unidadVecinal" placeholder="Unidad vecinal">
                    </div>
                    <div class="col-md-4">
                        <label for="registro" class="form-label small fw-bold">Registro</label>
                        <input type="text" class="form-control" id="registro" placeholder="N°mero de registro">
                    </div>
                    <div class="col-md-4">
                        <label for="folio" class="form-label small fw-bold">Folio</label>
                        <input type="number" class="form-control" id="folio" placeholder="N°mero de folio">
                    </div>

                    <div class="col-md-6">
                        <label for="fechaRegistro" class="form-label small fw-bold">Fecha del Registro</label>
                        <input type="date" class="form-control" id="fechaRegistro">
                    </div>
                    <div class="col-md-6">
                        <label for="numeroSocios" class="form-label small fw-bold">N°mero de Socios</label>
                        <input type="number" class="form-control" id="numeroSocios" placeholder="Cantidad de socios">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección: Objeto Social -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold fs-6 mb-1">Objeto Social</h5>
                <p class="text-muted small mb-4">Información sobre el prop¿sito y Áreas de especialización</p>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="objetoTipoOrganizacion" class="form-label small fw-bold">Tipo de
                            Organización</label>
                        <select class="form-select" id="objetoTipoOrganizacion">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="areaEspecializacion" class="form-label small fw-bold">Área de
                            Especialización</label>
                        <input type="text" class="form-control" id="areaEspecializacion"
                            placeholder="Área de especialización">
                    </div>
                    <div class="col-md-6">
                        <label for="fechaIngreso" class="form-label small fw-bold">Fecha de Ingreso</label>
                        <input type="date" class="form-control" id="fechaIngreso">
                    </div>
                    <div class="col-md-6">
                        <label for="fechaTermino" class="form-label small fw-bold">Fecha de T¿rmino de
                            Vigencia</label>
                        <input type="date" class="form-control" id="fechaTermino">
                    </div>
                    <div class="col-12">
                        <label for="descripcionObjeto" class="form-label small fw-bold">Descripción del Objeto
                            Social</label>
                        <textarea class="form-control" id="descripcionObjeto" rows="4"
                            placeholder="Describa detalladamente el objeto social..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección: Representante y Domicilio (Grid split) -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 mb-4 h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-1">Representante Legal</h5>
                        <p class="text-muted small mb-4">Datos del representante legal</p>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="repRut" class="form-label small fw-bold">RUT</label>
                                <input type="text" class="form-control" id="repRut" placeholder="XX.XXX.XXX-X">
                            </div>
                            <div class="col-md-6">
                                <label for="repApellidoPaterno" class="form-label small fw-bold">Apellido
                                    Paterno</label>
                                <input type="text" class="form-control" id="repApellidoPaterno">
                            </div>
                            <div class="col-md-6">
                                <label for="repApellidoMaterno" class="form-label small fw-bold">Apellido
                                    Materno</label>
                                <input type="text" class="form-control" id="repApellidoMaterno">
                            </div>
                            <div class="col-12">
                                <label for="repNombres" class="form-label small fw-bold">Nombres</label>
                                <input type="text" class="form-control" id="repNombres">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 mb-4 h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-1">Domicilio y Contacto</h5>
                        <p class="text-muted small mb-4">Ubicación y datos de contacto</p>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="domCalle" class="form-label small fw-bold">Calle/Avenida</label>
                                <input type="text" class="form-control" id="domCalle">
                            </div>
                            <div class="col-md-4">
                                <label for="domNumero" class="form-label small fw-bold">N°mero</label>
                                <input type="text" class="form-control" id="domNumero">
                            </div>
                            <div class="col-md-6">
                                <label for="domComunaNombre" class="form-label small fw-bold">Comuna</label>
                                <input type="text" class="form-control" id="domComunaNombre">
                            </div>
                            <div class="col-md-6">
                                <label for="domCelular" class="form-label small fw-bold">Celular</label>
                                <input type="text" class="form-control" id="domCelular">
                            </div>
                            <div class="col-12">
                                <label for="domCorreo" class="form-label small fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control" id="domCorreo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Atenciones y Proyectos Tables -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold fs-6 mb-0">Atenciones Registradas</h5>
                    <button type="button" class="btn btn-sm btn-dark"
                        onclick="Swal.fire('Info', 'Nueva atención...', 'info')">+ Nueva Atención</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tablaAtenciones">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>N° Atención</th>
                                <th>Fecha</th>
                                <th>Atención</th>
                                <th>Proyecto</th>
                                <th>Estado</th>
                                <th>Usuario</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <!-- Data loaded dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold fs-6 mb-0">Proyectos Asociados</h5>
                    <button type="button" class="btn btn-sm btn-dark"
                        onclick="Swal.fire('Info', 'Nuevo proyecto...', 'info')">+ Nuevo Proyecto</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tablaProyectos">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>Unidad</th>
                                <th>Año</th>
                                <th>N° Ingreso</th>
                                <th>Nombre del Proyecto</th>
                                <th>Tipo Fondo</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <!-- Data loaded dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Observaciones y Antecedentes Financieros -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-1">Observaciones</h5>
                        <textarea class="form-control" id="observaciones" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-1">Antecedentes Financieros</h5>
                        <textarea class="form-control" id="antecedentesFinancieros" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/organizaciones_consulta_organizacion.js"></script>


<?php include '../../api/footer.php'; ?>