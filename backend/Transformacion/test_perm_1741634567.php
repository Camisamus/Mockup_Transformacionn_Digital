<?php
echo "TIME: " . time() . "<br>";
echo "VERSION: 3<br>";
require_once __DIR__ . '/src/Config/Database.php';
require_once __DIR__ . '/src/Models/OIRS_GESTIONES.php';
require_once __DIR__ . '/src/Models/GENERAL_BITACORA.php';

use App\Config\Database;
use App\Models\OIRS_GESTIONES;

$db = (new Database())->getConnection();
$oirs = new OIRS_GESTIONES($db);

$testUsers = [2, 3]; // Leticia (Admin), Ramon (Jefe)
$view = 'revisar';

foreach ($testUsers as $uid) {
    try {
        $results = $oirs->getOirsByView($uid, $view);
        echo "Usuario ID $uid en '$view': " . count($results) . " resultados.<br>";
    } catch (Exception $e) {
        echo "ERROR para ID $uid: " . $e->getMessage() . "<br>";
    }
}
?>