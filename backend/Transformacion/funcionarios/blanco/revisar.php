<?php
$pageTitle = "Bandeja OIRS";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>




<div class="container-fluid p-4">
    <!-- ========================================
         TABLA DE RESULTADOS
         ======================================== -->
    <div id="tabla-resultados-oirs"></div>
</div>

<script src="../../recursos/js/funcionarios/oirs/oirs_revisar.js"></script>
<script src="../../recursos/js/funcionarios/oirs/oirs_tabla_flujo.js"></script>
<script>
    $(document).ready(function () {
        OirsTable.init('revisar');
    });
</script>
<?php include '../../api/general/footer.php'; ?>