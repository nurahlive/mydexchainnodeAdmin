<?php
require_once __DIR__."/config/config.php";
require_once __DIR__."/controller/request.php";
use  config\themes,request\get;
require_once  __DIR__."/".themes::themeBaseDirectory()."/".themes::themeActiveDirectory()."/footer.php";
?>