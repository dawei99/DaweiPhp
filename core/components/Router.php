<?php
namespace core\components;

use core\Dawei;

/**
 * 路由模块
 */

class Router
{
    protected $controllerName;
    protected $actionName;
    protected $actionMark = 'action';
    protected $controllerMark = 'Controller';

    public function setControllerAction()
    {
        $this->controllerName = Dawei::$app->request->get('c');
        $this->actionName = Dawei::$app->request->get('a');
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
