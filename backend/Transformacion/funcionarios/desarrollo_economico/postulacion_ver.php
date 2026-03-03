<?php 
$pageTitle = "Detalle de Postulación - Desarrollo Económico";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php'; 

// Datos mock de la postulación
$postulacion = [
    "folio" => "POST-2024-045",
    "nombre_proyecto" => "Talleres Culturales 2024 - Sector Bosquemar",
    "organizacion" => "Centro Cultural El Bosque",
    "rut" => "76.234.567-8",
    "tipo_fondo" => "Regional",
    "monto_solicitado" => 3200000,
    "fecha_ingreso" => "2024-04-20",
    "estado" => "En Evaluación",
    "descripcion" => "Fortalecimiento de la identidad local a través de talleres de música y danza para jóvenes.",
    "historial" => [
        ["fecha" => "2024-04-20 09:15", "accion" => "Ingreso de la postulación", "usuario" => "Sistema Online"],
        ["fecha" => "2024-04-21 14:30", "accion" => "Validación de documentos - OK", "usuario" => "M. González"],
        ["fecha" => "2024-04-25 10:00", "accion" => "Asignado a Comisión Técnica", "usuario" => "J. Pérez"]
    ]
];
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
                    "gob-danger": "#ef4444"
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

    <!-- Header / Action Bar -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <div class="flex items-center gap-3">
                <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight"><?= $postulacion['folio'] ?></h1>
                <span class="bg-amber-100 text-amber-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-amber-200"><?= $postulacion['estado'] ?></span>
            </div>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium tracking-wider"><?= $postulacion['nombre_proyecto'] ?></p>
        </div>
        <div class="flex gap-2">
            <button id="btnAprobar" class="bg-gob-success hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-emerald-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">check_circle</span> APROBAR
            </button>
            <button id="btnRechazar" class="bg-gob-danger hover:bg-rose-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-rose-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">cancel</span> RECHAZAR
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Detail Container -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white gob-card rounded-3xl p-8 space-y-8">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest border-b border-slate-100 pb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-blue">info</span> Detalles del Proyecto
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Organización</label>
                            <p class="text-base font-black text-slate-800 tracking-tight"><?= $postulacion['organizacion'] ?></p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">RUT Receptor</label>
                            <p class="text-base font-bold text-primary-blue"><?= $postulacion['rut'] ?></p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Fondo Solicitado</label>
                            <p class="text-base font-black text-slate-800"><?= $postulacion['tipo_fondo'] ?></p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Monto Estimado</label>
                            <p class="text-xl font-black text-emerald-600">$<?= number_format($postulacion['monto_solicitado'], 0, ',', '.') ?></p>
                        </div>
                    </div>
                </div>

                <div class="space-y-2 pt-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Descripción Técnica</label>
                    <p class="text-sm text-slate-600 italic leading-relaxed bg-slate-50 p-6 rounded-2xl border border-slate-100"><?= $postulacion['descripcion'] ?></p>
                </div>
                
                <div class="space-y-4 pt-6">
                    <h4 class="text-[11px] font-black text-slate-800 uppercase tracking-widest">Archivos Adjuntos (Digital)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3 p-4 rounded-xl border border-slate-100 hover:border-primary-blue hover:bg-blue-50/50 cursor-pointer transition-all">
                            <span class="material-symbols-outlined text-rose-500 text-3xl">picture_as_pdf</span>
                            <div class="flex-1">
                                <p class="text-xs font-black text-slate-800">Formulario_Tecnico.pdf</p>
                                <p class="text-[10px] text-slate-400 uppercase tracking-widest">2.4 MB</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-4 rounded-xl border border-slate-100 hover:border-primary-blue hover:bg-blue-50/50 cursor-pointer transition-all">
                            <span class="material-symbols-outlined text-rose-500 text-3xl">picture_as_pdf</span>
                            <div class="flex-1">
                                <p class="text-xs font-black text-slate-800">Presupuesto_Detallado.pdf</p>
                                <p class="text-[10px] text-slate-400 uppercase tracking-widest">1.1 MB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline / History Sidebar -->
        <div class="space-y-6">
            <div class="bg-white gob-card rounded-3xl p-8 space-y-6">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-blue">list_alt</span> Historial de Estados
                </h3>
                <div class="relative pl-6 space-y-6 before:content-[''] before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-px before:bg-slate-100">
                    <?php foreach ($postulacion['historial'] as $h): ?>
                    <div class="relative">
                        <div class="absolute -left-[20px] top-1.5 size-3 rounded-full bg-primary-blue/30 border-2 border-primary-blue shadow-sm"></div>
                        <div class="space-y-0.5">
                            <p class="text-xs font-black text-slate-800 leading-tight"><?= $h['accion'] ?></p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest"><?= $h['fecha'] ?></p>
                            <p class="text-[10px] text-primary-blue font-bold uppercase italic mt-1">Por: <?= $h['usuario'] ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Notas de la Evaluación -->
            <div class="bg-blue-50 border border-blue-100 rounded-3xl p-8 space-y-4">
                <h4 class="text-[10px] font-black text-primary-blue uppercase tracking-widest">Observaciones Comisión</h4>
                <textarea class="w-full bg-white rounded-2xl border-blue-100 text-sm italic font-black text-blue-800 p-4 focus:ring-primary-blue" rows="4" placeholder="Escriba sus observaciones técnicas aquí..."></textarea>
                <button class="w-full py-3 bg-primary-blue text-white rounded-xl font-black text-[10px] uppercase tracking-widest">GUARDAR OBSERVACIÓN</button>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#btnAprobar').click(function () {
            Swal.fire({
                title: '¿Confirmar Aprobación?',
                text: "Se notificará a la organización seleccionada sobre el cambio de estado.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'SÍ, APROBAR',
                cancelButtonText: 'ATRÁS'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('¡Éxito!', 'La postulación ha sido aprobada técnicamente.', 'success');
                }
            });
        });

        $('#btnRechazar').click(function () {
            Swal.fire({
                title: '¿Confirmar Rechazo?',
                text: "Es obligatorio incluir el motivo del rechazo en las observaciones.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'SÍ, RECHAZAR',
                cancelButtonText: 'ATRÁS'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Procesado', 'La postulación ha sido rechazada.', 'error');
                }
            });
        });
    });
</script>

<?php include '../../api/general/footer.php'; ?>