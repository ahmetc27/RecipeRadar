<?php

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
require 'config/db_connect.php';

// Include the user_service.php to fetch current user information
require 'user_service.php';

// Initialize error variables
$fnameError = $mnameError = $lnameError = $emailError = $unameError = $errorMessage = "";
$error = false;

//
// need to move this function into a separate file or main.js, because multiple files use the same code
//
// Function to clean user inputs
function cleanInputs($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    // Clean user inputs
    $salutation = cleanInputs($_POST["salutation"]);
    $fname = cleanInputs($_POST["firstName"]);
    $mname = cleanInputs($_POST["middleName"]);
    $lname = cleanInputs($_POST["lastName"]);
    $username = cleanInputs($_POST["userName"]);
    $email = cleanInputs($_POST["email"]);
    $birthDate = cleanInputs($_POST["birthDate"]);

    // Validate first name
    if (empty($fname)) {
        $error = true;
        $fnameError = "Please enter your first name";
    } elseif (strlen($fname) < 3) {
        $error = true;
        $fnameError = "First name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $error = true;
        $fnameError = "First name must contain only letters and spaces.";
    }

    // Validate middle name
    if (empty($mname)) {
        $error = true;
        $mnameError = "Please enter your middle name";
    } elseif (strlen($mname) < 3) {
        $error = true;
        $mnameError = "Middle name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $mname)) {
        $error = true;
        $mnameError = "Middle name must contain only letters and spaces.";
    }

    // Validate last name
    if (empty($lname)) {
        $error = true;
        $lnameError = "Please enter your last name";
    } elseif (strlen($lname) < 3) {
        $error = true;
        $lnameError = "Last name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
        $error = true;
        $lnameError = "Last name must contain only letters and spaces.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } elseif ($email != $user["email"]) {
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Provided email is already in use";
        }
    }

    // Validate username
    if (empty($username)) {
        $error = true;
        $unameError = "Please enter your username";
    } elseif (strlen($username) < 3) {
        $error = true;
        $unameError = "Username must have at least 3 characters.";
    } elseif ($username != $user["userName"]) {
        $query = "SELECT userName FROM users WHERE userName='$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $unameError = "Provided username is already in use";
        }
    }

    // Check if there are changes in user data
    if (
        $salutation != $user["salutation"] ||
        $fname != $user["firstName"] ||
        $mname != $user["middleName"] ||
        $lname != $user["lastName"] ||
        $username != $user["userName"] ||
        $email != $user["email"] ||
        $birthDate != $user["birthDate"]
    ) {
        // If no validation errors, update user data in the database
        if (!$error) {
            $update = "UPDATE users SET salutation='$salutation', firstName='$fname', middleName='$mname', lastName='$lname', userName='$username', email='$email', birthDate='$birthDate' WHERE userID={$userData['userID']}";
            $updateResult = mysqli_query($conn, $update);

            if ($updateResult) {
                // Update session data
                $_SESSION['currentSession']['salutation'] = $salutation;
                $_SESSION['currentSession']['firstName'] = $fname;
                $_SESSION['currentSession']['middleName'] = $mname;
                $_SESSION['currentSession']['lastName'] = $lname;
                $_SESSION['currentSession']['userName'] = $username;
                $_SESSION['currentSession']['email'] = $email;
                $_SESSION['currentSession']['birthDate'] = $birthDate;

                // Success message

                // the line below that redirects in case of refresh has an issue so this is removed as well
                //$_SESSION['successMessage'] = "<div class='alert alert-success'>Update successful<br><small>Reload the page to see the updates</small></div>";
                
                
                // Redirect to remove the success message on refresh
                
                // the line below has an issue
                // header("Location: {$_SERVER['REQUEST_URI']}");
                
                exit();
            } else {
                $errorMessage = "<div class='alert alert-danger'>Something went wrong. Please try again later.</div>";
            }
        }
    }
}

?>
