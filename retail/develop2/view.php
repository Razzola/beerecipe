<?php

$type = "";
if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
	

	switch ($type) {
		case 'prd':
			$name = 'products';
			break;
		case 'rec':
			$name = 'recipes';
			break;
		case 'ing':
			$name= 'ingredients';
			break;
		case 'wh':
			$name= 'product';
			break;
	}
}

?>

<div class="col-lg-12">
    <div class="panel panel-default">
    <br/>
        <div class="panel-body">
        <div class="text-right">
             <a href="index.php?p=create&type=<?php echo $type;?>">Insert new <?php echo $name;?> 
               <i class="fa fa-arrow-circle-right"></i></a>
         </div>
         <br/>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <?php
                            if ( $type == 'ing' ) {
                            ?>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                            <?php
                            }
                            ?>
                            
                            <?php
                            if ( $type == 'prd' ) {
                            ?>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Reference</th>
                            <th>Action</th>
                            <?php
                            }
                            ?>
                            
                            
                            <?php
                            if ( $type == 'rec' ) {
                            ?>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Action</th>
                            <?php
                            }
                            ?>
                            
                            <?php
                            if ( $type == 'cat' ) {
                            ?>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                            <?php
                            }
                            ?>
                            
                            
                            <?php
                            if ( $type == 'wh' ) {
                            ?>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Position</th>
                            <th>Action</th>
                            <?php
                            }
                            ?>
                            
                        </tr>
                    </thead>
                    <tbody>
                    
                    		<?php
                            if ( $type == 'cat' ) {
                            
	                            $mysqli = new mysqli("localhost", "root", "", "beerecipe");
	                            $result = $mysqli->query("SELECT * FROM `category`");
								$row = $result->fetch_row();  
								                          
                            	while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td><?php echo $row[1]; ?></td>
	                            <td><?php echo $row[2]; ?></td>
	                            <td>
									<a href="index.php?p=update&uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
                            	}
                            }
                            ?>
                        
                        
                        	<?php
                            if ( $type == 'ing' ) {
                            
	                            $mysqli = new mysqli("localhost", "root", "", "beerecipe");
	                            $result = $mysqli->query("SELECT * FROM `ingredients`");
								$row = $result->fetch_row();  
								                          
                            	while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td><?php echo $row[0]; ?></td>
	                            <td><?php echo $row[1]; ?></td>
	                            <td><?php echo $row[2]; ?></td>
	                            <td>
									<a href="index.php?p=update&uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
                            	}
                            }
                            ?>
                            
                            <?php
                            if ( $type == 'prd' ) {
                            
	                            $mysqli = new mysqli("localhost", "root", "", "beerecipe");
	                            $result = $mysqli->query("SELECT a.name,a.description,a.price, b.name, a.uid FROM products a
															left join ingredients b on a.ingredients_uid=b.uid ");
								$row = $result->fetch_row();  
								                          
                            	while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td><?php echo $row[0]; ?></td>
	                            <td><?php echo $row[1]; ?></td>
	                            <td><?php echo $row[2]; ?></td>
	                            <td><?php echo $row[3]; ?></td>
	                            <td>
									<a href="index.php?p=update&uid=<?php echo $row[4]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
                            	}
                            }
                            ?>
                            
                            <?php
                            if ( $type == 'rec' ) {
                            
	                            $mysqli = new mysqli("localhost", "root", "", "beerecipe");
	                            $result = $mysqli->query("SELECT a.uid, a.name,a.description,amount,b.name FROM recipe a
	                            		LEFT JOIN category b ON a.category=b.uid ");
								$row = $result->fetch_row();  
								                          
                            	while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td><?php echo $row[1]; ?></td>
	                            <td><?php echo $row[2]; ?></td>
	                            <td><?php echo $row[3]; ?></td>
	                            <td><?php echo $row[4]; ?></td>
	                            <td>
	                            	<a id="deletelink" href="action/delete.php?uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									<a href="index.php?p=update&uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
                            	}
                            }
                            ?>
                            
                            <?php
                            if ( $type == 'wh' ) {
                            
	                            $mysqli = new mysqli("localhost", "root", "", "beerecipe");
	                            $result = $mysqli->query("SELECT uid,name, quantity, position from products ORDER BY name");
								$row = $result->fetch_row();  
								                          
                            	while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td><?php echo $row[1]; ?></td>
	                            <td><?php echo $row[2]; ?></td>
	                            <td><?php echo $row[3]; ?></td>
	                            <td>
	                            	<a href="index.php?p=update&uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
                            	}
                            }
                            ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <a href="index.php?p=create&type=<?php echo $type;?>">Insert new <?php echo $name;?>
                  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>