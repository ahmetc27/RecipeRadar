<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login MD Hotel</title>
    <!-- font awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="res/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/css/design.css">

</head>

<body>
    <div class="page-content d-lg-flex align-items-center ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                    <h4 class="untertitle mb-1 mt-5">login</h4>
                    <hr>
                    <form action="auswertung.php" method="post">
                        <div class="mb-2 mt-3">
                            <label for="userName" class="left-align-label">Benuzername:</label>
                            <input type="text" class="form-control auth-input" name="userName" required>
                        </div>
                        <div class="mb-3 mt-2">
                            <label for="password" class="left-align-label">Passwort:</label>
                            <div class="mb-3 mt-2">
                                <input type="password" class="form-control auth-input" name="password" id="password" required>
                            </div>

                        </div>
                        <button class="btn auth-btn mt-2 mb-3">Sign in</button>
                        <hr class="seperator">
                        <p class="text mb-1 mt-3">Noch kein Konto? <a href="registrierung.php" class="text-link">Account erstellen</a></p>
                        <p class="mb-5">Zur&uuml;ck zur <a href="index.php" class="text-link">Startseite</a></p>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootsttap js -->
        <script src="res/js/bootstrap.bundle.min.js"></script>
</body>

</html>