<?php 

require 'config/db_connect.php';

session_start();

if (!isset($_SESSION['currentSession'])) {
    header("location: index.php");
    exit();
}

$viewedUserID = $_GET['userID'] ?? null; // Use null coalescing operator to handle undefined index
$currentUserID = $_SESSION['currentSession']['userID']; // Define currentUserID
$targetUserID = $viewedUserID; // Assuming viewedUserID is the target for follow requests

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
    <script src="resources/js/approve_request_script.js"></script>
    <script src="resources/js/refuse_request_script.js"></script>

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
    <div class="row" style="margin-top: 90px;">

        <div class="container col-6-m col-12-sm">

            <!-- need to deal with cached information in order to show new info immediately after saving
            new info -->
            <button id="editButton" onclick="toggleForms('edit')">Edit Info</button>
            <button id="cancelButton" style="display:none;" onclick="toggleForms('view')">Cancel</button>
            

            <!-- I think that it should be possible to write a single javascript script that can handle
            all buttons. that would make it easier to change text when neccessary (ie. from "send request"
            to "refuse request"). This could probably be done by adding another value that is passed with 
            currentUserID and viewingUserID (ie. 1 for send follow request, 2 accept, 3 refuse-->


            <form action="services/follow_request_service.php" method="post">
                <input type="hidden" name="relationFrom" value="<?php echo $_SESSION['currentSession']['userID']; ?>">
                <input type="hidden" name="relationTo" value="<?php echo $targetUserID; ?>"> 
                <button type="submit">Send Follow Request</button>
                <br><br>
            </form>

            <!-- Approve Request Button -->
            <button onclick="approveRequest(<?php echo $viewedUserID; ?>, <?php echo $currentUserID; ?>)">Approve Request</button>

            <!-- currently "refuse request button" also removes the "friend" -->

            <!-- Refuse Request Button -->
            <button onclick="refuseRequest(<?php echo $viewedUserID; ?>, <?php echo $currentUserID; ?>)">Refuse Request</button>

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

<script>
    // Function to handle the approval of the request
function approveRequest(viewedUserID, currentUserID) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Define the request URL
    var url = 'services/approve_request_service.php';

    // Create a FormData object to send data
    var formData = new FormData();
    formData.append('viewedUserID', viewedUserID);
    formData.append('currentUserID', currentUserID);

    // Open a POST request
    xhr.open('POST', url, true);

    // Set up the onload function to handle the response
    xhr.onload = function () {
        // Check if the request was successful (status code 200)
        if (xhr.status === 200) {
            // Redirect to the profile page of the viewed user
            window.location.href = 'profile.php?userID=' + viewedUserID;
        } else {
            // Display an error message
            console.error('Request failed. Status: ' + xhr.status);
        }
    };

    // Set up the onerror function to handle errors
    xhr.onerror = function () {
        console.error('Request failed. Check your network connection.');
    };

    // Send the request with the FormData
    xhr.send(formData);
}
</script>

<?php
    include('components/footer.php');
?>

</body>

</html>