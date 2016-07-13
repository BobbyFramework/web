<?php

namespace BobbyFramework\Web;

class Template extends View
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
     * @var string  title de la page
     */
    private $_title = '';

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

    private $_tpl = null;

    /**
     * initilize choise layout page
     *
     * @param           $layout
     * @param bool|true $isLayoutPredefined
     * @param string $ext
     *
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

    public function setContentPathView($path)
    {
        $this->setPath($path);

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

    public function getTitle()
    {
        return $this->_title;
    }

    public function setTitle($title)
    {
        $this->_title = (string)$title;
        return $this;
    }

    public function displayTheme($data, array $data = array())
    {
        $data = array_merge($data, $this->_vars);
        echo $this->render($data);
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

    public function get($file, $data = array())
    {
        $path = $this->getPath();
        if (false === is_null($this->getTpl())) {
            $path .= $this->getTpl() . '/';
        }

        $file = $path . 'html/' . $file . '.php';

        if (!file_exists($file)) {
            throw new \InvalidArgumentException('la view demander nexiste pas ' . $file);

        }

        return $this->_load($file, $data);
    }

    public function getTpl()
    {
        return $this->_tpl;
    }

    public function setTpl($tpl)
    {
        $this->_tpl = $tpl;
        return $this;
    }

    /**
     * Cette methode permet d'afficher la vues demmander et ajout les donn�e initialize dans le template
     * @param $page
     * @param array $data
     */
    public function displayView($page, array $data = array())
    {
        $data = array_merge($data, $this->_vars);
        $this->display($page, $data);
    }

    public function displayContent(array $data = array())
    {
        echo $this->getContent($data);
    }

    public function getContent(array $data = array())
    {
        $data = array_merge($data, $this->_vars);
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
        // $this->_tabLayout['_content'] = $page;
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
}