<?php
set_time_limit(0);// to infinity for exampl
$mainPath=dirname( __DIR__);
chdir($mainPath);
set_include_path($mainPath);
ini_set('include_path', $mainPath);
require_once ($mainPath.DIRECTORY_SEPARATOR."controller/docker.php");
require_once ($mainPath.DIRECTORY_SEPARATOR."controller/crons.php");
use dockerSpace\docker,crons\cronNoder;

cronNoder::empetyTrakerKeyScan();
//print_R(cronNoder::empetyTrakerKeyScan());


?>