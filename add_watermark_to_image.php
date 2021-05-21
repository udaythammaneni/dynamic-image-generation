<?php
// header("Content-type: image/jpeg");
$fullName = "Name";
$imgPath = "Place_Image-GM.png";
$fontName = "arial.ttf";
$photo_to_paste = "Place_Image.jpg";  //image 321 x 400

$condition = GetImageSize($imgPath); // image format?
if ($condition[2] == 1) //gif
$image = imagecreatefromgif("$imgPath");
if ($condition[2] == 2) //jpg
$image = imagecreatefromjpeg("$imgPath");
if ($condition[2] == 3) //png
$image = imagecreatefrompng("$imgPath");

$colorBlack = imagecolorallocate($image, 0, 0, 0);

$condition2 = GetImageSize($photo_to_paste); // image format?
if ($condition2[2] == 1) //gif
$im2 = imagecreatefromgif("$photo_to_paste");
if ($condition2[2] == 2) //jpg
$im2 = imagecreatefromjpeg("$photo_to_paste");
if ($condition2[2] == 3) //png
$im2 = imagecreatefrompng("$photo_to_paste");

// Get image dimensions
list($width_orig, $height_orig) = getimagesize($photo_to_paste);
imagecopyresampled($image, $im2, 55, 71, 0, 0, 115, 115, $width_orig, $height_orig);

$bbox = imagettfbbox(18, 0, $fontName, $fullName);
$x = $bbox[0] + (imagesx($image) / 2) - ($bbox[4] / 2) + 0;
$y = $bbox[1] + (imagesy($image) / 2) - ($bbox[5] / 2) - 90;
imagettftext($image, 18, 0, $x, $y, $colorBlack, $fontName, $fullName);

// imagejpeg($image);

//set it to writable location, a place for temp generated PNG files
$IMG_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
//ofcourse we need rights to create temp dir
if (!file_exists($IMG_DIR))mkdir($IMG_DIR);

// Save the picture
$public_file_path = './images/';
$imgName1 = "WaterMark-Image.jpg";
imagejpeg($image, $public_file_path . $imgName1, 100);
$activityImage = "./images/" . $imgName1;

echo '<a href="' . $activityImage . '" download><img src="' . $activityImage . '"  width="784" height="500" title="Click to download"></a>';
?>