<?php

require_once "../../cgi-data/Recipe/class/BootLoader.php";

CW_Loader::loadClass('View', C_ROOT.DIRECTORY_SEPARATOR."View");
$chk = CW_Loader::getInstance('InitializeForm', C_ROOT.DIRECTORY_SEPARATOR."Form");

$error_msg = array();

if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    CW_Loader::loadClass('getRecipe',C_ROOT);
    View::$NewsData = getRecipe::getRecipeKeyword('3');
    if(isset($_GET['disp']) && $_GET['disp'] === "search"){
        $tmpl = 'recipe_keyword_for_search';
    }else{
        $tmpl = 'recipe_keyword';
    }
}
View::loadTmpl('View'.DIRECTORY_SEPARATOR.$tmpl.'.html', T_ROOT, true);

