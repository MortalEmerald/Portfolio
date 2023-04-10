<?php
/**
 * Default Values.
 *
 * @package Raute
 */

if ( ! function_exists( 'raute_get_default_theme_options' ) ) :

    /**
     * Get default theme options
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function raute_get_default_theme_options() {

        $raute_defaults = array();
        // Options.
        $raute_defaults['logo_width_range']                       = 230;
        $raute_defaults['raute_pagination_layout']      = 'numeric';
        $raute_defaults['footer_column_layout']                       = 3;
        $raute_defaults['header_section_title']                      = esc_html__( 'Collecting Moments', 'raute' );
        $raute_defaults['header_section_sub_title']                      = esc_html__( 'Live life with no excuses, travel with no regret ! ! !', 'raute' );
        $raute_defaults['footer_copyright_text']                      = esc_html__( 'All rights reserved.', 'raute' );
        $raute_defaults['ed_header_search']                           = 1;
        $raute_defaults['ed_image_content_inverse']                   = 0;
        $raute_defaults['ed_related_post']                            = 1;
        $raute_defaults['related_post_title']                         = esc_html__('Related Post','raute');
        $raute_defaults['twp_navigation_type']                        = 'norma-navigation';
        $raute_defaults['ed_post_author']                             = 1;
        $raute_defaults['ed_post_date']                               = 1;
        $raute_defaults['ed_post_category']                           = 1;
        $raute_defaults['ed_post_tags']                               = 1;
        $raute_defaults['ed_floating_next_previous_nav']               = 0;
        $raute_defaults['ed_footer_copyright']                        = 1;

        // main banner section
        $raute_defaults['ed_main_banner_section']                      = 1;
        $raute_defaults['main_banner_section_title_wide']              = esc_html__('Adventure Is Out There','raute');
        $raute_defaults['number_of_post_main_banner_wide']             = 5;
        $raute_defaults['main_banner_section_title_narrow']            = esc_html__('Most Views Articles','raute');

        // cta section
        $raute_defaults['ed_cta_section']                       = 1;
        $raute_defaults['cta_section_button_text']            = esc_html__('Visit Us Now','raute');


        $raute_defaults['ed_open_link_new_tab']                       = 0;
        $raute_defaults['ed_desktop_menu']            = 0;
        $raute_defaults['ed_post_excerpt']            = 1;
        $raute_defaults['recent_post_title_search']                 = esc_html__('Recent Post','raute');

        $raute_defaults['ed_about_section']                         = 1;
        $raute_defaults['about_section_sub_title']                 = esc_html__('This is a sub-title','raute');

        $raute_defaults['ed_featured_section']                 = 1;
        $raute_defaults['featured_section_title']              = esc_html__('Featured Trip','raute');

        $raute_defaults['top_category_title_search']                 = esc_html__('Top Category','raute');
        $raute_defaults['ed_header_search_recent_posts']             = 1;
        $raute_defaults['ed_header_search_top_category']             = 1;
        $raute_defaults['ed_day_night_mode_switch']             = 1;

        $raute_defaults['ed_gallery_section']             = 1;
        $raute_defaults['gallery_section_title']                 = esc_html__('Featured Gallery','raute');

        $raute_defaults['ed_category_section']             = 1;
        $raute_defaults['category_section_title']                 = esc_html__('Featured Category','raute');

        $raute_defaults['ed_preloader']             = 1;
        $raute_defaults['ed_cursor_option']             = 1;
        
        $raute_defaults['ed_autoplay']             = 'autoplay-disable';
        $raute_defaults['global_sidebar_layout']             = 'right-sidebar';
        $raute_defaults['post_video_aspect_ration']             = 'default';
        
        // Pass through filter.
        $raute_defaults = apply_filters( 'raute_filter_default_theme_options', $raute_defaults );

        return $raute_defaults;

    }

endif;
