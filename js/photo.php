<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    if(isset($_GET['photo']) && file_exists(UP_ROOT.DIRECTORY_SEPARATOR.$_GET['photo'])){
        if(isset($_GET['width']) && is_numeric($_GET['width']) && isset($_GET['height']) && is_numeric($_GET['height'])){
            
            list($width,$height)=getimagesize(UP_ROOT.DIRECTORY_SEPARATOR.$_GET['photo']);
            if($width > $_GET['width']){
                $width = $_GET['width'];
            }
            if($height > $_GET['height']){
                $height = $_GET['height'];
            }
            
            $thumbmagick = new Imagick(UP_ROOT.DIRECTORY_SEPARATOR.$_GET['photo']);
            $thumbmagick->setCompression(Imagick::COMPRESSION_JPEG); 
            $thumbmagick->setCompressionQuality(70);
            $thumbmagick->adaptiveResizeImage($width,$height,true);
            $thumbmagick->setImageFormat('jpeg');
            header("Content-type: image/jpeg");
            header("X-Content-Type-Options: nosniff");
            echo $thumbmagick;
            $thumbmagick->clear();
            $thumbmagick->destroy();
            $thumbmagick = null;
        }
    }
}