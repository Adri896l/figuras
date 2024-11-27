<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $side = $data['side'];

    $area = $side * $side;
    $perimeter = 4 * $side;

    echo json_encode(['area' => $area, 'perimeter' => $perimeter, 'sides' => 4]);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
