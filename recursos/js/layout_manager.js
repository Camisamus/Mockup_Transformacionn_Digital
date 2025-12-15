// Universal Layout Manager
// Injects Sidebar and Header into every page
// Handles path resolution for resources

document.addEventListener('DOMContentLoaded', () => {
    // 1. Determine if we are in root or subdirectory
    // Simple heuristic: check if 'recursos' folder exists in current level or parent
    const isRoot = window.location.pathname.endsWith('index.html') || window.location.pathname.endsWith('/');
    const pathPrefix = isRoot ? '' : '../';

    // 2. Inject Layout Structure if not present
    // We expect the page to have a <body> content. We wrap it.

    // Check if map or special full screen
    const isLogin = document.getElementById('login-screen');
    if (isLogin) return; // Don't mess with login page index.html logic if handled there

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
});

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
    // Load absolute or relative path to sidebar.html? 
    // We construct the "sidebar.html" content manually or fetch it? 
    // Better to fetch to keep it modular.
    fetch(`${prefix}paginas/sidebar.html`)
        .then(r => r.text())
        .then(html => {
            // Fix image/link paths in raw HTML if any
            const fixedHtml = html.replace(/src="/g, `src="${prefix}`).replace(/href="/g, `href="${prefix}`);
            container.innerHTML = fixedHtml;

            // Load Menu Data
            loadMenuData(prefix);
            if (window.feather) window.feather.replace();
        });
}

function loadMenuData(prefix) {
    fetch(`${prefix}recursos/jsons/menu_data.json`)
        .then(r => r.json())
        .then(data => {
            const menuContainer = document.getElementById('menu-container');
            if (menuContainer) {
                // We need a modified buildMenuHtml that creates direct links
                menuContainer.innerHTML = buildDirectMenuHtml(data, 0, prefix);
                if (window.feather) window.feather.replace();
                highlightCurrentPage();
            }
        });
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
