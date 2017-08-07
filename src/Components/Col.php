<?php

namespace BobbyFramework\Web\Components;

/**
 * Class Col
 *
 * @package BobbyFramework\Web\Components
 */
class Col
{
    /**
     * @var
     */
    protected $content;

    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}
