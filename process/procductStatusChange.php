<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/request.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
use request\post,security\control;
control::loginControl();

$error["status"]=0;
$error["title"]="Hata";
$error["text"]="Hata Meydana Geldi";
$error["icon"]="error";
$succes["status"]=1;
$succes["title"]="Başarılı";
$succes["text"]="Ekleme Basarılı";
$succes["icon"]="success";


    if (post::productChangeStatus($_POST)==true)
    {
        post::arrayTojsonMessage($succes);
    }else{

        post::arrayTojsonMessage($error);
    }










?>