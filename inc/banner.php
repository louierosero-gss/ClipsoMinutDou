<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

if($_SERVER['REQUEST_METHOD'] === "GET"){
    if(isset($_GET['type']) && is_numeric($_GET['type']) && intval($_GET['type']) > 0 && intval($_GET['type']) < 12){
        CW_Loader::loadClass('getBanner',C_ROOT);
        View::$NewsData = getBanner::getBannerFromType($_GET['type']);
        View::loadTmpl('View'.DIRECTORY_SEPARATOR.'banner.html', T_ROOT, true);
    }
    
}


