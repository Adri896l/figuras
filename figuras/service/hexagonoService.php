<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $ladoH = $data['ladoH'];

    $area = (3 * sqrt(3) / 2) * $ladoH * $ladoH;
    $perimeter = 6 * $ladoH;

    echo json_encode(['area' => $area, 'perimeter' => $perimeter, 'sides' => 6]);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>