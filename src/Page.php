<?php

namespace BobbyFramework\Web;

use BobbyFramework\Web\Component\Assets;
use BobbyFramework\Web\Component\Breadcrumb;
use BobbyFramework\Web\Component\Nav;
use BobbyFramework\Web\Component\Row;

class Page
{
    protected $_rows;
    protected $_breadcrumb;
    protected $_navs;
    protected $_title;
    protected $_assets;
    protected $_metaDescription;

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
        $this->_assets = $assets;
        return $this;
    }

    public function getAssets()
    {
        return $this->_assets;
    }

    public function setBreadcrumb(Breadcrumb $breadcrumb)
    {
        $this->_breadcrumb = $breadcrumb;
        return $this;
    }

    public function getBreadcrumb()
    {
        return $this->_breadcrumb;
    }

    public function getNavs()
    {
        return $this->_navs;
    }

    public function setNavs(Nav $nav)
    {
        $this->_navs[] = $nav;
    }

    public function setTitle($title)
    {
        $this->_title = $title;

        return $this;
    }

    public function setMetaDescription($metaDescription)
    {
        $this->_metaDescription = $metaDescription;

        return $this;
    }

    public function getMetaDescription()
    {
        return $this->_metaDescription;
    }
}