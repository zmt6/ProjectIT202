<?php
#turn error reporting on
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('config.php');
echo "Loaded Host: " . $host;
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
try{
    	$db = new PDO($conn_string, $username, $password);
        echo "<br>Connected</br>";
        //create table
        $query = "create table if not exists `ProjectAccounts`(
                `Id` int auto_increment not null,
                `Username` varchar(30) not null unique,
                `Password` varchar(60) default 0,
                `Points` int not null default 0,
		            `Keys` int not null default 0,
		             PRIMARY KEY (`Id`)
                ) CHARACTER SET utf8 COLLATE utf8_general_ci";
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $stmt = $db->prepare($query);
        print_r($stmt->errorInfo());
        $r = $stmt->execute();
        echo "<br>" . ($r>0?"Created table or already exists":"Failed to create table") . "<br>";
        unset($r);
        
        
        $insert_query = "INSERT INTO `ProjectAccounts`(`Username`, `Password`, `Points`, `Keys`)
                VALUES (:username,:password,:points,:keys)";
        $stmt = $db->prepare($insert_query);
        $newUser = "Test";
        $newPassword = 1234;
	$points = 0;
	$keys = 0;
        $r = $stmt->execute(array(":username"=>$newUser,":password"=>$newPassword, ":points"=>$points, ":keys"=>$keys));
	
        print_r($stmt->errorInfo());
       
        echo "<br>" . ($r>0?"Insert successful":"Insert failed") . "<br>";

        $select_query = "select * from `Accounts` where Username = :username";
        $stmt = $db->prepare($select_query);
        $r = $stmt->execute(array(":username"=> "Test"));
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        //print_r($stmt->errorInfo());
        echo "<pre>" . var_export($results, true) . "</pre>";
}
catch(Exception $e){
        echo $e->getMessage();
        exit("Something went wrong");
}
?>
