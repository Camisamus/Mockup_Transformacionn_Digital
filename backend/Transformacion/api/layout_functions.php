<?php
// Function to build hierarchical menu from flat permissions list
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
            'icon' => $item['rol_icono'] ?? ($item['icon'] ?? ''),
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
    $menuData = buildMenuHierarchy($flatPermissions);

    $html = '<aside id="sidebar" class="d-flex flex-column w-100 h-100" style="overflow-y: auto; background-color: #003399;">
        <div class="p-3 border-bottom border-white border-opacity-10 bg-white">
            <div class="traslogo">
            <a href="' . $pathPrefix . 'paginas/dashboard.php" style="cursor: pointer; display: block;">
                <img src="' . $pathPrefix . 'recursos/img/cropped-logo-2022-v2-e1767721959431.png" alt="Viña del Mar"
                    style="width: 100%; max-width: 200px; height: auto;">
            </a>
            </div>
        </div>
        <nav class="flex-grow-1 p-2">
            <ul class="nav flex-column" id="menu-container">';

    $html .= buildMenuHtml($menuData, 0, $pathPrefix, $currentScript);

    $html .= '</ul>
        </nav>
        <div class="p-3 border-top border-primary-subtle small opacity-50">
           <!-- Footer Text -->
        </div>
    </aside>';

    return $html;
}

function buildMenuHtml($items, $level, $pathPrefix, $currentScript)
{
    $html = '';
    foreach ($items as $index => $item) {
        // Use the actual ID from DB/JSON to ensure global uniqueness across recursive levels
        // Harden ID: Replace . with - and ensure it starts with a letter
        $idBase = str_replace('.', '-', $item['id'] ?? $index);
        $uniqueId = "menu-collapse-" . $idBase;
        $paddingLeft = $level === 0 ? '' : 'style="padding-left: ' . (1 + $level * 0.5) . 'rem"';

        $html .= '<li class="nav-item">';

        if ($item['tipo'] === 'categoria' || $item['tipo'] === 'subcategoria') {
            $hasChildren = !empty($item['contenido']);
            if ($hasChildren) {
                // Check if any child is active to open the collapse
                $isActive = isChildActive($item, $currentScript);
                $collapseClass = $isActive ? 'show' : '';
                $linkClass = $isActive ? '' : 'collapsed';
                $ariaExpanded = $isActive ? 'true' : 'false';

                $iconHtml = $item['icon'] ? '<i data-feather="' . $item['icon'] . '" style="width:18px; margin-right:8px;"></i>' : '';

                $html .= '
                    <a class="nav-link ' . $linkClass . '" data-bs-toggle="collapse" data-bs-target="#' . $uniqueId . '" role="button" aria-expanded="' . $ariaExpanded . '" aria-controls="' . $uniqueId . '" ' . $paddingLeft . '>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <span>' . $iconHtml . ' ' . $item['nombre'] . '</span>
                            <i data-feather="chevron-down" style="width:14px;"></i>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled ' . $collapseClass . '" id="' . $uniqueId . '" data-bs-parent="' . ($level === 0 ? '#menu-container' : '') . '">
                        ' . buildMenuHtml($item['contenido'], $level + 1, $pathPrefix, $currentScript) . '
                    </ul>
                ';
            }
        } else if ($item['tipo'] === 'Pagina') {
            $href = '#';
            if (!empty($item['Enlace'])) {
                // Adjust link extension from html to php
                $link = str_replace('.html', '.php', $item['Enlace']);

                // Handle relative paths
                // If we are in paginas/ (prefix ../) and link is paginas/foo.php -> foo.php
                if ($pathPrefix === '../' && strpos($link, 'paginas/') === 0) {
                    $href = str_replace('paginas/', '', $link);
                } else {
                    $href = $pathPrefix . $link;
                }
            }

            $isActive = strpos($href, $currentScript) !== false;
            $activeClass = $isActive ? 'fw-bold ' : '-50'; // Removed bg-primary to match original JS logic which just removes -50
            if ($isActive)
                $activeClass = "";

            $iconHtml = $item['icon'] ? '<i data-feather="' . $item['icon'] . '" style="width:18px; margin-right:8px;"></i>' : '';

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
        // If currentScript is inside the link (e.g. link=paginas/dashboard.php, current=dashboard.php)
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
?>