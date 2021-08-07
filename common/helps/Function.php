<?php
// 公共函数

/**
 * 格式化打印
 * @param $data
 */
function dd($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * 使用Container
 */
function Con(){
    return \core\soft\container\Container::instance(...func_get_args());
}
