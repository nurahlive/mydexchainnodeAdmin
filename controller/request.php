<?php
 namespace  request{
     require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/config/config.php");
     require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");
     require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/helper.php");
     require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/auth.php");
     use config\themes,ndatabase\nmysql,helper\message,auth\nsession;

     class post  extends message {

         public static function orderInfo(int $orderId){
             $db= new nmysql();
             $orderSql="select * from orders where orderId=:orderId";
             $orderArg=["orderId"=>$orderId];
             return $db->query($orderSql,"one",$orderArg);
         }
           public  static function  servisAdd($data){
               $db= new nmysql();
                $orderInfo=self::orderInfo($data['orderId']);
               $controlSql="select * from services where ip=:ip and port=:port";
               $controlArg=[
                   "ip"=>$data['servisIp'],
                   "port"=>$data['servisPort']
               ];
               $returnMessage=[];
               if(self::databaseRecordCount($controlSql,$controlArg)>0){
                   $returnMessage['text']="Servis Daha Önceden Kayıtlı";
                   $returnMessage['title']="Hata";
                   $returnMessage['status']=false;
                   $returnMessage['icon']="error";
                   return $returnMessage;

               }else {

                   $servisInsertSql="insert into services
    (orderId,userId,serviceName,ip,port,controlDate,status) values(:orderId,:userId,:serviceName,:ip,:port,:controlDate,:status)";
                   $servisInsertArg=[
                       "orderId"=>$orderInfo->orderId,
                       "userId"=>$orderInfo->userId,
                       "serviceName"=>$data['servisName'],
                       "ip"=>$data['servisIp'],
                       "port"=>$data['servisPort'],
                       "controlDate"=>date("Y-m-d H:i:s",time()),
                       "status"=>1,

                   ];
                    if($db->insert($servisInsertSql,$servisInsertArg)){
                        $returnMessage['text']="Servis Eklendi";
                        $returnMessage['title']="Başarılı";
                        $returnMessage['status']=true;
                        $returnMessage['icon']="success";
                        return $returnMessage;

                    }else {
                        $returnMessage['text']="Servis Ekleme Sırasında Hata Meydana Geldi";
                        $returnMessage['title']="Hata";
                        $returnMessage['status']=false;
                        $returnMessage['icon']="error";
                        return $returnMessage;

                    }

               }

           }

           public static  function productAdd($data){
               $db=new nmysql();
               $sql="insert into product(productName,amount,moneyType,DockerCount,periods,status,deliveryTime) values(:productName,:amount,:moneyType,:DockerCount,:periods,:status,:deliveryTime)";
               $arg=[
                   "productName"=>$data['productName'],
                   "amount"=>$data['amount'],
                   "moneyType"=>$data['moneyType'],
                   "DockerCount"=>$data['dockerCount'],
                   "periods"=>$data['period'],
                   "status"=>$data['status'],
                   "deliveryTime"=>$data['deliveryTime'],
               ];
               if($db->insert($sql,$arg)){
                   return true;
               }else{
                   return false;
               }

           }
           public static  function productChangeStatus($data){
               $db= new nmysql();
               $sql="UPDATE product  set status=:status where productId=:productId";
               $arg=[
                   "status"=>$data['status'],
                   "productId"=>$data['productId']
               ];
               if($db->update($sql,$arg)){
                   return true;
               }else{
                   return false;
               }
           }


         public static function databaseRecordCount($sql,$arg){
             $db= new nmysql();
             $data=$db::$db->prepare($sql);
             $data->execute($arg);
             return $data->rowCount();
         }
         public static  function loginDbControl($data){
             $arg=[
                 "mail"=>$_POST['email'],
                 "password"=>md5($_POST['password'])
             ];
             $sql="select * from adm where mail=:mail and password=:password ";

             if(self::databaseRecordCount($sql,$arg)==1){
                 $db= new nmysql();
                 $admData=$db->query($sql,"one",$arg);
                 nsession::createLoginSession($admData);
                return true;
             }else{
                 return false;
             }

         }



     }
      class get{


         public static function  menu($menu){
 //echo "gelen   : ";
   //echo themes::$themePath;
  //print_r($menu);
             $slh=DIRECTORY_SEPARATOR;
  echo "<hr>";
             switch(@array_keys($menu)[0]){
                 case 'login' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/themes/".themes::$themePath."/login.php");
                         die();
                     } break;

                 case 'productPackets' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . $slh . "/themes/".themes::$themePath."/productPackets.php");
                     } break;
                 case 'privateServerNodeSetup' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . $slh . "/themes/".themes::$themePath."/privateServerNodeSetup.php");
                     } break;
                 case 'masterTrakerPool' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . $slh . "/themes/".themes::$themePath."/masterTrakerPool.php");
                     } break;
                 case 'manuelContainerSetup' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . $slh . "/themes/".themes::$themePath."/manuelContainerSetup.php");
                     } break;


                 case 'servers' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . $slh . "/themes/".themes::$themePath."/servers.php");
                     } break;
                 case 'orders' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . $slh . "/themes/".themes::$themePath."/orders.php");
                     } break;
                 case 'orderServisAdd' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . $slh . "/themes/".themes::$themePath."/orderServisAdd.php");
                     } break;
                 case 'userServiceList' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . $slh . "/themes/".themes::$themePath."/userService.php");
                     } break;
                 case 'serviceList' :
                     {
                         require_once($_SERVER['DOCUMENT_ROOT'] . $slh . "/themes/".themes::$themePath."/serviceList.php");
                     } break;





                  default: echo "main page";

              }

         }


      }
 }
?>