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
	                    <label>Reference</label>
	                    <select class="form-control" name="reference">
	                        <option value="">1</option>
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
                
                <input type="hidden" name="type" class="form-control" value="<?php echo $type; ?>">

                <button type="submit" class="btn btn-default">Submit Button</button>
                <button type="reset" class="btn btn-default">Reset Button</button>

            </form>
            <div class="text-right">
                <a href="#">Control Panel - All Records <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>