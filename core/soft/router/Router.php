<?php
namespace core\soft\router;

use core\base\BaseObject;
use core\Dawei;

/**
 * 路由模块
 */

class Router extends BaseObject
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
    public function controllerName(bool $mark=true) : string
    {
        $return = ucfirst(strtolower($this->controllerName));
        if ($mark) $return .= $this->controllerMark;
        return $return;
    }

    /**
     * action名称
     * @return string
     */
    public function actionName(bool $mark=true) : string
    {
        $return = ucfirst(strtolower($this->actionName));
        if ($mark) $return = $this->actionMark . $return;
        return $return;
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
