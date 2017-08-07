<?php

namespace BobbyFramework\Web\Helpers;

/**
 * Class HTMLForms
 *
 * @package BobbyFramework\Web\Helpers
 */
class HTMLForms
{
    /**
     * @param string $attributes
     * @param string $content
     *
     * @return string
     */
    public static function button($attributes = '', $content = '')
    {

        $defaults = ['name' => ((!is_array($attributes)) ? $attributes : ''), 'href' => '#'];

        if (is_array($attributes) AND isset($attributes['content'])) {
            $content = $attributes['content'];
            unset($attributes['content']); // content is not an attribute
        }

        return "<button " . HTMLElements::arrayToAttributes(array_merge($defaults,
                $attributes)) . ">" . $content . "</button>";
    }

    /**
     * @param string $attributes
     *
     * @return string
     */
    public static function input($attributes = '')
    {
        $defaults = ['type' => ((!is_array($attributes)) ? $attributes : 'text'), 'name' => ''];

        return "<input " . HTMLElements::arrayToAttributes(array_merge($defaults, $attributes)) . "/>";
    }

    /**
     * @param string $attributes
     * @param        $options
     * @param array  $selected
     *
     * @return string
     */
    public static function select($attributes = '', $options, $selected = [])
    {

        $html = '<select ' . HTMLElements::arrayToAttributes($attributes) . '  >';

        foreach ($options as $key => $value) {

            if (is_array($value) AND isset($value['content'])) {
                $content = $value['content'];
                unset($value['content']); // content is not an attribute
            }

            if (in_array($value['value'], $selected)) {
                $value['selected'] = 'selected';
            }

            $html .= '<option ' . HTMLElements::arrayToAttributes($value) . ' >';
            $html .= (string)$content;
            $html .= '</option>';

        }

        return $html . '</select>';
    }
}
