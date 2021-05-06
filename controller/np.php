<?php
 namespace np{
     require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");
     require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/request.php");
     require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/docker.php");

     use helper\message;
     use ndatabase\nmysql,request\post,dockerSpace\docker;
     class nc{
         public static function manuelContainerSetup($data){
             $db = new  nmysql();
             sleep(2);
             $server=self::getServer(intval($data['setupServer']));
             //print_r($server);
             $conatinerName=trim($data['containerName']);
             //print_R($data);
             if($data['setupType']==0){// normal Kurulum
                 $normalContainerJson=self::manuelContainerJson(trim($data['startPort1']),trim($data['startPort2']),trim($data['startPort3']),trim($data['startPort4']));
                 $dockerData = docker::containerCreate($conatinerName, $server->serverIp, $server->serverPort, json_encode(json_decode($normalContainerJson)));
                 if(!empty(json_decode($dockerData)->Id)){
                 $dockerId = json_decode($dockerData)->Id;

                 $dockerRunData = docker::containerRun($server->serverIp, $server->serverPort, $dockerId);
               //  echo "rundata";  print_R($dockerRunData);
                 $returnStr="";
                 $returnStr=$returnStr."Container ". json_decode($dockerData)->message;
                 $returnStr=$returnStr+"Container Id : $dockerId";


                 $succes["status"]=1;
                 $succes["procStatus"]=true;
                 $succes["title"]="Başarılı";
                 $succes["text"]=$returnStr;
                 $succes["icon"]="success";
                 return $succes;
                 }else  {
                     $returnStr="";
                     $returnStr=$returnStr."Container ".json_decode($dockerData)->message;
                     $returnStr=$returnStr."Container Id :  Kurulum Yapılamadı";

                     $succes["status"]=0;
                     $succes["procStatus"]=false;
                     $succes["title"]="Başarılı";
                     $succes["text"]=$returnStr;
                     $succes["icon"]="error";
                     return $succes;
                 }

             }else{ // master traker pool Kurulumu
                 $normalContainerJson=self::manuelContainerJson(trim($data['startPort1']),trim($data['startPort2']),trim($data['startPort3']),trim($data['startPort4']),0,0,1024,0);
                 $dockerData = docker::containerCreate($conatinerName, $server->serverIp, $server->serverPort, json_encode(json_decode($normalContainerJson)));

                 if(!empty(json_decode($dockerData)->Id)){
                 $dockerId = json_decode($dockerData)->Id;
                 $dockerRunData = docker::containerRun($server->serverIp, $server->serverPort, $dockerId);
                     $returnStr="";
                     $returnStr=$returnStr."Container ". json_decode($dockerData)->message;
                     $returnStr=$returnStr."Container Id : $dockerId";
                 $succes["status"]=1;
                 $succes["procStatus"]=true;
                 $succes["title"]="Başarılı";
                 $succes["text"]=$returnStr;
                 $succes["icon"]="success";
                 return $succes;
                 }
                 else  {
                     $returnStr="";
                     $returnStr=$returnStr."Container ". json_decode($dockerData)->message;
                     $returnStr=$returnStr."Container Id : Kurulum Yapılamadı";
                     $succes["status"]=0;
                     $succes["procStatus"]=false;
                     $succes["title"]="Başarılı";
                     $succes["text"]=$returnStr;
                     $succes["icon"]="error";
                     return $succes;
                 }

             }

         }
         public static function getServer($serverid){
             $db=new  nmysql();
             $sql="select * from servers where serverId=:serverId";
             $arg=['serverId'=>$serverid];
             return $db->query($sql,"one",$arg);
         }
          public static function masterTrakerPollSave($data)
          {
              $db = new nmysql();
              $countSql = "select * from masterTrakerPool where serverId=:serverId";
              $countArg = ["serverId" => $data['masterPoolServer']];
              if ($db->databaseRecordCount($countSql, $countArg) > 0) {

                  return false;

              } else {

              $sql = "insert into masterTrakerPool(masterTrakerPoolName,poolApiKey,comment,serverId,status) 
values(:masterTrakerPoolName,:poolApiKey,:comment,:serverId,:status)";
              $arg = [
                  "masterTrakerPoolName" => $data['masterTrakerPoolName'],
                  "poolApiKey" => trim($data['masterTrakerPoolKey']),
                  "serverId" => $data['masterPoolServer'],
                  "comment" => $data['masterPoolComment'],
                  "status" => $data['poolStatus'],
              ];
              if ($db->insert($sql, $arg)) {
                  return true;
              } else {
                  return false;
              }
          }

          }

         // private server node start;
         public static function specialProductList(){
             $db= new nmysql();
             $sql="select * from product where productType='1'";
             return $db->query($sql,"all");
         }
         public static function privateServerSetup($data){
             $db= new nmysql();
             $getProduct=self::getProduct(intval($data['productId']));
                 // private Node Tanımlama Start;
                 // servis tanimlama start;
                 $serviceDate=self::nextdate(intval($data['serverPeriod']));
                 $serviceAdd=self::serviceAdd(intval($data['productId']),intval($data['members']),$serviceDate,$data['dextrakerNumber'],0);
                 //$serviceAdd    false değilse  servis id  gönderir
                 if($serviceAdd==false){
                     return false;
                 }else{
                     //  eklenecek  node Sayisi =  urun  * aldiği değer
                     $nodeSayısı=$getProduct->DockerCount*$data['quantity'];

                     for($df=1;$df<=$nodeSayısı;$df++)
                     {
                         if( (self::nodeAdd($serviceAdd))){
                             // echo "$serviceAdd servisli node oluşturuldur";
                         }else{
                             return false;
                         }
                     }
                     return true;
                 }

             //  private  node tanımlama ende;

         }
         // private server node  ende;
           public static  function serverUseNodeCount($serverId){
               $db= new nmysql();
               $sql="select *  from noder where serverId=:serverId";
               $arg=["serverId"=>$serverId];
               return $db->databaseRecordCount($sql,$arg);
           }
          public static function privateServerList(){
              $db= new  nmysql();
              $sql="select * from servers where serverType='1'";
              return $db->query($sql,"all");
          }
         public static function masterPoolServerList(){
             $db= new  nmysql();
             $sql="select * from servers where serverType='2'";
             return $db->query($sql,"all");
         }
         public static function masterPoolKeyList(){
             $db= new  nmysql();
             $sql="select * from servers,masterTrakerPool where servers.serverType='2'  and servers.serverId=masterTrakerPool.serverId";
             return $db->query($sql,"all");
         }
         public static  function memberlist(){
             $db= new nmysql();
             $sql="select * from members";
             return $db->query($sql,"all");
         }
         public static function  nodeAdd($servisId){
             $db= new nmysql();
             $sql="insert into noder(servisId) values(:servisId)";
             $arg=["servisId"=>$servisId];
             if($db->insert($sql,$arg)){
                 return true;
             }else{
                 return false;
             }
         }
        public static function  nextdate($nextMonth,$date=null){
             if($date==null){
                 $date = new \DateTime();
             }else{
                 $date = new \DateTime($date);
             }
             $date->modify('+'.$nextMonth.' month');
             $zaman=$date->format('Y-m-d H:i:s');
             return $zaman;
         }
         public static  function serviceAdd($productId,$memberId,$endate,$dexchainTrakeCode,$status=0){
             $db= new nmysql();
             $sql="INSERT INTO services(productId,memberId,status,endDate,dexchainTrakeCode)  VALUES(:productId,:memberId,:status,:endDate,:dexchainTrakeCode) ";
             $arg=[
                 "productId"=>intval($productId),
                 "memberId"=>intval($memberId),
                 "endDate"=>$endate,
                 "status"=>$status,
                 "dexchainTrakeCode"=>$dexchainTrakeCode
             ];
             if($db->insert($sql,$arg)){
                return  $db::$db->lastInsertId();
             }else{

                 return false;
             }
         }
          public static  function orderok($orderid){
             $db = new nmysql();
             //UPDATE `` SET `status` = '1' WHERE `orders`.`orderId` = 2;
             $sql="update orders set status=1, ConfirmedDate=:ConfirmedDate where orderId=:orderId";
             $arg=[
                 "orderId"=>$orderid,
                 "ConfirmedDate"=>date("Y-m-d H:i:s")
             ];
              if($db->update($sql,$arg)){
                  return true;
              }else{
                  return false;
              }
          }
          public static  function getService($serviceId){
             $db= new nmysql();
             $sql="select * from services where servisId=:servisId";
             $arg=["servisId"=>$serviceId];
             return $db->query($sql,"one",$arg);
          }
          public static function serviceExtendTime($serviceId,$extendMonth){
             $db=new nmysql();
             $getService=self::getService($serviceId);
             $nextdate=self::nextdate($extendMonth,$getService->endDate);
            // $sql="update services set endDate=:endDate where servisId=:servisId";
             $sql="update services set endDate=:endDate where servisId=:servisId";
             $arg=[
                 "endDate"=>$nextdate,
                 "servisId"=>$serviceId
             ];
             if($db->update($sql,$arg)){
                 return true;
             }else{
                 return false;
             }
          }
         public static function orderConfirm($orderId){
             $db= new nmysql();

             $getorder=self::getOrder($orderId);
             $getProduct=self::getProduct($getorder->productId);
            // print_R($getProduct);

             //  print_R($getorder);
                if($getorder->orderType==0 and $getorder->servisId*1<1)
                {
                    // servis tanimlama start;
                    $serviceDate=self::nextdate($getorder->periods);
                     $serviceAdd=self::serviceAdd($getorder->productId,$getorder->memberId,$serviceDate,$getorder->dexchainTrakeCode,0);
                     //$serviceAdd    false değilse  servis id  gönderir
                     if($serviceAdd==false){
                         return false;
                     }else{

                         //  eklenecek  node Sayisi =  urun  * aldiği değer
                         $nodeSayısı=$getProduct->DockerCount*$getorder->quantity;
                         $error=true;

                         for($df=1;$df<=$nodeSayısı;$df++)
                         {
                        if( (self::nodeAdd($serviceAdd))){
                           // echo "$serviceAdd servisli node oluşturuldur";
                        }else{
                          return false;
                        }
                         }
                         if(self::orderok($orderId)){
                             return true;
                         }else{
                             return false;
                         }

                     }

                }else{
                     //  servis süresi uzatman start;
                    if(self::serviceExtendTime($getorder->servisId,$getorder->periods)){
                        if(self::orderok($orderId)){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }

                     //  servis süresi uzatman  ende;
                }

         }
          public static function getOrder($orderId){
             $db= new nmysql();
             $sql="select * from orders where orderId=:orderId";
             $arg=["orderId"=>$orderId];
             return $db->query($sql,"one",$arg);
          }
          public static function getuser($userId){
              $db= new nmysql();
              $sql="select * from members where memberId=:memberId";
              $arg=["memberId"=>$userId];
              return $db->query($sql,"one",$arg);
          }
         public static  function orderList(){
             $db=new nmysql();
             $sql="select * from orders";
             return $db->query($sql,"all");
         }
         public  static  function serverList(){
             $db= new nmysql();
             $sql="select * from servers";
             return $db->query($sql,"all");
         }

         public static  function serverAdd($data){
             $db=new nmysql();
             $sql="insert into servers(serverName,serverIp,serverPort,DockerCount,serverType,status,startPort1,startPort2,startPort3,startPort4,ShortServerName)
values(:serverName,:serverIp,:serverPort,:DockerCount,:serverType,:status,:startPort1,:startPort2,:startPort3,:startPort4,:ShortServerName)";
             $arg=[
                 "serverName"=>$data['serverName'],
                 "serverIp"=>$data['serverIp'],
                 "serverPort"=>intval(trim($data['serverPort'])),
                 "DockerCount"=>$data['dockerCount'],
                 "serverType"=>$data['serverType'],
                 "status"=>$data['status'],
                 "startPort1"=>$data['startPort1'],
                 "startPort2"=>$data['startPort2'],
                 "startPort3"=>$data['startPort3'],
                 "startPort4"=>$data['startPort4'],
                 "ShortServerName"=>$data['ShorName'],
             ];

             if($db->insert($sql,$arg)){

                 return true;
             }else{

                 return false;
             }

         }
         public static function getProduct($productId){
             $db = new nmysql();
             $sql="select * from product where productId=:productId";
             $arg=["productId"=>$productId];
             return $db->query($sql,"one",$arg);
         }
         public static  function productAdd($data){
             $db=new nmysql();

             $sql="insert into product(productName,amount,moneyType,DockerCount,periods,status,parexMinning) 
values(:productName,:amount,:moneyType,:DockerCount,:periods,:status,:parexMinning)";
             $arg=[
                 "productName"=>$data['productName'],
                 "amount"=>$data['amount'],
                 "moneyType"=>$data['moneyType'],
                 "DockerCount"=>$data['dockerCount'],
                 "periods"=>$data['period'],
                 "status"=>$data['status'],
                 "parexMinning"=>$data['parexMinning'],
             ];
             if($db->insert($sql,$arg)){
                 return true;
             }else{
                 return false;
             }

         }
         public static  function getMoneyType($moneyId){
             $db=new nmysql();
             $sql="select * from moneyType where moneyId=:moneyId";
             $arg=["moneyId"=>$moneyId];
             return $db->query($sql,"one",$arg);
         }
         public static  function getMoneyTypeList(){
             $db=new nmysql();
             $sql="select * from moneyType";
             return $db->query($sql,"all");
         }
         // docker jsons start;
         public static function  manuelContainerJson($port1,$port2,$port3,$port4,$Memory=300000000,$memoryreservation=200000000,$CpuShares=512,$CpuQuota=6000){
             $json3='
{
     
       "Domainname": "",
        
        "AttachStdin": true,
        "AttachStdout": true,
        "AttachStderr": true,
        "Tty": true,
        "OpenStdin": true,
        "StdinOnce": true,
        "Env":[
"PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin",
"TZ=Europe/Istanbul",
"LANG=en_US.UTF-8",
"LANGUAGE=en_US:en",
"LC_ALL=en_US.UTF-8",
"vol=/var/lib/postgresql"
],
        "ExposedPorts":{
"2020/tcp":{
},
"3030/tcp":{
},
"5432/tcp":{
},
"80/tcp":{
}
},
    "Env": [
    "FOO=bar",
    "BAZ=quux"
    ],
    "Cmd": ["/startup.sh"],
"WorkingDir":"",
"Entrypoint":[
"/startup.sh"
],
"Image": "mydexchain/mydexchain:latest",
"Volumes":{
"/etc/postgresql":{
},
"/var/lib/postgresql":{
},
"/var/log/postgresql":{
}
},


"StopSignal": "SIGTERM",
"StopTimeout": 10,
"HostConfig": {
"RestartPolicy": { "Name": "always" },
"Memory": '.$Memory.',
"memory-reservation":'.$memoryreservation.',
"MemorySwap": 0,
"MemorySwap": 0,
"MemoryReservation": 0,
"KernelMemory": 0,
"CpuShares": '.$CpuShares.',
"CpuQuota": '.$CpuQuota.',
"NetworkMode":"default",

"PortBindings": {
"2020/tcp": [
{
"HostPort": "'.trim($port1).'"
}
],
"3030/tcp": [
{
"HostPort": "'.trim($port2).'"
}
],
"5432/tcp": [
{
"HostPort": "'.trim($port3).'"
}
],
"80/tcp": [
{
"HostPort": "'.trim($port4).'"
}
]
}
}
}
';

             return $json3;
         }

         // docker jsons  ende;
     }

 }
?>