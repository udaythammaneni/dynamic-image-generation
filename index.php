<?php
// header("Content-type: image/jpeg");
$fullName = "Your Name";
$imgPath = "Place_Image.jpg";

$condicion = GetImageSize($imgPath); // image format?
if ($condicion[2] == 1) //gif
$im = imagecreatefromgif("$imgPath");
if ($condicion[2] == 2) //jpg
$im = imagecreatefromjpeg("$imgPath");
if ($condicion[2] == 3) //png
$im = imagecreatefrompng("$imgPath");

$color = imagecolorallocate($im, 255, 255, 255);
$colorBlack = imagecolorallocate($im, 0, 0, 0);
$fontArial = "arial.ttf";

// Here 18 is Font Size 
// 0 & 0 is X and Y Coordinates to Adjust the center
$bbox = imagettfbbox(18, 0, $fontArial, $fullName);
$x = $bbox[0] + (imagesx($im)/2) - ($bbox[4]/2) + 0;
$y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2)+0 ;
imagettftext($im, 18, 0, $x, $y, $colorBlack, $fontArial, $fullName);

// imagejpeg($im);

//set it to writable location, a place for temp generated PNG files
$IMG_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
//ofcourse we need rights to create temp dir
if (!file_exists($IMG_DIR))mkdir($IMG_DIR);

// Save the picture
$public_file_path = './images/';
$imgName1 = $fullName.".jpg";
imagejpeg($im, $public_file_path . $imgName1, 100);
// $imgPathConcat = "./images/".$imgName1;
// echo ' <img src="'.$imgPathConcat.'" class="img-responsive" width="784" height="500"></a>';
?>