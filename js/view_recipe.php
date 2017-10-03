<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if($_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest'){
        //ブラウザからの直接リクエストを受け付けない
        die("PST ERR");
    }
    CW_Loader::loadClass('registUser', C_ROOT);
    View::$UserData = registUser::UserDataDecode(rawurldecode($_POST['enc']));
    $add = registUser::resetMyFavorite(View::$UserData['id'],$_POST['id']);
    if($add){
        return true;
    }else{
        return false;
    }
}
if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    //var_dump($_GET['enc']);
    if($_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest'){
        //ブラウザからの直接リクエストを受け付けない
        die(json_encode(array('stat' => "参照不成功：不正な呼び出し")));
    }
    if(!isset($_GET['enc']) || $_GET['enc'] === "" || empty($_GET['enc'])){
        die(json_encode(array('stat' => "No Entry")));
    }
    CW_Loader::loadClass('registUser', C_ROOT);
    View::$UserData = registUser::UserDataDecode(rawurldecode($_GET['enc']));
    View::$notifData = registUser::getNotification();
    if(isset($_GET['view']) && $_GET['view'] === "fav_detail"){
        if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['date']) && (intval($_GET['year']) > 2010) && (intval($_GET['month']) >= 1) && (intval($_GET['month'] < 13)) && intval($_GET['date'] >= 1) && intval($_GET['date'] < 32)){
            View::$CntData = registUser::getFavoriteCnt(View::$UserData['id'],$_GET['year'],$_GET['month'],$_GET['date']);
            View::$RecipeData = registUser::getMyFavorite(View::$UserData['id'],$_GET['year'],$_GET['month'],$_GET['date']);
            View::loadTmpl('View'.DIRECTORY_SEPARATOR.'mypage_recipe_date.html', T_ROOT, true);
            exit;
        }else{
            header("Location:/mypage/");
            exit;
        }
    }elseif(isset($_GET['view']) && $_GET['view'] === "calendar"){
        if(isset($_GET['year']) && isset($_GET['month']) && (intval($_GET['year']) > 2010) && (intval($_GET['month']) > 0) && (intval($_GET['month'] < 13))){
            View::$RecipeData = registUser::getMyFavoriteOnCal(View::$UserData['id'],$_GET['year'],$_GET['month']);
        }else{
            View::$RecipeData = registUser::getMyFavoriteOnCal(View::$UserData['id'],date("Y",$_SERVER['REQUEST_TIME']),date("n",$_SERVER['REQUEST_TIME']));
        }
        View::$CntData = registUser::getFavoriteCnt(View::$UserData['id']);
        View::loadTmpl('View'.DIRECTORY_SEPARATOR.'mypage_recipe_calendar.html', T_ROOT, true);
        exit;
    }elseif(isset($_GET['view']) && $_GET['view'] === "notification"){
        if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['date']) && (intval($_GET['year']) > 2011) && (intval($_GET['month']) >= 1) && (intval($_GET['month'] < 13)) && intval($_GET['date'] >= 1) && intval($_GET['date'] < 32)){
            View::$CategoryData = registUser::getItemCategory(View::$UserData['id']);
            View::$CntData = registUser::getNotificationByDate($_GET['year'],$_GET['month'],$_GET['date']);
            View::loadTmpl('View'.DIRECTORY_SEPARATOR.'mypage_notification.html', T_ROOT, true);
            exit;
        }else{
            header("Location:/mypage/");
            exit;
        }
    }elseif(isset($_GET['view']) && $_GET['view'] === "log"){
        if(isset($_GET['type']) && !empty($_GET['type'])){
            if($_GET['type'] === "recipe"){
                View::$CntData = registUser::getMyLog(View::$UserData['id'],"recipe");
                View::loadTmpl('View'.DIRECTORY_SEPARATOR.'mypage_log.html', T_ROOT, true);
            }elseif($_GET['type'] === "keyword"){
                View::$CntData = registUser::getMyLog(View::$UserData['id'],"keyword");
                View::loadTmpl('View'.DIRECTORY_SEPARATOR.'mypage_keyword.html', T_ROOT, true);
            }
            
            exit;
        }
    }
    View::$RecipeData = registUser::getMyFavorite(View::$UserData['id']);
    View::$CntData = registUser::getFavoriteCnt(View::$UserData['id']);
    View::loadTmpl('View'.DIRECTORY_SEPARATOR.'mypage_recipe_list.html', T_ROOT, true);
    
}