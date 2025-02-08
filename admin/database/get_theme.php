<?php
session_start();
require 'con_db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

// Iegūt tēmu no datubāzes
$stmt = $savienojums->prepare("SELECT theme FROM MP_users WHERE user_id = ?");
if ($stmt === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
    exit();
}

$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $_SESSION['theme'] = $user['theme'];
    echo json_encode(['theme' => $user['theme']]);
} else {
    echo json_encode(['theme' => 'light']); // noklusējuma tēma
}

$stmt->close();
$savienojums->close();
?> 