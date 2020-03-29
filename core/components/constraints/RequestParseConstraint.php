<?php


namespace core\components\constraint;


use core\components\request\Request;

interface RequestParseConstraint
{
    public function parse(Request $request)  : array;
}