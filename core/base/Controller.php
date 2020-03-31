<?php


namespace core\base;



use core\Dawei;
use core\soft\view\View;

class Controller extends BaseObject
{
    public function draw(string $action=null, array $params=[])
    {
        $actionName = strtolower($action ?? Dawei::$app->router->actionName(false));
        $controllerName = strtolower(Dawei::$app->router->controllerName(false));
        $drawName = $controllerName . '/' . $actionName;
        return $this->getDraw()->draw($drawName);
    }

    /**
     * 获取view单例
     * @return view
     */
    public function getDraw() : View
    {
        static $drowObject = null;
        if ($drowObject === null) {
            $drowObject = new View();
        }
        return $drowObject;
    }
}