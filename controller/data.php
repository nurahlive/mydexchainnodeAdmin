<?php
namespace  data{
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");
<<<<<<< HEAD
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
=======
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/crons.php");
    use ndatabase\nmysql,crons\earning;

    class liste {

        public static function ipUsersCount(int $mainUser, int $subUser){
            $db=new nmysql();

            //SELECT * FROM `iplist` WHERE userId='1' or userId='24'
            //SELECT DISTINCT ip FROM `iplist` where userId='1'
            $mainUserSql="select DISTINCT ip from iplist where userId=:userId";
            $mainUserArg=[
                "userId"=>$mainUser
            ];
             $mainUserData=$db->query($mainUserSql,"all",$mainUserArg);
           //  print_R($mainUserData);
            $subUserSql="select DISTINCT ip from iplist where userId=:userId";
            $subUserArg=[
                "userId"=>$subUser
            ];
            $subUserData=$db->query($subUserSql,"all",$subUserArg);
            //echo "<br>";
           // print_R($subUserData);
           // echo "<hr>";
            $catchIp=0;
            foreach ($mainUserData as $mainLine){
                foreach ($subUserData as $subLine){
                    if($mainLine->ip==$subLine->ip){
                       //echo "yakalandi <br>";
                        $catchIp=$catchIp+1;

                    }

                }
            }
   //echo "<br>  cartc $catchIp";
            return $catchIp;

        }
>>>>>>> b05cee1d97e6c0896ce44ecff90ed8d49ed7fdd3
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

<<<<<<< HEAD
=======
        public static function onholdWitdrawTotalBalance($coinId){
            $db= new nmysql();
            $arg=["coinId"=>$coinId];
            $sql="select sum(amount) as total from witdraws where coinId=:coinId and status='0'";
            return  $db->query($sql,"one",$arg)->total;
        }

         public static function dailyEarningTotal(){
             $db=new nmysql();
             $returnArray=[];
             $sql="select totalInterest,packageDay,minInvestAmount,coinType from membersPackets,investPackets where   membersPackets.status='1' and membersPackets.investPacketsId=investPackets.packageId";
             foreach ($db->query($sql,"all") as $line){
                 if(empty($returnArray[$line->coinType])) {
                     $returnArray[$line->coinType]=0;
                 }
                 $dailyEarling = (((100 + $line->totalInterest) / $line->packageDay) * $line->minInvestAmount) / 100;
                 $returnArray[$line->coinType]=$returnArray[$line->coinType]+$dailyEarling;
             }
>>>>>>> b05cee1d97e6c0896ce44ecff90ed8d49ed7fdd3









    }
}
?>