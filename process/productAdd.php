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

if(strlen(trim($_POST['productName']))>2  and strlen($_POST['amount'])>0){
    if (nc::productAdd($_POST)==true)
    {
        post::arrayTojsonMessage($succes);
    }else{

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