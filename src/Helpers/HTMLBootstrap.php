<?php
namespace BobbyFramework\Web\Helpers;

/**
 * Class HTMLElements
 *
 * @package Cybble\Utils\HTML
 */
class HTMLBootstrap extends HTMLElements
{
    /**
     * @param $caption
     * @param $options
     * @return mixed
     */
    private static function _dropdown($caption, $options)
    {
        $options['id'] = isset($options['id']) ? $options['id'] : 'label-dropdown-' . (string)(mt_rand(1, pow(10, 10)));
        $options['caption'] = $caption . ' ';
        $options['size'] = isset($options['size']) ? $options['size'] : null;

        $group = (isset($options['groupable']) && $options['groupable'])
        || (isset($options['split']) && $options['split'])
        || (isset($options['align']) && 'right' === $options['align']) ? 'btn-group' : null;

        $direction = isset($options['direction']) && $options['direction'] === 'up' ? 'dropup' : 'dropdown';

        $options['div_class'] = join(' ', array_filter([$group, $direction], 'strlen'));

        $button_class = isset($options['button']['class']) ? $options['button']['class'] : null;

        switch ($options['size']) {
            case 'lg':
            case 'large':
                $size = 'btn-lg';
                break;
            case 'sm':
            case 'small':
                $size = 'btn-sm';
                break;
            case 'xs':
            case 'extra_small':
                $size = 'btn-xs';
                break;
            default :
                $size = null;
        }

        $context = isset($options['context']) ? $options['context'] : 'default';
        $options['button_class'] = join(' ', array_filter([$button_class, 'btn', "btn-$context", $size], 'strlen'));

        $align = isset($options['align']) && $options['align'] === 'right' ? 'dropdown-menu-right' : null;
        $options['list_class'] = join(' ', array_filter(['dropdown-menu', $align], 'strlen'));

        unset($options['context']);
        unset($options['size']);
        return $options;
    }

    /**
     * @param $caption
     * @param array $options
     * @param null $navs
     * @return string
     */
    public static function dropdown($caption, $options = [], $navs = null)
    {
        if (is_callable($options)) {
            $navs = $options;
            $options = [];
        }

        $yield = is_callable($navs) ? call_user_func($navs) : null;

        $options = self::_dropdown($caption, $options);

        // Render
        $html = '<div ' . self::arrayToAttributes(['class' => $options['div_class']]) . '>';
        if (isset($options['split']) && $options['split']) {
            $html .= self::a(['class' => $options['button_class'], 'href' => $options['href']], $options['caption']);
        }


        $html .= '<button ' . self::arrayToAttributes([
                'class' => 'dropdown-toggle ' . $options['button_class'],
                'type' => 'button',
                'id' => $options['id'],
                'data-toggle' => 'dropdown'
            ]) . '>';

        if (isset($options['split']) && $options['split']) {
            $html .= '<span class="caret"></span>';
            $html .= '<span class="sr-only">Toggle Dropdown</span>';
        } else {
            $html .= $options['caption'] . ' <span class="caret"></span>';
        }

        $html .= '</button>';

        $html .= '<ul ' . self::arrayToAttributes([
                'class' => $options['list_class'],
                'role' => 'menu',
                'aria-labelledby' => $options['id']
            ]) . '>';

        foreach ($yield as $value) {
            if ($value === 'separator') {
                $html .= '<li role="separator" class="divider"></li>';
            } else {
                $html .= '<li>' . $value . '</li>';
            }
        }
        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }
}
