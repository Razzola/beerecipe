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
	if ( $type == 'prd' and isset($_GET['name'])  and isset($_GET['price']) and isset($_GET['ingredient']) ) {

		$name = $_GET['name'];
		$desc = $_GET['desc'];
		$price = $_GET['price'];
		$reference = $_GET['ingredient'];
		
		$result = $mysqli->query("INSERT INTO `products` ( uid, name, description, price, ingredients_uid ) VALUES ( null, '$name', '$desc', '$price', '$reference' ) ") or die($mysqli->error);
		
	}
	if ( $type == 'roc' and isset($_GET['name'])) {
		
		$name = $_GET['name'];
		$desc = $_GET['desc'];
	
		$result = $mysqli->query("INSERT INTO `recipe` ( uid, name, description ) VALUES ( null, '$name', '$desc' ) ") or die($mysqli->error);
	
		$url = $_SERVER['REQUEST_URI'];
		$params=split('&',$url);
		foreach ($params as &$param) {
				$elements=split("=",$param);
				$product="";
				$quantity="";
					$field = $elements[0];
					if (strpos($field, "product") !== false){
						$productMid = explode("|",$elements[1]);
						$product=$productMid[1];
					}
					if (strpos($field, "quantity") !== false){
						$quantity = $elements[1];
					}
						echo $product;
						echo $quantity;
					if ($product!=""){
						$query = "INSERT INTO `recipe_has_products` ( recipe_uid, products_uid, quantity ) VALUES (test,".$product.",".$quantity.")";
						echo $query;
					}
		}
	}
}

//header("Location: ../index.php?p=view&type=" . $type);

//$result = $mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
?>

