// Universal Layout Manager
// Injects Sidebar and Header into every page
// Handles path resolution for resources
// Global API Configuration
window.API_BASE_URL = 'http://127.0.0.1:8081/api';

document.addEventListener('DOMContentLoaded', async () => {
    // 1. Determine if we are in root or subdirectory
    const isRoot = window.location.pathname.endsWith('index.html') || window.location.pathname.endsWith('/');
    const pathPrefix = isRoot ? '' : '../';

    // 2. Verify Session BEFORE rendering layout (except for login page)
    const isLogin = document.getElementById('login-screen');
    if (isLogin) {
        // If on login screen, maybe check if already logged in and redirect?
        // Already handled in page.html script
        return;
    }

    // Verify Session Endpoint
    try {
        const response = await fetch(`${window.API_BASE_URL}/verify_session.php`, {
            method: 'GET',
            credentials: 'include',
            //headers: {
            //    'X-Requested-With': 'XMLHttpRequest'
            //}
        });

        // if (!response.ok) throw new Error('Session check failed'); // API might return 200 with isAuthenticated: false
        const data = await response.json();

        if (data.isAuthenticated === true) {
            // Update Local Storage with latest data
            // Structure: user: {}, permissions: []
            // Create a standardized user_data object
            const sessionData = {
                user: data.user,
                // Map permissions to 'menu' and 'rol' as needed
                menu: data.permissions || [],
                rol: data.user.rol || 'admin' // Fallback
            };

            localStorage.setItem('user_data', JSON.stringify(sessionData));
        } else {
            // Session Invalid
            console.warn('Session verification returned false');
            //window.logout();
            return;
        }
    } catch (e) {
        console.error('Error verifying session:', e);
        // If network error, might be offline dev? 
        // For now, enforce logout on error
        // window.logout();
        // return;
    }

    // 3. Inject Layout Structure if not present
    // ... (rest of the logic)

    // If we are in a subpage, wrap the body content
    if (!document.getElementById('wrapper-layout')) {
        // Reset body styles to prevent double padding/margins
        document.body.style.padding = '0';
        document.body.style.margin = '0';
        document.body.style.overflow = 'hidden'; // Let wrapper handle scroll

        // preserve existing scripts/nodes so we don't break references
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
        sidebar.className = 'flex-shrink-0'; // Prevent shrinking

        // Main Content Area
        const main = document.createElement('main');
        main.className = 'flex-grow-1 p-0 bg-light d-flex flex-column';
        main.style.height = '100vh';
        main.style.overflowY = 'auto';

        // Header
        const header = document.createElement('header');
        header.className = 'bg-white shadow-sm p-3 mb-4 d-flex justify-content-between align-items-center sticky-top';
        header.style.zIndex = '1000';
        header.innerHTML = `
            <h4 class="m-0 text-primary fw-bold" id="page-title">${document.title}</h4>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-muted small me-2">Usuario: Admin</span>
                <button class="btn btn-sm btn-outline-danger" onclick="logout()">
                    <i data-feather="log-out"></i> Salir
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

        // Clear body and append wrapper (effectively moving everything)
        // Note: We used appendChild above which moves them, so body is empty-ish now (except maybe text nodes)
        document.body.appendChild(wrapper);

        // Load Sidebar Logic (Async is fine here)
        loadSidebar(pathPrefix);

        // Dependency Injection (Async is fine here, DOM is already safe)
        loadDependencies(pathPrefix, () => {
            if (window.feather) window.feather.replace();
        });
    }

    // Identify Logout Button and attach Global Logout (if dynamic header)
    // Note: Header is injected dynamically, so we can't select it immediately easily unless we do it after injection.
    // However, the button has `onclick="logout()"`, so defining window.logout is sufficient.
});

// Global Logout Function
// Global Logout Function
window.logout = async function () {
    try {
        await fetch(`${window.API_BASE_URL}/logout.php`);
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
            <label class="form-label text-white-50 small text-uppercase fw-bold mb-1">Sesión representando a:</label>
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
            alert(`Verificando representación: ${name}\n\nUsted está actuando ahora en nombre de esta entidad.`);

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
    if (userData && userData.menu && Array.isArray(userData.menu) && userData.menu.length > 0) {
        // The API returns a flat list (e.g. "7", "7.1"). 
        // We need to transform it to hierarchy if the renderer expects hierarchy.
        const hierarchicalMenu = buildMenuHierarchy(userData.menu);
        renderMenu(hierarchicalMenu, prefix);
        return;
    }

    // 2. Fallback: Fetch from JSON (Dev/Legacy/Contribuyente Default)
    fetch(`${prefix}recursos/jsons/menu_data.json`)
        .then(r => r.json())
        .then(data => {
            // Apply Legacy Filters if needed (e.g. for Contribuyente mocked flow)
            const role = userData.rol || userData.role || userData.tipo_usuario || '';
            const isContribuyente = role.toLowerCase() === 'contribuyente' || localStorage.getItem('is_contribuyente') === 'true';

            if (isContribuyente) {
                // ... same filter logic as before ...
                data = data.filter(item => item.id === "1" || item.id === "1.c");
                const patentes = data.find(item => item.id === "1");
                if (patentes && patentes.contenido) {
                    patentes.contenido = patentes.contenido.filter(subItem =>
                        subItem.id === "1.1.b" || subItem.id === "1.2" || subItem.id === "1.3"
                    );
                }
            }
            renderMenu(data, prefix);
        })
        .catch(err => console.error('Error loading menu:', err));
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
                    <a class="nav-link collapsed text-white" data-bs-toggle="collapse" href="#${uniqueId}" role="button" aria-expanded="false" ${paddingLeft}>
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
                <a class="nav-link leaf-link text-white-50 d-flex align-items-center" href="${href}" ${paddingLeft}>
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
            link.classList.remove('text-white-50');
            link.classList.add('text-white', 'fw-bold', 'bg-primary');
            // Open parents
            let parent = link.closest('.collapse');
            while (parent) {
                parent.classList.add('show');
                parent = parent.parentElement.closest('.collapse');
            }
        }
    });
}
