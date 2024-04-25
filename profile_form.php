<?php

require "config/db_connect.php";

$sql = "SELECT * from users where userID = {$_GET["id"]}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$fnameError = $lnameError = $emailError = $unameError = "";
$error = false;
function cleanInputs($input)
{
    $data = trim($input); // removing extra spaces, tabs, newlines out of the string
    $data = strip_tags($data); // removing tags from the string
    $data = htmlspecialchars($data); // converting special characters to HTML entities, something like "<" and ">", it will be replaced by "&lt;" and "&gt";

    return $data;
}

if (isset($_POST["edit"])) {
    $fname = cleanInputs($_POST["fname"]);
    $lname = cleanInputs($_POST["lname"]);
    $username = cleanInputs($_POST["username"]);
    $email = cleanInputs($_POST["email"]);
    $salutation = cleanInputs($_POST["salutation"]);

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



    // simple validation for the "date of birth"
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
        $query = "SELECT username FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $unameError = "Provided Username is already in use";
        }
    }


    if (!$error) { // if there is no error with any input, data will be inserted to the database

        $update = "UPDATE users SET firstName='$fname', lastName = '$lname', email = '$email', userName = '$username',salutation = '$salutation' WHERE userID = {$_GET["id"]}";

        $updateResult = mysqli_query($conn, $update);

        if ($updateResult) {
            echo "<div class='alert alert-success'>
            <p>Update Success</p>
        </div>";
        } else {
            echo "<div class='alert alert-danger'>
            <p>Something went wrong, please try again later ...</p>
        </div>";
        }
    }
}
?>


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

            <form method="post" autocomplete="off">
                <div class="mb-3 mt-3">
                    <label for="fname" class="form-label">First name</label>
                    <input type="text" required class="form-control" id="fname" name="fname" placeholder="First name" value="<?= $row["firstName"] ?>">
                    <span class="text-danger"><?= $fnameError ?></span>
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last name</label>
                    <input type="text" required class="form-control" id="lname" name="lname" placeholder="Last name" value="<?= $row["lastName"] ?>">
                    <span class="text-danger"><?= $lnameError ?></span>
                </div>
                <div class="mb-3">
                    <label for="salutation" class="left-align-label">Anrede:</label>
                    <select class="form-select auth-select mb-2" aria-label="Default select example" name="salutation">
                        <option value="Keine Angabe" class="auth-select">Keine Angabe</option>
                        <option value="Herr" class="auth-select" <?= ($row["salutation"] == "Herr") ? "selected" : "" ?>>Mann</option>
                        <option value="Frau" class="auth-select" <?= ($row["salutation"] == "Frau") ? "selected" : "" ?>>Frau</option>
                    </select>
                </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Username</label>
            <input type="text" required class="form-control" id="email" name="username" placeholder="User name" value="<?= $row["userName"] ?>">
            <span class="text-danger"><?= $unameError ?></span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $row["email"] ?>">
            <span class="text-danger"><?= $emailError ?></span>
        </div>

      
        <p class="text mb-1 mt-3">Haben Sie Ihr Passort vergessen? <a href="passwordreset.php?id=<?= $_GET["id"] ?>" class="text-link">Passwort ändern</a></p>

        <button name="edit" type="submit" class="btn btn-primary">Edit account</button>

        </form>
    </div>
    </div>
    <a class="nav-link" href="logout_service.php">Logout</a>
</body>

</html>