<?php
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
        echo "ERROR: El archivo no existe: $f<br>";
        continue;
    }
    require_once $f;
}

use App\Config\Database;
use App\Models\OIRS_GESTIONES;

echo "<h1>Depuración de Perfiles OIRS</h1>";
echo "PHP SELF: " . $_SERVER['PHP_SELF'] . "<br>";
echo "Archivos incluidos:<pre>";
print_r(get_included_files());
echo "</pre>";

try {
    if (!class_exists('App\Models\OIRS_GESTIONES')) {
        die("ERROR: La clase App\Models\OIRS_GESTIONES no está definida tras el require.");
    }
    $db = (new Database())->getConnection();
    $oirs = new OIRS_GESTIONES($db);

    $testUsers = [2, 3, 17];
    $views = ['revisar', 'historial'];

    foreach ($testUsers as $uid) {
        $u = $db->query("SELECT usr_nombre FROM trd_acceso_usuarios WHERE usr_id = $uid")->fetch();
        echo "\n=== USUARIO: {$u['usr_nombre']} (ID $uid) ===\n";

        $p = $db->query("SELECT ofa_area, ofa_p FROM trd_oirs_funcionarios_areas WHERE ofa_funcionario = $uid")->fetch();
        echo "Perfil: Area=" . ($p['ofa_area'] ?? 'N/A') . ", Jefe=" . ($p['ofa_p'] ?? 'N/A') . "\n";

        foreach ($views as $v) {
            try {
                $results = $oirs->getOirsByView($uid, $v);
                echo "Vista '$v': " . count($results) . " resultados.\n";
            } catch (Exception $e) {
                echo "ERROR en Vista '$v': " . $e->getMessage() . "\n";
            }
        }
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";
?>