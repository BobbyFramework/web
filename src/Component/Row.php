<?php

namespace BobbyFramework\Web\Component;


class Row
{
    protected $_cols;
    protected $_title;

    public function addCols(Col $cols)
    {
        $this->_cols[] = $cols;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
    }

    public function getTitle($defaultValue = null)
    {
        return isset ($this->_title) ? $this->_title : $defaultValue;
    }

    public function hasTitle()
    {
        return isset ($this->_title);
    }

    public function getCols()
    {
        return $this->_cols;
    }

    public function countCols()
    {
        return count($this->_cols);
    }
}