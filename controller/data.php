<?php
namespace  data{
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/request.php");
    use ndatabase\nmysql,request\post;

    class liste {
        public static function ServiceList(){
            $db = new nmysql();
            $sql="select * from services";
            return $db->query($sql,"all");
        }
        public static function userServiceList(int $userId){
            $db = new nmysql();
            $sql="select * from services where userId=:userId";
            $arg=["userId"=>$userId];
            return $db->query($sql,"all",$arg);
        }
         public static function orderServisCount($orderId){
             $sql="select * from services  where orderId=:orderId";
             $arg=["orderId"=>$orderId];
             return post::databaseRecordCount($sql,$arg);
         }
        public static function getUserName($userId){
            $db=  new nmysql();
            $sql="select memberName from members where memberId=:memberId";
            $arg=["memberId"=>$userId];
            return $db->query($sql,"one",$arg)->memberName;
    }

         public static function getAdmUserName($admId){
             $db= new nmysql();
             $sql="select username from adm where admId=:admId";
             $arg=['admId'=>$admId];
             return $db->query($sql,"one",$arg)->username;
         }










    }
}
?>