<?php
 $db=null;
 $charset="UTF-8";



    try {
        //@self::$db = new \PDO('mysql:host=' . mysqlConfig::$mysqlHost . ';port=' . mysqlConfig::$mysqlPort . ';dbname=' . mysqlConfig::$mysqldatabase, mysqlConfig::$mysqlUser, mysqlConfig::$mysqlPasword);

        @$db = new PDO('mysql:host=localhost;port=3306;dbname=oldDockerSales','nurahtest','nurahtest');
       // @$db = new PDO('mysql:host=localhost;dbname=test', 'nurahtest', $pass);


        @$db->exec('SET NAMES `' . $charset . '`');
        @$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    } catch (PDOException $e) {
        echo "<br><font color='#F00'><strong>Local Sql Server not Connect. </strong></font>";
        exit();
    }
   function getUrl($url){
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

 //$poolKey="a2dff7c0-aa27-11eb-9a3b-02ca075254e8";
 $poolKey="ae5abe58-af7a-11eb-9a3b-02ca075254e8";
    $noder=$db->prepare("select * from noder where status='5' limit 0,60");
$noder->execute();
foreach ($noder->fetchAll() as $noderLine){
    //print_R($noderLine);
    $server=$db->prepare("select * from servers");
     $server->execute();
     foreach($server->fetchAll() as $serverLine){
         $url="http://$serverLine->serverIp:$noderLine->port/setJoinPool/$poolKey";
         echo "<br>url :$url <br>";
         $poolData=getUrl($url);
         echo "<br> Node Id : $noderLine->nodeId <br>";
          if(@json_decode(@$poolData)->message=='Success'){
              $up=$db->prepare("update noder set status='3',servisId=:servisId where nodeId=:nodeId");
              $up->bindParam(':nodeId',$noderLine->nodeId);
              $up->bindParam(':servisId',$serverLine->serverId);
              $arg=[
                  ":nodeId"=>$noderLine->nodeId,
                  ":servisId"=>$serverLine->serverId,
              ];
              if($up->execute()){
                  echo "<br><font color='#0F0'>update Başarılı</font> <br>";
              }else{
                  echo "<br><font color='#F00'>update Hatalı </font><br>";
              }
          }else{
              echo "<br></br><font color='#00F'>hata</font><br>";
          }



        // print_R($serverLine);

    }

}




?>