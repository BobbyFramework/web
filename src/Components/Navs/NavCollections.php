<?php

namespace BobbyFramework\Web\Components\Navs;

use BobbyFramework\Web\CollectionsComponent;
use BobbyFramework\Web\ComponentInterface;

/**
 * Class NavCollections
 * @package BobbyFramework\Web\Components\Navs
 */
class NavCollections extends CollectionsComponent implements ComponentInterface
{
    /**
     * @var string $title
     */
    protected $title = '';

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
}
