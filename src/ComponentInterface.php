<?php
namespace BobbyFramework\Web;

/**
 * Interface ComponentInterface
 * @package BobbyFramework\Web
 */
interface ComponentInterface
{
    /**
     * @param $file
     * @param array $data
     * @param bool $usingTemplateBase
     * @param bool $usingPath
     * @return mixed
     */
    public function render($file, array $data = [], $usingTemplateBase = false, $usingPath = true);
}