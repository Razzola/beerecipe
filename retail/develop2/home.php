<?php

	$mysqli = new mysqli("localhost", "root", "", "beerecipe");

	if ( isset($_POST["name"]) and isset($_POST["desc"]) ) {
		$name = $_POST["name"];
		$desc = $_POST["desc"];
		$uid = $_POST["uid"];
		// TODO Check uid, determinate if it's update action or not
		
		if ( $uid != "null" ) {
			$mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid=$uid");
		} else {
			$mysqli->query("INSERT INTO `ingredients` ( uid, name, description ) VALUES ( $uid, '$name', '$desc' )");
		}
		unset($_POST["uid"]);
		unset($_POST["name"]);
		unset($_POST["desc"]);
	}

	$result = $mysqli->query("SELECT COUNT(*) FROM `category`");
	$row = $result->fetch_row();
	$categoryTotal = $row[0];

	$result = $mysqli->query("SELECT COUNT(*) FROM `ingredients`");
	$row = $result->fetch_row();
	$ingredientsTotal = $row[0];
	
	$result = $mysqli->query("SELECT COUNT(*) FROM `products`");
	$row = $result->fetch_row();
	$productsTotal = $row[0];
	
	$result = $mysqli->query("SELECT COUNT(*) FROM `recipe`");
	$row = $result->fetch_row();
	$recipesTotal = $row[0];
?>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-folder fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $categoryTotal; ?></div>
                        <div>Category</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-leaf fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $ingredientsTotal; ?></div>
                        <div>Ingredients</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $productsTotal; ?></div>
                        <div>Products</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $recipesTotal; ?></div>
                        <div>Recipes</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-database fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $productsTotal + $recipesTotal + $ingredientsTotal + $categoryTotal; ?></div>
                        <div>Total</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Admin</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
