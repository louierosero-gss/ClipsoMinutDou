<?php
require_once "../../cgi-data/Recipe/class/BootLoader.php";
require_once "../../cgi-data/Recipe/class/setPoint.php";
require_once "../../cgi-data/Recipe/class/DB/ConnectPDO.php";
CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");
$error_msg = array();

session_start();
session_regenerate_id(true);

if(isset($_SESSION)){
    // ======== ログイン中 ======== 
    if(!isset($_SESSION['auth_key'])){
        header("Location:http://www.club.t-fal.co.jp/login/logout.php");
        exit;
    }else{
        if($_SESSION['auth_key'] === ""){
            header("Location:http://www.club.t-fal.co.jp/login/logout.php");
            exit;
        }elseif(!isset($_COOKIE['auth_key'])){
            header("Location:http://www.club.t-fal.co.jp/login/logout.php");
            exit;
        }else{
           if($_SESSION['auth_key'] !== $_COOKIE['auth_key']){
               header("Location:http://www.club.t-fal.co.jp/login/logout.php");
               exit;
           }
        }
    }
    
    if($_SERVER['REQUEST_METHOD'] === "GET"){
        
        if(isset($_GET['h']) && !empty($_GET['h']) && isset($_GET['d']) && is_numeric($_GET['d'])){
            
            $stmt = new DB_Conn_PDO();
            
            $sql_str = "select id, name, url from tf_sp_contents where hash = ?";
            $sql_arr = array($_GET['h']);
            
            try{
    			$result = $stmt->PreparedState($sql_str,$sql_arr);
    		}catch(PDOException $e){
    			var_dump($e->getCode(), $e->errorInfo, $e->getMessage());
    			die();
    		}
            if($result){
                $row = $stmt->Fetcher(PDO::FETCH_ASSOC);
                setPoint::setPointHistory(7,$_GET['d'],"spc_".$row['id'], $row['name']."閲覧");
                header("Location:".$row['url']);
                exit;
            }
        }else{
            header("Location:http://www.club.t-fal.co.jp");
            exit;
        }
    }
    
    
    
}else{
    header("Location:http://www.club.t-fal.co.jp/login/logout.php");
    exit;
}

    