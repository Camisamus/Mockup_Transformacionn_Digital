error_reporting(E_ALL);
ini_set('display_errors', 1);

$files = [
__DIR__ . '/src/Config/Database.php',
__DIR__ . '/src/Models/OIRS_GESTIONES.php',
__DIR__ . '/src/Models/GENERAL_BITACORA.php',
__DIR__ . '/vendor/autoload.php'
];

foreach ($files as $f) {
if (!file_exists($f)) {
die("ERROR: El archivo no existe: $f");
}
require_once $f;
}

use App\Config\Database;
use App\Models\OIRS_GESTIONES;

echo "Archivos cargados correctamente. Probando instanciación...\n";

try {
if (!class_exists('App\Models\OIRS_GESTIONES')) {
die("ERROR: La clase App\Models\OIRS_GESTIONES no está definida tras el require.");
}
$db = (new Database())->getConnection();
$oirs = new OIRS_GESTIONES($db);

// Usuarios de prueba (IDs basados en dump previo)
// Leticia (ID 2, Area 2 - OIRS) -> Debería ser Admin
// Ramon (ID 3, Area 1, ofa_p=1 - Jefe) -> Debería ver solo lo suyo
// JAIME (ID 17, Area 5, ofa_p=0 - Operador) -> Debería ver solo lo suyo

$testUsers = [2, 3, 17];
$views = ['revisar', 'historial'];

foreach ($testUsers as $uid) {
// Obtener nombre del usuario
$u = $db->query("SELECT usr_nombre FROM trd_acceso_usuarios WHERE usr_id = $uid")->fetch();
echo "\n=== PROBANDO USUARIO: {$u['usr_nombre']} (ID $uid) ===\n";

// Ver perfil
$p = $db->query("SELECT ofa_area, ofa_p FROM trd_oirs_funcionarios_areas WHERE ofa_funcionario = $uid")->fetch();
echo "Perfil detectado: Area=" . ($p['ofa_area'] ?? 'N/A') . ", Jefe=" . ($p['ofa_p'] ?? 'N/A') . "\n";

foreach ($views as $v) {
$results = $oirs->getOirsByView($uid, $v);
echo "Vista '$v': " . count($results) . " resultados encontrados.\n";
if (count($results) > 0) {
echo "Ejemplo Folio: " . ($results[0]['folio'] ?? 'S/F') . "\n";
}
}
}

} catch (Exception $e) {
echo "Error: " . $e->getMessage();
}
?>