<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/request.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
use request\post,security\control;

control::loginControl();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(@$_POST['type']=='Confirm'){
        $error["status"]=0;
        $error["title"]="Hata";
        $error["text"]="Hata Meydana Geldi";
        $error["icon"]="error";
        $succes["status"]=1;
        $succes["title"]="Başarılı";
        $succes["text"]=" Paket Onaylama   Basarılı";
        $succes["icon"]="success";
        if(post::referanceProc($_POST['referanceId'],1)){
            post::arrayTojsonMessage($succes);
        }else{
            post::arrayTojsonMessage($error);
        }
    }
    if(@$_POST['type']=='Cancel'){
        $error["status"]=0;
        $error["title"]="Hata";
        $error["text"]="Hata Meydana Geldi";
        $error["icon"]="error";
        $succes["status"]=1;
        $succes["title"]="Başarılı";
        $succes["text"]="Package İptal Edildi";
        $succes["icon"]="success";
        if(post::referanceProc($_POST['referanceId'],2)){
            post::arrayTojsonMessage($succes);
        }else{
            post::arrayTojsonMessage($error);
        }


    }
}else{
    die("error");
}




?>