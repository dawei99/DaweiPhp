<?php
namespace core\soft\container;

class Container {

    public $bind = [];

    public function __construct(){
        global $config;
        //var_dump(\core\soft\abstracts\ProviderAbstract::class);
        foreach ($config['providers'] as $provider) {
            call_user_func_array([(new $provider($this)), 'register'], []);
        }
    }

    public function bind($name, \Closure $func){
        $this->bind[$name] = $func;
    }

    public function make($name , $init=[]){
        return call_user_func_array($this->bind[$name], $init);
    }

    public static function instance(){
        static $instance = null;
        if ($instance === null) {
            $instance = new static();
        }
        if (count(func_get_args()) > 0) {
            return call_user_func_array([$instance, "make"], func_get_args());
        } else {
            return $instance;
        }
    }
}
