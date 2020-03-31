<?php


namespace core\soft\view;

use function Composer\Autoload\includeFile;

/**
 * 绘制模板
 * @package core\components
 */
class View
{
    protected $layoutDir = "layout"; //结构文件目录
    protected $layoutFile = "index"; //结构文件目录
    protected $view = "views"; //视图文件目录
    protected $suffix = ".php"; //模板文件后缀

    /**
     * 渲染模板
     * @param string $draw
     * @param array $param
     * @return mixed
     * @throws \Exception
     */
    public function draw(string $draw, array $param=[])
    {
        $content = $this->drawFileOb(...func_get_args());
        extract(['content' => $content], EXTR_OVERWRITE);
        return include __ROOT__ . __DIRS__ . "{$this->view}" . __DIRS__ . "{$this->layoutDir}" . __DIRS__ . "{$this->layoutFile}{$this->suffix}";
    }
    /**
     * 纯净渲染模板
     * @param string $draw
     * @param array $param
     * @return mixed
     * @throws \Exception
     */
    public function drawPure(string $draw, array $param=[])
    {
        return $this->drawFileOb(...func_get_args());
    }

    /**
     * 内存形式存储模板
     * @param string $file
     * @param array $param
     * @return mixed
     * @throws \Exception
     */
    protected function drawFileMem(string $draw, array $param=[])
    {
        extract($param, EXTR_OVERWRITE);
        $viewFile = __ROOT__ . __DIRS__ . "{$this->view}" . __DIRS__ . "$draw{$this->suffix}";
        if (!file_exists($viewFile)) throw new \Exception('模板不存在:'.$viewFile);
        return file_get_contents($viewFile);
    }


    /**
     * ob缓冲形式存储模板[首选]
     * @param string $draw
     * @param array $param
     * @return bool
     * @throws \Exception
     */
    protected function drawFileOb(string $draw, array $param=[])
    {
        $viewFile = __ROOT__ . __DIRS__ . "{$this->view}" . __DIRS__ . "$draw{$this->suffix}";
        if (!file_exists($viewFile)) throw new \Exception('模板不存在:'.$viewFile);
        ob_start();
        extract($param, EXTR_OVERWRITE);
        require $viewFile;
        return ob_get_clean();
    }
}
