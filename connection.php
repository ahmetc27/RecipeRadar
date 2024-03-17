<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "RecipeRadar_db";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
	die("failed to connect!");
}