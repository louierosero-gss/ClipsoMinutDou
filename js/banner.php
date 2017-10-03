<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    if(isset($_GET['type']) && isset($_GET['id']) && is_numeric($_GET['id'])){
        CW_Loader::loadClass('getBanner',C_ROOT);
        View::$NewsData = getBanner::getBannerById($_GET['id']);
        
        
        CW_Loader::loadClass('setLog', C_ROOT);
        $get = array();
        $get['id'] = $_GET['id'];
        $get['type'] = $_GET['type'];
        if(isset($_GET['t']) && !empty($_GET['t'])){
            $referer = $_GET['t'];
        }else{
            $referer = '';
        }
        $log = setLog::setLogOn('2','',$get,View::$NewsData['url'],$referer,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']);
        
        header("Location:".View::$NewsData['url']);
        exit;
    }
}
