<?php 

require 'config/db_connect.php';

session_start();

if (!isset($_SESSION['currentSession'])) {
    header("location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <?php
        include('components/head.php');
    ?>

    <!-- check if this is still needed? -->
    <link rel="stylesheet" type="text/css" href="resources/css/tabs_style.css">

    <!-- include the js file -->
    <script src="resources/js/user_script.js"></script> 
    <script src="resources/js/main.js"></script> 

</head>

<body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

<header>

    <!-- maybe don't have navigation on index? or have even more limited choices? -->
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
    <div class="row">

        <div class="container col-6-m col-12-sm">


            <!-- need to deal with cached information in order to show new info immediately after saving
            new info -->
            <button id="editButton" onclick="toggleForms('edit')">Edit Info</button>
            <button id="cancelButton" style="display:none;" onclick="toggleForms('view')">Cancel</button>
            
            <form action="services/logout_service.php" method="post">
                <button type="submit">Logout</button>
            </form>

            <div id="userForm">
                <?php include('components/user_form.php'); ?>
            </div>

            <div id="userEditForm" style="display:none;">
                <?php include('components/user_edit_form.php'); ?>
            </div>

            
        
        </div>
    
    </div>

</main>

<?php
    include('components/footer.php');
?>

</body>

</html>