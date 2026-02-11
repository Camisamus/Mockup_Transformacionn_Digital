<?php
// Function to build hierarchical menu from flat permissions list
function getIcon($name, $class = "", $attrs = [])
{
    $iconPath = dirname(__DIR__) . '/recursos/icons/' . $name . '.svg';
    if (file_exists($iconPath)) {
        $svg = file_get_contents($iconPath);

        // Ensure default styles match Feather expectations
        $svg = str_replace('<svg ', '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ', $svg);

        // Add class if provided
        if ($class) {
            $svg = str_replace('<svg ', '<svg class="' . $class . '" ', $svg);
        }

        // Add/Overwrite attributes if provided (e.g. width, height)
        if (!empty($attrs)) {
            foreach ($attrs as $key => $val) {
                // Remove existing attr if present
                $svg = preg_replace('/ ' . $key . '="[^"]*"/', '', $svg);
                // Add new attr
                $svg = str_replace('<svg ', '<svg ' . $key . '="' . $val . '" ', $svg);
            }
        }

        return $svg;
    }
    return ''; // Fallback
}

function buildMenuHierarchy($flatItems)
{
    $map = [];
    $roots = [];
    $items = [];

    // 1. Normalize and Map
    foreach ($flatItems as $item) {
        $newItem = [
            'id' => $item['rol_id'] ?? ($item['id'] ?? null),
            'nombre' => $item['rol_nombre'] ?? ($item['nombre'] ?? ''),
            'tipo' => $item['rol_tipo'] ?? ($item['tipo'] ?? ''),
            'Enlace' => $item['rol_enlace'] ?? ($item['Enlace'] ?? ''),
            'icon' => $item['rol_icono'] ?? ($item['icon'] ?? $item['rol_simbolo'] ?? ''),
            'contenido' => []
        ];

        if ($newItem['id']) {
            $map[$newItem['id']] = $newItem;
            // We store the keys to iterate later, or build a list of references
        }
    }

    // 2. Link children (Need to work with references now to build the tree)
    foreach ($map as $id => &$node) {
        $idParts = explode('.', $id);
        if (count($idParts) > 1) {
            array_pop($idParts);
            $parentId = implode('.', $idParts);

            if (isset($map[$parentId])) {
                $map[$parentId]['contenido'][] = &$node;
            } else {
                $roots[] = &$node;
            }
        } else {
            $roots[] = &$node;
        }
    }


    return $roots;
}

function renderSidebar($flatPermissions, $pathPrefix, $currentScript)
{
    // Enforce Essential Items at the start of permissions list if not already there
    $essentialItems = [
        [
            "rol_id" => "A.0",
            "rol_nombre" => "Bandeja",
            "rol_enlace" => "Funcionarios/bandeja.php",
            "rol_tipo" => "Pagina",
            "rol_icono" => "file-text"
        ],
        [
            "rol_id" => "A.1",
            "rol_nombre" => "Bandeja Historial",
            "rol_enlace" => "Funcionarios/bandeja_historial.php",
            "rol_tipo" => "Pagina",
            "rol_icono" => "clock"
        ]
    ];

    // Filter out these items from flatPermissions to avoid duplicates, then prepend
    $filteredPermissions = array_filter($flatPermissions, function ($item) {
        $link = $item['rol_enlace'] ?? ($item['Enlace'] ?? '');
        return ($link !== "Funcionarios/bandeja.php" && $link !== "Funcionarios/bandeja_historial.php" && $link !== "Funcionarios/Bandeja.php");
    });

    $finalPermissions = array_merge($essentialItems, $filteredPermissions);

    $menuData = buildMenuHierarchy($finalPermissions);

    // Identify active category in PHP to prevent visual flash
    $activeCategoryId = null;
    foreach ($menuData as $item) {
        if (isChildActive($item, $currentScript)) {
            // Get root ID to keep grouped items (like Bandeja + Historial) visible together
            $rootId = explode('.', $item['id'])[0];
            // If it's the Bandeja group (A), we don't treat it as a drill-down selection
            if ($rootId !== 'A') {
                $activeCategoryId = $rootId;
            }
            break;
        }
    }

    $backButtonClass = $activeCategoryId ? "" : "d-none";

    $html = '<aside id="sidebar" class="d-flex flex-column w-100 h-100" style="overflow-y: auto;">
        <nav class="flex-grow-1">
            <ul class="nav flex-column" id="menu-container">
                <!-- Back Button -->
                <li class="nav-item ' . $backButtonClass . '" id="back-to-panel-item">
                    <a class="nav-link fw-bold text-primary d-flex align-items-center" href="#" onclick="goBackToPanel(event)">
                        ' . str_replace('width="24" height="24"', 'style="width:18px; margin-right:8px;"', getIcon('arrow-left')) . '
                        <span>Volver al panel</span>
                    </a>
                </li>
    ';

    $html .= buildMenuHtml($menuData, 0, $pathPrefix, $currentScript, $activeCategoryId);

    $html .= '</ul>
        </nav>
        <div class="p-3 border-top border-primary-subtle small opacity-50">
           <!-- Footer Text -->
        </div>
    </aside>';

    return $html;
}

function buildMenuHtml($items, $level, $pathPrefix, $currentScript, $activeCategoryId = null)
{
    $html = '';
    foreach ($items as $index => $item) {
        // Use the actual ID from DB/JSON to ensure global uniqueness across recursive levels
        // Harden ID: Replace . with - and ensure it starts with a letter
        $idBase = str_replace('.', '-', $item['id'] ?? $index);
        $uniqueId = "menu-collapse-" . $idBase;
        $paddingLeft = $level === 0 ? '' : 'style="padding-left: ' . (1 + $level * 0.5) . 'rem"';

        // Categorize for drill-down
        $liClass = 'nav-item';
        $categoryAttr = '';
        if ($level === 0) {
            $liClass .= ' top-level-category';
            $categoryAttr = ' data-category-id="' . ($item['id'] ?? '') . '"';

            // Apply initial visibility based on active category
            // We compare against the root ID of the item to keep siblings grouped
            $itemRootId = explode('.', $item['id'])[0];
            if ($activeCategoryId && $itemRootId !== $activeCategoryId) {
                $liClass .= ' d-none';
            }
        } else {
            // Apply initial visibility for sub-items
            $parentCategory = explode('.', $item['id'])[0];
            if ($activeCategoryId && $parentCategory === $activeCategoryId) {
                $liClass .= ' sub-item'; // Visible if it belongs to active category
            } else {
                $liClass .= ' sub-item d-none'; // Hidden by default
            }
            $categoryAttr = ' data-parent-category="' . $parentCategory . '"';
        }

        $html .= '<li class="' . $liClass . '"' . $categoryAttr . '>';

        if ($item['tipo'] === 'categoria' || $item['tipo'] === 'subcategoria') {
            $hasChildren = !empty($item['contenido']);
            if ($hasChildren) {
                // Check if any child is active to open the collapse
                $isActive = isChildActive($item, $currentScript);
                $collapseClass = $isActive ? 'show' : '';
                $linkClass = $isActive ? '' : 'collapsed';

                // If it's the active top-level category, add special class
                if ($level === 0 && $isActive) {
                    $linkClass .= ' category-header-active';
                }

                $ariaExpanded = $isActive ? 'true' : 'false';

                $iconHtml = $item['icon'] ? getIcon($item['icon'], 'me-2') : '';
                // Adjust size for menu icons via CSS if needed, or inline
                if ($iconHtml) {
                    $iconHtml = str_replace('width="24" height="24"', 'style="width:18px; margin-right:8px;"', $iconHtml);
                }
                //https://feathericons.com/


                // If level 0, its the trigger for drill-down
                $onClick = ($level === 0) ? 'onclick="drillDown(event, \'' . $item['id'] . '\')"' : '';
                $href = ($level === 0) ? '#' : '#' . $uniqueId;
                $toggle = ($level === 0) ? '' : 'data-bs-toggle="collapse"';

                $html .= '
                    <a class="nav-link ' . $linkClass . '" ' . $toggle . ' href="' . $href . '" ' . $onClick . ' role="button" aria-expanded="' . $ariaExpanded . '" aria-controls="' . $uniqueId . '" ' . $paddingLeft . '>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <span>' . $iconHtml . ' ' . $item['nombre'] . '</span>
                            ' . str_replace('width="24" height="24"', 'style="width:14px;"', getIcon('chevron-down')) . '
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled ' . $collapseClass . '" id="' . $uniqueId . '" data-bs-parent="' . ($level === 0 ? '#menu-container' : '') . '">
                        ' . buildMenuHtml($item['contenido'], $level + 1, $pathPrefix, $currentScript, $activeCategoryId) . '
                    </ul>
                ';
            }
        } else if ($item['tipo'] === 'Pagina') {
            $href = '#';
            if (!empty($item['Enlace'])) {
                // Adjust link extension from html to php
                $link = str_replace('.html', '.php', $item['Enlace']);

                // Handle relative paths
                // If we are in Funcionarios/ (prefix ../) and link is Funcionarios/foo.php -> foo.php
                // Handle relative paths
                // If we are deep (../../) or mid (../), adjust links
                if ($pathPrefix !== './' && strpos($link, 'Funcionarios/') === 0) {
                    // This is still a bit simplified, but let's try to make it work
                    // If we are at root, we keep Funcionarios/...
                    // If we are at Funcionarios/ (../), we want NO_Asignadas/... or ../INGRESOS/...
                    // The safest is to ALWAYS use $pathPrefix . $link
                    $href = $pathPrefix . $link;
                } else {
                    $href = $pathPrefix . $link;
                }
            }

            $isActive = strpos($href, $currentScript) !== false;
            $activeClass = $isActive ? 'active-page fw-bold ' : '-50';

            $iconHtml = $item['icon'] ? getIcon($item['icon'], 'me-2') : '';
            if ($iconHtml) {
                $iconHtml = str_replace('width="24" height="24"', 'style="width:18px; margin-right:8px;"', $iconHtml);
            }
            //$iconHtml = $item['icon'] ? '<i data-feather="' . $item['rol_simbolo'] . '" style="width:18px; margin-right:8px;"></i>' : '';
            //$iconHtml = $item['rol_simbolo'] ? '<span class="material-symbols-outlined">' . $item['rol_simbolo'] . '</span><span>' : $iconHtml;


            $html .= '
                <a class="nav-link leaf-link ' . $activeClass . ' d-flex align-items-center" href="' . $href . '" ' . $paddingLeft . '>
                    <span>' . $iconHtml . ' ' . $item['nombre'] . '</span>
                </a>
             ';
        }
        $html .= '</li>';

    }
    return $html;
}

function isChildActive($item, $currentScript)
{
    if ($item['tipo'] === 'Pagina') {
        // Simple check
        $link = str_replace('.html', '.php', $item['Enlace']);
        // If currentScript is inside the link (e.g. link=Funcionarios/dashboard.php, current=dashboard.php)
        return strpos($link, $currentScript) !== false;
    }
    if (!empty($item['contenido'])) {
        foreach ($item['contenido'] as $child) {
            if (isChildActive($child, $currentScript))
                return true;
        }
    }
    return false;
}

function renderLayoutScripts($pathPrefix)
{
    ?>
    <script>
        // Global API Configuration
        (function () {
            const origin = window.location.origin;
            const path = window.location.pathname;
            const transformacionIdx = path.indexOf('/Transformacion/');

            if (transformacionIdx !== -1) {
                window.API_BASE_URL = origin + path.substring(0, transformacionIdx) + '/Transformacion/api';
            } else {
                window.API_BASE_URL = origin + '/transformacion/api';
            }
        })();

        // --- Drill-down Menu Logic ---
        window.drillDown = function (event, categoryId) {
            if (event) event.preventDefault();
            localStorage.setItem('active_category', categoryId);
            applyMenuState(categoryId);
        };

        window.goBackToPanel = function (event) {
            if (event) event.preventDefault();
            localStorage.removeItem('active_category');
            applyMenuState(null);
        };

        function applyMenuState(activeCategoryId) {
            const topLevelCategories = document.querySelectorAll('.top-level-category');
            const subItems = document.querySelectorAll('.sub-item');
            const backButton = document.getElementById('back-to-panel-item');

            if (activeCategoryId) {
                topLevelCategories.forEach(el => {
                    const catId = el.getAttribute('data-category-id');
                    const anchor = el.querySelector('.nav-link');

                    if (catId === activeCategoryId) {
                        el.classList.remove('d-none');
                        if (anchor) anchor.classList.add('category-header-active');
                        const collapse = el.querySelector('.collapse');
                        if (collapse) {
                            collapse.classList.add('show');
                            collapse.querySelectorAll('.sub-item').forEach(sub => sub.classList.remove('d-none'));
                        }
                    } else {
                        el.classList.add('d-none');
                    }
                });
                if (backButton) backButton.classList.remove('d-none');
            } else {
                topLevelCategories.forEach(el => {
                    el.classList.remove('d-none');
                    const anchor = el.querySelector('.nav-link');
                    if (anchor) anchor.classList.remove('category-header-active');
                    const collapse = el.querySelector('.collapse');
                    if (collapse) collapse.classList.remove('show');
                });
                subItems.forEach(el => el.classList.add('d-none'));
                if (backButton) backButton.classList.add('d-none');
            }


        }

        // --- Logout Logic ---
        window.logout = async function () {
            try {
                await fetch(`${window.API_BASE_URL}/logout.php`, {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        ACCION: "logout"
                    })
                });
            } catch (e) {
                console.error('Logout failed on server', e);
            }

            localStorage.removeItem('isLoggedIn');
            localStorage.removeItem('is_contribuyente');
            localStorage.removeItem('current_representation');
            localStorage.removeItem('user_data');
            localStorage.removeItem('google_token');
            localStorage.removeItem('active_category');
            location.reload();
        };

        // --- Representation Selector (Contribuyente) ---
        function renderRepresentationSelector() {
            const nav = document.querySelector('#sidebar-container nav');
            const menuContainer = document.getElementById('menu-container');

            if (nav && menuContainer && !document.getElementById('representation-selector')) {
                const wrapper = document.createElement('div');
                wrapper.className = 'mb-3 px-2';
                wrapper.innerHTML = `
                <label class="form-label -50 small text-uppercase fw-bold mb-1">Sesión representando a:</label>
                <select class="form-select form-select-sm bg-primary-subtle border-0" id="representation-selector">
                    <option value="personal">Persona Natural</option>
                </select>
            `;
                nav.insertBefore(wrapper, menuContainer);

                const companies = JSON.parse(localStorage.getItem('local_companies')) || [];
                const selector = document.getElementById('representation-selector');
                companies.forEach(company => {
                    const option = document.createElement('option');
                    option.value = company.rut;
                    option.textContent = company.nombre;
                    selector.appendChild(option);
                });

                selector.value = localStorage.getItem('current_representation') || 'personal';
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

        document.addEventListener('DOMContentLoaded', () => {
            // Check representation selector
            if (localStorage.getItem('is_contribuyente') === 'true') renderRepresentationSelector();

            // Initialize menu state
            let activeCategory = localStorage.getItem('active_category');

            // Detect active category from current page to prevent flicker/reset
            const activePageLink = document.querySelector('.active-page');
            if (activePageLink) {
                // Check if it's a sub-item
                const subItemLi = activePageLink.closest('.sub-item');
                if (subItemLi) {
                    activeCategory = subItemLi.getAttribute('data-parent-category');
                } else {
                    // Check if it's a top-level category item (like Bandeja)
                    const topLevelLi = activePageLink.closest('.top-level-category');
                    if (topLevelLi) {
                        activeCategory = topLevelLi.getAttribute('data-category-id');
                        // For items like A.0, the group is A
                        if (activeCategory && activeCategory.includes('.')) {
                            activeCategory = activeCategory.split('.')[0];
                        }
                    }
                }

                if (activeCategory) {
                    // If it's the Bandeja group (A), we don't save it as an active category
                    if (activeCategory === 'A') {
                        activeCategory = null;
                        localStorage.removeItem('active_category');
                    } else {
                        localStorage.setItem('active_category', activeCategory);
                    }
                }
            }

            applyMenuState(activeCategory);
        });
    </script>
    <?php
}
?>