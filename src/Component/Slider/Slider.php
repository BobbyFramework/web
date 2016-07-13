<?php

namespace BobbyFramework\Web\Component\Slider;

use BobbyFramework\Web\ComponentInterface;
use BobbyFramework\Web\Component;

class Slider extends Component implements ComponentInterface
{
    protected $_slide = null;

    protected $_optionsDefault = [
        "templateName" => 'element-slider'
    ];

    public function __construct(array $options = [])
    {
        $options = array_merge($this->_optionsDefault, $options);
        parent::__construct($options);
    }

    public function add(Slide $slide)
    {
        $this->_slide[] = $slide;
        return $this;
    }

    public function render(array $data = [])
    {
        $data['slides'] = $this->_slide;

        return $this->get($this->getTemplatePath() . $this->getTemplateName(), $data);
    }
}
