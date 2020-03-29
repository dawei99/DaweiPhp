<?php


namespace core\components\request;


class Request
{
    protected $dividingModeUrlName = 'd'; // nginx重写参数
    private $mode;
    private $home = 'index/index';
    private $parses = null;

    protected $_bodyParams = null; // body参数
    protected $_queryParams = null; // get参数

    public function __construct(array $config)
    {
        $this->parses = $config['parses'] ?? [];
        $this->mode = $config['mode'] ?? 1;
        $this->home = $config['home'] ?? '';
    }

    public function fullUrl() : string
    {
        return $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
    }

    /**
     * 获取content-type头信息
     * @return mixed|null
     */
    public function getHeaderContentType()
    {
        $headers = $this->getHeaders();
        if (isset($headers['Content-Type'])) {
            return $headers['Content-Type'];
        } else {
            return null;
        }
    }

    /**
     * 获取请求头
     * @return array|false
     */
    public function getHeaders()
    {
        return getallheaders();
    }

    /**
     * 获取请求原始body数据
     * @return false|string
     */
    public function getBodyOriginal()
    {
        return file_get_contents('php://input');
    }

    /**
     * 获取所有url参数
     * @return null
     */
    public function getParams() : array
    {
        if ($this->_queryParams === null) {
            $modeFunc = [
                1 => "_modeGeneral",
                2 => "_modeDividing",
            ];
            $modeFun = $modeFunc[$this->mode];
            $this->_queryParams = $this->$modeFun();
        }
        return $this->_queryParams;
    }

    /**
     * 普通模式
     */
    private function _modeGeneral() : array
    {
        $paramsStr = parse_url($this->fullUrl(), PHP_URL_QUERY);
        $paramsArr = [];
        if (
            $paramsStr &&
            $params = explode('&', $paramsStr)
        ) {
            foreach ($params AS $value) {
                $valueArr = explode('=', $value);
                $paramsArr[$valueArr[0]] = $valueArr[1];
            }
        }
        return $paramsArr;
    }

    /**
     * 斜线模式
     */
    private function _modeDividing() : array
    {
        //TODO 斜线模式待开发

    }

    /**
     * 获取请求body体
     */
    public function getBodyParam()
    {
        if ($this->_bodyParams === null) {
            $contentType = $this->getHeaderContentType();
            if ($contentType) {
                $contentType = explode(';',$contentType)[0];
                if ($this->parses) {
                    if (!array_key_exists($contentType, $this->parses)) throw new \Exception('无法解析'.$contentType.'类型数据');
                    $parseClassName = $this->parses[$contentType];
                    if (!class_exists($parseClassName)) throw new \Exception('该类型解析器无法找到'.$contentType);
                    $parseClass = new $parseClassName();
                    return $parseClass->parse($this);
                }
            } else {
                return null;
            }
        }
        return $this->_bodyParams;
    }

    /**
     * 获取url参数
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key="")
    {
        return $this->getParams()[$key] ?? null;
    }

    /**
     * 获取请求方式
     * @return mixed
     */
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
