<?php

namespace BobbyFramework\Web\Components;

/**
 * Class Site
 * @package BobbyFramework\Web
 */
class Site
{
    /**
     * @var string
     */
    private $copyright;
    /**
     * @var string
     */
    private $pathLogo;

    /**
     * @param string $copyright
     * @return $this
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * @param $pathLogo
     * @return $this
     */
    public function setPathLogo($pathLogo)
    {
        $this->pathLogo = $pathLogo;

        return $this;
    }

    /**
     * @return string
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * @return string
     */
    public function getPathLogo()
    {
        return $this->pathLogo;
    }
}