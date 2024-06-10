<?php

include('config/db_connect.php'); // Include the database connection file

$sql = "SELECT * FROM users WHERE userID = {$_SESSION['currentSession']['userID']}";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$users = "SELECT * FROM users WHERE userTyp != 'admin'";
$usersResult = mysqli_query($conn, $users);

$layout = "";

if (mysqli_num_rows($usersResult) == 0) {
    $layout .= "No Users found!";
} else {
    while ($user = mysqli_fetch_assoc($usersResult)) {
        $layout .= "<div class='card' style='width: 18rem'>
        <div class='card-body'>
          <h5 class='card-title'>{$user["firstName"]} {$user["lastName"]}</h5>
          <hr>

          <p class='card-text'>Username: {$user["userName"]}</p>
          <a href='userdetails.php?id={$user["userID"]}' class='btn btn-success' >Details</a>
        </div>
      </div>";
    }
}


?>
