<?php
require 'config/db_connect.php';

if (!isset($_SESSION['currentSession']) || !isset($_SESSION['currentSession']['userID'])) {
    header("location: ../index.php");
    exit();
}

$currentUserID = $_SESSION['currentSession']['userID'];

// Query to find users the current user is following with the type
$sqlFollowing = "
    SELECT 
        relationTo AS followingID, type
    FROM relations
    WHERE relationFrom = '$currentUserID'
";

$resultFollowing = $conn->query($sqlFollowing);

if (!$resultFollowing) {
    die("SQL Error: " . $conn->error);
}

$followings = [];
if ($resultFollowing->num_rows > 0) {
    while ($row = $resultFollowing->fetch_assoc()) {
        $followings[] = ['id' => $row['followingID'], 'type' => $row['type']];
    }
}

// Query to find users who are following the current user with the type
$sqlFollowers = "
    SELECT 
        relationFrom AS followerID, type
    FROM relations
    WHERE relationTo = '$currentUserID'
";

$resultFollowers = $conn->query($sqlFollowers);

if (!$resultFollowers) {
    die("SQL Error: " . $conn->error);
}

$followers = [];
if ($resultFollowers->num_rows > 0) {
    while ($row = $resultFollowers->fetch_assoc()) {
        $followers[] = ['id' => $row['followerID'], 'type' => $row['type']];
    }
}
?>
