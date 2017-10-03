<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";
require_once "../../cgi-data/Recipe/class/DB/ConnectPDO.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

$u_arr = array('',
'http://www.t-fal-online.jp/?utm_source=np&utm_medium=mailmagazine&utm_term=%E3%83%80%E3%82%A4%E3%83%AC%E3%82%AF%E3%83%88%E3%82%B5%E3%83%BC%E3%83%96%E3%82%AA%E3%83%B3%E3%83%A9%E3%82%A4%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%97&utm_campaign=2012_np_mailmagazine',
'http://www.t-fal-online.jp/?utm_source=np&utm_medium=mailmagazine&utm_term=%E3%83%80%E3%82%A4%E3%83%AC%E3%82%AF%E3%83%88%E3%82%B5%E3%83%BC%E3%83%96%E3%82%AA%E3%83%B3%E3%83%A9%E3%82%A4%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%97&utm_campaign=2012_np_mailmagazine_02',
'http://www.t-fal-online.jp/?utm_source=np&utm_medium=mailmagazine&utm_term=%E3%83%80%E3%82%A4%E3%83%AC%E3%82%AF%E3%83%88%E3%82%B5%E3%83%BC%E3%83%96%E3%82%AA%E3%83%B3%E3%83%A9%E3%82%A4%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%97&utm_campaign=2012_np_mailmagazine_03');

$t_arr = array('',
'ダイレクトサーブオンラインショップ',
'ダイレクトサーブオンラインショップ',
'ダイレクトサーブオンラインショップ');

if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        
        $stmt = new DB_Conn_PDO();
        
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
            $ref = $_SERVER['HTTP_REFERER'];
        }else{
            $ref = '';
        }
        
        if(empty($u_arr[$_GET['id']]) || empty($t_arr[$_GET['id']])){
            header("Location:http://www.club.t-fal.co.jp/");
            exit;
        }
        
        $sql_str = "insert into tf_NPLog (log_type,s_date,s_url,s_keyword,s_ip,s_agent,s_referer) values (?,?,?,?,?,?,?)";
        $sql_arr = array($_GET['id'],TIME_NOW,$u_arr[$_GET['id']],$t_arr[$_GET['id']],$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],$ref);
        
        try{
			$result = $stmt->PreparedState($sql_str,$sql_arr);
		}catch(PDOException $e){
			var_dump($e->getCode(), $e->errorInfo, $e->getMessage());
			die();
		}
		if($result){
            header("Location:".$u_arr[$_GET['id']]);
            exit;
        }
    }else{
        header("Location:http://www.club.t-fal.co.jp");
        exit;
    }
}