<?php

namespace BobbyFramework\Web\Managers;

use BobbyFramework\Web\Components\Assets;
use BobbyFramework\Web\Components\Breadcrumb;
use BobbyFramework\Web\Components\Row;

/**
 * Class Page
 * @package BobbyFramework\Web\Managers
 */
class Page
{
    /**
     * @var
     */
    protected $_rows;

    /**
     * @var Breadcrumb|null $breadcrumb
     */
    protected $breadcrumb = null;

    /**
     * @var
     */
    protected $navs;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var Assets $assets
     */
    protected $assets;

    /**
     * @var $assets
     */
    protected $metaDescription;

    /**
     * @param Row $row
     */
    public function addRow(Row $row)
    {
        $this->_rows[] = $row;
    }

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->_rows;
    }

    /**
     * @return bool
     */
    public function hasAssets()
    {
        return isset($this->assets);
    }

    /**
     * @param Assets $assets
     * @return $this
     */
    public function setAssets(Assets $assets)
    {
        $this->assets = $assets;

        return $this;
    }

    /**
     * @return Assets
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @return bool
     */
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

    /**
     * @return Navs
     */
    public function getNavs()
    {
        return $this->navs;
    }

    /**
     * @param Navs $nav
     */
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

    /**
     * @param string $metaDescription
     * @return $this
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }
}