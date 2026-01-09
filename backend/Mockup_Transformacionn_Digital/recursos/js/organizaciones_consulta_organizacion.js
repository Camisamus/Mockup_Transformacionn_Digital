// Logic for Consulta Organizacion Page

document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements - Form Fields
    const formFields = {
        // Información General
        tipoOrganizacion: document.getElementById('tipoOrganizacion'),
        codigo: document.getElementById('codigo'),
        rut: document.getElementById('rut'),
        rpj: document.getElementById('rpj'),
        categoria: document.getElementById('categoria'),
        subcategoria: document.getElementById('subcategoria'),
        estado: document.getElementById('estado'),
        nombre: document.getElementById('nombre'),
        razonSocial: document.getElementById('razonSocial'),
        unidadVecinal: document.getElementById('unidadVecinal'),
        registro: document.getElementById('registro'),
        folio: document.getElementById('folio'),
        fechaRegistro: document.getElementById('fechaRegistro'),
        numeroSocios: document.getElementById('numeroSocios'),
        adecuacionEstatuto: document.getElementById('adecuacionEstatuto'),
        fechaAdecuacion: document.getElementById('fechaAdecuacion'),
        leyDeporte: document.getElementById('leyDeporte'),
        fechaLeyDeporte: document.getElementById('fechaLeyDeporte'),
        personalidadJuridica: document.getElementById('personalidadJuridica'),
        otorgadaPor: document.getElementById('otorgadaPor'),

        // Objeto Social
        objetoTipoOrganizacion: document.getElementById('objetoTipoOrganizacion'),
        areaEspecializacion: document.getElementById('areaEspecializacion'),
        fechaIngreso: document.getElementById('fechaIngreso'),
        fechaTermino: document.getElementById('fechaTermino'),
        descripcionObjeto: document.getElementById('descripcionObjeto'),

        // Representante Legal
        repRut: document.getElementById('repRut'),
        repApellidoPaterno: document.getElementById('repApellidoPaterno'),
        repApellidoMaterno: document.getElementById('repApellidoMaterno'),
        repNombres: document.getElementById('repNombres'),

        // Domicilio
        domCalle: document.getElementById('domCalle'),
        domNumero: document.getElementById('domNumero'),
        domBloque: document.getElementById('domBloque'),
        domDepartamento: document.getElementById('domDepartamento'),
        domComunaCodigo: document.getElementById('domComunaCodigo'),
        domComunaNombre: document.getElementById('domComunaNombre'),
        domSector: document.getElementById('domSector'),
        domTelefono: document.getElementById('domTelefono'),
        domTelefonoSecundario: document.getElementById('domTelefonoSecundario'),
        domCelular: document.getElementById('domCelular'),
        domCorreo: document.getElementById('domCorreo'),

        // Elecciones
        elecFechaUltima: document.getElementById('elecFechaUltima'),
        elecFechaVencimiento: document.getElementById('elecFechaVencimiento'),

        // SUBDERE
        subFechaInscripcion: document.getElementById('subFechaInscripcion'),
        subInscripcion: document.getElementById('subInscripcion'),
        subFechaActualizacion: document.getElementById('subFechaActualizacion'),

        // Observaciones y Antecedentes
        observaciones: document.getElementById('observaciones'),
        antecedentesFinancieros: document.getElementById('antecedentesFinancieros')
    };

    // Tables
    const tablaAtenciones = document.getElementById('tablaAtenciones');
    const tablaProyectos = document.getElementById('tablaProyectos');

    let organizacionData = null;
    let atencionesData = [];
    let proyectosData = [];

    // Initialize
    loadOrganizacion();
    loadAtenciones();
    loadProyectos();

    // Load organization data from JSON
    function loadOrganizacion() {
        fetch('../recursos/jsons/organizaciones_organizacion_mock.json')
            .then(response => response.json())
            .then(data => {
                organizacionData = data.organizacion;
                populateForm();
            })
            .catch(error => console.error('Error loading organization data:', error));
    }

    // Load atenciones data from JSON
    function loadAtenciones() {
        fetch('../recursos/jsons/organizaciones_atenciones_mock.json')
            .then(response => response.json())
            .then(data => {
                atencionesData = data.atenciones;
                renderAtenciones();
            })
            .catch(error => console.error('Error loading atenciones:', error));
    }

    // Load proyectos data from JSON
    function loadProyectos() {
        fetch('../recursos/jsons/organizaciones_proyectos_mock.json')
            .then(response => response.json())
            .then(data => {
                proyectosData = data.proyectos;
                renderProyectos();
            })
            .catch(error => console.error('Error loading proyectos:', error));
    }

    // Populate form with organization data
    function populateForm() {
        if (!organizacionData) return;

        // Información General
        setFieldValue(formFields.tipoOrganizacion, organizacionData.tipoOrganizacion);
        setFieldValue(formFields.codigo, organizacionData.codigo);
        setFieldValue(formFields.rut, organizacionData.rut);
        setFieldValue(formFields.rpj, organizacionData.rpj);
        setFieldValue(formFields.categoria, organizacionData.categoria);
        setFieldValue(formFields.subcategoria, organizacionData.subcategoria);
        setFieldValue(formFields.estado, organizacionData.estado);
        setFieldValue(formFields.nombre, organizacionData.nombre);
        setFieldValue(formFields.razonSocial, organizacionData.razonSocial);
        setFieldValue(formFields.unidadVecinal, organizacionData.unidadVecinal);
        setFieldValue(formFields.registro, organizacionData.registro);
        setFieldValue(formFields.folio, organizacionData.folio);
        setFieldValue(formFields.fechaRegistro, organizacionData.fechaRegistro);
        setFieldValue(formFields.numeroSocios, organizacionData.numeroSocios);
        setFieldValue(formFields.adecuacionEstatuto, organizacionData.adecuacionEstatuto);
        setFieldValue(formFields.fechaAdecuacion, organizacionData.fechaAdecuacion);
        setFieldValue(formFields.leyDeporte, organizacionData.leyDeporte);
        setFieldValue(formFields.fechaLeyDeporte, organizacionData.fechaLeyDeporte);
        setFieldValue(formFields.personalidadJuridica, organizacionData.personalidadJuridica);
        setFieldValue(formFields.otorgadaPor, organizacionData.otorgadaPor);

        // Objeto Social
        if (organizacionData.objetoSocial) {
            setFieldValue(formFields.objetoTipoOrganizacion, organizacionData.objetoSocial.tipoOrganizacion);
            setFieldValue(formFields.areaEspecializacion, organizacionData.objetoSocial.areaEspecializacion);
            setFieldValue(formFields.fechaIngreso, organizacionData.objetoSocial.fechaIngreso);
            setFieldValue(formFields.fechaTermino, organizacionData.objetoSocial.fechaTermino);
            setFieldValue(formFields.descripcionObjeto, organizacionData.objetoSocial.descripcion);
        }

        // Representante Legal
        if (organizacionData.representanteLegal) {
            const rep = organizacionData.representanteLegal;
            setFieldValue(formFields.repRut, rep.rut);
            setFieldValue(formFields.repApellidoPaterno, rep.apellidoPaterno);
            setFieldValue(formFields.repApellidoMaterno, rep.apellidoMaterno);
            setFieldValue(formFields.repNombres, rep.nombres);
        }

        // Domicilio
        if (organizacionData.domicilio) {
            const dom = organizacionData.domicilio;
            setFieldValue(formFields.domCalle, dom.calle);
            setFieldValue(formFields.domNumero, dom.numero);
            setFieldValue(formFields.domBloque, dom.bloque);
            setFieldValue(formFields.domDepartamento, dom.departamento);
            setFieldValue(formFields.domComunaCodigo, dom.comunaCodigo);
            setFieldValue(formFields.domComunaNombre, dom.comunaNombre);
            setFieldValue(formFields.domSector, dom.sector);
            setFieldValue(formFields.domTelefono, dom.telefono);
            setFieldValue(formFields.domTelefonoSecundario, dom.telefonoSecundario);
            setFieldValue(formFields.domCelular, dom.celular);
            setFieldValue(formFields.domCorreo, dom.correo);
        }

        // Elecciones
        if (organizacionData.elecciones) {
            setFieldValue(formFields.elecFechaUltima, organizacionData.elecciones.fechaUltima);
            setFieldValue(formFields.elecFechaVencimiento, organizacionData.elecciones.fechaVencimiento);
        }

        // SUBDERE
        if (organizacionData.subdere) {
            setFieldValue(formFields.subFechaInscripcion, organizacionData.subdere.fechaInscripcion);
            setFieldValue(formFields.subInscripcion, organizacionData.subdere.inscripcion);
            setFieldValue(formFields.subFechaActualizacion, organizacionData.subdere.fechaActualizacion);
        }

        // Observaciones y Antecedentes
        setFieldValue(formFields.observaciones, organizacionData.observaciones);
        setFieldValue(formFields.antecedentesFinancieros, organizacionData.antecedentesFinancieros);
    }

    // Helper function to set field value
    function setFieldValue(field, value) {
        if (field && value !== null && value !== undefined) {
            field.value = value;
        }
    }

    // Render atenciones table
    function renderAtenciones() {
        const tbody = tablaAtenciones.querySelector('tbody');
        tbody.innerHTML = '';

        if (atencionesData.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center text-muted">No hay atenciones registradas</td>
                </tr>
            `;
            return;
        }

        atencionesData.forEach(atencion => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${atencion.numeroAtencion}</td>
                <td>${atencion.fecha}</td>
                <td>${atencion.atencion}</td>
                <td>${atencion.proyecto}</td>
                <td><span class="badge ${atencion.estadoClass}">${atencion.estado}</span></td>
                <td>${atencion.usuario}</td>
                <td><button class="btn btn-sm btn-outline-secondary">✏️</button></td>
            `;
            tbody.appendChild(row);
        });
    }

    // Render proyectos table
    function renderProyectos() {
        const tbody = tablaProyectos.querySelector('tbody');
        tbody.innerHTML = '';

        if (proyectosData.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-muted">No hay proyectos registrados</td>
                </tr>
            `;
            return;
        }

        proyectosData.forEach(proyecto => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${proyecto.unidad}</td>
                <td>${proyecto.anio}</td>
                <td>${proyecto.numeroIngreso}</td>
                <td>${proyecto.nombreProyecto}</td>
                <td>${proyecto.tipoFondo}</td>
                <td><button class="btn btn-sm btn-outline-secondary">✏️</button></td>
            `;
            tbody.appendChild(row);
        });
    }
});

// Global functions for action buttons
async function limpiarFormulario() {
    const result = await Swal.fire({
        title: '¿Está seguro?',
        text: '¿Está seguro que desea limpiar el formulario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, limpiar',
        cancelButtonText: 'Cancelar'
    });
    if (result.isConfirmed) {
        location.reload();
    }
}

function editarFormulario() {
    Swal.fire('Modo Edición', 'Modo de edición activado\n(Funcionalidad de mockup)', 'info');
    // Enable all form fields
    document.querySelectorAll('input, select, textarea').forEach(field => {
        field.removeAttribute('readonly');
        field.removeAttribute('disabled');
    });
}

function guardarCambios() {
    Swal.fire('Éxito', 'Cambios guardados exitosamente\n(Funcionalidad de mockup)', 'success');
}
