<?php

session_start();

if(isset($_SESSION['currentSession']))
{
	unset($_SESSION['currentSession']);
}

header("Location: ../index.php");
die;

?>
