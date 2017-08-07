<?php

namespace BobbyFramework\Web;

/**
 * Class View
 * @package BobbyFramework\Web
 */
class Template implements ViewInterface
{
    /**
     *
     */
    const NO_LAYOUT = 2;

    /**
     * @var string
     */
    protected $layoutUsingPath = null;

    /**
     * @var string
     */
    protected $contentPath = null;

    /**
     * @var string
     */
    protected $pathBase = null;

    /**
     * @var string
     */
    protected $layoutUsingTemplateBase = null;

    /**
     * @var string
     */
    protected $contentTemplateBase = null;

    /**
     * @var array
     */
    private $partials = [];

    /**
     * @var bool status run generate layout
     */
    protected $isRun = false;

    /**
     * @var bool status layout is defined
     */
    protected $isLayout = false;

    /**
     * @var null content le layout
     */
    protected $layout = null;

    /**
     * @var array data vars using template
     */
    protected $vars = [];

    /**
     * @var null|string contenue de la view
     */
    protected $content = null;

    /**
     * @var array  name des varaible reserve
     */
    protected $varsNameReserved = [];

    /** @var null|string */
    protected $path = null;

    /**
     * @var bool
     */
    protected $contentIsData = false;

    /**
     * Template constructor.
     * @param null $path
     * @param null $pathBase
     */
    public function __construct($path = null, $pathBase = null)
    {
        $this->setPath($path);
        $this->setPathBase($pathBase);
    }

    /**
     * @param $layout
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return Template $this
     * @throws \Exception
     */
    public function setLayout($layout, $usingTemplateBase = false, $usingPath = true)
    {
        if (!$this->isRun) {
            $this->isLayout = true;
            $this->layout = $layout;
            $this->layoutUsingPath = $usingPath;
            $this->layoutUsingTemplateBase = $usingTemplateBase;
        } else throw new \Exception('Le layout ne peut pas etre redifinie dans le layout ');

        return $this;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getLayout(array $data = [])
    {
        return $this->getView($this->layout, $data, $this->layoutUsingTemplateBase, $this->layoutUsingPath);
    }

    /**
     * @param string $path
     * @return Template $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @param string $key
     */
    public function setVarReserved($key)
    {
        $this->varsNameReserved[] = $key;
    }

    /**
     * @param string $var
     * @param $value
     * @param bool $addReserved
     * @return Template $this
     */
    public function setVar($var, $value, $addReserved = false)
    {
        if (in_array($var, $this->varsNameReserved)) {
            throw new \InvalidArgumentException('Var name is using syteme : ' . $var);
        }

        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit �tre une chaine de caract�re non nulle');
        }
        $this->vars[$var] = $value;

        if (true === $addReserved) {
            $this->setVarReserved($var);
        }
        return $this;
    }

    /**
     * @param array $vars
     * @param bool $merge
     * @return Template $this
     * @internal param bool $clear
     */
    public function setVars(array $vars, $merge = false)
    {
        if (true === $merge) {
            $this->vars = array_merge($this->vars, $vars);
        } else {
            $this->vars = $vars;
        }
        return $this;
    }

    /**
     * @param array $vars
     */
    public function addVars(array $vars)
    {
        $this->setVars($vars, true);
    }


    /**
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getVar($key)
    {
        return $this->vars[$key];
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data = array())
    {
        if (false === $this->isLayout) {
            throw new \RuntimeException('No Layout defined ', self::NO_LAYOUT);
        }
        $this->isRun = true;
        $data = array_merge($data, $this->vars);

        return $this->getLayout($data);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Template $this
     */
    public function setPathBase($path)
    {
        $this->pathBase = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPathBase()
    {
        return $this->pathBase;
    }

    /**
     * @param $file
     * @param array $data
     * @param bool $ext
     * @return string
     */
    public function get($file, array $data = [], $ext = true)
    {
        return View::create()->get($file, $data, $ext);
    }

    /**
     * @param string $file
     * @param array $data
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return string
     */
    public function getView($file, array $data = [], $usingTemplateBase = false, $usingPath = true)
    {
        return $this->_get($file, $data, $usingTemplateBase, $usingPath);
    }

    /**
     * @param string $file
     * @param array $data
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @param null|string $contextViewParent
     * @return string
     * @throws NoViewException
     */
    protected function _get($file, $data = array(), $usingTemplateBase = false, $usingPath = true, $contextViewParent = null)
    {
        $this->setVars($data, true);

        if (true === $usingTemplateBase && true === $usingPath) {
            //on utiliser pas la view du template => default View app current
            return $this->get($this->getPathBase() . $file, $this->getVars());

        } else {
            //on utiliser la view du template (le path) definie => using file defined path
            try {
                $fileDefined = $file;
                if (true === is_bool($usingPath) && true === $usingPath) {
                    $fileDefined = $this->getPath() . $file;
                }

                return $this->get($fileDefined, $this->getVars());

            } catch (NoViewException $e) {

                if ($e->getCode() === View::NO_VIEW) {

                    if (null === $this->getPathBase() && true === $usingTemplateBase) {
                        exit($e->getMessage() . ' no path parent defined');
                    }

                    if (false === $usingPath && true === is_null($contextViewParent)) {
                        exit($e->getMessage());
                    }

                    if (false === is_null($contextViewParent)) {
                        exit('context => ' . $e->getMessage());
                    }
                    //La view definie n'existe pas => default View app current
                    return $this->_get($this->getPathBase() . $file, $this->getVars(), true, false, $e->getNoFile());
                }
            }
        }

        exit('An unknown error occurred');
    }

    /**
     * @param string $file
     * @param array $data
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return string|void
     */
    public function display($file, array $data = array(), $usingTemplateBase = false, $usingPath = true)
    {
        echo $this->getView($file, $data, $usingTemplateBase, $usingPath);
    }

    /**
     * @param string $content
     */
    public function addContent($content)
    {
        $this->content = $content;
        $this->contentIsData = true;
    }

    /**
     * @param string $file
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return Template $this
     */
    public function setContent($file, $usingTemplateBase = false, $usingPath = true)
    {
        $this->content = $file;
        $this->contentPath = $usingPath;
        $this->contentTemplateBase = $usingTemplateBase;
        return $this;
    }

    /**
     * @param array $data
     * @return string
     */
    public function getContent(array $data = array())
    {
        if ($this->contentIsData) {
            return $this->content;
        }
        return $this->getView($this->content, $data, $this->contentTemplateBase, $this->contentPath);
    }

    /**
     * @param array $data
     */
    public function displayContent(array $data = array())
    {
        echo $this->getContent($data);
    }

    /**
     * @return Template
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @param string $key
     * @param string $file
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return Template $this
     */
    public function setPartial($key, $file, $usingTemplateBase = false, $usingPath = true)
    {
        $this->partials[$key] = [
            'content' => $file,
            'usingTemplateBase' => $usingTemplateBase,
            'usingPath' => $usingPath,
            'isContent' => false
        ];
        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasPartials($key)
    {
        return isset($this->partials[(string)$key]);
    }

    /**
     * @return array
     */
    public function getPartialsNames()
    {
        return array_keys($this->partials);
    }

    /**
     * @param string $key
     * @param array $data
     */
    public function displayPartial($key, array $data = array())
    {
        echo $this->getPartial($key, $data);
    }

    /**
     * @param string $key
     * @param array $data
     * @return string
     */
    public function getPartial($key, array $data = array())
    {

        if (array_key_exists($key, $this->getPartials())) {
            $file = $this->getPartialsByKey($key);
        } else {
            throw new \RuntimeException('No Partial defined');
        }

        if (true === $file['isContent']) {
            return $file['content'];
        }

        return $this->getView($file['content'], $data, $file['usingTemplateBase'], $file['usingPath']);
    }

    /**
     * @param string $key
     * @param string $content
     */
    public function addPartial($key, $content)
    {
        $this->partials[$key] = [
            'content' => $content,
            'isContent' => true
        ];
    }

    /**
     * @return array
     */
    public function getPartials()
    {
        return $this->partials;
    }

    /**
     * @param string $key
     * @param null|string $defaultValue
     * @return null|string
     */
    public function getPartialsByKey($key, $defaultValue = null)
    {
        return isset($this->partials[$key]) ? $this->partials[$key] : $defaultValue;
    }

    /**
     * reset all
     */
    public function reset()
    {
        $this->content = null;
        $this->partials = [];
        //TODO implement other...
    }
}
