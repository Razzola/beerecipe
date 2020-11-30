<?php
    if (isset($_GET['AAU'])){
        $aau=$_GET['AAU'];
        $mysqli = new mysqli("localhost", "root", "", "beerecipe");
        $lastId= $mysqli->query("SELECT MAX(uid) from products");
        $prod_id=$lastId->fetch_row()[0];
        if ($type == 'prd' and isset($_GET['uid'])){
            $prod_id=$_GET['uid'];
            $hopPrd= $mysqli->query("SELECT * from hop where product_id='$prod_id'");
            $hopPrdN=$hopPrd->fetch_row();
            echo $hopPrdN[0];
            if ($hopPrdN[0] == ''){
                $insert= $mysqli->query("INSERT INTO hop ( hop_id, product_id, aau ) VALUES ( null, '$prod_id', '$aau' ) ");
            }
            else
                $update= $mysqli->query("UPDATE hop SET aau='$aau' WHERE product_id='$prod_id'");
        }else{
            echo "pippo";
                $insert= $mysqli->query("INSERT INTO hop ( hop_id, product_id, aau ) VALUES ( null, '$prod_id', '$aau' ) ");
        }
    }
?>