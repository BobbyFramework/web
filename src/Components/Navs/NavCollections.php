<?php

namespace BobbyFramework\Web\Components\Navs;

use BobbyFramework\Web\Component;
use BobbyFramework\Web\ComponentInterface;
use BobbyFramework\Web\Template;
use BobbyFramework\Web\View;
use BobbyFramework\Web\ViewInterface;

/**
 * Class NavCollections
 * @package BobbyFramework\Web\Components\Navs
 */
class NavCollections extends Component implements ComponentInterface
{

    /**
     * @var array $navs
     */
    protected $navs = [];
    /**
     * @var string|null $name
     */
    protected $name;

    /**
     * NavCollections constructor.
     * @param ViewInterface $name
     * @param ViewInterface|null $view
     * @param array $options
     */
    public function __construct($name, ViewInterface $view = null, array $options = [])
    {
        $view = $view ?: new View();
        parent::__construct($view, $options);
        $this->setName($name);
    }

    /**
     * @param Nav $nav
     */
    public function add(Nav $nav)
    {
        $this->navs[] = $nav;
    }

    /**
     * @return array
     *
     */
    public function getAll()
    {
        return $this->navs;
    }

    /**
     * Remove list nav
     */
    public function clear()
    {
        $this->navs = [];
    }

    /**
     * @param string $name
     * @return NavCollections $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $file
     * @param array $data
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return mixed
     */
    public function render($file, array $data = [], $usingTemplateBase = false, $usingPath = true)
    {
        $data['navCollection'] = $this;

        return parent::render($file, $data, $usingTemplateBase, $usingPath);
    }
}