<?php
$pageTitle = "Consulta OIRS";
require_once '../../api/auth_check.php';
include 'header-oirs-funcionarios.php';

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
$funcionarios = $funcionarioCtrl->getAll()['data'] ?? [];

// 3. Fetch Solicitud if ID exists
$solicitudData = null;
if (isset($_GET['id'])) {
    $res = $solicitudCtrl->getById($_GET['id']);
    // Controller usually returns ["status"=>..., "data"=>...] or direct data?
    // Based on API usage, it returns the response structure.
    if (isset($res['status']) && $res['status'] === 'success') {
        $solicitudData = $res['data'];
    }
}
?>

<div class="container-fluid p-4">

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4 border-bottom-0" id="oirsTabs" role="tablist" style="gap: 5px;">
        <li class="nav-item">
            <a class="nav-link active border-0 rounded-pill bg-white shadow-sm font-weight-bold px-4"
                style="font-size: 13px;" data-toggle="tab" href="#tab-detalle">Detalle de la OIRS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-0 rounded-pill bg-white shadow-sm font-weight-bold px-4" style="font-size: 13px;"
                data-toggle="tab" href="#tab-contribuyente">Datos del Contribuyente</a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-0 rounded-pill bg-white shadow-sm font-weight-bold px-4" style="font-size: 13px;"
                data-toggle="tab" href="#tab-asignacion">Asignación</a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-0 rounded-pill bg-white shadow-sm font-weight-bold px-4" style="font-size: 13px;"
                data-toggle="tab" href="#tab-adjuntos-muni">Adjuntos Municipio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-0 rounded-pill bg-white shadow-sm font-weight-bold px-4" style="font-size: 13px;"
                data-toggle="tab" href="#tab-historial">Historial</a>
        </li>
    </ul>

    <div class="tab-content">

        <!-- DETALLE DE LA OIRS -->
        <div class="tab-pane fade show active" id="tab-detalle">
            <div class="card search-card p-4 mb-4">
                <h6 class="text-uppercase text-primary font-weight-bold mb-4"
                    style="font-size: 11px; letter-spacing: 0.1em; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
                    Información General</h6>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Tipo Atención</label>
                        <select class="form-control form-control-cool" id="oirs_tipo_atencion" disabled>
                            <option disabled selected>Seleccione...</option>
                            <?php foreach ($tiposAtencion as $t): ?>
                                <option value="<?= $t['tat_id'] ?>" <?= ($solicitudData && $solicitudData['oirs_tipo_atencion'] == $t['tat_id']) ? 'selected' : '' ?>>
                                    <?= $t['tat_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Origen Consulta</label>
                        <select class="form-control form-control-cool" id="oirs_origen" disabled>
                            <option selected>Presencial</option>
                            <option>Teléfono</option>
                            <option>Terreno</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Condición</label>
                        <select class="form-control form-control-cool" id="oirs_condicion" disabled>
                            <option disabled selected>Seleccione...</option>
                            <?php foreach ($condiciones as $c): ?>
                                <option value="<?= $c['con_id'] ?>" <?= ($solicitudData && $solicitudData['oirs_condicion'] == $c['con_id']) ? 'selected' : '' ?>>
                                    <?= $c['con_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Prioridad Municipal</label>
                        <select class="form-control form-control-cool" id="oirs_prioridad">
                            <option value="1">Ninguna</option>
                            <option value="2">Baja</option>
                            <option value="3">Media</option>
                            <option value="4">Alta</option>
                            <option value="5">Riesgo de Vida</option>
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Fecha de Ingreso</label>
                        <input type="date" class="form-control form-control-cool" id="oirs_fecha" disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Hora</label>
                        <input type="time" class="form-control form-control-cool" id="oirs_hora" disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Temática Principal</label>
                        <select class="form-control form-control-cool" id="oirs_tematica" disabled>
                            <option disabled selected>Seleccione...</option>
                            <?php foreach ($tematicas as $t): ?>
                                <option value="<?= $t['tem_id'] ?>" <?= ($solicitudData && $solicitudData['oirs_tematica'] == $t['tem_id']) ? 'selected' : '' ?>>
                                    <?= $t['tem_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Subtemática</label>
                        <select class="form-control form-control-cool" id="oirs_subtematica" disabled>
                            <option disabled selected>Seleccione...</option>
                            <?php
                            // Initial load: if solData exists, filter by tematica, otherwise empty or all?
                            // JS usually handles filtering. We can populate the relevant ones if tematica is selected.
                            if ($solicitudData && $solicitudData['oirs_tematica']) {
                                foreach ($subtematicas as $s) {
                                    if ($s['tem_id'] == $solicitudData['oirs_tematica']) {
                                        $selected = ($solicitudData['oirs_subtematica'] == $s['sub_id']) ? 'selected' : '';
                                        echo "<option value=\"{$s['sub_id']}\" $selected>{$s['sub_nombre']}</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="filter-label">Dirección de la Solicitud</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-cool" id="oirs_calle" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text bg-white border-left-0"><span
                                        class="material-symbols-outlined text-primary"
                                        style="font-size: 18px;">location_on</span></span>
                            </div>
                        </div>
                        <div id="map_incidente" style="height: 250px; border-radius: 8px; margin-top: 10px;"
                            class="border" disabled>
                            <!-- Google Map -->
                        </div>
                        <input type="hidden" id="oirs_lat">
                        <input type="hidden" id="oirs_lng">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="filter-label">Sector</label>
                        <select class="form-control form-control-cool" id="oirs_sector" disabled>
                            <option disabled selected>Seleccione...</option>
                            <?php foreach ($sectores as $s): ?>
                                <option value="<?= $s['sec_id'] ?>" <?= ($solicitudData && $solicitudData['oirs_sector'] == $s['sec_id']) ? 'selected' : '' ?>>
                                    <?= $s['sec_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="filter-label">Descripción de la Solicitud</label>
                        <textarea class="form-control form-control-cool" id="oirs_descripcion" rows="4"
                            disabled></textarea>
                    </div>
                </div>

                <h6 class="text-uppercase text-secondary font-weight-bold mb-3"
                    style="font-size: 11px; letter-spacing: 0.1em;">Archivos Adjuntos (Usuario)</h6>
                <div class="row" id="contenedor_adjuntos_usuario">
                    <!-- Dinámico -->
                </div>


                <hr class="my-4">

                <h6 class="text-uppercase text-primary font-weight-bold mb-4"
                    style="font-size: 11px; letter-spacing: 0.1em; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
                    Información al Contribuyente</h6>

                <div class="row">

                    <!-- Respuesta preliminar -->
                    <div class="col-12 mb-3">
                        <label class="filter-label">Respuesta Preliminar</label>
                        <textarea class="form-control form-control-cool" id="oig_respuesta_preliminar" rows="4"
                            placeholder="Escriba la respuesta oficial para el contribuyente..." disabled></textarea>
                    </div>

                    <!-- Fila acciones -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-end">

                            <!-- Respuesta técnica -->
                            <div>
                                <label class="filter-label mb-1">
                                    ¿Requiere respuesta técnica?
                                </label>
                                <select class="form-control form-control-cool" id="oig_requiere_respuesta_tecnica">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Botón guardar -->
                            <button class="btn btn-primary btn-sm px-3 font-weight-bold" id="btn_responder_preliminar">
                                <span class="material-symbols-outlined align-middle mr-1">save</span>
                                Responder al Vecino
                            </button>

                        </div>
                    </div>

                </div>


                <hr class="my-4">

                <div class="row" id="container_respuesta_tecnica">
                    <div class="col-12 mb-3">
                        <label class="filter-label">Respuesta por Unidad Técnica</label>
                        <textarea class="form-control form-control-cool" id="oig_respuesta_tecnica" rows="4"
                            placeholder="Escriba la respuesta oficial para el contribuyente..."></textarea>
                    </div>

                    <!-- Fila acciones -->
                    <div class="row col-12">

                        <div class="col-md-3 mb-3">
                            <label class="filter-label">¿La solicitud será ejecutada?</label>
                            <select class="form-control form-control-cool" id="oig_solicitud_ejecutada">
                                <option value="1" selected="">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="filter-label">Fuente de Financiamiento:</label>
                            <select class="form-control form-control-cool" id="oig_fuente_financiamiento">
                                <option value="Contrato de Licitación">Contrato de Licitación</option>
                                <option value="Recursos Propios">Recursos Propios</option>
                                <option value="Fondo Regional">Fondo Regional</option>
                                <option value="Fondo Nacional">Fondo Nacional</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3 d-flex align-items-end text-right">
                            <button class="btn btn-primary btn-sm px-3 font-weight-bold" id="btn_responder_tecnico">
                                <span class="material-symbols-outlined align-middle mr-1">save</span>
                                Responder al Vecino
                            </button>
                        </div>
                    </div>

                </div>

                <hr class="my-4">

                <div class="row" id="container_notificacion_ejecucion">
                    <div class="col-12 mb-3">
                        <label class="filter-label">Notificación de Ejecución</label>
                        <textarea class="form-control form-control-cool" id="oig_notificacion_ejecucion" rows="4"
                            placeholder="Notifica al contribuyente que su OIRS fue ejecutada..."></textarea>
                    </div>

                    <div class="row col-12">

                        <div class="col-md-3 mb-3">
                            <label class="filter-label">¿Fue realizada en los plazos planificados?</label>
                            <select class="form-control form-control-cool" id="oig_realizada_en_plazo">
                                <option value="1" selected="">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3 d-flex align-items-end text-right">
                            <button class="btn btn-primary btn-sm px-3 font-weight-bold" id="btn_notificar_ejecucion">
                                <span class="material-symbols-outlined align-middle mr-1">save</span>
                                Responder al Vecino
                            </button>
                        </div>
                    </div>

                </div>

                <hr class="my-4">


                <div class="row" id="container_aclaratoria">
                    <h6 class="text-uppercase text-primary font-weight-bold mb-4"
                        style="font-size: 11px; letter-spacing: 0.1em; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
                        Aclaratoria del Contribuyente</h6>
                    <div class="col-12 mb-3">
                        <label class="filter-label text-warning">Aclaratoria Contribuyente</label>
                        <textarea class="form-control form-control-cool bg-light border-warning"
                            id="oig_aclaratoria_contribuyente" rows="3"
                            readonly>El contribuyente indica que la dirección exacta es frente al número 125, no 123.</textarea>
                    </div>
                </div>

                <div class="row" id="container_respuesta_aclaratoria">
                    <div class="col-12 mb-3">
                        <label class="filter-label">Respuesta Aclaratoria</label>
                        <textarea class="form-control form-control-cool" id="oig_respuesta_aclaratoria" rows="3"
                            placeholder="Respuesta a la aclaratoria..."></textarea>
                    </div>
                    <div class="col-12 text-right">
                        <button class="btn btn-primary btn-sm px-3 font-weight-bold" id="btn_responder_aclaratoria">
                            <span class="material-symbols-outlined align-middle mr-1">save</span>
                            Responder Aclaratoria
                        </button>
                    </div>
                </div>

                <hr class="my-4">

            </div>
        </div>

        <!-- DATOS DEL CONTRIBUYENTE -->
        <div class="tab-pane fade" id="tab-contribuyente">
            <div class="card search-card p-4">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="filter-label">RUT Contribuyente</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-cool" id="cont_rut" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary btn-sm"><span class="material-symbols-outlined"
                                        style="font-size: 16px;">search</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="filter-label">Tipo Contribuyente</label>
                        <select class="form-control form-control-cool" id="tipoContribuyenteSwitch" readonly>
                            <option value="natural" selected>Persona Natural</option>
                            <option value="juridica">Persona Jurídica</option>
                        </select>
                    </div>
                </div>

                <hr>

                <!-- Persona Natural -->
                <div id="infoNatural">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="filter-label">Nombre</label>
                            <input type="text" class="form-control form-control-cool" id="cont_nombre" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="filter-label">Apellido Paterno</label>
                            <input type="text" class="form-control form-control-cool" id="cont_apellido_paterno"
                                readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="filter-label">Apellido Materno</label>
                            <input type="text" class="form-control form-control-cool" id="cont_apellido_materno"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="filter-label">Sexo</label>
                            <select class="form-control form-control-cool" id="cont_sexo" readonly>
                                <option value="">Seleccione...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro / No Binario</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="filter-label">Fecha Nacimiento</label>
                            <input type="date" class="form-control form-control-cool" id="cont_fecha_nacimiento"
                                readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="filter-label">Estado Civil</label>
                            <select class="form-control form-control-cool" id="cont_estado_civil" readonly>
                                <option value="">Seleccione...</option>
                                <option value="Soltero/a">Soltero/a</option>
                                <option value="Casado/a">Casado/a</option>
                                <option value="Divorciado/a">Divorciado/a</option>
                                <option value="Viudo/a">Viudo/a</option>
                                <option value="Acuerdo Unión Civil">Acuerdo Unión Civil</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="filter-label">Nivel Escolaridad</label>
                            <select class="form-control form-control-cool" id="cont_escolaridad" readonly>
                                <option value="">Seleccione...</option>
                                <?php foreach ($escolaridades as $e): ?>
                                    <option value="<?= $e['esc_id'] ?>" <?= ($solicitudData && isset($solicitudData['tgc_escolaridad']) && $solicitudData['tgc_escolaridad'] == $e['esc_id']) ? 'selected' : '' ?>>
                                        <?= $e['esc_nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="filter-label">Nacionalidad</label>
                            <input type="text" class="form-control form-control-cool" id="cont_nacionalidad" readonly>
                        </div>
                    </div>
                </div>

                <!-- Persona Juridica -->
                <div id="infoJuridica" class="d-none">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="filter-label">Nombre Representante / Quien realiza trámite</label>
                            <input type="text" class="form-control form-control-cool" placeholder="Nombre completo"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="filter-label">RUT Representante</label>
                            <input type="text" class="form-control form-control-cool" placeholder="12.345.678-9"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="filter-label">Cargo</label>
                            <input type="text" class="form-control form-control-cool" placeholder="Ej: Gerente General"
                                readonly>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="filter-label">Correo Electrónico</label>
                        <input type="email" class="form-control form-control-cool" id="cont_email" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="filter-label">Teléfono Contacto</label>
                        <input type="text" class="form-control form-control-cool" id="cont_telefono" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="filter-label">Dirección Contribuyente</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-cool" id="cont_direccion" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text bg-white border-left-0"><span
                                        class="material-symbols-outlined text-primary"
                                        style="font-size: 18px;">location_on</span></span>
                            </div>
                        </div>
                        <div id="map_home" style="height: 250px; border-radius: 8px; margin-top: 10px;" class="border">
                            <!-- Google Map -->
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="filter-label">Comuna</label>
                        <select class="form-control form-control-cool" readonly>
                            <option selected>Viña del Mar</option>
                            <option>Valparaíso</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- ASIGNACIÓN -->
        <div class="tab-pane fade" id="tab-asignacion">
            <div class="card search-card p-4">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <h6 class="font-weight-bold mb-3 text-primary">Nueva Asignación</h6>
                        <div class="form-group">
                            <label class="filter-label">Asignar a Funcionario / Departamento</label>
                            <select class="form-control form-control-cool" id="oig_asignacion">
                                <option selected disabled>Seleccionar...</option>
                                <?php foreach ($funcionarios as $f): ?>
                                    <option value="<?= $f['fnc_id'] ?>">
                                        <?= $f['fnc_nombre'] . " (" . ($f['fnc_area_nombre'] ?? 'N/A') . ")" ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="filter-label">Mensaje / Instrucción</label>
                            <textarea class="form-control form-control-cool" id="oig_instruccion_asignacion" rows="4"
                                placeholder="Escriba una instrucción para el funcionario..."></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary" id="btn_asignar"><span
                                    class="material-symbols-outlined align-middle mr-1"
                                    style="font-size: 18px;">send</span> Asignar y Notificar</button>
                        </div>
                    </div>
                    <div class="col-md-6 pl-4">
                        <h6 class="font-weight-bold mb-3 text-dark">Asignaciones Actuales</h6>
                        <div class="accordion" id="accordionAsignaciones">
                            <!-- Asignación 1 -->
                            <div class="card border mb-2 shadow-sm">
                                <div class="card-header bg-white p-3" id="headingOne" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="cursor: pointer;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-3"
                                                style="width: 32px; height: 32px;">
                                                <span class="material-symbols-outlined text-primary"
                                                    style="font-size: 18px;">person</span>
                                            </div>
                                            <div>
                                                <span class="font-weight-bold d-block text-dark"
                                                    style="font-size: 13px;">Juan Pérez (Operaciones)</span>
                                                <small class="text-muted">Asignado el 07/02/2024</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-warning mr-2">Pendiente Revisión</span>
                                            <span class="material-symbols-outlined text-muted">expand_more</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionAsignaciones">
                                    <div class="card-body bg-light p-3">
                                        <!-- Hilo de conversación -->
                                        <div class="mb-3">
                                            <div class="d-flex mb-2">
                                                <div class="mr-2"><span class="badge badge-primary">Tú</span></div>
                                                <div class="bg-white p-2 rounded shadow-sm w-100 border">
                                                    <p class="mb-0 small text-muted">Favor evaluar factibilidad técnica
                                                        de retiro de microbasural.</p>
                                                    <small class="text-muted" style="font-size: 10px;">07/02/2024 10:00
                                                        AM</small>
                                                </div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div class="mr-2"><span class="badge badge-secondary">J. Pérez</span>
                                                </div>
                                                <div class="bg-white p-2 rounded shadow-sm w-100 border">
                                                    <p class="mb-0 small text-dark">Se realizó visita a terreno.
                                                        Efectivamente existe acopio de basura no convencional. Se
                                                        requiere camión tolva.</p>
                                                    <div class="mt-2 text-right">
                                                        <a href="#" class="badge badge-light border"><span
                                                                class="material-symbols-outlined align-middle"
                                                                style="font-size: 12px;">attachment</span>
                                                            evidencia_visita.jpg</a>
                                                    </div>
                                                    <small class="text-muted" style="font-size: 10px;">08/02/2024 14:30
                                                        PM</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Acciones -->
                                        <div class="border-top pt-2 mt-2">
                                            <label class="filter-label mb-2">Tu Gestión</label>
                                            <div class="d-flex" style="gap: 5px;">
                                                <button class="btn btn-sm btn-success flex-grow-1 font-weight-bold"
                                                    onclick="Swal.fire('Aprobado', 'La respuesta ha sido validada.', 'success')">
                                                    <span class="material-symbols-outlined align-middle mr-1"
                                                        style="font-size: 16px;">check</span> Aprobar Respuesta
                                                </button>
                                                <button class="btn btn-sm btn-danger flex-grow-1 font-weight-bold"
                                                    onclick="Swal.fire('Solicitud de Rectificación', 'Se ha notificado al funcionario.', 'warning')">
                                                    <span class="material-symbols-outlined align-middle mr-1"
                                                        style="font-size: 16px;">replay</span> Solicitar Corrección
                                                </button>
                                            </div>
                                            <div class="mt-2">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Escribe un comentario o nueva instrucción...">
                                                <div class="text-right mt-1">
                                                    <button class="btn btn-link btn-sm p-0 text-primary">Enviar
                                                        Comentario</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Asignación 2 -->
                            <div class="card border mb-2 shadow-sm">
                                <div class="card-header bg-white p-3" id="headingTwo" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                    style="cursor: pointer;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-3"
                                                style="width: 32px; height: 32px;">
                                                <span class="material-symbols-outlined text-primary"
                                                    style="font-size: 18px;">person</span>
                                            </div>
                                            <div>
                                                <span class="font-weight-bold d-block text-dark"
                                                    style="font-size: 13px;">María Gómez (Tránsito)</span>
                                                <small class="text-muted">Asignado el 07/02/2024</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-success mr-2">Finalizada</span>
                                            <span class="material-symbols-outlined text-muted">expand_more</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionAsignaciones">
                                    <div class="card-body bg-light p-3">
                                        <div class="mb-3">
                                            <div class="d-flex mb-2">
                                                <div class="mr-2"><span class="badge badge-primary">Tú</span></div>
                                                <div class="bg-white p-2 rounded shadow-sm w-100 border">
                                                    <p class="mb-0 small text-muted">Verificar si corresponde
                                                        demarcación en la zona.</p>
                                                    <small class="text-muted" style="font-size: 10px;">07/02/2024 10:05
                                                        AM</small>
                                                </div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div class="mr-2"><span class="badge badge-secondary">M. Gómez</span>
                                                </div>
                                                <div class="bg-white p-2 rounded shadow-sm w-100 border">
                                                    <p class="mb-0 small text-dark">No corresponde demarcación, es vía
                                                        servidumbre.</p>
                                                    <small class="text-muted" style="font-size: 10px;">07/02/2024 11:00
                                                        AM</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-success py-2 font-weight-bold" style="font-size: 12px;">
                                            <span class="material-symbols-outlined align-middle mr-1"
                                                style="font-size: 16px;">check_circle</span> Gestionado y Cerrado
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADJUNTOS MUNICIPIO -->
        <div class="tab-pane fade" id="tab-adjuntos-muni">
            <div class="card search-card p-4">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileMuni" multiple>
                            <label class="custom-file-label" for="customFileMuni">Seleccionar archivos internos (Actas,
                                Fotos Visita, etc)...</label>
                        </div>
                        <div id="lista_archivos_muni" class="list-group list-group-flush mt-2 small">
                            <!-- Dynamic list of selected files -->
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" class="btn btn-sm btn-primary" id="btnGuardarAdjuntosMuni">
                                <span class="material-symbols-outlined align-middle"
                                    style="font-size: 16px;">cloud_upload</span>
                                Guardar Adjuntos
                            </button>
                        </div>
                    </div>
                </div>

                <h6 class="filter-label mb-3">Documentos Internos Cargados</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th>Nombre Archivo</th>
                                <th>Subido por</th>
                                <th>Fecha</th>
                                <th class="text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span
                                        class="material-symbols-outlined align-middle mr-1 text-danger">picture_as_pdf</span>
                                    Informe_Visita_Tecnica.pdf</td>
                                <td>Juan Pérez</td>
                                <td>08/02/2024</td>
                                <td class="text-right"><a href="#" class="text-primary">Descargar</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- HISTORIAL -->
        <div class="tab-pane fade" id="tab-historial">
            <div class="card search-card p-4">
                <div class="timeline" id="timeline_container">
                    <!-- Dinámico -->
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('tipoContribuyenteSwitch').addEventListener('change', function () {
        if (this.value === 'juridica') {
            document.getElementById('infoNatural').classList.add('d-none');
            document.getElementById('infoJuridica').classList.remove('d-none');
        } else {
            document.getElementById('infoNatural').classList.remove('d-none');
            document.getElementById('infoJuridica').classList.add('d-none');
        }
    });

    // Custom File Input Label
    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
<?php
use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey();
?>
<!-- Google Maps API -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&callback=initMap&libraries=places"
    async defer></script>

<script>
    // Inject Server-Side Data
    window.oirsData = {
        solicitud: <?php echo json_encode($solicitudData); ?>,
        listas: {
            tiposAtencion: <?php echo json_encode($tiposAtencion); ?>,
            condiciones: <?php echo json_encode($condiciones); ?>,
            tematicas: <?php echo json_encode($tematicas); ?>,
            subtematicas: <?php echo json_encode($subtematicas); ?>,
            sectores: <?php echo json_encode($sectores); ?>,
            escolaridades: <?php echo json_encode($escolaridades); ?>,
            funcionarios: <?php echo json_encode($funcionarios); ?>
        }
    };
</script>
<script src="../../recursos/js/funcionarios/oirs/oirs_consulta.js"></script>
<?php include 'footer-funcionarios.php'; ?>