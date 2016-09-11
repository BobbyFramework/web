<?php

namespace BobbyFramework\Web;

/**
 * Class Component
 * @package BobbyFramework\Web
 */
Abstract class Component
{
    /** @var array $_options */
    protected $_options = array();
    /** @var ViewInterface $_adapter */
    protected $_adapter;

    /**
     * Component constructor.
     * @param ViewInterface $view
     * @param array $options
     */
    public function __construct(ViewInterface $view, array $options = [])
    {
        $this->_adapter = $view;
        $this->setOptions($options);
    }

    /**
     * @return ViewInterface
     */
    public function getAdapter()
    {
        return $this->_adapter;
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

    public function render($file, array $data = [], $usingTemplateBase = false, $usingPath = true)
    {
        if ($this->_adapter instanceof Template) {
            return $this->_adapter->getView($file, $data, $usingTemplateBase, $usingPath);
        }

        return $this->getAdapter()->get($file, $data);
    }
}