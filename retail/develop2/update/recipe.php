			
				<?php
					if ( $type == 'rec' ) {
						$recipes = $mysqli->query("SELECT uid,name,description,category,amount,ibu,alcool FROM `recipe` WHERE uid =".$uid);
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
		                    <select class="form-control" name="category" >
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
		                    <textarea style="width:94%;height:250px;" name="desc" class="form-control" rows="3"><?php echo $recipe[2];?></textarea>
		                </div>
	               		<div class="form-group col-xs-12 col-sm-1">
			                <label>Amount</label>
			                 <p><?php echo $recipe[4];?></p>
			            </div>
	               		<div class="form-group col-xs-12 col-sm-1" style="margin-left:20px;">
			                <label>IBU</label>
			                 <p><?php echo $recipe[5];?></p>
			            </div>
	               		<div class="form-group col-xs-12 col-sm-2">
			                <label>Alcool</label>
			                <p><?php echo $recipe[6];?></p>
			            </div>
	               		<div class="form-group col-xs-12 col-sm-2" >
			            	<button style="margin-top: 10px;" type="button" class="btn btn-default" data-toggle="modal" data-target="#IBUCalculate"><?php echo $IBUCalculate;?></button>
	               		</div>
	               		<div class="form-group col-xs-12 col-sm-2" >
			            	<button style="margin-top: 10px;" type="button" class="btn btn-default" data-toggle="modal" data-target="#AlcoolCalculate"><?php echo $AlcoolCalculate;?></button>
	               		</div>
	               		<div class="form-group col-xs-12 col-sm-2" >
				            <button style="margin-top: 10px;" type="button" class="btn btn-default" data-toggle="modal" data-target="#StickerSize"><?php echo $sticker;?></button>
                        </div>
	               		<div class="form-group col-xs-12 col-sm-1" >
				            <button style="margin-top: 10px;" type="submit" class="btn btn-default"><?php echo $submit;?></button>
                        </div>
		            </div>
		            <div div class="form-group col-xs-12 col-sm-6" style="background: url('<?php echo $rootImages?>recipeImages/<?php echo $recipe[1];?>-0.jpg');background-size: cover;height:450px;background-repeat: no-repeat;background-position: center;"></div>

	                <table class="table table-bordered table-hover table-striped " style="margin-top:10px;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity in grams</th>
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
							$prdIndexU=9;//indice usato per update
								                          
                            while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td>
	                            	<?php echo $row[1]; ?>
               					 	<input type="hidden" name="product<?php echo $prdIndex.$prdIndexU;?>" class="form-control" value="<?php echo $row[0]; ?>">
               					</td>
	                            <td>
	                            	<input name="quantity<?php echo $prdIndex.$prdIndexU;?>" class="form-control" required value="<?php echo $row[2]; ?>">
	                            </td>
								<td width="100px">
	                            	<?php echo $row[3]; ?>
									<a href="index.php?p=update&uid=<?php echo $row[0]; ?>&type=prd"><span style="float:right;"class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								    <a href="action/delete.php?uid=<?php echo $uid; ?>&type=<?php echo $type; ?>&prd_uid=<?php echo $row[0];?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
								$prdIndex++;
								$prdIndexU++;
                            }
                    ?>
                    	</tbody>
                    </table>
                    <?php
                        include "utils/multipleProductsControl.php";
                    ?>
                    <div name="otherIng"></div>
                         <p>New ingredient: <a onclick="addRow(document.getElementsByName('rowIng')[0].innerHTML)"><span class="glyphicon glyphicon-plus"></span></a></p>
					<?php
					}
				?>