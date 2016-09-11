<?php
namespace BobbyFramework\Web\Components;

use BobbyFramework\Web\ComponentInterface;
use BobbyFramework\Web\Component;
use BobbyFramework\Web\ViewInterface;

/**
 * Class Breadcrumb
 * @package BobbyFramework\Web\Component
 */
class Breadcrumb extends Component implements ComponentInterface
{
    /**
     * array $breadcrumbs
     */
    public $breadcrumbs = array();

    /**
     * Breadcrumb constructor.
     * @param ViewInterface $view
     * @param array $options
     */
    public function __construct(ViewInterface $view, array $options = [])
    {
        parent::__construct($view, $options);
    }

    /**
     * @param string $title
     * @param bool $url
     * @param array $active
     */
    public function add($title, $url = false, array $active = array())
    {
        $this->breadcrumbs[] = array(
            'content' => $title,
            'url' => $url,
            'attribute' => $active,
            'content_element' => false
        );
    }

    /**
     * @param $html
     */
    public function addSpecific($html)
    {
        $this->breadcrumbs[] = array(
            'content' => false,
            'url' => false,
            'attribute' => false,
            'content_element' => $html
        );
    }

    /**
     * @param $title
     */
    public function active($title)
    {
        $attributes = array(
            'class' => 'active'
        );
        $this->add($title, false, $attributes);
    }

    /**
     * @param $file
     * @param array $data
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return mixed|string|void
     */
    public function render($file, array $data = [], $usingTemplateBase = false, $usingPath = true)
    {
        if (empty($this->breadcrumbs)) {
            return;
        }
        $data['breadcrumbs'] = $this->breadcrumbs;

        return parent::render($file, $data, $usingTemplateBase, $usingPath);
    }

    /**
     * @param array $attributes
     */
    public function display(array $attributes = array())
    {
        echo $this->render($attributes);
    }
}
