<?php
/**
* Body Classes.
*
* @package Raute
*/
 
 if (!function_exists('raute_body_classes')) :

    function raute_body_classes($classes) {

        $raute_default = raute_get_default_theme_options();
        $ed_desktop_menu = get_theme_mod( 'ed_desktop_menu',$raute_default['ed_desktop_menu'] );
        global $post;
        
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }
        if( $ed_desktop_menu ){

            $classes[] = 'enabled-desktop-menu';

        }else{

            $classes[] = 'disabled-desktop-menu';

        }


        if( is_active_sidebar('sidebar-1')){
            $classes[] = 'sidebar-active';
        }

        return $classes;
    }

endif;

add_filter('body_class', 'raute_body_classes');