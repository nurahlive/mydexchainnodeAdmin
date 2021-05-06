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
$succes["status"]=1;
$succes["title"]="Başarılı";
$succes["text"]="Ekleme Basarılı";
$succes["icon"]="success";

if($_POST){



    if (nc::masterTrakerPollSave($_POST)==true)
    {
        post::arrayTojsonMessage($succes);
    }else{

        post::arrayTojsonMessage($error);
    }
}else{
    post::arrayTojsonMessage($error);
    die();
}









?>