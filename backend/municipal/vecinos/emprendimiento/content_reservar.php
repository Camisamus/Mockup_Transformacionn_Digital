<div class="row mb-4 align-items-center">
    <div class="col-md-7 mb-3 mb-md-0">
        <h2 class="h1 font-serif font-weight-bold text-dark mb-2">Reserva de Plazas - Marzo 2026</h2>
        <p class="text-muted lead" style="font-size: 16px;">Gestiona tus créditos mensuales para asegurar tu lugar en las ferias municipales.</p>
    </div>
    <div class="col-md-5">
        <div class="card border-0 shadow-sm" style="border-radius: 15px; border-left: 5px solid var(--gob-primary) !important;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <p class="font-weight-bold text-dark mb-0">Créditos Disponibles</p>
                    <p id="credits-count" class="h3 font-weight-black text-primary mb-0">14</p>
                </div>
                <div class="progress mb-2" style="height: 8px; border-radius: 10px;">
                    <div id="credits-progress" class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted text-uppercase font-weight-bold" style="font-size: 9px; letter-spacing: 0.1em;">Saldo Mensual</small>
                    <span class="badge badge-primary-soft text-primary font-weight-bold py-1 px-2" style="font-size: 9px; background: rgba(0, 111, 179, 0.1);">CUPO ACTUAL</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
            <div class="table-responsive">
                <table class="table table-hover mb-0 border-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted text-uppercase px-4 py-3" style="font-size: 10px; letter-spacing: 0.05em;">Espacio / Feria</th>
                            <th class="border-0 text-muted text-uppercase py-3 text-center" style="font-size: 10px; letter-spacing: 0.05em;">Semana 1</th>
                            <th class="border-0 text-muted text-uppercase py-3 text-center" style="font-size: 10px; letter-spacing: 0.05em;">Semana 2</th>
                            <th class="border-0 text-muted text-uppercase py-3 text-center" style="font-size: 10px; letter-spacing: 0.05em;">Semana 3</th>
                            <th class="border-0 text-muted text-uppercase py-3 text-center" style="font-size: 10px; letter-spacing: 0.05em;">Semana 4</th>
                        </tr>
                    </thead>
                    <tbody id="grid-body">
                        <!-- Inyectado vía JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="alert alert-info border-0 shadow-sm mt-4 p-4 d-flex" style="border-radius: 12px; background-color: #e7f3ff; color: #004085;">
            <span class="material-symbols-outlined mr-3" style="font-size: 24px;">tips_and_updates</span>
            <div>
                <h6 class="font-weight-bold mb-1" style="font-size: 14px;">¿Cómo reservar?</h6>
                <p class="mb-0" style="font-size: 13px;">Selecciona la celda del espacio y semana que deseas (deben estar libres). Revisa el resumen lateral y confirma tu reserva.</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 100px; border-radius: 15px;">
            <div class="card-body p-4">
                <h3 class="h5 font-weight-bold text-dark mb-4 d-flex align-items-center" style="gap: 0.75rem;">
                    <span class="material-symbols-outlined text-primary">shopping_cart_checkout</span>
                    Resumen de Selección
                </h3>
                
                <div id="empty-selection" class="py-5 text-center text-muted border rounded mb-4" style="border-style: dashed !important; background: #fafafa;">
                    <span class="material-symbols-outlined mb-2" style="font-size: 32px; opacity: 0.5;">touch_app</span>
                    <p class="small font-weight-bold mb-0">Selecciona un espacio en la tabla</p>
                </div>

                <div id="active-selection" class="d-none">
                    <div id="selection-list" class="mb-4">
                        <!-- Items dinámicos -->
                    </div>
                    
                    <div class="bg-primary text-white p-3 rounded mb-4 d-flex justify-content-between align-items-center">
                        <span class="small font-weight-bold">Inversión Total</span>
                        <span id="total-cost" class="h5 font-weight-black mb-0">0 Créditos</span>
                    </div>
                    
                    <button onclick="confirmFinalReservation()" class="btn btn-primary btn-block btn-lg font-weight-black py-3 mb-2 shadow-sm" style="border-radius: 10px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Confirmar Reserva
                    </button>
                    
                    <button onclick="cancelSelection()" class="btn btn-link btn-sm btn-block text-muted font-weight-bold text-decoration-none">Cancelar selección</button>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <h6 class="text-muted text-uppercase font-weight-bold mb-3 d-flex align-items-center" style="font-size: 10px; letter-spacing: 0.1em; opacity: 0.7;">
                        <span class="material-symbols-outlined mr-2" style="font-size: 16px;">rule</span> Reglas de Participación
                    </h6>
                    <ul class="list-unstyled mb-0" style="font-size: 12px; color: #666;">
                        <li class="mb-2 d-flex align-items-start"><span class="text-primary mr-2">•</span> Máximo 2 ferias por mes.</li>
                        <li class="mb-2 d-flex align-items-start"><span class="text-primary mr-2">•</span> Máximo 1 feria por semana.</li>
                        <li class="mb-0 d-flex align-items-start"><span class="text-primary mr-2">•</span> Debe elegir plazas diferentes.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .slot-cell {
        height: 60px;
        transition: all 0.2s;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin: 5px;
        border: 1px dashed #dee2e6;
    }
    .slot-cell:hover:not(.full) {
        background-color: #f8f9fa;
        border-color: var(--gob-primary);
        color: var(--gob-primary);
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .slot-cell.selected {
        background-color: var(--gob-primary) !important;
        border-color: var(--gob-primary) !important;
        color: white !important;
        border-style: solid;
        box-shadow: 0 8px 20px rgba(0, 111, 179, 0.3);
        transform: scale(1.05);
        z-index: 2;
    }
    .slot-cell.full {
        background-color: #fff5f5;
        border-color: #feb2b2;
        color: #c53030;
        cursor: not-allowed;
        opacity: 0.7;
    }
    .slot-cell.full .material-symbols-outlined { font-size: 14px; position: absolute; top: 5px; right: 5px; }
    
    .font-weight-black { font-weight: 900 !important; }
</style>

<script>
    const spaces = [
        { name: 'Plaza Victoria', sector: 'Centro' },
        { name: 'Quinta Vergara', sector: 'Poniente' },
        { name: 'Plaza de Armas', sector: 'Centro Histórico' },
        { name: 'Parque Italia', sector: 'Centro' },
        { name: 'Muelle Vergara', sector: 'Borde Costero' },
        { name: 'Plaza O\'Higgins', sector: 'El Almendral' }
    ];

    let credits = 14;
    let selectedSlots = [];

    function generateGrid() {
        const tbody = document.getElementById('grid-body');
        let html = '';
        spaces.forEach((space, sIdx) => {
            html += `<tr>
                <td class="px-4 py-3 align-middle">
                    <div class="d-flex align-items-center">
                        <div class="bg-light rounded mr-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <span class="material-symbols-outlined text-muted" style="font-size: 20px;">storefront</span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="font-weight-bold text-dark" style="font-size: 13px;">${space.name}</span>
                            <small class="text-muted text-uppercase" style="font-size: 9px; letter-spacing: 0.05em;">${space.sector}</small>
                        </div>
                    </div>
                </td>`;
            
            for(let w = 1; w <= 4; w++) {
                const occupancy = Math.floor(Math.random() * 100);
                const isFull = occupancy >= 95;
                const elementId = `slot-${sIdx}-${w}`;
                html += `
                <td class="p-1 align-middle">
                    <div onclick="selectSlot('${space.name}', 'Semana ${w}', ${occupancy}, ${isFull}, '${elementId}')" 
                         class="slot-cell position-relative ${isFull ? 'full' : ''}" 
                         id="${elementId}">
                        <span class="font-weight-black" style="font-size: 14px;">${occupancy}%</span>
                        <span class="font-weight-bold text-uppercase" style="font-size: 8px;">${isFull ? 'Lleno' : 'Libre'}</span>
                        ${isFull ? '<span class="material-symbols-outlined">lock</span>' : ''}
                    </div>
                </td>`;
            }
            html += `</tr>`;
        });
        tbody.innerHTML = html;
    }

    function selectSlot(name, week, occupancy, isFull, elementId) {
        if (isFull) {
            Swal.fire({
                title: 'Espacio Agotado',
                text: 'Lo sentimos, este periodo ya alcanzó el 100% de su capacidad.',
                icon: 'info',
                confirmButtonColor: '#006FB3'
            });
            return;
        }

        const slotIndex = selectedSlots.findIndex(s => s.id === elementId);
        const cell = document.getElementById(elementId);
        
        if (slotIndex > -1) {
            selectedSlots.splice(slotIndex, 1);
            cell.classList.remove('selected');
        } else {
            if (selectedSlots.length >= 2) {
                Swal.fire({ title: 'Máximo Alcanzado', text: 'Solo puedes seleccionar hasta 2 ferias por proceso.', icon: 'warning', confirmButtonColor: '#006FB3' });
                return;
            }
            if (selectedSlots.some(s => s.week === week)) {
                Swal.fire({ title: 'Semana Ocupada', text: `Ya tienes otra selección para la ${week}.`, icon: 'warning', confirmButtonColor: '#006FB3' });
                return;
            }
            if (selectedSlots.some(s => s.name === name)) {
                Swal.fire({ title: 'Plaza Repetida', text: `Ya has seleccionado ${name}. Elige una plaza diferente.`, icon: 'warning', confirmButtonColor: '#006FB3' });
                return;
            }
            selectedSlots.push({ id: elementId, name, week });
            cell.classList.add('selected');
        }
        updateSidebar();
    }

    function updateSidebar() {
        const emptyState = document.getElementById('empty-selection');
        const activeState = document.getElementById('active-selection');
        const listContainer = document.getElementById('selection-list');
        const totalCostLabel = document.getElementById('total-cost');

        if (selectedSlots.length === 0) {
            emptyState.classList.remove('d-none');
            activeState.classList.add('d-none');
        } else {
            emptyState.classList.add('d-none');
            activeState.classList.remove('d-none');
            
            let html = '';
            selectedSlots.forEach((slot, index) => {
                html += `
                <div class="card bg-light border-0 mb-3" style="border-radius: 10px;">
                    <div class="card-body p-3 position-relative">
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 9px; letter-spacing: 0.1em;">Reserva ${index + 1}</small>
                        <h6 class="font-weight-bold text-dark mb-1" style="font-size: 14px;">${slot.name}</h6>
                        <p class="small text-muted mb-0">${slot.week} de Marzo</p>
                        <button onclick="removeSlot('${slot.id}')" class="btn btn-link p-0 position-absolute" style="top: 10px; right: 10px; color: #ccc;">
                            <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                        </button>
                    </div>
                </div>`;
            });
            listContainer.innerHTML = html;
            totalCostLabel.innerText = `${selectedSlots.length * 7} Créditos`;
        }
    }

    function removeSlot(id) {
        const slotIndex = selectedSlots.findIndex(s => s.id === id);
        if (slotIndex > -1) {
            selectedSlots.splice(slotIndex, 1);
            document.getElementById(id).classList.remove('selected');
            updateSidebar();
        }
    }

    function cancelSelection() {
        selectedSlots.forEach(slot => document.getElementById(slot.id).classList.remove('selected'));
        selectedSlots = [];
        updateSidebar();
    }

    function confirmFinalReservation() {
        if (selectedSlots.length === 0) return;
        const cost = selectedSlots.length * 7;
        Swal.fire({
            title: '¿Confirmar Reservas?',
            text: `Estás por reservar ${selectedSlots.length} espacios. Costo: ${cost} créditos.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#006FB3',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, confirmar everything',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                credits -= cost;
                document.getElementById('credits-count').innerText = credits;
                document.getElementById('credits-progress').style.width = (credits / 14 * 100) + '%';
                Swal.fire({ title: '¡Éxito!', text: 'Reservas completadas.', icon: 'success', timer: 2000, showConfirmButton: false }).then(() => {
                    window.location.href = 'confirmar.php';
                });
            }
        });
    }

    // Inicializar
    generateGrid();
</script>
