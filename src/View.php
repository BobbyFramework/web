<?php

namespace BobbyFramework\Web;

class View implements ViewInterface
{
    const NO_VIEW = 1;
    /**
     * @var array
     */
    private $_tabLayout = array();

    /**
     * @var bool status run generate layout
     */
    private $_isRun = false;

    /**
     * @var bool status layout is defined
     */
    private $_isLayout = false;

    /**
     * @var null content le layout
     */
    private $_layout = null;

    /**
     * @var array data vars using template
     */
    Private $_vars = array();

    /**
     * @var null contenue de la view
     */
    private $_content = null;

    /**
     * @var array  name des varaible reserve
     */
    private $_varsNameReserved = array(
        'theme',
        'view',
        'title',
    );
    /** @var  null|string */
    private $_path = null;

    /**
     * @param $layout
     * @return $this
     * @throws \Exception
     */
    public function layout($layout)
    {
        if (!$this->_isRun) {
            $this->_isLayout = true;
            $this->_layout = $layout;
        } else throw new \Exception('Le layout ne peut pas etre redifinie dans le layout ');

        return $this;
    }

    /**
     * @param $key
     * @param $page
     * @return $this
     */
    public function setPartial($key, $page)
    {
        $this->_tabLayout[$key] = $page;
        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function partialExists($key)
    {
        $return = false;
        if (isset($this->_tabLayout[$key])) {
            $return = true;
        }
        return $return;
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->_path = $path;

        return $this;
    }

    /**
     * @param $var
     * @param $value
     * @return $this
     */
    public function setVar($var, $value)
    {
        if (in_array($var, $this->_varsNameReserved)) {
            throw new \InvalidArgumentException('Var name is using syteme ');
        }

        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit �tre une chaine de caract�re non nulle');
        }
        $this->_vars[$var] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getVars()
    {
        return $this->_vars;
    }

    /**
     * @param array $data
     * @return string
     */
    public function render($data = array())
    {
        $this->_isRun = true;
        $content = '';
        $data = array_merge($data, $this->_vars);
        if ($this->_isLayout) {
            $content = $this->get($this->_layout, $data);
        }

        return $content;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * @param $file
     * @param array $data
     * @param bool $usingPath
     * @return string
     */
    public function get($file, $data = array(), $usingPath = true)
    {
        if (true === $usingPath) {
            $file = $this->getPath() . $file . '.php';
        }

        if (!file_exists($file)) {
            throw new \RuntimeException('la view demander nexiste pas ' . $file, self::NO_VIEW);
        }

        $view = $this;

        $data = array_merge($data, $this->_vars);
        extract($data);

        ob_start();
        require $file;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * @param $page
     * @param array $data
     */
    public function display($page, array $data = array())
    {
        echo $this->get($page, $data);
    }

    /**
     * @param array $data
     */
    public function displayContent(array $data = array())
    {
        echo $this->getContent($data);
    }

    /**
     * @param array $data
     * @return mixed|string
     */
    public function getContent(array $data = array())
    {
        return $this->get($this->_content, $data);
    }

    /**
     * initilize choise view content page
     *
     * @param $page
     *
     * @return $this
     */
    public function setContent($page)
    {
        $this->_content = $page;

        return $this;
    }

    /**
     * @param $key
     * @param array $data
     */
    public function displayPartial($key, array $data = array())
    {
        echo $this->getPartial($key, $data);
    }

    /**
     * @param $page
     * @param array $data
     * @return mixed|string
     */
    public function getPartial($page, array $data = array())
    {
        if (array_key_exists($page, $this->_tabLayout)) {
            $page = $this->_tabLayout[$page];
        } else {
            die('eroor');
        }
        $data = array_merge($data, $this->_vars);
        return $this->get($page, $data);
    }

    /**
     * @return static
     */
    public static function create()
    {
        return new static();
    }
}