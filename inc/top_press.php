<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    CW_Loader::loadClass('getNews',C_ROOT);
    View::$NewsData = getNews::getNewsForTop(10);
    
}
View::loadTmpl('View'.DIRECTORY_SEPARATOR.'news_top_area.html', T_ROOT, true);

