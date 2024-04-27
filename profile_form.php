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

        // Validierung der Eingaben...

        // Wenn keine Validierungsfehler auftreten
        if (!$error) {
            // UPDATE-Abfrage vorbereiten und ausführen, um die Benutzerdaten in der Datenbank zu aktualisieren
            $update = "UPDATE users SET salutation='$salutation', firstName='$fname', middleName='$mname', lastName='$lname', userName='$username', email='$email', birthDate='$birthDate' WHERE userID={$userData['userID']}";
            $updateResult = mysqli_query($conn, $update);

            // Überprüfen, ob die Aktualisierung erfolgreich war
            if ($updateResult) {
                // Erfolgsmeldung anzeigen
                $successMessage = "<div class='alert alert-success'>Update erfolgreich</div>";
            } else {
                // Fehlermeldung anzeigen, wenn die Aktualisierung fehlschlägt
                $errorMessage = "<div class='alert alert-danger'>Etwas ist schiefgelaufen. Bitte versuchen Sie es später erneut.</div>";
            }
        }
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
                </div>
                <div class="mb-3">
                    <label for="middleName" class="form-label">Middle name</label>
                    <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle name" value="<?= $row["middleName"] ?>">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last name</label>
                    <input type="text" required class="form-control" id="lastName" name="lastName" placeholder="Last name" value="<?= $row["lastName"] ?>">
                </div>
                <div class="mb-3">
                    <label for="userName" class="form-label">User name</label>
                    <input type="text" required class="form-control" id="userName" name="userName" placeholder="User name" value="<?= $row["userName"] ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" required class="form-control" id="email" name="email" placeholder="Email address" value="<?= $row["email"] ?>">
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