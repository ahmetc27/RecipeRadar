<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$showForm = true;

include('config/db_connect.php');

$error = false;
$rpasswordError = $successInsert = "";

// Initializing additional variables to avoid undefined variable errors
$firstName = $lastName = $email = $userName = $password = $passwordControl = $salutation = $birthDate = "";

function cleanInput($value)
{
    $input = trim($value);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);

    return $input;
}

if (isset($_POST['submit'])) {
    $password = "";
    $salutation = cleanInput($_POST['salutation']);
    $firstName = cleanInput($_POST['firstName']);
    $middleName = cleanInput($_POST['middleName']);
    $lastName = cleanInput($_POST['lastName']);
    $userName = cleanInput($_POST['userName']);
    $email = cleanInput($_POST["email"]);
    $password = cleanInput($_POST["password"]);
    $passwordControl = cleanInput($_POST["passwordControl"]);
    $birthDate = cleanInput($_POST["birthDate"]);

    // Initializing variables to avoid undefined variable errors
    $result = null;
    $message = "";

    if (!$error) {
        //Überprüfen ob der userName bereits vorhanden ist.
        $checkQuery = "SELECT * FROM `users` WHERE `userName` = '$userName'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Benutzername bereits vorhanden!
            $userNameError = "Dieser Benutzername ist bereits vergeben!";
        }
        //Überprüfen ob der email bereits vorhanden ist.
        $checkQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // email bereits registriert!!
            $emailError = "Dieser email ist bereits registriert!";
        }

        // Überprüfen, ob die Passwörter übereinstimmen, bevor sie gehasht werden
        if ($password == $passwordControl) {
            // Hashen des Passworts
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insert = "INSERT INTO `users`(`salutation`, `firstName`, `middleName`, `lastName`, `userName`, `email`, `password`,  `birthDate`) VALUES ('$salutation','$firstName','$middleName','$lastName','$userName','$email','$hashedPassword','$birthDate')";
            $result = mysqli_query($conn, $insert);

            if (!$result) {
                die('Error: ' . mysqli_error($conn));
            } else {
                $successInsert = '<div class="auth-message auth-success">Erfolgreich registriert</div>';
                // Felder leeren
                $firstName = $lastName = $email = $userName = $passwordFirst = $passwordControl = $salutation = "";
            }

            if ($result) {
                $message = '<div class="auth-message auth-success">Erfolgreich registriert</div>';
                // Set showForm to false to hide the form after successful registration
                $showForm = false;
            } else {
                $message = "<div class='alert alert-danger' role='alert'>
                <h4 class='alert-heading'>Ohh, snap :|</h4>
                <p>Something went wrong, please try again later</p> </div>";
            }
        } else {
            $passwordError = "Die Passwörter stimmen nicht überein!";
        }
    }

} ?>
