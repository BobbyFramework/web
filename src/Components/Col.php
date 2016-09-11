<?php

namespace BobbyFramework\Web\Components;

class Col
{
    protected $content;

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}
