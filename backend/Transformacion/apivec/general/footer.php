</div>
<footer class="footer mt-auto py-1 bg-light border-top">
    <div class="container-fluid text-center">
        <span class="text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
            Sistema Municipal Unificado &copy; 2026
        </span>
    </div>
</footer>

</main>
<div id="sidebar-overlay"></div>

</div>
<script src="<?php echo $pathPrefix; ?>recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (function_exists('renderLayoutScriptsVecinos'))
    renderLayoutScriptsVecinos($pathPrefix); ?>

<script>
    if (window.feather) feather.replace();

    // Sidebar Toggle Logic
    document.addEventListener('DOMContentLoaded', () => {
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
                }
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show-mobile');
                overlay.classList.remove('show');
            });
        }
    });
</script>
</body>

</html>