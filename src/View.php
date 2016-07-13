<?php

namespace BobbyFramework\Web;

class View
{
    protected $_di = array();

    private $_contentPath = '';


    public static function create()
    {
        return new static();
    }

    public function get($file, $data = array())
    {
        $file = $this->_contentPath . $file . '.php';

        if (!file_exists($file)) {
            throw new \InvalidArgumentException('la view demander nexiste pas ' . $file);

        }

        return $this->_load($file, $data);
    }

    protected function _load($file, $data = array())
    {
        $view = $this;

        $data = array_merge($this->_di, $data);
        extract($data);

        ob_start();
        require $file;
        $content = ob_get_clean();
        return $content;
    }

    public function display($page, array $data = array())
    {
        echo $this->get($page, $data);
    }

    public function getPath()
    {
        return $this->_contentPath;
    }

    public function setPath($path)
    {
        $this->_contentPath = $path;

        return $this;
    }
}