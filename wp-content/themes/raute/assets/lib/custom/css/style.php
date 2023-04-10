<?php

/**
 * Raute Dynamic Styles
 *
 * @package Raute
 */

function raute_dynamic_css()
{

    $raute_default = raute_get_default_theme_options();
    $background_color = get_theme_mod('background_color');

    $background_color = '#' . str_replace("#", "", $background_color);

    $logo_width_range = get_theme_mod('logo_width_range', $raute_default['logo_width_range']);

    echo "<style type='text/css' media='all'>"; ?>


    .site-logo .custom-logo{
    max-width: <?php echo esc_attr($logo_width_range); ?>px;
    }
    
    html:not(.night-mode) .header-searchbar-active .header-searchbar-inner,
    html:not(.night-mode) #offcanvas-menu,
    html:not(.night-mode) .preloader {
    background-color:<?php echo esc_attr($background_color); ?>;
    }

<?php echo "</style>";
}

add_action('wp_head', 'raute_dynamic_css', 100);

/**
 * Sanitizing Hex color function.
 */
function raute_sanitize_hex_color($color)
{

    if ('' === $color)
        return '';
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
        return $color;
}
