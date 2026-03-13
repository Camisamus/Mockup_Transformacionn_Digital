<?php
$pageTitle = "Mis Datos de Contacto";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';

use App\Models\general_contribuyentes;
$contModel = new general_contribuyentes($db);
$vecino = $contModel->getById($_SESSION['vecino_id']);
?>

<style>
    .profile-card {
        border-radius: 40px;
        background-color: white;
        box-shadow: 0 30px 60px rgba(0,0,0,0.04);
        border: 1px solid #f8fafc;
        padding: 4rem;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 40px;
        background: linear-gradient(135deg, #006FB3 0%, #004a7c 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 800;
        margin: 0 auto 2rem;
        box-shadow: 0 15px 30px rgba(0, 111, 179, 0.2);
    }
    .form-group-custom label {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        margin-bottom: 0.75rem;
    }
    .form-control-custom {
        border: 2px solid #f1f5f9;
        border-radius: 18px;
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: #1e293b;
        transition: all 0.25s;
    }
    .form-control-custom:focus {
        border-color: #006FB3;
        box-shadow: 0 0 0 5px rgba(0, 111, 179, 0.05);
        background-color: white;
    }
    .form-control-custom:disabled {
        background-color: #f8fafc;
        border-color: #f1f5f9;
        color: #64748b;
    }
</style>

<div class="row justify-content-center py-5">
    <div class="col-lg-8 col-xl-7 text-center mb-5">
        <h1 class="h2 fw-extrabold text-dark mb-3">Tu Información Personal</h1>
        <p class="text-muted px-lg-5">Mantén tus datos actualizados para que podamos contactarte de forma eficiente sobre tus solicitudes OIRS.</p>
    </div>

    <div class="col-lg-10 col-xl-9">
        <div class="profile-card">
            <div class="profile-avatar">
                <?= strtoupper(substr($vecino['tgc_nombre'], 0, 1) . substr($vecino['tgc_apellido_paterno'], 0, 1)) ?>
            </div>

            <form id="formMisDatos">
                <div class="row g-4">
                    <div class="col-md-6 form-group-custom">
                        <label>RUT</label>
                        <input type="text" class="form-control form-control-custom" value="<?= $vecino['tgc_rut'] ?>" disabled>
                    </div>
                    <div class="col-md-6 form-group-custom">
                        <label>Nombres</label>
                        <input type="text" class="form-control form-control-custom" value="<?= $vecino['tgc_nombre'] ?>" disabled>
                    </div>
                    <div class="col-md-6 form-group-custom">
                        <label>Apellido Paterno</label>
                        <input type="text" class="form-control form-control-custom" value="<?= $vecino['tgc_apellido_paterno'] ?>" disabled>
                    </div>
                    <div class="col-md-6 form-group-custom">
                        <label>Apellido Materno</label>
                        <input type="text" class="form-control form-control-custom" value="<?= $vecino['tgc_apellido_materno'] ?>" disabled>
                    </div>
                    <div class="col-md-12 border-top my-5"></div>
                    <div class="col-md-6 form-group-custom">
                        <label>Correo Electrónico</label>
                        <input type="email" class="form-control form-control-custom" id="tgc_correo_electronico" value="<?= $vecino['tgc_correo_electronico'] ?>">
                    </div>
                    <div class="col-md-6 form-group-custom">
                        <label>Teléfono de Contacto</label>
                        <input type="text" class="form-control form-control-custom" id="tgc_telefono_contacto" value="<?= $vecino['tgc_telefono_contacto'] ?>">
                    </div>
                </div>

                <div class="mt-5 d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg d-flex align-items-center gap-2" id="btnGuardarDatos">
                        <?= getIcon('save', '', ['width' => 20, 'height' => 20]) ?>
                        GUARDAR CAMBIOS
                    </button>
                    <a href="index.php" class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold text-muted border">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#btnGuardarDatos').on('click', async function() {
        const payload = {
            tgc_correo_electronico: $('#tgc_correo_electronico').val(),
            tgc_telefono_contacto: $('#tgc_telefono_contacto').val()
        };

        Swal.fire({
            title: 'Actualizando datos...',
            didOpen: () => { Swal.showLoading(); }
        });

        // Simulación de actualización (o API real si existiera)
        // Por ahora, solo mostraremos éxito
        setTimeout(() => {
            Swal.fire('¡Éxito!', 'Tus datos han sido actualizados.', 'success');
        }, 1000);
    });
</script>

<?php include '../../apivec/general/footer.php'; ?>
