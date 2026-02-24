<?php
$pageTitle = "DESVE";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Crear Nueva Solicitud DESVE</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary-blue: #0071bc;
            --custom-text: #857F7E;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-primary-blue {
            background-color: var(--primary-blue);
        }

        .text-primary-blue {
            color: var(--primary-blue);
        }

        .label-custom {
            color: var(--custom-text) !important;
            font-weight: 700;
        }

        .input-readonly-dashed {
            background-color: #f9fafb !important;
            border-style: dashed !important;
            border-width: 1.5px !important;
        }

        .update-flash {
            animation: pulse-blue 0.8s ease-in-out;
        }

        @keyframes pulse-blue {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
                color: #0071bc;
            }

            100% {
                transform: scale(1);
            }
        }

        /* Estilos para el dropzone */
        .drop-zone {
            border: 2px dashed #e2e8f0;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .drop-zone:hover {
            border-color: var(--primary-blue);
            background-color: #f0f9ff;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    <main class="max-w-7xl mx-auto px-4 py-8">
        <form id="form_nuevo_desve">

            <!-- Header fijo -->
            <section
                class="bg-white rounded-lg border border-gray-200 p-8 mb-8 flex justify-between items-center shadow-md sticky top-0 z-20">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Crear Nueva Solicitud DESVE</h1>
                    <p class="text-gray-500 mt-1">Complete los campos para ingresar un nuevo requerimiento al
                        departamento de desarrollo vecinal</p>
                </div>
                <div class="flex items-center space-x-6">
                    <a class="text-primary-blue font-semibold hover:underline transition-all text-sm"
                        href="index.php">Cancelar</a>
                    <button type="submit"
                        class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded shadow-sm transition-colors text-sm uppercase tracking-wide">
                        Guardar Solicitud
                    </button>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">

                    <!-- Sección 1: Información -->
                    <section class="bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
                        <h2 class="text-xl font-bold text-gray-800 mb-8 pb-2 border-b">1. Información de la Solicitud
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                            <div class="md:col-span-3">
                                <label
                                    class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Nombre
                                    del Expediente</label>
                                <input
                                    class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm"
                                    id="NombreExpediente" placeholder="Ej: Consulta por Luminaria" type="text"
                                    required />
                            </div>

                            <div class="md:col-span-1">
                                <label
                                    class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Código
                                    DESVE</label>
                                <input
                                    class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm text-center font-bold text-primary-blue bg-blue-50"
                                    type="text" id="Codigo_DESVE" placeholder="123" />
                            </div>

                            <div class="md:col-span-4">
                                <label
                                    class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Reingreso</label>
                                <div class="flex shadow-sm h-[38px]">
                                    <input
                                        class="flex-grow border-gray-300 rounded-l-md focus:ring-primary-blue focus:border-primary-blue text-sm italic input-readonly-dashed"
                                        id="ReingresoDisplay" readonly placeholder="Seleccione solicitud previa..."
                                        type="text" />
                                    <input type="hidden" id="Reingreso" value="">
                                    <button type="button" onclick="abrirModalReingreso()"
                                        class="bg-slate-600 hover:bg-slate-700 text-white px-4 rounded-r-md transition-colors flex items-center">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Tipo
                                    de Solicitante</label>
                                <select id="ID_Organizacion"
                                    class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm"
                                    required>
                                    <option value="" disabled selected>Seleccione tipo...</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Origen
                                    de Solicitud</label>
                                <div class="flex shadow-sm h-[38px]">
                                    <input
                                        class="flex-grow border-gray-300 rounded-l-md focus:ring-primary-blue focus:border-primary-blue text-sm input-readonly-dashed"
                                        id="OrigenSolicitudDisplay" readonly placeholder="Seleccione organización..."
                                        type="text" />
                                    <input type="hidden" id="OrigenSolicitud" required>
                                    <button type="button" onclick="abrirModalBuscarOrganizacion()"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 border-y border-gray-300 flex items-center"
                                        id=btn_buscar_origen>
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <!-- <button type="button" id="btn_nuevo_origen"
                                        class="bg-primary-blue hover:bg-blue-700 text-white px-4 rounded-r-md transition-colors">
                                        <span class="text-xl leading-none">+</span>
                                    </button> -->
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Fecha
                                    de Recepción</label>
                                <input
                                    class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm"
                                    id="FechaUltimaRecepcion" type="date" required />
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Sector</label>
                                <select id="Sector"
                                    class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm"
                                    required>
                                </select>
                            </div>

                            <div class="md:col-span-4">
                                <label
                                    class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Detalle
                                    del Ingreso</label>
                                <textarea id="DetalleIngreso"
                                    class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm"
                                    placeholder="Escriba el detalle aquí..." rows="4"></textarea>
                            </div>

                            <div class="md:col-span-4">
                                <label
                                    class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Observaciones</label>
                                <textarea id="Observaciones"
                                    class="w-full border-gray-300 rounded-md focus:ring-primary-blue focus:border-primary-blue text-sm"
                                    placeholder="Comentarios adicionales..." rows="2"></textarea>
                            </div>
                        </div>
                    </section>

                    <!-- Sección: Geolocalización Real -->
                    <section class="bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-8 pb-2 border-b">
                            <h2 class="text-xl font-bold text-gray-800">2. Geolocalización</h2>
                            <div class="flex items-center">
                                <input type="checkbox" id="chk_geoloc"
                                    class="w-4 h-4 text-primary-blue border-gray-300 rounded focus:ring-primary-blue cursor-pointer">
                                <label for="chk_geoloc"
                                    class="ml-3 block text-[10px] font-bold label-custom uppercase tracking-wider cursor-pointer">Activar
                                    Mapa</label>
                            </div>
                        </div>

                        <div id="geolocalizacion_area" class="space-y-6 hidden">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="md:col-span-2">
                                    <label
                                        class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Dirección</label>
                                    <div class="flex shadow-sm h-[38px]">
                                        <input type="text" class="flex-grow border-gray-300 rounded-l-md text-sm"
                                            id="Geo_dir" placeholder="Calle, número">
                                        <button type="button" id="btn_buscar_geo"
                                            class="bg-slate-600 hover:bg-slate-700 text-white px-4 rounded-r-md">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="md:col-span-1">
                                    <label
                                        class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Latitud</label>
                                    <input type="text" id="Latitud"
                                        class="w-full border-gray-300 rounded-md text-sm bg-gray-50 input-readonly-dashed"
                                        placeholder="-33.024..." readonly>
                                </div>
                                <div class="md:col-span-1">
                                    <label
                                        class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Longitud</label>
                                    <input type="text" id="Longitud"
                                        class="w-full border-gray-300 rounded-md text-sm bg-gray-50 input-readonly-dashed"
                                        placeholder="-71.557..." readonly>
                                </div>
                            </div>
                            <div id="map_desve" style="height: 350px; width: 100%; border-radius: 8px;"
                                class="border border-gray-200"></div>
                            <p class="text-[10px] label-custom italic">Puede buscar una dirección o hacer clic
                                directamente en el mapa para posicionar el marcador.</p>
                        </div>
                    </section>

                    <!-- Sección: Destinatarios -->
                    <section class="bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
                        <div class="flex justify-between items-center mb-8 pb-2 border-b">
                            <h2 class="text-xl font-bold text-gray-800">3. Destinatarios</h2>
                            <button type="button" onclick="abrirModalBuscarFuncionario()"
                                class="bg-slate-700 hover:bg-slate-800 text-white px-4 py-2 rounded text-xs font-bold uppercase tracking-wider transition-colors">
                                <i class="bi bi-person-plus me-2"></i> Buscar Funcionario
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm" id="tabla_destinos">
                                <thead class="bg-gray-50 text-[10px] font-bold label-custom uppercase tracking-wider">
                                    <tr>
                                        <th class="px-4 py-3 border-b">Funcionario</th>
                                        <th class="px-4 py-3 border-b text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_destinos" class="divide-y divide-gray-100">
                                    <tr id="placeholder_destinos">
                                        <td colspan="2" class="px-4 py-8 text-center text-gray-400 italic">No hay
                                            destinatarios agregados.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                <!-- Sidebar -->
                <aside class="space-y-6">
                    <!-- Información Automática -->
                    <section class="bg-white rounded-lg border border-gray-200 p-8 shadow-sm text-center sticky top-24">
                        <h2 class="text-xl font-bold text-gray-800 mb-8 border-b pb-4">Información Automática</h2>
                        <div class="mb-10 text-left">
                            <label
                                class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Prioridad
                                Estimada</label>
                            <input type="text" id="Prioridad"
                                class="w-full border-gray-300 rounded-md text-sm bg-gray-50 font-bold text-primary-blue text-center"
                                value="Calculando..." readonly>
                        </div>
                        <div class="text-left">
                            <label
                                class="block text-[10px] font-bold label-custom uppercase mb-2 tracking-wider">Vencimiento
                                Proyectado</label>
                            <input type="text" id="FechaVecimiento"
                                class="w-full border-gray-300 rounded-md text-sm bg-gray-50 font-bold text-gray-800 text-center"
                                value="Pendiente" readonly>
                        </div>

                    </section>

                    <!-- Adjuntos -->
                    <section class="bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-4">Documentos Adjuntos</h2>
                        <div class="drop-zone" id="drop_zone">
                            <input type="file" id="inputArchivosSolicitud" hidden multiple>
                            <div class="text-gray-400">
                                <i class="bi bi-cloud-arrow-up text-3xl mb-2"></i>
                                <p class="text-xs font-medium">Arrastre archivos o haga clic aquí</p>
                            </div>
                        </div>
                        <div id="listaArchivosSolicitud" class="mt-4 space-y-2">
                            <!-- Archivos dinámicos -->
                        </div>
                    </section>
                </aside>
            </div>
        </form>
    </main>

    <!-- Modales -->


    <!-- Si no están en un archivo aparte, incluirlos directamente del original -->
    <div class="modal fade" id="modalFuncionarios" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold fs-6">Buscar Funcionario Interno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="row g-2 p-3">
                    <div class="col-md-7">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="buscar_fnc_input"
                                placeholder="Buscar por nombre o apellido...">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <select class="form-select form-select-sm" id="filtro_area_fnc">
                            <option value="">Todas las Áreas</option>
                            <option value="SIN_AREA">Sin Área Asignada</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive p-3" style="max-height: 400px;">
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
                        <tbody id="lista_busqueda_fnc" class="small"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalReingreso" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold fs-6">Buscar Solicitud para Reingreso</h5><button type="button"
                        class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="text" class="form-control form-control-sm mb-3" id="filtroReingreso"
                        placeholder="Buscar por código DESVE o nombre de expediente...">
                    <div class="table-responsive" style="max-height: 400px;">
                        <table class="table table-hover align-middle">
                            <thead class="table-light text-uppercase small">
                                <tr>
                                    <th>Código</th>
                                    <th>Expediente</th>
                                    <th>Fecha</th>
                                    <th class="text-end">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="lista_busqueda_reingreso" class="small"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBuscarOrganizacion" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold fs-6">Buscar Organización</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="d-flex mb-3"><input type="text" class="form-control form-control-sm me-2"
                            id="filtroOrganizacion" placeholder="Filtrar por nombre o RUT..."><button type="button"
                            class="btn btn-sm btn-dark" onclick="abrirModalNuevaOrganizacion()">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button></div>
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
                            <tbody id="lista_busqueda_org" class="small"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nueva Organización -->
    <div class="modal fade" id="modalNuevaOrganizacion" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold fs-6">Nueva Organización</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="form_nueva_organizacion">
                        <div class="row g-3">
                            <div class="col-12"><label class="form-label small fw-bold">RUT *</label><input type="text"
                                    class="form-control" id="orgc_rut" required></div>
                            <div class="col-12"><label class="form-label small fw-bold">Nombre *</label><input
                                    type="text" class="form-control" id="orgc_nombre" required></div>
                            <div class="col-6"><label class="form-label small fw-bold">Código</label><input type="text"
                                    class="form-control" id="orgc_codigo"></div>
                            <div class="col-6"><label class="form-label small fw-bold">RPJ</label><input type="text"
                                    class="form-control" id="orgc_rpj"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0"><button type="button" class="btn btn-dark btn-sm px-4"
                        onclick="guardarNuevaOrganizacion()">Guardar</button></div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../../recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>if (window.feather) feather.replace();</script>

    <script>
        // Toggle Geolocalización
        document.getElementById('chk_geoloc').addEventListener('change', function () {
            document.getElementById('geolocalizacion_area').classList.toggle('hidden', !this.checked);
            if (this.checked && typeof initMap === 'function') {
                // Re-inicializar mapa si es necesario al mostrar
                setTimeout(() => { if (window.map) google.maps.event.trigger(window.map, 'resize'); }, 100);
            }
        });
    </script>

    <script src="../../recursos/js/funcionarios/desve/nuevo.js"></script>

    <?php
    use App\Config\AppConfig;
    $googleMapsKey = AppConfig::getGoogleMapsKey();
    ?>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&libraries=places&callback=initMap"
        async defer></script>

</body>

</html>

<?php include '../../api/general/footer.php'; ?>