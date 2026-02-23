<?php
$pageTitle = "DESVE";
require_once '../../api/auth_check.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Crear Nueva Solicitud DESVE</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-blue: #0071bc;
            --custom-text: #857F7E;
        }

        body { font-family: 'Inter', sans-serif; }
        .bg-primary-blue { background-color: var(--primary-blue); }
        .text-primary-blue { color: var(--primary-blue); }
        .text-custom { color: var(--custom-text); }
        
        /* Estilos para etiquetas con mejor contraste */
        .label-custom {
            color: var(--custom-text) !important;
            font-weight: 700;
        }
        
        /* Estilos para inputs de solo lectura con contraste */
        .input-readonly-dashed {
            background-color: #f9fafb !important;
            border-style: dashed !important;
            border-width: 1.5px !important;
        }

        /* Forzar altura de botones pequeños para que calcen con inputs sm */
        .btn-mini-square {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .update-flash {
            animation: pulse-blue 0.8s ease-in-out;
        }

        @keyframes pulse-blue {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); color: #0071bc; }
            100% { transform: scale(1); }
        }

        /* Switch personalizado */
        .form-switch-custom {
            width: 2.2em;
            height: 1.1em;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">


<main class="max-w-7xl mx-auto px-4 py-8">
    <form id="form_nuevo_desve" method="POST" enctype="multipart/form-data">
        
        <section class="bg-white rounded-lg border border-gray-200 p-8 mb-8 flex justify-between items-center shadow-md sticky top-0 z-20">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Crear Nueva Solicitud DESVE</h1>
                <p class="text-gray-500 mt-1">Complete los campos para ingresar un nuevo requerimiento al departamento de desarrollo vecinal</p>
            </div>
            <div class="flex items-center space-x-6">
                <a class="text-primary-blue font-semibold hover:underline transition-all text-sm" href="index.php">Cancelar</a>
                <button type="submit" class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded shadow-sm transition-colors text-sm uppercase tracking-wide">
                    Guardar Solicitud
                </button>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                
                <section class="bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-800 mb-8 pb-2 border-b">1. Información de la Solicitud</h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        
                        <div class="md:col-span-3">
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Nombre / Título</label>
                            <input class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm" 
                                   id="NombreExpediente" placeholder="E.J: SOLICITUD DE COMPRA INSUMOS COMPUTACIONALES" type="text" required/>
                        </div>

                        <div class="md:col-span-1">
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Código DESVE</label>
                            <input class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm text-center font-bold text-primary-blue bg-blue-50" 
                                   type="text" name="codigo_desve" placeholder="123"/>
                        </div>

                        <div class="md:col-span-4">
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Reingreso</label>
                            <div class="flex shadow-sm h-[38px]">
                                <input class="flex-grow border-gray-300 rounded-l-md focus:ring-primary-blue focus:border-primary-blue text-sm italic input-readonly-dashed" 
                                       id="ReingresoDisplay" readonly placeholder="BUSCAR SOLICITUD PREVIA..." type="text"/>
                                <button type="button" onclick="abrirModalReingreso()" class="bg-slate-600 hover:bg-slate-700 text-white px-4 rounded-r-md transition-colors flex items-center">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Tipo de Solicitante</label>
                            <select id="ID_Organizacion" class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm" required>
                                <option value="" disabled selected>SELECCIONE TIPO...</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Nombre de la Entidad / Origen</label>
                            <div class="flex shadow-sm h-[38px]">
                                <input class="flex-grow border-gray-300 rounded-l-md focus:ring-primary-blue focus:border-primary-blue text-sm input-readonly-dashed" 
                                       id="OrigenSolicitudDisplay" readonly placeholder="BUSCAR O CREAR." type="text"/>
                                <button type="button" onclick="abrirModalBuscar()" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 border-y border-gray-300 flex items-center">
                                    <i class="bi bi-search"></i>
                                </button>
                                <button type="button" id="btn_nuevo_origen" class="bg-primary-blue hover:bg-blue-700 text-white px-4 rounded-r-md transition-colors">
                                    <span class="text-xl leading-none">+</span>
                                </button>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Fecha de Recepción</label>
                            <input class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm" type="date" value="2026-02-23"/>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Sector Territorial</label>
                            <select id="Sector" onchange="actualizarFeedback()" class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm">
                                <option value="">SELECCIONE SECTOR...</option>
                            </select>
                        </div>

                        <div class="md:col-span-4">
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Detalle del Ingreso</label>
                            <textarea class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm" placeholder="ESCRIBA EL CONTENIDO O DETALLE AQUÍ..." rows="4"></textarea>
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-800 mb-8 pb-2 border-b">2. Adjuntos y Referencias</h2>
                    <div class="space-y-6">
                        
                        <div>
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Documento Principal (PDF)</label>
                            <div class="flex h-[38px]">
                                <input class="flex-grow border-gray-300 rounded-l-md text-sm bg-gray-50 border-dashed italic" readonly placeholder="SELECCIONAR ARCHIVO PDF..." type="text"/>
                                <button type="button" class="bg-primary-blue hover:bg-blue-700 text-white px-6 rounded-r-md font-bold text-[10px] tracking-widest uppercase">
                                    CARGAR
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Anexos (Opcional)</label>
                            <div class="flex h-[38px]">
                                <input class="flex-grow border-gray-300 rounded-l-md text-sm bg-gray-50 border-dashed italic" readonly placeholder="SELECCIONAR ANEXOS..." type="text"/>
                                <button type="button" class="bg-primary-blue hover:bg-blue-700 text-white px-6 rounded-r-md font-bold text-[10px] tracking-widest uppercase">
                                    CARGAR
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Observaciones</label>
                            <textarea class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm" placeholder="COMENTARIOS ADICIONALES..." rows="2"></textarea>
                        </div>

                        <div class="pt-4 border-t">
                            <div class="flex items-center">
                                <input type="checkbox" id="chk_geoloc" class="w-4 h-4 text-primary-blue border-gray-300 rounded focus:ring-primary-blue cursor-pointer">
                                <label for="chk_geoloc" class="ml-3 block text-[10px] font-bold label-custom uppercase tracking-wider cursor-pointer">Activar Geolocalización</label>
                            </div>
                            <div id="geolocalizacion_area" class="mt-4 hidden animate-pulse">
                                <div class="w-full h-64 bg-gray-100 rounded-lg border flex items-center justify-center label-custom italic text-sm">
                                    Mapa Territorial - Selección de Ubicación
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <aside class="space-y-6">
                <section class="bg-white rounded-lg border border-gray-200 p-8 shadow-sm text-center sticky top-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-8 border-b pb-4">Información Automática</h2>
                    <div class="mb-10">
                        <h3 class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-3">Prioridad Estimada</h3>
                        <div id="status-prioridad" class="inline-block bg-blue-50 text-blue-400 border border-blue-100 text-[10px] font-bold px-8 py-1.5 rounded-full uppercase tracking-widest transition-all">
                            Calculando...
                        </div>
                    </div>
                    <div>
                        <h3 class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Vencimiento Proyectado</h3>
                        <div id="display-vencimiento" class="text-gray-300 text-3xl font-extrabold uppercase tracking-tight transition-all">
                            Pendiente
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t">
                        <p class="text-[10px] label-custom italic">Los cálculos se basan en la prioridad del sector y tipo de requerimiento.</p>
                    </div>
                </section>
            </aside>
        </div>
    </form>
    <!-- Modal Funcionarios -->
<div class="modal fade" id="modalFuncionarios" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Funcionario Interno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="row g-2 mb-4">
                <div class="col-md-7">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>
                        <input type="text" class="form-control border-start-0" id="buscar_fnc_input"
                            placeholder="Buscar por nombre o apellido...">
                    </div>
                </div>
                <div class="col-md-5">
                    <select class="form-select form-select-sm" id="filtro_area_fnc">
                        <option value="">Todas las Áreas</option>
                        <option value="SIN_AREA">Sin Área Asignada</option>
                        <!-- Dynamic -->
                    </select>
                </div>
            </div>
            <div class="table-responsive" style="max-height: 400px;">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="lista_busqueda_fnc" class="small">
                        <!-- Populated dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Nuevo Origen Especial -->
<div class="modal fade" id="modalNuevoOrigenEspecial" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Agregar Origen Especial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-0">
                    <label for="textoNuevoOrigenEspecial" class="form-label small fw-bold">Nuevo Origen
                        Especial</label>
                    <input type="text" class="form-control form-control-sm" id="textoNuevoOrigenEspecial"
                        placeholder="Escriba aquí el origen especial...">
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-link text-muted text-decoration-none small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark btn-sm px-4"
                    onclick="guardarOrigenEspecial()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buscar Contribuyente -->
<div class="modal fade" id="modalBuscarContribuyente" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Contribuyente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <input type="text" class="form-control form-control-sm me-2" id="filtroContribuyente"
                        placeholder="Filtrar por RUT o nombre...">
                    <button type="button" class="btn btn-sm btn-dark" onclick="abrirModalNuevoContribuyente()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Nuevo
                    </button>
                </div>
                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>RUT</th>
                                <th>Nombre Completo</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_contrib" class="small">
                            <!-- Populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Contribuyente -->
<div class="modal fade" id="modalNuevoContribuyente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Nuevo Contribuyente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form_nuevo_contribuyente">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nc_rut" class="form-label small fw-bold">RUT <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nc_rut" required
                                placeholder="12345678-9">
                        </div>
                        <div class="col-12">
                            <label for="nc_nombre" class="form-label small fw-bold">Nombre <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nc_nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nc_paterno" class="form-label small fw-bold">Apellido Paterno</label>
                            <input type="text" class="form-control form-control-sm" id="nc_paterno">
                        </div>
                        <div class="col-md-6">
                            <label for="nc_materno" class="form-label small fw-bold">Apellido Materno <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nc_materno" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-link text-muted text-decoration-none small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark btn-sm px-4"
                    onclick="guardarNuevoContribuyente()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buscar Organización -->
<div class="modal fade" id="modalBuscarOrganizacion" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Organización</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <input type="text" class="form-control form-control-sm me-2" id="filtroOrganizacion"
                        placeholder="Filtrar por nombre o RUT...">
                    <button type="button" class="btn btn-sm btn-dark" onclick="abrirModalNuevaOrganizacion()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Nuevo
                    </button>
                </div>
                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>RUT</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_org" class="small">
                            <!-- Populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nueva Organización (Comunitaria) -->
<div class="modal fade" id="modalNuevaOrganizacion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Nueva Organización</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form_nueva_organizacion">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="orgc_rut" class="form-label small fw-bold">RUT</label>
                            <input type="text" class="form-control form-control-sm" id="orgc_rut" placeholder="12.345.678-9">
                        </div>
                        <div class="col-12">
                            <label for="orgc_nombre" class="form-label small fw-bold">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="orgc_nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="orgc_codigo" class="form-label small fw-bold">Código</label>
                            <input type="text" class="form-control form-control-sm" id="orgc_codigo">
                        </div>
                        <div class="col-md-6">
                            <label for="orgc_rpj" class="form-label small fw-bold">RPJ</label>
                            <input type="text" class="form-control form-control-sm" id="orgc_rpj">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-link text-muted text-decoration-none small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark btn-sm px-4"
                    onclick="guardarNuevaOrganizacion()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Reingreso Modal -->
<div class="modal fade" id="modalReingreso" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Solicitud para Reingreso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <input type="text" class="form-control form-control-sm" id="filtroReingreso"
                        placeholder="Buscar por código DESVE o nombre de expediente...">
                </div>
                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>Código DESVE</th>
                                <th>Expediente</th>
                                <th>Fecha</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_reingreso" class="small">
                            <!-- Populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<script>
    // Mostrar/Ocultar Geolocalización
    document.getElementById('chk_geoloc').addEventListener('change', function() {
        const area = document.getElementById('geolocalizacion_area');
        area.classList.toggle('hidden', !this.checked);
    });

    // Feedback visual para el Sidebar
    function actualizarFeedback() {
        const vencimiento = document.getElementById('display-vencimiento');
        const prioridad = document.getElementById('status-prioridad');
        
        // Simulación de cálculo al seleccionar sector
        vencimiento.innerHTML = "15 MARZO 2026";
        vencimiento.classList.remove('text-gray-300');
        vencimiento.classList.add('text-primary-blue', 'update-flash');
        
        prioridad.innerHTML = "PRIORIDAD ALTA";
        prioridad.classList.replace('bg-blue-50', 'bg-red-50');
        prioridad.classList.replace('text-blue-400', 'text-red-500');
        prioridad.classList.add('update-flash');

        // Quitar clases de animación después de que ocurra
        setTimeout(() => {
            vencimiento.classList.remove('update-flash');
            prioridad.classList.remove('update-flash');
        }, 1000);
    }

    // Funciones placeholders para modales (se deben conectar con tu backend)
    function abrirModalReingreso() { console.log("Buscando solicitudes previas..."); }
    function abrirModalBuscar() { console.log("Buscando organizaciones..."); }

</script>
<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    if (window.feather) feather.replace();
</script>

<script src="../../recursos/js/funcionarios/desve/desve_nuevo.js"></script

</body>
</html>


<?php include '../../api/footer.php'; ?>