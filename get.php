<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$filename = 'player_data.json';
$allData = [];
if (file_exists($filename)) {
    $allData = json_decode(file_get_contents($filename), true) ?: [];
}

// Filter out old data (older than 5 seconds)
$currentTime = time() * 1000;
$filteredData = array_filter($allData, function($player) use ($currentTime) {
    return ($currentTime - $player['timestamp']) < 5000;
});

echo json_encode($filteredData);
?>
