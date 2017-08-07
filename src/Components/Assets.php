<?php

namespace BobbyFramework\Web\Components;

use BobbyFramework\Web\Helpers\HTMLElements;

/**
 * Class Assets
 *
 * @package BobbyFramework\Web\Components
 */
class Assets
{
    /**
     * @var array
     */
    private $arrayJS = [];

    /**
     * @var array
     */
    private $arrayCSS = [];

    /**
     * @var string
     */
    private $cdn = '';

    /**
     * @param $cdn
     */
    public function setCdn($cdn)
    {
        $this->cdn = $cdn;
    }

    /**
     * @return string
     */
    public function getCdn()
    {
        return $this->cdn;
    }

    /**
     * @param $file
     */
    public function displayCdn($file)
    {
        echo $this->cdn . $file;
    }

    /**
     * @param array $listFiles
     */
    public function addCdn(array $listFiles)
    {
        $this->_add($listFiles, $this->cdn);
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
     * @param bool  $cdn
     */
    public function _add(array $listFiles, $cdn = false)
    {
        $itemAssets = ['js', 'css'];

        foreach ($itemAssets as $item) {
            if (array_key_exists($item, $listFiles)) {
                if ($cdn === true) {

                    array_walk($listFiles[$item], function (&$value, $key) {
                        if (isset($value['src'])) {
                            $value['src'] = $this->cdn . $value['src'];
                        }
                        if (isset($value['href'])) {
                            $value['href'] = $this->cdn . $value['href'];
                        }
                    });
                }

                $this->{'array' . strtoupper($item)} = array_merge($this->{'array' . strtoupper($item)},
                    $listFiles[$item]);
            }
        }
    }

    /**
     * @param $file
     * @param $type
     *
     * @return array
     */
    private function _transformFileArrayJsOrArrayCss($file, $type)
    {
        return [$type => [$file]];
    }

    /**
     * @param      $file
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
     * @param      $file
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
     * @param bool       $cdn
     *
     * @return bool
     */
    public function outputCss(array $file = null, $cdn = false)
    {
        if ($file != null) {
            $this->addCss($file, $cdn);
        }

        return $this->_output($this->arrayCSS, 'css');
    }

    /**
     * @param        $arrayType
     * @param string $type
     *
     * @return bool
     */
    private function _output($arrayType, $type = 'css')
    {
        if (!is_array($arrayType)) {
            return false;
        }

        if (isset($arrayType) && count($arrayType) > 0) {

            foreach ($arrayType as $i => $item) {
                if ($type === 'css') {
                    echo HTMLElements::link(null, $item);
                } else {
                    if ($type === 'js') {
                        echo HTMLElements::script(null, $item);
                    }
                }
            }
        }
    }

    /**
     * @return bool
     */
    public function outputJs()
    {
        return $this->_output($this->arrayJS, 'js');
    }

    /**
     * @return bool
     */
    public function hasJs()
    {
        return !empty($this->arrayJS);
    }

    /**
     * @return bool
     */
    public function hasCss()
    {
        return !empty($this->arrayCSS);
    }
}
