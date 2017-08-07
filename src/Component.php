<?php

namespace BobbyFramework\Web;

/**
 * Class Component
 * @package BobbyFramework\Web
 */
abstract class Component
{
    /**
     * @var array $_options
     */
    protected $_options = [];

    /**
     * @var ViewInterface $adapter
     */
    protected $adapter;

    /**
     * Component constructor.
     * @param ViewInterface $view
     * @param array $options
     */
    public function __construct(ViewInterface $view, array $options = [])
    {
        $this->adapter = $view;
        $this->setOptions($options);
    }

    /**
     * @return ViewInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->_options = $options;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setOption($key, $value)
    {
        $this->_options[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasOption($key)
    {
        return isset ($this->_options[$key]);
    }

    /**
     * @param $offset
     * @param null $defaultValue
     * @return null
     */
    public function getOption($offset, $defaultValue = null)
    {
        foreach ($this->_options as $key => $value) {
            if ($offset === $key) {
                return $value;
            }
        }

        return $defaultValue;
    }

    /**
     * @param $file
     * @param array $data
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return mixed|string
     */
    public function render($file, array $data = [], $usingTemplateBase = false, $usingPath = true)
    {
        if ($this->adapter instanceof Template) {
            return $this->adapter->getView($file, $data, $usingTemplateBase, $usingPath);
        }

        return $this->getAdapter()->get($file, $data);
    }
}
