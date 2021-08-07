<?php
namespace core;

use core\base\BaseObject;
use Throwable;

/**
 * 运行主体
 * @package core
 * @property soft\request\Request $request
 * @property soft\router\Router $router
 */
class App extends BaseObject
{
    private $components = [];
    private $componentsConfig = [];
    private $initConfig = null;

    public function __construct(array $init)
    {
        $this->initConfig = $init;
    }

    /**
     * 初始工作
     * @param array $init
     * @throws \Exception
     */
    private function _init() : void
    {
        // 初始化组件
        $this->componentsConfig = $this->initConfig['components'];
        $this->_iniComponents($this->initConfig['components_init']);
    }

    /**
     * 初始化组件
     * @param array $components
     * @throws \Exception
     */
    private function _iniComponents(array $components) : void
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
        try {
            Dawei::$app = $this;
            $this->_init();
            $this->router->run();
        } catch (\Throwable $e) {
            $this->exceptionHandle($e);
        }


    }

    /**
     * 异常处理
     * @param \Throwable $e
     */
    public function exceptionHandle(\Throwable $e)
    {
        echo "看看吧，出异常啦！！！";
        dd($e);
        die;
    }

}
