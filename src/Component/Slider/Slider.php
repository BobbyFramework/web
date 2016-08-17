<?php

namespace BobbyFramework\Web\Component\Slider;

use BobbyFramework\Web\ComponentInterface;
use BobbyFramework\Web\Component;
use BobbyFramework\Web\ViewInterface;

class Slider extends Component implements ComponentInterface
{
    protected $_slide = null;

    protected $_optionsDefault = [
        "templateName" => 'Elements/element-slider'
    ];

    public function __construct(ViewInterface $view, array $options = [])
    {
        $options = array_merge($this->_optionsDefault, $options);
        parent::__construct($view, $options);
    }

    public function add(Slide $slide)
    {
        $this->_slide[] = $slide;
        return $this;
    }

    public function render(array $data = [])
    {
        $data['slides'] = $this->_slide;

        return $this->getAdapter()->get($this->getPath() . $this->getName(), $data);
    }
}
