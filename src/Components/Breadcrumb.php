<?php

namespace BobbyFramework\Web\Components;

use BobbyFramework\Web\ComponentInterface;
use BobbyFramework\Web\Component;
use BobbyFramework\Web\ViewInterface;

/**
 * Class Breadcrumb
 *
 * @package BobbyFramework\Web\Component
 */
class Breadcrumb extends Component implements ComponentInterface
{
    /**
     * array $breadcrumbs
     */
    public $breadcrumbs = [];

    /**
     * @var int
     */
    private $countChild = 0;

    /**
     *
     */
    const FIRST_CHILD = 0;

    /**
     * Breadcrumb constructor.
     *
     * @param ViewInterface $view
     * @param array         $options
     */
    public function __construct(ViewInterface $view, array $options = [])
    {
        parent::__construct($view, $options);
    }

    /**
     * @param string $title
     * @param bool   $url
     * @param array  $attributes
     */
    public function add($title, $url = false, array $attributes = [])
    {
        $this->breadcrumbs[$this->countChild] = [
            'content'         => $title,
            'url'             => $url,
            'attribute'       => $attributes,
            'content_element' => false,
        ];

        $this->countChild++;
    }

    /**
     * @param $html
     */
    public function addSpecific($html)
    {
        $this->breadcrumbs[$this->countChild] = [
            'content'         => false,
            'url'             => false,
            'attribute'       => false,
            'content_element' => $html,
        ];

        $this->countChild++;
    }

    /**
     * @param $title
     */
    public function active($title)
    {
        $attributes = [
            'class' => 'active',
        ];
        $this->add($title, false, $attributes);
    }

    /**
     * @param       $file
     * @param array $data
     * @param bool  $usingTemplateBase
     * @param bool  $usingPath
     *
     * @return mixed|string|void
     */
    public function render($file, array $data = [], $usingTemplateBase = false, $usingPath = true)
    {
        if (empty($this->breadcrumbs)) {
            return;
        }
        $data['breadcrumbs'] = $this->breadcrumbs;

        parent::render($file, $data, $usingTemplateBase, $usingPath);
    }

	/**
	 * @param       $file
	 * @param array $data
	 * @param bool  $usingTemplateBase
	 * @param bool  $usingPath
	 *
	 * @internal param array $attributes
	 */
    public function display($file, array $data = [], $usingTemplateBase = false, $usingPath = true)
    {
        echo $this->render($file, $data, $usingTemplateBase, $usingPath);
    }
}
