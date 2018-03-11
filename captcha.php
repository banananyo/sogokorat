<?php
session_start();

$RandomStr = md5(microtime());// md5 to generate the random string

// $RandomStr = md5($_SESSION["rand"]);

$ResultStr = substr($RandomStr,0,6);//trim 5 digit
$_SESSION["rand"] = $ResultStr;

$NewImage =imagecreatefromjpeg("img.jpg");//image create by existing image and as back ground

$LineColor = imagecolorallocate($NewImage,233,239,239);//line color
$TextColor = imagecolorallocate($NewImage, 255, 255, 255);//text color-white

imageline($NewImage,1,-35,50,80,$LineColor);//create line 1 on image
imageline($NewImage,1,180,70,0,$LineColor);//create line 2 on image

imagestring($NewImage, 120, 24, 12, $ResultStr, $TextColor);// Draw a random string horizontally

$_SESSION["detect_farang"] = $ResultStr;// carry the data through session

header("Content-type: image/jpeg");// out out the image

imagejpeg($NewImage);//Output image to browser

?>
