<?php


namespace core\components\request\multipart;
use core\components\constraint\RequestParseConstraint;
use core\components\request\Request;

class FormData implements RequestParseConstraint
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