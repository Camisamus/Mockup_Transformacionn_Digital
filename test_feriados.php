<?php
require_once __DIR__ . '/backend/Transformacion/vendor/autoload.php';
require_once __DIR__ . '/backend/Transformacion/src/Config/Database.php';
require_once __DIR__ . '/backend/Transformacion/src/Helpers/Fechas.php';

use App\Config\Database;
use App\Helpers\Fechas;

$db = new Database();
$conn = $db->getConnection();

if (!$conn) {
    die("Error: No se pudo conectar a la base de datos.\n");
}

function testSumarDias($start, $days, $expected, $conn)
{
    $result = Fechas::sumarDiasHabiles($start, $days, $conn);
    if ($result === $expected) {
        echo "[PASS] $start + $days business days = $result\n";
    } else {
        echo "[FAIL] $start + $days business days = $result (Expected: $expected)\n";
    }
}

echo "Testing sumarDiasHabiles WITH Holidays...\n";

// Force a test holiday
$test_holiday = '2024-05-16'; // A Thursday
$conn->exec("DELETE FROM sup_feriados WHERE fer_fecha = '$test_holiday'");
$conn->exec("INSERT INTO sup_feriados (fer_fecha, fer_motivo, fer_tipo) VALUES ('$test_holiday', 'Test Holiday skip', 'Civil')");

echo "Inserted test holiday on $test_holiday (Thursday)\n";

// 2024-05-15 (Wed) + 2 business days:
// 16 (Thu) is holiday -> skip
// 17 (Fri) is business day [1]
// 18 (Sat) -> skip
// 19 (Sun) -> skip
// 20 (Mon) is business day [2]
// Expected: 2024-05-20
testSumarDias('2024-05-15', 2, '2024-05-20', $conn);

// Clean up
$conn->exec("DELETE FROM sup_feriados WHERE fer_fecha = '$test_holiday' AND fer_motivo = 'Test Holiday skip'");
echo "Cleaned up test holiday.\n";
