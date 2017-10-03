<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadFile('finger_print.php', C_ROOT.DIRECTORY_SEPARATOR."Session");
CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

session_start();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    // ======== ログイン中 ======== 
    if(isset($_SESSION['auth_key'])){
        if($_SESSION['auth_key'] !== ""){
            header("Location:http://www.club.t-fal.co.jp/");
            exit;
        }elseif(isset($_COOKIE['auth_key'])){
            if($_SESSION['auth_key'] === $_COOKIE['auth_key']){
                header("Location:http://www.club.t-fal.co.jp/");
                exit;
            }
        }
    }
    if(isset($_SESSION['user_data'])){
        header("Location:http://www.club.t-fal.co.jp/");
        exit;
    }
    
    if(isset($_POST['mode']) && !empty($_POST['mode'])){
        if($_POST['mode'] === "login"){
            CW_Loader::loadClass('loginChk', C_ROOT.DIRECTORY_SEPARATOR."Auth");
            $loginchk= loginChk::isUserChk($_POST['email'],$_POST['password']);
            if(null === $loginchk || !is_array($loginchk)){
                View::$errMsg = array("【ログインID】もしくは【パスワード】が正しくありません。");
                View::loadTmpl('Login'.DIRECTORY_SEPARATOR.'login_user_mm.html', T_ROOT, true);
                exit;
            }else{
                CW_Loader::loadClass('registUser', C_ROOT);
                CW_Loader::loadClass('getMy', C_ROOT);
                CW_Loader::loadClass('getPoint', C_ROOT);
                CW_Loader::loadClass('setPoint', C_ROOT);
                CW_Loader::loadClass('getMMLink', C_ROOT);
                
                $my_lead = getMy::getMyLead($loginchk);
                session_regenerate_id(true);
                // ======== 認証成功時 ======== 
                $token = md5(uniqid(rand(), true)); // この文字列がログイン中を示すセッションIDの代わり
                $point = setPoint::setPointHistory(2,$loginchk['id'],"log","マイページログイン");
                $_SESSION['auth_key'] = $token;
                setcookie('auth_key',$token,0,'/','',FALSE,TRUE);
                $_SESSION['lead_text'] = $my_lead;
                $_SESSION['total_point'] = getPoint::getPointTotalByUser($loginchk['id']);
                $_SESSION['user_data'] = registUser::UserDataEncode(array("id" => $loginchk['id'],"name" => $loginchk['name'],"expired" => $_SERVER['REQUEST_TIME']));
                
                $mm = getMMLink::getMMLinkById($_POST['d']);
                setPoint::setPointHistory(6,$loginchk['id'],"mml_".$_POST['d'],$mm['name']."リンククリック");
                
                header("Location:".$mm['url']);
                exit;
                
            }
        }
    }
    
    
    
}

if($_SERVER['REQUEST_METHOD'] === "GET"){
    CW_Loader::loadClass('registUser', C_ROOT);
    CW_Loader::loadClass('getPoint', C_ROOT);
    CW_Loader::loadClass('setPoint', C_ROOT);
    CW_Loader::loadClass('getMMLink', C_ROOT);
    if(isset($_SESSION['user_data'])){
        if(isset($_GET['d']) && !empty($_GET['d'])){
            $d = registUser::UserDataDecode($_SESSION['user_data']);
            $mm = getMMLink::getMMLinkByIdForLink($_GET['d']);
            if(isset($mm['id']) && is_numeric($mm['id'])){
                setPoint::setPointHistory(6,$d['id'],"mml_".$_GET['d'],$mm['name']."リンククリック");
                header("Location:".$mm['url']);
                exit;
            }else{
                header("Location:http://".$_SERVER['SERVER_NAME']."/");
                exit;
            }
        }else{
            header("Location:http://".$_SERVER['SERVER_NAME']."/");
            exit;
        }
    }
    // ======== ログイン中 ======== 
    if(isset($_SESSION['auth_key']) && !empty($_SESSION['auth_key'])){
        if(isset($_COOKIE['auth_key'])){
            if(isset($_GET['d']) && !empty($_GET['d'])){
                $d = registUser::UserDataDecode($_SESSION['user_data']);
                $mm = getMMLink::getMMLinkById($_GET['d']);
                if(isset($mm['id']) && is_numeric($mm['id'])){
                    setPoint::setPointHistory(6,$d['id'],"mml_".$_GET['d'],$mm['name']."リンククリック");
                    header("Location:".$mm['url']);
                    exit;
                }else{
                    header("Location:http://".$_SERVER['SERVER_NAME']."/");
                    exit;
                }
            }else{
                header("Location:http://".$_SERVER['SERVER_NAME']."/");
                exit;
            }
        }
    }
    
    /*CW_Loader::loadClass('setLog', C_ROOT);
    if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
        $referer = $_SERVER['HTTP_REFERER'];
    }else{
        $referer = '';
    }
    $log = setLog::setLogOn($_GET,"http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],$referer,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']);*/
    
    
    View::loadTmpl('Login'.DIRECTORY_SEPARATOR.'login_user_mm.html', T_ROOT, true);
    exit;
    
    
}