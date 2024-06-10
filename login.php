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

    </head>

    <body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

        <header>

            <?php
                include('components/navigation.php');
            ?>
                    
        </header>

        <main>

            <div class="container">
            
                <?php
                    include('components/login_form.php');
                ?>
            
            </div>

        </main>
        
        <?php
            include('components/footer.php');
        ?>

    </body>

</html>