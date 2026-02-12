<?php
// Usamos el header de funcionarios para mantener coherencia, pero lo haremos más limpio para móvil
include("../../include/header-funcionarios.php");

// Simulamos los proyectos (mismo mock que index)
$proyectos = [];
$tipos = ['Infraestructura', 'Social', 'Salud', 'Educación', 'Seguridad'];
for ($i = 1; $i <= 200; $i++) {
    $proyectos[] = [
        'id' => $i,
        'nombre' => "Proyecto " . str_pad($i, 3, '0', STR_PAD_LEFT),
        'tipo' => $tipos[array_rand($tipos)],
        'presupuesto' => rand(10, 500) . " Millones"
    ];
}
?>

<div class="flex-grow-1 overflow-auto bg-light py-5">
    <div class="container" style="max-width: 600px;">
        <!-- Paso 1: Identificación -->
        <div id="step-identity" class="mb-5 d-flex flex-column" style="gap: 3rem;">
            <div class="text-center">
                <div class="d-flex align-items-center justify-content-center border border-primary text-primary bg-white shadow-sm mx-auto mb-4" style="width: 96px; height: 96px; border-width: 2px !important;">
                    <span class="material-symbols-outlined" style="font-size: 48px;">how_to_vote</span>
                </div>
                <h1 class="h3 font-serif font-bold text-dark mb-2">Priorización Ciudadana 2026</h1>
                <p class="text-muted font-weight-medium mx-auto" style="max-width: 350px;">Bienvenido al sistema oficial de votación para el presupuesto participativo municipal.</p>
            </div>

            <div class="card border-0 shadow-sm p-4 p-md-5">
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-muted text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.15em;">Identificación del Elector</label>
                    <input type="text" id="voterName" placeholder="Ingrese su nombre completo" class="form-control form-control-lg border-2 bg-light shadow-none" style="height: 60px; font-size: 14px; font-weight: bold; border-radius: 0;">
                </div>
                <button onclick="startVoting()" class="btn btn-primary btn-lg w-100 font-weight-bold text-uppercase py-3" style="letter-spacing: 0.1em; border-radius: 0;">
                    COMENZAR PROCESO DE VOTACIÓN
                </button>
            </div>
            
            <div class="bg-white border-left border-primary shadow-sm p-4 text-center" style="border-left-width: 8px !important;">
                <p class="text-primary font-weight-bold text-uppercase mb-3" style="font-size: 10px; letter-spacing: 0.2em;">Disponibilidad en Tiempo Real</p>
                <div class="d-flex justify-content-center mb-3" style="gap: 0.5rem;">
                    <?php for($i=1; $i<=5; $i++): ?> <div style="width: 10px; height: 10px; background-color: var(--gob-primary);"></div> <?php endfor; ?>
                    <?php for($i=1; $i<=5; $i++): ?> <div style="width: 10px; height: 10px; background-color: #DEE2E6;"></div> <?php endfor; ?>
                </div>
                <p class="text-muted font-weight-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: -0.02em;">Quedan 5 de 10 espacios de validación presencial</p>
            </div>
        </div>

        <!-- Paso 2: Votación Grid -->
        <div id="step-voting" class="d-none pb-5">
            <div class="sticky-top bg-white border-bottom shadow-sm p-3 mb-4" style="z-index: 1000; margin-top: -3rem; margin-left: -1rem; margin-right: -1rem;">
                <div class="container d-flex align-items-center justify-content-between p-0" style="max-width: 600px;">
                    <div class="d-flex flex-column">
                        <span id="displayName" class="text-primary font-weight-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 0.1em;">Cargando elector...</span>
                        <h2 class="h5 font-serif font-bold text-dark mb-0">Seleccione 5 Iniciativas</h2>
                    </div>
                    <div class="bg-white border-2 border-primary d-flex align-items-center px-3 py-2" style="border: 2px solid var(--gob-primary) !important;">
                        <span id="voteCount" class="h4 font-weight-bold text-dark mb-0 mr-1">0</span>
                        <span class="text-muted font-weight-bold text-uppercase" style="font-size: 10px;">/ 5 Votos</span>
                    </div>
                </div>
            </div>

            <div class="position-relative mb-4">
                <span class="material-symbols-outlined position-absolute" style="left: 15px; top: 12px; color: #94a3b8;">search</span>
                <input type="text" placeholder="Buscar iniciativas por nombre..." class="form-control form-control-lg border-2 bg-white shadow-none" style="padding-left: 48px; height: 50px; font-size: 13px; font-weight: bold; border-radius: 0;">
            </div>

            <div class="oirs-list overflow-auto px-1" style="max-height: 60vh;">
                <?php foreach(array_slice($proyectos, 0, 50) as $p): ?>
                <div onclick="toggleVote(this, <?php echo $p['id']; ?>)" class="card border-0 shadow-sm mb-3 cursor-pointer project-vote-card transition-all">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1 pr-3">
                            <span class="text-primary font-weight-bold text-uppercase mb-1 d-block" style="font-size: 9px; letter-spacing: 0.2em;"><?php echo $p['tipo']; ?></span>
                            <h4 class="h6 font-weight-bold text-dark mb-2 leading-tight"><?php echo $p['nombre']; ?></h4>
                            <p class="text-muted font-weight-bold text-uppercase mb-0" style="font-size: 10px;">Ppto: <?php echo $p['presupuesto']; ?></p>
                        </div>
                        <div class="vote-indicator border d-flex align-items-center justify-content-center transition-all bg-light" style="width: 32px; height: 32px; border-width: 2px !important;">
                            <span class="material-symbols-outlined text-white" style="font-size: 20px; display: none;">check</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="text-center py-4 text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.15em; opacity: 0.5;">Fin del listado preliminar</div>
            </div>

            <div class="fixed-bottom p-4 bg-white border-top d-md-none" style="z-index: 1010;">
                <button onclick="finishVoting()" id="finishBtn" class="btn btn-secondary w-100 py-3 font-weight-bold text-uppercase shadow-lg disabled" style="letter-spacing: 0.1em; border-radius: 0;">
                    ENVIAR PREFERENCIAS
                </button>
            </div>
            <div class="mt-4 d-none d-md-block">
                <button onclick="finishVoting()" id="finishBtnDesktop" class="btn btn-secondary w-100 py-4 font-weight-bold text-uppercase shadow-sm disabled" style="letter-spacing: 0.1em; border-radius: 0;">
                    ENVIAR PREFERENCIAS
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.project-vote-card:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0, 75, 122, 0.1) !important; }
.project-vote-card.selected { border: 2px solid var(--gob-primary) !important; background-color: rgba(0, 111, 179, 0.02); }
.project-vote-card.selected .vote-indicator { background-color: var(--gob-primary) !important; border-color: var(--gob-primary) !important; }
.project-vote-card.selected .vote-indicator .material-symbols-outlined { display: block !important; }

.transition-all { transition: all 0.2s ease-in-out; }
.cursor-pointer { cursor: pointer; }
.fixed-bottom { position: fixed; bottom: 0; left: 0; right: 0; }
</style>

<script>
    let selectedVotes = 0;
    const maxVotes = 5;

    function startVoting() {
        const name = document.getElementById('voterName').value;
        if (!name) {
            alert('Por favor, ingrese su nombre para continuar.');
            return;
        }
        document.getElementById('displayName').innerText = 'Elector: ' + name;
        document.getElementById('step-identity').classList.add('d-none');
        document.getElementById('step-voting').classList.remove('d-none');
        window.scrollTo(0, 0);
    }

    function toggleVote(element, id) {
        if (!element.classList.contains('selected') && selectedVotes >= maxVotes) {
            alert('Ya ha seleccionado el máximo de 5 iniciativas.');
            return;
        }

        element.classList.toggle('selected');
        selectedVotes = document.querySelectorAll('.project-vote-card.selected').length;
        document.getElementById('voteCount').innerText = selectedVotes;

        const finishBtns = [document.getElementById('finishBtn'), document.getElementById('finishBtnDesktop')];
        if (selectedVotes === maxVotes) {
            finishBtns.forEach(btn => {
                btn.classList.remove('btn-secondary', 'disabled');
                btn.classList.add('btn-primary');
            });
        } else {
            finishBtns.forEach(btn => {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-secondary', 'disabled');
            });
        }
    }

    function finishVoting() {
        if (selectedVotes < maxVotes) return;
        alert('Su votación ha sido registrada exitosamente. Gracias por participar.');
        window.location.href = 'index.php';
    }
</script>

<?php include("../../include/footer-funcionarios.php"); ?>
