<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents('php://input'), true);
if ($data && isset($data['id'])) {
    $filename = 'player_data.json';
    $allData = [];
    
    if (file_exists($filename)) {
        $allData = json_decode(file_get_contents($filename), true) ?: [];
    }
    
    $allData[$data['id']] = $data;
    file_put_contents($filename, json_encode($allData));
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}
?>
