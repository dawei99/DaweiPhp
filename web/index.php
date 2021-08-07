<?php

// 项目绝对路径
define("__ROOT__", dirname(dirname(__FILE__)));

// 系统分隔符
define("__DIRS__" , DIRECTORY_SEPARATOR);

require __ROOT__ . __DIRS__ . "common/helps/Function.php";
require __ROOT__ . __DIRS__ . "core/Dawei.php";
require __ROOT__ . __DIRS__ . "vendor/autoload.php";
$config = require __ROOT__ . __DIRS__ . "common/config/main.php";
require __ROOT__ . '/core/soft/container/Container.php';

(new core\App($config))->run();
