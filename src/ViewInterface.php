<?php

namespace BobbyFramework\Web;

/**
 * Interface ViewInterface
 * @package BobbyFramework\Web
 */
interface ViewInterface
{
    /**
     * @param $file
     * @param array $data
     * @return mixed
     */
    public function get($file, $data = array());

    /**
     * @return mixed
     */
    public static function create();

    /**
     * @param $page
     * @param array $data
     * @return mixed
     */
    public function display($page, array $data = array());

    /**
     * @return mixed
     */
    public function getPath();

    /**
     * @param $path
     * @return mixed
     */
    public function setPath($path);
}