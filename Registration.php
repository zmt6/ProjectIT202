<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST["username"]) && isset($_POST["password1"]) && isset($_POST["password2"])){
	$name = $_POST["username"];
        $p1 = $_POST["password1"];
        $p2 = $_POST["password2"];
	try{    
  
  
		if($p1 == $p2){
			require('config.php');
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);
			$hash = password_hash($p1, PASSWORD_BCRYPT);
			$insert_query = "INSERT into `ProjectAccounts`(`Username`, `Password`) VALUES(:username, :password)";
                        $stmt = $db->prepare($insert_query);
			$result = $stmt->execute(array(":username"=>$name,":password"=>$hash));
			if(!$stmt->errorInfo()) {
				print_r($stmt->errorInfo());
                        }
			else {
				echo "Account Created";
			}
		}
                else{
                	echo "Passwords Don't Match";                                        
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
section{ width:80%; margin-left: auto; margin-right:auto; background-color:Black; padding: 2%;margin-top: 2%;}
form{ width:50%; margin-left: auto; margin-right:auto; padding: 2%;margin-top: 2%;}
</style>
</head>
<body>
<header>
        <section>
		<h1 align="center">Registration Page</h1>
		Already have an account?
		<nav> 
			<a href="login.php">Login</a> 
		</nav>
		
	</section>
</header>
<section>
        <h2 align="center">Create your account below:</h2><br>

        <form method="POST">
                Username: <input name="username" type="text" placeholder="Enter your username"/><br>
                Password: <input name="password1" type="password" placeholder="Enter your password"/><br>
                Confirm Password: <input name="password2" type="password" placeholder="Re-enter your password"/><br>
                <input type="submit" value="Register"/>
        </form>

</section>
</body>
</html>
