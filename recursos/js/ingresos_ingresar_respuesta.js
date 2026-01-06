let currentSol = null;
let currentUser = null;

document.addEventListener('DOMContentLoaded', async function () {
    // Ensure API_BASE_URL is available
    const API_BASE_URL = window.location.origin + '/api';
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const loadingDiv = document.getElementById('loading-check');
    const containerDiv = document.getElementById('step-2');

    if (!id) {
        // alert("ID de solicitud faltante");
        const manualId = prompt("Por favor ingrese el ID de la solicitud:");
        if (manualId) {
            window.location.search = `?id=${manualId}`;
            return;
        } else {
            window.location.href = '../page.html';
            return;
        }
    }

    try {
        // 1. Verify Session & Get User ID
        const sessionRes = await fetch(`${API_BASE_URL}/verify_session.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "" })
        });
        const sessionData = await sessionRes.json();

        if (!sessionData.isAuthenticated || !sessionData.user) {
            alert("Debe iniciar sesión para acceder a esta página.");
            window.location.href = '../page.html';
            return;
        }

        currentUser = sessionData.user;

        // 2. Load Solicitud Data
        const response = await fetch(`${API_BASE_URL}/solicitudes.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sol_id: id, ACCION: "CONSULTAM" })
        });
        const result = await response.json();

        if (result.status === 'success' && result.data) {
            currentSol = result.data;

            // 3. Security Check: Is this user the assigned official?
            // Convert both to strings/numbers to ensure safe comparison
            console.log(`Verifying Official Assignment: Solicitud(${currentSol.sol_funcionario_id}) vs User(${currentUser.id})`);

            if (String(currentSol.sol_funcionario_id) !== String(currentUser.id)) {
                // If funcionario_id is null/0, maybe allow any admin? For now, strict check per user request.
                alert(`ACCESO DENEGADO.\nEsta solicitud está asignada al funcionario #${currentSol.sol_funcionario_id} y usted es #${currentUser.id}.`);
                window.location.href = 'patentes_mis_solicitudes.html'; // Or dashboard
                return;
            }

            // Success: User is authorized
            loadingDiv.classList.add('d-none');
            containerDiv.classList.remove('d-none');
            renderSolicitationInfo();

        } else {
            alert("No se encontró la solicitud o hubo un error.");
            window.history.back();
        }

    } catch (e) {
        console.error("Error loading data:", e);
        alert("Error de conexión");
    }
});

function renderSolicitationInfo() {
    if (!currentSol) return;
    document.getElementById('display-expediente').innerText = currentSol.sol_nombre_expediente;
    document.getElementById('display-id').innerText = currentSol.sol_id;
    document.getElementById('display-vencimiento').innerText = new Date(currentSol.sol_fecha_vencimiento).toLocaleString();
    document.getElementById('display-detalle').innerText = currentSol.sol_detalle || 'Sin detalle';
}

async function saveResponse() {
    const responseText = document.getElementById('input-respuesta').value;
    const isDefinitiva = document.getElementById('check-respuesta-definitiva').checked;

    if (!responseText.trim()) {
        alert("Por favor ingrese un contenido para la respuesta.");
        return;
    }

    if (!currentSol || !currentSol.sol_id) {
        alert("Error: No hay solicitud activa.");
        return;
    }

    const payload = {
        ACCION: "CREAR",
        res_solicitud_id: currentSol.sol_id,
        res_texto: responseText,
        res_tipo: isDefinitiva ? 'Definitiva' : 'Observación',
        // res_usuario_id: currentUser.id // Should be handled by session or added if backend requires it explicit
    };

    // Add user_id explicitly if Controller relies on it (RespuestaController didn't show it but good practice if AuthController doesn't inject it)
    // Actually, looking at the code, it uses data['res_solicitud_id'].
    // Let's assume the backend might need the user ID or it tracks it via session logic. 
    // The current RespuestaController doesn't seem to enforce user ID in the simplistic create, 
    // but the `trd_ingresos_respuestas` table almost certainly has a `res_usuario_id` column.
    // I will include it to be safe.
    payload.res_usuario_id = currentUser.id;

    try {
        const response = await fetch(`${window.API_BASE_URL}/respuestas.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (result.status === 'success' || result.success) {
            alert("Respuesta guardada correctamente.");
            window.location.href = 'bandeja.html';
        } else {
            alert(`Error al guardar: ${result.message}`);
        }
    } catch (e) {
        console.error("Error saving response:", e);
        alert("Error de conexión al guardar la respuesta.");
    }
}
