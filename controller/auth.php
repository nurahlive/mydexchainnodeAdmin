<?php
namespace auth{
    class  nsession{
        public static  function   createLoginSession($data){
            self::session_start();
            $_SESSION['ademail']=$data->mail;
            $_SESSION['adid']=$data->admId;
            $_SESSION['adusername']=$data->username;
            $_SESSION['adlaravel']=md5(rand(0,100));
        }
        public static function session_start(){
            if(session_id() === "") session_start();
        }
        public static function sessionStart(){
            if(!isset($_SESSION)){
                session_start();
            }
        }
        public static function sessionControl($path)
        {
            if(!isset($_SESSION['email']) and !isset($_SESSION['id'])){
                header("location: $path");
            }
        }
        public static function nsesControl(){
            if(!isset($_SESSION['email']) and !isset($_SESSION['admId'])){
                return false;
            }
            else{
                return true;
            }
        }

    }
    class login{

    }
}
?>