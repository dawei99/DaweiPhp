<?php


namespace core\soft\request\multipart;
use core\base\BaseObject;
use core\soft\constraint\RequestParseConstraint;
use core\soft\request\Request;

class FormData extends BaseObject implements RequestParseConstraint
{
    /**
     * 解析方法
     * @param $original
     */
    public function parse(Request $request) : array
    {
        // 如果方法时post时PHP已经解析，直接使用即可
        if ($request->getMethod() == "POST") {
            return $_POST;
        } else {
            return [];
        }
    }
}