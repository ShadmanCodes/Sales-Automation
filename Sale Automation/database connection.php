<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "sales_automation";

$conn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);

if(!$conn){
	die("Database connection failed!!");
}							

?>
