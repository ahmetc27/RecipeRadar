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

        <style>
            main {
            min-height: 1000px;
            }
        </style>
    </head>

    <body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

        <header>

            <?php
                include('components/navigation.php');
            ?>
                    
        </header>

        <main>
            <div class="container" style="margin-top: 120px;">

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