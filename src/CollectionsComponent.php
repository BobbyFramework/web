<?php
namespace BobbyFramework\Web;

abstract class CollectionsComponent extends Component
{
    protected $collection = [];
    protected $name;

    public function __construct($name, ViewInterface $view = null, array $options = [])
    {
        $view = $view ?: new View();
        parent::__construct($view, $options);
        $this->setName($name);
    }

    public function getAll()
    {
        return $this->collection;
    }

    public function add(EntityInterface $entity)
    {
        $this->collection[] = $entity;
    }

    /**
     * @param string $name
     * @return  $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Remove
     */
    public function clear()
    {
        $this->collection = [];
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
        $data['elements'] = $this->collection;

        return parent::render($file, $data, $usingTemplateBase, $usingPath);
    }
}