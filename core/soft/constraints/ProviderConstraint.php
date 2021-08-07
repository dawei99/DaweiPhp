<?php
namespace core\soft\constraints;
interface ProviderConstraint {
    public function register();
    public function readyAll();
}