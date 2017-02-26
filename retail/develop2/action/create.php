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
	
		//$result = $mysqli->query("INSERT INTO `recipe` ( uid, name, description ) VALUES ( null, '$name', '$desc' ) ") or die($mysqli->error);
	
		$url = $_SERVER['REQUEST_URI'];
		$params=explode('&',$url);
		$max= $mysqli->query("SELECT MAX(uid) FROM recipe");
		$recipeUid = $max->fetch_row();
		foreach ($params as &$param) {
				$elements=explode("=",$param);
					$field = $elements[0];
					if (strpos($field, "ingredient") !== false){
						$ingredient[2];
					}
					if (strpos($field, "product") !== false){
						$productMid = explode("|",$elements[1]);
						$ingredient[0]=$productMid[1];
					}
					if (strpos($field, "quantity") !== false){
						$ingredient[1] = $elements[1];
						//$query = $mysqli->query("INSERT INTO `recipe_has_products` ( recipe_uid, products_uid, quantity ) VALUES (".$recipeUid[0].",".$ingredient[0].",".$ingredient[1].")");
						echo "INSERT INTO `recipe_has_products` ( recipe_uid, products_uid, quantity ) VALUES (".$recipeUid[0].",".$ingredient[0].",".$ingredient[1].")";
					}
		}
	}
}

//header("Location: ../index.php?p=view&type=" . $type);

//$result = $mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
?>

