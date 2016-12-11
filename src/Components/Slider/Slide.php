<?php

namespace BobbyFramework\Web\Components\Slider;

use BobbyFramework\Web\EntityInterface;

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
    public function getUid(){
        return  $this->uid;
    }

    public function getImage(){
       return  $this->img;
    }

}