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

// Check if current user is friends with viewed user and get the relation type and roles
$sql = "SELECT type, relationFrom, relationTo FROM relations WHERE (relationFrom = ? AND relationTo = ?) OR (relationFrom = ? AND relationTo = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $currentUserID, $viewedUserID, $viewedUserID, $currentUserID);
$stmt->execute();
$result = $stmt->get_result();

$relationType = null;
$relationFrom = null;
$relationTo = null;
if ($row = $result->fetch_assoc()) {
    $relationType = $row['type'];
    $relationFrom = $row['relationFrom'];
    $relationTo = $row['relationTo'];
}

$isFriends = $relationType === 'friend';
$isRequestToCurrentUser = $relationType === 'request' && $relationFrom == $viewedUserID && $relationTo == $currentUserID;
$isRequest = $relationType === 'request';
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

<style>
    .action-button {
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    margin-right: 10px;
    margin-bottom: 10px;
}

.approve-button {
    background-color: #4CAF50; /* Green */
}

.refuse-button {
    background-color: #f44336; /* Red */
}

.remove-button {
    background-color: #f44336; /* Red */
}

.logout {
    background-color: #4682B4 ;
}
 
.send {
    background-color: #4682B4 ;
}

.button-container {
    text-align: center; /* Center the buttons */
    margin-bottom: 20px; /* Optional: Adjust margin as needed */
}
</style>

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
                <div class="button-container">
                    <button id="editButton" class="action-button" onclick="toggleForms('edit')">Edit Info</button>
                    <button id="cancelButton" class="action-button" style="display:none;" onclick="toggleForms('view')">Cancel</button>
                    <form action="services/logout_service.php" method="post">
                        <button type="submit" class="action-button logout">Logout</button>
                    </form>
                </div>
            <?php elseif (!$isFriends && !$isRequest): ?>
                <form action="services/follow_request_service.php" method="post">
                    <input type="hidden" name="relationFrom" value="<?php echo $_SESSION['currentSession']['userID']; ?>">
                    <input type="hidden" name="relationTo" value="<?php echo $targetUserID; ?>"> 
                    <button type="submit" class="action-button send">Send Follow Request</button>
                    <br><br>
                </form>
            <?php elseif ($isRequestToCurrentUser): ?>
                <div class="button-container">
                    <button onclick="approveRequest(<?php echo $viewedUserID; ?>, <?php echo $currentUserID; ?>)" class="action-button approve-button">Approve Request</button>
                    <button onclick="refuseRequest(<?php echo $viewedUserID; ?>, <?php echo $currentUserID; ?>)" class="action-button refuse-button">Refuse Request</button>
                </div>
            <?php elseif ($isFriends): ?>
                <button onclick="removeFriend(<?php echo $viewedUserID; ?>, <?php echo $currentUserID; ?>)" class="action-button remove-button">Remove Friend</button>
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
                <?php include('services/discover_posts/user_profile_recipes.php'); ?>
            </section>
        </div>
    </div>
</main>

<script>
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
    function removeFriend(viewedUserID, currentUserID) {
        if (confirm('Are you sure you want to remove this user as a friend?')) {
            var xhr = new XMLHttpRequest();
            var url = 'services/remove_friend_service.php';
            var formData = new FormData();
            formData.append('viewedUserID', viewedUserID);
            formData.append('currentUserID', currentUserID);
            xhr.open('POST', url, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert('Friend removed successfully.');
                    window.location.reload();
                } else {
                    console.error('Request failed. Status: ' + xhr.status);
                }
            };
            xhr.onerror = function () {
                console.error('Request failed. Check your network connection.');
            };
            xhr.send(formData);
        }
    }
</script>

<?php
    include('components/footer.php');
?>

</body>
</html>
