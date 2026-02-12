<?php

include("../../include/header-usuarios.php");
?>
<form action="registro_guardar.php" method="POST" enctype="multipart/form-data">

<main class="flex-1 max-w-[1024px] mx-auto w-full py-10 px-6">
    <div class="mb-10">
        <div class="flex justify-between items-end mb-6 px-2">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">Registro de Emprendedor</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Siga los pasos para formalizar su actividad en la comuna.</p>
            </div>
            <div class="text-right">
                <span class="text-sm font-semibold text-primary" id="step-indicator-text">Paso 1 de 4</span>
                <p class="text-xs text-gray-400 font-medium" id="step-next-text">Siguiente: Datos del Negocio</p>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="relative mb-8">
            <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 dark:bg-gray-800 -translate-y-1/2 rounded-full overflow-hidden">
                <div class="bg-primary h-full transition-all duration-500" style="width: 25%;" id="progress-bar"></div>
            </div>
            <div class="relative flex justify-between">
                <!-- Step 1 Indicator -->
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold ring-4 ring-white dark:ring-background-dark step-circle transition-colors duration-300" data-step="1">1</div>
                    <span class="text-[10px] font-bold mt-2 uppercase text-primary step-label transition-colors duration-300" data-step="1">Categoría</span>
                </div>
                <!-- Step 2 Indicator -->
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-gray-200 dark:bg-gray-800 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold ring-4 ring-white dark:ring-background-dark step-circle transition-colors duration-300" data-step="2">2</div>
                    <span class="text-[10px] font-bold mt-2 uppercase text-gray-400 step-label transition-colors duration-300" data-step="2">Negocio</span>
                </div>
                <!-- Step 3 Indicator -->
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-gray-200 dark:bg-gray-800 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold ring-4 ring-white dark:ring-background-dark step-circle transition-colors duration-300" data-step="3">3</div>
                    <span class="text-[10px] font-bold mt-2 uppercase text-gray-400 step-label transition-colors duration-300" data-step="3">Solicitante</span>
                </div>
                <!-- Step 4 Indicator -->
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-gray-200 dark:bg-gray-800 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold ring-4 ring-white dark:ring-background-dark step-circle transition-colors duration-300" data-step="4">4</div>
                    <span class="text-[10px] font-bold mt-2 uppercase text-gray-400 step-label transition-colors duration-300" data-step="4">Documentos</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden min-h-[400px]">
        
        <!-- STEP 1: Categoría -->
        <div class="p-8 step-content block" id="step-content-1">
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-2">
                    <h2 class="text-2xl font-bold">1. Seleccione Categoría</h2>
                    <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">Obligatorio</span>
                </div>
                <p class="text-gray-500 dark:text-gray-400">Elija el rubro principal de su emprendimiento.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Option 1 -->
                <label class="group cursor-pointer border-2 border-transparent bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 transition-all hover:border-primary/50 hover:bg-primary/5 relative overflow-hidden has-[:checked]:border-primary has-[:checked]:bg-primary/5 category-card">
                    <input type="radio" name="categoria" value="alimentos" class="hidden peer" checked>
                    <div class="absolute top-3 right-3 text-primary opacity-0 peer-checked:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors peer-checked:bg-primary peer-checked:text-white">
                        <span class="material-symbols-outlined text-2xl">restaurant</span>
                    </div>
                    <h3 class="font-bold text-lg mb-1">Alimentos</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Comida preparada, snacks, productos orgánicos.</p>
                </label>
                
                <!-- Option 2 -->
                <label class="group cursor-pointer border-2 border-transparent bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 transition-all hover:border-primary/50 hover:bg-primary/5 relative overflow-hidden has-[:checked]:border-primary has-[:checked]:bg-primary/5 category-card">
                    <input type="radio" name="categoria" value="artesania" class="hidden peer">
                    <div class="absolute top-3 right-3 text-primary opacity-0 peer-checked:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors peer-checked:bg-primary peer-checked:text-white">
                        <span class="material-symbols-outlined text-2xl">brush</span>
                    </div>
                    <h3 class="font-bold text-lg mb-1">Artesanía</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Manualidades, cerámica, orfebrería.</p>
                </label>

                <!-- Option 3 -->
                <label class="group cursor-pointer border-2 border-transparent bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 transition-all hover:border-primary/50 hover:bg-primary/5 relative overflow-hidden has-[:checked]:border-primary has-[:checked]:bg-primary/5 category-card">
                    <input type="radio" name="categoria" value="textil" class="hidden peer">
                    <div class="absolute top-3 right-3 text-primary opacity-0 peer-checked:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors peer-checked:bg-primary peer-checked:text-white">
                        <span class="material-symbols-outlined text-2xl">checkroom</span>
                    </div>
                    <h3 class="font-bold text-lg mb-1">Textil & Moda</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Ropa, tejidos, accesorios.</p>
                </label>

                <!-- Option 4 -->
                <label class="group cursor-pointer border-2 border-transparent bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 transition-all hover:border-primary/50 hover:bg-primary/5 relative overflow-hidden has-[:checked]:border-primary has-[:checked]:bg-primary/5 category-card">
                    <input type="radio" name="categoria" value="servicios" class="hidden peer">
                    <div class="absolute top-3 right-3 text-primary opacity-0 peer-checked:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors peer-checked:bg-primary peer-checked:text-white">
                        <span class="material-symbols-outlined text-2xl">design_services</span>
                    </div>
                    <h3 class="font-bold text-lg mb-1">Servicios</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Diseño, consultoría, peluquería, gasfitería.</p>
                </label>

                <!-- Option 5 -->
                <label class="group cursor-pointer border-2 border-transparent bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 transition-all hover:border-primary/50 hover:bg-primary/5 relative overflow-hidden has-[:checked]:border-primary has-[:checked]:bg-primary/5 category-card">
                    <input type="radio" name="categoria" value="comercio" class="hidden peer">
                    <div class="absolute top-3 right-3 text-primary opacity-0 peer-checked:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors peer-checked:bg-primary peer-checked:text-white">
                        <span class="material-symbols-outlined text-2xl">storefront</span>
                    </div>
                    <h3 class="font-bold text-lg mb-1">Comercio</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Bazar, abarrotes, venta de artículos.</p>
                </label>

                <!-- Option 6 -->
                <label class="group cursor-pointer border-2 border-transparent bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 transition-all hover:border-primary/50 hover:bg-primary/5 relative overflow-hidden has-[:checked]:border-primary has-[:checked]:bg-primary/5 category-card">
                    <input type="radio" name="categoria" value="tecnologia" class="hidden peer">
                    <div class="absolute top-3 right-3 text-primary opacity-0 peer-checked:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors peer-checked:bg-primary peer-checked:text-white">
                        <span class="material-symbols-outlined text-2xl">devices</span>
                    </div>
                    <h3 class="font-bold text-lg mb-1">Tecnología</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Reparación, desarrollo, insumos.</p>
                </label>
            </div>
        </div>

        <!-- STEP 2: Datos del Negocio -->
        <div class="p-8 step-content hidden" id="step-content-2">
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-2">
                    <h2 class="text-2xl font-bold">2. Datos del Negocio</h2>
                    <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">Obligatorio</span>
                </div>
                <p class="text-gray-500 dark:text-gray-400">Complete la ficha pública de su emprendimiento.</p>
            </div>

            <div class="max-w-2xl mx-auto space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">RUT Empresa</label>
                        <input name="rut_empresa" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all font-medium" placeholder="76.123.456-7" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Nombre de Fantasía</label>
                        <input name="nombre_empresa" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all font-medium" placeholder="Ej: Panadería Los Andes" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Descripción / Presentación</label>
                    <textarea name="descripcion" rows="4" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all font-medium resize-none" placeholder="Describa brevemente su negocio, sus productos y qué lo hace único..."></textarea>
                </div>

                <!-- Logo Section Corrected Alignment -->
                <div class="flex flex-col md:flex-row items-center justify-between p-4 border-2 border-dashed border-primary/30 rounded-xl bg-primary/5 gap-4">
                    <div class="flex items-center gap-4">
                        <div class="bg-primary/20 text-primary p-3 rounded-lg">
                            <span class="material-symbols-outlined">image</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm">Logo del Negocio</h4>
                            <p class="text-xs text-gray-500">Formato JPG o PNG, máx 2MB</p>
                        </div>
                    </div>
                    <label class="cursor-pointer bg-primary text-white px-5 py-2 rounded-lg text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all shadow-sm">
                        <span class="material-symbols-outlined text-base">cloud_upload</span>
                        SUBIR IMAGEN
                        <input type="file" name="logo" class="hidden" accept="image/*">
                    </label>
                </div>

            </div>
        </div>

        <!-- STEP 3: Datos del Solicitante -->
        <div class="p-8 step-content hidden" id="step-content-3">
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-2">
                    <h2 class="text-2xl font-bold">3. Datos del Solicitante</h2>
                    <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">Obligatorio</span>
                </div>
                <p class="text-sm text-gray-500 mb-6">Información de contacto y validación de identidad.</p>
            </div>

            <div class="max-w-2xl mx-auto space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Nombre Completo</label>
                    <input name="nombre" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all font-medium" placeholder="Nombre y Apellido"/>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Correo Electrónico</label>
                        <input name="correo" type="email" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all font-medium" placeholder="correo@ejemplo.cl"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Teléfono</label>
                        <input name="telefono" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all font-medium" placeholder="+56 9 1234 5678"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Organización (Opcional)</label>
                    <input name="organizacion" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all font-medium" placeholder="Junta de Vecinos, Asociación, etc."/>
                </div>
                 <div>
                    <label class="block text-xs font-bold text-gray-400 mb-1 uppercase">Clave de Acceso</label>
                    <input name="clave" type="password" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all font-medium" placeholder="••••••••"/>
                </div>
            </div>
        </div>

        <!-- STEP 4: Documentos -->
        <div class="p-8 step-content hidden" id="step-content-4">
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-1">
                    <h2 class="text-2xl font-bold">4. Carga de Documentos</h2>
                    <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">Obligatorio</span>
                </div>
                <p class="text-sm text-gray-500">Adjunte los documentos requeridos para finalizar.</p>
            </div>

            <div class="max-w-2xl mx-auto space-y-4">
                <!-- Doc 1 -->
                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-900">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 dark:bg-green-900/30 text-green-600 p-2 rounded-lg">
                            <span class="material-symbols-outlined">description</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm">Cédula de Identidad</h4>
                            <p class="text-xs text-gray-400">cedula_identidad_final.pdf • 1.2MB</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                         <span class="text-[10px] font-bold text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded border border-green-100 dark:border-green-900/30">CARGADO</span>
                    </div>
                </div>

                 <!-- Doc 2 -->
                <div class="flex items-center justify-between p-4 border-2 border-dashed border-primary/30 rounded-xl bg-primary/5">
                    <div class="flex items-center gap-4">
                        <div class="bg-primary/20 text-primary p-2 rounded-lg">
                            <span class="material-symbols-outlined">health_and_safety</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm">Resolución Sanitaria</h4>
                            <p class="text-xs text-gray-500">Requerido para Alimentos</p>
                        </div>
                    </div>
                    <label class="cursor-pointer">
                        <span class="bg-white text-primary px-3 py-1.5 rounded border border-gray-200 text-xs font-bold hover:bg-gray-50">EXAMINAR</span>
                         <input type="file" name="doc_seremi" class="hidden">
                    </label>
                </div>
            </div>
        </div>

        <!-- Footer Control -->
        <div class="p-6 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center">
            <button type="button" id="prev-btn" class="px-6 py-2.5 rounded-lg text-sm font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all invisible">
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    Anterior
                </div>
            </button>
            
            <button type="button" id="next-btn" class="px-8 py-2.5 rounded-lg text-sm font-bold bg-primary text-white hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                Siguiente
                <span class="material-symbols-outlined text-lg">arrow_forward</span>
            </button>

            <a href="reservar.php" id="submit-btn" class="hidden px-8 py-2.5 rounded-lg text-sm font-bold bg-green-600 text-white hover:bg-green-700 transition-all shadow-lg shadow-green-600/20 flex items-center gap-2">
                Finalizar Registro
                <span class="material-symbols-outlined text-lg">check</span>
            </a>
        </div>

    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nextBtn = document.getElementById('next-btn');
            const prevBtn = document.getElementById('prev-btn');
            const submitBtn = document.getElementById('submit-btn');
            const progressBar = document.getElementById('progress-bar');
            const stepIndicatorText = document.getElementById('step-indicator-text');
            const stepNextText = document.getElementById('step-next-text');
            
            let currentStep = 1;
            const totalSteps = 4;
            
            const stepTitles = [
                "Siguiente: Datos del Negocio",
                "Siguiente: Datos del Solicitante",
                "Siguiente: Documentos",
                "Finalizar"
            ];

            function updateUI() {
                // Update step content
                document.querySelectorAll('.step-content').forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('block');
                });
                document.getElementById(`step-content-${currentStep}`).classList.remove('hidden');
                document.getElementById(`step-content-${currentStep}`).classList.add('block');

                // Update progress bar
                progressBar.style.width = `${(currentStep / totalSteps) * 100}%`;

                // Update indicators
                document.querySelectorAll('.step-circle').forEach(circle => {
                    const step = parseInt(circle.dataset.step);
                    if (step < currentStep) {
                        circle.classList.remove('bg-gray-200', 'dark:bg-gray-800', 'text-gray-500', 'bg-primary');
                        circle.classList.add('bg-green-500', 'text-white');
                        circle.innerHTML = '<span class="material-symbols-outlined text-xs">check</span>';
                    } else if (step === currentStep) {
                        circle.classList.remove('bg-gray-200', 'dark:bg-gray-800', 'text-gray-500', 'bg-green-500');
                        circle.classList.add('bg-primary', 'text-white');
                        circle.innerHTML = step;
                    } else {
                        circle.classList.remove('bg-primary', 'bg-green-500', 'text-white');
                        circle.classList.add('bg-gray-200', 'dark:bg-gray-800', 'text-gray-500');
                        circle.innerHTML = step;
                    }
                });

                document.querySelectorAll('.step-label').forEach(label => {
                    const step = parseInt(label.dataset.step);
                    if (step <= currentStep) {
                        label.classList.remove('text-gray-400');
                        label.classList.add('text-primary');
                    } else {
                        label.classList.remove('text-primary');
                        label.classList.add('text-gray-400');
                    }
                });

                // Update text
                stepIndicatorText.innerText = `Paso ${currentStep} de ${totalSteps}`;
                stepNextText.innerText = stepTitles[currentStep - 1];

                // Update buttons
                if (currentStep === 1) {
                    prevBtn.classList.add('invisible');
                } else {
                    prevBtn.classList.remove('invisible');
                }

                if (currentStep === totalSteps) {
                    nextBtn.classList.add('hidden');
                    submitBtn.classList.remove('hidden');
                } else {
                    nextBtn.classList.remove('hidden');
                    submitBtn.classList.add('hidden');
                }
                
                // Scroll to top of form
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            nextBtn.addEventListener('click', () => {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateUI();
                }
            });

            prevBtn.addEventListener('click', () => {
                if (currentStep > 1) {
                    currentStep--;
                    updateUI();
                }
            });

            // Initialize
            updateUI();
        });
    </script>
<?php include("../include/footer-usuarios.php"); ?>
