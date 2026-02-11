// Universal Layout Manager (Adapted for PHP Logic)
// Handles Global Config, Logout, and Specific UI enhancements

// Global API Configuration
(function () {
    const path = window.location.pathname;
    const backendIdx = path.indexOf('/backend/');
    if (backendIdx !== -1) {
        // We are in a subfolder structure
        // path is like /.../backend/Transformacion/Funcionarios/dashboard.php
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

        // If I am at .../Transformacion/Funcionarios/dashboard.php
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
    localStorage.removeItem('active_category'); // Clear active category on logout

    // Redirect to index (login)
    // Use PHP page logic
    const path = window.location.pathname;
    // content of window.location with just index.php relative to Transformacion

    // Simplest: Reload current page, auth_check will redirect to login if session is gone.
    location.reload();
};

// --- Drill-down Menu Logic ---

window.drillDown = function (event, categoryId) {
    if (event) event.preventDefault();
    console.log("Drilling down to category:", categoryId);

    localStorage.setItem('active_category', categoryId);
    applyMenuState(categoryId);
};

window.goBackToPanel = function (event) {
    if (event) event.preventDefault();
    console.log("Going back to main panel");

    localStorage.removeItem('active_category');
    applyMenuState(null);
};

function applyMenuState(activeCategoryId) {
    console.log("Applying menu state for:", activeCategoryId);
    const topLevelCategories = document.querySelectorAll('.top-level-category');
    const subItems = document.querySelectorAll('.sub-item');
    const backButton = document.getElementById('back-to-panel-item');

    if (activeCategoryId) {
        // Hide all top-level categories first, then only show the active one
        topLevelCategories.forEach(el => {
            const catId = el.getAttribute('data-category-id');
            const anchor = el.querySelector('.nav-link');

            if (catId === activeCategoryId) {
                el.classList.remove('d-none');
                if (anchor) {
                    anchor.classList.add('category-header-active');
                    // Add a class to indicate it's the "current header"
                }

                // Show and expand the contents
                const collapse = el.querySelector('.collapse');
                if (collapse) {
                    collapse.classList.add('show');
                    // Ensure all descendant li's are visible
                    collapse.querySelectorAll('.sub-item').forEach(sub => {
                        sub.classList.remove('d-none');
                    });
                }
            } else {
                el.classList.add('d-none');
            }
        });

        // Show back button
        if (backButton) backButton.classList.remove('d-none');
    } else {
        // Standard View: Show all top-level categories, hide all sub-content
        topLevelCategories.forEach(el => {
            el.classList.remove('d-none');
            const anchor = el.querySelector('.nav-link');
            if (anchor) anchor.classList.remove('category-header-active');

            const collapse = el.querySelector('.collapse');
            if (collapse) {
                collapse.classList.remove('show');
            }
        });

        // Hide all sub-items when in main view
        subItems.forEach(el => el.classList.add('d-none'));

        // Hide back button
        if (backButton) backButton.classList.add('d-none');
    }

    // Refresh icons if feather is available
    if (window.feather) {
        feather.replace();
    }
}


// Initialize menu state on load
document.addEventListener('DOMContentLoaded', () => {
    const activeCategory = localStorage.getItem('active_category');

    // Check if we have an active page that belongs to a category
    const activePageLink = document.querySelector('.active-page');
    if (activePageLink) {
        const parentLi = activePageLink.closest('.sub-item');
        if (parentLi) {
            const parentCategory = parentLi.getAttribute('data-parent-category');
            if (parentCategory) {
                localStorage.setItem('active_category', parentCategory);
                applyMenuState(parentCategory);
                return;
            }
        }
    }

    applyMenuState(activeCategory);
});
