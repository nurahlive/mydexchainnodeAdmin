<?php
namespace crons{
    require_once(dirname( __DIR__) . DIRECTORY_SEPARATOR . "/controller/database.php");
    require_once(dirname( __DIR__) . DIRECTORY_SEPARATOR . "/controller/docker.php");
    require_once(dirname( __DIR__) . DIRECTORY_SEPARATOR . "/controller/sendMail.php");
    use ndatabase\nmysql,dockerSpace\docker,sendMail\nmail;
    use np\nc;

    class  cronNoder{
        static  $sshp="Nurah425";
        static  $sshAllowIp="178.18.254.57";
        public static function remoteSshAllowIp(){
            return self::$sshAllowIp;
        }

        public static function remoteSshp(){
            return self::$sshp;
        }
        public static function trakerKeyUpdate($noderId,$trakerKey){

            $db = new nmysql();
            $sql="update noder set  trackerKey=:trackerKey  where nodeId=:nodeId";
            $arg=[
                "trackerKey"=>$trakerKey,
                "nodeId"=>$noderId
            ];
            if($db->update($sql,$arg)){
                return true;
            }else{
                return false;
            }
        }
         public static function empetyTrakerKeyScan(){
             $db=new nmysql();
             //and noder.status='3
             $sql="select * from noder where trackerKey='0' and status='3'";
             $nodeData=$db->query($sql,"all");
             foreach ($nodeData as $line){
                  $server=self::getServer($line->serverId);
                 $requestUrl="http://".$server->serverIp.":".$line->port."/getTrackerKey/";
                 $getTrakerData=json_decode(self::getUrl($requestUrl));
                // print_r($getTrakerData);
                 if($getTrakerData->message=='Success'){
                     if(strlen($getTrakerData->value)>3){
                      //   print_R($getTrakerData);
                         self::trakerKeyUpdate($line->nodeId,$getTrakerData->value);
                        // echo "test10";
                        // exit();

                     }

                 }

             }

            // return $db->query($sql,"all");
         }
         public static  function serverChangePool($serverId){
             $db =new nmysql();
             $sql="select * from noder where status='4' limit 0,10";
             $activeNoderData=$db->query($sql,"all");

             foreach ($activeNoderData as $nodeline){
                 $getserver=self::getServer($nodeline->serverId);
                 $requestUrl="http://".trim($getserver->serverIp).":".$nodeline->port;
                 $poolApikey=self::MasterTrakerPoolapikey();

                 $poolJoinUrl=$requestUrl."/setJoinPool/".$poolApikey;
                 echo "pool Adres: $poolJoinUrl";
                 $poolData=json_decode(self::getUrl($poolJoinUrl));

                 if($poolData->message=="Success"){
                     self::nodeStatusChange($nodeline->nodeId,3);

                     // sileecek sonra    start
                     $dxcMinerUrl=$requestUrl."/setStartDXCMiner/";
                     $dxcMinerData=json_decode(self::getUrl($dxcMinerUrl));
                     if($dxcMinerData->result=="000")
                     {
                         $prxMinerUrl=$requestUrl."/setStartPRXMiner/";
                         $prxMinerData=json_decode(self::getUrl($prxMinerUrl));
                         if($prxMinerData->result="000"){
                             echo "prx added <br>";

                         }else{
                             echo "setStartPRXMiner Hatasi";
                         }

                     }
                     else{
                         echo "StartDXCMiner Hatasi";
                     }
                     // sileecek sonra     ende;


                     echo "\n <br>    poll ekleme Başarılı  \n <br>";
                 }else{
                     echo "\n <br>  Hatali  $nodeline->nodeId  \n <br>";
                 }



             }


         }
         public static  function getUrl($url){
             // create curl resource
             set_time_limit(0);// to infinity for exampl
             $ch = curl_init();
             // set url
             curl_setopt($ch, CURLOPT_URL, $url);
             //return the transfer as a string
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

             curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);


             curl_setopt($ch, CURLOPT_TIMEOUT, 60);
             //curl_setopt($ch, CURLOPT_TIMEOUT, 60);
             $output = curl_exec($ch);
             // close curl resource to free up system resources
             curl_close($ch);
             return $output;
         }

         public  static function MasterTrakerPoolapikey(){


             // return "18205e6e-a83e-11eb-9a3b-02ca075254e8";
             // return "7706e857-a877-11eb-9a3b-02ca075254e8";
             // return "896151f4-a6a1-11eb-9a3b-02ca075254e8";
             // return "aff11b95-9f06-11eb-9a3b-02ca075254e8";
              //return "b229ab43-aa02-11eb-9a3b-02ca075254e8";// me
             // return "a2dff7c0-aa27-11eb-9a3b-02ca075254e8";// me
              //return "61aed842-a9f0-11eb-9a3b-02ca075254e8";//  maldar
              //return "a2dff7c0-aa27-11eb-9a3b-02ca075254e8";// mee
              return "00b24134-a87f-11eb-9a3b-02ca075254e8";// mee
          }
           public static  function getActivePoolKey(){
             $db=  new nmysql();
            // $sql="select * from masterTrakerPool where status='1' limit 0,1";
             $sql="select * from masterTrakerPool where status='1' ORDER BY RAND() limit 0,1";
             return $db->query($sql,"one");
           }

          public static function getTrakerNumber($servisId){
             $db=new nmysql();
             $sql="select * from services  where servisId=:servisId";
             $arg=["servisId"=>$servisId];
             return $db->query($sql,"one",$arg)->dexchainTrakeCode;
             //return "5c41faf4706b11eb88ab06a281cead4eBRlScE8YEl";
          }
          public static function  getServer($serverId){
              $db = new nmysql();
              $sql="select * from servers where serverId=:serverId";
              $arg=["serverId"=>$serverId];
              return  $db->query($sql,"one",$arg);
          }

    // services
         // noder active etme Start;
         public static  function onholdNodeActive(){
             $db= new nmysql();
             $sql="select * from noder where status='1' limit 0,1";
             $OnholdActiveNode=$db->query($sql,"all");

             // print_R($OnholdActiveNode);
             //exit();
             foreach ($OnholdActiveNode as $nodeline) {
                 $getPoolKey = self::getActivePoolKey();
                 // print_R($getPoolKey);

                 $poolApikey = trim($getPoolKey->poolApiKey);
                 echo "\api key :$poolApikey \n";
                 $poolApiId = $getPoolKey->masterPoolId;
                 //echo "dex code". self::getTrakerNumber($nodeline->servisId)."\n x";
                 //exit();

                 //exit();s
                 print_R($getPoolKey);
                 if ($getPoolKey->setupCount <=320) {


                 $getServiceProductInfo = self::getServiceProductInfo($nodeline->servisId);
                 $getserver = self::getServer($nodeline->serverId);
                 $requestUrl = "http://" . trim($getserver->serverIp) . ":" . $nodeline->port;
                 $nodeName = $getserver->ShortServerName . '-' . $nodeline->nodeId;
                 echo "\n <br> $nodeline->nodeId   Node Idli ------------------------   <br>\n";
                 echo "\n talep Url " . $requestUrl . "\n <br>";
                 echo "\n Node Name :$nodeName  \n <br>";
                 if ($controldata = self::getUrl($requestUrl)) {
                     sleep(2);

                     $poolJoinUrl = $requestUrl . "/setJoinPool/" . $poolApikey;
                     echo " \n <br>   pool url : $poolJoinUrl \n <br>";
                     $poolData = json_decode(self::getUrl($poolJoinUrl));
                     if ($poolData->message == "Success") {
                         echo "\n $poolApikey  pool key girildi \n";
                         print_r($poolData);

                         $SetNickNameUrl = $requestUrl . "/setNickname/" . $nodeName;

                         $NickNameData = json_decode(self::getUrl($SetNickNameUrl));

                         sleep(2);
                         echo "\n <br> Nick Url = $SetNickNameUrl \n <br>";
                         if ($NickNameData->message == "Success") {
                             $getTrakerUrl = $requestUrl . "/setDextracker/" . self::getTrakerNumber($nodeline->servisId);
                             $getTrakerData = json_decode(self::getUrl($getTrakerUrl));
                             echo "\n <br> trakaer Url = <a href='$getTrakerUrl'>$getTrakerUrl</a>  \n <br>";
                             if ($getTrakerData->message == "Success") {
                                 $dxcMinerUrl = $requestUrl . "/setStartDXCMiner/";
                                 $dxcMinerData = json_decode(self::getUrl($dxcMinerUrl));
                                 if ($dxcMinerData->result == "000") {
                                     $prxMinerUrl = $requestUrl . "/setStartPRXMiner/";
                                     $prxMinerData = json_decode(self::getUrl($prxMinerUrl));
                                     if ($prxMinerData->result = "000") {
                                         echo "prx added <br>";
                                         //  servis tamammi kontrol et
                                         self::masterPoolSetupInc($poolApiId);
                                         // pool status  cahange  start;

                                     } else {
                                         echo "setStartPRXMiner Hatasi";
                                     }

                                 } else {
                                     echo "StartDXCMiner Hatasi";
                                 }



                                 self::nodeStatusChange($nodeline->nodeId, 3); // işlem tamamlandı olarak işarektler
                                 self::NodePollChange($nodeline->nodeId, $poolApiId);// Hangi poolda oldugu belli olsun die
                                 echo "---------------- \n $nodeName  BAŞARILIS   --------- \n <br> ";
                             } else {
                                 echo " \n <br> Traker Kodu Girilemedi \n <br>";
                             }

                         } else {
                             echo "\n  <br> Nick namae eklememedi \n <br>";
                         }
                     } else {
                         echo " \n <br> pool değişmesi gerek  <br> \n";
                     }


                 } else {

                     if($nodeline->runTest>3){// noder kurulum için erişilemesse silinecek



                     $dockerDeleteData = docker::dockerDelete(trim($getserver->serverIp), $getserver->serverPort, $nodeline->dockerId);
                     if (self::nodeReinstall($nodeline->nodeId)) {
                         echo "\n NODE  DBDEB SİLİNNDİ";
                     } else {
                         echo "\n NODE DB SİLME HATASI";
                     }
                     }else{
                         // run test artir.
                         self::noderRuntestInc($nodeline->nodeId);
                         echo "\n noder Run test 1 artırıldı \n";
                     }
                     // print_R($dockerDeleteData);
                     echo "\n docker  ve   nodeler silinecek \n";
                 }


                 echo "\n  $nodeline->nodeId   Node Idli --------SONU-----------  \n";
                 echo "test";
                 // print_r($nodeline);
                 // print_R($getServiceProductInfo);
                 // print_R($getserver);
                 sleep(3);
             }//  musait pool api key var ise;
                 else{
                     //  mail at
                     echo "\n Boşta  api key yok \n";
                     self::masterPoolChangeStatus($getPoolKey->masterPoolId ,2);
                     nmail::noIdleMasterPoolKey("Boşta Master pool Key kalmadi");
                 }

             }// for ende;

         }
         public static function nodeReinstall($nodeId){
             $db=new nmysql();
            // UPDATE `noder` SET `status` = '4' WHERE `noder`.`nodeId` = 14;

             $sql="UPDATE noder SET  status='4' WHERE nodeId=:nodeId";
             $arg=["nodeId"=>$nodeId];
             if($db->update($sql,$arg)){
                 return true;
             }else{
                 return false;
             }
         }

         // noder active etme  ende;
         public static  function serviceUseNodeCount($servisId){
             $db= new nmysql();
             $sql="select *  from noder where servisId=:servisId";
             $arg=["servisId"=>$servisId];
             return $db->databaseRecordCount($sql,$arg);
         }
         public static function serviceFullInstalled($serviceId){
            if(self::serviceChangeStatus($serviceId,1)){
                return true;
            }else{
                return false;
            }
         }
         public static function serviceChangeStatus($serviceId,$status){
             //0 Kurulumda 1 Aktif 2 süresi bitmiş 3 iptal 4 süre Uzatma Bekliyor
             $db=new nmysql();
             $sql="update services set status=:status where servisId=servisId";
             $arg=[
               "servisId"=>$serviceId,
                 "status"=>$status
             ];
             if($db->query($sql,$arg)){
                 return true;
             }else{
                 return false;
             }
         }
         public static function  nodeStatusChange($nodeId,$statusCode){
             $db=new nmysql();
             $sql="update noder set status=:status where nodeId=:nodeId";
             $arg=[
                 "nodeId"=>$nodeId,
                 "status"=>$statusCode
             ];
             if($db->update($sql,$arg)){
                 return true;
             }else{
                 return false;
             }
         }
         public static function  NodePollChange($nodeId,$masterPool){
             $db=new nmysql();
             $sql="update noder set masterPool=:masterPool where nodeId=:nodeId";
             $arg=[
                 "nodeId"=>$nodeId,
                 "masterPool"=>$masterPool
             ];
             if($db->update($sql,$arg)){
                 return true;
             }else{
                 return false;
             }
         }
         public static function  nodeUpdateContainerInstalled($nodeId,$serverId,$port,$dockerId){
             $db=new nmysql();
             $sql="update noder set dockerId=:dockerId,serverId=:serverId,port=:port,status=:status where nodeId=:nodeId";
             $arg=[
                 "nodeId"=>$nodeId,
                 "serverId"=>$serverId,
                 "dockerId"=>$dockerId,
                 "port"=>$port,
                 "status"=>1
             ];
             if($db->update($sql,$arg)){
                 return true;
             }else{
                 return false;
             }
         }
           public static function serverPortInc($serverId){
               $db= new nmysql();
               $sql="update servers set startPort1=startPort1+1,startPort2=startPort2+1,startPort3=startPort3+1,startPort4=startPort4+1 where serverId=:serverId";
               $arg=["serverId"=>$serverId];
               if($db->update($sql,$arg))
               {
                   return true;
               }else{
                   return false;
               }
     }
        public static function noderRuntestInc($nodeId){
            $db= new nmysql();
            $sql="update noder set runTest=runTest+1 where nodeId=:nodeId";
            $arg=["nodeId"=>$nodeId];
            if($db->update($sql,$arg))
            {
                return true;
            }else{
                return false;
            }
        }
     public static function masterPoolChangeStatus($poolServerId,$status){
             $db = new nmysql();
             $sql="update masterTrakerPool set status=:status where masterPoolId=:masterPoolId";
             $arg=[
               "masterPoolId"=>$poolServerId,
                 "status"=>$status
             ];
         if($db->update($sql,$arg))
         {
             return true;
         }else{
             return false;
         }

     }
        public static function masterPoolSetupInc($poolServerId){
            $db= new nmysql();
            $sql="update masterTrakerPool set setupCount=setupCount+1 where masterPoolId=:masterPoolId";
            $arg=["masterPoolId"=>$poolServerId];
            if($db->update($sql,$arg))
            {
                return true;
            }else{
                return false;
            }
        }
         public static function serverStatusChange($serverId,$statusId){
             //0 kuruluma musait 1 kuruluma kapali 2 server dolmuş
             $db =new nmysql();
             $sql= "update servers set status=:status where serverId=:serverId";
             $arg=[
                 "serverId"=>$serverId,
                 "status"=>$statusId
             ];
             if($db->update($sql,$arg)){
                 return true;
             }else{
                 return false;
             }
         }
         public static  function serverUseNodeCount($serverId){
             $db= new nmysql();
             $sql="select *  from noder where serverId=:serverId";
             $arg=["serverId"=>$serverId];
             return $db->databaseRecordCount($sql,$arg);
         }
         public static function getpivateOneServer(){
             $db = new nmysql();
             $sql="select * from servers where serverType='1' and status='0'";
          return $db->query($sql,"one");
         }
         public static function getGeneralOneServer(){
             $db = new nmysql();
             $sql="select * from servers where serverType='0' and status='0' limit 0,1";
             return $db->query($sql,"one");
         }

         public static function getServiceProductInfo($servisID){
             $db= new  nmysql();
             $servisAllInfosql="select * from services,product where  services.servisId=:servisId  and product.productId=services.productId";
             $arg=[
                 "servisId"=>$servisID
             ];
             $data=$db->query($servisAllInfosql,"one",$arg);
             return $data;

         }
         public static function   OnholdDockerSetup(){
             $db= new nmysql();
             $sql="select * from noder where status='0' limit 0,1";
             $onholdNode=$db->query($sql,"all");
             /*
                 [nodeId] => 1
            [servisId] => 1
            [dockerId] => 0
            [serverId] => 0
            [port] => 0
            [status] => 0

              * */
             foreach($onholdNode as $nodeLine){
                 // node  bilgilerini servisle cekme start;
                 $serviceAndProductInfo=self::getServiceProductInfo($nodeLine->servisId);
                // print_R($serviceAndProductInfo);
                 //getpivateServer
                 // ozel sunucu kurulumu için paket ise start;
                 if($serviceAndProductInfo->productType==1) {
                     $onePrivateServer = self::getpivateOneServer();

                     $serverUseNodeCount = self::serverUseNodeCount($onePrivateServer->serverId);

                     //print_R($onePrivateServer);
                     if(strlen(@$onePrivateServer->serverIp)>3){

                     if ($serverUseNodeCount <= $onePrivateServer->DockerCount) {

                         $containerJson = self::dockerContainerJsonPrepare($onePrivateServer->startPort1, $onePrivateServer->startPort2, $onePrivateServer->startPort3, $onePrivateServer->startPort4);
                         //print_R($containerJson);
                         $conatinerName = $onePrivateServer->ShortServerName . '-' . $nodeLine->nodeId;
                         $dockerData = docker::containerCreate($conatinerName, $onePrivateServer->serverIp, $onePrivateServer->serverPort, json_encode(json_decode($containerJson)));
                         $dockerId = json_decode($dockerData)->Id;
                         //print_R($dockerData);
                         if (strlen($dockerId) > 5) {
                             self::serverPortInc($onePrivateServer->serverId);
                             //$nodeId,$serverId,$port,$dockerId
                             self::nodeUpdateContainerInstalled($nodeLine->nodeId, $onePrivateServer->serverId, $onePrivateServer->startPort1, $dockerId);
                             // $serviceNodeCount=self::serviceUseNodeCount($nodeLine->servisId);

                             echo " \n \n Kurulan Conainer Name= $conatinerName \n";
                             $dockerRunData = docker::containerRun($onePrivateServer->serverIp, $onePrivateServer->serverPort, $dockerId);
                             echo " \ndocker run data  <br>\n";
                             $cmd1="iptables -A INPUT -s ".self::remoteSshAllowIp()." -p tcp --dport ".$onePrivateServer->startPort1." -j ACCEPT";
                             $cmd2="iptables -A INPUT -p tcp --dport ".$onePrivateServer->startPort1." -j REJECT";
                             self::nssh($onePrivateServer->serverIp,'22','root',self::remoteSshp(),$cmd1);
                             self::nssh($onePrivateServer->serverIp,'22','root',self::remoteSshp(),$cmd2);

                             //print_R($dockerRunData);
                             // echo "container kuruldu";
                         } else {
                             echo " \nContainer Hatası Oldu \n";
                         }


                     } else {
                         echo "\n Sunucu  Node Sayısı Dolmus  \n";
                         self::serverStatusChange($onePrivateServer->serverId, 2);
                         nmail::noIdlePrivateServer(" Priv Sunucu  Node Sayısı Dolmus");
                         //sunucuyu doluya cevir
                     }
                     }else{
                          echo "Boşta Musait sunucu  Bulunamadi\n";
                          nmail::noIdlePrivateServer("Boşta Musait Normal sunucu  Bulunamadi");
                          //
                     }
                     // print_R($onePrivateServer);


                 }// ozel sunucu kurulumu için paket ise ende;
                 else{
                     // normal Sunucu  sunucu Node Kurulumu Start;
                      //  Burada Kodlanacak.
                     echo "Normal Sunuuc  Kurlum";
                     $generalServer=self::getGeneralOneServer();
                     if(!empty($generalServer))
                     {
                          //  Kurulum yapılacak sunucu var ise
                         $generalServerUseNodeCount = self::serverUseNodeCount($generalServer->serverId);
                         echo "kac tane  krulu node var.$generalServerUseNodeCount";
                         if ($generalServerUseNodeCount <= $generalServer->DockerCount) {
                             // ortam musait kurulum yap
                             $containerJson = self::dockerContainerJsonPrepare($generalServer->startPort1, $generalServer->startPort2, $generalServer->startPort3, $generalServer->startPort4);
                             $conatinerName = $generalServer->ShortServerName . '-' . $nodeLine->nodeId;
                             $dockerData = docker::containerCreate($conatinerName, $generalServer->serverIp, $generalServer->serverPort, json_encode(json_decode($containerJson)));


                             if(!empty(json_decode($dockerData)->Id)){
                                 $dockerId = json_decode($dockerData)->Id;
                                 self::serverPortInc($generalServer->serverId);
                                 self::nodeUpdateContainerInstalled($nodeLine->nodeId, $generalServer->serverId, $generalServer->startPort1, $dockerId);
                                 $dockerRunData = docker::containerRun($generalServer->serverIp, $generalServer->serverPort, $dockerId);
                                 $cmd1="iptables -A INPUT -s ".self::remoteSshAllowIp()." -p tcp --dport ".$generalServer->startPort1." -j ACCEPT";
                                 $cmd2="iptables -A INPUT -p tcp --dport ".$generalServer->startPort1." -j REJECT";
                                 self::nssh($generalServer->serverIp,'22','root',self::remoteSshp(),$cmd1);
                                 self::nssh($generalServer->serverIp,'22','root',self::remoteSshp(),$cmd2);
                                 echo "  \n  $conatinerName  $generalServer->ShortServerName serverina Kuruldu \n";
                             }else{
                                 echo "  Container Kurulum Hatası";
                             }

                         }else{
                             echo "\n  Genel Server  Node Dolur \n <br>";
                             nmail::noIdleGeneralServer("$generalServer->serverId li genel server Dolur");
                         }

                         //print_R($nodeLine);

                     }else{
                         echo "\n Boşta Normal Sunucu Yok \n";
                          nmail::noIdleGeneralServer("Kurulum Yapacak Genel Müşteri Sunucusu kalmamış");
                     }

                     // normal Sunucu  sunucu Node Kurulumu  ende;

                 }


             } // node  bilgilerini servisle cekme   ende;


     }
      public static function nssh($host,$port,$username,$password,$cmd)
        {
            $connection = ssh2_connect($host,$port);
            $pass_success=ssh2_auth_password($connection, $username, $password);
            if (!$pass_success) {
                throw new Exception("fail: unable to establish connection\nPlease Check your password");
            }else {
                echo "connection ok";
            }
            $stream = ssh2_exec($connection, $cmd);
            $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
            stream_set_blocking($errorStream, true);
            stream_set_blocking($stream, true);
            print_r($cmd);
            $output = stream_get_contents($stream);
            fclose($stream);
            fclose($errorStream);
            ssh2_exec($connection, 'exit');
            unset($connection);
            return $output;
        }
     public static function  dockerContainerJsonPrepare($port1,$port2,$port3,$port4){
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
"Memory": 300000000,
"memory-reservation":200000000,
"MemorySwap": 0,
"MemorySwap": 0,
"MemoryReservation": 0,
"KernelMemory": 0,
"CpuShares": 512,
"CpuQuota": 6000,
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

    }
}
?>