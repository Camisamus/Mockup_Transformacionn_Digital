<?php
$pageTitle = "Consulta OIRS";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';


// --- Server-Side Data Fetching ---
use App\Controllers\OIRS_TipoAtencionController;
use App\Controllers\OIRS_CondicionController;
use App\Controllers\OIRS_TematicaController;
use App\Controllers\OIRS_SubtematicaController;
use App\Controllers\SectorController;
use App\Controllers\EscolaridadController;
use App\Controllers\FuncionarioController;
use App\Controllers\OirsSolicitudController;

// 1. Init Controllers
$tipoAtencionCtrl = new OIRS_TipoAtencionController($db);
$condicionCtrl = new OIRS_CondicionController($db);
$tematicaCtrl = new OIRS_TematicaController($db);
$subtematicaCtrl = new OIRS_SubtematicaController($db);
$sectorCtrl = new SectorController($db);
$escolaridadCtrl = new EscolaridadController($db);
$funcionarioCtrl = new FuncionarioController($db);
$solicitudCtrl = new OirsSolicitudController($db);

// 2. Fetch Lists
$tiposAtencion = $tipoAtencionCtrl->getAll()['data'] ?? [];
$condiciones = $condicionCtrl->getAll()['data'] ?? [];
$tematicas = $tematicaCtrl->getAll()['data'] ?? [];
$subtematicas = $subtematicaCtrl->getAll()['data'] ?? [];
$sectores = $sectorCtrl->getAll()['data'] ?? [];
$escolaridades = $escolaridadCtrl->getAll()['data'] ?? [];
// Ahora traemos Cargos en lugar de Funcionarios para la bandeja de asignación
$cargosOirs = $funcionarioCtrl->getAllCargosOIRS()['data'] ?? [];
$misCargos = $funcionarioCtrl->getMisCargosOIRS();
$misCargosIds = array_column($misCargos, 'car_id');

// 3. Process Areas and Auth
$areasUnicas = [];
foreach ($cargosOirs as $c) {
    if (!empty($c['area_id']) && !empty($c['area_nombre'])) {
        $areasUnicas[$c['area_id']] = $c['area_nombre'];
    }
}
$userOirsInfo = $funcionarioCtrl->esOIRS();
$esOirsArea = ($userOirsInfo && $userOirsInfo['Area'] === 'OIRS');
$userAreaId = $userOirsInfo['tga_id'] ?? '';

$solicitudData = null;
if (isset($_GET['id'])) {
    $res = $solicitudCtrl->getById($_GET['id']);
    if (isset($res['status']) && $res['status'] === 'success') {
        $solicitudData = $res['data'];
    }
}

if($_GET['debug']==1){
    print_r($solicitudData);

    echo "------<br><br>";
    print_r($userOirsInfo);

    echo "------<br><br>";
    echo "Es Area<br>";


    print_r($esOirsArea);
}


// Usamos (int) para asegurarnos de que la comparación sea numérica

// Si requiere respuesta técnica 

$respuestaTecnica=0;

$esTecnica = ((int)$solicitudData['gestion']['oig_requiere_respuesta_tecnica'] === 1);

if ($esTecnica) {
    // Aquí tu lógica cuando requiere respuesta técnica
    $respuestaTecnica=1;
}

$esAreaValida = 0; // Verificar si eres OIRS o eres un Asignado 

// Son Encargado OIRS lo que estàn mirando.... 
if (isset($userOirsInfo['tga_id']) && $userOirsInfo['tga_id'] == 2) {
    // El area 2 es de OIRS y puede asignar 
    $esAreaValida = 1;
} 

// Yo puedo asignar (Si o No)
$yo = $_SESSION['user_id'];

// Extraemos solo los IDs de los CARGOS asignados
$asignadosCargosIds = array_column($solicitudData['asignaciones'] ?? [], 'oia_asignacion');

// Validamos si alguno de tus cargos actuales está en las asignaciones de la OIRS
$intersect = array_intersect($misCargosIds, $asignadosCargosIds);
if (!empty($intersect)) {
    // ESTÁS ASIGNADO VIA CARGO
    $esAreaValida = 1;
} 


/* si es administrador puede asignar porque si */ 


$mostrarAsignacion=0;

if($respuestaTecnica==1 && $esAreaValida==1){
    $mostrarAsignacion=1;
}


/* esta oirs esta cerrada, nadie puede asginar más... . */ 

// Lógica para Respuesta Preliminar
$rolOIRS = $userOirsInfo['rol'] ?? '';
$puedeResponderPreliminar = (strpos(strtolower($rolOIRS), 'encargado oirs') !== false || strpos(strtolower($rolOIRS), 'administrador oirs') !== false);
$tieneRespuestaPreliminar = !empty($solicitudData['gestion']['oig_respuesta_preliminar']);

// Visibilidad del bloque "Información al Contribuyente"
$mostrarBloquePreliminar = $puedeResponderPreliminar || $tieneRespuestaPreliminar;
$soloLecturaPreliminar = !$puedeResponderPreliminar && $tieneRespuestaPreliminar;

// Lógica para Respuesta por Unidad Técnica
$puedeResponderTecnica = (strpos(strtolower($rolOIRS), 'jefe/director') !== false || strpos(strtolower($rolOIRS), 'administrador oirs') !== false);
$tieneRespuestaTecnica = !empty($solicitudData['gestion']['oig_respuesta_tecnica']);
$mostrarBloqueTecnica = $puedeResponderTecnica || $tieneRespuestaTecnica;
$soloLecturaTecnica = !$puedeResponderTecnica && $tieneRespuestaTecnica;

// Lógica para Notificación de Ejecución
$puedeNotificarEjecucion = (strpos(strtolower($rolOIRS), 'jefe/director') !== false || strpos(strtolower($rolOIRS), 'encargado temático') !== false || strpos(strtolower($rolOIRS), 'administrador oirs') !== false);
$tieneNotificacionEjecucion = !empty($solicitudData['gestion']['oig_notificacion_ejecucion']);
$mostrarBloqueEjecucion = $puedeNotificarEjecucion || $tieneNotificacionEjecucion;
$soloLecturaEjecucion = !$puedeNotificarEjecucion && $tieneNotificacionEjecucion;
?>


<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />
<script>
    let perfiles = {
        "Consulta Oirs": {
            "id": "1",
            "metrica_personal": false,
            "PrimeraRespuesta": false,
            "RespuestaTecnica": { "Solo": false, "Multiple": false },
            "Notificacion_Ejecucion": false,
            "Asignaciones": [],
            "ApruebaRespuesta": [],
            "ElementosHabilitados": [],
            "ComunicacionVecino": false,
            "cierreConversacion": false,
        },
        "Administrador Oirs": {
            "id": "2",
            "metrica_personal": true,
            "PrimeraRespuesta": true,
            "RespuestaTecnica": { "Solo": false, "Multiple": true },
            "Notificacion_Ejecucion": true,
            "Asignaciones": ["Jefe/Director"],
            "ApruebaRespuesta": [],
            "ElementosHabilitados": [],
            "ComunicacionVecino": true,
            "cierreConversacion": true,
        },
        "Encargado Oirs": {
            "id": "3",
            "metrica_personal": true,
            "PrimeraRespuesta": true,
            "RespuestaTecnica": { "Solo": false, "Multiple": false },
            "Notificacion_Ejecucion": false,
            "Asignaciones": ["Jefe/Director", "Administrador Oirs"],
            "ApruebaRespuesta": [],
            "ElementosHabilitados": [],
            "ComunicacionVecino": true,
            "cierreConversacion": false,
        },
        "Jefe/Director": {
            "id": "4",
            "metrica_personal": true,
            "PrimeraRespuesta": false,
            "RespuestaTecnica": { "Solo": true, "Multiple": false },
            "Notificacion_Ejecucion": true,
            "Asignaciones": ["Encargado Temático"],
            "ApruebaRespuesta": ["Encargado Temático"],
            "ElementosHabilitados": [],
            "ComunicacionVecino": true,
            "cierreConversacion": true,
        },
        "Encargado Temático": {
            "id": "5",
            "metrica_personal": true,
            "PrimeraRespuesta": false,
            "RespuestaTecnica": { "Solo": false, "Multiple": false },
            "Notificacion_Ejecucion": true,
            "Asignaciones": [],
            "ApruebaRespuesta": [],
            "ElementosHabilitados": [],
            "ComunicacionVecino": false,
            "cierreConversacion": false,
        },
        "Daniela(Administrador General)": {
            "id": "6",
            "metrica_personal": true,
            "PrimeraRespuesta": false,
            "RespuestaTecnica": { "Solo": false, "Multiple": false },
            "Notificacion_Ejecucion": false,
            "Asignaciones": [],
            "ApruebaRespuesta": [],
            "ElementosHabilitados": [],
            "ComunicacionVecino": false,
            "cierreConversacion": false,
        },
    }
</script>

<script id="tailwind-config">
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "primary-blue": "#1a5f9c",
                    "gob-warning": "#f59e0b",
                    "gob-success": "#10b981",
                    "cyan-border": "#E0FFFF",
                    "gray-info": "#D3D3D3",
                    "soft-cyan": "#F0FFFF"
                },
                fontFamily: { "sans": ["Inter", "sans-serif"] }
            }
        }
    }
</script>


<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }

    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        vertical-align: middle;
        line-height: 1;
    }

    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Estilo de la barra de pestañas completa */
    #oirsTabs {
        background-color: white;
        border-radius: 9999px;
        /* Borde totalmente redondeado */
        padding: 5px;
        border: 1px solid #e2e8f0;
        /* Borde sutil del contenedor */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        display: inline-flex;
        /* Para que no ocupe todo el ancho si no es necesario */
    }

    #oirsTabs .nav-item {
        margin-right: 0;
        /* Elimina la separación entre botones */
    }

    #oirsTabs .nav-link {
        border: none !important;
        color: #1a5f9c;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 25px;
        border-radius: 9999px;
        /* Redondeado individual */
        transition: all 0.3s ease;
        background: transparent;
    }

    #oirsTabs .nav-link.active {
        background-color: #1a5f9c !important;
        /* Color azul de tu sistema */
        color: white !important;
        box-shadow: 0 4px 6px -1px rgba(26, 95, 156, 0.4);
    }

    #oirsTabs .nav-link:hover:not(.active) {
        background-color: #f1f5f9;
    }

    .label-custom {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div
        class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Consulta de Solicitud OIRS
            </h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider">Folio:
                <?= $solicitudData['oirs_folio'] ?? '---' ?>
            </p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" onclick="location.href='index.php'"
                class="bg-slate-800 hover:bg-black text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">grid_view</span> Bandeja OIRS
            </button>
        </div>
    </div>

    <div class="flex justify-start mb-6">
        <ul class="nav nav-tabs border-bottom-0" id="oirsTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#tab-detalle">Detalle de la OIRS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-contribuyente">Datos del Contribuyente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-asignacion">Asignación</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-adjuntos-muni">Adjuntos Municipio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-historial">Historial</a>
            </li>
        </ul>
    </div>

    <div class="tab-content pt-4">
        <!--PEstaña Detalle de la OIRS-->
        <div class="tab-pane fade show active" id="tab-detalle">
            <div class="bg-white gob-card rounded-2xl overflow-hidden p-6 lg:p-8 space-y-8">
                <h6
                    class="text-primary-blue font-bold text-xs uppercase tracking-widest border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">info</span> Información General
                </h6>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-1">
                        <label class="label-custom">N° OIRS</label>
                        <input type="text" class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50 font-bold text-primary-blue text-center"
                            id="oirs_id_visual" disabled>
                    </div>
                    <div class="space-y-1 md:col-start-4">
                        <label class="label-custom">ESTADO</label>
                        <input type="text" class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50 font-bold text-center"
                            id="oirs_estado_visual" disabled placeholder="Sin asignar">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-1">
                        <label class="label-custom">Tipo Atención</label>
                        <select class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50 font-medium"
                            id="oirs_tipo_atencion" disabled>
                            <option disabled selected>Seleccione...</option>
                            <?php foreach ($tiposAtencion as $t): ?>
                                <option value="<?= $t['tat_id'] ?>" <?= ($solicitudData && $solicitudData['oirs_tipo_atencion'] == $t['tat_id']) ? 'selected' : '' ?>>
                                    <?= $t['tat_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="label-custom">Origen Consulta</label>
                        <select class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50 font-medium"
                            id="oirs_origen" disabled>
                            <option selected>Presencial</option>
                            <option>Teléfono</option>
                            <option>Terreno</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="label-custom">Condición</label>
                        <select class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50 font-medium"
                            id="oirs_condicion" disabled>
                            <option disabled selected>Seleccione...</option>
                            <?php foreach ($condiciones as $c): ?>
                                <option value="<?= $c['con_id'] ?>" <?= ($solicitudData && $solicitudData['oirs_condicion'] == $c['con_id']) ? 'selected' : '' ?>>
                                    <?= $c['con_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="label-custom">Prioridad Municipal</label>
                        <select class="w-full rounded-xl border-slate-200 text-[15px] font-bold text-primary-blue"
                            id="oirs_prioridad">
                            <option value="1">Ninguna</option>
                            <option value="2">Baja</option>
                            <option value="3">Media</option>
                            <option value="4">Alta</option>
                            <option value="5">Riesgo de Vida</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-1">
                        <label class="label-custom">Fecha de Ingreso</label>
                        <input type="date" class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50"
                            id="oirs_fecha" disabled>
                    </div>
                    <div class="space-y-1">
                        <label class="label-custom">Hora</label>
                        <input type="time" class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50"
                            id="oirs_hora" disabled>
                    </div>
                    <div class="space-y-1">
                        <label class="label-custom">Temática Principal</label>
                        <select class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50 font-medium"
                            id="oirs_tematica" disabled>
                            <option disabled selected>Seleccione...</option>
                            <?php foreach ($tematicas as $t): ?>
                                <option value="<?= $t['tem_id'] ?>" <?= ($solicitudData && $solicitudData['oirs_tematica'] == $t['tem_id']) ? 'selected' : '' ?>>
                                    <?= $t['tem_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="label-custom">Subtemática</label>
                        <select class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50 font-medium"
                            id="oirs_subtematica" disabled>
                            <option disabled selected>Seleccione...</option>
                            <?php if ($solicitudData && $solicitudData['oirs_tematica']): ?>
                                <?php foreach ($subtematicas as $s):
                                    if ($s['tem_id'] == $solicitudData['oirs_tematica']): ?>
                                        <option value="<?= $s['sub_id'] ?>" <?= ($solicitudData['oirs_subtematica'] == $s['sub_id']) ? 'selected' : '' ?>><?= $s['sub_nombre'] ?></option>
                                    <?php endif; endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-4">
                        <div class="space-y-1">
                            <label class="label-custom">Dirección de la Solicitud</label>
                            <div class="flex gap-2">
                                <input type="text" class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50"
                                    id="oirs_calle" disabled>
                                <span
                                    class="material-symbols-outlined text-primary-blue bg-blue-50 p-2 rounded-xl">location_on</span>
                            </div>
                        </div>
                        <div id="map_incidente"
                            class="w-full h-[250px] rounded-2xl border border-slate-100 shadow-inner"></div>
                        <input type="hidden" id="oirs_lat"><input type="hidden" id="oirs_lng">
                    </div>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="label-custom">Sector</label>
                            <select class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50 font-medium"
                                id="oirs_sector" disabled>
                                <option disabled selected>Seleccione...</option>
                                <?php foreach ($sectores as $s): ?>
                                    <option value="<?= $s['sec_id'] ?>" <?= ($solicitudData && $solicitudData['oirs_sector'] == $s['sec_id']) ? 'selected' : '' ?>>
                                        <?= $s['sec_nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="bg-soft-cyan border border-cyan-border rounded-2xl p-5 space-y-2">
                            <h6 class="label-custom text-primary-blue">Archivos Usuario</h6>
                            <div id="contenedor_adjuntos_usuario" class="space-y-2"></div>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="label-custom">Descripción de la Solicitud</label>
                    <textarea class="w-full rounded-2xl border-slate-200 text-[15px] bg-slate-50 p-4 italic"
                        id="oirs_descripcion" rows="4" disabled></textarea>
                </div>

                <div class="bg-blue-50/50 border border-blue-100 rounded-3xl p-6 lg:p-8 space-y-6" style="<?= !$mostrarBloquePreliminar ? 'display: none;' : '' ?>">
                    <h6
                        class="text-primary-blue font-bold text-xs uppercase tracking-widest border-b border-blue-200 pb-3">
                        Información al Contribuyente <?= $soloLecturaPreliminar ? '<span class="text-[10px] text-slate-400 font-normal ml-2">(Modo Lectura)</span>' : '' ?></h6>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="label-custom text-primary-blue">Respuesta Preliminar</label>
                            <textarea
                                class="w-full rounded-2xl border-slate-200 text-[15px] p-4 shadow-sm <?= $soloLecturaPreliminar ? 'bg-slate-100 text-slate-500 cursor-not-allowed' : 'focus:ring-primary-blue' ?>"
                                id="oig_respuesta_preliminar" rows="4"
                                placeholder="Escriba la respuesta oficial..." <?= $soloLecturaPreliminar ? 'disabled' : '' ?>><?= $solicitudData['gestion']['oig_respuesta_preliminar'] ?? '' ?></textarea>
                        </div>
                        <div class="flex flex-col md:flex-row justify-between items-end gap-4">
                            <div class="w-full md:w-1/3 space-y-1">
                                <label class="label-custom text-slate-500">¿Requiere respuesta técnica?</label>
                                <select id="oig_requiere_respuesta_tecnica" name="oig_requiere_respuesta_tecnica"
                                    class="form-control <?= $soloLecturaPreliminar ? 'bg-slate-100 text-slate-500 cursor-not-allowed' : '' ?>" <?= $soloLecturaPreliminar ? 'disabled' : '' ?>>
                                    <option value="" <?= ($solicitudData && (!isset($solicitudData['gestion']) || empty($solicitudData['gestion']['oig_requiere_respuesta_tecnica']))) ? 'selected' : '' ?>>Seleccione...</option>
                                    <option value="1" <?= ($solicitudData && isset($solicitudData['gestion']) && ($solicitudData['gestion']['oig_requiere_respuesta_tecnica'] == 1 || $solicitudData['gestion']['oig_requiere_respuesta_tecnica'] === 'Si')) ? 'selected' : '' ?>>Si</option>
                                    <option value="0" <?= ($solicitudData && isset($solicitudData['gestion']) && ($solicitudData['gestion']['oig_requiere_respuesta_tecnica'] === '0' || $solicitudData['gestion']['oig_requiere_respuesta_tecnica'] === 0 || $solicitudData['gestion']['oig_requiere_respuesta_tecnica'] === 'No')) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                            <?php if (!$soloLecturaPreliminar): ?>
                            <button type="button"
                                class="bg-primary-blue text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-blue-700 transition-all text-xs uppercase tracking-widest flex items-center gap-2"
                                id="btn_responder_preliminar">
                                <span class="material-symbols-outlined text-sm">send</span> Responder al Vecino
                            </button>
                            <?php endif; ?>
                        </div>
                        <div id="info_auditoria_preliminar"
                            class="text-sm text-slate-600 mt-3 font-medium flex justify-between bg-white/50 p-2 rounded-lg border border-slate-100">
                            <span id="txt_preliminar_user">Respuesta entregada por: -</span>
                            <span id="txt_preliminar_fec">Fecha: -</span>
                        </div>
                    </div>
                </div>

                <div id="container_respuesta_tecnica"
                    class="bg-emerald-50/50 border border-emerald-100 rounded-3xl p-6 lg:p-8 space-y-6"
                    style="<?= ($solicitudData && isset($solicitudData['gestion']) && ($solicitudData['gestion']['oig_requiere_respuesta_tecnica'] == 1 || $solicitudData['gestion']['oig_requiere_respuesta_tecnica'] === 'Si')) && $mostrarBloqueTecnica ? '' : 'display: none;' ?>">
                    <h6
                        class="text-gob-success font-bold text-xs uppercase tracking-widest border-b border-emerald-200 pb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined">engineering</span> Respuesta por Unidad Técnica <?= $soloLecturaTecnica ? '<span class="text-[10px] text-slate-400 font-normal ml-2">(Modo Lectura)</span>' : '' ?>
                    </h6>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="label-custom text-gob-success">Respuesta Técnica</label>
                            <textarea class="w-full rounded-2xl border-slate-200 text-[15px] p-4 shadow-sm <?= $soloLecturaTecnica ? 'bg-slate-100 text-slate-500 cursor-not-allowed' : 'focus:ring-gob-success' ?>"
                                id="oig_respuesta_tecnica" rows="4"
                                placeholder="Escriba la respuesta técnica..." <?= $soloLecturaTecnica ? 'disabled' : '' ?>><?= $solicitudData['gestion']['oig_respuesta_tecnica'] ?? '' ?></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                            <div class="space-y-1">
                                <label class="label-custom text-slate-500">¿La solicitud será ejecutada?</label>
                                <select class="w-full rounded-xl border-slate-200 text-[15px] <?= $soloLecturaTecnica ? 'bg-slate-100 text-slate-500 cursor-not-allowed' : '' ?>"
                                    id="oig_solicitud_ejecutada" <?= $soloLecturaTecnica ? 'disabled' : '' ?>>
                                    <option value="">Seleccione...</option>
                                    <option value="1" <?= ($solicitudData && isset($solicitudData['gestion']) && ($solicitudData['gestion']['oig_solicitud_ejecutada'] == 1 || $solicitudData['gestion']['oig_solicitud_ejecutada'] === 'Si')) ? 'selected' : '' ?>>Si</option>
                                    <option value="0" <?= ($solicitudData && isset($solicitudData['gestion']) && ($solicitudData['gestion']['oig_solicitud_ejecutada'] == 0 || $solicitudData['gestion']['oig_solicitud_ejecutada'] === 'No')) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="label-custom text-slate-500">Fuente de Financiamiento</label>
                                <select class="w-full rounded-xl border-slate-200 text-[15px] <?= $soloLecturaTecnica ? 'bg-slate-100 text-slate-500 cursor-not-allowed' : '' ?>"
                                    id="oig_fuente_financiamiento" <?= $soloLecturaTecnica ? 'disabled' : '' ?>>
                                    <option value="">Seleccione...</option>
                                    <option value="Contrato de Licitación" <?= ($solicitudData && isset($solicitudData['gestion']) && $solicitudData['gestion']['oig_fuente_financiamiento'] === 'Contrato de Licitación') ? 'selected' : '' ?>>Contrato de Licitación</option>
                                    <option value="Recursos Propios" <?= ($solicitudData && isset($solicitudData['gestion']) && $solicitudData['gestion']['oig_fuente_financiamiento'] === 'Recursos Propios') ? 'selected' : '' ?>>Recursos Propios</option>
                                    <option value="Fondo Regional" <?= ($solicitudData && isset($solicitudData['gestion']) && $solicitudData['gestion']['oig_fuente_financiamiento'] === 'Fondo Regional') ? 'selected' : '' ?>>Fondo Regional</option>
                                    <option value="Fondo Nacional" <?= ($solicitudData && isset($solicitudData['gestion']) && $solicitudData['gestion']['oig_fuente_financiamiento'] === 'Fondo Nacional') ? 'selected' : '' ?>>Fondo Nacional</option>
                                </select>
                            </div>
                            <?php if (!$soloLecturaTecnica): ?>
                            <button type="button"
                                class="bg-primary-blue text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-blue-700 transition-all text-xs uppercase tracking-widest flex items-center justify-center gap-2"
                                id="btn_responder_tecnico">
                                <span class="material-symbols-outlined text-sm">send</span> Responder al Vecino
                            </button>
                            <?php endif; ?>
                        </div>
                        <div id="info_auditoria_tecnica"
                            class="text-sm text-slate-600 mt-3 font-medium flex justify-between bg-white/50 p-2 rounded-lg border border-slate-100">
                            <span id="txt_tecnica_user">Respuesta entregada por: -</span>
                            <span id="txt_tecnica_fec">Fecha: -</span>
                        </div>
                    </div>
                </div>
                <div id="container_notificacion_ejecucion"
                    class="bg-slate-50 border border-slate-200 rounded-3xl p-6 lg:p-8 space-y-6" style="<?= $mostrarBloqueEjecucion ? 'display: none;' : 'display: none;' /* JS will handle the display logic but we still apply inline style here as base */ ?>">
                    <h6
                        class="text-slate-600 font-bold text-xs uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined">task_alt</span> Notificación de Ejecución <?= $soloLecturaEjecucion ? '<span class="text-[10px] text-slate-400 font-normal ml-2">(Modo Lectura)</span>' : '' ?>
                    </h6>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="label-custom">Mensaje de Notificación de Término</label>
                            <textarea id="oig_notificacion_ejecucion"
                                class="w-full rounded-2xl border-slate-200 text-[15px] p-4 shadow-sm <?= $soloLecturaEjecucion ? 'bg-slate-100 text-slate-500 cursor-not-allowed' : 'focus:ring-primary-blue' ?>" rows="3"
                                placeholder="Notifica al contribuyente que su OIRS fue ejecutada..." <?= $soloLecturaEjecucion ? 'disabled' : '' ?>><?= $solicitudData['gestion']['oig_notificacion_ejecucion'] ?? '' ?></textarea>
                        </div>
                        <div class="flex flex-col md:flex-row justify-between items-end gap-4">
                            <div class="w-full md:w-1/2 space-y-1">
                                <label class="label-custom">¿Fue realizada en los plazos planificados?</label>
                                <select id="oig_realizada_en_plazo"
                                    class="w-full rounded-xl border-slate-200 text-[15px] <?= $soloLecturaEjecucion ? 'bg-slate-100 text-slate-500 cursor-not-allowed' : '' ?>" <?= $soloLecturaEjecucion ? 'disabled' : '' ?>>
                                    <option value="1" <?= ($solicitudData && isset($solicitudData['gestion']) && ($solicitudData['gestion']['oig_realizada_en_plazo'] == 1 || $solicitudData['gestion']['oig_realizada_en_plazo'] === 'Si')) ? 'selected' : '' ?>>Si</option>
                                    <option value="0" <?= ($solicitudData && isset($solicitudData['gestion']) && ($solicitudData['gestion']['oig_realizada_en_plazo'] == 0 || $solicitudData['gestion']['oig_realizada_en_plazo'] === 'No')) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                            <?php if (!$soloLecturaEjecucion): ?>
                            <button type="button"
                                class="bg-primary-blue text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-blue-700 transition-all text-xs uppercase tracking-widest flex items-center gap-2"
                                id="btn_notificar_ejecucion">
                                <span class="material-symbols-outlined text-sm">send</span> Responder al Vecino
                            </button>
                            <?php endif; ?>
                        </div>
                        <div id="info_auditoria_ejecucion"
                            class="text-sm text-slate-600 mt-3 font-medium flex justify-between bg-white/50 p-2 rounded-lg border border-slate-100">
                            <span id="txt_ejecucion_user">Respuesta entregada por: -</span>
                            <span id="txt_ejecucion_fec">Fecha: -</span>
                        </div>
                    </div>
                </div>

                <div id="container_aclaratoria"
                    class="bg-amber-50/50 border border-amber-100 rounded-3xl p-6 lg:p-8 space-y-6"
                    style="display: none;">
                    <h6
                        class="text-amber-600 font-bold text-xs uppercase tracking-widest border-b border-amber-200 pb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined">feedback</span> Aclaratoria del Contribuyente
                    </h6>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="label-custom text-amber-600">Comentario del Vecino</label>
                            <div
                                class="p-4 bg-white/80 rounded-2xl border border-amber-100 italic text-slate-700 text-[15px] shadow-sm">
                                <?= !empty($solicitudData['gestion']['oig_aclaratoria_contribuyente']) ? htmlspecialchars($solicitudData['gestion']['oig_aclaratoria_contribuyente']) : 'Sin comentarios adicionales del contribuyente.' ?>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="label-custom text-slate-500">Respuesta a la Aclaratoria</label>
                            <textarea id="oig_respuesta_aclaratoria"
                                class="w-full rounded-2xl border-slate-200 text-[15px] p-4 focus:ring-primary-blue shadow-sm"
                                rows="3"
                                placeholder="Escriba la aclaración final..."><?= $solicitudData['gestion']['oig_respuesta_aclaratoria'] ?? '' ?></textarea>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button type="button"
                                class="bg-primary-blue text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-blue-700 transition-all text-xs uppercase tracking-widest flex items-center gap-2"
                                id="btn_responder_aclaratoria">
                                <span class="material-symbols-outlined text-sm">send</span> Responder al Vecino
                            </button>
                        </div>
                    </div>
                </div>

                <!--<div class="pt-6 border-t border-slate-100 flex justify-end">
                    <button type="button"
                        class="bg-gob-success text-white font-extrabold py-4 px-10 rounded-2xl shadow-xl hover:scale-105 transition-all text-sm uppercase tracking-widest flex items-center gap-3"
                        id="btn_guardar_todo">
                        <span class="material-symbols-outlined">save_as</span> Guardar Todos los Cambios
                    </button>
                </div>-->
            </div>
        </div>

        <!--Pestaña Datos del Contribuyente-->
        <div class="tab-pane fade" id="tab-contribuyente">
            <div class="bg-white gob-card rounded-2xl p-6 lg:p-10 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div class="space-y-1">
                        <label class="label-custom">RUT Contribuyente</label>
                        <div class="flex gap-2">
                            <input type="text"
                                class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50 font-bold"
                                id="cont_rut" readonly>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="label-custom">Tipo Contribuyente</label>
                        <select class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50"
                            id="tipoContribuyenteSwitch" disabled>
                            <option value="natural">Persona Natural</option>
                            <option value="juridica">Persona Jurídica</option>
                        </select>
                    </div>
                </div>

                <div id="infoNatural" class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 border-t border-slate-50">
                    <div class="space-y-1"><label class="label-custom">Nombre</label><input type="text" id="cont_nombre"
                            class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50" readonly></div>
                    <div class="space-y-1"><label class="label-custom">Ap. Paterno</label><input type="text"
                            id="cont_apellido_paterno"
                            class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50" readonly></div>
                    <div class="space-y-1"><label class="label-custom">Ap. Materno</label><input type="text"
                            id="cont_apellido_materno"
                            class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50" readonly></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1"><label class="label-custom">Email</label><input type="text" id="cont_email"
                            class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50" readonly></div>
                    <div class="space-y-1"><label class="label-custom">Teléfono</label><input type="text"
                            id="cont_telefono" class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50"
                            readonly></div>
                    <div class="space-y-1"><label class="label-custom">Dirección</label><input type="text"
                            id="cont_direccion" class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50"
                            readonly></div>
                </div>
                <div id="map_home" class="w-full h-[300px] rounded-2xl border border-slate-100 shadow-inner"></div>
            </div>
        </div>

        <!--Pestaña Asignación-->



        <div class="tab-pane fade" id="tab-asignacion">
            <div class="bg-white gob-card rounded-2xl p-6 lg:p-8">
                <div class="grid grid-cols-1 <?= ($mostrarAsignacion==1) ? 'md:grid-cols-2' : '' ?> gap-6"0">
                     <?php
            if($mostrarAsignacion==1){
            ?>

                    <div class="space-y-6">
                               

                        <h6
                            class="text-primary-blue font-bold text-xs uppercase tracking-widest border-b pb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">person_add</span> Nueva Asignación
                        </h6>

                        <div class="space-y-4">
                            <div class="space-y-1">
                                <label class="label-custom">Funcionario / Departamento</label>
                                <div class="flex gap-2">
                                    <input type="text"
                                        class="w-full rounded-xl border-slate-200 text-[15px] bg-slate-50"
                                        id="oig_asignacion_display" readonly placeholder="Buscar funcionario...">
                                    <button class="bg-primary-blue text-white p-2 rounded-xl shadow-md"
                                        data-bs-toggle="modal" data-bs-target="#modalBuscarFuncionario"
                                        onclick="abrirModalBuscarCargos()">
                                        <span class="material-symbols-outlined">search</span>
                                    </button>
                                </div>
                                <input type="hidden" id="oig_asignacion">
                            </div>
                            <div class="space-y-1">
                                <label class="label-custom">Instrucción</label>
                                <textarea
                                    class="w-full rounded-xl border-slate-200 text-[15px] p-4 focus:ring-primary-blue"
                                    id="oig_instruccion_asignacion" rows="4"
                                    placeholder="Escriba instrucciones..."></textarea>
                            </div>
                            <button
                                class="w-full bg-primary-blue text-white font-bold py-3 rounded-xl shadow-lg uppercase text-xs tracking-widest"
                                id="btn_asignar">Asignar y Notificar</button>
                        </div>


                    </div>
                                                                    <?php 
            } 
            ?>
                    <div class="space-y-6">
                        <h6
                            class="text-slate-700 font-bold text-xs uppercase tracking-widest border-b pb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">group</span> Asignaciones Actuales
                        </h6>
                        <div class="accordion space-y-2" id="accordionAsignaciones"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--Pestaña Adjuntos-->
        <div class="tab-pane fade" id="tab-adjuntos-muni">
            <div class="bg-white gob-card rounded-2xl p-6 lg:p-8 space-y-6">
                <div class="bg-soft-cyan border border-cyan-border rounded-3xl p-8 text-center space-y-4">
                    <input type="file" id="customFileMuni" class="hidden" multiple>
                    <label for="customFileMuni" class="cursor-pointer block">
                        <span class="material-symbols-outlined text-primary-blue text-5xl mb-2">cloud_upload</span>
                        <p class="text-[15px] text-slate-700 font-bold">Seleccionar archivos internos</p>
                        <p class="text-xs text-slate-400 uppercase tracking-widest mt-1">Actas, Fotos Visita, Informes
                            Técnicos</p>
                    </label>
                    <div id="lista_archivos_muni" class="max-w-md mx-auto space-y-1"></div>
                    <button
                        class="bg-primary-blue text-white font-bold py-2 px-8 rounded-xl shadow-md text-xs uppercase tracking-widest mt-4"
                        id="btnGuardarAdjuntosMuni">Subir Documentos</button>
                </div>

                <div class="overflow-hidden border border-slate-100 rounded-2xl">
                    <table class="w-full text-left text-[14px]">
                        <thead
                            class="bg-slate-50 text-slate-500 font-bold uppercase text-[10px] tracking-widest border-b">
                            <tr>
                                <th class="px-6 py-4">Nombre Archivo</th>
                                <th class="px-6 py-4">Subido por</th>
                                <th class="px-6 py-4">Fecha</th>
                                <th class="px-6 py-4 text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600">
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 flex items-center gap-2"><span
                                        class="material-symbols-outlined text-rose-500">picture_as_pdf</span>
                                    Informe_Visita.pdf</td>
                                <td class="px-6 py-4">Juan Pérez</td>
                                <td class="px-6 py-4">08/02/2024</td>
                                <td class="px-6 py-4 text-right font-bold text-primary-blue"><a href="#">DESCARGAR</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--Pestaña Historial-->
        <div class="tab-pane fade" id="tab-historial">
            <div class="bg-white gob-card rounded-2xl p-6 lg:p-8">
                <div class="timeline space-y-6" id="timeline_container"></div>
            </div>
        </div>

    </div>
</div>

<!--Modal Buscar Funcionario-->
<div class="modal fade" id="modalBuscarFuncionario" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-50 border-b p-6">
                <h5 class="modal-title font-extrabold text-slate-800 text-sm uppercase tracking-widest">Buscar Cargo Destino</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <input type="text" class="w-full rounded-xl border-slate-200 text-sm p-3" id="buscar_fnc_input"
                        placeholder="Buscar por nombre del cargo...">
                </div>
                <div class="table-responsive max-h-[400px] rounded-xl border border-slate-100">
                    <table class="table table-hover align-middle mb-0">
                        <thead
                            class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b sticky top-0">
                            <tr>
                                <th class="px-4 py-3 text-left">ID / Cargo</th>
                                <th class="px-4 py-3 text-left">Área</th>
                                <th class="text-end px-4 py-3">Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_fnc_oirs" class="text-[13px] text-slate-600"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Inyectar datos originales
    window.oirsData = {
        solicitud: <?php echo json_encode($solicitudData); ?>,
        listas: {
            tiposAtencion: <?php echo json_encode($tiposAtencion); ?>,
            condiciones: <?php echo json_encode($condiciones); ?>,
            tematicas: <?php echo json_encode($tematicas); ?>,
            subtematicas: <?php echo json_encode($subtematicas); ?>,
            sectores: <?php echo json_encode($sectores); ?>,
            escolaridades: <?php echo json_encode($escolaridades); ?>,
            cargos: <?php echo json_encode($cargosOirs); ?>
        },
        currentUserId: <?php echo $_SESSION['user_id'] ?? 0; ?>,
        misCargos: <?php echo json_encode($misCargos); ?>,
        permisos: {
            mostrarBloqueTecnica: <?php echo $mostrarBloqueTecnica ? 'true' : 'false'; ?>,
            mostrarBloqueEjecucion: <?php echo $mostrarBloqueEjecucion ? 'true' : 'false'; ?>
        }
    };

    // Toggle original
    if (document.getElementById('tipoContribuyenteSwitch')) {
        document.getElementById('tipoContribuyenteSwitch').addEventListener('change', function () {
            if (this.value === 'juridica') {
                document.getElementById('infoNatural').classList.add('d-none');
                document.getElementById('infoJuridica').classList.remove('d-none');
            } else {
                document.getElementById('infoNatural').classList.remove('d-none');
                document.getElementById('infoJuridica').classList.add('d-none');
            }
        });
    }
</script>

<?php
use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey();
?>
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&callback=initMap&libraries=places"
    async defer></script>
<script src="../../recursos/js/funcionarios/oirs/ver.js"></script>
<?php include '../../api/general/footer.php'; ?>