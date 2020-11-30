<div name= "rowIng" style="display:none;">
                <div class="form-group col-xs-6 col-sm-3 ">
                    <label>Ingredient</label>
                    <select class="form-control" name="ingredient" onchange="getProducts(this.name)">
                    	<option value="">Select ingredient</option>
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
                    <select class="form-control" name="product" onchange="setPrice(this.name)">
                        <option value="">Select product</option>
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
                    <input name="quantity" class="form-control" >
                </div>


                <div class="form-group col-xs-6 col-sm-3 ">
                    <label>Price</label>
                    <input  class="form-control" name="price">
                    <p  class="help-block"></p>
                </div>
            </div>