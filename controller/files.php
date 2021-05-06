<?php
namespace  fileproces {

    class    upload
    {
        public static function fileUpload($file,$forminputName,$uploadPath,$allowedFile){

            $uploadFileName=self::enctypeFileName(self::randomName(25)).".".pathinfo($file[$forminputName]['name'], PATHINFO_EXTENSION);

            if(self::fileExtensionControl(pathinfo($file[$forminputName]['name'], PATHINFO_EXTENSION),$allowedFile['extension'])) {
                if (move_uploaded_file($file[$forminputName]['tmp_name'],$uploadPath.$uploadFileName  ))
                {

                    return  [
                        "path"=>$uploadPath,
                        "fileName"=>$uploadFileName
                    ];
                } else {
                    return  0;
                }
            }

        }
        public  static  function fileExtensionControl($ext,$allowedExtension){
            if(!in_array($ext,$allowedExtension)) {

                return 0 ;
            }else{
                return 1;
            }
        }
        public static  function randomName($length){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        public static  function  enctypeFileName($fileName)  {

            return md5($fileName);
        }
    }
    class   download {
        public static function fileDownload($path,$downloadName){
            header("content-disposition: attachment; filename=$downloadName");
            readfile($path);
        }
    }
}