const MOCK_PASSWORD = "admin";
let currentSol = null;

document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (!id) {
        alert("ID de solicitud faltante");
        window.history.back();
        return;
    }

    document.getElementById('auth-display-id').innerText = `#${id}`;

    // Load SOL data for display in step 2
    try {
        const solData = await fetch('../recursos/jsons/ingresos_solicitudes.json').then(r => r.json());
        currentSol = solData.find(s => s.ID_Solicitud === parseInt(id));

        if (!currentSol) {
            alert("No se encontró la solicitud");
            window.history.back();
        }
    } catch (e) {
        console.error("Error loading solicitudes:", e);
    }
});

function verifyPassword() {
    const pass = document.getElementById('input-password').value;
    const errorDiv = document.getElementById('auth-error');

    if (pass === MOCK_PASSWORD) {
        document.getElementById('step-1').classList.add('d-none');
        document.getElementById('step-2').classList.remove('d-none');
        renderSolicitationInfo();
    } else {
        errorDiv.classList.remove('d-none');
    }
}

function renderSolicitationInfo() {
    if (!currentSol) return;
    document.getElementById('display-expediente').innerText = currentSol.Nombre_expediente;
    document.getElementById('display-id').innerText = currentSol.ID_Solicitud;
    document.getElementById('display-vencimiento').innerText = currentSol.Fecha_vecimiento;
    document.getElementById('display-detalle').innerText = currentSol.Detalle_ingreso || 'Sin detalle';
}

function saveResponse() {
    const respValue = document.getElementById('input-respuesta').value;
    if (!respValue.trim()) {
        alert("Por favor ingrese una respuesta.");
        return;
    }

    alert(`Respuesta para solicitud #${currentSol.ID_Solicitud} guardada correctamente (Simulado).`);
    window.location.href = `ingresos_ingreso_ingresos.html?id=${currentSol.ID_Solicitud}`;
}
