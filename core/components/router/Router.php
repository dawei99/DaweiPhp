<?php
namespace core\components\router;

use core\Dawei;

/**
 * 路由模块
 */

class Router
{
    protected $controllerName = "home";
    protected $actionName = "index";
    protected $actionMark = 'action';
    protected $controllerMark = 'Controller';

    /**
     * 设置控制器、方法名
     */
    public function setControllerAction()
    {
        if(Dawei::$app->request->get('c')) $this->controllerName = Dawei::$app->request->get('c');
        if(Dawei::$app->request->get('a')) $this->actionName = Dawei::$app->request->get('a');
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
        $this->setControllerAction();
        $action = $this->actionName();
        $controllerClass = '\controllers\\' . $this->controllerName();
        $controller = new $controllerClass;
        return call_user_func([$controller, $action]);
    }
}
