<?php
include 'navbar.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$showForm = true;
require "db_connect.php";
$error = false;
$firstNameError = $lastNameError = $emailError = $userNameError = $passwordError = $rpasswordError = $successInsert = "";
$firstName = $lastName = $email = $address = $message = "";

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
    $lastName = cleanInput($_POST['lastName']);
    $userName = cleanInput($_POST['userName']);
    $email = cleanInput($_POST["email"]);
    $password = cleanInput($_POST["password"]);
    $passwordControl = cleanInput($_POST["passwordControl"]);

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

            $insert = "INSERT INTO `users`(`salutation`, `firstName`, `lastName`, `birthDate`, `userName`, `email`, `password`) VALUES ('$salutation','$firstName','$lastName', '$birthDate','$userName','$email','$hashedPassword')";
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


<!DOCTYPE html>
<html lang="de">
<nav>
    <?php
        include('navigation.php');
    ?>
</nav>

<head>
    <?php
        include('head.php');
    ?>
</head>


<body>
    <div class="page-content d-lg-flex align-items-center ">
        <div class="container">

            <!-- dies ist nur eine temporäre Korrektur -->
            </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>


            <div class="row justify-content-center">
                <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                    <h4 class="untertitle mb-1 mt-5">Registrierung</h4>
                    <hr>

                    <?php if ($showForm) : ?>
                        <form method="POST" action="registrierung.php">
                            <div class="mb-2">
                                <label for="salutation" class="left-align-label">Anrede:</label>
                                <select class="form-select auth-select mb-2" aria-label="Default select example" name="salutation">
                                    <option value="Keine Angabe" class="auth-input" <?php if ($salutation == "Keine Angabe") echo "selected"; ?>>Keine Angabe</option>
                                    <option value="Herr" class="auth-input" <?php if ($salutation == "Herr") echo "selected"; ?>>Mann</option>
                                    <option value="Frau" <?php if ($salutation == "Frau") echo "selected"; ?>>Frau</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="firstName" class="left-align-label">Vorname:</label>
                                <input type="text" class="form-control auth-input" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
                                <p class="text-danger left-align-label"><?= $firstNameError ?></p>
                            </div>
                            <div class="mb-2">
                                <label for="lastName" class="left-align-label">Nachname:</label>
                                <input type="text" class="form-control auth-input" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
                                <p class="text-danger left-align-label"><?= $lastNameError ?></p>
                            </div>
                            <div class="mb-2">
                                <label for="birth_date" class="left-align-label">Geburtsdatum:</label>
                                <input type="date" class="form-control auth-input" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
                            </div>
                            <div class="mb-2">
                                <label for="mail" class="left-align-label">E-Mail Adresse:</label>
                                <input type="email" class="form-control auth-input" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                                <p class="text-danger left-align-label"><?= $emailError ?></p>
                            </div>
                            <div class="mb-2">
                                <label for="userName" class="left-align-label">Benutzername:</label>
                                <input type="text" class="form-control auth-input" name="userName" value="<?php echo htmlspecialchars($userName); ?>" required>
                                <p class="text-danger left-align-label"><?= $userNameError ?></p>
                            </div>
                            <div class="mb-2">
                                <label for="password" class="left-align-label">Passwort:</label>
                                <input type="password" class="form-control auth-input" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
                                <p class="text-danger left-align-label"><?= $passwordError ?></p>
                            </div>
                            <div class="mb-2">
                                <label for="password" class="left-align-label">Passwort wiederholen:</label>
                                <input type="password" class="form-control auth-input" name="passwordControl" value="<?php echo htmlspecialchars($passwordControl); ?>" required>
                            </div>
                            <div class="mb-2">
                                <button type="submit" class="btn auth-btn mt-3 mb-3" name="submit">Registrieren</button>
                            </div>
                        <?php endif; ?>
                        <?php echo $successInsert; ?>
                        <hr>
                        <p class="text mb-1 mt-3">Bereits einen Account? <a href="login.php" class="text-link">Zum Login</a></p>
                        <p class="text mb-5">Zur&uuml;ck zur <a href="index.php" class="text-link">Startseite</a></p>

                        </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootsttap js -->
    <script src="res/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>