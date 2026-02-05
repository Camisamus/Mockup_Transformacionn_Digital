// Universal Layout Manager (Adapted for PHP Logic)
// Handles Global Config, Logout, and Specific UI enhancements

// Global API Configuration
(function () {
    const path = window.location.pathname;
    const backendIdx = path.indexOf('/backend/');
    if (backendIdx !== -1) {
        // We are in a subfolder structure
        // path is like /.../backend/Transformacion/paginas/dashboard.php
        // we want /.../backend/Transformacion/api
        // But wait, the original logic found '/backend/' and appended 'backend/api'.
        // If path is .../backend/Transformacion/... 
        // Original: path.substring(0, backendIdx) + '/backend/api' -> root/backend/api
        // This assumes 'backend/api' exists.
        // My files are in backend/Transformacion/api.
        // Let's stick to the relative detection that worked before or improve it.

        // Actually, let's look at the PHP structure.
        // backend/Transformacion/api 
        // backend/Transformacion/index.php

        // If I am at .../Transformacion/paginas/dashboard.php
        // API is at ../api

        // JS often uses absolute paths. 
        // Let's try to detect 'Transformacion'

        const transformacionIdx = path.indexOf('/Transformacion/');
        if (transformacionIdx !== -1) {
            window.API_BASE_URL = window.location.origin + path.substring(0, transformacionIdx) + '/Transformacion/api';
        } else {
            // Fallback
            window.API_BASE_URL = window.location.origin + '/transformacion/api';
        }
    } else {
        window.API_BASE_URL = window.location.origin + '/transformacion/api';
    }
})();

document.addEventListener('DOMContentLoaded', () => {
    // Inject Company Selector if Contribuyente (Legacy Feature Preservation)
    if (localStorage.getItem('is_contribuyente') === 'true') {
        renderRepresentationSelector();
    }
});

function renderRepresentationSelector() {
    const nav = document.querySelector('#sidebar-container nav');
    const menuContainer = document.getElementById('menu-container');

    if (nav && menuContainer) {
        // Avoid duplicate
        if (document.getElementById('representation-selector')) return;

        const wrapper = document.createElement('div');
        wrapper.className = 'mb-3 px-2';
        wrapper.innerHTML = `
            <label class="form-label -50 small text-uppercase fw-bold mb-1">Sesión representando a:</label>
            <select class="form-select form-select-sm bg-primary-subtle border-0" id="representation-selector">
                <option value="personal">Persona Natural</option>
            </select>
        `;

        // Insert before menu
        nav.insertBefore(wrapper, menuContainer);

        // Populate Options from Local Storage
        const companies = JSON.parse(localStorage.getItem('local_companies')) || [];
        const selector = document.getElementById('representation-selector');

        companies.forEach(company => {
            const option = document.createElement('option');
            option.value = company.rut;
            option.textContent = company.nombre;
            selector.appendChild(option);
        });

        // Set current selection
        const current = localStorage.getItem('current_representation') || 'personal';
        selector.value = current;

        // Change Event
        selector.addEventListener('change', (e) => {
            const newVal = e.target.value;
            localStorage.setItem('current_representation', newVal);

            const name = e.target.options[e.target.selectedIndex].text;
            Swal.fire({
                title: 'Verificando representación',
                text: `Usted está actuando ahora en nombre de: ${name}`,
                icon: 'info',
                confirmButtonText: 'Entendido'
            });
        });
    }
}

// Global Logout Function
window.logout = async function () {
    try {
        await fetch(`${window.API_BASE_URL}/logout.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "logout" })
        });
    } catch (e) {
        console.error('Logout failed on server', e);
    }

    localStorage.removeItem('isLoggedIn');
    localStorage.removeItem('is_contribuyente');
    localStorage.removeItem('current_representation');
    localStorage.removeItem('user_data');
    localStorage.removeItem('google_token');

    // Redirect to index (login)
    // Use PHP page logic
    const path = window.location.pathname;
    // content of window.location with just index.php relative to Transformacion

    // Simplest: Reload current page, auth_check will redirect to login if session is gone.
    location.reload();
};