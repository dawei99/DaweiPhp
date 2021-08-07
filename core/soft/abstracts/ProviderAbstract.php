<?php
namespace core\soft\abstracts;
use \core\soft\container\Container;

abstract class ProviderAbstract
{
    protected $app;
    public function __construct(Container $app)
    {
        $this->app = $app;
    }
}
