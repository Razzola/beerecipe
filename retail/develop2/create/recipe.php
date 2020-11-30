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
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category" >
                        <option value="">Select category</option>
                         <?php

                        $result = $mysqli->query("SELECT * FROM `category`");
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
                include "utils/multipleProductsControl.php";
            ?>

                <div name="otherIng"></div>
                <p>New ingredient: <a onclick="addRow(document.getElementsByName('rowIng')[0].innerHTML)"><span class="glyphicon glyphicon-plus"></span></a></p>
<?php
	}
?>
