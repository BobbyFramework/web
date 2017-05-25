<?php

namespace BobbyFramework\Web\Components;

use BobbyFramework\Web\Helpers\HTMLElements;

/**
 * Class Assets
 * @package BobbyFramework\Web\Components
 */
class Assets
{
    /**
     * @var array
     */
    private $_arrayJS = array();

    /**
     * @var array
     */
    private $_arrayCSS = array();

    /**
     * @var string
     */
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

    /**
     * @param $file
     */
    public function displayCdn($file)
    {
        echo $this->_cdn . $file;
    }

    /**
     * @param array $listFiles
     */
    public function addCdn(array $listFiles)
    {
        $this->_add($listFiles, $this->_cdn);
    }

    /**
     * @param array $listFiles
     */
    public function add(array $listFiles)
    {
        $this->_add($listFiles);
    }

    /**
     * @param array $listFiles
     * @param bool $cdn
     */
    public function _add(array $listFiles, $cdn = false)
    {
        $itemAssets = array('js', 'css');

        foreach ($itemAssets as $item) {
            if (array_key_exists($item, $listFiles)) {
                if ($cdn === true) {

                    array_walk($listFiles[$item], function (&$value, $key) {
                        if(isset( $value['src'])) {
                            $value['src'] = $this->_cdn . $value['src'];
                        }
                        if(isset( $value['href'])) {
                            $value['href'] = $this->_cdn . $value['href'];
                        }
                    });
                }

                $this->{'_array' . strtoupper($item)} = array_merge($this->{'_array' . strtoupper($item)}, $listFiles[$item]);
            }
        }
    }

    /**
     * @param $file
     * @param $type
     * @return array
     */
    private function _transformFileArrayJsOrArrayCss($file, $type)
    {
        return array($type => array($file));
    }

    /**
     * @param $file
     * @param bool $cdn
     */
    public function addJs($file, $cdn = false)
    {

        $this->_add($this->_transformFileArrayJsOrArrayCss($file, 'js'), $cdn);
    }

    /**
     * @param $file
     */
    public function addCdnJs($file)
    {
        $this->addJs($file, true);
    }

    /**
     * @param $file
     * @param bool $cdn
     */
    public function addCss($file, $cdn = false)
    {

        $this->_add($this->_transformFileArrayJsOrArrayCss($file, 'css'), $cdn);
    }

    /**
     * @param $file
     */
    public function addCdnCss($file)
    {
        $this->addCss($file, true);
    }

    /**
     * @param array|null $file
     * @param bool $cdn
     * @return bool
     */
    public function outputCss(array $file = null, $cdn = false)
    {
        if ($file != null) {
            $this->addCss($file, $cdn);
        }
        return $this->_output($this->_arrayCSS, 'css');
    }

    /**
     * @param $arrayType
     * @param string $type
     * @return bool
     */
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

    /**
     * @return bool
     */
    public function outputJs()
    {
        return $this->_output($this->_arrayJS, 'js');
    }

    /**
     * @return bool
     */
    public function hasJs()
    {
        return !empty($this->_arrayJS);
    }

    /**
     * @return bool
     */
    public function hasCss()
    {
        return !empty($this->_arrayCSS);
    }
}
