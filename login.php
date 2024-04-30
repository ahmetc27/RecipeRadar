<?php
session_start();

if (isset($_SESSION["currentSession"])) {
    header("Location: profile.php");
  }

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
                    include('login_form.php');
            ?>

        </main>

        <?php
            include('footer.php');
        ?>

    </body>

</html>