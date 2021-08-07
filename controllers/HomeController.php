<?php


namespace controllers;


use core\base\Controller;

class HomeController extends Controller
{
    public function actionIndex()
    {
        $res = Con("http")->request('GET', 'http://www.baidu.com');
        echo $res->getStatusCode();
        return $this->draw('index', ['x' => 123]);
    }
}