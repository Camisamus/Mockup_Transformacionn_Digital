// Add to patentes_solicitud_unica.js

// ... inside DOMContentLoaded ...

// Mock Drafts Data
const mockBorradores = [
    {
        id: 1,
        fecha: '14/12/2024 10:30',
        tramites: ['PATENTE COMERCIAL', 'PATENTE DE ALCOHOLES'],
        progreso: 'Paso 2'
    },
    {
        id: 2,
        fecha: '10/12/2024 15:45',
        tramites: ['PATENTE INDUSTRIAL'],
        progreso: 'Paso 1'
    }
];

function initBorradores() {
    const section = document.getElementById('borradoresSection');
    const container = document.getElementById('borradoresContainer');
    const count = document.getElementById('borradoresCount');

    if (mockBorradores.length > 0) {
        section.classList.remove('d-none');
        count.textContent = mockBorradores.length;

        container.innerHTML = '';
        mockBorradores.forEach(draft => {
            const item = document.createElement('a');
            item.href = '#';
            item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';
            item.onclick = (e) => loadDraft(e, draft);
            item.innerHTML = `
                    <div>
                        <div class="fw-bold text-dark">Solicitud #${draft.id} - ${draft.tramites.join(', ')}</div>
                        <small class="text-muted">Guardado: ${draft.fecha} | Progreso: ${draft.progreso}</small>
                    </div>
                    <button class="btn btn-sm btn-outline-primary">
                        <i data-feather="play-circle"></i> Continuar
                    </button>
                `;
            container.appendChild(item);
        });
        feather.replace();
    }
}

function loadDraft(e, draft) {
    e.preventDefault();
    alert(`Cargando borrador #${draft.id}...\n(Esta funcionalidad simularía la carga de datos)`);
    // Here we would populate state and move step
}

// Call initBorradores in initApplication
