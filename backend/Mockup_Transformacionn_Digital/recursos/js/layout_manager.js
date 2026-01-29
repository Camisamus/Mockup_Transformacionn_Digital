// Universal Layout Manager
// Injects Sidebar and Header into every page
// Handles path resolution for resources
// Global API Configuration
// Global API Configuration - Detect backend/api path automatically
(function () {
    const path = window.location.pathname;
    const backendIdx = path.indexOf('/backend/');
    if (backendIdx !== -1) {
        window.API_BASE_URL = window.location.origin + path.substring(0, backendIdx) + '/backend/api';
    } else {
        window.API_BASE_URL = window.location.origin + '/api';
    }
})();

document.addEventListener('DOMContentLoaded', () => {
    // 1. Determine if we are in root or subdirectory
    const isRoot = window.location.pathname.endsWith('index.html') || window.location.pathname.endsWith('/');
    const pathPrefix = isRoot ? '' : '../';

    // 2. Filter out login screens
    const isLogin = document.getElementById('login-screen');
    if (isLogin) {
        document.body.classList.add('layout-ready');
        return;
    }

    // 3. Inject Layout Structure IMMEDIATELY
    injectLayout(pathPrefix);

    // 4. Verify Session in the BACKGROUND
    verifySessionBackground(pathPrefix);
});

/**
 * Injects the core layout structure (wrapper, sidebar container, and header)
 * without waiting for any API calls.
 */
function injectLayout(pathPrefix) {
    if (document.getElementById('wrapper-layout')) return;

    const sidebarCollapsed = localStorage.getItem('sidebar_collapsed') === 'true';

    // Reset body styles to prevent double padding/margins
    document.body.style.padding = '0';
    document.body.style.margin = '0';
    document.body.style.overflow = 'hidden'; // Let wrapper handle scroll

    // Preserve existing scripts/nodes so we don't break references
    const childrenToMove = Array.from(document.body.children);

    // New Structure
    const wrapper = document.createElement('div');
    wrapper.id = 'wrapper-layout';
    wrapper.className = 'd-flex h-100';
    wrapper.style.minHeight = '100vh';

    // Sidebar Container
    const sidebar = document.createElement('div');
    sidebar.id = 'sidebar-container';
    sidebar.style.minWidth = '250px';
    sidebar.style.maxWidth = '250px';
    sidebar.className = `flex-shrink-0 sidebar-entrance ${sidebarCollapsed ? 'collapsed' : ''}`;

    // Trigger fade-in animation with a slight delay for smoothness
    document.getElementsByTagName('body')[0].style.visibility = 'visible';
    setTimeout(() => {
        sidebar.classList.add('sidebar-visible');

        // After sidebar animation completes (0.8s), fade in main content
        setTimeout(() => {
            main.classList.add('content-visible');
        }, 800);
    }, 100);

    // Instant Shell HTML (Static part of sidebar)
    sidebar.innerHTML = `
        <aside id="sidebar" class="bg-primary  d-flex flex-column w-100 h-100" style="overflow-y: auto;">
            <div class="p-3 border-bottom border-primary-subtle">
                <a href="${pathPrefix}dashboard.html" style="cursor: pointer; display: block;">
                    <img src="${pathPrefix}recursos/img/logo_vina_del_mar_azul.png" alt="Viña del Mar"
                        style="width: 100%; max-width: 200px; height: auto;">
                </a>
            </div>
            <nav class="flex-grow-1 p-2">
                <ul class="nav flex-column" id="menu-container">
                    <li class="nav-item p-3 -50 small">Cargando menú...</li>
                </ul>
            </nav>
            <div class="p-3 border-top border-primary-subtle small opacity-50">
                <div class="sidebar-footer-text">Usuario: Cargando...</div>
            </div>
        </aside>
    `;

    // Main Content Area
    const main = document.createElement('main');
    main.className = 'flex-grow-1 p-0 bg-light d-flex flex-column content-entrance';
    main.style.height = '100vh';
    main.style.overflowY = 'auto';

    // Header (Static template, will be updated if needed)
    const header = document.createElement('header');
    header.className = 'bg-white shadow-sm p-3 mb-4 d-flex justify-content-between align-items-center sticky-top';
    header.style.zIndex = '1000';

    // Get user info from cache for initial display
    const cachedData = JSON.parse(localStorage.getItem('user_data') || '{}');
    const userName = cachedData.user ? `${cachedData.user.nombre} ${cachedData.user.apellido}` : 'Cargando...';

    header.innerHTML = `
        <div class="d-flex align-items-center gap-3">
            <button type="button" class="btn btn-toolbar" id="sidebar-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
            <h4 class="m-0 text-primary fw-bold" id="page-title">${document.title}</h4>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <span class="text-muted small me-2 d-none d-md-inline" id="header-user-name">Usuario: ${userName}</span>
            <button type="button" class="btn btn-toolbar" style="background-color: #dc3545; color: white; border-color: #dc3545;" onclick="logout()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span class="d-none d-sm-inline">Salir</span>
            </button>
        </div>
    `;

    // Content Wrapper
    const contentDiv = document.createElement('div');
    contentDiv.className = 'container-fluid pb-5 px-4';

    // Move original children into contentDiv
    childrenToMove.forEach(child => contentDiv.appendChild(child));

    // Assembly
    main.appendChild(header);
    main.appendChild(contentDiv);
    wrapper.appendChild(sidebar);
    wrapper.appendChild(main);

    // Sidebar Overlay for Mobile
    const overlay = document.createElement('div');
    overlay.id = 'sidebar-overlay';
    document.body.appendChild(overlay);

    // Clear body and append wrapper
    document.body.appendChild(wrapper);

    // Add layout-ready class to show content quickly
    setTimeout(() => document.body.classList.add('layout-ready'), 50);

    // Load Sidebar content (Async)
    loadSidebar(pathPrefix);

    // Load common dependencies (Async)
    loadDependencies(pathPrefix, () => {
        if (window.feather) window.feather.replace();
        attachLayoutEvents();
    });
}

/**
 * Checks session validity in the background after layout is visible.
 * Updates menu and user info once data arrives.
 */
async function verifySessionBackground(pathPrefix) {
    try {
        const googleToken = localStorage.getItem('google_token');

        const response = await fetch(`${window.API_BASE_URL}/verify_session.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: "",
                google_token: googleToken
            })
        });

        const data = await response.json();

        if (data.isAuthenticated === true) {
            // Update Local Storage with latest data
            const sessionData = {
                user: data.user,
                menu: data.permissions || [],
                rol: data.user.rol || 'admin'
            };
            localStorage.setItem('user_data', JSON.stringify(sessionData));

            // Refresh UI components that depend on session data
            const headerNameEl = document.getElementById('header-user-name');
            if (headerNameEl) {
                headerNameEl.innerText = `Usuario: ${data.user.nombre} ${data.user.apellido}`;
            }

            // Refresh Menu with real permissions
            loadMenuData(pathPrefix);
        } else {
            console.warn('Session verification failed, logging out...');
            window.logout();
        }
    } catch (e) {
        console.error('Error verifying session background:', e);
        // On network error, we don't force logout to allow offline dev or intermittent connection
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

    // Redirect to root login. 
    // If we are deep in paginas/, we go to ../page.html. 
    // If we are at root, we go to page.html
    const isRoot = window.location.pathname.endsWith('index.html') || window.location.pathname.endsWith('/');
    const target = isRoot ? 'page.html' : '../page.html';
    window.location.href = target;
};

function loadDependencies(prefix, callback) {
    const head = document.head;
    let pending = 0;

    function onDependencyLoad() {
        pending--;
        // Only callback when all pending are done
        if (pending <= 0) {
            // Ensure callback is called only once
            if (callback) {
                const cb = callback;
                callback = null; // unset to prevent double call
                cb();
            }
        }
    }

    // 1. Bootstrap CSS (if not present)
    if (!document.querySelector('link[href*="bootstrap.min.css"]')) {
        pending++;
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = `${prefix}recursos/css/bootstrap.min.css`;
        // CSS load event is supported
        link.onload = onDependencyLoad;
        link.onerror = onDependencyLoad;
        head.appendChild(link);
    }

    // 2. Feather Icons script
    if (!window.feather && !document.querySelector('script[src*="feather-icons"]')) {
        pending++;
        const script = document.createElement('script');
        script.src = 'https://unpkg.com/feather-icons';
        script.onload = onDependencyLoad;
        script.onerror = onDependencyLoad;
        head.appendChild(script);
    }

    // 3. Bootstrap Bundle JS
    // Check if bootstrap global exists? Hard to check if script not loaded.
    // Check for script tag.
    if (!document.querySelector('script[src*="bootstrap.bundle.min.js"]')) {
        pending++;
        const script = document.createElement('script');
        script.src = `${prefix}recursos/js/bootstrap.bundle.min.js`;
        script.onload = onDependencyLoad;
        script.onerror = onDependencyLoad;
        head.appendChild(script);
    }

    // 4. Custom Style (if missing)
    if (!document.querySelector('link[href*="style.css"]')) {
        pending++;
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = `${prefix}recursos/css/style.css`;
        link.onload = onDependencyLoad;
        link.onerror = onDependencyLoad;
        head.appendChild(link);
    }

    // 5. SweetAlert2
    if (!window.Swal && !document.querySelector('script[src*="sweetalert2"]')) {
        pending++;
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        script.onload = onDependencyLoad;
        script.onerror = onDependencyLoad;
        head.appendChild(script);
    }

    // If nothing pending, call back immediately
    if (pending <= 0 && callback) callback();
}

function loadSidebar(prefix) {
    const container = document.getElementById('sidebar-container');
    fetch(`${prefix}paginas/sidebar.html`)
        .then(r => r.text())
        .then(html => {
            const fixedHtml = html.replace(/src="/g, `src="${prefix}`).replace(/href="/g, `href="${prefix}`);
            container.innerHTML = fixedHtml;

            // Inject Company Selector if Contribuyente
            if (localStorage.getItem('is_contribuyente') === 'true') {
                renderRepresentationSelector();
            }

            // Attach Logout Listener to Sidebar Button
            const logoutBtn = document.getElementById('logout-btn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    window.logout();
                });
            }

            loadMenuData(prefix);
            if (window.feather) window.feather.replace();
        });
}

function renderRepresentationSelector() {
    const nav = document.querySelector('#sidebar-container nav');
    const menuContainer = document.getElementById('menu-container');

    if (nav && menuContainer) {
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

        // Populate Options
        const selector = document.getElementById('representation-selector');
        const companies = JSON.parse(localStorage.getItem('local_companies')) || [];

        companies.forEach(company => {
            const option = document.createElement('option');
            option.value = company.rut;
            option.textContent = company.nombre;
            selector.appendChild(option);
        });

        // Set current selection
        const current = localStorage.getItem('current_representation') || 'personal';
        selector.value = current;

        // Change Event without reload, just alert
        selector.addEventListener('change', (e) => {
            const newVal = e.target.value;
            localStorage.setItem('current_representation', newVal);

            // User requested alert
            const name = e.target.options[e.target.selectedIndex].text;
            Swal.fire({
                title: 'Verificando representación',
                text: `Usted está actuando ahora en nombre de: ${name}`,
                icon: 'info',
                confirmButtonText: 'Entendido'
            });

            // Optional: Reload if logic requires it, but user didn't explicitly ask for reload.
            // Just "Siempre visible y que salga una alerta que pida verificar"
        });

        // Listen for external updates (e.g. adding a company)
        window.addEventListener('companiesUpdated', () => {
            // Re-render options? Simplest is to just reload page or re-run this function logic if we clear it.
            // For now, let's keep it simple.
        });
    }
}

function loadMenuData(prefix) {
    // 1. Try to get menu from Local Storage (Session Data)
    const userData = JSON.parse(localStorage.getItem('user_data') || '{}');
    let userMenu = userData.menu;

    // Standardize empty checks
    if (!userMenu || userMenu.length === 0) {
        // DEFAULT VIEW FOR USERS WITH NO ROLES: BANDEJA ONLY
        // We do NOT fallback to menu_data.json which has everything.
        // Unless it is explicitly marked as contribuyente in a way that requires the JSON (legacy).
        // But the requirement says "todos los usuarios que no tengan pefil asignado deberan tener disponible la vista de banjeda por defecto".

        const defaultMenu = [
            {
                "id": "default-0",
                "tipo": "Pagina",
                "nombre": "Bandeja",
                "icon": "inbox", // using 'inbox' feather icon if available, or 'file-text'
                "Enlace": "paginas/bandeja.html"
            }
        ];

        // Render this default menu directly
        renderMenu(defaultMenu, prefix);
        return;
    }

    // If we have menu data from API
    if (userMenu && Array.isArray(userMenu) && userMenu.length > 0) {
        // The API returns a flat list (e.g. "7", "7.1"). 
        // We need to transform it to hierarchy if the renderer expects hierarchy.
        const hierarchicalMenu = buildMenuHierarchy(userMenu);
        renderMenu(hierarchicalMenu, prefix);
        return;
    }

    // Fallback Code (Legacy/Dev) - Only if we really want to support local JSON for debug
    // In production with real auth, we should probably hit the default view above.
    // However, keeping this for 'contribuyente' flow if it relies on local storage flags not coming from API menu.
    const role = userData.rol || userData.role || userData.tipo_usuario || '';
    const isContribuyente = role.toLowerCase() === 'contribuyente' || localStorage.getItem('is_contribuyente') === 'true';

    if (isContribuyente) {
        fetch(`${prefix}recursos/jsons/menu_data.json`)
            .then(r => r.json())
            .then(data => {
                // ... filter logic as before ...
                data = data.filter(item => item.id === "1" || item.id === "1.c");
                const patentes = data.find(item => item.id === "1");
                if (patentes && patentes.contenido) {
                    patentes.contenido = patentes.contenido.filter(subItem =>
                        subItem.id === "1.1.b" || subItem.id === "1.2" || subItem.id === "1.3"
                    );
                }
                renderMenu(data, prefix);
            })
            .catch(err => console.error('Error loading menu:', err));
    }
}

// Helper to transform flat list (id="7", id="7.1") to nested structure
function buildMenuHierarchy(flatItems) {
    // Deep copy to avoid mutating original source if needed
    const items = JSON.parse(JSON.stringify(flatItems));
    const map = {};
    const roots = [];

    // 1. Normalize and Map all items by ID
    items.forEach(item => {
        // Normalize fields from DB (rol_*) to UI expectations
        item.id = item.rol_id || item.id;
        item.nombre = item.rol_nombre || item.nombre;
        item.tipo = item.rol_tipo || item.tipo;
        item.Enlace = item.rol_enlace || item.Enlace;
        item.icon = item.rol_icono || item.icon; // Assuming rol_icono might exist or just icon

        item.contenido = []; // Initialize children array
        if (item.id) {
            map[item.id] = item;
        }
    });

    // 2. Link children to parents
    items.forEach(item => {
        if (!item.id) return;

        const idParts = item.id.split('.');
        if (idParts.length > 1) {
            // It has a parent?
            // e.g. "7.1" -> parent is "7"
            // e.g. "7.1.1" -> parent is "7.1"
            const parentId = idParts.slice(0, -1).join('.');
            const parent = map[parentId];

            if (parent) {
                parent.contenido.push(item);
            } else {
                // Parent not found? Treat as root.
                roots.push(item);
            }
        } else {
            // No dots, top level
            roots.push(item);
        }
    });

    return roots;
}


function renderMenu(data, prefix) {
    const menuContainer = document.getElementById('menu-container');
    if (menuContainer) {
        menuContainer.innerHTML = buildDirectMenuHtml(data, 0, prefix);
        if (window.feather) window.feather.replace();
        highlightCurrentPage();
    }
}

function buildDirectMenuHtml(items, level, prefix) {
    let html = '';
    items.forEach((item, index) => {
        const uniqueId = `menu-${level}-${index}`;
        const paddingLeft = level === 0 ? '' : `style="padding-left: ${1 + level * 0.5}rem"`;

        html += `<li class="nav-item">`;

        if (item.tipo === 'categoria' || item.tipo === 'subcategoria') {
            const hasChildren = item.contenido && item.contenido.length > 0;
            if (hasChildren) {
                html += `
                    <a class="nav-link collapsed " data-bs-toggle="collapse" href="#${uniqueId}" role="button" aria-expanded="false" ${paddingLeft}>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <span>
                               ${item.icon ? `<i data-feather="${item.icon}" style="width:18px; margin-right:8px;"></i>` : ''} 
                               ${item.nombre}
                            </span>
                            <i data-feather="chevron-down" style="width:14px;"></i>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="${uniqueId}">
                        ${buildDirectMenuHtml(item.contenido, level + 1, prefix)}
                    </ul>
                `;
            }
        } else if (item.tipo === 'Pagina') {
            // Direct Link Logic
            // If Enlace exists, define href. Else #
            // Enlace in JSON is like "paginas/foo.html". 
            // If we are in "paginas/bar.html", we need "../paginas/foo.html" OR just "foo.html" if in same dir?
            // Easiest is absolute path from root logic using prefix

            let href = '#';
            if (item.Enlace) {
                // Optimized Link Generation
                // If we are in 'paginas/' (prefix is '../') and target is in 'paginas/',
                // we can just use the filename.
                if (prefix === '../' && item.Enlace.startsWith('paginas/')) {
                    href = item.Enlace.replace('paginas/', '');
                } else {
                    href = prefix + item.Enlace;
                }
            }
            // console.log(`Generated Menu Item: ${item.nombre}, HREF: ${href}`);
            html += `
                <a class="nav-link leaf-link -50 d-flex align-items-center" href="${href}" ${paddingLeft}>
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

function highlightCurrentPage() {
    // Simple active highligting
    const current = window.location.pathname.split('/').pop();
    const links = document.querySelectorAll('.leaf-link');
    links.forEach(link => {
        if (link.getAttribute('href').includes(current)) {
            link.classList.remove('-50');
            //link.classList.add('', 'fw-bold', 'bg-primary');
            // Open parents
            let parent = link.closest('.collapse');
            while (parent) {
                parent.classList.add('show');
                parent = parent.parentElement.closest('.collapse');
            }
        }
    });
}

function attachLayoutEvents() {
    const toggleBtn = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar-container');
    const overlay = document.getElementById('sidebar-overlay');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show-mobile');
                overlay.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                localStorage.setItem('sidebar_collapsed', sidebar.classList.contains('collapsed'));
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show-mobile');
            overlay.classList.remove('show');
        });
    }
}

function seguridad() {
    let aux = false;
    let tienepermiso = document.getElementsByClassName("nav-link");
    if (tienepermiso.length > 0) {
        tienepermiso.forEach(permiso => {
            if (permiso.href == window.location.href) {
                aux = true;
            }
        });
    }
    // 3. Security Check (Only assigned official can respond)
    if (!aux) {
        Swal.fire({
            title: 'Acceso Denegado',
            text: `No tiene permiso para acceder a esta Página.`,
            icon: 'error',
            confirmButtonText: 'Volver a Bandeja'
        });
        window.location.href = 'bandeja.html';
        return;
    }
}