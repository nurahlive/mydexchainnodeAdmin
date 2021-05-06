<?php
namespace  config{

    class mysqlConfig{
        static  $mysqlHost="localhost";
        static  $mysqlUser="nurahtest";
        static  $mysqlPasword="nurahtest";
        static $mysqldatabase="dockersales";
        static $mysqlPort="3306";


    }
    class  siteConfig {
        static $domain="admin.dockersales.nurah.com";


    }

class themes{
    static $AllowedFilesType = array("image/png");
    static $AllowedExtension=array("png");
    static  $ImageMainBasePath="/sanalphp/coin/coinInvestImage/";
    static $ImagePathPublic="http://coin.nurah.com/coinInvestImage/";
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