<?php
#turn error reporting on
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");
//echo "Loaded Host: " . $host;
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
//echo $conn_string;

//echo "<br>" . $username;
//echo "<br>" . $password;



try{
	$db = new PDO($conn_string, $username, $password);
	echo "<br>" . "Connected" . "<br>";
	
	//create table
	$query = "create table if not exists `ProjectAccounts`(
		`id` int auto_increment not null,
		`username` varchar(30) not null unique,
		`pin` int default 0,
		PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_general_ci";
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$stmt = $db->prepare($query);
	//print_r($stmt->errorInfo());
	$r = $stmt->execute();
	echo "<br>" . ($r>0?"Created table or already exists":"Failed to create table") . "<br>";
	unset($r);


	$insert_query = "INSERT INTO `ProjectAccounts`( `username`, `pin`) VALUES ('Zach', 0420)";
	$stmt = $db->prepare($insert_query);
}
//New
/*
	$newUser = "Rusty"
	$newPin = 0420
	$r = $stmt->execute(array(":username"=> $newUser, ":pin"=>$newPin));

	print_r($stmt->errorInfo());

	echo "<br>" . ($r>0?"Insert successful":"Insert failed") . "<br>";
	
	$select_query = "select * from `ProjectAccounts` where username = :username";
	$stmt = $db->prepare($select_query);
	$r = $stmt->execute(array(":username"=> "Rusty"));
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
	print_r($stmt->errorInfo());
	echo "<pre>" . var_export($results, true) . "</pre>";	

*/


catch(Exception $e){
	echo $e->getMessage();
	exit("Something went wrong");
}
?>

