<?php
$pageTitle = "Gestión de Empresas";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


    <div class="container-fluid py-4">
        <!-- Header & Toolbar -->
        <div class="main-header mb-4">
            <div class="header-title">
                <h2 class="fw-bold fs-4">Gestión de Empresas Representadas</h2>
                <p class="text-muted mb-0">Inscriba y gestione las empresas que representa para trámites municipales</p>
            </div>
            <div class="toolbar">
                <button class="btn btn-toolbar" onclick="document.getElementById('empresaRut').focus()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nuevo Registro
                </button>
            </div>
        </div>

        <div class="row g-4">
            <!-- Form Column -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 border-start border-4 border-primary">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-1">Inscribir Nueva Empresa</h5>
                        <p class="text-muted small mb-4">Ingrese los datos de la razón social y adjunte acreditación</p>

                        <form id="form-empresa">
                            <div class="mb-3">
                                <label for="empresaRut" class="form-label small fw-bold">RUT Empresa</label>
                                <input type="text" class="form-control form-control-sm" id="empresaRut"
                                    placeholder="12.345.678-9" required>
                            </div>
                            <div class="mb-3">
                                <label for="empresaNombre" class="form-label small fw-bold">Razón Social</label>
                                <input type="text" class="form-control form-control-sm" id="empresaNombre"
                                    placeholder="Nombre de la Empresa SpA" required>
                            </div>
                            <div class="mb-4">
                                <label for="empresaDoc" class="form-label small fw-bold">Documento de
                                    Representación</label>
                                <input type="file" class="form-control form-control-sm" id="empresaDoc" required>
                                <div class="form-text xsmall">Adjunte escritura o poder notarial (PDF, JPG).</div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit"
                                    class="btn btn-dark shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="16"></line>
                                        <line x1="8" y1="12" x2="16" y2="12"></line>
                                    </svg>
                                    Agregar Empresa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Column -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-3">Empresas Registradas</h5>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light text-uppercase small">
                                    <tr>
                                        <th>RUT</th>
                                        <th>Razón Social</th>
                                        <th>Documento</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-empresas" class="small">
                                    <!-- Dynamic Content -->
                                </tbody>
                            </table>
                        </div>
                        <div id="empty-state" class="text-center py-5" style="display: none;">
                            <i data-feather="inbox" class="text-muted opacity-25 mb-3"
                                style="width: 48px; height: 48px;"></i>
                            <p class="text-muted small mb-0">No hay empresas registradas en su perfil.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        feather.replace();
    </script>
    
    <script src="../recursos/js/contribuyente_empresas.js"></script>

<?php include '../api/footer.php'; ?>

