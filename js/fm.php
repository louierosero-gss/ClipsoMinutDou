<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";
require_once "../../cgi-data/Recipe/class/DB/ConnectPDO.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

$u_arr = array('',
'http://www.t-fal-online.jp/',
'http://www.directserve.t-fal.co.jp',
'http://www.club.t-fal.co.jp/products/CE/coffeemakers/directserve/features.html',
'http://www.club.t-fal.co.jp/products/CE/coffeemakers/directserve/cafepod.html',
'http://www.club.t-fal.co.jp/products/CE/coffeemakers/directserve/oc-ogawa.html',
'http://www.t-fal-online.jp/',
'http://www.club.t-fal.co.jp',
'http://www.t-fal.co.jp',
'http://www.club.t-fal.co.jp/campaign/index.html',
'http://www.club.t-fal.co.jp/campaign/ir/index.html',
'http://www.club.t-fal.co.jp/campaign/kt/index.html',
'http://www.club.t-fal.co.jp/campaign/vc/index.html',
'http://www.club.t-fal.co.jp/campaign/cm/index.html'
);

$t_arr = array('',
'ダイレクトサーブオンラインショップその1',
'ダイレクトサーブスペシャルコンテンツ',
'3つの驚きの秘密：ダイレクトサーブスペシャルコンテンツ',
'カフェポッド：ダイレクトサーブスペシャルコンテンツ',
'珈琲職人の味：ダイレクトサーブスペシャルコンテンツ',
'ダイレクトサーブオンラインショップその2',
'CLUB T-fal',
'T-falコーポレートサイト',
'CLUB T-falキャンペーントップページ',
'使ってなっとくキャンペーンアイロンページ',
'使ってなっとくキャンペーン電気ケトルページ',
'使ってなっとくキャンペーンエアフォースコンパクトページ',
'使ってなっとくキャンペーンダイレクトサーブページ'
);

if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    if(isset($_GET['c']) && is_numeric($_GET['c']) && isset($_GET['d']) && is_numeric($_GET['d'])){
        
        $stmt = new DB_Conn_PDO();
        
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
            $ref = $_SERVER['HTTP_REFERER'];
        }else{
            $ref = '';
        }
        
        $sql_str = "insert into tf_FMLog (log_type,s_date,s_url,s_keyword,s_ip,s_agent,s_referer) values (?,?,?,?,?,?,?)";
        $sql_arr = array($_GET['d'],TIME_NOW,$u_arr[$_GET['c']],$t_arr[$_GET['c']],$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],$ref);
        
        try{
			$result = $stmt->PreparedState($sql_str,$sql_arr);
		}catch(PDOException $e){
			var_dump($e->getCode(), $e->errorInfo, $e->getMessage());
			die();
		}
		if($result){
            header("Location:".$u_arr[$_GET['c']]);
            exit;
        }
    }else{
        header("Location:http://www.club.t-fal.co.jp");
        exit;
    }
}