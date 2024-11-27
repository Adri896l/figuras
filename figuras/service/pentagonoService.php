<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $ladoP = $data['ladoP'];
    $apotema = $data['apotema'];

    $area = (5 / 4) * $ladoP * $apotema;
    $perimeter = 5 * $ladoP;

    echo json_encode(['area' => $area, 'perimeter' => $perimeter, 'sides' => 5]);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
