<?php

namespace BobbyFramework\Web\Managers;

use BobbyFramework\Web\Components\Assets;
use BobbyFramework\Web\Components\Breadcrumb;
use BobbyFramework\Web\Components\Row;

/**
 * Class Page
 *
 * @package BobbyFramework\Web\Managers
 */
class Page
{
    /**
     * @var
     */
    protected $rows;

    /**
     * @var Breadcrumb|null $breadcrumb
     */
    protected $breadcrumb = null;

    /**
     * @var Navs $navs
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
     * @var string $metaDescription
     */
    protected $metaDescription;

    /**
     * @var string $metaKeywords
     */
    protected $metaKeywords;

    /**
     * @var string $metaAuthor
     */
    protected $metaAuthor;

    /**
     * @var string $content content page
     */
    protected $content;

    /**
     * @var string reference unique page
     */
    protected $reference;


    public function __construct($reference = null)
    {
        $this->reference = $reference ?: 'undefined';
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param Row $row
     */
    public function addRow(Row $row)
    {
        $this->rows[] = $row;
    }

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->rows;
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
     *
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
     *
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
     *
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
     *
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

    /**
     * @param string $metaKeywords
     *
     * @return $this
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param $metaAuthor
     *
     * @return $this
     */
    public function setMetaAutor($metaAuthor)
    {
        $this->metaAuthor = $metaAuthor;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaAuthor()
    {
        return $this->metaAuthor;
    }

    /**
     * @param string $content
     */
    public function addContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return bool
     */
    public function hasContent()
    {
        return isset($this->content);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
