<?php
$pageTitle = "Bandeja de Entrada";
require_once '../api/general/auth_check.php';
include '../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

<script id="tailwind-config">
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "primary-blue": "#1a5f9c",
                    "gob-warning": "#f59e0b",
                    "gob-success": "#10b981",
                },
                fontFamily: { "sans": ["Inter", "sans-serif"] }
            }
        }
    }
</script>

<style>
    body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
    
    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal; font-style: normal; line-height: 1;
        display: inline-block; white-space: nowrap; word-wrap: normal;
        direction: ltr; -webkit-font-smoothing: antialiased;
        vertical-align: middle;
    }

    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col lg:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Bienvenido <?php echo $_SESSION['nombre']; ?></h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium">Aquí puedes encontrar todas tus tareas y solicitudes pendientes.</p>
        </div>
        
        <div class="flex flex-row gap-3 w-full lg:w-auto justify-center lg:justify-end">
            <button type="button" onclick="abrirModalCrearTarea()"
                class="flex-1 lg:flex-none whitespace-nowrap bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">add_circle</span> NUEVA TAREA
            </button>
            <button type="button" onclick="window.location.href = 'bandeja_historial.php'"
                class="flex-1 lg:flex-none whitespace-nowrap bg-slate-700 hover:bg-slate-800 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg transition-all text-sm uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">history</span> HISTORIAL
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue flex items-center gap-4">
            <div class="rounded-full bg-blue-50 p-4 text-primary-blue">
                <span class="material-symbols-outlined text-3xl">check_circle</span>
            </div>
            <div>
                <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Tareas Pendientes</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="totalTareas">...</h3>
            </div>
        </div>
        
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-warning flex items-center gap-4" title="Tareas con fecha 3 días atrás o más">
            <div class="rounded-full bg-amber-50 p-4 text-gob-warning">
                <span class="material-symbols-outlined text-3xl">warning</span>
            </div>
            <div>
                <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Tareas Atrasadas</p>
                <h3 class="text-3xl font-extrabold text-gob-warning mb-0" id="totalTareasAtrasadas">...</h3>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-white flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">list_alt</span>
                <h3 class="font-bold text-slate-700">Listado de Tareas Pendientes</h3>
            </div>
            <span class="text-xs font-semibold text-slate-400">Mostrando tareas actuales</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="tablaBandeja">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">Asunto / Título</th>
                        <th class="px-6 py-4">Origen</th>
                        <th class="px-6 py-4">Responsable</th>
                        <th class="px-6 py-4 text-center">Fecha</th>
                        <th class="px-6 py-4 text-center">Fecha límite</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[15px] text-slate-700" id="table-body">
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400 italic">Cargando tareas...</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-slate-50/50 flex justify-end gap-2 border-t border-slate-100">
            <button class="flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all" id="btnAnterior" disabled>
                <span class="material-symbols-outlined text-sm">chevron_left</span> Anterior
            </button>
            <button class="flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all" id="btnSiguiente">
                Siguiente <span class="material-symbols-outlined text-sm">chevron_right</span>
            </button>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-white flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">assignment_turned_in</span>
                <h3 class="font-bold text-slate-700">Listado de Tareas Asignadas por mí</h3>
            </div>
            <div class="text-xs font-semibold text-slate-400" id="paginationInfoTareasQueAsigne"></div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="tablaTareasQueAsigne">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">Asunto / Título</th>
                        <th class="px-6 py-4">Responsable</th>
                        <th class="px-6 py-4 text-center">Fecha</th>
                        <th class="px-6 py-4 text-center">Fecha límite</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[15px] text-slate-700">
                    </tbody>
            </table>
        </div>
        <div class="p-4 bg-slate-50/50 flex justify-end gap-2 border-t border-slate-100">
            <button class="flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all" id="btnAnteriorAsigne" disabled>
                <span class="material-symbols-outlined text-sm">chevron_left</span> Anterior
            </button>
            <button class="flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all" id="btnSiguienteAsigne">
                Siguiente <span class="material-symbols-outlined text-sm">chevron_right</span>
            </button>
        </div>
    </div>

</div>

<!--<div class="container-fluid py-4">-->

    <!-- Actions Card -->
    <!--<div class="card shadow-sm border-0 mb-4 bg-white" style="border-radius: 10px;">-->
        <!--<div class="card-body p-3">-->
            <!-- Header -->
            <!--<div class="main-header mb-4" style="display: flex; justify-content: space-between;">-->
                <!--<div class="header-title">-->
                    <!--<h2 class="fw-bold fs-4">Bienvenido <?php echo $_SESSION['nombre']; ?></h2>
                    <p class="text-muted mb-0">Aquí puedes encontrar todas tus tareas y solicitudes pendientes</p>
                </div>
                <div class="row g-2 justify-content-md-end text-end">
                    <div class="col-12 col-md-auto">
                        <button class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="abrirModalCrearTarea()">
                            <i data-feather="plus" class="me-2"></i>
                            Nueva Tarea
                        </button>
                    </div>
                    <div class="col-12 col-md-auto">
                        <button class="btn btn-toolbar btn-dark w-100 shadow-sm"
                            onclick="window.location.href = 'bandeja_historial.php'">
                            <i data-feather="clock" class="me-2"></i>
                            Historial
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm border-0 mb-4 bg-white" style="border-radius: 10px;"></div>-->
    <!-- KPI Metrics (Standardized) -->
    <!--<div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 border-start border-4 border-primary h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-4">
                        <i data-feather="check-circle" class="text-primary" style="width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Tareas Pendientes</h6>
                        <h2 class="fw-bold mb-0" id="totalTareas">...</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 border-start border-4 border-warning h-100"
                title="Tareas con fecha 3 días atrás o más">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-4">
                        <i data-feather="alert-triangle" class="text-warning" style="width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Tareas Atrasadas</h6>
                        <h2 class="fw-bold mb-0 text-warning" id="totalTareasAtrasadas">...</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

    <!-- Tasks Table Layer -->
    <!--<div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Tareas Pendientes</h5>
                <div class="pagination-info text-muted small">Mostrando tareas actuales</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaBandeja">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Asunto / Título</th>
                            <th>Origen</th>
                            <th>Responsable</th>
                            <th>Fecha</th>
                            <th>Fecha limite</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody class="small" id="table-body">-->
                        <!-- Data loaded dynamically by bandeja.js -->
                        <!--<tr>
                            <td colspan="6" class="text-center py-5 text-muted">Cargando tareas...</td>
                        </tr>
                    </tbody>
                </table>
            </div>-->

            <!-- Pagination controls -->
            <!--<div class="d-flex justify-content-end gap-2 mt-4">
                <button class="btn btn-sm btn-outline-secondary px-4 shadow-sm" id="btnAnterior" disabled>
                    <i data-feather="chevron-left" class="me-1"></i> Anterior
                </button>
                <button class="btn btn-sm btn-outline-secondary px-4 shadow-sm" id="btnSiguiente">
                    Siguiente <i data-feather="chevron-right" class="ms-1"></i>
                </button>
</div>
        </div>
    </div>-->

    <!-- Tareas Assigned by me Table Layer -->
    <!--<div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Tareas Asignadas por mí</h5>
                <div class="pagination-info text-muted small" id="paginationInfoTareasQueAsigne"></div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaTareasQueAsigne">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Asunto / Título</th>
                            <th>Responsable</th>
                            <th>Fecha</th>
                            <th>Fecha limite</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody class="small">-->
                        <!-- Data loaded dynamically by bandeja.js -->
                    <!--</tbody>
                </table>
            </div>-->

            <!-- Pagination controls -->
            <!--<div class="d-flex justify-content-end gap-2 mt-4">
                <button class="btn btn-sm btn-outline-secondary px-4 shadow-sm" id="btnAnteriorAsigne" disabled>
                    <i data-feather="chevron-left" class="me-1"></i> Anterior
                </button>
                <button class="btn btn-sm btn-outline-secondary px-4 shadow-sm" id="btnSiguienteAsigne">
                    Siguiente <i data-feather="chevron-right" class="ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>-->


<!-- Modal Crear tarea -->
<!--<div class="modal fade" id="modalCrearTarea" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Crear Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-crear-tarea">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="titulo" class="form-label small fw-bold">Asunto <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="tar_titulo" class="form-control" id="titulo" required
                                placeholder="Título descriptivo">
                        </div>
                        <div class="col-12">
                            <label for="detalle" class="form-label small fw-bold">Descripción <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="tar_detalle" id="detalle" rows="3" required
                                placeholder="Detalle de la tarea"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="tar_plazo" class="form-label small fw-bold">Fecha Límite <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="tar_plazo" class="form-control" id="tar_plazo" required>
                        </div>
                        <div class="col-md-6">
                            <label for="responsable" class="form-label small fw-bold">Responsable <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="responsable" id="responsable" required
                                    disabled placeholder="No asignado">
                                <button type="button" class="btn btn-dark" onclick="abrirModalBuscarFuncionario()">
                                    <i data-feather="search" style="width: 16px; height: 16px;"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control" name="asignador" id="asignador" required hidden>
                            <input type="text" class="form-control" name="usr_id" id="usr_id" required hidden>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-link text-decoration-none text-muted small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark px-4 shadow-sm" id="btnGuardarTarea"
                    onclick="guardarTarea()">Guardar Tarea</button>
            </div>
        </div>
    </div>
</div>-->

<!-- Modal Buscar Funcionario -->
<!--<div class="modal fade" id="modalBusquedaFuncionario" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Funcionario Destino</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="input-group mb-4 shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i data-feather="search" class="text-muted" style="width: 16px; height: 16px;"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="buscar_fnc_input"
                        placeholder="Buscar por nombre o apellido...">
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase small sticky-top">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_fnc" class="small">-->
                            <!-- Dynamic -->
                        <!--</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>-->

<!--Modal Crear Tarea-->
<div class="modal fade" id="modalCrearTarea" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="bg-slate-50 p-6 border-b border-slate-100">
                <h5 class="font-extrabold text-slate-800 text-sm uppercase tracking-widest">Crear Tarea</h5>
            </div>
            <div class="p-6">
                <form id="form-crear-tarea">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2 space-y-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Asunto <span class="text-rose-500">*</span></label>
                            <input type="text" name="tar_titulo" id="titulo" required placeholder="Título descriptivo"
                                class="w-full rounded-xl border-slate-200 focus:ring-primary-blue text-sm p-3">
                        </div>
                        <div class="md:col-span-2 space-y-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Descripción <span class="text-rose-500">*</span></label>
                            <textarea name="tar_detalle" id="detalle" rows="3" required placeholder="Detalle de la tarea"
                                class="w-full rounded-xl border-slate-200 focus:ring-primary-blue text-sm p-3"></textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Fecha Límite <span class="text-rose-500">*</span></label>
                            <input type="datetime-local" name="tar_plazo" id="tar_plazo" required
                                class="w-full rounded-xl border-slate-200 focus:ring-primary-blue text-sm p-3">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Responsable <span class="text-rose-500">*</span></label>
                            <div class="flex gap-2">
                                <input type="text" name="responsable" id="responsable" required disabled placeholder="No asignado"
                                    class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm p-3">
                                <button type="button" class="bg-slate-800 text-white p-3 rounded-xl flex items-center" onclick="abrirModalBuscarFuncionario()">
                                    <span class="material-symbols-outlined">search</span>
                                </button>
                            </div>
                            <input type="text" name="asignador" id="asignador" required hidden>
                            <input type="text" name="usr_id" id="usr_id" required hidden>
                        </div>
                    </div>
                </form>
            </div>
            <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" class="text-slate-400 font-bold text-xs uppercase" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="bg-primary-blue text-white font-bold py-2.5 px-6 rounded-xl text-xs uppercase shadow-lg" onclick="guardarTarea()">Guardar Tarea</button>
            </div>
        </div>
    </div>
</div>

<!--Modal Buscar Funcionario--> 
<div class="modal fade" id="modalBusquedaFuncionario" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-50 border-b p-6">
                <h5 class="modal-title font-extrabold text-slate-800 text-sm uppercase tracking-widest">Buscar Funcionario Destino</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="p-6">
                <div class="flex gap-2 mb-6">
                    <span class="material-symbols-outlined text-slate-400 translate-y-2">search</span>
                    <input type="text" class="w-full rounded-xl border-slate-200 focus:ring-primary-blue text-sm p-3" id="buscar_fnc_input" placeholder="Buscar por nombre o apellido...">
                </div>
                <div class="table-responsive max-h-[400px] rounded-xl border border-slate-100">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="text-end px-4 py-3">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_fnc" class="text-[13px] text-slate-600 italic"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="../recursos/js/funcionarios/NO_Asignadas/bandeja.js"></script>

<?php include '../api/general/footer.php'; ?>