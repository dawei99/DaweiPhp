<?php
namespace core;

use core\base\BaseObject;

/**
 * 运行主体
 */
class Dawei
{
    /**
     * @var App
     */
    public static $app;

    /**
     * 类自动加载
     * @param $wholeClassName
     */
    static public function autoload(string $wholeClassName) : void
    {
        $handleClas = preg_replace("/\\\/", "/", $wholeClassName);
        $classFile = __DIR__ . "/../$handleClas.php";

        if (is_file($classFile)) {
            include $classFile;
        } else {
            throw new \Exception('未找到类:' . $wholeClassName);
        }
    }
}

spl_autoload_register(['core\Dawei', 'autoload'], true, true);
