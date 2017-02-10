<?php

$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$type = "";

if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
		
	if ( $type == 'ing' and isset($_GET['uid']) ) {
		
		$uid = $_GET['uid'];
		
		$result = $mysqli->query("DELETE FROM `ingredients` WHERE uid = '$uid'") or die($mysqli->error);
		
	}
	
	if ( $type == 'prd' and isset($_GET['uid']) ) {
		
		$uid = $_GET['uid'];
		
		$result = $mysqli->query("DELETE FROM `products` WHERE uid = '$uid'") or die($mysqli->error);
		
	}
}

header("Location: ../index.php?p=view&type=" . $type);

?>

