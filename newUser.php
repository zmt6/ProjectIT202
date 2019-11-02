<?php
	$newUser = "Rusty"
	$newPin = 0420
	$r = $stmt->execute(array(":username"=> $newUser, ":pin"=>$newPin));

	print_r($stmt->errorInfo());

	echo "<br>" . ($r>0?"Insert successful":"Insert failed") . "<br>";
	
	$select_query = "select * from `Tes` where username = :username";
	$stmt = $db->prepare($select_query);
	$r = $stmt->execute(array(":username"=> "Billy"));
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
	//print_r($stmt->errorInfo());
	echo "<pre>" . var_export($results, true) . "</pre>";	


?>
