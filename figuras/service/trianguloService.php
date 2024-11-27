<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $lado = $data['lado'];

    $area = (sqrt(3) / 4) * $lado * $lado;
    $perimeter = 3 * $lado;

    echo json_encode(['area' => $area, 'perimeter' => $perimeter, 'sides' => 3]);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
