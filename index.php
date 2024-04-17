<?php
session_start();

?>

<!DOCTYPE html>
<html>

<nav>
    <?php
    include('navigation.php');
    ?>
</nav>

<head>
    <?php
    include('head.php');
    ?>
</head>

<body>


    <!-- <a href="logout.php">Logout</a> -->

    <img class="home-logo" src="pics/logo.png" alt="Recipe Radar" />

    <br>
    
    <?php 
    //  echo $user_data['user_name']; 
    ?> 
</body>

<footer>
    <?php
    include('footer.php');
    ?>
</footer>

</html>