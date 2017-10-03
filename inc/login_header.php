<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadFile('finger_print.php', C_ROOT.DIRECTORY_SEPARATOR."Session");
CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

if(session_status() == PHP_SESSION_NONE){
    session_start();
    session_regenerate_id(true);
}

if(isset($_SESSION)){
    // ======== ログイン中 ======== 
     if(!isset($_SESSION['auth_key'])){
         if(isset($_GET['sp']) && $_GET['sp'] === "on"){
                View::loadTmpl('View'.DIRECTORY_SEPARATOR.'login_sp.html', T_ROOT, true);
            }else{
                View::loadTmpl('View'.DIRECTORY_SEPARATOR.'login.html', T_ROOT, true);
         }
         exit;
     }else{
         if($_SESSION['auth_key'] === ""){
             $_SESSION = array();
             if(isset($_COOKIE[session_name()])){
                 setcookie(session_name(), '', time()-42000, '/');
             }
             if(isset($_COOKIE['auth_key'])){
                 setcookie('auth_key', '', time()-42000, '/');
             }
             session_destroy();
         }elseif(!isset($_COOKIE['auth_key'])){
            if(isset($_GET['sp']) && $_GET['sp'] === "on"){
                View::loadTmpl('View'.DIRECTORY_SEPARATOR.'login_sp.html', T_ROOT, true);
            }else{
                View::loadTmpl('View'.DIRECTORY_SEPARATOR.'login.html', T_ROOT, true);
         }
             exit;
         }else{
            if($_SESSION['auth_key'] !== $_COOKIE['auth_key']){
                $_SESSION = array();
                if(isset($_COOKIE[session_name()])){
                    setcookie(session_name(), '', time()-42000, '/');
                }
                if(isset($_COOKIE['auth_key'])){
                    setcookie('auth_key', '', time()-42000, '/');
                }
                session_destroy();
            }
         }
     }
     CW_Loader::loadClass('registUser', C_ROOT);
     View::$RecipeData = registUser::UserDataDecode($_SESSION['user_data']);
     if(isset($_GET['sp']) && $_GET['sp'] === "on"){
            View::loadTmpl('View'.DIRECTORY_SEPARATOR.'login_sp.html', T_ROOT, true);
        }else{
            View::loadTmpl('View'.DIRECTORY_SEPARATOR.'login.html', T_ROOT, true);
        }

}



