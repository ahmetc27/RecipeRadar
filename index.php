<?php
session_start();

include("connection.php");
include("functions.php");

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css/style.css">
	<title>My website</title>
</head>

<body>

	<a href="logout.php">Logout</a>
	<h1>This is the index page</h1>
	<img src="pics/InProgress.jpg" alt="Image not found">

	<br>
	Hello, <?php echo $user_data['user_name']; ?>
</body>

</html>