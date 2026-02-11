</div> <!-- End container-fluid -->
</main> <!-- End Main -->

<!-- Sidebar Overlay for Mobile -->
<div id="sidebar-overlay"></div>

</div> <!-- End Wrapper -->

<!-- Scripts -->
<script src="<?php echo $pathPrefix; ?>recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (function_exists('renderLayoutScripts'))
    renderLayoutScripts($pathPrefix); ?>

<script>
    feather.replace();

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