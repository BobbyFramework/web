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
     * Validator constructor.
     * @param $options
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

    public function setTemplatePath($path)
    {
        $this->setOption('templatePath', $path);
    }

    public function getTemplatePath()
    {
        return $this->getOption('templatePath');
    }

    public function setTemplateName($name)
    {
        $this->setOption('templateName', $name);
    }

    public function getTemplateName()
    {
        return $this->getOption('templateName');
    }
}