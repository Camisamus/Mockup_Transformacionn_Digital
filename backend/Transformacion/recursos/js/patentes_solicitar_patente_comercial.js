// Logic for Solicitud Patente Page

document.addEventListener('DOMContentLoaded', () => {

    const elements = {
        tipoPatenteSelect: document.getElementById('tipoTrámite'),
        tipoTramiteSection: document.getElementById('tipoTramiteSection'),
        variacionesSection: document.getElementById('variacionesSection'),
        variacionesContainer: document.getElementById('variacionesContainer'),
        btnIniciar: document.getElementById('btnIniciarTramite'),
        formSections: document.getElementById('form-sections'),
        documentosList: document.getElementById('documentosList')
    };

    let patentData = [];
    let documentosList = [];

    // Initialize
    fetchData();
    setupEventListeners();

    function fetchData() {
        console.log('Fetching patent data...');
        fetch('../recursos/jsons/patentes_data_documentos.json')
            .then(response => response.json())
            .then(data => {
                patentData = data.TramitePatente || [];
                documentosList = data.Documento || [];
                console.log('Data loaded:', { patentData, documentosList });

                // Populate Select
                if (elements.tipoPatenteSelect) {
                    // Keep default option
                    elements.tipoPatenteSelect.innerHTML = '<option value="">Seleccione...</option>';

                    patentData.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.tramite_base;
                        // Format text for better readability (Title Case) or keep raw
                        // Keeping raw unique values as requested to match comparison source
                        option.textContent = item.tramite_base;
                        elements.tipoPatenteSelect.appendChild(option);
                    });
                }
            })
            .catch(error => console.error('Error loading patent data:', error));
    }

    function setupEventListeners() {
        // Logic for Tipo de Patente selection
        if (elements.tipoPatenteSelect) {
            elements.tipoPatenteSelect.addEventListener('change', handleTypeChange);
        }

        // Logic for Iniciar Trámite
        if (elements.btnIniciar) {
            elements.btnIniciar.addEventListener('click', startProcedure);
        }
    }

    function handleTypeChange(e) {
        const selectedType = e.target.value.toUpperCase();
        elements.variacionesContainer.innerHTML = '';

        if (!selectedType) {
            elements.variacionesSection.classList.add('d-none');
            elements.btnIniciar.classList.add('d-none');
            // Hide form sections if user deselects type to avoid inconsistency
            elements.formSections.classList.add('d-none');
            return;
        }

        const foundType = patentData.find(item => item.tramite_base === selectedType);

        if (foundType) {
            // Show start button
            elements.btnIniciar.classList.remove('d-none');

            // Render Variations
            if (foundType.variaciones_adicionales && foundType.variaciones_adicionales.length > 0) {
                elements.variacionesSection.classList.remove('d-none');

                foundType.variaciones_adicionales.forEach((item, index) => {
                    const checkboxDiv = document.createElement('div');
                    checkboxDiv.className = 'form-check w-100';
                    checkboxDiv.innerHTML = `
                        <input class="form-check-input variation-checkbox" type="checkbox" value="${index}" id="var_${index}" data-docs='${JSON.stringify(item.documentos_adicionales)}'>
                        <label class="form-check-label" for="var_${index}">
                            ${item.variacion}
                        </label>
                    `;
                    elements.variacionesContainer.appendChild(checkboxDiv);
                });
            } else {
                elements.variacionesSection.classList.add('d-none');
            }
        }
    }

    function startProcedure() {
        const selectedType = elements.tipoPatenteSelect.value.toUpperCase();
        if (!selectedType) return;

        const foundType = patentData.find(item => item.tramite_base === selectedType);
        if (!foundType) return;

        // Collect Document IDs
        let requiredDocIds = new Set(foundType.documentos_generales || []);

        // Add variation documents
        const checkedVariations = document.querySelectorAll('.variation-checkbox:checked');
        checkedVariations.forEach(checkbox => {
            const docs = JSON.parse(checkbox.getAttribute('data-docs') || '[]');
            docs.forEach(id => requiredDocIds.add(id));
        });

        // Render Document List
        renderDocumentList(Array.from(requiredDocIds));

        // Show Sections
        elements.formSections.classList.remove('d-none');

        // Optional: Scroll to first section
        elements.formSections.scrollIntoView({ behavior: 'smooth' });

        // Hide Type Section as requested
        elements.tipoTramiteSection.classList.add('d-none');
    }

    function renderDocumentList(ids) {
        elements.documentosList.innerHTML = '';

        if (ids.length === 0) {
            elements.documentosList.innerHTML = '<div class="alert alert-success">No se requieren documentos adicionales.</div>';
            return;
        }

        // Sort IDs numerically
        ids.sort((a, b) => a - b);

        ids.forEach(id => {
            const doc = documentosList.find(d => d.id === id);
            if (doc) {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'mb-3';
                itemDiv.innerHTML = `
                    <label for="doc_${doc.id}" class="form-label">${doc.id} .- ${doc.descripcion}</label>
                    <input class="form-control" type="file" id="doc_${doc.id}">
                `;
                elements.documentosList.appendChild(itemDiv);
            }
        });
    }

});
