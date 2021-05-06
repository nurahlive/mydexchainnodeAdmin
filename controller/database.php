<?php
 namespace  ndatabase{
    // require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/config/config.php");
     require_once(dirname( __DIR__) . DIRECTORY_SEPARATOR . "/config/config.php");
     use config\mysqlConfig;

     class nmysql{
         static $db=null;
         static $charset="UTF-8";

         public function  __construct()
         {

             try {
                 @self::$db = new \PDO('mysql:host=' . mysqlConfig::$mysqlHost . ';port=' . mysqlConfig::$mysqlPort . ';dbname=' . mysqlConfig::$mysqldatabase, mysqlConfig::$mysqlUser, mysqlConfig::$mysqlPasword);


                 @self::$db->exec('SET NAMES `' . self::$charset . '`');
                 @self::$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

             } catch (\PDOException $e) {
                 echo "<br><font color='#F00'><strong>Local Sql Server not Connect. </strong></font>";
                 exit();
             }
             return self::$db;
         }
         public function update($sql,$arrayValue){
             $update= self::$db->prepare($sql);

             if(  $update->execute($arrayValue)){
                 return true;
             }else{
                 return false;
             }
         }
         public function delete($sql,$arrayValue){
             $update= self::$db->prepare($sql);
             $update->execute($arrayValue);
             return $update;
         }
         public function insert($sql,$arrayValue){
              $sql=self::$db->prepare($sql);
              if($sql->execute($arrayValue)){
                  return true;
              }else{
                  return false;
              }
         }
         public function databaseRecordCount($sql,$arg){
             $db= new nmysql();
             $data=$db::$db->prepare($sql);
             $data->execute($arg);
             return $data->rowCount();
         }
         public function query($sql,$fetch='one',$arrayValue=Null)
         {
             // $fetch   one  :  one record  all: get  full record;
             $query= self::$db->prepare($sql);
             $query->execute($arrayValue);
            if($fetch=='all'){
                return $query->fetchAll();
            }else{
                return $query->fetch();
            }
         }


     }
 }
?>