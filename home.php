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

                <!-- need to make it a bit slower when appearing/dissappearing -->
                <div id="postFormContainer" style="display: none;">
        
                    <?php
                        include('components/post_form.php');
                    ?>
                
                </div>
    
                <!-- need to make it full width and have some space between two buttons later -->
                <button id="togglePostFormBtn" class="btn btn-primary">Toggle Post Form</button>

            </div>

            <!-- change this later? -->
            <hr style="border-top: 0px;">

            <div class="container">

                <?php
                        include('components/feed.php');
                ?>

            </div>

        </main>
        
        <?php
            include('components/footer.php');
        ?>

    </body>

</html>