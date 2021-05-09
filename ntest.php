<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "controller/control.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "controller/data.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "controller/crons.php");
use security\control,data\liste,crons\cronNoder;
control::loginControl();

 $pool=cronNoder::getActivePoolKey();
   print_R($pool);


exit();

$test=array(

    "assd"=>5,
    "assdd"=>5
);
$json=json_decode(json_encode($test));
 if(!empty($json->as)){
     echo "  şart 1";
 }else{
     echo " else değeri";
 }
//print_r($json);
exit();


$zaman=nextdate(2,date("Y-m-d H:i:s"));
exit();

echo "Zaman  :".  date("Y-m-d H:i:s");
exit();
print_R(liste::getAdmUserName(1));
exit();
$dizi=[];
$n=5;

print_R(data\liste::dailyEarningTotal() );
exit();
 for($k=1;$k<=3;$k++){
     if(empty($dizi[$n])) {
         echo "s";
         $dizi[$n]=0;
     }
$dizi[$n]=$dizi[$n]+$k;
}
 print_r($dizi);

 //echo data\liste::dailyPaymentFuture("6") ;