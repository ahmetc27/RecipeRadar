<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

include('config/db_connect.php');

if (!isset($_SESSION["currentSession"])) {

    $inputUsername = trim($_POST["userName"]);
    $inputPassword = trim($_POST["password"]);

    $valid = true;
    $errors = [];

    $query = "SELECT * FROM users WHERE LOWER(userName) = LOWER('$inputUsername')";
    $result = $conn->query($query);
    
    if (!$result) {
        die("SQL-Fehler: " . $db_obj->error);
    }
    
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    
        if (password_verify($inputPassword, $userData["password"])) {

            $_SESSION["currentSession"] = $userData;
            header("Location: welcome.php");

        } else {

            echo '<div class="alert alert-danger container" role="alert">Benutzername oder Passwort ist inkorrekt!</div>';
            echo "Password Verify Result: " . var_export(password_verify($inputPassword, $userData["password"]), true);
        
        }
        
    } else {
        echo '<div class="alert alert-danger container" role="alert">Benutzer nicht gefunden!</div>';
    }

}

?>