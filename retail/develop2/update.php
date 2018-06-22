<?php

	$mysqli = new mysqli("localhost", "root", "", "beerecipe");
	$type = "";
	if ( isset($_GET['type']) ) {
		$type = $_GET['type'];
	}

	if ( isset($_GET['uid']) ) {
		$uid = $_GET['uid'];
	}
	
	

?>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Update form</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="action/update.php">
            
           		<?php
					if ( $type == 'cat' ) {
						
						$result = $mysqli->query("SELECT uid,name,description FROM `category` WHERE uid =".$uid);
						$row = $result->fetch_row();
					
					?>
					
					<input name="uid" type="hidden" value="<?php echo $row[0];?>">
					
					<div class="form-group">
	                    <label>Name</label>
	                    <input name="name" class="form-control" value="<?php echo $row[1];?>">
	                </div>
	                <div class="form-group">
	                    <label>Description</label>
	                    <textarea name="desc" class="form-control" rows="3"><?php echo $row[2];?></textarea>
	                </div>
	                
					<?php
					}
				?>

				<?php
					if ( $type == 'ing' ) {
					
						$result = $mysqli->query("SELECT uid,name,description FROM `ingredients` WHERE uid =".$uid);
						$row = $result->fetch_row();
					
					?>
					
					<input name="uid" type="hidden" value="<?php echo $row[0];?>">
					
					<div class="form-group">
	                    <label>Name</label>
	                    <input name="name" class="form-control" value="<?php echo $row[1];?>">
	                </div>
	                <div class="form-group">
	                    <label>Description</label>
	                    <textarea name="desc" class="form-control" rows="3"><?php echo $row[2];?></textarea>
	                </div>
	                
					<?php
					}
				?>
				
				<?php
					if ( $type == 'prd' ) {
						

						$result = $mysqli->query("SELECT uid,name,description, price, ingredients_uid FROM `products` WHERE uid =".$uid);
						$row = $result->fetch_row();
					?>
					
					<div class="form-group">
	                    <label>Name</label>
	                    <input name="name" class="form-control" value="<?php echo $row[1];?>">
	                </div>
	                
					<input name="uid" type="hidden" value="<?php echo $row[0];?>">

	                <div class="form-group">
	                    <label>Description</label>
	                    <textarea name="desc" class="form-control" rows="3" ><?php echo $row[2];?></textarea>
	                </div>
					
					<div class="form-group">
	                    <label>Price</label>
	                    <input name="price" class="form-control" value="<?php echo $row[3];?>">
	                </div>
	                
	                <div class="form-group">
	                    <label>Ingredient</label>
	                    <select class="form-control" name="ingredient" >
		                   	<option value="">Select product</option>
	                    	 <?php

							$result = $mysqli->query("SELECT * FROM `ingredients` order by name");
							$ingredient = $result->fetch_row();
							
                            while ( $ingredient != null ) {
                            	if ($ingredient[0] == $row[4]){
	                            	?>
		                            	<option value="<?php echo $ingredient[0]; ?>" selected><?php echo $ingredient[1]; ?></option>
	                            	<?php
                            	}else{
                            		?>
                            			<option value="<?php echo $ingredient[0]; ?>"><?php echo $ingredient[1]; ?></option>
                            		<?php
                            	}
                            
	                            $ingredient = $result->fetch_row();
                            }
                            ?>
	                    </select>
	                </div>
	                
					<?php
					}
				?>
				
				<?php
					if ( $type == 'rec' ) {
						$recipes = $mysqli->query("SELECT uid,name,description,category,amount FROM `recipe` WHERE uid =".$uid);
						$recipe = $recipes->fetch_row();
						
					?>
					<div div class="form-group col-xs-12 col-sm-6">
							<div class="form-group col-xs-12 col-sm-6" style="margin-left: -15px;">
			                    <label>Name</label>
			                    <input name="name" class="form-control" value="<?php echo $recipe[1];?>">
	               				<input type="hidden" name="uid" class="form-control col-xs-12 col-sm-4" value="<?php echo $uid; ?>">
			                </div>
			                <div class="form-group col-xs-12 col-sm-6">
		                    <label>Category</label>
		                    <select class="form-control" name="ingredient" >
			                   	<option value="">Select category</option>
		                    	 <?php
	
								$result = $mysqli->query("SELECT * FROM `category`");
								$category = $result->fetch_row();
								
	                            while ( $category != null ) {
	                            	if ($category[0] == $recipe[3]){
		                            	?>
			                            	<option value="<?php echo $category[0]; ?>" selected><?php echo $category[1]; ?></option>
		                            	<?php
	                            	}else{
	                            		?>
	                            			<option value="<?php echo $category[0]; ?>"><?php echo $category[1]; ?></option>
	                            		<?php
	                            	}
	                            
		                            $category = $result->fetch_row();
	                            }
	                            ?>
		                    </select>
		                </div>
			                
		                <div class="form-group ">
		                    <label>Description</label>
		                    <textarea style="width:94%;" name="desc" class="form-control" rows="3"><?php echo $recipe[2];?></textarea>
		                </div>
	               		<div class="form-group ">	
			                <label>Amount</label>
			                 <p><?php echo $recipe[4];?></p>
			            </div>
		            </div>
		            <img width="50%" alt="<?php echo $recipe[1];?>" src="recipeImages/<?php echo $recipe[1];?>-0.jpg">

	                <table class="table table-bordered table-hover table-striped " style="margin-top:10px;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
	                <?php
                            $result = $mysqli->query("SELECT products_uid,NAME,a.quantity, price
														FROM recipe_has_products a
														LEFT JOIN products ON products.uid=a.products_uid
														WHERE recipe_uid=".$recipe[0]);
							$row = $result->fetch_row();  
							$prdIndex=0;
								                          
                            while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td>
	                            	<?php echo $row[1]; ?>
               					 	<input type="hidden" name="prd_uid<?php echo $prdIndex;?>" class="form-control" value="<?php echo $row[0]; ?>">
               					</td>
	                            <td>
	                            	<input name="quantity<?php echo $prdIndex;?>" class="form-control" required value="<?php echo $row[2]; ?>">
	                            </td>
								<td>
	                            	<?php echo $row[3]; ?>
								</td>
	                            <td>
									<a href="index.php?p=update&uid=<?php echo $row[0]; ?>&type=prd"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
								$prdIndex++;
                            }
                    ?>
                    	</tbody>
                    </table>              
					<?php
					}
				?>
				
				
                <?php
					if ( $type == 'wh' ) {
					
						$result = $mysqli->query("SELECT uid, name, quantity, position
													FROM products WHERE uid =".$uid);
						$row = $result->fetch_row();
					
					?>
					
					<input name="uid" type="hidden" value="<?php echo $row[0];?>">
					
					<div class="form-group col-xs-12 col-sm-4">
	                    <label>Product</label>
	                    <p><?php echo $row[1]; ?></p>
	                </div>
	                <div class="form-group col-xs-12 col-sm-4">
	                    <label>Position</label>
	                    <input name="position" class="form-control" required value="<?php echo $row[3]; ?>"></input>
	                </div>
	                <div class="form-group col-xs-12 col-sm-4">
	                    <label>Quantity</label>
	                    <input name="quantity" class="form-control" required value="<?php echo $row[2]; ?>"></input>
	                </div>
	               
	                
					<?php
					}
				?>
                <input type="hidden" name="type" class="form-control" value="<?php echo $type; ?>">
                <button type="submit" class="btn btn-default"><?php echo $submit;?></button>
                <button type="reset" class="btn btn-default"><?php echo $reset;?></button>
                <?php  if ( $type == 'rec' ) {?><a href="action/sticker.php?uid=<?php echo $uid; ?>" class="btn btn-default"><?php echo $sticker;?></a><?php }?>
				  <!-- Trigger the modal with a button -->
				  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#bitterCalculate"><?php echo $bitterCalculate;?></button>
				
				  <!-- Modal -->
				  <?php include "calculator.php";?>
				  <!-- End Modal -->
				</div>
            </form>
        </div>
    </div>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>
</div>