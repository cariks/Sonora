<?php
function getUserData($savienojums, $user_id, $force_refresh = false) {
    // Ja dati jau ir sesijā un nav nepieciešams spēcīgi atjaunināt
    if (!$force_refresh && isset($_SESSION['user_data']) && isset($_SESSION['user_data_timestamp'])) {
        // Pārbaude, vai dati nav seni (5 minūtes)
        if (time() - $_SESSION['user_data_timestamp'] < 300) {
            return $_SESSION['user_data'];
        }
    }

    $stmt = $savienojums->prepare("SELECT username, email, profile_picture FROM MP_users WHERE user_id = ?");
    
    if ($stmt === false) {
        return null;
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    
    if ($user) {
        // Saglabājam datus sesijā
        $_SESSION['user_data'] = $user;
        $_SESSION['user_data_timestamp'] = time();
    }
    
    return $user;
}
?>