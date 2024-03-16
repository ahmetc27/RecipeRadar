<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_rr_db";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
	die("failed to connect!");
}