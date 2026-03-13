document.addEventListener('DOMContentLoaded', function () {
    let currentStep = 0;
    const totalSteps = 3;
    let selectedRubro = null;
    let rubrosData = [];
    let isUpdate = false;
    let currentEmprendimiento = null;

    // Elementos
    const btnNext = document.getElementById('btn-next');
    const btnPrev = document.getElementById('btn-prev');
    const btnAddNew = document.getElementById('btn-add-new');
    const inputRut = document.getElementById('input-rut');
    const rutAlert = document.getElementById('rut-success-alert');
    const categorySelector = document.getElementById('category-selector');
    const mainStepper = document.getElementById('main-stepper');
    const navContainer = document.getElementById('nav-container');
    const myRecordsContainer = document.getElementById('my-records-container');

    let map, marker, geocoder;

    // Cargar Rubros dinámicamente
    function loadRubros() {
        if (!categorySelector) return;

        categorySelector.innerHTML = '<div class="col-12 text-center p-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted">Cargando categorías...</p></div>';

        fetch('../../apivec/desarrollo_economico/rubros.php')
            .then(res => res.json())
            .then(response => {
                if (response.status === 'success') {
                    rubrosData = response.data;
                    renderRubros();
                } else {
                    categorySelector.innerHTML = '<div class="col-12 alert alert-danger">Error al cargar categorías</div>';
                }
            })
            .catch(err => {
                console.error(err);
                categorySelector.innerHTML = '<div class="col-12 alert alert-danger">Error de conexión al cargar categorías</div>';
            });
    }

    function renderRubros() {
        categorySelector.innerHTML = '';

        if (rubrosData.length === 0) {
            categorySelector.innerHTML = '<div class="col-12 alert alert-info">No hay categorías disponibles</div>';
            return;
        }

        rubrosData.forEach((rubro, index) => {
            const isFirst = index === 0;
            if (isFirst) selectedRubro = rubro.rub_id;

            const col = document.createElement('div');
            col.className = 'col-md-4';
            col.innerHTML = `
                <div class="card option-card ${isFirst ? 'active' : ''} p-4 position-relative" data-rubro="${rubro.rub_id}">
                    <div class="position-absolute top-0 end-0 p-3 text-primary icon-check ${isFirst ? '' : 'd-none'}">
                        <i class="bi bi-${rubro.rub_icono || 'tag'}" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="${isFirst ? 'bg-primary text-white' : 'bg-light text-muted'} rounded-4 d-inline-flex p-3 mb-4 shadow-sm">
                        <i class="bi bi-${rubro.rub_icono || 'tag'}" style="font-size: 2rem;"></i>
                    </div>
                    <h4 class="h5 fw-bold text-dark mb-2">${rubro.rub_nombre}</h4>
                    <p class="small text-muted mb-0 lh-base">Categoría de actividad comercial para su emprendimiento.</p>
                </div>
            `;

            const card = col.querySelector('.option-card');

            // Si estamos en modo lectura, deshabilitar cards de rubro
            if (isUpdate && currentEmprendimiento && currentEmprendimiento.dee_estado !== 'Por Reparar') {
                card.style.opacity = '0.7';
                card.style.cursor = 'default';
                card.classList.remove('active'); // Will set active only if matches current
            } else {
                card.addEventListener('click', function () {
                    // Deseleccionar otros
                    document.querySelectorAll('.option-card').forEach(c => {
                        c.classList.remove('active');
                        c.querySelector('.icon-check').classList.add('d-none');
                        const iconContainer = c.querySelector('.rounded-4');
                        iconContainer.classList.replace('bg-primary', 'bg-light');
                        iconContainer.classList.replace('text-white', 'text-muted');
                    });

                    // Seleccionar este
                    this.classList.add('active');
                    this.querySelector('.icon-check').classList.remove('d-none');
                    const activeIconContainer = this.querySelector('.rounded-4');
                    activeIconContainer.classList.replace('bg-light', 'bg-primary');
                    activeIconContainer.classList.remove('text-muted');
                    activeIconContainer.classList.add('text-white');

                    selectedRubro = this.getAttribute('data-rubro');
                });
            }

            // Si es el rubro actual del emprendimiento, marcarlo
            if (isUpdate && selectedRubro == rubro.rub_id) {
                card.classList.add('active');
                card.querySelector('.icon-check').classList.remove('d-none');
                const iCon = card.querySelector('.rounded-4');
                iCon.classList.replace('bg-light', 'bg-primary');
                iCon.classList.add('text-white');
            }

            categorySelector.appendChild(col);
        });
    }

    // Detección de empresa por RUT
    inputRut.addEventListener('input', function () {
        this.value = formatRut(this.value);
        let val = this.value.replace(/-/g, '');
        if (val.length >= 8) {
            let num = parseInt(val.substring(0, val.length - 1));
            const isEmpresa = num > 50000000;
            document.getElementById('container-estatutos').classList.toggle('d-none', !isEmpresa);
        }
    });

    async function loadRequiredDocs() {
        const container = document.getElementById('dynamic-docs-container');
        if (!container) return;

        container.innerHTML = '<div class="text-center p-4"><div class="spinner-border text-primary"></div></div>';

        try {
            const res = await fetch(`../../apivec/desarrollo_economico/rubros.php?rubro_id=${selectedRubro}`);
            const response = await res.json();

            if (response.status === 'success') {
                renderRequiredDocs(response.data);
            } else {
                container.innerHTML = '<div class="alert alert-danger">Error al cargar requerimientos</div>';
            }
        } catch (err) {
            console.error(err);
            container.innerHTML = '<div class="alert alert-danger">Error de conexión</div>';
        }
    }

    function renderRequiredDocs(docs) {
        const container = document.getElementById('dynamic-docs-container');
        if (!container) return;
        container.innerHTML = '';

        if (!docs || docs.length === 0) {
            container.innerHTML = '<div class="alert alert-light text-center">No se requieren documentos adicionales para este rubro.</div>';
            return;
        }

        docs.forEach(doc => {
            // Buscar si ya fue entregado
            const preSubidos = (isUpdate && currentEmprendimiento && currentEmprendimiento.delivered_docs)
                ? currentEmprendimiento.delivered_docs.filter(d => d.dee_documentacion == doc.ded_id)
                : [];

            const row = document.createElement('div');
            row.className = 'col-12 border-bottom py-3 d-flex align-items-center justify-content-between';
            row.innerHTML = `
                <div class="pe-3">
                    <p class="fw-bold text-dark mb-0">${doc.ded_nombre}</p>
                    <p class="small text-muted mb-0">${doc.ded_obligatorio ? 'Requerido' : 'Opcional'}</p>
                    ${renderDeliveredList(preSubidos)}
                </div>
                <div>
                    <input type="file" class="form-control form-control-sm dynamic-doc-input" 
                           data-doc-id="${doc.ded_id}" 
                           data-doc-name="${doc.ded_nombre}"
                           ${isUpdate && currentEmprendimiento && currentEmprendimiento.dee_estado !== 'Por Reparar' ? 'disabled' : ''}>
                </div>
            `;
            container.appendChild(row);
        });
    }

    function renderDeliveredList(docs) {
        if (!docs || docs.length === 0) return '';
        let html = '<ul class="list-unstyled mt-2 mb-0">';
        docs.forEach(d => {
            const url = `../../apivec/gesdoc/general.php?ACCION=Bajar&doc_id=${d.dee_documento}`;
            html += `
            <li class="small">
                <i class="bi bi-file-earmark-check text-success"></i> 
                <a href="${url}" target="_blank" class="text-decoration-none">${d.dee_nombre} (Ya subido)</a>
            </li>
        `;
        });
        html += '</ul>';
        return html;
    }

    function updateStepUI() {
        // Actualizar visibilidad de secciones
        document.querySelectorAll('[id^="section-"]').forEach(section => {
            const stepId = parseInt(section.id.replace('section-', ''));
            section.classList.toggle('d-none', stepId !== currentStep);
        });

        // Visibilidad de Stepper y Nav
        if (mainStepper) mainStepper.classList.toggle('d-none', currentStep === 0);
        if (navContainer) navContainer.classList.toggle('d-none', currentStep === 0);

        if (currentStep === 0) {
            loadMyRecords();
        } else if (currentStep === 1) {
            loadRubros();
        } else if (currentStep === 2) {
            initMap();
        } else if (currentStep === 3) {
            loadRequiredDocs();
        }

        const stepperCircles = document.querySelectorAll('.stepper-circle');
        const stepProgress = document.querySelector('.text-primary.fw-bold.small');

        if (stepProgress && currentStep > 0) {
            stepProgress.innerText = `Paso ${currentStep} de ${totalSteps}`;
        }

        stepperCircles.forEach((circle, index) => {
            const stepNum = index + 1;
            circle.classList.remove('bg-primary', 'bg-success', 'bg-light', 'text-white', 'text-muted', 'shadow-lg');
            if (stepNum < currentStep) {
                circle.classList.add('bg-success', 'text-white');
                circle.innerHTML = '✓';
            } else if (stepNum === currentStep) {
                circle.classList.add('bg-primary', 'text-white', 'shadow-lg');
                circle.innerText = stepNum;
            } else {
                circle.classList.add('bg-light', 'text-muted');
                circle.innerText = stepNum;
            }
        });

        if (btnPrev) btnPrev.classList.toggle('d-none', currentStep === 1);

        if (btnNext) {
            btnNext.innerText = currentStep === totalSteps ? 'Finalizar Registro' : 'Siguiente';

            // Ocultar botón de guardado/finalizar si es solo lectura y es el último paso
            if (isUpdate && currentEmprendimiento && currentEmprendimiento.dee_estado !== 'Por Reparar' && currentStep === totalSteps) {
                btnNext.classList.add('d-none');
            } else {
                btnNext.classList.remove('d-none');
            }
        }
    }

    // Google Maps
    function initMap() {
        if (map) return; // Ya inicializado

        const defaultLat = -33.0245; // Viña del Mar
        const defaultLon = -71.5518;

        const mapElement = document.getElementById('map');
        if (!mapElement) return;

        map = new google.maps.Map(mapElement, {
            center: { lat: defaultLat, lng: defaultLon },
            zoom: 15,
            disableDefaultUI: false,
        });

        geocoder = new google.maps.Geocoder();

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            position: { lat: defaultLat, lng: defaultLon }
        });

        // Actualizar coordenadas al mover marcador
        google.maps.event.addListener(marker, 'dragend', function () {
            const pos = marker.getPosition();
            document.getElementById('input-lat').value = pos.lat();
            document.getElementById('input-lon').value = pos.lng();
        });

        // Botón Buscar
        const btnBuscar = document.getElementById('btn-buscar-direccion');
        if (btnBuscar) {
            btnBuscar.addEventListener('click', function (e) {
                e.preventDefault();
                buscarDireccion();
            });
        }
    }

    function buscarDireccion() {
        const address = document.getElementById('input-direccion').value;
        if (!address) return;

        geocoder.geocode({ 'address': address + ', Viña del Mar, Chile' }, function (results, status) {
            if (status === 'OK') {
                const pos = results[0].geometry.location;
                map.setCenter(pos);
                marker.setPosition(pos);
                document.getElementById('input-lat').value = pos.lat();
                document.getElementById('input-lon').value = pos.lng();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Dirección no encontrada',
                    text: 'No se pudo encontrar la ubicación: ' + status,
                    confirmButtonColor: '#006FB3'
                });
            }
        });
    }

    btnNext.addEventListener('click', async function () {
        if (currentStep === 1) {
            if (!selectedRubro) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Selección Requerida',
                    text: 'Por favor, seleccione una categoría para continuar.',
                    confirmButtonColor: '#006FB3'
                });
                return;
            }
            currentStep++;
            updateStepUI();
        } else if (currentStep === 2) {
            const rut = inputRut.value.trim();
            if (!rut) {
                Swal.fire({
                    icon: 'warning',
                    title: 'RUT Requerido',
                    text: 'Debe ingresar un RUT para validar su identidad.',
                    confirmButtonColor: '#006FB3'
                });
                return;
            }
            rutAlert.classList.remove('d-none');
            rutAlert.classList.add('d-flex');
            setTimeout(() => { currentStep++; updateStepUI(); }, 800);
        } else if (currentStep === 3) {
            // Recolectar todo y enviar
            const formData = new FormData();
            formData.append('ACCION', isUpdate ? 'UPDATE_FULL' : 'CREATE_FULL');
            formData.append('dee_rut', inputRut.value.trim());
            formData.append('dee_rubro', selectedRubro);
            formData.append('dee_fantasia', document.getElementById('input-fantasia').value.trim());
            formData.append('dee_descripcion', document.getElementById('input-descripcion').value.trim());
            formData.append('dee_direccion', document.getElementById('input-direccion').value.trim());
            formData.append('dee_lat', document.getElementById('input-lat').value);
            formData.append('dee_lon', document.getElementById('input-lon').value);

            // Archivos principales
            const fileCedula = document.getElementById('file-cedula').files[0];
            if (fileCedula) formData.append('file_cedula', fileCedula);

            const fileEstatutos = document.getElementById('file-estatutos').files[0];
            if (fileEstatutos) formData.append('file_estatutos', fileEstatutos);

            const filePortada = document.getElementById('file-portada').files[0];
            if (filePortada) formData.append('file_portada', filePortada);

            const fileLogo = document.getElementById('file-logo').files[0];
            if (fileLogo) formData.append('file_logo', fileLogo);

            // Documentos dinámicos
            const dynamicFiles = document.querySelectorAll('.dynamic-doc-input');
            const docsMeta = [];
            dynamicFiles.forEach((input, index) => {
                const file = input.files[0];
                if (file) {
                    formData.append('dynamic_file_' + index, file);
                    docsMeta.push({
                        id_requerida: input.getAttribute('data-doc-id'),
                        nombre: input.getAttribute('data-doc-name'),
                        index: index
                    });
                }
            });
            formData.append('docs_meta', JSON.stringify(docsMeta));

            btnNext.disabled = true;
            btnNext.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Procesando...';

            try {
                const res = await fetch('../../apivec/desarrollo_economico/inscripcion.php', {
                    method: 'POST',
                    body: formData // Enviamos como FormData para archivos
                });
                const response = await res.json();
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        text: 'Su emprendimiento y expediente han sido generados.',
                        confirmButtonColor: '#006FB3'
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en el Registro',
                        text: response.message,
                        confirmButtonColor: '#006FB3'
                    });
                    btnNext.disabled = false;
                    btnNext.innerText = 'Finalizar Registro';
                }
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de Conexión',
                    text: 'No se pudo comunicar con el servidor.',
                    confirmButtonColor: '#006FB3'
                });
                btnNext.disabled = false;
                btnNext.innerText = 'Finalizar Registro';
            }
        }
    });

    function loadMyRecords() {
        if (!myRecordsContainer) return;

        myRecordsContainer.innerHTML = '<div class="col-12 text-center p-5"><div class="spinner-border text-primary"></div><p class="mt-2 text-muted">Cargando sus emprendimientos...</p></div>';

        fetch('../../apivec/desarrollo_economico/inscripcion.php', {
            method: 'POST',
            body: JSON.stringify({ ACCION: 'GET_MY_RECORDS' }),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(res => res.json())
            .then(response => {
                console.log('Mis Registros:', response);
                if (response.status === 'success') {
                    renderMyRecords(response.data);
                } else {
                    myRecordsContainer.innerHTML = `<div class="col-12 alert alert-danger">Error: ${response.message}</div>`;
                }
            })
            .catch(err => {
                console.error('Error cargando registros:', err);
                myRecordsContainer.innerHTML = '<div class="col-12 alert alert-danger">Error de conexión al cargar sus registros</div>';
            });
    }

    function renderMyRecords(records) {
        myRecordsContainer.innerHTML = '';

        const tableContainer = document.createElement('div');
        tableContainer.className = 'col-12';
        tableContainer.innerHTML = `
        <div class="table-responsive rounded-4 border border-light">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light bg-opacity-50">
                    <tr>
                        <th class="border-0 px-4 py-3 text-uppercase text-muted small fw-bold" style="width: 80px;">Icono</th>
                        <th class="border-0 px-4 py-3 text-uppercase text-muted small fw-bold">Nombre / Fantasía</th>
                        <th class="border-0 px-4 py-3 text-uppercase text-muted small fw-bold">Rubro</th>
                        <th class="border-0 px-4 py-3 text-uppercase text-muted small fw-bold">Expediente</th>
                        <th class="border-0 px-4 py-3 text-uppercase text-muted small fw-bold">Estado</th>
                        <th class="border-0 px-4 py-3 text-uppercase text-muted small fw-bold text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody id="my-records-table-body">
                </tbody>
            </table>
        </div>
    `;
        myRecordsContainer.appendChild(tableContainer);

        const tbody = document.getElementById('my-records-table-body');

        if (records.length === 0) {
            tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center p-5 text-muted">
                    <i class="bi bi-info-circle d-block mb-2" style="font-size: 2rem;"></i>
                    Aún no tiene emprendimientos registrados. Haga clic en <strong>Agregar Nuevo</strong> para comenzar.
                </td>
            </tr>
        `;
            return;
        }

        records.forEach(rec => {
            const tr = document.createElement('tr');
            let statusClass = 'bg-warning text-warning';
            if (rec.dee_estado === 'Activo') statusClass = 'bg-success text-success';
            if (rec.dee_estado === 'Rechazado') statusClass = 'bg-danger text-danger';
            if (rec.dee_estado === 'Por Reparar') statusClass = 'bg-info text-info';

            tr.innerHTML = `
            <td class="px-4 py-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 d-inline-flex">
                    <i class="bi bi-${rec.rub_icono || 'shop'}" style="font-size: 1.2rem;"></i>
                </div>
            </td>
            <td class="px-4 py-4">
                <span class="fw-bold text-dark d-block">${rec.dee_fantasia || 'Sin Nombre'}</span>
                <span class="text-muted small">${formatRut(rec.dee_rut)}</span>
            </td>
            <td class="px-4 py-4">
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill small fw-normal px-3">${rec.rub_nombre}</span>
            </td>
            <td class="px-4 py-4">
                <span class="text-dark small fw-bold">${rec.dee_registro_general_de_expedientes || 'N/A'}</span>
            </td>
            <td class="px-4 py-4">
                <span class="status-pill ${statusClass} bg-opacity-10 border-0 fw-bold" style="font-size: 0.6rem;">${(rec.dee_estado || 'Por Validar').toUpperCase()}</span>
            </td>
            <td class="px-4 py-4 text-end">
                <button class="btn btn-sm btn-white border-light rounded-3 px-3 shadow-none btn-ver-detalles">Ver Detalles</button>
            </td>
        `;

            const btnVer = tr.querySelector('.btn-ver-detalles');
            btnVer.addEventListener('click', function () {
                cargarEmprendimiento(rec.dee_rut);
            });

            tbody.appendChild(tr);
        });
    }

    async function cargarEmprendimiento(rut) {
        Swal.fire({
            title: 'Cargando datos...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        try {
            const res = await fetch('../../apivec/desarrollo_economico/inscripcion.php', {
                method: 'POST',
                body: JSON.stringify({ ACCION: 'GET_BY_RUT', rut: rut }),
                headers: { 'Content-Type': 'application/json' }
            });
            const response = await res.json();
            Swal.close();

            if (response.status === 'success') {
                isUpdate = true;
                currentEmprendimiento = response.data;

                // Poblar campos
                inputRut.value = formatRut(currentEmprendimiento.dee_rut);
                document.getElementById('input-fantasia').value = currentEmprendimiento.dee_fantasia || '';
                document.getElementById('input-descripcion').value = currentEmprendimiento.dee_descripcion || '';
                document.getElementById('input-direccion').value = currentEmprendimiento.dee_direccion || '';
                document.getElementById('input-lat').value = currentEmprendimiento.dee_lat || '';
                document.getElementById('input-lon').value = currentEmprendimiento.dee_lon || '';

                selectedRubro = currentEmprendimiento.dee_rubro;

                // Mostrar documentos estáticos ya subidos (Cédula/Estatutos)
                renderStaticDeliveries();

                // Verificar modo solo lectura (Cualquiera excepto 'Por Reparar')
                const canEdit = currentEmprendimiento.dee_estado === 'Por Reparar';
                setFormReadOnly(!canEdit);

                // Avanzar al paso 1
                currentStep = 1;
                updateStepUI();

                // Disparar detección de empresa
                inputRut.dispatchEvent(new Event('input'));

            } else {
                Swal.fire('Error', response.message, 'error');
            }
        } catch (err) {
            console.error(err);
            Swal.fire('Error', 'No se pudo cargar el registro', 'error');
        }
    }

    function renderStaticDeliveries() {
        if (!currentEmprendimiento || !currentEmprendimiento.delivered_docs) return;

        // Limpiar contenedores previos si existen
        document.querySelectorAll('.delivered-info').forEach(el => el.remove());

        const docs = currentEmprendimiento.delivered_docs;

        // Cédula
        const ciDocs = docs.filter(d => d.dee_nombre === 'Cédula de Identidad');
        if (ciDocs.length > 0) {
            const input = document.getElementById('file-cedula');
            if (input) input.insertAdjacentHTML('afterend', `<div class="delivered-info mt-1">${renderDeliveredList(ciDocs)}</div>`);
        }

        // Estatutos
        const estDocs = docs.filter(d => d.dee_nombre === 'Estatutos Empresa');
        if (estDocs.length > 0) {
            const input = document.getElementById('file-estatutos');
            if (input) input.insertAdjacentHTML('afterend', `<div class="delivered-info mt-1">${renderDeliveredList(estDocs)}</div>`);
        }

        // Multimedia Portada
        if (currentEmprendimiento.dee_img_portada) {
            const input = document.getElementById('file-portada');
            const url = `../../apivec/gesdoc/general.php?ACCION=Bajar&doc_id=${currentEmprendimiento.dee_img_portada}`;
            if (input) input.insertAdjacentHTML('afterend', `
            <div class="delivered-info mt-1 small">
                <i class="bi bi-image text-primary"></i> 
                <a href="${url}" target="_blank" class="text-decoration-none">Imagen Portada Actual</a>
            </div>`);
        }

        // Multimedia Logo
        if (currentEmprendimiento.dee_img_logo) {
            const input = document.getElementById('file-logo');
            const url = `../../apivec/gesdoc/general.php?ACCION=Bajar&doc_id=${currentEmprendimiento.dee_img_logo}`;
            if (input) input.insertAdjacentHTML('afterend', `
            <div class="delivered-info mt-1 small">
                <i class="bi bi-image text-primary"></i> 
                <a href="${url}" target="_blank" class="text-decoration-none">Logo Actual</a>
            </div>`);
        }
    }

    function setFormReadOnly(readOnly) {
        const inputs = [
            inputRut,
            document.getElementById('input-fantasia'),
            document.getElementById('input-descripcion'),
            document.getElementById('input-direccion'),
            document.getElementById('file-cedula'),
            document.getElementById('file-estatutos'),
            document.getElementById('file-portada'),
            document.getElementById('file-logo')
        ];

        inputs.forEach(input => {
            if (input) input.disabled = readOnly;
        });

        const btnBuscar = document.getElementById('btn-buscar-direccion');
        if (btnBuscar) btnBuscar.disabled = readOnly;

        // Para rubros, manejaremos en renderRubros
        // Para documentos dinámicos, en renderRequiredDocs
    }

    if (btnPrev) {
        btnPrev.addEventListener('click', function () {
            if (currentStep > 0) {
                currentStep--;
                updateStepUI();
            }
        });
    }

    if (btnAddNew) {
        btnAddNew.addEventListener('click', function () {
            isUpdate = false;
            currentEmprendimiento = null;
            selectedRubro = null;

            // Limpiar formulario
            const formInputs = document.querySelectorAll('input:not([type="hidden"]), textarea');
            formInputs.forEach(input => {
                input.value = '';
                input.disabled = false;
            });
            setFormReadOnly(false);

            currentStep = 1;
            updateStepUI();
        });
    }

    updateStepUI();
});
