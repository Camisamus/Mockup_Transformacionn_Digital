// Logic for Solicitud Única de Patentes Multi-Trámite

document.addEventListener('DOMContentLoaded', () => {

    const elements = {
        // Steps
        step1: document.getElementById('step1_Section'),
        step2: document.getElementById('step2_Section'),
        step3: document.getElementById('step3_Section'),

        // Containers
        tramitesContainer: document.getElementById('tramitesContainer'),
        preguntasContainer: document.getElementById('preguntasContainer'),
        contenedorSecciones: document.getElementById('contenedorSecciones'),

        // Buttons
        btnIrPaso2: document.getElementById('btnIrPaso2'),
        btnGenerar: document.getElementById('btnGenerarFormulario')
    };

    let tramiteData = [];
    let elementosData = [];
    let selectedTramites = []; // Array of tramite objects
    const mapInstances = {};

    // Group Title Mapping (New Schema)
    const friendlyGroups = {
        "Datos Contribuyente": "Identificación del Solicitante",
        "Identificación Tributaria": "Identificación Tributaria",
        "Dirección Comercial / Tributaria": "Domicilio Comercial",
        "Dirección Particular / Domicilio Postal Tributario": "Domicilio Postal / Particular",
        "Actividad Comercial": "Actividad Económica",
        "Patente": "Datos de la Patente",
        "Contacto y Firma": "Datos de Contacto",
        "Propaganda": "Declaración de Propaganda",
        "Capital Propio": "Declaración de Capital Propio",
        "Requisitos Comunes": "Documentación General",
        "Requisitos Inmueble/Domicilio": "Documentación Inmueble",
        "Requisitos Sanitarios/Operacionales": "Resoluciones Sanitarias",
        "Requisitos S.I.I.": "Antecedentes S.I.I."
    };

    // Initialize
    initApplication();

    function initApplication() {
        Promise.all([
            fetch('../recursos/jsons/categoria_patentes_mapeo_completo.json').then(r => r.json()),
            fetch('../recursos/jsons/formularios_elementos.json').then(r => r.json())
        ]).then(([tramitesResult, elementosResult]) => {
            // New Schema: tramitesResult has 'categorias' and 'tramites_detalle'
            if (tramitesResult.categorias && tramitesResult.tramites_detalle) {
                window.categoriasData = tramitesResult.categorias;
                tramiteData = tramitesResult.tramites_detalle;
            } else {
                // Fallback for old schema
                tramiteData = Array.isArray(tramitesResult) ? tramitesResult : tramitesResult.Maestro_Tramites;
            }
            elementosData = elementosResult;
            renderTramitesSelection();
            setupEventListeners();
            checkDrafts(); // Check for drafts on load
        }).catch(err => console.error('Error loading data:', err));
    }

    // --- Drafts Logic (Mock) ---
    function checkDrafts() {
        const section = document.getElementById('borradoresSection');
        const container = document.getElementById('borradoresContainer');
        const countSpan = document.getElementById('borradoresCount');

        // Mock Data
        const drafts = [
            { id: 101, date: '12/12/2025', desc: 'Solicitud Comercial + Alcoholes', step: 'Paso 2' },
            { id: 102, date: '10/12/2025', desc: 'Renovación Industrial', step: 'Paso 1' }
        ];

        if (drafts.length > 0 && section) {
            section.classList.remove('d-none');
            if (countSpan) countSpan.textContent = drafts.length;

            if (container) {
                container.innerHTML = '';
                drafts.forEach(d => {
                    const item = document.createElement('div');
                    item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3 border-0 border-bottom';
                    item.innerHTML = `
                        <div>
                            <h6 class="mb-1 text-primary fw-bold">${d.desc}</h6>
                            <small class="text-muted"><i data-feather="calendar" class="me-1" style="width:12px"></i>${d.date} &bull; Estado: ${d.step}</small>
                        </div>
                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="loadDraft(${d.id})">
                            Reanudar <i data-feather="arrow-right" class="ms-1" style="width:14px"></i>
                        </button>
                    `;
                    container.appendChild(item);
                });
                feather.replace();
            }
        }
    }

    window.loadDraft = function (id) {
        Swal.fire('Borrador', `Simulación: Cargando borrador ID ${id}. Los datos se pre-llenarían aquí.`, 'info');
    };

    function renderTramitesSelection() {
        elements.tramitesContainer.innerHTML = '';

        // Check if we have categorized data
        if (window.categoriasData && window.categoriasData.length > 0) {
            // Create a row to hold the 3 columns
            const mainRow = document.createElement('div');
            mainRow.className = 'row g-4';

            // Render categorized view - each category as a column
            window.categoriasData.forEach((categoria, catIndex) => {
                // Create category column
                const categoryCol = document.createElement('div');
                categoryCol.className = 'col-md-4';

                const categoryCard = document.createElement('div');
                categoryCard.className = 'card border-0 shadow-sm h-100';
                categoryCard.style.borderTop = `4px solid ${categoria.color}`;

                categoryCard.innerHTML = `
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 d-flex align-items-center" style="color: ${categoria.color};">
                            <i data-feather="${categoria.icono}" class="me-2" style="width: 24px; height: 24px;"></i>
                            ${categoria.nombre}
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush" id="cat_${catIndex}"></div>
                    </div>
                `;

                categoryCol.appendChild(categoryCard);
                mainRow.appendChild(categoryCol);

                const tramitesContainer = categoryCard.querySelector(`#cat_${catIndex}`);

                // Render tramites for this category as list items
                categoria.tramites.forEach((tramiteName, index) => {
                    const listItem = document.createElement('div');
                    listItem.className = 'list-group-item list-group-item-action border-0 py-3 tramite-list-item';
                    listItem.style.cursor = 'pointer';
                    listItem.style.transition = 'background-color 0.2s';
                    listItem.onclick = function (event) { toggleTramiteList(event, this); };

                    listItem.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input tramite-check" type="checkbox" value="${tramiteName}" id="t_${catIndex}_${index}">
                                <label class="form-check-label ms-2" style="cursor: pointer; font-size: 0.95rem; color: #495057;">
                                    ${tramiteName}
                                </label>
                            </div>
                            <i data-feather="chevron-right" style="width: 18px; height: 18px; color: #adb5bd;"></i>
                        </div>
                    `;
                    tramitesContainer.appendChild(listItem);
                });
            });

            elements.tramitesContainer.appendChild(mainRow);
        } else {
            // Fallback: render flat list (old schema)
            tramiteData.forEach((tramite, index) => {
                const col = document.createElement('div');
                col.className = 'col-md-4 col-sm-6';
                col.innerHTML = `
                    <div class="card h-100 border-0 shadow-sm tramite-card" style="cursor: pointer;" onclick="toggleTramite(event, this)">
                        <div class="card-body d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input tramite-check" type="checkbox" value="${tramite.tramite_base}" id="t_${index}">
                            </div>
                            <label class="form-check-label ms-2 fw-semibold" style="cursor: pointer;">
                                ${tramite.tramite_base}
                            </label>
                        </div>
                    </div>
                `;
                elements.tramitesContainer.appendChild(col);
            });
        }

        feather.replace();
    }

    // Helper for list item toggle
    window.toggleTramiteList = function (event, listItem) {
        const checkbox = listItem.querySelector('input[type="checkbox"]');

        // If the click target is NOT the checkbox itself, we manually toggle it
        if (event.target !== checkbox) {
            checkbox.checked = !checkbox.checked;
        }

        // Update visual style based on final state
        if (checkbox.checked) {
            listItem.style.backgroundColor = '#f8f9fa';
        } else {
            listItem.style.backgroundColor = '';
        }

        validateStep1();
    };

    // Helper exposed to click on card
    window.toggleTramite = function (event, card) {
        const checkbox = card.querySelector('input[type="checkbox"]');

        // If the click target is NOT the checkbox itself, we manually toggle it
        // This prevents double-toggling (native click + script click)
        if (event.target !== checkbox) {
            checkbox.checked = !checkbox.checked;
        }

        // Update visual style based on final state
        if (checkbox.checked) {
            card.classList.add('border-primary', 'bg-light');
            card.style.borderWidth = '2px';
        } else {
            card.classList.remove('border-primary', 'bg-light');
            card.style.borderWidth = '1px'; // Restore default border roughly or 0 if preferred
            card.style.border = ''; // Reset to css default
        }

        validateStep1();
    };

    function validateStep1() {
        const checked = document.querySelectorAll('.tramite-check:checked');
        elements.btnIrPaso2.disabled = checked.length === 0;
    }

    function setupEventListeners() {
        elements.btnIrPaso2.addEventListener('click', goToStep2);
        elements.btnGenerar.addEventListener('click', generateUnifiedForm);
    }

    // Navigation
    window.changeStep = function (stepNumber) {
        elements.step1.classList.add('d-none');
        elements.step2.classList.add('d-none');
        elements.step3.classList.add('d-none');

        // Handle Drafts Visibility
        const draftsSection = document.getElementById('borradoresSection');
        if (draftsSection) draftsSection.classList.add('d-none');

        if (stepNumber === 1) {
            elements.step1.classList.remove('d-none');
            // Show drafts if we have them
            const count = document.getElementById('borradoresCount');
            if (draftsSection && count && parseInt(count.textContent) > 0) {
                draftsSection.classList.remove('d-none');
            }
        }
        if (stepNumber === 2) elements.step2.classList.remove('d-none');
        if (stepNumber === 3) elements.step3.classList.remove('d-none');
    };

    function goToStep2() {
        const checkboxes = document.querySelectorAll('.tramite-check:checked');
        selectedTramites = Array.from(checkboxes).map(cb => {
            return tramiteData.find(t => t.tramite_base === cb.value);
        });

        renderQuestions();
        window.changeStep(2);
    }

    function renderQuestions() {
        elements.preguntasContainer.innerHTML = '';
        let hasQuestions = false;

        selectedTramites.forEach(tramite => {
            if (!tramite.variaciones_adicionales || tramite.variaciones_adicionales.length === 0) return;

            const tramiteTitle = document.createElement('h6');
            tramiteTitle.className = 'text-primary border-bottom pb-2 mt-2';
            tramiteTitle.textContent = `Para: ${tramite.tramite_base}`;
            elements.preguntasContainer.appendChild(tramiteTitle);

            tramite.variaciones_adicionales.forEach((variacion, idx) => {
                hasQuestions = true;
                // Transform text to question if possible
                let questionText = variacion.variacion;
                // Simple heuristic: if it starts with "Cuando...", replace with "¿...?"
                if (questionText.toLowerCase().startsWith('cuando ')) {
                    questionText = "¿" + questionText.substring(7) + "?";
                } else if (!questionText.startsWith('¿')) {
                    questionText = "¿" + questionText + "?";
                }

                // ID needs to be unique combination of tramite + index
                const qId = `q_${tramite.tramite_base.replace(/\s+/g, '')}_${idx}`;

                const div = document.createElement('div');
                div.className = 'card card-body p-3';
                div.innerHTML = `
                    <div class="form-check">
                        <input class="form-check-input variation-check" type="checkbox" 
                            id="${qId}" 
                            data-tramite="${tramite.tramite_base}" 
                            data-index="${idx}">
                        <label class="form-check-label fw-bold text-dark" for="${qId}">
                            ${questionText}
                        </label>
                    </div>
                `;
                elements.preguntasContainer.appendChild(div);
            });
        });

        if (!hasQuestions) {
            elements.preguntasContainer.innerHTML = '<div class="alert alert-success">No hay preguntas adicionales para los trámites seleccionados. Puede continuar.</div>';
        }
        feather.replace();
    }

    function generateUnifiedForm() {
        // Collect all IDs
        const requiredIds = new Set();

        selectedTramites.forEach(tramite => {
            // New Schema: 'Campos' instead of 'campos_generales'
            (tramite.Campos || []).forEach(id => requiredIds.add(id));

            // Variation docs (checked only)
            const checks = document.querySelectorAll(`.variation-check[data-tramite="${tramite.tramite_base}"]:checked`);
            checks.forEach(chk => {
                const idx = parseInt(chk.dataset.index);
                const varDocs = tramite.variaciones_adicionales[idx].documentos_adicionales || [];
                varDocs.forEach(id => requiredIds.add(id));
            });
        });

        // Map IDs to Objects (New Schema: ID instead of id_numerico)
        const campos = Array.from(requiredIds).map(id => {
            return elementosData.find(el => el.ID === id);
        }).filter(el => el != null);

        renderUnifiedFields(campos);
        window.changeStep(3);
    }

    // Old renderUnifiedFields removed. Grouping logic handled in new implementation.

    function renderStandardGroup(campos, title) {
        const section = document.createElement('div');
        section.className = 'section-card';
        section.innerHTML = `
            <div class="section-title">${title}</div>
            <div class="row g-3"></div>
        `;
        elements.contenedorSecciones.appendChild(section);
        const container = section.querySelector('.row');

        campos.forEach(campo => {
            const col = document.createElement('div');
            col.className = defineColumnSize(campo.TIPO);
            col.innerHTML = generateInputHTML(campo);
            container.appendChild(col);
        });
    }

    // --- Region & Comuna Data (Chile) ---
    // Prioritizing V Región and Viña del Mar as requested
    const chileData = {
        "Región de Valparaíso": ["Viña del Mar", "Valparaíso", "Quilpué", "Villa Alemana", "Concón", "Limache", "Olmué", "Quillota", "San Antonio", "Los Andes", "San Felipe"],
        "Región Metropolitana": ["Santiago", "Providencia", "Las Condes", "Maipú", "La Florida", "Puente Alto"],
        "Región de Arica y Parinacota": ["Arica", "Camarones", "Putre", "General Lagos"],
        "Región de Tarapacá": ["Iquique", "Alto Hospicio"],
        "Región de Antofagasta": ["Antofagasta", "Mejillones", "Tocopilla", "Calama"],
        "Región de Atacama": ["Copiapó", "Caldera", "Vallenar"],
        "Región de Coquimbo": ["La Serena", "Coquimbo", "Ovalle"],
        "Región del Libertador Gral. Bernardo O'Higgins": ["Rancagua", "Machalí", "San Fernando"],
        "Región del Maule": ["Talca", "Curicó", "Linares"],
        "Región de Ñuble": ["Chillán", "San Carlos"],
        "Región del Biobío": ["Concepción", "Talcahuano", "Los Ángeles"],
        "Región de La Araucanía": ["Temuco", "Padre Las Casas", "Villarrica"],
        "Región de Los Ríos": ["Valdivia", "Corral"],
        "Región de Los Lagos": ["Puerto Montt", "Puerto Varas", "Osorno"],
        "Región de Aysén": ["Coyhaique", "Aysén"],
        "Región de Magallanes": ["Punta Arenas", "Puerto Natales"]
    };

    const addressTitles = {
        "DIRE_C": "Dirección Comercial",
        "DIRE_P": "Dirección Particular / Postal",
        "DIRE_A": "Dirección Anterior",
        "DIRE_M": "Dirección Modificada",
        "SEDE": "Sede Comercial"
    };

    function renderDomicilioGroup(campos, title) {
        // Sub-group fields by address entity prefix (e.g., DIRE_C, DIRE_P)
        const subGrupos = {};

        campos.forEach(campo => {
            // Extract prefix like DIRE_C from DIRE_C_CAL
            const parts = campo.ID.split('_');
            const prefix = parts.length > 1 ? parts.slice(0, 2).join('_') : parts[0];

            if (!subGrupos[prefix]) subGrupos[prefix] = { fields: [] };
            subGrupos[prefix].fields.push(campo);
        });

        Object.keys(subGrupos).forEach(prefix => {
            const subGrupo = subGrupos[prefix];

            // Determine Title
            let subTitle = addressTitles[prefix];
            if (!subTitle) {
                // Formatting fallback
                subTitle = title;
            }

            const hasAddressStructure = subGrupo.fields.some(f =>
                f.NOMBRE.toLowerCase().includes('calle') ||
                f.NOMBRE.toLowerCase().includes('región') ||
                f.NOMBRE.toLowerCase().includes('region')
            );

            const section = document.createElement('div');
            section.className = 'section-card border-warning';
            section.style.borderLeftColor = '#ffc107';

            let sectionHTML = `<div class="section-title text-warning-emphasis">${subTitle}</div><div class="row g-3">`;

            if (hasAddressStructure) {
                // --- RENDER AS MAP/ADDRESS COMPLEX ---

                // Identify key fields by Name logic or Suffix
                const fCalle = subGrupo.fields.find(f => f.ID.endsWith('_CAL') || f.NOMBRE.toLowerCase().includes('calle'));
                const fNumero = subGrupo.fields.find(f => f.ID.endsWith('_NUM') || f.NOMBRE.toLowerCase().includes('número'));
                const fComuna = subGrupo.fields.find(f => f.ID.endsWith('_COM') || f.NOMBRE.toLowerCase().includes('comuna'));
                const fRegion = subGrupo.fields.find(f => f.ID.endsWith('_REG') || f.NOMBRE.toLowerCase().includes('región'));
                const fLat = subGrupo.fields.find(f => f.ID.endsWith('_LAT'));
                const fLng = subGrupo.fields.find(f => f.ID.endsWith('_LON'));

                // Override Types & Shorten Labels
                [fCalle, fNumero, fComuna, fRegion, fLat, fLng].forEach(f => {
                    if (f) {
                        if (f === fCalle) f.shortName = 'Calle';
                        else if (f === fNumero) f.shortName = 'Número';
                        else if (f === fRegion) f.shortName = 'Región';
                        else if (f === fComuna) f.shortName = 'Comuna';
                        else f.shortName = f.NOMBRE;
                    }
                });

                // Region & Comuna Logic
                let regionHTML = '', comunaHTML = '';

                if (fRegion) {
                    const regions = Object.keys(chileData);
                    const firstRegion = "Región de Valparaíso";
                    const otherRegions = regions.filter(r => r !== firstRegion);
                    const sortedRegions = [firstRegion, ...otherRegions];
                    const options = sortedRegions.map(r => `<option value="${r}">${r}</option>`).join('');
                    const onchange = fComuna ? `onchange="updateComunas('${fComuna.ID}', this.value)"` : '';

                    regionHTML = `
                        <div class="col-md-3">
                            <label class="form-label">${fRegion.shortName || 'Región'}</label>
                            <select class="form-select" id="${fRegion.ID}" ${onchange}>
                                <option value="">Seleccione...</option>
                                ${options}
                            </select>
                        </div>
                    `;
                }

                if (fComuna) {
                    comunaHTML = `
                        <div class="col-md-3">
                            <label class="form-label">${fComuna.shortName || 'Comuna'}</label>
                            <select class="form-select" id="${fComuna.ID}" disabled>
                                <option value="">Seleccione Región...</option>
                            </select>
                        </div>
                    `;
                }

                const calleHTML = fCalle ? `<div class="col-md-3">${generateInputHTML(fCalle, false, fCalle.shortName)}</div>` : '';
                const numeroHTML = fNumero ? `<div class="col-md-3">${generateInputHTML(fNumero, false, fNumero.shortName)}</div>` : '';

                sectionHTML += regionHTML + comunaHTML + calleHTML + numeroHTML;

                // Map Button
                const mapId = `map_${prefix}`;
                sectionHTML += `
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-warning btn-sm" onclick="initMapFor('${prefix}', '${mapId}', '${fCalle?.ID}', '${fNumero?.ID}', '${fComuna?.ID}', '${fRegion?.ID}', '${fLat?.ID}', '${fLng?.ID}')">
                            <i data-feather="map-pin"></i> Ubicar en Mapa
                        </button>
                        <small class="d-block text-muted mt-1" style="font-size: 0.75rem;">(Seleccione la ubicación exacta arrastrando el marcador)</small>
                    </div>
                    <div class="col-12">
                         <div id="${mapId}" style="height: 350px; width: 100%; border-radius: 8px; border: 1px solid #ddd; background: #eee;"></div>
                    </div>
                `;

                if (fLat) sectionHTML += `<div class="col-md-6">${generateInputHTML(fLat, true, fLat.shortName)}</div>`;
                if (fLng) sectionHTML += `<div class="col-md-6">${generateInputHTML(fLng, true, fLng.shortName)}</div>`;

                const usedIds = [fCalle, fNumero, fComuna, fRegion, fLat, fLng].filter(x => x).map(x => x.ID);
                subGrupo.fields.forEach(f => {
                    if (!usedIds.includes(f.ID)) {
                        sectionHTML += `<div class="col-12">${generateInputHTML(f)}</div>`;
                    }
                });

            } else {
                // --- RENDER AS SIMPLE FIELDS ---
                subGrupo.fields.forEach(f => {
                    sectionHTML += `<div class="col-md-6">${generateInputHTML(f)}</div>`;
                });
            }

            sectionHTML += `</div>`;
            section.innerHTML = sectionHTML;
            elements.contenedorSecciones.appendChild(section);
        });
    }

    // Helper: Update Comunas based on Region
    window.updateComunas = function (comunaId, regionName) {
        const comunaSelect = document.getElementById(comunaId);
        if (!comunaSelect) return;

        comunaSelect.innerHTML = '<option value="">Seleccione...</option>';
        comunaSelect.disabled = true;

        if (regionName && chileData[regionName]) {
            comunaSelect.disabled = false;
            let comunas = [...chileData[regionName]]; // Copy
            // If Region is Valparaiso, Viña first
            if (regionName === "Región de Valparaíso") {
                const spec = "Viña del Mar";
                comunas = comunas.filter(c => c !== spec);
                comunas.unshift(spec);
            }

            comunas.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c;
                opt.textContent = c;
                comunaSelect.appendChild(opt);
            });
        }
    };

    function renderTableGroup(tableName, fields) {
        const section = document.createElement('div');
        section.className = 'section-card border-info';
        section.style.borderLeftColor = '#0dcaf0';

        // Generate unique ID for this table section
        const tableId = `tbl_${tableName.replace(/\s+/g, '_')}`;

        // 1. Inputs Area
        let inputsHTML = `<div class="section-title text-info-emphasis">${tableName}</div>
                          <div class="row g-3 mb-3 p-3 bg-light rounded inputs-container">`;

        fields.forEach(f => {
            // Force inputs to use a temporary ID for adding logic, avoiding collision with main form if re-rendered? 
            // Actually, we can just use their original IDs but strictly for this "Add" row context.
            // Since these fields are 'repeater' fields, we shouldn't use their ID as the final form ID for the row.
            // But for the input fields *used to add* a row, we can use the ID from JSON.
            inputsHTML += `<div class="${defineColumnSize(f.TIPO)}">${generateInputHTML(f)}</div>`;
        });

        const btnAddId = `btn_add_${tableId}`;

        inputsHTML += `
            <div class="col-12 text-end">
                <button type="button" class="btn btn-info " id="${btnAddId}">
                    <i data-feather="plus"></i> Agregar a ${tableName}
                </button>
            </div>
        </div>`;

        // 2. Table Area
        let tableHTML = `
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="${tableId}">
                    <thead class="table-light">
                        <tr>
                            ${fields.map(f => `<th>${f.NOMBRE}</th>`).join('')}
                            <th style="width: 50px;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be added here -->
                    </tbody>
                </table>
            </div>
        `;

        section.innerHTML = inputsHTML + tableHTML;
        elements.contenedorSecciones.appendChild(section);

        // 3. Attach Event Listener
        const btn = section.querySelector(`#${btnAddId}`);
        btn.addEventListener('click', () => {
            const tbody = section.querySelector('tbody');
            const tr = document.createElement('tr');

            let rowDataHTML = '';
            let allEmpty = true;

            fields.forEach(f => {
                const input = document.getElementById(f.ID);
                let val = '';

                if (input.type === 'checkbox') val = input.checked ? 'Sí' : 'No';
                else val = input.value;

                if (val && val.trim() !== '') allEmpty = false;

                rowDataHTML += `<td>${val}</td>`;

                // Clear input after adding
                if (input.type === 'checkbox') input.checked = false;
                else input.value = '';
            });

            if (allEmpty) {
                Swal.fire('Atención', "Por favor complete al menos un campo para agregar un registro.", 'warning');
                return;
            }

            rowDataHTML += `
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">
                        <i data-feather="trash-2"></i>
                    </button>
                </td>
             `;

            tr.innerHTML = rowDataHTML;
            tbody.appendChild(tr);
            feather.replace();
        });
    }

    renderUnifiedFields = function (campos) { // Overwriting the previous function definition to insert logic
        elements.contenedorSecciones.innerHTML = '';

        // Group logic using the new friendly mapping
        const grupos = {};
        const tablas = {}; // Store table fields

        // Custom order for sections based on New Groups
        const groupOrder = [
            "Datos Contribuyente",
            "Identificación Tributaria",
            "Dirección Comercial / Tributaria",
            "Dirección Particular / Domicilio Postal Tributario",
            "Actividad Comercial",
            "Patente",
            "Sede Comercial",
            "Contacto y Firma",
            "Propaganda",
            "Capital Propio",
            "Requisitos Comunes",
            "Requisitos Inmueble/Domicilio"
        ];

        campos.forEach(campo => {
            // Check for TABLA attribute
            if (campo.TABLA) {
                if (!tablas[campo.TABLA]) tablas[campo.TABLA] = [];
                tablas[campo.TABLA].push(campo);
            } else {
                const rawGroup = campo.GRUPO || 'General';
                if (!grupos[rawGroup]) grupos[rawGroup] = [];
                grupos[rawGroup].push(campo);
            }
        });

        // Loop using defined order, then any others
        const allKeys = Object.keys(grupos);
        const sortedKeys = groupOrder.filter(k => allKeys.includes(k)).concat(allKeys.filter(k => !groupOrder.includes(k)));

        sortedKeys.forEach(rawGroup => {
            const cleanTitle = friendlyGroups[rawGroup] || rawGroup;
            const fields = grupos[rawGroup];

            if (rawGroup.includes('Dirección')) {
                renderDomicilioGroup(fields, cleanTitle);
            } else {
                renderStandardGroup(fields, cleanTitle);
            }
        });

        // Render Tables at the end (or we could interleave them if we had order info)
        Object.keys(tablas).forEach(tableName => {
            renderTableGroup(tableName, tablas[tableName]);
        });

        feather.replace();
    };
    window.initMapFor = function (prefix, mapDivId, idCalle, idNumero, idComuna, idRegion, idLat, idLng) {
        if (!window.google) { Swal.fire('Error', "Google Maps API no cargada.", 'error'); return; }
        const calle = document.getElementById(idCalle)?.value;
        const numero = document.getElementById(idNumero)?.value;
        const comuna = document.getElementById(idComuna)?.value;
        const region = document.getElementById(idRegion)?.value || "Chile";

        if (!calle || !numero || !comuna) { Swal.fire('Atención', "Complete dirección para usar el mapa.", 'warning'); return; }

        const address = `${calle} ${numero}, ${comuna}, ${region}`;
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: address }, (results, status) => {
            if (status === "OK") {
                const location = results[0].geometry.location;
                if (!mapInstances[prefix]) {
                    mapInstances[prefix] = new google.maps.Map(document.getElementById(mapDivId), { zoom: 15, center: location });
                    const marker = new google.maps.Marker({ map: mapInstances[prefix], position: location, draggable: true });
                    marker.addListener('dragend', () => {
                        const pos = marker.getPosition();
                        updateCoords(idLat, idLng, pos.lat(), pos.lng());
                    });
                    mapInstances[prefix].marker = marker;
                } else {
                    mapInstances[prefix].setCenter(location);
                    mapInstances[prefix].marker.setPosition(location);
                }
                updateCoords(idLat, idLng, location.lat(), location.lng());
            } else { Swal.fire('Error', "Error geocodificación: " + status, 'error'); }
        });
    };

    function updateCoords(idLat, idLng, lat, lng) {
        if (idLat && document.getElementById(idLat)) document.getElementById(idLat).value = lat;
        if (idLng && document.getElementById(idLng)) document.getElementById(idLng).value = lng;
    }

    function defineColumnSize(tipo) {
        if (['textarea', 'file', 'document'].includes(tipo)) return 'col-12';
        return 'col-md-6';
    }

    function generateInputHTML(campo, forceDisabled = false, customLabel = null) {
        const labelText = customLabel || campo.NOMBRE;
        const label = `<label class="form-label">${labelText}</label>`;
        const disabledAttr = forceDisabled ? 'readonly style="background-color: #e9ecef;"' : '';
        let input = '';

        // TIPO handling with new schema
        switch (campo.TIPO) {
            case 'select':
                input = `<select class="form-select" id="${campo.ID}" ${disabledAttr}><option value="">Seleccione...</option>${(campo.OPCIONES || []).map(o => `<option value="${o}">${o}</option>`).join('')}</select>`;
                break;
            case 'textarea':
                input = `<textarea class="form-control" id="${campo.ID}" rows="3" ${disabledAttr}></textarea>`;
                break;
            case 'file':
            case 'document': // New type 'document' in schema
                input = `<input type="file" class="form-control" id="${campo.ID}">`;
                break;
            case 'checkbox':
                return `<div class="form-check mt-3"><input class="form-check-input" type="checkbox" id="${campo.ID}"><label class="form-check-label" for="${campo.ID}">${labelText}</label></div>`;
            case 'radio':
                // Assuming OPCIONES exists for radio
                if (campo.OPCIONES) {
                    input = `<div>`;
                    campo.OPCIONES.forEach((opt, idx) => {
                        input += `<div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="${campo.ID}" id="${campo.ID}_${idx}" value="${opt}">
                                    <label class="form-check-label" for="${campo.ID}_${idx}">${opt}</label>
                                  </div>`;
                    });
                    input += `</div>`;
                } else {
                    input = `<input type="radio" class="form-check-input" id="${campo.ID}">`; // Fallback
                }
                return `<div>${label}${input}</div>`;
            default:
                input = `<input type="${campo.TIPO || 'text'}" class="form-control" id="${campo.ID}" ${disabledAttr}>`;
        }
        return `<div>${label}${input}</div>`;
    }

});
