<?php
require('config.php');
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";

$db = new PDO($conn_string, $username, $password);

$stm = $db->query("select * from ProjectAccounts");
$result = $stm->fetch();
echo $result['username'];


if ($result['username'] == $_POST['usernameLog'] && $result['password'] == $_POST['passwordLog'] )
{
  echo "Access Granted";
}
else {
  echo "Access Denied";
}  
?>


<!DOCTYPE html>
<html>
<head>
</head>


<body>
<div style="margin-left: 50%; margin-right:50%;">
<form method="POST" action="#" onsubmit="return validate();">
<input name="name" type="text" placeholder="Enter your name"/>

<input name="email" type="email" placeholder="name@example.com"/>
<span id="validation.email" style="display:none;"></span>

<input type="password" name="password" placeholder="Enter password"/>
<input type="password" name="confirm" placeholder="Re-Enter password"/>
<span style="display:none;" id="validation.password"></span>

<input type="submit" value="Try it"/>
</form>
</div>

</body>
</html>
