<?php 
require 'config/db_connect.php';

session_start();

if (!isset($_SESSION['currentSession'])) {
    header("location: index.php");
    exit();
}

$viewedUserID = $_GET['userID'] ?? null;
$currentUserID = $_SESSION['currentSession']['userID']; 
$targetUserID = $viewedUserID; 

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
    <?php
        include('components/navigation.php');
    ?>
</header>

<main>
    <div class="row" style="margin-top: 110px;">
        <div class="container col-6-m col-12-sm" style="max-height: 1100px;">

            <?php if ($currentUserID == $viewedUserID): ?>
                <button id="editButton" onclick="toggleForms('edit')">Edit Info</button>
                <button id="cancelButton" style="display:none;" onclick="toggleForms('view')">Cancel</button>
                <form action="services/logout_service.php" method="post">
                    <button type="submit">Logout</button>
                </form>
            <?php else: ?>
                <form action="services/follow_request_service.php" method="post">
                    <input type="hidden" name="relationFrom" value="<?php echo $_SESSION['currentSession']['userID']; ?>">
                    <input type="hidden" name="relationTo" value="<?php echo $targetUserID; ?>"> 
                    <button type="submit">Send Follow Request</button>
                    <br><br>
                </form>

                <button onclick="approveRequest(<?php echo $viewedUserID; ?>, <?php echo $currentUserID; ?>)">Approve Request</button>
                <button onclick="refuseRequest(<?php echo $viewedUserID; ?>, <?php echo $currentUserID; ?>)">Refuse Request</button>
            <?php endif; ?>

            <div id="userForm">
                <?php include('components/user_form.php'); ?>
            </div>

            <div id="userEditForm" style="display:none;">
                <?php include('components/user_edit_form.php'); ?>
            </div>
        
        </div>

        <div class="container" style="text-align: center;">
            <section>
                <h2>Recipes</h2>
                <hr style="border-top: 0px;">
                <?php
                    include('services/discover_posts/user_profile_recipes.php');
                ?>
            </section>
        </div>
    </div>
</main>

<script>
    // Function to handle the approval of the request
    function approveRequest(viewedUserID, currentUserID) {
        var xhr = new XMLHttpRequest();
        var url = 'services/approve_request_service.php';
        var formData = new FormData();
        formData.append('viewedUserID', viewedUserID);
        formData.append('currentUserID', currentUserID);

        xhr.open('POST', url, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                window.location.href = 'profile.php?userID=' + viewedUserID;
            } else {
                console.error('Request failed. Status: ' + xhr.status);
            }
        };

        xhr.onerror = function () {
            console.error('Request failed. Check your network connection.');
        };

        xhr.send(formData);
    }
</script>

<?php
    include('components/footer.php');
?>

</body>
</html>
