// Sidebar Component Logic

document.addEventListener('DOMContentLoaded', () => {
    loadSidebar();
});

function loadSidebar() {
    const container = document.getElementById('sidebar-container');
    if (!container) return;

    fetch('paginas/sidebar.php')
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html;
            // After Sidebar HTML is injected, load the menu data and initialize events
            loadMenu();
            initializeLogout();
            feather.replace(); // Initialize icons for the static parts of sidebar
        })
        .catch(err => console.error('Error loading sidebar:', err));
}

function loadMenu() {
    fetch('recursos/jsons/menu_data.json')
        .then(response => response.json())
        .then(data => {
            const menuContainer = document.getElementById('menu-container');
            if (menuContainer) {
                menuContainer.innerHTML = buildMenuHtml(data);
                feather.replace(); // Initialize icons for the dynamic menu
            }
        })
        .catch(error => console.error('Error loading menu data:', error));
}

function buildMenuHtml(items, level = 0) {
    let html = '';
    if (state.is_Contribuyente) {
        alert("Contribuyente");
        return;
    }
    items.forEach((item, index) => {
        const uniqueId = `menu-${level}-${index}-${Math.random().toString(36).substr(2, 9)}`;
        // Indentation padding
        const paddingLeft = level === 0 ? '' : 'style="padding-left: ' + (1 + level * 0.5) + 'rem"';

        html += `<li class="nav-item">`;

        if (item.tipo === 'categoria' || item.tipo === 'subcategoria') {
            const hasChildren = item.contenido && item.contenido.length > 0;
            if (hasChildren) {
                html += `
                    <a class="nav-link collapsed " data-bs-toggle="collapse" href="#${uniqueId}" role="button" aria-expanded="false" ${paddingLeft}>
                        <span>
                           ${item.icon ? `<i data-feather="${item.icon}" style="width:18px; margin-right:8px;"></i>` : ''} 
                           ${item.nombre}
                        </span>
                        <i data-feather="chevron-down" style="width:14px;"></i>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="${uniqueId}">
                        ${buildMenuHtml(item.contenido, level + 1)}
                    </ul>
                `;
            }
        } else if (item.tipo === 'Pagina') {
            // If it has a specific link, pass it, otherwise just label
            const linkArg = item.Enlace ? `'${item.nombre}', '${item.Enlace}'` : `'${item.nombre}'`;
            html += `
                <a class="nav-link leaf-link -50" href="#" onclick="handleNavClick(${linkArg})" ${paddingLeft}>
                    <span>
                       ${item.icon ? `<i data-feather="${item.icon}" style="width:18px; margin-right:8px;"></i>` : ''} 
                       ${item.nombre}
                    </span>
                </a>
            `;
        }
        html += `</li>`;
    });
    return html;
}

function initializeLogout() {
    const logoutBtn = document.getElementById('logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (typeof logout === 'function') {
                logout(); // Call global logout from code.js
            } else {
                console.warn('Logout function not found');
            }
        });
    }
}

