<?php
namespace core;

/**
 * 运行主体
 */

/**
 * Class App
 * @package core
 * @property components\Router $router
 */
class App
{
    private $components = [];
    public function __construct(array $init)
    {
        // 初始化组件
        $this->_iniComponents($init['components']);
    }

    private function _iniComponents(array $components)
    {
        if (!empty($components)) {
            foreach ($components as $compName=>$compInfo) {
                $compClass = $compInfo['class'] ?? null;
                unset($compInfo['class']);
                if (!$compClass || !class_exists($compClass)) throw new \Exception('组件类不存在');
                $this->components[$compName] = (new $compClass($compInfo));
            }
        }
    }

    public function __get($name)
    {
        // 到组件中查找
        if (!isset($this->components[$name])) {
            throw new \Exception('组件未找到！');
        }
        return $this->components[$name];
    }

    public function run()
    {
        $this->router->run(); // 路由到方法
        Dawei::$app = $this;
    }

}
