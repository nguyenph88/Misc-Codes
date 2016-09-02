<?php
session_start();
create_image();
exit();
function create_image()
{
    $md5_hash = md5(rand(0,999) . $_GET['mode']); 
    $security_code = substr($md5_hash, 15, 6); 
    $_SESSION['captcha_' . $_GET['mode']] = $security_code;
    $width = 70;
    $height = 20; 
    $image = ImageCreate($width, $height);  
    $white = ImageColorAllocate($image, 255, 255, 255);
    $black = ImageColorAllocate($image, 0, 0, 0);
    $grey = ImageColorAllocate($image, 204, 204, 204);
    ImageFill($image, 0, 0, $black); 
    ImageString($image, 3, 10, 3, $security_code, $white); 
    ImageRectangle($image,0,0,$width-1,$height-1,$grey); 
    header('Content-Type: image/jpeg'); 
    ImageJpeg($image);
    ImageDestroy($image);
}
?>