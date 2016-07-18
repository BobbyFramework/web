<?php

namespace BobbyFramework\Web;

class View implements ViewInterface
{
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

    /**-
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


    private $_path;


    public function __construct()
    {

    }

    public function layout($layout)
    {
        if (!$this->_isRun) {
            $this->_isLayout = true;
            $this->_layout = $layout;
        } else throw new \Exception('Le layout ne peut pas etre redifinie dans le layout ');

        return $this;
    }

    public function setPartial($key, $page)
    {
        $this->_tabLayout[$key] = $page;
        return $this;
    }

    public function partialExists($key)
    {
        $return = false;
        if (isset($this->_tabLayout[$key])) {
            $return = true;
        }
        return $return;
    }

    public function setPath($path)
    {
        $this->_path = $path;

        return $this;
    }

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

    public function getVars()
    {
        return $this->_vars;
    }

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

    public function getPath()
    {
        return $this->_path;
    }

    public function get($file, $data = array())
    {
        $file = $this->getPath() . $file . '.php';

        if (!file_exists($file)) {
            throw new \InvalidArgumentException('la view demander nexiste pas ' . $file);

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


    public function display($page, array $data = array())
    {
        echo $this->get($page, $data);
    }

    public function displayContent(array $data = array())
    {
        echo $this->getContent($data);
    }

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

    public function displayPartial($key, array $data = array())
    {
        echo $this->getPartial($key, $data);
    }

    public function getPartial($page, $data = array())
    {
        if (array_key_exists($page, $this->_tabLayout)) {
            $page = $this->_tabLayout[$page];
        } else {
            die('eroor');
        }
        $data = array_merge($data, $this->_vars);
        return $this->get($page, $data);
    }

    public static function create()
    {
        return new static();
    }
}