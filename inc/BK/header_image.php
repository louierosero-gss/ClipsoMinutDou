<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    CW_Loader::loadClass('getHeaderImage',C_ROOT);
    View::$NewsData = getHeaderImage::getImages();
    
}
View::loadTmpl('View'.DIRECTORY_SEPARATOR.'header_image.html', T_ROOT, true);

