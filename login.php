<?php

session_start();

if (isset($_SESSION["currentSession"])) {
    header("Location: home.php");
}

?>

<!DOCTYPE html>
<html>

    <head>

        <?php
            include('components/head.php');
        ?>

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

            <!-- later will need a "row" so that the admin feed is next to the login/register form -->
            <div class ="row" style="margin-top: 90px;">
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