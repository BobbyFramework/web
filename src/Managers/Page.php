<?php

namespace BobbyFramework\Web\Managers;

use BobbyFramework\Web\Components\Assets;
use BobbyFramework\Web\Components\Breadcrumb;
use BobbyFramework\Web\Components\Row;

class Page
{
    protected $_rows;
    /**
     * @var Breadcrumb|null $breadcrumb
     */
    protected $breadcrumb = null;
    protected $navs;
    /**
     * @var string $title
     */
    protected $title;
    protected $assets;
    protected $metaDescription;

    public function addRow(Row $row)
    {
        $this->_rows[] = $row;
    }

    public function getRows()
    {
        return $this->_rows;
    }

    public function render()
    {

    }

    public function setAssets(Assets $assets)
    {
        $this->assets = $assets;
        return $this;
    }

    public function getAssets()
    {
        return $this->assets;
    }

    public function hasBreadcrumb()
    {
        return isset($this->breadcrumb);
    }

    /**
     * @param Breadcrumb $breadcrumb
     * @return Page $this
     */
    public function setBreadcrumb(Breadcrumb $breadcrumb)
    {
        $this->breadcrumb = $breadcrumb;
        return $this;
    }

    /**
     * @return Breadcrumb
     */
    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    public function getNavs()
    {
        return $this->navs;
    }

    public function setNavs(Navs $nav)
    {
        $this->navs = $nav;
    }

    /**
     * @param string $title
     * @return Page $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getMetaDescription()
    {
        return $this->metaDescription;
    }
}