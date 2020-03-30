<?php
namespace core;

/**
 * 运行主体
 * @package core
 * @property components\request\Request $request
 * @property components\router\Router $router
 */
class App
{
    private $components = [];
    private $componentsConfig = [];
    public function __construct(array $init)
    {
        // 初始化组件
        $this->componentsConfig = $init['components'];
        $this->_iniComponents($init['components_init']);
    }

    /**
     * 初始化组件
     * @param array $components
     * @throws \Exception
     */
    private function _iniComponents(array $components)
    {
        if (!empty($components)) {
            foreach ($components as $compName) {
                $this->createComponent($compName);
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
            $this->createComponent($name);
        }
        return $this->components[$name];
    }

    /**
     * 创建组件
     * @param $name
     * @throws \Exception
     */
    public function createComponent($name)
    {
        $component = $this->componentsConfig[$name] ?? null;
        if ($component) {
            $compClass = $component['class'] ?? null;
            if (!$compClass) throw new \Exception('组件'.$name.'未找到！');
            unset($component['class']);
            $this->components[$name] = new $compClass($component);
        }
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
