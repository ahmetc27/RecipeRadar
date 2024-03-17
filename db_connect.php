<?php

$username = "root";
$hostname = "localhost";
$password = "";
$dbname = "md_hotel";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>