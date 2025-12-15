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

    // Group Title Mapping (User Request: "Identificacion persona", etc)
    const friendlyGroups = {
        "Personas": "Identificación del Solicitante / Representante",
        "Domicilio": "Domicilio Comercial y Ubicación",
        "Contacto": "Datos de Contacto",
        "Tributario": "Identificación de la Empresa (Tributaria)",
        "Financiero": "Datos Bancarios",
        "Propaganda": "Detalles de Propaganda",
        "Deuda": "Situación de Deuda",
        "Documento": "Documentación Requerida",
        "Motivo": "Motivo de la Solicitud",
        "General": "Otros Antecedentes"
    };

    // Initialize
    initApplication();

    function initApplication() {
        Promise.all([
            fetch('../recursos/jsons/categoria_patentes_mapeo_completo.json').then(r => r.json()),
            fetch('../recursos/jsons/formularios_elementos.json').then(r => r.json())
        ]).then(([tramitesResult, elementosResult]) => {
            tramiteData = tramitesResult.Maestro_Tramites || tramitesResult;
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
        alert(`Simulación: Cargando borrador ID ${id}. Los datos se pre-llenarían aquí.`);
    };

    function renderTramitesSelection() {
        elements.tramitesContainer.innerHTML = '';
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
            // General docs
            (tramite.documentos_generales || []).forEach(id => requiredIds.add(id));

            // Variation docs (checked only)
            const checks = document.querySelectorAll(`.variation-check[data-tramite="${tramite.tramite_base}"]:checked`);
            checks.forEach(chk => {
                const idx = parseInt(chk.dataset.index);
                const varDocs = tramite.variaciones_adicionales[idx].documentos_adicionales || [];
                varDocs.forEach(id => requiredIds.add(id));
            });
        });

        // Map IDs to Objects
        const campos = Array.from(requiredIds).map(id => {
            return elementosData.find(el => el.id_numerico === id);
        }).filter(el => el != null);

        renderUnifiedFields(campos);
        window.changeStep(3);
    }

    function renderUnifiedFields(campos) {
        elements.contenedorSecciones.innerHTML = '';

        // Group logic using the new friendly mapping
        const grupos = {};

        // Custom order for sections
        const groupOrder = [
            "Personas",
            "Domicilio",
            "Tributario",
            "Contacto",
            "Financiero",
            "Deuda",
            "Motivo",
            "General",
            "Propaganda",
            "Documento"
        ];

        campos.forEach(campo => {
            const rawGroup = campo.grupo || 'General';
            if (!grupos[rawGroup]) grupos[rawGroup] = [];
            // Handle array initialization if not exists
            if (!grupos[rawGroup]) grupos[rawGroup] = [];
            grupos[rawGroup].push(campo);
        });

        // Loop using defined order, then any others
        const allKeys = Object.keys(grupos);
        const sortedKeys = groupOrder.filter(k => allKeys.includes(k)).concat(allKeys.filter(k => !groupOrder.includes(k)));

        sortedKeys.forEach(rawGroup => {
            const cleanTitle = friendlyGroups[rawGroup] || rawGroup;
            const fields = grupos[rawGroup];

            if (rawGroup === 'Domicilio') {
                renderDomicilioGroup(fields, cleanTitle);
            } else {
                renderStandardGroup(fields, cleanTitle);
            }
        });

        feather.replace();
    }

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
            col.className = defineColumnSize(campo.tipo);
            col.innerHTML = generateInputHTML(campo);
            container.appendChild(col);
        });
    }

    function renderDomicilioGroup(campos, title) {
        // Reuse similar logic but wrapped in our new structure
        // Sub-group fields by address entity (GDOMDCM, etc)
        const subGrupos = {};

        campos.forEach(campo => {
            const match = campo.id_numerico.match(/^([A-Z]+)/);
            const prefix = match ? match[0] : 'OTHER';

            // Try to infer subgroup name from field name if possible, or just use prefix
            // Typically "Direccion Casa Matriz ..."
            if (!subGrupos[prefix]) subGrupos[prefix] = { fields: [] };
            subGrupos[prefix].fields.push(campo);
        });

        Object.keys(subGrupos).forEach(prefix => {
            const subGrupo = subGrupos[prefix];

            // Deduce subtitle
            const referenceField = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('direccion'));
            let subTitle = referenceField ? referenceField.nombre.replace(/direccion/i, '').replace(/calle/i, '').replace(/región/i, '').trim() : 'Dirección';
            if (subTitle === '') subTitle = "Ubicación";

            const section = document.createElement('div');
            section.className = 'section-card border-warning';
            section.style.borderLeftColor = '#ffc107'; // Keep yellow style for address

            let sectionHTML = `<div class="section-title">${title}: ${subTitle}</div><div class="row g-3">`;

            // Logic fields
            const fCalle = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('calle'));
            const fNumero = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('número') || f.nombre.toLowerCase().includes('numero'));
            const fComuna = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('comuna'));
            const fRegion = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('región'));
            const fLat = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('latitud'));
            const fLng = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('longitud'));

            // Render Key Address fields first
            const ordered = [fRegion, fComuna, fCalle, fNumero].filter(x => x);
            ordered.forEach(f => sectionHTML += `<div class="col-md-3">${generateInputHTML(f)}</div>`);

            // Map Button
            const mapId = `map_${prefix}`;
            sectionHTML += `
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-warning btn-sm" onclick="initMapFor('${prefix}', '${mapId}', '${fCalle?.id_numerico}', '${fNumero?.id_numerico}', '${fComuna?.id_numerico}', '${fRegion?.id_numerico}', '${fLat?.id_numerico}', '${fLng?.id_numerico}')">
                        <i data-feather="map-pin"></i> Ubicar en Mapa
                    </button>
                </div>
                <div class="col-12">
                     <div id="${mapId}" style="height: 350px; width: 100%; border-radius: 8px; border: 1px solid #ddd; background: #eee;"></div>
                </div>
            `;

            // Lat/Lng
            if (fLat) sectionHTML += `<div class="col-md-6">${generateInputHTML(fLat, true)}</div>`;
            if (fLng) sectionHTML += `<div class="col-md-6">${generateInputHTML(fLng, true)}</div>`;

            // Others
            const usedIds = [fCalle, fNumero, fComuna, fRegion, fLat, fLng].map(x => x?.id_numerico);
            subGrupo.fields.forEach(f => {
                if (!usedIds.includes(f.id_numerico)) {
                    sectionHTML += `<div class="col-12">${generateInputHTML(f)}</div>`;
                }
            });

            sectionHTML += `</div>`;
            section.innerHTML = sectionHTML;
            elements.contenedorSecciones.appendChild(section);
        });
    }

    // Reuse helper functions
    window.initMapFor = function (prefix, mapDivId, idCalle, idNumero, idComuna, idRegion, idLat, idLng) {
        if (!window.google) { alert("Google Maps API no cargada."); return; }
        const calle = document.getElementById(idCalle)?.value;
        const numero = document.getElementById(idNumero)?.value;
        const comuna = document.getElementById(idComuna)?.value;
        const region = document.getElementById(idRegion)?.value || "Chile";

        if (!calle || !numero || !comuna) { alert("Complete dirección para usar el mapa."); return; }

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
            } else { alert("Error geocodificación: " + status); }
        });
    };

    function updateCoords(idLat, idLng, lat, lng) {
        if (idLat && document.getElementById(idLat)) document.getElementById(idLat).value = lat;
        if (idLng && document.getElementById(idLng)) document.getElementById(idLng).value = lng;
    }

    function defineColumnSize(tipo) {
        if (['textarea', 'file'].includes(tipo)) return 'col-12';
        return 'col-md-6';
    }

    function generateInputHTML(campo, forceDisabled = false) {
        const label = `<label class="form-label">${campo.nombre}</label>`;
        const disabledAttr = forceDisabled ? 'readonly style="background-color: #e9ecef;"' : '';
        let input = '';

        switch (campo.tipo) {
            case 'select':
                input = `<select class="form-select" id="${campo.id_numerico}" ${disabledAttr}><option value="">Seleccione...</option>${(campo.opciones || []).map(o => `<option value="${o}">${o}</option>`).join('')}</select>`;
                break;
            case 'textarea':
                input = `<textarea class="form-control" id="${campo.id_numerico}" rows="3" ${disabledAttr}></textarea>`;
                break;
            case 'file':
                input = `<input type="file" class="form-control" id="${campo.id_numerico}">`;
                break;
            case 'checkbox':
                return `<div class="form-check mt-3"><input class="form-check-input" type="checkbox" id="${campo.id_numerico}"><label class="form-check-label" for="${campo.id_numerico}">${campo.nombre}</label></div>`;
            default:
                input = `<input type="${campo.tipo || 'text'}" class="form-control" id="${campo.id_numerico}" ${disabledAttr}>`;
        }
        return `<div>${label}${input}</div>`;
    }

});
