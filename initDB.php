<?php

ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");

$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";

try{
	$db = new PDO($conn_string, $username, $password);
	echo "<br>" . "Connected" . "<br>";
	
}
catch(Exception $e){
	echo $e->getMessage();
	exit("Something went wrong");
}
?>

