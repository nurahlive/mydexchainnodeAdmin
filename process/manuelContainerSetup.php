<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/request.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/np.php");
use request\post,security\control,np\nc;
control::loginControl();

$error["status"]=0;
$error["title"]="Hata";
$error["text"]="Hata Meydana Geldi";
$error["icon"]="error";


if($_POST){


     $manuelContainerSetup=nc::manuelContainerSetup($_POST);

    if ($manuelContainerSetup['procStatus']=true)

    {
        $succes["status"]=$manuelContainerSetup['status'];
        $succes["title"]=$manuelContainerSetup['title'];
        $succes["text"]=$manuelContainerSetup['text'];
        $succes["icon"]=$manuelContainerSetup['icon'];
        post::arrayTojsonMessage($succes);
    }else{
        $error["status"]=$manuelContainerSetup['status'];
        $error["title"]=$manuelContainerSetup['title'];
        $error["text"]=$manuelContainerSetup['text'];
        $error["icon"]=$manuelContainerSetup['icon'];

        post::arrayTojsonMessage($error);
    }
}else{
    post::arrayTojsonMessage($error);
    die();
}









?>