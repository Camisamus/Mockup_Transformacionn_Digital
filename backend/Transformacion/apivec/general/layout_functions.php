<?php
// Function to build hierarchical menu from flat permissions list
function getIcon($name, $class = "", $attrs = [])
{
    $iconPath = dirname(__DIR__, 2) . '/recursos/icons/' . $name . '.svg';
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

    // Fallback: Material Symbols
    $classAttr = $class ? ' ' . $class : '';
    return '<span class="material-symbols-outlined' . $classAttr . '" style="font-size: inherit;">' . $name . '</span>';
}

function renderSidebarVecinos($permissions, $pathPrefix, $currentScript)
{
    $html = '<aside id="sidebar" class="d-flex flex-column w-100 h-100 bg-white border-end shadow-sm">';
    $html .= '<nav class="flex-grow-1 mt-2 px-2"><ul class="nav flex-column">';


    // 1. Detectar módulo actual basado en la ruta
    $currentPath = $_SERVER['SCRIPT_NAME'];
    $module = 'principal'; // Módulo por defecto

    // Determinamos el módulo según la carpeta en la que estamos
    if (stripos($currentPath, '/oirs/') !== false) {
        $module = 'oirs';
    }

    if (stripos($currentPath, '/licencias/') !== false) {
        $module = 'licencias';
    }

    if (stripos($currentPath, '/desarrollo_economico/') !== false) {
        $module = 'desarrollo_economico';
    }

    // 2. Filtrar los permisos (roles) por el módulo detectado
    $flatPermissions = is_array($permissions) ? $permissions : [];
    $filteredPermissions = array_filter($flatPermissions, function ($item) use ($module) {
        return isset($item['rol_modulo']) && $item['rol_modulo'] === $module;
    });

    // 3. Renderizar usando la nueva interfaz estilizada
    return renderSidebarPrincipal($filteredPermissions, $currentScript, $pathPrefix, $module);
}

function renderSidebarPrincipal($permissions, $currentScript, $pathPrefix, $currentModule = 'principal')
{
    $html = '<aside id="sidebar" class="d-flex flex-column w-100 h-100 bg-white border-end shadow-sm">';

    // Botón Volver al Panel Principal si estamos en un submódulo
    if ($currentModule !== 'principal') {
        $html .= '
        <div class="px-3 mt-3 mb-2">
            <a class="nav-link text-muted d-flex align-items-center" href="' . $pathPrefix . 'vecinos/index.php" style="font-size: 0.85rem;">
                <i class="me-2" style="width:16px; height:16px;">' . getIcon('arrow-left') . '</i> 
                <span>Volver al Panel</span>
            </a>
        </div>';
    }

    $html .= '<nav class="flex-grow-1 mt-2 px-2"><ul class="nav flex-column">';

    foreach ($permissions as $item) {
        if ($item['rol_formato'] === 'separador') {
            // Diseño para "GESTIÓN", "CONFIGURACIÓN", etc.
            $html .= '
            <li class="nav-item mt-4 mb-2 ps-3">
                <small class="text-uppercase fw-bold text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">
                    ' . htmlspecialchars($item['rol_nombre']) . '
                </small>
            </li>';
        } else if ($item['rol_formato'] === 'menu') {

            // Diseño para los botones con link (Categorías o Páginas)
            $enlace = $item['rol_enlace'] ?: '#';
            $href = ($enlace !== '#') ? $pathPrefix . $enlace : '#';

            // Estado activo: verificamos si el script actual contiene el enlace del menú
            $currentPath = $_SERVER['SCRIPT_NAME'];
            $isActive = ($enlace !== '#' && strpos(strtolower($currentPath), strtolower($enlace)) !== false) ? 'active-main' : '';
            $icon = !empty($item['rol_simbolo']) ? $item['rol_simbolo'] : 'grid';
            $html .= '
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center px-3 py-2 ' . $isActive . '" 
                    href="' . $href . '" 
                    style="color: #444; font-weight: 500; transition: 0.2s; border-radius: 6px; margin-bottom: 2px;">
                        <i class="me-3" style="width:20px; height:20px; display: inline-flex; align-items: center; justify-content: center;">' . getIcon($icon) . '</i>
                        <span>' . htmlspecialchars($item['rol_nombre']) . '</span>
                    </a>
                </li>';



        }
    }
    $html .= '</ul></nav></aside>';
    return $html;
}

function renderMenuItem($item, $class = "", $isRoot = false)
{
    $icon = $item['rol_simbolo'] ?? 'file';
    $chevron = $isRoot ? '<i data-feather="chevron-right" class="ms-auto opacity-50" style="width:14px"></i>' : '';
    // Si es categoría raíz, su enlace es el de su primera página para "entrar"
    $href = $item['rol_enlace'] ?: '#';

    return "
    <li class='nav-item'>
        <a class='nav-link d-flex align-items-center px-3 py-2 $class' href='$href'>
            <i class='me-3 text-dark icon-style' data-feather='$icon'></i>
            <span class='text-dark'>{$item['rol_nombre']}</span>
            $chevron
        </a>
    </li>";
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

function renderLayoutScriptsVecinos($pathPrefix)
{
    ?>
    <script src="<?php echo $pathPrefix; ?>recursos/js/layout_manager.js"></script>
    <script>
        // No es necesario duplicar el código aquí, layout_manager.js ya maneja el logout y el menú.
        // Solo inicializamos si es necesario algo específico.
    </script>
    <?php
}
?>