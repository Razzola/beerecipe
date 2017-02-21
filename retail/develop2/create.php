<?php

	$mysqli = new mysqli("localhost", "root", "", "beerecipe");
	$type = "";
	if ( isset($_GET['type']) ) {
		$type = $_GET['type'];
	}

?>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Creation form</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="action/create.php">

				<?php
					if ( $type == 'ing' ) {
					
						$uid = "null";
					
					?>
					
					<div class="form-group">
	                    <label>Name</label>
	                    <input name="name" class="form-control">
	                    <p class="help-block">Name</p>
	                </div>

	                <div class="form-group">
	                    <label>Description</label>
	                    <textarea name="desc" class="form-control" rows="3"></textarea>
	                    <p class="help-block">Description</p>
	                </div>
	                
					<?php
					}
				?>
				
				<?php
					if ( $type == 'prd' ) {
					?>
					
					<div class="form-group">
	                    <label>Name</label>
	                    <input name="name" class="form-control">
	                    <p class="help-block">Name</p>
	                </div>

	                <div class="form-group">
	                    <label>Description</label>
	                    <textarea name="desc" class="form-control" rows="3"></textarea>
	                </div>
					
					<div class="form-group">
	                    <label>Price</label>
	                    <input name="price" class="form-control">
	                    <p class="help-block">Name</p>
	                </div>
	                
	                <div class="form-group">
	                    <label>Ingredient</label>
	                    <select class="form-control" name="ingredient">
	                    	 <?php

							$result = $mysqli->query("SELECT * FROM `ingredients`");
							$row = $result->fetch_row();
							
                            while ( $row != null ) {
                            ?>
	                            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                            <?php
	                            $row = $result->fetch_row();
                            }
                            ?>
	                    </select>
	                </div>
	                
					<?php
					}
				?>
				
				<?php
					if ( $type == 'rec' ) {
					?>
						<div class="form-group">
		                    <label>Name</label>
		                    <input name="name" class="form-control">
		                </div>
	
		                <div class="form-group">
		                    <label>Description</label>
		                    <textarea name="desc" class="form-control" rows="3"></textarea>
		                </div>
					<div name= "rowIng">
		                <div class="form-group col-xs-6 col-sm-3 ">
		                    <label>Ingredient</label>
		                    <select class="form-control" name="ingredient" onchange="getProducts()">
		                    	 <?php
	
								$result = $mysqli->query("SELECT * FROM `ingredients`");
								$row = $result->fetch_row();
								
	                            while ( $row != null ) {
	                            ?>
		                            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
	                            <?php
		                            $row = $result->fetch_row();
	                            }
	                            ?>
		                    </select>
		                </div>
		                
		                <div class="form-group col-xs-6 col-sm-3 ">
		                    <label>Product</label>
		                    <select class="form-control" name="product" onchange="setPrice()">
		                    <option value="">Select value</option>
		                    	 <?php
	
								$result = $mysqli->query("SELECT uid,name,ingredients_uid,price FROM products");
								$row = $result->fetch_row();
								
	                            while ( $row != null ) {
	                            ?>
		                            <option value="<?php echo $row[0]; ?>|<?php echo $row[2]; ?>|<?php echo $row[3]; ?>"><?php echo $row[1]; ?></option>
	                            <?php
		                            $row = $result->fetch_row();
	                            }
	                            ?>
		                    </select>
		                </div>
		                
		                
						<div class="form-group col-xs-6 col-sm-3 ">
		                    <label>Quantity</label>
		                    <input name="quantity" class="form-control">
		                </div>
		                
		                
		                <div class="form-group col-xs-6 col-sm-3 ">
		                    <label>Price</label>
		                    <input  class="form-control" name="price">
		                    <p  class="help-block"></p>
		                </div>
		                
		                
	                	
                	</div>
                	<div name="otherIng"></div>
					<p>New ingredient: <a onclick="addRow(document.getElementsByName('rowIng')[0].innerHTML)"><span class="glyphicon glyphicon-plus"></span></a></p> 	                
					<?php
					}
				?>
                
                <input type="hidden" name="type" class="form-control" value="<?php echo $type; ?>">
                <button type="submit" class="btn btn-default"><?php echo $submit;?></button>
                <button type="reset" class="btn btn-default"><?php echo $reset;?></button>

            </form>
        </div>
    </div>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>
</div>