<?php

namespace BobbyFramework\Web\Managers;

use BobbyFramework\Web\Components\Navs\Nav;
use BobbyFramework\Web\Components\Navs\NavCollections;

/**
 * Class Navs
 * @package BobbyFramework\Web\Managers
 */
class Navs
{
    /**
     * @var array $navs
     */
    protected $navs = [];

    /**
     * @param NavCollections $navCollection
     */
    public function add(NavCollections $navCollection)
    {
        //todo name not definie => unid
        $this->navs[$navCollection->getName()] = $navCollection;
    }

    /**
     * @param string $key
     * @param Nav $nav
     * @return Navs $this
     */
    public function set($key, Nav $nav)
    {
        //todo verifier exist
        $this->navs[$key]->add($nav);
        return $this;
    }

    /**
     * @param string $key
     * @return NavCollections
     */
    public function get($key)
    {
        return $this->navs[$key];
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->navs;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset ($this->navs[$key]);
    }
}
