<?php
$pageTitle = "Tablero de Control - Municipalidad";
require_once '../api/auth_check.php';
include '../api/header.php';
?>

    <script type="text/javascript">
        // Force check login on load
        document.addEventListener('DOMContentLoaded', () => {
            try {
                fetch(`${window.API_BASE_URL}/logout.php`, {
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
            // If we are deep in paginas/, we go to ../index.html. 
            // If we are at root, we go to index.html
            const isRoot = window.location.pathname.endsWith('index.html') || window.location.pathname.endsWith('/');
            const target = isRoot ? 'index.html' : '../index.html';
            window.location.href = target;
        });
    </script>

<?php include '../api/footer.php'; ?>

