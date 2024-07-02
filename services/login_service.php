<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../config/db_connect.php';

if (!isset($_SESSION["currentSession"])) {

    $inputUsername = trim($_POST["userName"]);
    $inputPassword = trim($_POST["password"]);

    $valid = true;
    $errors = [];

    $query = "SELECT * FROM users WHERE LOWER(userName) = LOWER('$inputUsername')";
    $result = $conn->query($query);

    if (!$result) {
        die("SQL Error: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();

        if (password_verify($inputPassword, $userData["password"])) {
            // Currently the session stores all data, including the password which is not safe practice
            // Later adjust so that all other user data is included in the currentSession except password
            $_SESSION["currentSession"] = $userData;
            echo '<script>alert("Login successful!"); window.close();</script>';
            exit; // Stop further execution
        } else {
            echo '<script>alert("Username or password is incorrect!"); window.history.back();</script>';
            exit; // Stop further execution
        }

    } else {
        echo '<script>alert("User not found!"); window.history.back();</script>';
        exit; // Stop further execution
    }

}

?>
