// Logic for Solicitud Única de Patentes

document.addEventListener('DOMContentLoaded', () => {

    const elements = {
        selectTramite: document.getElementById('selectTramite'),
        seleccionSection: document.getElementById('seleccionTramiteSection'),
        variacionesContainer: document.getElementById('variacionesContainer'),
        listaVariaciones: document.getElementById('listaVariaciones'),
        btnGenerar: document.getElementById('btnGenerarFormulario'),
        formularioGenerado: document.getElementById('formularioGenerado'),
        contenedorSecciones: document.getElementById('contenedorSecciones'),
        btnVolver: document.getElementById('btnVolverSeleccion')
    };

    let tramiteData = [];
    let elementosData = [];
    // Store maps and markers to handle them independently
    const mapInstances = {};

    // Initialize
    initApplication();

    function initApplication() {
        Promise.all([
            fetch('../recursos/jsons/categoria_patentes_mapeo_completo.json').then(r => r.json()),
            fetch('../recursos/jsons/formularios_elementos.json').then(r => r.json())
        ]).then(([tramitesResult, elementosResult]) => {
            tramiteData = tramitesResult.Maestro_Tramites || tramitesResult;
            elementosData = elementosResult;
            populateSelect();
            setupEventListeners();
        }).catch(err => console.error('Error loading data:', err));
    }

    function populateSelect() {
        elements.selectTramite.innerHTML = '<option value="">Seleccione...</option>';
        tramiteData.forEach(tramite => {
            const option = document.createElement('option');
            option.value = tramite.tramite_base;
            option.textContent = tramite.tramite_base;
            elements.selectTramite.appendChild(option);
        });
    }

    function setupEventListeners() {
        elements.selectTramite.addEventListener('change', handleTramiteChange);
        elements.btnGenerar.addEventListener('click', generateForm);
        elements.btnVolver.addEventListener('click', resetSelection);
    }

    function handleTramiteChange(e) {
        const selectedValue = e.target.value;
        elements.listaVariaciones.innerHTML = '';

        if (!selectedValue) {
            elements.variacionesContainer.classList.add('d-none');
            elements.btnGenerar.classList.add('d-none');
            return;
        }

        const tramite = tramiteData.find(t => t.tramite_base === selectedValue);
        if (!tramite) return;

        elements.btnGenerar.classList.remove('d-none');

        if (tramite.variaciones_adicionales && tramite.variaciones_adicionales.length > 0) {
            elements.variacionesContainer.classList.remove('d-none');
            tramite.variaciones_adicionales.forEach((variacion, index) => {
                const div = document.createElement('div');
                div.className = 'form-check form-check-inline border p-2 rounded bg-light';
                div.innerHTML = `
                    <input class="form-check-input variation-check" type="checkbox" id="var_${index}" value="${index}">
                    <label class="form-check-label" for="var_${index}">${variacion.variacion}</label>
                `;
                elements.listaVariaciones.appendChild(div);
            });
        } else {
            elements.variacionesContainer.classList.add('d-none');
        }
    }

    function generateForm() {
        const selectedValue = elements.selectTramite.value;
        const tramite = tramiteData.find(t => t.tramite_base === selectedValue);
        if (!tramite) return;

        let ids = new Set(tramite.documentos_generales || []);
        const checks = document.querySelectorAll('.variation-check:checked');
        checks.forEach(check => {
            const index = parseInt(check.value);
            const varDocs = tramite.variaciones_adicionales[index].documentos_adicionales || [];
            varDocs.forEach(id => ids.add(id));
        });

        const campos = Array.from(ids).map(id => {
            return elementosData.find(el => el.id_numerico === id);
        }).filter(el => el != null);

        renderCampos(campos);

        elements.seleccionSection.classList.add('d-none');
        elements.formularioGenerado.classList.remove('d-none');
    }

    function renderCampos(campos) {
        elements.contenedorSecciones.innerHTML = '';

        // Group fields
        const grupos = {};
        campos.forEach(campo => {
            const g = campo.grupo || 'General';
            if (!grupos[g]) grupos[g] = [];
            grupos[g].push(campo);
        });

        Object.keys(grupos).forEach(grupoNombre => {
            if (grupoNombre === 'Domicilio') {
                renderDomicilioGroup(grupos[grupoNombre]);
            } else {
                renderStandardGroup(grupoNombre, grupos[grupoNombre]);
            }
        });

        feather.replace();
    }

    function renderStandardGroup(grupoNombre, campos) {
        const section = document.createElement('div');
        section.className = 'section-card';
        section.innerHTML = `
            <div class="section-title">${grupoNombre}</div>
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

    function renderDomicilioGroup(campos) {
        // Sub-group fields by address entity (looks at ID prefix like GDOMDCM, GDOMDLO)
        const subGrupos = {};

        campos.forEach(campo => {
            // Extract prefix (e.g. "GDOMDCM" from "GDOMDCM36")
            const match = campo.id_numerico.match(/^([A-Z]+)/);
            const prefix = match ? match[0] : 'OTHER';

            if (!subGrupos[prefix]) subGrupos[prefix] = { name: campo.nombre.split(' ')[1] || 'Dirección', fields: [] };
            subGrupos[prefix].fields.push(campo);
        });

        Object.keys(subGrupos).forEach(prefix => {
            const subGrupo = subGrupos[prefix];
            const section = document.createElement('div');
            section.className = 'section-card border-warning'; // Different color for address
            section.style.borderLeftColor = '#ffc107';

            // Try to deduce a nice title from the fields
            const referenceField = subGrupo.fields.find(f => f.nombre.includes('Direccion'));
            let displayTitle = referenceField ? referenceField.nombre.replace('Región', '').replace('Calle', '').trim() : 'Información de Domicilio';
            // Clean up title
            displayTitle = displayTitle.replace(/Direccion/i, 'Dirección').trim();

            let sectionHTML = `<div class="section-title">${displayTitle}</div><div class="row g-3">`;

            // 1. Identify specific fields for logic
            const fCalle = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('calle'));
            const fNumero = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('número') || f.nombre.toLowerCase().includes('numero'));
            const fComuna = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('comuna'));
            const fRegion = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('región'));
            const fLat = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('latitud'));
            const fLng = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('longitud'));
            const fObs = subGrupo.fields.find(f => f.nombre.toLowerCase().includes('observacion'));

            // Render Address Inputs (Region, Comuna, Calle, Numero)
            const addressFields = [fRegion, fComuna, fCalle, fNumero].filter(f => f != null);
            addressFields.forEach(f => {
                sectionHTML += `<div class="col-md-3">${generateInputHTML(f)}</div>`;
            });

            // Search Button
            const mapId = `map_${prefix}`;
            sectionHTML += `
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-warning btn-sm" onclick="initMapFor('${prefix}', '${mapId}', '${fCalle?.id_numerico}', '${fNumero?.id_numerico}', '${fComuna?.id_numerico}', '${fRegion?.id_numerico}', '${fLat?.id_numerico}', '${fLng?.id_numerico}')">
                        <i data-feather="map-pin"></i> Ubicar en Mapa
                    </button>
                </div>
            `;

            // Map Container
            sectionHTML += `
                <div class="col-12">
                    <div id="${mapId}" style="height: 350px; width: 100%; border-radius: 8px; border: 1px solid #ddd; background: #eee;"></div>
                </div>
            `;

            // Lat/Lng (Disabled and AFTER map)
            if (fLat) {
                // Force readonly
                sectionHTML += `<div class="col-md-6">${generateInputHTML(fLat, true)}</div>`;
            }
            if (fLng) {
                sectionHTML += `<div class="col-md-6">${generateInputHTML(fLng, true)}</div>`;
            }

            // Global Observation (if any) and other remaining fields
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

    // Helper exposed to global scope for the onclick handler
    window.initMapFor = function (prefix, mapDivId, idCalle, idNumero, idComuna, idRegion, idLat, idLng) {
        if (!window.google) {
            alert("Google Maps API no cargada.");
            return;
        }

        const calle = document.getElementById(idCalle)?.value;
        const numero = document.getElementById(idNumero)?.value;
        const comuna = document.getElementById(idComuna)?.value;
        const region = document.getElementById(idRegion)?.value || "Chile";

        if (!calle || !numero || !comuna) {
            alert("Debe ingresar Calle, Número y Comuna para localizar.");
            return;
        }

        const address = `${calle} ${numero}, ${comuna}, ${region}`;
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: address }, (results, status) => {
            if (status === "OK") {
                const location = results[0].geometry.location;

                // Initialize map if not exists
                if (!mapInstances[prefix]) {
                    mapInstances[prefix] = new google.maps.Map(document.getElementById(mapDivId), {
                        zoom: 15,
                        center: location
                    });

                    // Marker
                    const marker = new google.maps.Marker({
                        map: mapInstances[prefix],
                        position: location,
                        draggable: true
                    });

                    marker.addListener('dragend', () => {
                        const pos = marker.getPosition();
                        updateCoords(idLat, idLng, pos.lat(), pos.lng());
                    });

                    mapInstances[prefix].marker = marker; // save ref
                } else {
                    // Update existing
                    mapInstances[prefix].setCenter(location);
                    mapInstances[prefix].marker.setPosition(location);
                }

                updateCoords(idLat, idLng, location.lat(), location.lng());

            } else {
                alert("No se pudo encontrar la dirección: " + status);
            }
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
        let input = '';
        const disabledAttr = forceDisabled ? 'readonly disabled_bg' : ''; // disabled_bg custom class if needed

        switch (campo.tipo) {
            case 'select':
                input = `<select class="form-select" id="${campo.id_numerico}" ${disabledAttr}>
                            <option value="">Seleccione...</option>
                            ${(campo.opciones || []).map(o => `<option value="${o}">${o}</option>`).join('')}
                         </select>`;
                break;
            case 'textarea':
                input = `<textarea class="form-control" id="${campo.id_numerico}" rows="3" ${disabledAttr}></textarea>`;
                break;
            case 'file':
                input = `<input type="file" class="form-control" id="${campo.id_numerico}">`;
                break;
            case 'checkbox':
                return `
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="${campo.id_numerico}">
                        <label class="form-check-label" for="${campo.id_numerico}">${campo.nombre}</label>
                    </div>
                `;
            default:
                input = `<input type="${campo.tipo || 'text'}" class="form-control" id="${campo.id_numerico}" ${disabledAttr}>`;
        }
        return `<div>${label}${input}</div>`;
    }

    function resetSelection() {
        elements.formularioGenerado.classList.add('d-none');
        elements.seleccionSection.classList.remove('d-none');
        // Reset maps
        Object.keys(mapInstances).forEach(k => delete mapInstances[k]);
        document.querySelectorAll('[id^="map_"]').forEach(el => el.innerHTML = '');
    }

});
