<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$dataFile = '../data/positions.json';

// Create data directory if it doesn't exist
if (!file_exists('../data')) {
    mkdir('../data', 0755, true);
}

// Initialize default positions
$defaultPositions = [
    'julio' => 'center 35%',
    'soren' => 'center 8%',
    'sun' => 'center 3%',
    'inaya' => 'center 3%',
    'andres' => 'center 0%',
    'yoruhime' => 'center 18%'
];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Read positions from file
    if (file_exists($dataFile)) {
        $positions = json_decode(file_get_contents($dataFile), true);
        // Merge with defaults for any missing positions
        $positions = array_merge($defaultPositions, $positions ?: []);
    } else {
        $positions = $defaultPositions;
        // Create file with defaults
        file_put_contents($dataFile, json_encode($positions, JSON_PRETTY_PRINT));
    }
    
    echo json_encode($positions);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save positions to file
    $input = json_decode(file_get_contents('php://input'), true);
    
    if ($input && isset($input['positions'])) {
        // Load existing positions
        $existingPositions = [];
        if (file_exists($dataFile)) {
            $existingPositions = json_decode(file_get_contents($dataFile), true) ?: [];
        }
        
        // Merge with new positions
        $positions = array_merge($existingPositions, $input['positions']);
        
        // Save to file
        if (file_put_contents($dataFile, json_encode($positions, JSON_PRETTY_PRINT))) {
            echo json_encode(['success' => true, 'message' => 'Positions sauvegardées']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la sauvegarde']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Données invalides']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
?>

