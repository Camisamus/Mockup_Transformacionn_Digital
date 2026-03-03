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
    return ''; // Fallback
}

function renderSidebarVecinos($pathPrefix, $currentScript)
{
    $html = '<aside id="sidebar" class="d-flex flex-column w-100 h-100 bg-white border-end shadow-sm">';
    $html .= '<nav class="flex-grow-1 mt-2 px-2"><ul class="nav flex-column">';

    // Menú simplificado para vecinos
    $menuItems = [
        ['nombre' => 'Inicio', 'enlace' => 'vecinos/index.php', 'icon' => 'home'],
    ];

    foreach ($menuItems as $item) {
        $href = $pathPrefix . $item['enlace'];
        $isActive = (strpos(strtolower($_SERVER['SCRIPT_NAME']), strtolower($item['enlace'])) !== false) ? 'active-main' : '';

        $html .= '
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center px-3 py-2 ' . $isActive . '" 
                href="' . $href . '" 
                style="color: #444; font-weight: 500; transition: 0.2s; border-radius: 6px; margin-bottom: 2px;">
                    <i class="me-3" style="width:20px; height:20px; display: inline-flex; align-items: center; justify-content: center;">' . getIcon($item['icon']) . '</i>
                    <span>' . htmlspecialchars($item['nombre']) . '</span>
                </a>
            </li>';
    }

    $html .= '</ul></nav></aside>';
    return $html;
}

function renderLayoutScriptsVecinos($pathPrefix)
{
    ?>
    <script>
        // Global API Configuration para Vecinos
        (function () {
            const origin = window.location.origin;
            const path = window.location.pathname;
            const transformacionIdx = path.indexOf('/Transformacion/');

            if (transformacionIdx !== -1) {
                window.API_BASE_URL = origin + path.substring(0, transformacionIdx) + '/Transformacion/apivec';
            } else {
                window.API_BASE_URL = origin + '/transformacion/apivec';
            }
        })();

        // --- Logout Logic para Vecinos ---
        window.logout = async function () {
            try {
                await fetch(`${window.API_BASE_URL}/general/logout.php`, {
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

            localStorage.removeItem('isLoggedInVecino');
            localStorage.removeItem('vecino_data');
            location.reload();
        };
    </script>
    <?php
}
?>