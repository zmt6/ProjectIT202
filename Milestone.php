<?php
require('config.php');
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";

$db = new PDO($conn_string, $username, $password);

$stm = $db->query("select * from users");
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
