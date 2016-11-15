<?php

namespace BobbyFramework\Web\Components\SocialNetwork;

use BobbyFramework\Web\EntityInterface;

/**
 * Class Social
 * @package BobbyFramework\Web\Components\S
 */
class Social implements EntityInterface
{
    /**
     * @var string $label
     */
    protected $label;

    /**
     * @var array $optionsLink
     */
    protected $optionsLink = [];

    /**
     * @var string $icon
     */
    protected $icon;

    /**
     * @param $label
     * @param array $optionsLink
     * @return $this
     */
    public function setLabel($label, array $optionsLink = [])
    {
        $this->label = $label;
        $this->optionsLink = $optionsLink;
        return $this;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @param string $href
     * @return $this
     */
    public function setHref($href)
    {
        $this->optionsLink['href'] = $href;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getHref()
    {
        return $this->optionsLink['href'];
    }

    public function getOptionsLink()
    {
        return $this->optionsLink;
    }

}