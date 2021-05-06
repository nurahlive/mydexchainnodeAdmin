<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/request.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/helper.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/auth.php");
use request\post,helper\tools,auth\nsession;
nsession::sessionStart();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if(tools::refererControl()){
        if(  tools::crsfControl('loginStr',$_POST['csrf-token'])){
            if(post::loginDbControl($_POST)){
                $succes["status"]=1;
                $succes["title"]="Başarılı";
                $succes["text"]="Login Basarılı";
                $succes["icon"]="success";
                 tools::arrayTojsonMessage($succes);
            }else{
                $succes["status"]=0;
                $succes["title"]="Hata";
                $succes["text"]="Bilgiler Hatali";
                $succes["icon"]="error";
                tools::arrayTojsonMessage($succes);
                die();
            }


        }else{
            $succesa["status"]=0;
            $succesa["title"]="Hata";
            $succesa["text"]="Güvenlik Uyarısı 2";
            $succesa["icon"]="error";
            tools::arrayTojsonMessage($succesa);
             die();
        }
    }else{
        $succes["status"]=0;
        $succes["title"]="Hata";
        $succes["text"]="Güvenlik Uyarısı 1";
        $succes["icon"]="error";
        tools::arrayTojsonMessage($succes);
        die();
    }
}else{
    $succes["status"]=0;
    $succes["title"]="Hata";
    $succes["text"]="Güvenlik Uyarısı 0";
    $succes["icon"]="error";
    tools::arrayTojsonMessage($succes);
die();
}

?>