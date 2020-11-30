<?php

$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$type = "";

if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
	
	if ( $type == 'cat' and isset($_GET['uid']) and isset($_GET['name']) and isset($_GET['desc']) ) {
		$uid = $_GET['uid'];
		$name = mysqli_real_escape_string($mysqli,$_GET['name']);
		$desc = $_GET['desc'];
	
		$result = $mysqli->query("UPDATE `category` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
	
	}
	
	
	if ( $type == 'rec' and isset($_GET['uid']) and isset($_GET['name']) ) {
		$uid = $_GET['uid'];
		$name = mysqli_real_escape_string($mysqli,$_GET['name']);
		$desc = $_GET['desc'];
		$ibu = $_GET['ibu'];
		$alcool= $_GET['alcool'];
		$category=$_GET['category'];
	
	
		$url = $_SERVER['REQUEST_URI'];
		$params=explode('&',$url);
		$amount=0;
		foreach ($params as &$param) {
			$elements=explode("=",$param);
			$field = $elements[0];
			if (strpos($field, "product") !== false){
				$product[2]=null;
				$product[0]=$elements[1];
                //gestisco eventuali aggiunte di prodotto
                if (strpos($product[0], "|") !== false){
                    $productMid = explode("|",$product[0]);
                }else{
                    $productMid = explode("%7C",$product[0]);
                }
                $product[0]=$productMid[0];
                ////
			}
			if (strpos($field, "quantity") !== false){
				$product[1] = $elements[1];
				//get price
				if ($product[0]!=''){
                    $prdQuery=$mysqli->query("SELECT price FROM products WHERE uid=".$product[0]);
                    $product[2] = $prdQuery->fetch_row();


                //se l'ingrediente in quella ricetta non c'è, crealo
                $detectProductInRecipe=$mysqli->query("SELECT COUNT(*) FROM recipe_has_products WHERE recipe_uid=".$uid." AND products_uid=".$product[0]);
                $foundPrd = $detectProductInRecipe->fetch_row();
                if ($foundPrd[0]==0){
						$insert="INSERT INTO `recipe_has_products` ( recipe_uid, products_uid, quantity ) VALUES (".$uid.",".$product[0].",".$product[1].");";
						//echo $insert."<br/>";
						$query = $mysqli->query($insert)or die($mysqli->error);
                }
                //

				$amount=$amount+($product[1]*$product[2][0]/1000);
				//echo $amount."<br/>";
				$update="UPDATE `recipe_has_products` SET quantity=".$product[1]." WHERE recipe_uid=".$uid." AND products_uid=".$product[0];
				$query = $mysqli->query($update)or die($mysqli->error);
			    }
			}
				
		}
		
		//if developed in order to not overwrite ibu value by save button
		if ($ibu!="")
			$ibufilter=", ibu='$ibu'";
		else
			$ibufilter='';
		/////////////////
		//if developed in order to not overwrite alcool value by save button
        if ($alcool!="")
            $alcoolfilter=", alcool='$alcool'";
        else
            $alcoolfilter='';
        /////////////////
		$desc=mysqli_real_escape_string($mysqli, $desc);
		$stringQry="UPDATE `recipe` SET amount='$amount',category='$category',name='$name', description='$desc'".$ibufilter." ".$alcoolfilter." WHERE uid='$uid' ";
		$result = $mysqli->query($stringQry) or die($mysqli->error);
		//echo $stringQry;
	}

	
	if ( $type == 'ing' and isset($_GET['uid']) and isset($_GET['name']) and isset($_GET['desc']) ) {
		$uid = $_GET['uid'];
		$name = mysqli_real_escape_string($mysqli,$_GET['name']);
		$desc = $_GET['desc'];

		$result = $mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
		
	}
	
	if ( $type == 'prd' and isset($_GET['uid']) and isset($_GET['name']) and isset($_GET['desc']) and isset($_GET['price']) and isset($_GET['ingredient']) ) {

		$uid = $_GET['uid'];
		$name = mysqli_real_escape_string($mysqli,$_GET['name']);
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
        include "../utils/hopManager.php";
	}
	
	if ( $type == 'wh' and isset($_GET['uid'])  and isset($_GET['quantity'])) {

		$uid = $_GET['uid'];
		$quantit = $_GET['quantity'];
		$position = $_GET['position'];
	
		$result = $mysqli->query("UPDATE `products` SET quantity='$quantit', position='$position' WHERE uid='$uid' ") or die($mysqli->error);
	}
}
if ( $type == 'rec' and isset($_GET['uid'])) {
	header("Location: ../index.php?p=update&type=" . $type."&uid=".$uid."");
}
else {
	header("Location: ../index.php?p=view&type=" . $type);
}
//
?>

