<?php 

require 'config/db_connect.php';

session_start();

if (!isset($_SESSION['currentSession'])) {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html>

    <head>

        <?php
            include('components/head.php');
        ?>

        <script src="resources/js/post_form_script.js"></script>

    </head>

    <body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

        <header>

            <?php
                include('components/navigation.php');
            ?>
                    
        </header>

        <main>

            <!-- we should set it up as background instead of the image element -->
            <!-- <img class="home-logo" src="pictures/logo-new.png" alt="Recipe Radar" /> -->
            <div class="container">

                <?php
                    include('components/search_result_form.php');
                ?>

            </div>

        </main>
        
        <?php
            include('components/footer.php');
        ?>

    </body>

</html>