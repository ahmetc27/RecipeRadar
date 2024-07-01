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
    WHERE relationFrom = ? OR (relationFrom = ? AND relationTo = ?)
";

$stmtFollowing = $conn->prepare($sqlFollowing);
$stmtFollowing->bind_param("iii", $currentUserID, $currentUserID, $currentUserID);
$stmtFollowing->execute();
$resultFollowing = $stmtFollowing->get_result();

if (!$resultFollowing) {
    die("SQL Error: " . $stmtFollowing->error);
}

$followings = [];
while ($row = $resultFollowing->fetch_assoc()) {
    $followings[] = ['id' => $row['followingID'], 'type' => $row['type']];
}

$stmtFollowing->close();

// Query to find users who are following the current user with the type
$sqlFollowers = "
    SELECT 
        relationFrom AS followerID, type
    FROM relations
    WHERE relationTo = ? OR (relationTo = ? AND relationFrom = ?)
";

$stmtFollowers = $conn->prepare($sqlFollowers);
$stmtFollowers->bind_param("iii", $currentUserID, $currentUserID, $currentUserID);
$stmtFollowers->execute();
$resultFollowers = $stmtFollowers->get_result();

if (!$resultFollowers) {
    die("SQL Error: " . $stmtFollowers->error);
}

$followers = [];
while ($row = $resultFollowers->fetch_assoc()) {
    $followers[] = ['id' => $row['followerID'], 'type' => $row['type']];
}

$stmtFollowers->close();

// Now you have $followings and $followers arrays containing IDs and types of relationships
// Use these arrays as needed in your application
?>
