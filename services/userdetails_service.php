<?php
session_start();

if (!isset($_SESSION["currentSession"])) {
    header("Location: login.php");
    exit();
}

require "config/db_connect.php";

$sql = "SELECT * FROM users WHERE userID = {$_SESSION['currentSession']['userID']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$user = null;
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $getUser = "SELECT * FROM users WHERE userID = $id";
    $userResult = mysqli_query($conn, $getUser);
    $user = mysqli_fetch_assoc($userResult);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userType"])) {
    $newUserType = $_POST["userType"];
    if ($newUserType !== $user['type']) {
        $updateUserTypeSql = "UPDATE users SET type = '$newUserType' WHERE userID = $id";
        if (mysqli_query($conn, $updateUserTypeSql)) {
            $user['type'] = $newUserType;
            echo "User type updated successfully.";
        } else {
            echo "Error updating user type: " . mysqli_error($conn);
        }
    }
}
?>