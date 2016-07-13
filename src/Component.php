<?php

namespace BobbyFramework\Web;


Abstract class Component extends View
{
    /**
     * @var
     */
    protected $_options = array();

    /**
     * Validator constructor.
     * @param $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @param $options
     */
    public function setOptions($options)
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