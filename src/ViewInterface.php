<?php

namespace BobbyFramework\Web;

interface ViewInterface
{
    /**
     * @param $file
     * @param array $data
     * @return mixed
     */
    public function get($file, $data = array());

    public static function create();

    public function display($page, array $data = array());

    public function getPath();

    public function setPath($path);
}