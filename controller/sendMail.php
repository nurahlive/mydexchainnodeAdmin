<?php
namespace sendMail{
    class nmail{

        public static function noIdlePrivateServer($msg=null){
            echo "Boşta kurululacak özel sunucu yok";
            echo "mail mesaji : $msg";
        }
        public static function noIdleGeneralServer($msg=null){
            echo "Boş Normal Sunucu Yok Mail  at";
            echo "mail mesaji : $msg";
        }
        public static function noIdleMasterPoolKey($msg=null){
            echo "Boşta Pool Yok";
            echo "mail mesaji : $msg";
        }
    }
}


?>