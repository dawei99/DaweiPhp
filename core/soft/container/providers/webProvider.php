<?php
namespace core\soft\container\providers;
use \core\soft\constraints\ProviderConstraint;
use \core\soft\abstracts\ProviderAbstract;

class webProvider extends ProviderAbstract implements ProviderConstraint {
    public function register()
    {
        // TODO: Implement register() method.
        $this->app->bind('http', function(){
            if (func_get_args() > 0) {
                return new \GuzzleHttp\Client();
            } else {
                return new \GuzzleHttp\Client(func_get_args());
            }

        });

    }

    public function readyAll()
    {
        // TODO: Implement readyAll() method.

    }
}
