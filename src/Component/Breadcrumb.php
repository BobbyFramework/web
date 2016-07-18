<?php
namespace BobbyFramework\Web\Component;

use BobbyFramework\Web\ComponentInterface;
use BobbyFramework\Web\Component;
use BobbyFramework\Web\ViewInterface;

/**
 * Class Breadcrumb
 * @package BobbyFramework\Web\Component
 */
class Breadcrumb extends Component implements ComponentInterface
{

    protected $_optionsDefault = [
        "templateName" => 'Elements/element-breadcrumb'
    ];

    public function __construct(ViewInterface $view,array $options = [])
    {
        $options = array_merge($this->_optionsDefault, $options);
        parent::__construct($view,$options);
    }

    /**
     * array of breadcrumbs
     */
    public $breadcrumbs = array();

    /**
     * @param $title
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
     * @param array $data
     * @return string|void
     */
    public function render(array $data = [])
    {
        if (empty($this->breadcrumbs)) {
            return;
        }
        $data['breadcrumbs'] = $this->breadcrumbs;

        return $this->getAdapter()->get($this->getTemplatePath() . $this->getTemplateName(), $data);
    }

    /**
     * @param array $attributes
     */
    public function display(array $attributes = array())
    {
        echo $this->render($attributes);
    }
}
