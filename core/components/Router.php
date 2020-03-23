<?php
namespace core\components;

/**
 * 路由模块
 */

class Router
{
    protected $controllerName;
    protected $actionName;
    protected $actionMark = 'action';
    protected $controllerMark = 'Controller';
    protected $dividingModeUrlName = 'd';

    private $mode;

    public function __construct(array $config)
    {
        $this->mode = $config['mode'] ?? 1;
    }


    protected function parsingUrl() : void
    {
        $modeFunc = [
            1 => "_modeGeneral",
            2 => "_modeDividing",
        ];
        $modeFun = $modeFunc[$this->mode];
        $this->$modeFun();
    }

    /**
     * 普通模式
     */
    private function _modeGeneral() : void
    {
        //TODO 这里需要换成request组件
        $this->controllerName = $_GET['c'];
        $this->actionName = $_GET['a'];
    }

    /**
     * 斜线模式
     */
    private function _modeDividing() : void
    {
        //TODO 这里需要换成request组件
        $dividingModeUrl = explode('/',$_GET[$this->dividingModeUrlName]);
        list($this->controllerName, $this->actionName) = $dividingModeUrl;
    }

    /**
     * controller名称
     * @return string
     */
    protected function controllerName() : string
    {
        return ucfirst(strtolower($this->controllerName)) . $this->controllerMark;
    }

    /**
     * action名称
     * @return string
     */
    protected function actionName() : string
    {
        return $this->actionMark . ucfirst(strtolower($this->actionName));
    }

    /**
     * 运行
     * @return mixed
     */
    public function run()
    {
        $this->parsingUrl();
        $action = $this->actionName();
        $controllerClass = '\controllers\\' . $this->controllerName();
        $controller = new $controllerClass;
        return call_user_func([$controller, $action]);
    }
}
