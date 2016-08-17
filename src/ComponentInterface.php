<?php
namespace BobbyFramework\Web;

/**
 * Interface ComponentInterface
 * @package BobbyFramework\Web
 */
interface ComponentInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function render(array $data = []);
}