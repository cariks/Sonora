<?php
function getUserData($savienojums, $user_id) {
    $stmt = $savienojums->prepare("SELECT username, email, profile_picture FROM MP_users WHERE user_id = ?");
    
    if ($stmt === false) {
        return null;
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    
    return $user;
}
?> 