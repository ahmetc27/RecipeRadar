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

    <body style="background-color: rgb(250,245,225);">

    <?php
        include('navigation.php');
    ?>
        
    <main class="page-content d-lg-block py-5 align-items-center ">

        <?php
            include('profile_form.php');
        ?>

    </main>

    <?php
        include('footer.php');
     ?>

    </body>

</html>