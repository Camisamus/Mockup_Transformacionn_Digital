<?php
$pageTitle = "Centro de Reservas de Plazas";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';
?>

<style>
    .plaza-card:hover { border-color: #006FB3 !important; box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
    .day-slot { height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; transition: 0.2s; cursor: pointer; border: 1px dashed #dee2e6; }
    .day-slot:hover { background-color: #f8fafc; border-style: solid; }
    .day-slot.available { background-color: #10b981; color: white; border-style: solid; border-color: #10b981; cursor: default; }
    .day-slot.blocked { background-color: #ef4444; color: white; border-style: solid; border-color: #ef4444; cursor: not-allowed; }
    .day-slot.selected { background-color: #006FB3; color: white; border-style: solid; border-color: #006FB3; box-shadow: 0 0 0 3px rgba(0,111,179,0.2), 0 0 0 5px white; }
    .status-pill { font-size: 0.55rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px; letter-spacing: 0.5px; }
</style>

<div class="row g-4 mb-5">
    <!-- Header -->
    <div class="col-lg-8">
        <h1 class="h1 fw-black text-dark mb-2">Reserva de Plazas Públicas</h1>
        <p class="text-muted lead opacity-75">Módulo de gestión municipal para ferias de emprendimiento y uso del espacio público.</p>
    </div>
    <div class="col-lg-4 text-end">
        <div class="card border-0 shadow-sm p-4 rounded-4 bg-white text-start">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="h6 fw-bold text-dark mb-0">Créditos Disponibles</p>
                <p class="h4 fw-black text-primary mb-0">14</p>
            </div>
            <div class="progress mb-2" style="height: 6px; border-radius: 10px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.55rem; letter-spacing: 1px;">Asignación mensual vigente</p>
        </div>
    </div>

    <!-- Tabs Navegación -->
    <div class="col-12">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end border-bottom gap-4 mt-4">
            <div class="d-flex gap-4 overflow-auto pb-0">
                <a href="#" class="text-decoration-none border-bottom border-primary border-4 pb-3 px-3 text-primary fw-black small text-uppercase">Esta Semana</a>
                <a href="#" class="text-decoration-none border-bottom border-transparent border-4 pb-3 px-3 text-muted fw-bold small text-uppercase hover-primary">Próxima Semana</a>
                <a href="#" class="text-decoration-none border-bottom border-transparent border-4 pb-3 px-3 text-muted fw-bold small text-uppercase hover-primary">Calendario Mensual</a>
            </div>
            <div class="d-flex gap-2 pb-3 px-3">
                <button class="btn btn-white border-light border-2 text-dark fw-bold rounded-3 px-4 py-2 d-flex align-items-center gap-2 shadow-sm small">
                    <?php echo getIcon('map', '', ['width'=>16]); ?> Ver Mapa
                </button>
                <button class="btn btn-white border-light border-2 text-dark rounded-3 p-2 shadow-sm">
                    <?php echo getIcon('filter', '', ['width'=>16]); ?>
                </button>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="col-lg-8">
        <div class="vstack gap-4">
            <!-- Header Tabla -->
            <div class="row g-2 px-4 text-uppercase text-muted fw-bold" style="font-size: 0.6rem; letter-spacing: 1px;">
                <div class="col-4">Espacio / Plaza</div>
                <div class="col text-center">Lun 23</div>
                <div class="col text-center">Mar 24</div>
                <div class="col text-center">Mié 25</div>
                <div class="col text-center">Jue 26</div>
                <div class="col text-center">Vie 27</div>
                <div class="col text-center">Sáb 28</div>
            </div>

            <!-- Fila 1 -->
            <div class="card border-0 shadow-sm p-3 rounded-4 plaza-card">
                <div class="row g-2 align-items-center">
                    <div class="col-4 d-flex align-items-center gap-3">
                        <div class="rounded-4 overflow-hidden bg-center bg-cover flex-shrink-0" style="width: 50px; height: 50px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBY0el0uftkNayKlDZ-a_AIVD-QIjUsjRKwXzeCqLCLAfP51_3C_dBqtDhz0gc-wjl2fNu2bxUjvFS_60x4I9kl-TT36BO-iMHG23X31HaP_n-qB2wfPmti2yiQDlVIWYoIyRrveI6BQ6jNQVdP567RYOn4bPG1xGgK8cAkec-lBH0VDLV1_4_4rbwab9TD5yu9P9N0G6ymDfgQFfPVsnMrAnj12mAsnKT5ohq-3bDrbBXOiGdnoB_LMdaCTgqsqjKTGCxvkZ5rVMzz');"></div>
                        <div>
                            <p class="fw-bold text-dark mb-0 small">Plaza Mayor</p>
                            <span class="text-muted" style="font-size: 0.65rem;">Cap: 12 Puestos</span>
                        </div>
                    </div>
                    <div class="col"><div class="day-slot available"><?php echo getIcon('check', '', ['width'=>20]); ?></div></div>
                    <div class="col"><div class="day-slot blocked"><?php echo getIcon('slash', '', ['width'=>20]); ?></div></div>
                    <div class="col"><div class="day-slot selected shadow-lg"><?php echo getIcon('calendar-check', '', ['width'=>20]); ?></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                </div>
            </div>

            <!-- Fila 2 -->
            <div class="card border-0 shadow-sm p-3 rounded-4 plaza-card">
                <div class="row g-2 align-items-center">
                    <div class="col-4 d-flex align-items-center gap-3">
                        <div class="rounded-4 overflow-hidden bg-center bg-cover flex-shrink-0" style="width: 50px; height: 50px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCtFfw5xw-DyWyhxeNYurpkRU8ZZ3-X3mPYIVyRlIASMbCnq6XsJBwZWS_942LgMAn6IPT2eznoREV_shOckVClQq3dCLgYm-CDKl4yzvARhrDZLaSrheGAglzfQTiXqjEL0Hfs2YFv47u72vHI4SJziLoQxYUCs9qE3_vNIQdPCUnSYoHsXRAFoRhxDXHuaq9z5wlSh0SB5632NKzXmSEehQgruBEA5iBdQe0v2BHE_UWxKDAMoOCB0MfrjrANGJIA_XsQkDhpmhI0');"></div>
                        <div>
                            <p class="fw-bold text-dark mb-0 small">Parque Central</p>
                            <span class="text-muted" style="font-size: 0.65rem;">Cap: 25 Puestos</span>
                        </div>
                    </div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot blocked"><?php echo getIcon('lock', '', ['width'=>20]); ?></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                </div>
            </div>

             <!-- Fila 3 -->
             <div class="card border-0 shadow-sm p-3 rounded-4 plaza-card">
                <div class="row g-2 align-items-center">
                    <div class="col-4 d-flex align-items-center gap-3">
                        <div class="rounded-4 overflow-hidden bg-center bg-cover flex-shrink-0" style="width: 50px; height: 50px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDDh8aQYJq45c_qkloERf0p3HO8Ay3g3w-OolpYLN1xsJ_6IMDQOkYEjdirW9usb6OsI4k8ggaBe2YcJPA6MnDCNbss1fd9y6FfFdUl0mcMNGNutvRXf492PMEKqH0DwwjQAnUwG2AetD5Uylymi8AR0XF8WMfV2Vcg_UTZUjW-s7zuePXYDZMMQJ4MmzmLAWH-GzQo3-Fnr42S7O2_3YymvVgLjBpgd0HAsOlrqxXUG0hxfKfuVVaVQ4_YrrRiQetXdJtcmr30FJQ5');"></div>
                        <div>
                            <p class="fw-bold text-dark mb-0 small">Centro Cultural</p>
                            <span class="text-muted" style="font-size: 0.65rem;">Cap: 8 Puestos</span>
                        </div>
                    </div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                    <div class="col"><div class="day-slot"></div></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen Reserva Sidebar -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-lg p-4 rounded-5 sticky-top overflow-hidden" style="top: 100px;">
            <div class="p-3 mb-4 bg-primary text-white rounded-4 d-inline-flex shadow shadow-primary-500/10">
                <?php echo getIcon('shopping-cart', '', ['width'=>24]); ?>
            </div>
            <h3 class="h5 fw-black text-dark mb-4">Resumen de Reserva</h3>
            
            <div class="vstack gap-4 mb-5 pb-4 border-bottom">
                <div class="space-y-1">
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.55rem; letter-spacing: 1px;">Espacio Seleccionado</p>
                    <p class="fw-bold text-dark mb-0">Plaza Mayor - Zona A</p>
                </div>
                <div class="space-y-1">
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.55rem; letter-spacing: 1px;">Fecha y Horario</p>
                    <p class="fw-bold text-dark mb-0">Miércoles, 25 Oct 2023</p>
                    <p class="small text-muted mb-0">08:00 AM - 06:00 PM</p>
                </div>
            </div>

            <div class="vstack gap-2 mb-4">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <span class="small fw-semibold text-muted">Costo de Reserva</span>
                    <span class="fw-black text-primary">7 Créditos</span>
                </div>
                <div class="d-flex justify-content-between align-items-center py-2">
                    <span class="small fw-semibold text-muted">Nuevo Balance</span>
                    <span class="fw-black text-dark">7 Créditos</span>
                </div>
            </div>

            <button class="btn btn-primary btn-lg w-100 rounded-4 py-3 fw-black shadow-lg shadow-primary-500/20 d-flex align-items-center justify-content-center gap-2 border-0 mb-4">
                Confirmar Reserva <span class="opacity-75 small font-normal">(7 Créditos)</span>
            </button>

            <div class="bg-primary-light border border-primary border-opacity-10 p-3 rounded-4">
                <div class="d-flex gap-2">
                    <div class="text-primary"><?php echo getIcon('info', '', ['width'=>18]); ?></div>
                    <p class="small text-primary mb-0 lh-base fw-medium opacity-75">Esta reserva requiere 24h de antelación para cancelación. Los créditos se reembolsan según reglas BPMN.</p>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 rounded-4 mt-4">
            <h6 class="fw-bold text-dark text-uppercase mb-4" style="font-size: 0.6rem; letter-spacing: 1px;">Leyenda</h6>
            <div class="vstack gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="day-slot selected shadow-none m-0" style="width: 24px; height: 24px;"></div>
                    <span class="small text-muted fw-medium">Seleccionado</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="day-slot blocked shadow-none m-0 opacity-50" style="width: 24px; height: 24px;"></div>
                    <span class="small text-muted fw-medium">Bloqueado por Regla</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="day-slot available shadow-none m-0 opacity-50" style="width: 24px; height: 24px;"></div>
                    <span class="small text-muted fw-medium">Ya Reservado</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
