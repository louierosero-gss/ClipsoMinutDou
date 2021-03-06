<?php
require_once "../../cgi-data/Recipe/class/BootLoader.php";
require_once "../../cgi-data/Recipe/class/DB/ConnectPDO.php";
CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");
$error_msg = array();
$u_arr = array(
    '1' => array('',
                'http://www.club.t-fal.co.jp/products/CE/coffeemakers/directserve/',
                'http://www.club.t-fal.co.jp/sp/recipes/breakfast/',
                'http://www.specialcontents.t-fal.co.jp/store/index.html',
                'http://www.club.t-fal.co.jp/mypage/regist/',
                'http://www.club.t-fal.co.jp/index.html',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/'),
    '2' => array('',
                'http://www.club.t-fal.co.jp/recipe/detail/317/',
                'http://www.club.t-fal.co.jp/recipe/detail/219/',
                'http://www.club.t-fal.co.jp/recipe/detail/94/',
                'http://www.club.t-fal.co.jp/sp/recipes/vegetable/',
                'http://www.club.t-fal.co.jp/products/CE/iron/prince/',
                'http://www.t-fal.co.jp/All+Products/Consumer+electronics/irons/',
                'http://www.club.t-fal.co.jp/products/CA/homebakery/bl_top.html',
                'http://www.club.t-fal.co.jp/products/CW/kitchenscale/',
                'http://www.t-fal-online.jp/',
                'http://www.club.t-fal.co.jp/products/CE/coffeemakers/directserve/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.club.t-fal.co.jp/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/login/'),
    '3' => array('',
                'http://www.club.t-fal.co.jp/products/CE/airforcecompact/',
                'http://www.club.t-fal.co.jp/sp/recipes/snack/',
                'http://www.club.t-fal.co.jp/products/CA/toaster/index.html',
                'http://www.club.t-fal.co.jp/products/CE/kettles/index.html',
                'http://www.specialcontents.t-fal.co.jp/store/',
                'http://www.club.t-fal.co.jp/products/CE/coffeemakers/directserve/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/'),
    '4' => array('',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.club.t-fal.co.jp/sp/recipes/stamina/',
                'http://www.club.t-fal.co.jp/campaign/iron201206/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/'),
    '5' => array('',
                'http://www.club.t-fal.co.jp/sp/recipes/cool-sweets/',
                'http://www.club.t-fal.co.jp/products/CA/stickmixer/index.html',
                'http://www.club.t-fal.co.jp/campaign/iron201206/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
    			'http://www.club.t-fal.co.jp/'),
    '6' => array('',
                'http://www.club.t-fal.co.jp/products/CE/iron/freemove/index.html',
                'http://www.club.t-fal.co.jp/campaign/mikaku-bento/index.html',
                'http://www.club.t-fal.co.jp/products/CA/foodprocessor/index.html',
                'http://www.club.t-fal.co.jp/sp/recipes/kinoko/index.html',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
    			'http://www.club.t-fal.co.jp/'),
    '7' => array('',
                'http://www.club.t-fal.co.jp/products/CE/coffeemakers/directserve/',
                'http://www.club.t-fal.co.jp/sp/recipes/frying-pan/index.html',
                'http://www.club.t-fal.co.jp/products/CW/kitchengoods/timer/index.html',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
    			'http://www.club.t-fal.co.jp/'),
    '8' => array('',
                'http://www.club.t-fal.co.jp/sp/recipes/speed-cooking/',
                'http://www.club.t-fal.co.jp/campaign/mikaku-bento/',
                'http://www.club.t-fal.co.jp/library/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
                'http://www.club.t-fal.co.jp/'),
    '9' => array('',
                'http://www.club.t-fal.co.jp/products/CW/pressurecookers/acticook/',
                'http://www.club.t-fal.co.jp/sp/recipes/stackable-party/index.html',
                'http://www.club.t-fal.co.jp/recipe/detail/127/',
                'http://www.club.t-fal.co.jp/recipe/detail/561/',
                'http://www.club.t-fal.co.jp/recipe/detail/657/',
                'http://www.club.t-fal.co.jp/recipe/detail/226/',
                'http://www.club.t-fal.co.jp/recipe/detail/617/',
                'http://www.club.t-fal.co.jp/recipe/detail/211/',
                'http://www.club.t-fal.co.jp/products/CE/coffeemakers/directserve/',
                'http://www.t-fal-online.jp/',
                'http://www.club.t-fal.co.jp/products/CE/kettles/',
                'http://www.club.t-fal.co.jp/products/CE/airforcecompact/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
                'http://www.club.t-fal.co.jp/'),
    '10' => array('',
                'http://www.club.t-fal.co.jp/sp/recipes/hotpot/index.html',
                'http://www.club.t-fal.co.jp/products/CA/foodprocessor/index.html',
                'http://www.t-fal.co.jp/All+Products/Cooking+Appliances/Portable+IH+Cooking+Heater/Products/compact_ih/compact_ih.htm',
                'http://www.t-fal-online.jp/index.php',
                'http://www.club.t-fal.co.jp/products/CW/pressurecookers/acticook/index.html',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
                'http://www.club.t-fal.co.jp/'),
    'e1' => array('',
                'http://www.club.t-fal.co.jp/mypage/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
                'http://www.club.t-fal.co.jp/'),
    '11' => array('',
                'http://www.club.t-fal.co.jp/sp/recipes/winter-sweets/index.html',
                'http://www.club.t-fal.co.jp/campaign/airforce201302/index.html',
                'http://www.specialcontents.t-fal.co.jp/store/index.html',
                'http://www.club.t-fal.co.jp/products/CW/kitchengoods/index.html',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
                'http://www.club.t-fal.co.jp/'),
    '12' => array('',
                'http://www.club.t-fal.co.jp/products/CW/stackable/index.html',
                'http://www.club.t-fal.co.jp/sp/recipes/frying-pan-asian/index.html',
                'http://www.club.t-fal.co.jp/products/CW/kitchengoods/scale/index.html',
                'http://www.specialcontents.t-fal.co.jp/store/index.html',
                'http://www.club.t-fal.co.jp/mypage/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
                'http://www.club.t-fal.co.jp/'),
    '13' => array('',
                'http://www.club.t-fal.co.jp/products/CA/homebakery/mb/index.html',
                'http://www.club.t-fal.co.jp/sp/recipes/spring-party/index.html',
                'http://www.club.t-fal.co.jp/products/CE/airforcecompact/csreport/index.html',
                'http://www.youtube.com/watch?v=axiru2ykWjA&list=PLGFfRp_F-B1RrDuSQhXPBCZ_tj6laa7Ou&index=1',
                'http://www.club.t-fal.co.jp/campaign/index.html',
                'http://www.club.t-fal.co.jp/mypage/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
                'http://www.club.t-fal.co.jp/'),
    '14' => array('',
                'http://www.club.t-fal.co.jp/sp/recipes/healthy-vegetable/index.html',
                'http://www.club.t-fal.co.jp/products/CE/kettles/index.html',
                'http://www.specialcontents.t-fal.co.jp/store/index.html',
                'http://www.t-fal-online.jp/',
                'http://www.club.t-fal.co.jp/mypage/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
                'http://www.club.t-fal.co.jp/'),
    '15' => array('',
                'http://www.facebook.com/tfal.co.jp/',
                'http://www.club.t-fal.co.jp/sp/recipes/speed-cooking-summer/index.html',
                'http://www.club.t-fal.co.jp/products/CE/iron/index.html',
                'http://www.club.t-fal.co.jp/mypage/',
                'http://www.club.t-fal.co.jp/login/',
                'http://www.t-fal.co.jp/Tools/Legal+Information/Legal+Information.htm',
                'http://www.club.t-fal.co.jp/info/privacy/',
                'http://www.club.t-fal.co.jp/',
                'http://www.club.t-fal.co.jp/')
);
$t_arr = array(
    '1' => array('',
                'ダイレクトサーブスペシャルコンテンツへ',
                'レシピ特集ページへ',
                'T-fal STORE情報ページへ',
                'CLUB T-fal マイページユーザー登録はこちら',
                'T-falファンのための情報コミュニティサイト【CLUB T-fal】',
                '利用規約',
                '個人情報取扱について'),
    '2' => array('',
                '野菜が主役レシピ：ラタトゥイユ',
                '野菜が主役レシピ：トマトスープ',
                '野菜が主役レシピ：かぼちゃのとりそぼろ煮',
                '野菜が主役レシピ特集ページへ',
                '洗濯王子のアイロン基礎講座へ',
                'アイロン製品一覧へ',
                'バゲットからマカロンまで、ホームベーカリーブーランジェリー',
                'コンパクト＆スタイリッシュ、キッチンスケールオプティモ',
                'ティファールオンラインストアへ',
                'ダイレクトサーブスペシャルサイトへ',
                'CLUB T-fal  マイページ ユーザー登録はこちら',
                'T-falファンのための情報コミュニティサイト【CLUB T-fal】',
                '利用規約',
                '個人情報取扱について',
                'マイページログイン'),
    '3' => array('',
                '新製品情報 エアフォースコンパクト',
                'レシピ特集 初夏のおつまみ',
                'ティファールからの提案　ポップアップトースター',
                'ティファールからの提案　電気ケトル',
                'アイロン体験イベント',
                'ダイレクトサーブ',
                'プレゼントキャンペーンへの応募',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal'),
    '4' => array('',
                '「ダイレクトサーブ」 モニターキャンペーン',
                'レシピ特集 夏のスタミナレシピ',
                'ラクラクアイロン上達！キャンペーン',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal'),
    '5' => array('',
                'レシピ特集 夏の絶品スイーツ',
                'スティックミキサー',
                'ラクラクアイロン上達！キャンペーン',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal',
    			'CLUB T-fal 画像リンク'),
    '6' => array('',
                'コードレス スチームアイロン「フリームーブ」',
                'キャンペーン「味覚の一週間 BENTOコンクール」',
                'フードプロセッサー「ミニプロ」',
                'レシピ特集「きのこ三昧」',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal',
    			'CLUB T-fal 画像リンク'),
    '7' => array('',
                'コーヒーメーカー「ダイレクトサーブ」',
                'レシピ特集「フライパンだけでつくるお手軽レシピ」',
                'キッチンタイマー「プティ」',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal',
    			'CLUB T-fal 画像リンク'),
    '8' => array('',
                'レシピ特集「時短＆こくうまレシピ」',
                'イベント情報「ＢＥＮＴＯコンクール」',
                '新製品CM',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal テキストリンク',
                'CLUB T-fal 画像リンク'),
    '9' => array('',
                'アクティクック',
                '取っ手の取れる調理器具でパーティレシピ',
                'レシピランキング01：ケークサレ',
                'レシピランキング02：豚肉の角煮',
                'レシピランキング03：マカロン',
                'レシピランキング04：ナスのミートソースグラタン',
                'レシピランキング05：ハンバーグ',
                'レシピランキング06：チョコレートケーキ',
                'ダイレクトサーブキャンペーン：製品特設サイト',
                'ダイレクトサーブキャンペーン：オンラインストア',
                'バナー：ケトル',
                'バナー：エアフォースコンパクト',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal テキストリンク',
                'CLUB T-fal 画像リンク'),
    '10' => array('',
                'レシピ特集「しめも美味しい手作り鍋レシピ」',
                '製品情報「ミニプロ」',
                '製品情報「コンパクトIH」',
                'オンラインストア',
                'コラム：アクティクック',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal テキストリンク',
                'CLUB T-fal 画像リンク'),
    'e1' => array('',
                'エアフォースコンパクト100世帯モニターキャンペーン',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal テキストリンク',
                'CLUB T-fal 画像リンク'),
    '11' => array('',
                'レシピ特集「元気になるスイーツレシピ」',
                'キャンペーン情報「エアフォースコンパクトモニターキャンペーン」',
                'アウトレットストア情報',
                'コラム：オプティモ・プティ',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal テキストリンク',
                'CLUB T-fal 画像リンク'),
    '12' => array('',
                '新製品情報「インジニオ・ネオ」',
                'レシピ情報「アジアンレシピ」',
                '新製品情報「オプティモ」',
                'ストア情報',
                'プレゼント',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal テキストリンク',
                'CLUB T-fal 画像リンク'),
    '13' => array('',
                'マイブレッド',
                '春から初夏のおもてなしレシピ',
                'エアフォースモニターレポート',
                'CM Youtube',
                '使ってなっとくキャンペーン',
                'プレゼント',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal テキストリンク',
                'CLUB T-fal 画像リンク'),
    '14' => array('',
                'スチームクッカーレシピ特集',
                '電気ケトル',
                'ストア情報',
                'オンラインストア情報',
                'プレゼント',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal テキストリンク',
                'CLUB T-fal 画像リンク'),
    '15' => array('',
                'Facebook',
                'レシピ特集',
                'アイロン',
                'プレゼント',
                '登録変更の手続き',
                '利用規約',
                '個人情報取扱について',
                'CLUB T-fal テキストリンク',
                'CLUB T-fal 画像リンク')

);
if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    if(isset($_GET['c']) && is_numeric($_GET['c']) && isset($_GET['d']) && !empty($_GET['d'])){
        
        $stmt = new DB_Conn_PDO();
        
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
            $ref = $_SERVER['HTTP_REFERER'];
        }else{
            $ref = '';
        }
        
        if(empty($u_arr[$_GET['d']][$_GET['c']]) || empty($t_arr[$_GET['d']][$_GET['c']])){
            header("Location:http://www.club.t-fal.co.jp/");
            exit;
        }
        
        $sql_str = "insert into tf_Log (log_type,s_date,s_url,s_type,s_id,s_keyword,s_ip,s_agent,u_id,s_category,s_genre,s_level,s_page,s_referer) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $sql_arr = array('3',TIME_NOW,$u_arr[$_GET['d']][$_GET['c']],'mm',$_GET['d'],$t_arr[$_GET['d']][$_GET['c']],$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],'0','','','','',$ref);
        
        try{
			$result = $stmt->PreparedState($sql_str,$sql_arr);
		}catch(PDOException $e){
			var_dump($e->getCode(), $e->errorInfo, $e->getMessage());
			die();
		}
		if($result){
            header("Location:".$u_arr[$_GET['d']][$_GET['c']]);
            exit;
        }
    }else{
        header("Location:http://www.club.t-fal.co.jp");
        exit;
    }
}