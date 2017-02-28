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
	
	if ( $type == 'prd' and isset($_GET['uid']) and isset($_GET['name']) and isset($_GET['desc']) and isset($_GET['price']) and isset($_GET['ingredient']) ) {
		
		$uid = $_GET['uid'];
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		$price = $_GET['price'];
		$ingredient = $_GET['ingredient'];
		
		$result = $mysqli->query("UPDATE `products` SET name='$name', description='$desc', price='$price', ingredients_uid='$ingredient' WHERE uid='$uid' ") or die($mysqli->error);
		$recipes = $mysqli->query("SELECT b.uid
									FROM recipe_has_products a
									JOIN recipe b ON a.recipe_uid=b.uid
									JOIN products c ON a.products_uid=c.uid
									WHERE a.products_uid=".$uid) or die($mysqli->error);
		$recipe = $recipes->fetch_row();
		
		while ($recipe != null ) {
			$updateRecipeAmount=$mysqli->query("SELECT b.uid, SUM(a.quantity*c.price) AS newamount
							FROM recipe_has_products a
							JOIN recipe b ON a.recipe_uid=b.uid
							JOIN products c ON a.products_uid=c.uid
							WHERE b.uid=".$recipe[0]) or die($mysqli->error);
			
			$newAmount = $updateRecipeAmount->fetch_row();
			$recipe = $recipes->fetch_row();
			$updateRecipe=$mysqli->query("UPDATE `recipe` SET amount=".$newAmount[1]." WHERE uid=".$newAmount[0]) or die($mysqli->error);
		}
	}
}

header("Location: ../index.php?p=view&type=" . $type);

//
?>

