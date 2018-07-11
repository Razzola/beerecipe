<?php 
//Parameter
$charLimit=30;
$charSize=35;
$rotation=0;
$startFromY=210;		//y start from;
$startFromX=190;	//x start from;
$startIbuFromY=750;		//y ibu start from;
$startIbuFromX=1275;	//x ibu start from;
$startAlcoolFromY=175;//y alcool start from;
$startAlcoolFromX=1275;//x alccol start from;

//Set size for 1l sticker
if(isset($_GET['size'])&& ($_GET['size'])==100 ){
	$charLimit=30;
	$charSize=35;
	$rotation=0;
	$startFromY=210;		
	$startFromX=190;	
	$startIbuFromY=750;		
	$startIbuFromX=1075;	
	$startAlcoolFromY=175;
	$startAlcoolFromX=1075;
}
//Set size for 75cl sticker
if(isset($_GET['size'])&& ($_GET['size'])==100 ){
	$charLimit=30;
	$charSize=35;
	$rotation=0;
	$startFromY=210;
	$startFromX=190;
	$startIbuFromY=750;
	$startIbuFromX=1075;
	$startAlcoolFromY=175;
	$startAlcoolFromX=1075;
}
//Set size for 50cl sticker
if(isset($_GET['size'])&& ($_GET['size'])==100 ){
	$charLimit=30;
	$charSize=35;
	$rotation=0;
	$startFromY=210;
	$startFromX=190;
	$startIbuFromY=750;
	$startIbuFromX=1075;
	$startAlcoolFromY=175;
	$startAlcoolFromX=1075;
}

//Set size for 33cl sticker
if(isset($_GET['size'])&& ($_GET['size'])==100 ){
	$charLimit=30;
	$charSize=35;
	$rotation=0;
	$startFromY=210;
	$startFromX=190;
	$startIbuFromY=750;
	$startIbuFromX=1075;
	$startAlcoolFromY=175;
	$startAlcoolFromX=1075;
}
///////////////////////////


$root="C:/xampp/htdocs/beerecipe/retail/develop2";
$font=$root.'/fonts/arial.ttf';

// Create new image
$stickerImg = imagecreatefromjpeg($root.'/stickers/BlackSticker.jpg');

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
$recipes = $mysqli->query("SELECT uid,name,description,category,amount,ibu,alcool FROM `recipe` WHERE uid =".$uid);
$recipe = $recipes->fetch_row();
$text = $recipe[2];
$ibu="IBU: ".intval($recipe[5]);
$alcool=intval($recipe[6])."% vol.";

//from Descripton make rows
$formattedText = wordwrap($text, $charLimit, "\n");

// Scrivo il testo all'interno dell'immagine
imagettftext($stickerImg, $charSize, $rotation, $startFromY, $startFromX, $txtColor, $font, $formattedText);
imagettftext($stickerImg, $charSize, $rotation, $startIbuFromY, $startIbuFromX, $txtColor, $font, $ibu);
imagettftext($stickerImg, $charSize, $rotation, $startAlcoolFromY, $startAlcoolFromX, $txtColor, $font, $alcool);

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