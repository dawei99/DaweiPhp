<?php
define("__ROOT__", dirname(dirname(__FILE__)));
define("__DIRS__" , DIRECTORY_SEPARATOR);

require __ROOT__ . __DIRS__ . "common/helps/Function.php";
require __ROOT__ . __DIRS__ . "core/Dawei.php";
require __ROOT__ . __DIRS__ . "vendor/autoload.php";
$config = require __ROOT__ . __DIRS__ . "common/config/main.php";

(new core\App($config))->run();
