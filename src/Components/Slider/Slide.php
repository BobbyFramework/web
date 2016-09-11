<?php

namespace BobbyFramework\Web\Components\Slider;

class Slide
{
    /**
     * @var
     */
    protected $img;
    /**
     * @var
     */
    protected $href;
    /**
     * @var
     */
    protected $thumbnails = [];

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
     * @param string $img
     * @return $this
     */
    public function setImage($img)
    {
        //TODO File existe
        $this->img = $img;
        return $this;
    }

    /**
     * @param $img
     * @return $this
     */
    public function setThumbnails(array $img)
    {
        $this->thumbnails = $img;
        return $this;
    }

}