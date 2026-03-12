</div> 

<footer class="footer mt-auto py-5 bg-white border-top">
    <div class="container-fluid px-4 px-lg-6">
        <div class="row g-4 text-center text-md-start">
            <!-- Columna 1: Ayuda -->
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-3 justify-content-center justify-content-md-start">
                    <span class="material-symbols-outlined text-primary-blue">help_center</span>
                    <h6 class="text-uppercase fw-bold text-slate-800 mb-0 tracking-wider">Centro de Ayuda</h6>
                </div>
                <ul class="list-unstyled space-y-2">
                    <li><a href="#" class="text-slate-500 text-decoration-none small hover-blue d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                        <span class="material-symbols-outlined fs-6">menu_book</span> Guías de usuario</a></li>
                    <li><a href="#" class="text-slate-500 text-decoration-none small hover-blue d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                        <span class="material-symbols-outlined fs-6">video_library</span> Video tutoriales</a></li>
                    <li><a href="#" class="text-slate-500 text-decoration-none small hover-blue d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                        <span class="material-symbols-outlined fs-6">fact_check</span> Preguntas frecuentes</a></li>
                </ul>
            </div>
            
            <!-- Columna 2: Soporte -->
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-3 justify-content-center justify-content-md-start">
                    <span class="material-symbols-outlined text-primary-blue">support_agent</span>
                    <h6 class="text-uppercase fw-bold text-slate-800 mb-0 tracking-wider">Soporte Técnico</h6>
                </div>
                <ul class="list-unstyled space-y-2">
                    <li class="text-slate-500 small d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                        <span class="material-symbols-outlined fs-6 text-slate-400">mail</span> soporte@munivina.cl</li>
                    <li class="text-slate-500 small d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                        <span class="material-symbols-outlined fs-6 text-slate-400">schedule</span> Lunes a Viernes: 08:30 - 17:30</li>
                    <li class="text-slate-400 x-small mt-2 text-center text-md-start">Sistema Municipal Unificado &copy; 2026 ● v1.0.4</li>
                </ul>
            </div>
            
            <!-- Columna 3: Feedback -->
            <div class="col-md-4 text-md-end">
                <div class="d-flex align-items-center gap-2 mb-3 justify-content-center justify-content-md-end">
                    <span class="material-symbols-outlined text-rose-500">bug_report</span>
                    <h6 class="text-uppercase fw-bold text-slate-800 mb-0 tracking-wider">Feedback</h6>
                </div>
                <button type="button" class="btn btn-outline-danger btn-sm rounded-xl px-4 py-2 fw-bold transition-all hover-scale" data-bs-toggle="modal" data-bs-target="#modalReportarProblema">
                    REPORTAR UN PROBLEMA
                </button>
            </div>
        </div>
    </div>
</footer>

<!-- Modal Reportar Problema -->
<div class="modal fade" id="modalReportarProblema" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-rose-500 text-white border-0 py-4 px-5">
                <h5 class="modal-title d-flex align-items-center gap-3 fw-bold">
                    <span class="material-symbols-outlined">report</span> Reportar un Problema
                </h5>
                <button type="button" class="btn-close btn-close-white opacity-75" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <p class="text-slate-500 small mb-4 font-medium">
                    ¿Algo no funciona como debería? Descríbelo aquí. Nuestro equipo recibirá este reporte junto con la URL de la página donde te encuentras para investigar el error.
                </p>
                <form id="formReportarProblema">
                    <div class="mb-0">
                        <label for="reporte_problema" class="form-label fw-bold small text-slate-700 uppercase tracking-wider mb-2">Descripción del problema</label>
                        <textarea class="form-control rounded-2xl border-slate-200 bg-slate-50 focus-ring-primary p-3" 
                            id="reporte_problema" rows="4" 
                            placeholder="Ej: No se cargan las solicitudes pendientes, el botón de guardar no responde..." 
                            required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 p-5 pt-0 gap-3">
                <button type="button" class="btn btn-light rounded-xl px-4 py-2.5 text-slate-500 fw-bold border-0" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-rose-500 text-white rounded-xl px-4 py-2.5 fw-bold shadow-lg shadow-rose-200" id="btnEnviarReporte">
                    <span class="d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">send</span> Enviar Reporte
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-blue:hover { color: #1a5f9c !important; }
    .btn-rose-500 { background-color: #f43f5e; }
    .btn-rose-500:hover { background-color: #e11d48; }
    .shadow-rose-200 { box-shadow: 0 10px 15px -3px rgba(244, 63, 94, 0.2); }
    .focus-ring-primary:focus { border-color: #1a5f9c; box-shadow: 0 0 0 4px rgba(26, 95, 156, 0.1); }
    .x-small { font-size: 0.65rem; }
    .hover-scale:hover { transform: translateY(-2px); }
</style>

</main> <div id="sidebar-overlay"></div>

</div> <script src="<?php echo $pathPrefix; ?>recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (function_exists('renderLayoutScripts'))
    renderLayoutScripts($pathPrefix); ?>

<script>
    if (window.feather) feather.replace();

    // Sidebar Toggle Logic
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar-container');
        const overlay = document.getElementById('sidebar-overlay');

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show-mobile');
                    overlay.classList.toggle('show');
                } else {
                    sidebar.classList.toggle('collapsed');
                }
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show-mobile');
                overlay.classList.remove('show');
            });
        }

        // Logic for Reporting Problem
        const btnEnviarReporte = document.getElementById('btnEnviarReporte');
        if (btnEnviarReporte) {
            btnEnviarReporte.addEventListener('click', async () => {
                const textarea = document.getElementById('reporte_problema');
                const problema = textarea.value.trim();
                
                if (!problema) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campo Requerido',
                        text: 'Por favor, describe el problema antes de enviar.',
                        confirmButtonColor: '#f43f5e'
                    });
                    return;
                }

                // UI Loading state
                btnEnviarReporte.disabled = true;
                btnEnviarReporte.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Enviando...';

                try {
                    const response = await fetch('<?php echo $pathPrefix; ?>api/general/report_problem.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            problema: problema,
                            url: window.location.href
                        })
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Reporte Enviado',
                            text: 'Muchas gracias. El equipo de soporte ha sido notificado.',
                            confirmButtonColor: '#1a5f9c'
                        });
                        // Close modal & reset
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalReportarProblema'));
                        modal.hide();
                        textarea.value = '';
                    } else {
                        throw new Error(result.message || 'Error desconocido');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al enviar',
                        text: 'No pudimos enviar tu reporte en este momento. Inténtalo más tarde o escribe directamente a soporte@munivina.cl.',
                        confirmButtonColor: '#f43f5e'
                    });
                    console.error('Error reporting problem:', error);
                } finally {
                    btnEnviarReporte.disabled = false;
                    btnEnviarReporte.innerHTML = '<span class="d-flex align-items-center gap-2"><span class="material-symbols-outlined text-[18px]">send</span> Enviar Reporte</span>';
                }
            });
        }
    });
</script>
</body>
</html>