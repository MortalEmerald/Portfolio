<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @package Raute
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses raute_header_style()
 */
function raute_custom_header_setup()
{
add_theme_support( 'custom-header', array(
    'default-text-color'     => '000000',
    'width'            => 1920,
    'height'           => 666,
    'flex-height' => true,
    'flex-width' => true,
    'video'            => true,
    'default-image' 		=> esc_url( get_stylesheet_directory_uri() . '/assets/images/main-banner.jpg'),
    'wp-head-callback'       => 'raute_header_style',
) );
}

add_action('after_setup_theme', 'raute_custom_header_setup');


if (!function_exists('raute_header_style')) :
    /**
     * Styles the header image and text displayed on the blog
     *
     * @see raute_custom_header_setup().
     */
    function raute_header_style()
    {
        $header_text_color = get_header_textcolor();

        // If no custom options for text are set, let's bail
        // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
        if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
            return;
        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
            <?php
                // Has the text been hidden?
                if ( 'blank' == $header_text_color ) :
            ?>
            .header-titles .site-title,
            .header-titles .custom-logo-name,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
                display: none;
                opacity: 0;
                visibility: hidden;
            }

            <?php
                // If the user has set a custom color for the text use that.
                else :
            ?>
            .header-titles .site-title,
            .header-titles .custom-logo-name,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }

            @media (min-width: 992px) {
                .site-navigation .primary-menu a,
                .site-navigation .primary-menu .icon {
                    color: #<?php echo esc_attr( $header_text_color ); ?>;
                }
            }

            .navbar-controls .svg-icon {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
                fill: #<?php echo esc_attr( $header_text_color ); ?>;
            }

            <?php endif; ?>
        </style>
        <?php
    }
endif; // raute_header_style