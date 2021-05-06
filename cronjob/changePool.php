<?php
$mainPath=dirname( __DIR__);
chdir($mainPath);
set_include_path($mainPath);
ini_set('include_path', $mainPath);
require_once ($mainPath.DIRECTORY_SEPARATOR."controller/docker.php");
require_once ($mainPath.DIRECTORY_SEPARATOR."controller/crons.php");
use dockerSpace\docker,crons\cronNoder;

cronNoder::serverChangePool(2);


?>