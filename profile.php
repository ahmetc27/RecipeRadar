<?php
session_start();

if (!isset($_SESSION['currentSession'])) {
    header("Location: login.php");
    exit();
}

include('config/db_connect.php');

?>

<!DOCTYPE html>
<html>

    <?php
        include('head.php');
    ?>

    <body>

        <header>

            <?php
                include('navigation.php');
            ?>
        
        </header>

        <main class="page-content d-lg-block py-5 align-items-center ">

            <?php
                    include('profile_form.php');
            ?>

        </main>

        <?php
            include('footer.php');
        ?>

        <!-- Bootsttap js -->
         <!-- warum brauchen wir es hier? -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>

</html>