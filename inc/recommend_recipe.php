<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

if($_SERVER['REQUEST_METHOD'] === "GET"){
    CW_Loader::loadClass('getRecipe',C_ROOT);
    CW_Loader::loadClass('getToprecipe',C_ROOT);
    View::$NewsData = getToprecipe::getRecipeForTops('4');
    
}
View::loadTmpl('View'.DIRECTORY_SEPARATOR.'recipe_recommend_area.html', T_ROOT, true);

