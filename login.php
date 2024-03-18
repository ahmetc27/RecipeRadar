<!DOCTYPE html>
<html>

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
            <div class="row justify-content-center">
                <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                    <h4 class="untertitle mb-1 mt-5">Login</h4>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>