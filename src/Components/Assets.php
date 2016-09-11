<?php

namespace BobbyFramework\Web\Components;

use BobbyFramework\Web\Helpers\HTMLElements;

class Assets
{
    private $_arrayJS = array();
    private $_arrayCSS = array();

    private $_cdn = '';

    /**
     * @param $cdn
     */
    public function setCdn($cdn)
    {
        $this->_cdn = $cdn;
    }

    /**
     * @return string
     */
    public function getCdn()
    {
        return $this->_cdn;
    }

    public function displayCdn($file)
    {
        echo $this->_cdn . $file;
    }

    public function addCdn(array $listFiles)
    {
        $this->_add($listFiles, $this->_cdn);
    }

    public function add(array $listFiles)
    {
        $this->_add($listFiles);
    }

    public function _add(array $listFiles, $cdn = false)
    {
        $itemAssets = array('js', 'css');

        foreach ($itemAssets as $item) {
            if (array_key_exists($item, $listFiles)) {
                if ($cdn === true) {
                    array_walk($listFiles[$item], function (&$value, $key) {
                        $value = $this->_cdn . $value;
                    });
                }

                $this->{'_array' . strtoupper($item)} = array_merge($this->{'_array' . strtoupper($item)}, $listFiles[$item]);
            }
        }
    }

    private function _transformFileArrayJsOrArrayCss($file, $type)
    {
        return array($type => array($file));
    }

    public function addJs($file, $cdn = false)
    {
        $this->_add($this->_transformFileArrayJsOrArrayCss($file, 'js'), $cdn);
    }

    public function addCdnJs($file)
    {
        $this->addJs($file, true);
    }

    public function addCss($file, $cdn = false)
    {

        $this->_add($this->_transformFileArrayJsOrArrayCss($file, 'css'), $cdn);
    }

    public function addCdnCss($file)
    {
        $this->addCss($file, true);
    }

    public function outputCss(array $file = null, $cdn = false)
    {
        if ($file != null) {
            $this->addCss($file, $cdn);
        }
        return $this->_output($this->_arrayCSS, 'css');
    }

    private function _output($arrayType, $type = 'css')
    {
        if (!is_array($arrayType))
            return false;

        if (isset($arrayType) && count($arrayType) > 0) {

            foreach ($arrayType as $i => $item) {
                if ($type === 'css') {
                    echo HTMLElements::link(null, $item);
                } elseif ($type === 'js') {
                    echo HTMLElements::script(null, $item);
                }
            }
        }
    }

    public function outputJs()
    {
        return $this->_output($this->_arrayJS, 'js');
    }
}