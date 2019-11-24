<?php
session_start();
ini_set('display_error',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
?>

<html>
<head>
</head>
<style>
body{background-color: black;}
</style>
<body onload="queryParam();">
        <header>
                <nav>
                     	<a href="?page=home">Home</a> |
                	    <a href="logout.php">Logout</a> |
		</nav>
        </header>
        <div id="home">
		<article>
                	<h1> Welcome,  <?php echo $_SESSION["user"]["Username"];?>! </h1>
		</article>
	</div>
	
</body>
</html>
