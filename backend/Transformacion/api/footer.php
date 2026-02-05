</div> <!-- End container-fluid -->
</main> <!-- End Main -->

<!-- Sidebar Overlay for Mobile -->
<div id="sidebar-overlay"></div>

</div> <!-- End Wrapper -->

<!-- Scripts -->
<script src="<?php echo $pathPrefix; ?>recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="https://cdn.digital.gob.cl/framework/js/gob.cl.js"></script> -->
<script src="<?php echo $pathPrefix; ?>recursos/js/layout_manager.js"></script>
<script>
    feather.replace();

    // Minimal Sidebar Toggle Logic (extracted from layout_manager.js)
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
                    // Save preference
                    // localStorage.setItem('sidebar_collapsed', sidebar.classList.contains('collapsed'));
                }
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show-mobile');
                overlay.classList.remove('show');
            });
        }

        // Restore collapse state if needed, but CSS might need to handle it or inline JS
    });
</script>
</body>

</html>