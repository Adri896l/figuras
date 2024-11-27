<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $side = $data['side'];  // Se asume que el valor recibido es el lado del heptágono

    // Perímetro del heptágono (7 veces el lado)
    $perimeter = 7 * $side;

    // Área del heptágono (fórmula para área de un heptágono regular)
    $area = (7 / 4) * pow($side, 2) * (1 / tan(M_PI / 7));

    echo json_encode([
        'area' => $area,
        'perimeter' => $perimeter,
        'sides' => 7
    ]);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
