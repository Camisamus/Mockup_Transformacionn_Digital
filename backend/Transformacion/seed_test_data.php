<?php
$host = '127.0.0.1';
$db   = 'transformacion_digital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // 1. Insert Sample Cargos
    $cargos = [
        ['Admin OIRS', 2, 3], // Nombre, Area, Nivel
        ['Jefe Desarrollo Vecinal', 3, 2],
        ['Administrativo Vecinal', 3, 1]
    ];
    
    foreach($cargos as $c) {
        $stmt = $pdo->prepare("INSERT INTO trd_general_cargos (car_nombre, car_area, car_nivel) VALUES (?, ?, ?)");
        $stmt->execute($c);
    }
    echo "Sample cargos created.\n";

    // 2. Link first user to Admin OIRS to test Level 3
    $userStmt = $pdo->query("SELECT usr_id FROM trd_acceso_usuarios LIMIT 1");
    $usrId = $userStmt->fetchColumn();
    
    if ($usrId) {
        $cargoId = $pdo->lastInsertId() - 2; // The first one inserted 'Admin OIRS'
        $stmt = $pdo->prepare("INSERT INTO trd_oirs_funcionarios_cargos (ofc_funcionario, ofc_cargo, ofc_desde, ofc_estado) VALUES (?, ?, NOW(), 1)");
        $stmt->execute([$usrId, $cargoId]);
        echo "User $usrId linked to Admin OIRS (Level 3).\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
