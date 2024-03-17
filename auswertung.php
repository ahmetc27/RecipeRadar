<?php
// anmelde_skript.php
require "db_connect.php";

session_start();

if (isset($_SESSION["currentSession"])) {
  header("Location: index.php");
} else {
  $inputUsername = trim($_POST["userName"]);
  $inputPassword = trim($_POST["password"]);

  $query = "SELECT * FROM users WHERE LOWER(userName) = LOWER('$inputUsername')";
  $result = $conn->query($query);
  $statusSql = "SELECT * FROM users WHERE userName = '$inputUsername'";
  $statusQuery = mysqli_query($conn, $statusSql);
  $statusResult = mysqli_fetch_assoc($statusQuery);

  if (!$result) {
    die("SQL-Fehler: " . $conn->error);
  }


  if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    $hashedPassword = $userData["password"];

    // Überprüfen, ob das eingegebene Passwort mit dem gehashten Passwort übereinstimmt
    if (password_verify($inputPassword, $hashedPassword) && $status == "aktiv") {
      $_SESSION["currentSession"] = $userData;
      header("Location: welcome.php");
    } else {
      echo '<div class="alert alert-danger container" role="alert">Benutzername oder Passwort ist inkorrekt!</div>';
      echo "Password Verify Result: " . var_export(password_verify($inputPassword, $hashedPassword), true);
    }
  } else {
    echo '<div class="alert alert-danger container" role="alert">Benutzer nicht gefunden!</div>';
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Problem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>