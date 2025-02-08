<?php
session_start();
require 'con_db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}


if ($stmt->execute()) {
    // Lietotāja datu kešatmiņas atiestatīšana
    unset($_SESSION['user_data']);
    unset($_SESSION['user_data_timestamp']);
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to update profile picture']);
}

$stmt->close();
$savienojums->close();
?> 