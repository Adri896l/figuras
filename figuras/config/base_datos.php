<?php

$host = 'localhost';
$dbname = 'sistema_verificacion';
$user = 'root';
$password = '';
$port = 3305;

try {
    
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
    ]);
} catch (PDOException $e) {
    
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}
?>
