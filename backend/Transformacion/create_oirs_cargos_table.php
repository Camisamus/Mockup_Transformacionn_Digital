<?php
$host = '127.0.0.1';
$db   = 'transformacion_digital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    $sql = "CREATE TABLE IF NOT EXISTS trd_oirs_funcionarios_cargos (
        ofc_id INT AUTO_INCREMENT PRIMARY KEY,
        ofc_funcionario INT NOT NULL,
        ofc_cargo INT NOT NULL,
        ofc_desde DATETIME NOT NULL,
        ofc_hasta DATETIME NULL,
        ofc_tipo_vinculo VARCHAR(50) DEFAULT 'Titular',
        ofc_estado INT DEFAULT 1,
        INDEX (ofc_funcionario),
        INDEX (ofc_cargo)
    )";
    
    $pdo->exec($sql);
    echo "Table trd_oirs_funcionarios_cargos created successfully.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
