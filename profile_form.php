<?php

require "config/db_connect.php";

// Session starten, um auf Benutzerdaten zugreifen zu können
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (isset($_SESSION['currentSession'])) {
    // Benutzerdaten aus der Session abrufen
    $userData = $_SESSION['currentSession'];

    // Datenbankabfrage, um die vorhandenen Benutzerdaten abzurufen
    $sql = "SELECT * FROM users WHERE userID = {$userData['userID']}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Fehlervariablen für die Validierung initialisieren
    $fnameError = $lnameError = $emailError = $unameError = "";
    $error = false;

    // Funktion zur Bereinigung von Eingaben definieren
    function cleanInputs($input)
    {
        $data = trim($input);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Überprüfen, ob das Formular gesendet wurde
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
        // Benutzereingaben bereinigen
        $salutation = cleanInputs($_POST["salutation"]);
        $fname = cleanInputs($_POST["firstName"]);
        $mname = cleanInputs($_POST["middleName"]);
        $lname = cleanInputs($_POST["lastName"]);
        $username = cleanInputs($_POST["userName"]);
        $email = cleanInputs($_POST["email"]);
        $birthDate = cleanInputs($_POST["birthDate"]);

        // simple validation for the "first name"
        if (empty($fname)) {
            $error = true;
            $fnameError = "Please, enter your first name";
        } elseif (strlen($fname) < 3) {
            $error = true;
            $fnameError = "Name must have at least 3 characters.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
            $error = true;
            $fnameError = "Name must contain only letters and spaces.";
        }

        // simple validation for the "Middle name"
        if (empty($mname)) {
            $error = true;
            $mnameError = "Please, enter your Middle name";
        } elseif (strlen($mname) < 3) {
            $error = true;
            $mnameError = "Middle name must have at least 3 characters.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $mname)) {
            $error = true;
            $mnameError = "Middle name must contain only letters and spaces.";
        }

        // simple validation for the "last name"
        if (empty($lname)) {
            $error = true;
            $lnameError = "Please, enter your last name";
        } elseif (strlen($lname) < 3) {
            $error = true;
            $lnameError = "Last name must have at least 3 characters.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
            $error = true;
            $lnameError = "Last name must contain only letters and spaces.";
        }

        // simple validation for the "email"
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // if the provided text is not a format of an email, error will be true
            $error = true;
            $emailError = "Please enter a valid email address";
        } elseif ($email != $row["email"]) {
            // if email is already exists in the database, error will be true
            $query = "SELECT email FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) != 0) {
                $error = true;
                $emailError = "Provided Email is already in use";
            }
        }

        if (empty($username)) { // if the provided text is not a format of an email, error will be true
            $error = true;
            $unameError = "Please enter your username";
        } elseif ($username != $row["userName"]) {
            $query = "SELECT userName FROM users WHERE userName='$username'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) != 0) {
                $error = true;
                $unameError = "Provided Username is already in use";
            }
        }

        // Überprüfen, ob tatsächlich Änderungen an den Benutzerdaten vorgenommen wurden
        if (
            $salutation != $row["salutation"] ||
            $fname != $row["firstName"] ||
            $mname != $row["middleName"] ||
            $lname != $row["lastName"] ||
            $username != $row["userName"] ||
            $email != $row["email"] ||
            $birthDate != $row["birthDate"]
        ) {
            // Wenn keine Validierungsfehler auftreten
            if (!$error) {
                // UPDATE-Abfrage vorbereiten und ausführen, um die Benutzerdaten in der Datenbank zu aktualisieren
                $update = "UPDATE users SET salutation='$salutation', firstName='$fname', middleName='$mname', lastName='$lname', userName='$username', email='$email', birthDate='$birthDate' WHERE userID={$userData['userID']}";
                $updateResult = mysqli_query($conn, $update);

                // Überprüfen, ob die Aktualisierung erfolgreich war
                if ($updateResult) {
                    // Erfolgsmeldung anzeigen
                    $_SESSION['successMessage'] = "<div class='alert alert-success'>Update erfolgreich<br><small>Laden Sie die Seite neu, um die Updates anzuzeigen</small></div>";
                    // Weiterleitung zur gleichen Seite, um die Erfolgsmeldung zu entfernen
                    header("Location: {$_SERVER['REQUEST_URI']}");
                    exit();
                } else {
                    // Fehlermeldung anzeigen, wenn die Aktualisierung fehlschlägt
                    $errorMessage = "<div class='alert alert-danger'>Etwas ist schiefgelaufen. Bitte versuchen Sie es später erneut.</div>";
                }
            }
        }
    }

    // Überprüfen, ob eine Erfolgsmeldung vorhanden ist und sie dann ausgeben
    if (isset($_SESSION['successMessage'])) {
        echo '<div class="container">';
        echo $_SESSION['successMessage'];
        echo '</div>';
        unset($_SESSION['successMessage']); // Die Erfolgsmeldung aus der Session entfernen
    }
} else {
    // Weiterleitung zur Anmeldeseite, wenn der Benutzer nicht angemeldet ist
    header("Location: login.php");
    exit();
}
?>

<!-- HTML-Formular zum Aktualisieren des Benutzerprofils -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <?php echo isset($successMessage) ? $successMessage : ''; ?>
            <?php echo isset($errorMessage) ? $errorMessage : ''; ?>
            <form method="post" autocomplete="off">
                <div class="mb-3 mt-3">
                    <label for="salutation" class="form-label">Salutation</label>
                    <select class="form-select" id="salutation" name="salutation" required>
                        <option value="" disabled selected>Choose Salutation</option>
                        <option value="Keine Angabe" <?php if ($row["salutation"] === "Keine Angabe") echo "selected"; ?>>Keine Angabe</option>
                        <option value="Herr" <?php if ($row["salutation"] === "Herr") echo "selected"; ?>>Herr</option>
                        <option value="Frau" <?php if ($row["salutation"] === "Frau") echo "selected"; ?>>Frau</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="text" required class="form-control" id="firstName" name="firstName" placeholder="First name" value="<?= $row["firstName"] ?>">
                    <span class="text-danger"><?= $fnameError ?></span>
                </div>
                <div class="mb-3">
                    <label for="middleName" class="form-label">Middle name</label>
                    <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle name" value="<?= $row["middleName"] ?>">
                    <span class="text-danger"><?= $mnameError ?></span>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last name</label>
                    <input type="text" required class="form-control" id="lastName" name="lastName" placeholder="Last name" value="<?= $row["lastName"] ?>">
                    <span class="text-danger"><?= $lnameError ?></span>
                </div>
                <div class="mb-3">
                    <label for="userName" class="form-label">User name</label>
                    <input type="text" required class="form-control" id="userName" name="userName" placeholder="User name" value="<?= $row["userName"] ?>">
                    <span class="text-danger"><?= $unameError ?></span>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" required class="form-control" id="email" name="email" placeholder="Email address" value="<?= $row["email"] ?>">
                    <span class="text-danger"><?= $emailError ?></span>
                </div>
                <div class="mb-3">
                    <label for="birthDate" class="form-label">Birth date</label>
                    <input type="date" class="form-control" id="birthDate" name="birthDate" value="<?= $row["birthDate"] ?>">
                </div>
                <p class="text mb-1 mt-2">Haben Sie Ihr Passort vergessen? <a href="passwordreset_service.php?id=<?= $_GET["id"] ?>" class="text-link">Passwort ändern</a></p>

                <button name="edit" type="submit" class="btn btn-primary mt-3">Edit account</button>
            </form>
        </div>
        <a class="btn btn-danger mt-4" href="logout_service.php">Logout</a>
    </div>
</body>

</html>