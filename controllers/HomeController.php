<?php


namespace controllers;


use core\base\Controller;

class HomeController extends Controller
{
    public function actionIndex()
    {
        return $this->draw('index', ['x' => 123]);
    }
}