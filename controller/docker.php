<?php
namespace dockerSpace{
    class docker{

        public static function dockerDelete($host,$port,$dockerId)
        {
            $url="http://".$host.":".$port."/containers/".$dockerId."?force=true";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            $data="force=true";


            curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
            //&force=true


            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return $result;
        }
        public static function dockerRequest($host,$port,$reguestUrl,$requestType='g',$data=null){
            set_time_limit(0);// to infinity for exampl
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://'.$host.':'.$port."/".$reguestUrl);

            if($requestType=='p'){
                $headerSet=array(
                    //"Accept: application/json, text/plain, */*",
                    "Content-Type: application/json",
                );

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headerSet);
                curl_setopt($ch, CURLOPT_POST, true );
                curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
            }
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 250);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
            $data=curl_exec($ch);
            return $data;
        }
         public static function containerRestart($host,$port,$containerId){
              return  self::dockerRequest($host,$port,"containers/$containerId/restart","p");
         }
        public static function containerRun($host,$port,$containerId){
            //containers/2a981e39bd7b5f42fdb7518d6784c6a08f3a5a0fbc61a2430f14da2ae84fa71f/start
            return  self::dockerRequest($host,$port,"containers/$containerId/start","p");
        }
        public static  function containerCreate($continerName,$host,$port,$containerDataJson){
            return  self::dockerRequest($host,$port,"containers/create?name=$continerName","p",$containerDataJson);
        }
    }
}
?>