<?php
session_start();
require 'con_db.php';

// Iegūt datus no POST pieprasījuma
$data = json_decode(file_get_contents('php://input'), true);
$theme = isset($data['theme']) ? $data['theme'] : null;

if ($theme !== 'light' && $theme !== 'dark') {
    http_response_code(400);
    echo json_encode(['error' => 'Nederīga tēmas vērtība']);
    exit();
}

// Atjaunināt tēmu datubāzē
$stmt = $savienojums->prepare("UPDATE MP_users SET theme = ? WHERE user_id = ?");
if ($stmt === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Datubāzes kļūda']);
    exit();
}

$stmt->bind_param("si", $theme, $_SESSION['user_id']);

if ($stmt->execute()) {
    // Atjaunināt tēmu sesijā
    $_SESSION['theme'] = $theme;
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Neizdevās atjaunināt tēmu']);
}

$stmt->close();
$savienojums->close();
?> 