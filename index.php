<?php
session_start();

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

        <main>

        <img class="home-logo" src="pics/logo.png" alt="Recipe Radar" />

        </main>
        
        <?php 
        //  echo $user_data['user_name']; ???
        ?> 

        <?php
            include('footer.php');
        ?>

    </body>

</html>