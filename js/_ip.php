<?php

if($_SERVER['REMOTE_ADDR'] !== "122.216.29.18" && $_SERVER['REMOTE_ADDR'] !=="211.13.205.134" && $_SERVER['REMOTE_ADDR'] !== "210.249.95.113"){
    //header("Location:http://www.club.t-fal.co.jp/mybread_teser.html");
    echo 'location.href="http://www.club.t-fal.co.jp/mybread_teser.html"';
    exit;
}

//header("Content-type: application/x-javascript");

/*
header("Content-Type: application/json; charset=UTF-8");
header("X-Content-Type-Options: nosniff");
echo  json_encode(array('ip',$_SERVER['REMOTE_ADDR']), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
   
*/
/*
*/