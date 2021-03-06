<?php

namespace BobbyFramework\Web\Helpers;

/**
 * Class HTMLElements
 *
 * @package BobbyFramework\Web\Helpers
 */
class HTMLElements
{
    /**
     * @param array $attributes
     *
     * @return string
     */
    public static function arrayToAttributes(array $attributes)
    {
        //Build a list of single attributes first
        $attributeList = [];
        foreach ($attributes as $key => $value) {
            // If the value is not false add the attribute. This allows attributes to not be shown.
            if ($value !== false) {
                if (is_string($key)) {
                    $attributeList[] = htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
                } else {
                    $attributeList[] = $value;
                }
            }
        }

        return implode(' ', $attributeList);
    }

    /**
     * @param string $attributes
     * @param string $content
     *
     * @return string
     */
    public static function a($attributes = '', $content = '')
    {
        $defaults = ['href' => '#'];
        if (is_array($attributes) AND isset($attributes['content'])) {
            $content = $attributes['content'];
            unset($attributes['content']); // content is not an attribute
        }

        return "<a " . self::arrayToAttributes(array_merge($defaults, $attributes)) . ">" . $content . "</a>";
    }

    /**
     * @param null  $src
     * @param array $attributes
     *
     * @return string
     */
    public static function script($src = null, $attributes = [])
    {
        $defaults = [
            'src'  => $src,
            'type' => ((!is_array($attributes)) ? $attributes : 'application/javascript'),
        ];

        return "<script " . self::arrayToAttributes(array_merge($defaults, $attributes)) . "></script>";
    }

    /**
     * @param null  $href
     * @param array $attributes
     *
     * @return string
     */
    public static function link($href = null, $attributes = [])
    {
        $defaults = [
            'href'  => $href,
            'rel'   => ((!is_array($attributes)) ? $attributes : 'stylesheet'),
            'text'  => ((!is_array($attributes)) ? $attributes : 'text/css'),
            'media' => ((!is_array($attributes)) ? $attributes : 'all'),
        ];

        return "<link " . self::arrayToAttributes(array_merge($defaults, $attributes)) . ">";
    }

    /**
     * @param string $attributes
     * @param string $content
     *
     * @return string
     */
    public static function span($attributes = '', $content = '')
    {
        if (is_array($attributes) AND isset($attributes['content'])) {
            $content = $attributes['content'];
            unset($attributes['content']); // content is not an attribute
        }

        return "<span " . self::arrayToAttributes($attributes) . ">" . $content . "</span>";
    }
}
