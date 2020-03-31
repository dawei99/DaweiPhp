<?php


namespace core\soft\constraint;


use core\soft\request\Request;

interface RequestParseConstraint
{
    public function parse(Request $request)  : array;
}