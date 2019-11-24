<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST["username"]) && isset($_POST["password1"]) && isset($_POST["password2"])){
	$name = $_POST["username"];
        $p1 = $_POST["password1"];
        $p2 = $_POST["password2"];
	try {
		require('config.php');
		$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
		$db = new PDO($conn_string, $username, $password);
		$select_query = "select * from `ProjectAccounts` where Username = :username LIMIT 1";
        	$stmt = $db->prepare($select_query);
        	$r = $stmt->execute(array(":username"=>$name));
        	$results = $stmt->fetch(PDO::FETCH_ASSOC);
		      if($results && count($results) > 0) {
		      	if(password_verify($p1, $results["Password"])) {
           		echo "Welcome, " . $results["Username"] . " how kennel we help you today?";
		       		$name = array("Username"=> $results["Username"]);
				      $_SESSION["user"] = $name;
				      header("Location: Homepage.php");		
			}
			else {
				echo "The username or password is invalid or non-existant";
			}
		}
                else {
                	echo "The username or password is invalid or non-existant";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
}
?>
<html>
<head>
<style>
body{background-color: Black;}
section{ width:80%; margin-left: auto; margin-right:auto; background-color:black; padding: 2%;margin-top: 2%;}
form{ width:50%; margin-left: auto; margin-right:auto; padding: 2%;margin-top: 2%;}
</style>
</head>
<body>
<header>
        <section>
		<h1 align="center">Login Page</h1>
		Need an account?
		<nav>
			<a href="registeration.php">Register here</a>
		</nav>
	</section>
</header>
<section>
        <h2 align="center">Input your account information here:</h2><br>

        <form method="POST">
                Username: <input name="username" type="text" placeholder="Enter your username"/><br>
                Password: <input name="password1" type="password" placeholder="Enter your password"/><br>
                Confirm Password: <input name="password2" type="password" placeholder="Re-enter your password"/><br>
                <input type="submit" value="Login"/>
        </form>

</section>
</body>
</html>
