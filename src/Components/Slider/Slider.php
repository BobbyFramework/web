<?php

namespace BobbyFramework\Web\Components\Slider;

use BobbyFramework\Web\ComponentInterface;
use BobbyFramework\Web\Component;
use BobbyFramework\Web\ViewInterface;

/**
 * Class Slider
 * @package BobbyFramework\Web\Components\Slider
 */
class Slider extends Component implements ComponentInterface
{
    /**
     * @var array
     */
    protected $slides = [];

    /**
     * Slider constructor.
     * @param ViewInterface $view
     * @param array $options
     */
    public function __construct(ViewInterface $view, array $options = [])
    {
        parent::__construct($view, $options);
    }

    /**
     * @param Slide $slide
     * @return $this
     */
    public function add(Slide $slide)
    {
        $this->slides[] = $slide;

        return $this;
    }

    /**
     * @param $file
     * @param array $data
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return mixed
     */
    public function render($file, array $data = [], $usingTemplateBase = false, $usingPath = true)
    {
        $data['slides'] = $this->slides;

        return parent::render($file, $data, $usingTemplateBase, $usingPath);
    }
}
