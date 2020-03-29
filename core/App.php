<?php
namespace core;

/**
 * 运行主体
 * @package core
 * @property components\request\Request $request
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

    /**
     * 初始化组件
     * @param array $components
     * @throws \Exception
     */
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

    /**
     * 获取组件
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        // 到组件中查找
        if (!isset($this->components[$name])) {
            throw new \Exception('组件'.$name.'未找到！');
        }
        return $this->components[$name];
    }

    /**
     * 启动框架
     */
    public function run()
    {
        Dawei::$app = $this;
        $this->router->run(); // 路由到方法
    }

}
