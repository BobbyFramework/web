<?php

namespace BobbyFramework\Web\Components\Slider;

use BobbyFramework\Web\EntityInterface;

/**
 * Class Slide
 * @package BobbyFramework\Web\Components\Slider
 */
class Slide implements EntityInterface
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
     * @param $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
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

    /**
     * @return mixed
     */
    public function getUid(){
        return  $this->uid;
    }

    /**
     * @return mixed
     */
    public function getImage(){
       return  $this->img;
    }
}
