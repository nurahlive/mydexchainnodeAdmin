<?php
namespace   security{
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/auth.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");

    use  auth\nsession,ndatabase\nmysql;

    class control extends  nsession{

        public static function  loginControl(){
            self:self::start();
            if(self::statusControl()===false){
                self::yonlen("/?login");
            }
        }
        public static function yonlen($path){
            header("location: $path");

        }
        public  static function  start(){
            if(!isset($_SESSION) or session_id() === ""){
                session_start();
            }
        }

        public static  function statusControl(){
            if(!isset($_SESSION['ademail']) and !isset($_SESSION['id'])){
                return false;
            }
            else{
                return true;
            }
        }
        public static function logout(){
            self::start();
            session_destroy();
            self::yonlen("/?login");
        }

    }
}
?>