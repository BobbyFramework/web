<?php

namespace BobbyFramework\Web\Components\Navs;
use BobbyFramework\Web\EntityInterface;

/**
 * Class Nav
 * @package BobbyFramework\Web\Components\Navs
 */
class Nav implements EntityInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $href;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $alt;

    /**
     * @var boolean
     */
    protected $status;

    /**
     * @var array
     */
    protected $children = false;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * Nav constructor.
     * @param null|string $content
     * @param null|string $href
     */
    public function __construct($content = null, $href = null)
    {
        $this->setContent($content);
        $this->setHref($href);
        $this->setStatus(true);

        $this->active = false;
    }


    public function setName($id) {
        $this->name = $id;
    }

    public function getName(){
        return $this->name;
    }
    /**
     * @param string $title
     * @return $this
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
     * @return $this
     */
    public function active()
    {
        $this->active = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $alt
     * @return $this
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param boolean $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $href
     * @return $this
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $nav
     * @return $this
     */
    public function setChildren($nav)
    {
        $this->children = $nav;

        return $this;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }
}
