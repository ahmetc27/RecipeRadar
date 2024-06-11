<?php
require '../config/db_connect.php';
session_start();

if (!isset($_SESSION['currentSession'])) {
    header("location: ../index.php");
    exit();
}

$relationFrom = $_POST['relationFrom'];
$relationTo = $_POST['relationTo'];

// Insert follow request into the relations table
$query = "INSERT INTO relations (relationFrom, relationTo, type) VALUES ($relationFrom, $relationTo, 'request')";
mysqli_query($conn, $query);

header("location: ../profile.php?userID=$relationTo");
?>
