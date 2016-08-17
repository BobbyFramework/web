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

    /**
     * @param $path
     */
    public function setPath($path)
    {
        $this->setOption('path', $path);
    }

    /**
     * @return null
     */
    public function getPath()
    {
        return $this->getOption('path');
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->setOption('name', $name);
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->getOption('name');
    }
}