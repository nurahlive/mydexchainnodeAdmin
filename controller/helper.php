<?php
namespace  helper {
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "controller/auth.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "config/config.php");
use auth\nsession,config\siteConfig;
    class  message{
        public static function routeLogin($path){
            header("location: $path");

        }
        public static  function   arrayTojsonMessage($messege){
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($messege);
        }
    }
    class tools{
        public  static function refererControl(){
            if(isset($_SERVER['HTTP_REFERER'])){
                if (strpos($_SERVER['HTTP_REFERER'],siteConfig::$domain) === false) {
                    return false;
                } else {
                    return true;
                }
            }else{
                return false;
            }
        }
        public static function crsfTokenCreate($tokenName){
            nsession::sessionStart();
            // $token=bin2hex(random_bytes(32));
            $_SESSION[$tokenName]=bin2hex(random_bytes(32));;
            return $_SESSION[$tokenName];
        }
        public static function crsfTokenControl($TokenName){
            nsession::sessionStart();
            if (empty($_SESSION[$TokenName])) {
                $_SESSION[$TokenName] = self::crsfTokenCreate();
            }
        }
        public static function crsfTokenadd($TokenName){
            $_SESSION[$TokenName] = self::crsfTokenCreate();
        }
        public static function crsfControl($tokenName,$formData){
            nsession::sessionStart();

            if (hash_equals($_SESSION[$tokenName], $formData)) {
                $_SESSION[$tokenName]=self::crsfTokenCreate($tokenName);
                return true;
                // Proceed to process the form data
            } else {
                return false;
            }

        }
        public static  function   arrayTojsonMessage($messege){
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($messege);
        }
        public static function dateDiff($time1,$time2){
            $date1= new \DateTime($time1);
            $date2= new \DateTime($time2);
            $interval= $date1->diff($date2);
            $datediff= $interval->format('%R%a');
            $returnDate=[];
            $returnDate['time']=$datediff;
            $returnDate['timeType']="Days";
            return json_decode(json_encode($returnDate));
        }
    }
}
?>