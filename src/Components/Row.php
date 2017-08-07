<?php

namespace BobbyFramework\Web\Components;

/**
 * Class Row
 * @package BobbyFramework\Web\Components
 */
class Row
{
    /**
     * @var
     */
    protected $cols;

    /**
     * @var
     */
    protected $title;

    /**
     * @param Col $cols
     */
    public function addCols(Col $cols)
    {
        $this->cols[] = $cols;
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param null $defaultValue
     * @return null
     */
    public function getTitle($defaultValue = null)
    {
        return isset ($this->title) ? $this->title : $defaultValue;
    }

    /**
     * @return bool
     */
    public function hasTitle()
    {
        return isset ($this->title);
    }

    /**
     * @return mixed
     */
    public function getCols()
    {
        return $this->cols;
    }

    /**
     * @return int
     */
    public function countCols()
    {
        return count($this->cols);
    }
}
