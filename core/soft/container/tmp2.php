<?php

require_once 'Container.php';

interface board {
    public function __construct(Container $app);

    public function an();
}

abstract class Provider {
    protected $app;
    public function __construct(Container $app){
        $this->app = $app;
    }
}

class CommonKeyBoard extends Provider implements board {
    public function an(){return 'commonKeyBoard';}
}

class IKBCKeyBoard extends Provider implements board {
    public function an(){return 'IKBC';}
}



$continer = new Container();
$continer->bind('board', function(Container $app){
    return new IKBCKeyBoard($app);
});

$continer->bind('Computer', function(Container $app){
    return new Comp($app);
});

$cObj = $continer->make('Computer');

