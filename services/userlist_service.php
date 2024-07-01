<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
require 'config/db_connect.php';


// Fetch current session user
$sql = "SELECT * FROM users WHERE userID = {$_SESSION['currentSession']['userID']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Fetch non-admin users
$users = "SELECT * FROM users WHERE Type != 'admin'";
$usersResult = mysqli_query($conn, $users);

$layout = "";

if (mysqli_num_rows($usersResult) == 0) {
    $layout .= "No Users found!";
} else {
    while ($user = mysqli_fetch_assoc($usersResult)) {
        $layout .= "<div class='card' style='width: 18rem'>
        <div class='card-body'>
          <h5 class='card-title'>{$user["firstName"]} {$user["middleName"]} {$user["lastName"]}</h5>
          <hr>
          <p class='card-text'>Username: {$user["userName"]}</p>
          <a href='userdetails.php?id={$user["userID"]}' class='btn btn-success' >Details</a>
        </div>
      </div>";
    }
}
?>