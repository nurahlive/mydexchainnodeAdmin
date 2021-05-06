<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/request.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
use request\post,security\control;
control::loginControl();




if(strlen(trim($_POST['servisIp']))>2  and strlen($_POST['servisPort'])>0){
     $servisAdd=post::servisAdd($_POST);
    if ($servisAdd['status'])
    {
        $succes["status"]=1;
        $succes["title"]=$servisAdd['title'];
        $succes["text"]=$servisAdd['text'];
        $succes["icon"]=$servisAdd['icon'];
        post::arrayTojsonMessage($succes);
    }else{
        $error["status"]=0;
        $error["title"]=$servisAdd['title'];
        $error["text"]=$servisAdd['text'];
        $error["icon"]=$servisAdd['icon'];

        post::arrayTojsonMessage($error);
    }
}else{
    $error["status"]=0;
    $error["title"]="Hata";
    $error["text"]="Eksik Bilgiler";
    $error["icon"]="error";
    post::arrayTojsonMessage($error);

}









?>