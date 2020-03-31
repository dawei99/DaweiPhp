<?php
//phpinfo();
//ob_start(); //打开缓冲区

//header("Content-type:json"); //把浏览器重定向到index.php
//echo "Hellon"; //输出

//ob_end_flush();//输出全部内容到浏览器

//$str = ob_get_contents();//捕获缓存的内容
//var_dump($str);
//die;
define("__ROOT__", dirname(dirname(__FILE__)));

require "../core/Dawei.php";
require "../vendor/autoload.php";
$config = require "../common/config/main.php";

(new core\App($config))->run();
