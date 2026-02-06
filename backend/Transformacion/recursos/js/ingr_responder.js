document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (!id) {
        await checkAndRequestID();
        return;
    }

    const sessionUser = await checkSession();
    if (!sessionUser) return; // checkSession handles redirect

    await cargarDatos(id, sessionUser.id);
    setupEventListeners();
});

let currentId = null;
let currentRgtId = null;
let currentUserId = null;
let modalComentario = null;

async function checkSession() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/verify_session.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "" })
        });
        const data = await response.json();
        if (data.isAuthenticated) {
            return data.user;
        } else {
            window.location.href = '../index.php';
            return null;
        }
    } catch (e) {
        console.error("Session check failed", e);
        return null;
    }
}

async function cargarDatos(id, userId) {
    try {
        currentUserId = userId;
        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM', ing_id: id })
        });

        const result = await response.json();

        if (result.status === 'success') {
            const data = result.data;
            currentId = data.tis_id;
            currentRgtId = data.tis_registro_tramite;

            // RBAC Enforcement
            IngrPermissions.applyToUI(data.rol_usuario);

            // VALIDAR ACCESO Y ROL
            validarAccesoYRenderizarAcciones(data, userId);

            renderizarDetalles(data);
            renderizarTablaDestinos(data.destinos);
            renderizarComentarios(data.comentarios || []);
        } else {
            Swal.fire('Error', result.message || 'No se pudo cargar la información.', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire('Error', 'Error de conexión al servidor.', 'error');
    }
}

function renderizarTablaDestinos(destinos) {
    const tbody = document.getElementById('tabla_destinos_status');
    tbody.innerHTML = '';

    if (!destinos || destinos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted small">Sin destinos asignados.</td></tr>';
        return;
    }

    destinos.forEach(d => {
        const esRequerido = d.tid_requeido == 1; // Note: Database column spelling might be 'tid_requeido' based on previous context
        let estadoBadge = '<span class="badge bg-secondary">Pendiente</span>';

        if (d.tid_responde == 1) {
            estadoBadge = '<span class="badge bg-success">Aprobado</span>';
        } else if (d.tid_responde == 0 && d.tid_fecha_respuesta) {
            // Check fecha_respuesta because 0 might be default equivalent to null in some db setups if not nullable, 
            // but strict null check is safer if logic uses null for pending. 
            // Assuming model logic: null = pending, 0 = rejected, 1 = approved
            // If DB column is not nullable default 0, this logic might need adjust. 
            // Based on model update: tid_responde = :responde (0 or 1). 
            // We should assume null is pending.
            estadoBadge = '<span class="badge bg-danger">Rechazado</span>';
        } else if (d.tid_responde === '0') { // String check if API returns strings
            estadoBadge = '<span class="badge bg-danger">Rechazado</span>';
        }

        // If d.tid_responde is null, it's pending.

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <div class="d-flex align-items-center">
                    <div class="avatar-initials bg-light text-primary me-2" style="width:24px; height:24px; font-size:10px;">
                        ${(d.usr_nombre || '?').charAt(0)}${(d.usr_apellido || '?').charAt(0)}
                    </div>
                    <span>${d.usr_nombre} ${d.usr_apellido}</span>
                </div>
            </td>
            <td><span class="badge bg-light text-dark border">${d.tid_facultad}</span></td>
            <td>${esRequerido ? '<i data-feather="lock" class="text-danger" style="width:14px;"></i>' : '-'}</td>
            <td class="text-end">${estadoBadge}</td>
        `;
        tbody.appendChild(tr);
    });
    if (window.feather) feather.replace();
}

function validarAccesoYRenderizarAcciones(data, userId) {
    const destinos = data.destinos || [];
    // Convert both to strings or integers for safe comparison
    const MiRelacion = destinos.find(d => parseInt(d.tid_destino) === parseInt(userId));

    if (!MiRelacion) {
        Swal.fire({
            title: 'Acceso Restringido',
            text: 'Usted no tiene autorización para responder esta solicitud.',
            icon: 'warning',
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: 'Volver a Bandeja'
        }).then(() => {
            window.location.href = 'ingr_bandeja.php';
        });
        return;
    }

    if (MiRelacion.tid_facultad === 'Consultor') {
        Swal.fire({
            title: 'Modo Consulta',
            text: 'Usted tiene acceso como Consultor. Redirigiendo a vista de consulta.',
            icon: 'info',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = `ingr_consultar.php?id=${currentId}`;
        });
        return;
    }

    // Check if user already responded
    // If tid_fecha_respuesta is present or tid_responde is not null/undefined (considering 0 is valid response)
    if (MiRelacion.tid_fecha_respuesta || (MiRelacion.tid_responde !== null && MiRelacion.tid_responde !== undefined)) {
        Swal.fire({
            title: 'Respuesta ya registrada',
            text: 'Usted ya ha emitido su respuesta para esta solicitud. Se redirigirá a la vista de consulta.',
            icon: 'info',
            confirmButtonText: 'Ver Detalle',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = `ingr_consultar.php?id=${currentId}`;
        });
        return;
    }

    renderizarAcciones(MiRelacion.tid_facultad);
}

function renderizarAcciones(facultad) {
    const contenedor = document.getElementById('contenedor_acciones');
    contenedor.innerHTML = '';

    if (facultad === 'Firmante') {
        contenedor.innerHTML = `
            <button type="button" class="btn btn-toolbar me-2" onclick="enviarRespuesta('Resuelto_NO_Favorable', 'rechazar')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> Rechazar
            </button>
            <button type="button" class="btn btn-toolbar" style="background-color: #198754; color: white; border-color: #198754;" onclick="enviarRespuesta('Resuelto_Favorable', 'firmar')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Firmar
            </button>
        `;
    } else if (facultad === 'Visador') {
        contenedor.innerHTML = `
            <button type="button" class="btn btn-toolbar me-2" onclick="enviarRespuesta('Resuelto_NO_Favorable', 'rechazar')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> Rechazar
            </button>
            <button type="button" class="btn btn-toolbar" style="background-color: #0d6efd; color: white; border-color: #0d6efd;" onclick="enviarRespuesta('Resuelto_Favorable', 'visar')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> Visar
            </button>
        `;
    } else if (facultad === 'Responsable') {
        contenedor.innerHTML = `
            <button type="button" class="btn btn-toolbar me-2" onclick="enviarRespuesta('Resuelto_NO_Favorable', 'rechazar')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> Rechazar
            </button>
            <button type="button" class="btn btn-toolbar" style="background-color: #0d6efd; color: white; border-color: #0d6efd;" onclick="enviarRespuesta('Resuelto_Favorable', 'responder')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> Responder
            </button>
        `;
    }

    if (window.feather) window.feather.replace();
}

function renderizarDetalles(data) {
    document.getElementById('subtitulo_ingreso').innerText = `Gestión de Respuesta: ${data.tis_titulo} (ID: ${data.tis_id})`;
    document.getElementById('info_titulo').innerText = data.tis_titulo || '-';
    document.getElementById('info_contenido').innerText = data.tis_contenido || 'Sin contenido';

    const estadoEl = document.getElementById('info_estado');
    estadoEl.innerText = data.tis_estado || 'Pendiente';

    // Status badges styling
    estadoEl.className = 'badge';
    switch (data.tis_estado) {
        case 'Resuelto_Favorable': estadoEl.classList.add('bg-success'); break;
        case 'Resuelto_NO_Favorable': estadoEl.classList.add('bg-dark'); break;
        default: estadoEl.classList.add('bg-primary');
    }
}

function renderizarComentarios(array) {
    const container = document.getElementById('lista_comentarios');
    container.innerHTML = '';

    if (array.length === 0) {
        container.innerHTML = '<div class="text-center py-3 text-muted small">No hay comentarios previos.</div>';
        return;
    }

    array.forEach(com => {
        const div = document.createElement('div');
        div.className = 'list-group-item py-3 px-0 border-0 border-bottom bg-transparent';
        div.innerHTML = `
            <div class="d-flex justify-content-between mb-1">
                <span class="fw-bold small text-primary">${com.usr_nombre} ${com.usr_apellido}</span>
                <span class="text-muted" style="font-size: 0.7rem;">${com.gco_fecha.substring(0, 10)}</span>
            </div>
            <div class="small text-dark">${com.gco_comentario}</div>
        `;
        container.appendChild(div);
    });
}

let otpTimerInterval = null;
let otpModal = null;

function setupEventListeners() {
    modalComentario = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));
    otpModal = new bootstrap.Modal(document.getElementById('modalOTP'));

    document.getElementById('btn_abrir_comentario').onclick = () => modalComentario.show();
    document.getElementById('form_responder_ingreso').onsubmit = (e) => e.preventDefault();

    const btnIrPreparar = document.getElementById('btn_ir_preparar');
    if (btnIrPreparar) {
        btnIrPreparar.onclick = () => {
            window.location.href = `ingr_preparar.php?id=${currentId}`;
        };
    }
}

async function enviarRespuesta(estado, accionLabel) {
    const respuesta = document.getElementById('tis_respuesta').value.trim();

    if (accionLabel === 'firmar') {
        const confirm = await Swal.fire({
            title: `Iniciar Proceso de Firma`,
            text: `Se enviará un código de verificación a su correo. ¿Desea continuar?`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Sí, enviar código',
            cancelButtonText: 'Cancelar'
        });
        if (!confirm.isConfirmed) return;

        iniciarFirma(estado, accionLabel, respuesta);
    } else {
        // Normal Flow (Reject / Visar)
        const confirm = await Swal.fire({
            title: `¿Confirmar acción de ${accionLabel}?`,
            text: `¿Está seguro de querer ${accionLabel} este trámite?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, confirmar',
            cancelButtonText: 'Cancelar'
        });
        if (!confirm.isConfirmed) return;

        procesarRespuesta(estado, accionLabel, respuesta, null);
    }
}

async function iniciarFirma(estado, accionLabel, respuesta) {
    try {
        Swal.fire({ title: 'Enviando código...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: 'INIT_FIRMA',
                ing_id: currentId
            })
        });

        const result = await response.json();
        Swal.close();

        if (result.status === 'success') {
            document.getElementById('inp_otp_code').value = '';
            otpModal.show();
            startOTPTimer();

            // Store pending data for OTP submission
            window.pendingResponseData = { estado, accionLabel, respuesta };
        } else {
            Swal.fire('Error', result.message || 'Error al iniciar firma.', 'error');
        }
    } catch (e) {
        Swal.fire('Error', 'Error de conexión.', 'error');
    }
}

function startOTPTimer() {
    let timeLeft = 240; // 4 minutes
    const timerDisplay = document.getElementById('otp_timer');

    clearInterval(otpTimerInterval);
    otpTimerInterval = setInterval(() => {
        const m = Math.floor(timeLeft / 60);
        const s = timeLeft % 60;
        timerDisplay.innerText = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;

        timeLeft--;
        if (timeLeft < 0) {
            cerrarOTP(false);
            Swal.fire('Tiempo Expirado', 'El tiempo para ingresar el código ha expirado. El proceso se ha cancelado.', 'warning');
        }
    }, 1000);
}

function cerrarOTP(manual) {
    clearInterval(otpTimerInterval);
    otpModal.hide();
    window.pendingResponseData = null;
    if (manual) {
        // Just closed by user
    }
}

async function confirmarFirmaOTP() {
    const code = document.getElementById('inp_otp_code').value.trim();
    if (code.length !== 6) {
        Swal.fire('Atención', 'El código debe tener 6 dígitos.', 'warning');
        return;
    }

    const { estado, accionLabel, respuesta } = window.pendingResponseData;
    cerrarOTP(false); // Stop timer, close modal

    procesarRespuesta(estado, accionLabel, respuesta, code);
}

async function procesarRespuesta(estado, accionLabel, respuesta, otp) {
    try {
        Swal.fire({ title: 'Procesando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        // 1. Handle File Upload if present
        const fileInput = document.getElementById('inp_archivo_decreto');
        if (fileInput && fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const formData = new FormData();
            formData.append('ACCION', 'Subir');
            formData.append('tramite_id', currentId);
            formData.append('responsable_id', currentUserId); // Assuming currentUserId is set
            formData.append('es_docdigital', 0);

            // Rename file with prefix
            const renamedFile = new File([file], `Decreto - ${file.name}`, { type: file.type });
            formData.append('archivo', renamedFile);
            formData.append('doc_nombre_documento', renamedFile.name);

            try {
                const uploadResp = await fetch(`${window.API_BASE_URL}/gesdoc_general.php`, {
                    method: 'POST',
                    body: formData
                });
                const uploadResult = await uploadResp.json();

                if (uploadResult.status !== 'success') {
                    Swal.fire('Error', `Error al subir el decreto: ${uploadResult.message}`, 'error');
                    location.href = 'ingr_consultar.php?id=' + currentId;
                    return; // Stop process
                }
            } catch (uploadErr) {
                console.error("Upload error:", uploadErr);
                Swal.fire('Error', 'Error de red al subir el documento.', 'error');
                return;
            }
        }

        // 2. Proceed with Response Logic
        const payload = {
            ACCION: 'RESPONDER',
            ing_id: currentId,
            tis_respuesta: respuesta,
            tis_estado: estado,
            accion_label: accionLabel
        };
        if (otp) payload.otp = otp;

        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (result.status === 'success') {
            Swal.fire('¡Éxito!', `El trámite ha sido procesado (${accionLabel}) correctamente.`, 'success').then(() => {
                location.reload();
            });
        } else {
            Swal.fire('Error', result.message || 'No se pudo procesar la solicitud.', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire('Error', 'Ocurrió un error al procesar la respuesta.', 'error');
    }
}

async function guardarComentario() {
    const texto = document.getElementById('textoNuevoComentario').value.trim();
    if (!texto) {
        Swal.fire('Atención', 'Por favor escriba un comentario.', 'warning');
        return;
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/comentarios.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: "CREAR",
                rgt_id: currentRgtId,
                gco_texto: texto
            })
        });

        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoComentario').value = '';
            modalComentario.hide();
            Swal.fire({
                icon: 'success',
                title: '¡Guardado!',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                cargarDatos(currentId, currentUserId);
            });
        } else {
            Swal.fire('Error', result.message || 'No se pudo guardar el comentario.', 'error');
        }
    } catch (e) {
        console.error("Error saving comment:", e);
        Swal.fire('Error', 'Error de conexión al guardar.', 'error');
    }
}
window.guardarComentario = guardarComentario;
window.enviarRespuesta = enviarRespuesta;
window.confirmarFirmaOTP = confirmarFirmaOTP;
window.cerrarOTP = cerrarOTP;

async function checkAndRequestID() {
    const { value: formValues } = await Swal.fire({
        title: 'Trámite no especificado',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="tis_id">ID Interno (Solicitud)</option>
                    <option value="rgt_id_publica" selected>Cód. Público (Ej: H3k9L2p1)</option>
                    <option value="rgt_id">ID Trámite (RGT)</option>
                </select>
            </div>
            <div class="mb-2 text-start">
                <label class="form-label small fw-bold">Valor:</label>
                <input id="swal-id-value" class="form-control" placeholder="Ingrese el valor...">
            </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Buscar',
        cancelButtonText: 'Volver a Bandeja',
        allowOutsideClick: false,
        preConfirm: () => {
            const type = document.getElementById('swal-id-type').value;
            const value = document.getElementById('swal-id-value').value.trim();
            if (!value) {
                Swal.showValidationMessage('¡Debe ingresar un valor!');
                return false;
            }
            return { type, value };
        }
    });

    if (!formValues) {
        window.location.href = 'ingr_bandeja.php';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        let foundId = null;
        const payload = { ACCION: 'CONSULTAM' };

        // Match payload field to selected type
        if (type === 'tis_id') payload.tis_id = value;
        else if (type === 'rgt_id_publica') payload.rgt_id_publica = value;
        else if (type === 'rgt_id') payload.rgt_id = value;

        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        }).then(r => r.json());

        if (response.status === 'success' && response.data) {
            const results = Array.isArray(response.data) ? response.data : [response.data];

            if (results.length > 0 && results[0].tis_id) {
                foundId = results[0].tis_id;
            }
        }

        if (foundId) {
            Swal.close();
            // Reload with correct ID
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set('id', foundId);
            window.location.href = newUrl.toString();
        } else {
            Swal.fire('No encontrado', 'No se encontró ninguna solicitud con ese criterio.', 'error').then(() => {
                checkAndRequestID(); // Retry
            });
        }

    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
}

