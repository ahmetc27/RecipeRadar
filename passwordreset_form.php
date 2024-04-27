<?php
require "config/db_connect.php";

$passError = $rpassError = $opassError = ""; // Initialize error messages
$error = false;
function cleanInputs($input)
{
    $data = trim($input); // removing extra spaces, tabs, newlines out of the string
    $data = strip_tags($data); // removing tags from the string
    $data = htmlspecialchars($data); // converting special characters to HTML entities, something like "<" and ">", it will be replaced by "&lt;" and "&gt";

    return $data;
}

if (isset($_POST["changepass"])) {

    $oldHashedPassword = $_SESSION['currentSession']['password'];
    $inputOldPassword = $_POST['opassword'];
    $inputNewPassword = $_POST['password'];
    $inputPasswordControl = $_POST['rpassword'];
    if (!(password_verify($inputOldPassword, $oldHashedPassword))) {
        $error = true;
        $opassError = "Old password is wrong";
    }

    // simple validation for the "password"
    if (empty($inputNewPassword)) {
        $error = true;
        $passError = "Password can't be empty!";
    }

    // simple validation for the "password"
    if (empty($inputPasswordControl)) {
        $error = true;
        $rpassError = "Password can't be empty!";
    } elseif ($inputNewPassword != $inputPasswordControl) {
        $error = true;
        $rpassError = "Repeat password doesn't match the password provided!";
    }

    if (!$error) { // if there is no error with any input, data will be inserted to the database
        // hashing the password before inserting it to the database
        $password = password_hash($inputNewPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE users set password = '$password' WHERE userID = {$_SESSION['currentSession']['userID']}";

        $result = mysqli_query($conn, $sql);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/css/design.css">

    <title>Welcome <?= $row["fname"] ?></title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5 mt-4">

                <form method="post" autocomplete="off">
                    <div class="mb-3">
                        <label for="passwordold" class="form-label">altes Passwort</label>
                        <input type="password" class="form-control auth-input" id="passwordold" name="opassword" required>
                        <span class="text-danger"><?= $opassError ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">neues passwort</label>
                        <input type="password" class="form-control auth-input" id="password" name="password" required>
                        <span class="text-danger"><?= $passError ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="rpassword" class="form-label">Passwort wiederholen</label>
                        <input type="password" class="form-control auth-input" id="rpassword" name="rpassword" required>
                        <span class="text-danger"><?= $rpassError ?></span>
                    </div>
                    <button name="changepass" type="submit" class="btn auth-btn btn-primary">passwort ändern</button>

                </form>
            </div>
        </div>
    </div>
</body>

</html>