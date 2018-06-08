<?php 
//Parameter
$charLimit=30;
$charSize=35;
$rotation=0;
$startFromY=210;		//y start from;
$startFromX=190;	//x start from;
$font="../fonts/arial.ttf";

// Create new image
$stickerImg = imagecreatefromjpeg("../stickers/BlackSticker.jpg");

// Define bg color and text 
$bgColor = imagecolorallocate($stickerImg,000,000,000);
$txtColor = imagecolorallocate($stickerImg,255,255,255);

// Put color on img
imagefill($stickerImg,0,0,$bgColor);

// Create variable with the text to print
if ( isset($_GET['uid']) ) {
	$uid = $_GET['uid'];
}
$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$recipes = $mysqli->query("SELECT uid,name,description,category,amount FROM `recipe` WHERE uid =".$uid);
$recipe = $recipes->fetch_row();
$text = $recipe[2];

//from Descripton make rows
$formattedText = wordwrap($text, $charLimit, "\n");

// Scrivo il testo all'interno dell'immagine
imagettftext($stickerImg, $charSize, $rotation, $startFromY, $startFromX, $txtColor, $font, $formattedText);

// Definisco l'intestazione del file
// indicando che si tratta di una immagine Jpeg
header("Content-type: image/jpeg");

// Mostro l'immagine creata
imagejpeg($stickerImg);

?>
<div class="col-lg-12">
    <div class="panel panel-default">
    	<br/>
        <div class="panel-body">
        </div>
    </div>
</div>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>