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
                            <th>#</th>
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
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <?php
                            }
                            ?>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        
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
									<a href="action/delete.php?uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									<a href=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
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
	                            $result = $mysqli->query("SELECT * FROM `products`");
								$row = $result->fetch_row();  
								                          
                            	while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td><?php echo $row[0]; ?></td>
	                            <td><?php echo $row[1]; ?></td>
	                            <td><?php echo $row[2]; ?></td>
	                            <td><?php echo $row[3]; ?></td>
	                            <td><?php echo $row[4]; ?></td>
	                            <td>
									<a href="action/delete.php?uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									<a href=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
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