<?php
namespace  config{

    class mysqlConfig{
        static  $mysqlHost="localhost";
        static  $mysqlUser="nurah";
        static  $mysqlPasword="Nurah42501@";
        static $mysqldatabase="coinmaster";
        static $mysqlPort="3306";


    }
    class  siteConfig {
        static $domain="nadmin.coinwinstrader.com";


    }

class themes{
    static $AllowedFilesType = array("image/png");
    static $AllowedExtension=array("png");
    static  $ImageMainBasePath="/var/www/coinwinstrader.com/coinInvestImage/";
    static $ImagePathPublic="https://www.coinwinstrader.com/coinInvestImage/";
        static    $themeBasePath="themes";
        static $themePath="adminLte3";
        public static function  themeActiveDirectory(){
            return self::$themePath;
        }
        public static  function  themeBaseDirectory(){
            return self::$themeBasePath;
        }

    }
}


?>