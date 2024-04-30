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
                    include('passwordreset_form.php');
            ?>

        </main>

        <?php
            include('footer.php');
        ?>

    </body>

</html>