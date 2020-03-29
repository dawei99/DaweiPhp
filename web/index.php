<?php

require "../core/Dawei.php";
require "../vendor/autoload.php";
$config = require "../common/config/main.php";

(new core\App($config))->run();
