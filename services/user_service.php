<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
require 'config/db_connect.php';

// Initialize variables
$user = [];

// Check if user ID is provided in the URL
if(isset($_GET['userID'])) {
    // Fetch user data based on the provided user ID
    $userID = $_GET['userID'];
    $sql = "SELECT * FROM users WHERE userID = $userID";
} else {
    // Check if user is logged in
    if (isset($_SESSION['currentSession'])) {
        // Fetch user data from session
        $userData = $_SESSION['currentSession'];

        // Fetch existing user data from database
        $userID = $userData['userID'];
        $sql = "SELECT * FROM users WHERE userID = $userID";
    } else {
        // Redirect to login page if user is not logged in
        header("Location: login.php");
        exit();
    }
}

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>
