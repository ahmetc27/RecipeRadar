<?php

$username = "root";
$hostname = "localhost";
$password = "";
$dbname = "reciperadar_db";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Connection Error: " . $conn->connect_error;
    exit();
}

?>