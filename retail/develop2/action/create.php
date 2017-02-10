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
	
	if ( $type == 'prd' and isset($_GET['name']) and isset($_GET['desc']) and isset($_GET['price']) and isset($_GET['reference']) ) {
		
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		$price = $_GET['price'];
		$reference = $_GET['reference'];
		
		$result = $mysqli->query("INSERT INTO `products` ( uid, name, description, price, ingredients_uid ) VALUES ( null, '$name', '$desc', '$price', '$reference' ) ") or die($mysqli->error);
		
	}
}

header("Location: ../index.php?p=view&type=" . $type);

//$result = $mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
?>

