<?php

$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$type = "";

if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
		
	if ( $type == 'ing' and isset($_GET['uid']) ) {
		
		$uid = $_GET['uid'];
			
		//clean relation product, recipe
		$result = $mysqli->query("SELECT uid FROM `products` WHERE ingredients_uid = '$uid'") or die($mysqli->error);
	
		while ($result != null ) {
			$product_id = $result->fetch_row();
			$result = $mysqli->query("DELETE FROM `recipe_has_products` WHERE uid = '$product_id[0]'");
			updateRecipes($product_id[0]);
		}
		
		//clean products
		$result = $mysqli->query("DELETE FROM `products` WHERE ingredients_uid = '$uid'") or die($mysqli->error);
		
		//clean ingredients
		$result = $mysqli->query("DELETE FROM `ingredients` WHERE uid = '$uid'") or die($mysqli->error);
		
	}
	
	if ( $type == 'prd' and isset($_GET['uid']) ) {
	
		$uid = $_GET['uid'];
	
		$result = $mysqli->query("DELETE FROM `recipe_has_products` WHERE products_uid = '$uid'") or die($mysqli->error);
		$result = $mysqli->query("DELETE FROM `products` WHERE uid = '$uid'") or die($mysqli->error);
		updateRecipes($uid);
		
	}
	
	if ( $type == 'rec' and isset($_GET['uid']) ) {
	
		$uid = $_GET['uid'];
	
		$result = $mysqli->query("DELETE FROM `recipe_has_products` WHERE recipe_uid = '$uid'") or die($mysqli->error);
		$result = $mysqli->query("DELETE FROM `recièe` WHERE uid = '$uid'") or die($mysqli->error);
	}
	
}

function updateRecipes($product_id) {
	$mysqli = new mysqli("localhost", "root", "", "beerecipe");
	
	$recipes = $mysqli->query("SELECT b.uid
									FROM recipe_has_products a
									JOIN recipe b ON a.recipe_uid=b.uid
									JOIN products c ON a.products_uid=c.uid
									WHERE a.products_uid=".$product_id) or die($mysqli->error);
	$recipe = $recipes->fetch_row();
	
	while ($recipes != null ) {
		echo "SELECT b.uid, SUM(a.quantity*c.price) AS newamount
							FROM recipe_has_products a
							JOIN recipe b ON a.recipe_uid=b.uid
							JOIN products c ON a.products_uid=c.uid
							WHERE b.uid=".$recipe[0];
		/*$updateRecipeAmount=$mysqli->query("SELECT b.uid, SUM(a.quantity*c.price) AS newamount
							FROM recipe_has_products a
							JOIN recipe b ON a.recipe_uid=b.uid
							JOIN products c ON a.products_uid=c.uid
							WHERE b.uid=".$recipe[0]) or die($mysqli->error);*/
	
		$newAmount = $updateRecipeAmount->fetch_row();
		$recipe = $recipes->fetch_row();
		$updateRecipe=$mysqli->query("UPDATE `recipe` SET amount=".$newAmount[1]." WHERE uid=".$newAmount[0]) or die($mysqli->error);
	}
}



//header("Location: ../index.php?p=view&type=" . $type);

?>

