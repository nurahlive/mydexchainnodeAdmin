<?php
require_once __DIR__."/config/config.php";
require_once __DIR__."/controller/request.php";
require_once __DIR__."/controller/control.php";
require_once __DIR__."/controller/auth.php";
use  config\themes,request\get,security\control,auth\nsession;

nsession::sessionStart();


if(@array_keys(@$_GET)[0]=="login"){
    get::menu(@$_GET);

}
if(control::statusControl()===false){
    control::yonlen("?login");

}else {
    require_once  $_SERVER['DOCUMENT_ROOT'] ."/".themes::themeBaseDirectory()."/".themes::themeActiveDirectory()."/header.php";
    //require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");

    get::menu(@$_GET);
    require_once  $_SERVER['DOCUMENT_ROOT'] ."/".themes::themeBaseDirectory()."/".themes::themeActiveDirectory()."/footer.php";
//get::menu(@array_keys($_GET)[0]);
    /*
     print_r($_REQUEST);
    echo "   <hr>";
    get::menu($_GET);
     * */
    // require_once  __DIR__."/footer.php";
}



?>