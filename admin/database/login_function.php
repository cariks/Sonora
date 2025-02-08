<?php
    if(isset($_POST['ielogoties'])) {
        require 'con_db.php';
        session_start();

        // Veco kļūdu ziņojumu dzēšana
        unset($_SESSION['error']);

        $username = htmlspecialchars(trim($_POST['lietotajs']), ENT_QUOTES, 'UTF-8');
        $password = $_POST['parole'];

        if(empty($username) || empty($password)) {
            $_SESSION['error'] = "Lūdzu, aizpildiet visus laukus!";
            header("Location: ../../login.php");
            exit();
        }

        // Datu bāzes vaicājuma sagatavošana
        $stmt = $savienojums->prepare("SELECT * FROM MP_users WHERE username = ?");
        
        // Datubāzes vaicājuma pārbaude
        if ($stmt === false) {
            $_SESSION['error'] = "Datubāzes kļūda: " . htmlspecialchars($savienojums->error, ENT_QUOTES, 'UTF-8');
            header("Location: ../../login.php");
            exit();
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8');
            $_SESSION['role'] = htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8');
            $_SESSION['theme'] = htmlspecialchars($user['theme'], ENT_QUOTES, 'UTF-8');

            // Pēdējā pieteikšanās laika atjaunināšana
            $update_stmt = $savienojums->prepare("UPDATE MP_users SET last_login = NOW() WHERE user_id = ?");
            if ($update_stmt === false) {
                error_log("Failed to update last_login: " . htmlspecialchars($savienojums->error, ENT_QUOTES, 'UTF-8'));
            } else {
                $update_stmt->bind_param("i", $user['user_id']);
                $update_stmt->execute();
                $update_stmt->close();
            }

            header("Location: ../../index.php");
            exit();
        } else {
            $_SESSION['error'] = "Nepareizs lietotājvārds vai parole!";
            header("Location: ../../login.php");
            exit();
        }

        $stmt->close();
        $savienojums->close();
    }
?>