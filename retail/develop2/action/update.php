<?php

$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$type = "";

if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
		
	if ( $type == 'ing' and isset($_GET['uid']) and isset($_GET['name']) and isset($_GET['desc']) ) {
		$uid = $_GET['uid'];
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		
		$result = $mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
		
	}
	
	if ( $type == 'prd' and isset($_GET['uid']) and isset($_GET['name']) and isset($_GET['desc']) and isset($_GET['price']) and isset($_GET['reference']) ) {
		
		$uid = $_GET['uid'];
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		$price = $_GET['price'];
		$reference = $_GET['reference'];
		
		$result = $mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc', price='$price', ingredients_uid='$reference' WHERE uid='$uid' ") or die($mysqli->error);
	}
}

header("Location: ../index.php?p=view&type=" . $type);

//
?>

