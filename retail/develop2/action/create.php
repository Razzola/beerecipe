<?php

$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$type = "";

if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
		
	if ( $type == 'ing' and isset($_GET['name']) and isset($_GET['desc']) ) {
		
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		
		$result = $mysqli->query("INSERT INTO `ingredients` ( uid, name, description ) VALUES ( null, '$name', '$desc' ) ") or die($mysqli->error);
		
	}
}

header("Location: ../index.php");

//$result = $mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
?>

