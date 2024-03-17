<?php
session_start();
if (!isset($_SESSION["currentSession"])) {
    header("Location: login.php");
}
$registeredData = $_SESSION["currentSession"];
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Willkommen</title>
    <link rel="stylesheet" href="res/css/design.css">
    <link rel="stylesheet" href="res/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="page-content d-flex align-items-center">
        <div class="container d-flex justify-content-center">
            <div class="col-17 col-sm-15 col-md-12 col-lg-10 col-xl-8 col-xxl-6">
                <div class="auth-card">
                    <div class="inhalt">
                        <center>
                            <h1>Willkommen <?php echo $registeredData["firstName"]; ?>!</h1>
                            <p>Zur&uuml;ck zur <a href="index.php" class="text-link">Startseite</a></p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>