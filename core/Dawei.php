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
    public static function autoload(string $wholeClassName) : void
    {
        $backslash = "/\\\/";
        $handleClas = preg_replace($backslash, "/", $wholeClassName);
        $classFile = __DIR__ . "/../$handleClas.php";

        if (is_file($classFile)) {
            include $classFile;
        } else {
            throw new \Exception('未找到类:' . $wholeClassName);
        }
    }

    /**
     * 没有捕获的错误
     * @param \Exception $e
     */
    public static function setExeptionhandler(\Exception $e)
    {
        self::$app->exceptionHandle($e);
    }
}

spl_autoload_register(['core\Dawei', 'autoload'], true, true);
set_exception_handler(['core\Dawei', 'setExeptionhandler']);