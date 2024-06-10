<?php 

require 'config/db_connect.php';

session_start();

if (isset($_SESSION['currentSession'])) {
    header("location: home.php");
}

?>

<!DOCTYPE html>
<html>

    <head>

        <?php
            include('components/head.php');
        ?>

        <link rel="stylesheet" type="text/css" href="resources/css/tabs_style.css">

    </head>

    <body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

        <header>

            <!-- maybe don't have navigatioon on index? or have even more limited choices? -->
            <?php
                include('components/navigation.php');
            ?>
                    
        </header>

        <main>

            <!-- we should set it up as background instead of the image element -->
            <!-- <img class="home-logo" src="pictures/logo-new.png" alt="Recipe Radar" /> -->

            <!-- temporarily here, will need to change css later -->
            <hr>

            <!-- later will need a "row" so that the admin feed is next to the login/register form -->
            <div class ="row">

                <div class="container col-6-m col-12-sm">

                    <?php
                            include('components/feed.php');
                    ?>
                
                </div>

                <div class="container col-6-m col-12-sm">

                    <div class="tab">
                        <button id="defaultOpen" class="tablinks" onclick="openTab(event, 'login')">Login</button>
                        <button class="tablinks" onclick="openTab(event, 'register')">Register</button>
                    </div>

                    <div id="login" class="tabcontent">
                        <?php include('components/login_form.php'); ?>
                    </div>

                    <!-- maybe have a link instead of loading the form? -->
                    <div id="register" class="tabcontent">
                        <?php include('components/register_form.php'); ?>
                    </div>
                
                </div>
            
            </div>

        </main>
        
        <?php
            include('components/footer.php');
        ?>

    </body>

</html>