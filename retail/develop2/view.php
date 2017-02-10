<?php

$type = "";
if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
}

?>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Ingredients</h3>
        </div>
        <div class="panel-body">
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
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
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
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
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
                <a href="#">Control Panel - All Records <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>