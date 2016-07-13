<?php

namespace BobbyFramework\Web\Component\Slider;

class Slide
{
    protected $_img;
    protected $_href;
    protected $_imgThumbnail;

    public function setHref($href)
    {
        $this->_href = $href;
        return $this;
    }

    public function setImage($img)
    {
        $this->_img = $img;
        return $this;
    }
    public function setImageThumbnail($img){
        $this->_imgThumbnail = $img;
        return $this;
    }

}