<?php

/**
 * Custom Functions.
 *
 * @package Raute
 */

if (!function_exists('raute_fonts_url')) :

    //Google Fonts URL
    function raute_fonts_url()
    {

        $font_families = array(
            'Averia+Serif+Libre:wght@300;400;700',
            'Nunito:wght@200;300;400;500;600;700;800;900'

        );

        $fonts_url = add_query_arg(array(
            'family' => implode('&family=', $font_families),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2');

        return esc_url_raw($fonts_url);
    }

endif;

if (!function_exists('raute_read_more_render')) :

    function raute_read_more_render()
    { ?>
        <div class="entry-meta">
            <div class="entry-meta-link">
                <a href="<?php the_permalink(); ?>">
                    <?php esc_html_e('Read More', 'raute'); ?>
                </a>
            </div>
        </div>

        <?php
    }

endif;

if (!function_exists('raute_social_menu_icon')) :

    function raute_social_menu_icon($item_output, $item, $depth, $args)
    {

        // Add Icon
        if ('raute-social-menu' === $args->theme_location) {

            $svg = Raute_SVG_Icons::get_theme_svg_name($item->url);

            if (empty($svg)) {
                $svg = raute_the_theme_svg('link', $return = true);
            }

            $item_output = str_replace($args->link_after, '</span>' . $svg, $item_output);
        }

        return $item_output;
    }

endif;

add_filter('walker_nav_menu_start_el', 'raute_social_menu_icon', 10, 4);

if (!function_exists('raute_add_sub_toggles_to_main_menu')) :

    function raute_add_sub_toggles_to_main_menu($args, $item, $depth)
    {

        // Add sub menu toggles to the Expanded Menu with toggles.
        if (isset($args->show_toggles) && $args->show_toggles) {

            // Wrap the menu item link contents in a div, used for positioning.
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';

            // Add a toggle to items with children.
            if (in_array('menu-item-has-children', $item->classes, true)) {

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';
                // Add the sub menu toggle.
                $args->after .= '<button class="toggle submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __('Show sub menu', 'raute') . '</span>' . raute_the_theme_svg('chevron-down', $return = true) . '</span></button>';
            }

            // Close the wrapper.
            $args->after .= '</div><!-- .submenu-wrapper -->';

            // Add sub menu icons to the primary menu without toggles.
        } elseif ('raute-primary-menu' === $args->theme_location) {

            if (in_array('menu-item-has-children', $item->classes, true)) {

                $args->after = '<span class="icon">' . raute_the_theme_svg('chevron-down', true) . '</span>';
            } else {

                $args->after = '';
            }
        }

        return $args;
    }

endif;

add_filter('nav_menu_item_args', 'raute_add_sub_toggles_to_main_menu', 10, 3);

if (!function_exists('raute_sanitize_sidebar_option_meta')) :

    // Sidebar Option Sanitize.
    function raute_sanitize_sidebar_option_meta($input)
    {

        $metabox_options = array('global-sidebar', 'left-sidebar', 'right-sidebar', 'no-sidebar');
        if (in_array($input, $metabox_options)) {

            return $input;
        } else {

            return '';
        }
    }

endif;

if (!function_exists('raute_page_lists')) :

    // Page List.
    function raute_page_lists()
    {

        $page_lists = array();
        $page_lists[''] = esc_html__('-- Select Page --', 'raute');
        $pages = get_pages();
        foreach ($pages as $page) {

            $page_lists[$page->ID] = $page->post_title;
        }
        return $page_lists;
    }

endif;

if (!function_exists('raute_sanitize_post_layout_option_meta')) :

    // Sidebar Option Sanitize.
    function raute_sanitize_post_layout_option_meta($input)
    {

        $metabox_options = array('global-layout', 'layout-1', 'layout-2');
        if (in_array($input, $metabox_options)) {

            return $input;
        } else {

            return '';
        }
    }

endif;

if (!function_exists('raute_sanitize_header_overlay_option_meta')) :

    // Sidebar Option Sanitize.
    function raute_sanitize_header_overlay_option_meta($input)
    {

        $metabox_options = array('global-layout', 'enable-overlay');
        if (in_array($input, $metabox_options)) {

            return $input;
        } else {

            return '';
        }
    }

endif;

/**
 * Raute SVG Icon helper functions
 *
 * @package Raute
 * @since 1.0.0
 */
if (!function_exists('raute_the_theme_svg')) :
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Raute_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function raute_the_theme_svg($svg_name, $return = false)
    {

        if ($return) {

            return raute_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in raute_get_theme_svg();.

        } else {

            echo raute_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in raute_get_theme_svg();.

        }
    }

endif;

if (!function_exists('raute_get_theme_svg')) :

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function raute_get_theme_svg($svg_name)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Raute_SVG_Icons::get_svg($svg_name),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );
        if (!$svg) {
            return false;
        }
        return $svg;
    }

endif;


if (!function_exists('raute_post_category_list')) :

    // Post Category List.
    function raute_post_category_list($select_cat = true)
    {

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if ($select_cat) {

            $post_cat_cat_array[''] = esc_html__('-- Select Category --', 'raute');
        }

        foreach ($post_cat_lists as $post_cat_list) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;
        }

        return $post_cat_cat_array;
    }

endif;

if (!function_exists('raute_sanitize_meta_pagination')) :

    /** Sanitize Enable Disable Checkbox **/
    function raute_sanitize_meta_pagination($input)
    {

        $valid_keys = array('global-layout', 'no-navigation', 'norma-navigation', 'ajax-next-post-load');
        if (in_array($input, $valid_keys)) {
            return $input;
        }
        return '';
    }

endif;

if (!function_exists('raute_disable_post_views')) :

    /** Disable Post Views **/
    function raute_disable_post_views()
    {

        add_filter('booster_extension_filter_views_ed', function () {
            return false;
        });
    }

endif;

if (!function_exists('raute_disable_post_read_time')) :

    /** Disable Read Time **/
    function raute_disable_post_read_time()
    {

        add_filter('booster_extension_filter_readtime_ed', function () {
            return false;
        });
    }

endif;

if (!function_exists('raute_disable_post_like_dislike')) :

    /** Disable Like Dislike **/
    function raute_disable_post_like_dislike()
    {

        add_filter('booster_extension_filter_like_ed', function () {
            return false;
        });
    }

endif;

if (!function_exists('raute_disable_post_author_box')) :

    /** Disable Author Box **/
    function raute_disable_post_author_box()
    {

        add_filter('booster_extension_filter_ab_ed', function () {
            return false;
        });
    }

endif;


add_filter('booster_extension_filter_ss_ed', function () {
    return false;
});

if (!function_exists('raute_disable_post_reaction')) :

    /** Disable Reaction **/
    function raute_disable_post_reaction()
    {

        add_filter('booster_extension_filter_reaction_ed', function () {
            return false;
        });
    }

endif;

if (!function_exists('raute_post_floating_nav')) :

    function raute_post_floating_nav()
    {

        $raute_default = raute_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod('ed_floating_next_previous_nav', $raute_default['ed_floating_next_previous_nav']);

        if ('post' === get_post_type() && $ed_floating_next_previous_nav) {

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if (isset($prev_post->ID)) {

                $prev_link = get_permalink($prev_post->ID); ?>

                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if (get_the_post_thumbnail($prev_post->ID, 'medium')) { ?>
                        <?php echo wp_kses_post(get_the_post_thumbnail($prev_post->ID, 'medium')); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url($prev_link); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'raute'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
                    </a>
                </div>

            <?php }

            if (isset($next_post->ID)) {

                $next_link = get_permalink($next_post->ID); ?>

                <div class="floating-post-navigation floating-navigation-next">
                    <?php if (get_the_post_thumbnail($next_post->ID, 'medium')) { ?>
                        <?php echo wp_kses_post(get_the_post_thumbnail($next_post->ID, 'medium')); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url($next_link); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'raute'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
                    </a>
                </div>

            <?php
            }
        }
    }

endif;

add_action('raute_navigation_action', 'raute_post_floating_nav', 10);

if (!function_exists('raute_single_post_navigation')) :

    function raute_single_post_navigation()
    {

        $raute_default = raute_get_default_theme_options();
        $twp_navigation_type = esc_attr(get_post_meta(get_the_ID(), 'twp_disable_ajax_load_next_post', true));
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if ($twp_navigation_type == '' || $twp_navigation_type == 'global-layout') {
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $raute_default['twp_navigation_type']);
        }


        if ($twp_navigation_type != 'no-navigation' && 'post' === get_post_type()) {

            if ($twp_navigation_type == 'norma-navigation') { ?>

                <div class="theme-block navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . raute_the_theme_svg('arrow-left', $return = true) . '</span><span class="screen-reader-text">' . __('Previous post:', 'raute') . '</span><h4 class="entry-title entry-title-small">%title</h4>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . raute_the_theme_svg('arrow-right', $return = true) . '</span><span class="screen-reader-text">' . __('Next post:', 'raute') . '</span><h4 class="entry-title entry-title-small">%title</h4>',
                    )); ?>
                </div>
            <?php

            } else {

                $next_post = get_next_post();
                if (isset($next_post->ID)) {

                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint($next_post_id) . '" class="twp-single-infinity"></div>';
                }
            }
        }
    }

endif;

add_action('raute_navigation_action', 'raute_single_post_navigation', 30);

if (!function_exists('raute_header_toggle_search')) :

    /**
     * Header Search
     **/
    function raute_header_toggle_search()
    {

        $raute_default = raute_get_default_theme_options();
        $ed_header_search = get_theme_mod('ed_header_search', $raute_default['ed_header_search']);
        $ed_header_search_top_category = get_theme_mod('ed_header_search_top_category', $raute_default['ed_header_search_top_category']);
        $ed_header_search_recent_posts = absint(get_theme_mod('ed_header_search_recent_posts', $raute_default['ed_header_search_recent_posts']));

        if ($ed_header_search) { ?>

            <div class="header-searchbar">
                <div class="header-searchbar-inner">
                    <div class="wrapper">

                        <div class="header-searchbar-area">

                            <a href="javascript:void(0)" class="skip-link-search-start"></a>

                            <?php get_search_form(); ?>

                        </div>

                        <?php if ($ed_header_search_recent_posts || $ed_header_search_top_category) { ?>

                            <div class="search-content-area">

                                <?php if ($ed_header_search_recent_posts) { ?>

                                    <div class="search-recent-posts">
                                        <?php raute_recent_posts_search(); ?>
                                    </div>

                                <?php } ?>

                                <?php if ($ed_header_search_top_category) { ?>

                                    <div class="search-popular-categories">
                                        <?php raute_header_search_top_cat_content(); ?>
                                    </div>

                                <?php } ?>

                            </div>

                        <?php } ?>

                        <button type="button" id="search-closer" class="exit-search">
                            <?php raute_the_theme_svg('cross'); ?>
                        </button>

                        <a href="javascript:void(0)" class="skip-link-search-end"></a>

                    </div>
                </div>
            </div>

        <?php
        }
    }

endif;

if (!function_exists('raute_recent_posts_search')) :

    // Single Posts Related Posts.
    function raute_recent_posts_search()
    {

        $raute_default = raute_get_default_theme_options();
        $related_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts")));

        if ($related_posts_query->have_posts()) : ?>

            <div class="related-search-posts">

                <div class="theme-block-heading">
                    <?php
                    $recent_post_title_search = esc_html(get_theme_mod('recent_post_title_search', $raute_default['recent_post_title_search']));

                    if ($recent_post_title_search) { ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html($recent_post_title_search); ?>

                        </h2>
                    <?php } ?>
                </div>

                <div class="theme-list-group recent-list-group">

                    <?php
                    while ($related_posts_query->have_posts()) :
                        $related_posts_query->the_post(); ?>

                        <div class="search-recent-article-list">
                            <header class="entry-header">
                                <h3 class="entry-title entry-title-small">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            </header>
                        </div>

                    <?php
                    endwhile; ?>

                </div>

            </div>

        <?php
            wp_reset_postdata();

        endif;
    }

endif;

if (!function_exists('raute_main_banner_section')) :

    // Single Posts Related Posts.
    function raute_main_banner_section()
    {

        $raute_default = raute_get_default_theme_options();

        $ed_main_banner_section = get_theme_mod('ed_main_banner_section', $raute_default['ed_main_banner_section']);
        $main_banner_section_title_wide = get_theme_mod('main_banner_section_title_wide', $raute_default['main_banner_section_title_wide']);
        $number_of_post_main_banner_wide = absint(get_theme_mod('number_of_post_main_banner_wide', $raute_default['number_of_post_main_banner_wide']));
        $main_banner_section_title_narrow = get_theme_mod('main_banner_section_title_narrow', $raute_default['main_banner_section_title_narrow']);
        
        $select_category_for_main_banner_wide = absint(get_theme_mod('select_category_for_main_banner_wide'));
        $select_category_for_main_banner_narrow = absint(get_theme_mod('select_category_for_main_banner_narrow'));
        $main_banner_wide_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $number_of_post_main_banner_wide, 'cat' => $select_category_for_main_banner_wide,'post__not_in' => get_option("sticky_posts")));
        $main_banner_narrow_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5,'cat' => $select_category_for_main_banner_narrow, 'post__not_in' => get_option("sticky_posts")));
        if ($ed_main_banner_section) {
        ?>

            <div class="theme-main-banner theme-block">
                <div class="wrapper">
                    <div class="wrapper-inner">
                        <div class="column column-8 column-sm-12 mb-sm-16">
                            <div class="main-banner-content banner-content-left">
                                <?php if (!empty($main_banner_section_title_wide)) { ?>
                                    <div class="theme-panel-header">
                                        <div class="panel-header-title header-title-small">
                                            <h2> <?php echo esc_html($main_banner_section_title_wide); ?> </h2>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="theme-panel-body">
                                    <?php
                                    if ($main_banner_wide_posts_query->have_posts()) :
                                    while ($main_banner_wide_posts_query->have_posts()) :
                                        $main_banner_wide_posts_query->the_post(); 
                                        if (has_post_thumbnail()) {
                                            $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium-large');
                                            $url = isset($url[0]) ? $url[0] : '';
                                        }?>
                                        <div class="banner-content-item" data-aos="fade-up" data-aos-duration = '1000'>
                                            <article class="theme-news-article">
                                                <div class="news-article-image image-border-radius">
                                                    <div class="data-bg data-bg-medium" data-background='<?php echo esc_url($url); ?>'></div>
                                                </div>

                                                <div class="news-article-content">
                                                    <h2 class="entry-title entry-title-small line-clamp-2">
                                                        <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                                                    </h2>

                                                    <p class='line-clamp-2'>
                                                        <?php the_excerpt(); ?>
                                                    </p>
                                                </div>
                                            </article>
                                        </div>

                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                    endif; ?>
                                </div>

                            </div>
                        </div>

                        <div class="column column-4 column-sm-12">
                            <div class="main-banner-content banner-content-right">
                                <?php if (!empty($main_banner_section_title_narrow)) { ?>
                                    <div class="theme-panel-header">
                                        <div class="panel-header-title header-title-small">
                                            <h2> <?php echo esc_html($main_banner_section_title_narrow); ?> </h2>
                                        </div>
                                    </div>
                                <?php } ?>
                                    <div class="theme-panel-body">
                                <?php
                                if ($main_banner_narrow_posts_query->have_posts()) :
                                while ($main_banner_narrow_posts_query->have_posts()) :
                                    $main_banner_narrow_posts_query->the_post(); 
                                    if (has_post_thumbnail()) {
                                        $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                        $url = isset($url[0]) ? $url[0] : '';
                                    }?>
                                        <div class="banner-content-item" data-aos="fade-left" data-aos-duration = '1000'>
                                            <article class="theme-news-article news-article-flex article-flex-center">
                                                <div class="news-article-image image-border-radius">
                                                    <div class="data-bg data-bg-thumbnail" data-background='<?php echo esc_url($url); ?>'></div>
                                                </div>

                                                <div class="news-article-content">
                                                    <h2 class="entry-title entry-title-xsmall line-clamp-2">
                                                        <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                                                    </h2>

                                                    <div class="line-clamp-2">
                                                        <?php the_excerpt(); ?>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                                endif; ?>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php } ?>
        <?php }

endif;



if (!function_exists('raute_about_section')) :

    function raute_about_section()
    {
        $raute_default = raute_get_default_theme_options();
        $ed_about_section = get_theme_mod('ed_about_section', $raute_default['ed_about_section']);
        $about_section_sub_title = get_theme_mod('about_section_sub_title', $raute_default['about_section_sub_title']);
        $twp_about_featured_image_1 = get_theme_mod('twp_about_featured_image_1');
        $twp_about_featured_image_2 = get_theme_mod('twp_about_featured_image_2');
        if ($ed_about_section) {
            $raute_about_page = esc_attr(get_theme_mod('select_page_for_about'));
            if (!empty($raute_about_page)) {
                $raute_about_page_args = array(
                    'post_type' => 'page',
                    'page_id' => $raute_about_page,
                );
            }
            if (!empty($raute_about_page_args)) {
                $raute_about_page_query = new WP_Query($raute_about_page_args);
                while ($raute_about_page_query->have_posts()) : $raute_about_page_query->the_post();
                    if (has_post_thumbnail()) {
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = isset($url[0]) ? $url[0] : '';
                    }
        ?>
                    <div class="theme-about-us theme-block image-border-radius">
                        <div class="wrapper">

                            <div class="wrapper-inner wrapper-inner-center">

                                <div class="column column-6 column-sm-12 order-sm-2" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="about-us-image">
                                        <?php if (!empty($twp_about_featured_image_1)) { ?>
                                            <div class="image-item">
                                                <div class="data-bg data-bg-large" data-background='<?php echo esc_url($twp_about_featured_image_1);  ?>'></div>
                                            </div>
                                        <?php } ?>

                                        <?php the_excerpt(); ?>
                                        <a href="<?php the_permalink(); ?>" class="theme-btn-link"> <?php echo esc_html__('Read More', 'raute'); ?></a>
                                    </div>
                                </div>

                                <div class="column column-6 column-sm-12 order-sm-1 mb-sm-32" data-aos="fade-down" data-aos-duration="1000">
                                    <div class="about-us-content">
                                        <h2 class="entry-title entry-title-large"><?php the_title(); ?> </h2>
                                        <?php if (!empty($about_section_sub_title)){ ?>
                                            <h2 class="entry-title entry-title-small about-sub-title">
                                                <?php echo esc_html($about_section_sub_title); ?>
                                            </h2>
                                        <?php } ?>

                                        <?php if (!empty($twp_about_featured_image_2)) { ?>
                                            <div class="image-item">
                                                <div class="data-bg data-bg-large" data-background='<?php echo esc_url($twp_about_featured_image_2);  ?>'></div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


            <?php endwhile;
                wp_reset_postdata();
            }
        }
    }

endif;

if (!function_exists('raute_cta_section')) :

    function raute_cta_section()
    {
        $raute_default = raute_get_default_theme_options();
        $ed_cta_section = get_theme_mod('ed_cta_section', $raute_default['ed_cta_section']);
        $cta_section_button_text = get_theme_mod('cta_section_button_text', $raute_default['cta_section_button_text']);
        $cta_section_sub_text = get_theme_mod('cta_section_sub_text');
        $cta_section_button_url = get_theme_mod('cta_section_button_url');
        if ($ed_cta_section) {
            $select_page_for_cta = esc_attr(get_theme_mod('select_page_for_cta'));
            if (!empty($select_page_for_cta)) {
                $select_page_for_cta_args = array(
                    'post_type' => 'page',
                    'page_id' => $select_page_for_cta,
                );
            }
            if (!empty($select_page_for_cta_args)) {
                $select_page_for_cta_query = new WP_Query($select_page_for_cta_args);
                while ($select_page_for_cta_query->have_posts()) : $select_page_for_cta_query->the_post();
                    if (has_post_thumbnail()) {
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = isset($url[0]) ? $url[0] : '';
                    } ?>

                <div class="theme-cta image-border-radius overlay-content-left content-left-big overlay-content-custom theme-block" data-aos = 'fade-up' data-aos-duration = '1000'>
                    <div class="wrapper">
                        <div class="wrapper-inner">
                            <div class="column column-12">
                                <div class="theme-cta-image data-bg data-bg-large" data-background='<?php echo esc_url($url); ?>'></div>

                                <div class="theme-cta-content theme-block-content">
                                    <h2 class="entry-title entry-title-big line-clamp-3">
                                        <?php the_title(); ?>
                                    </h2>

                                    <h3 class="entry-title entry-title-small line-clamp-3">
                                        <?php echo esc_html($cta_section_sub_text); ?>
                                    </h3>

                                    <div class="theme-cta-excerpt line-clamp-4">
                                        <?php  the_excerpt();?>
                                    </div>

                                    <?php if (!empty($cta_section_button_text)) { ?>
                                     <a href="<?php echo esc_url($cta_section_button_url); ?>" class='theme-btn-link' ><?php echo esc_html($cta_section_button_text); ?> </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile;
                wp_reset_postdata();
            }
        }
    }

endif;


if (!function_exists('raute_gallery_section')) :

    function raute_gallery_section()
    {
        $raute_default = raute_get_default_theme_options();
        $ed_gallery_section = get_theme_mod('ed_gallery_section', $raute_default['ed_gallery_section']);
        $gallery_section_title = get_theme_mod('gallery_section_title', $raute_default['gallery_section_title']);
        if ($ed_gallery_section) { ?>
            <div class="theme-gallery-grid theme-block">
                <div class="wrapper">
                    <div class="wrapper-inner">
                        <div class="column column-12">
                            <div class="theme-panel-header">
                                <div class="panel-header-title">
                                    <h2><?php echo esc_html($gallery_section_title); ?></h2>
                                </div>
                            </div>

                            <div class="theme-panel-body">
                                <div class="gallery-grid-masonry image-border-radius">
                                    <?php for ($i = 1; $i < 8; $i++) {  ?>
                                        <?php if (!empty(get_theme_mod('twp_gallery_image_' . $i))) { ?>
                                            <div class="grid-masonry-item" data-aos = 'fade-up' data-aos-duration = '1000'>
                                                <img src="<?php echo esc_url(get_theme_mod('twp_gallery_image_' . $i)); ?>" alt="">
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>

                                <div class="grid-masonry-popup">
                                    <img src="" alt="">
                                    <?php raute_the_theme_svg('close'); ?>

                                    <button class="masonry-prev">
                                        <?php raute_the_theme_svg('border-arrow-left'); ?>
                                    </button>
                                    <button class="masonry-next">
                                        <?php raute_the_theme_svg('border-arrow-right'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
    }

endif;


if (!function_exists('raute_category_section')) :

    function raute_category_section()
    {
        $raute_default = raute_get_default_theme_options();
        $ed_category_section = get_theme_mod('ed_category_section', $raute_default['ed_category_section']);
        $category_section_title = get_theme_mod('category_section_title', $raute_default['category_section_title']);
        if ($ed_category_section) { ?>
            <div class="theme-card-block theme-block">
                <div class="wrapper">
                    <div class="wrapper-inner">
                        <div class="column column-12">
                            <div class="theme-panel-header">
                                <div class="panel-header-title">
                                    <h2> <?php echo esc_html($category_section_title); ?> </h2>
                                </div>
                            </div>

                            <div class="theme-panel-body overlay-content-left overlay-content-arrow">
                                <div class="wrapper-inner">
                                    <?php for ($i = 1; $i < 4; $i++) { ?>
                                        <?php $twp_cat_id = get_theme_mod('select_category_for_category' . $i);
                                        if (!empty($twp_cat_id)) {
                                            $twp_term_image = get_term_meta($twp_cat_id, 'twp-term-featured-image', true);
                                            $twp_term_name = get_the_category_by_ID($twp_cat_id);
                                            $twp_term_description = category_description($twp_cat_id);
                                            $twp_category_link = get_category_link($twp_cat_id);
                                        } else {
                                            $twp_term_image = '';
                                            $twp_term_name = __('No Categtory Selected', 'raute');
                                            $twp_term_description = '';
                                            $twp_category_link = '';
                                        }
                                        ?>
                                        <div class="column column-4 column-sm-6 column-xs-12 mb-sm-32" data-aos="fade-right" data-aos-duration="1000">

                                            <div class="data-bg data-bg-big" data-background='<?php echo esc_url($twp_term_image); ?>'></div>

                                            <div class="theme-block-content">
                                                <h2 class="entry-title entry-title-big">
                                                    <a href="<?php echo esc_url($twp_category_link); ?>">
                                                        <?php echo esc_html($twp_term_name); ?>
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }

endif;

if (!function_exists('raute_header_search_top_cat_content')) :

    function raute_header_search_top_cat_content()
    {

        $top_category = 3;

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $slug_counts = array();

        foreach ($post_cat_lists as $post_cat_list) {

            if ($post_cat_list->count >= 1) {

                $slug_counts[] = array(
                    'count'         => $post_cat_list->count,
                    'slug'          => $post_cat_list->slug,
                    'name'          => $post_cat_list->name,
                    'cat_ID'        => $post_cat_list->cat_ID,
                    'description'   => $post_cat_list->category_description,
                );
            }
        }

        if ($slug_counts) { ?>

            <div class="popular-search-categories">

                <div class="theme-block-heading">
                    <?php
                    $raute_default = raute_get_default_theme_options();
                    $top_category_title_search = esc_html(get_theme_mod('top_category_title_search', $raute_default['top_category_title_search']));

                    if ($top_category_title_search) { ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html($top_category_title_search); ?>

                        </h2>
                    <?php } ?>
                </div>

                <?php
                arsort($slug_counts); ?>

                <div class="theme-list-group categories-list-group">
                    <div class="wrapper-inner">

                        <?php
                        $i = 1;
                        foreach ($slug_counts as $key => $slug_count) {

                            if ($i > $top_category) {
                                break;
                            }

                            $cat_link           = get_category_link($slug_count['cat_ID']);
                            $cat_name           = $slug_count['name'];
                            $cat_slug           = $slug_count['slug'];
                            $cat_count          = $slug_count['count'];
                            $twp_term_image = get_term_meta($slug_count['cat_ID'], 'twp-term-featured-image', true); ?>

                            <div class="column column-4 column-sm-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-grid-article'); ?>>
                                    <div class="entry-wrapper">
                                        <?php if ($twp_term_image) { ?>
                                            <div class="entry-thumbnail">
                                                <a href="<?php echo esc_url($cat_link); ?>" class="data-bg data-bg-medium" data-background="<?php echo esc_url($twp_term_image); ?>"></a>
                                            </div>
                                        <?php } ?>

                                        <div class="post-content">
                                            <header class="entry-header">
                                                <h3 class="entry-title">
                                                    <a href="<?php echo esc_url($cat_link); ?>">
                                                        <?php echo esc_html($cat_name); ?>
                                                    </a>
                                                </h3>
                                            </header>
                                        </div>
                                    </div>
                                </article>
                            </div>

                        <?php
                            $i++;
                        } ?>

                    </div>
                </div>

            </div>
        <?php
        }
    }

endif;

add_action('raute_before_footer_content_action', 'raute_header_toggle_search', 10);

if (!function_exists('raute_content_offcanvas')) :

    // Offcanvas Contents
    function raute_content_offcanvas()
    { ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">

                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">

                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>

                        <button type="button" class="button-offcanvas-close">
                            <?php raute_the_theme_svg('close'); ?>
                        </button>

                    </div>
                </div>

                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'raute'); ?>" role="navigation">
                        <ul class="primary-menu">

                            <?php
                            if (has_nav_menu('raute-primary-menu')) {

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'raute-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );
                            } else {

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => false,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Raute_Walker_Page(),
                                    )
                                );
                            } ?>

                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>

                <?php if (has_nav_menu('raute-social-menu')) { ?>

                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">

                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'raute-social-menu',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                            'container' => 'div',
                            'container_class' => 'social-menu',
                            'depth' => 1,
                        )); ?>

                    </div>

                <?php } ?>

                <a href="javascript:void(0)" class="skip-link-menu-end"></a>

            </div>
        </div>

        <?php
    }

endif;

add_action('raute_before_footer_content_action', 'raute_content_offcanvas', 30);

if (!function_exists('raute_footer_content_widget')) :

    function raute_footer_content_widget()
    {

        $raute_default = raute_get_default_theme_options();
        if (
            is_active_sidebar('raute-footer-widget-0') ||
            is_active_sidebar('raute-footer-widget-1') ||
            is_active_sidebar('raute-footer-widget-2')
        ) :

            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 3 && is_active_sidebar('raute-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('raute-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('raute-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 3);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } else {
                $footer_sidebar_class = 4;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $raute_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="wrapper-inner">

                        <?php if (is_active_sidebar('raute-footer-widget-0')) : ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12" data-aos = 'fade-down' data-aos-duration = '1000'>
                                <?php dynamic_sidebar('raute-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('raute-footer-widget-1')) : ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12" data-aos = 'fade-up' data-aos-duration = '1000'>
                                <?php dynamic_sidebar('raute-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('raute-footer-widget-2')) : ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12" data-aos = 'fade-down' data-aos-duration = '1000'>
                                <?php dynamic_sidebar('raute-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php
        endif;
    }

endif;

add_action('raute_footer_content_action', 'raute_footer_content_widget', 10);


if (!function_exists('raute_footer_content_info')) :

    /**
     * Footer Copyright Area
     **/
    function raute_footer_content_info()
    {

        $raute_default = raute_get_default_theme_options(); ?>
        <div class="footer-credits">
            <div class="wrapper">
                <div class="wrapper-inner">

                    <div class="column column-10">

                        <div class="footer-copyright">

                            <?php
                            $ed_footer_copyright = wp_kses_post(get_theme_mod('ed_footer_copyright', $raute_default['ed_footer_copyright']));
                            $footer_copyright_text = wp_kses_post(get_theme_mod('footer_copyright_text', $raute_default['footer_copyright_text']));

                            echo esc_html__('Copyright ', 'raute') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html(get_bloginfo('name', 'display')) . '. </span></a> ' . esc_html($footer_copyright_text);

                            if ($ed_footer_copyright) {

                                echo '<br>';
                                echo esc_html__('Theme: ', 'raute') . 'Raute ' . esc_html__('By ', 'raute') . '<a href="' . esc_url('https://www.themeinwp.com/theme/raute') . '"  title="' . esc_attr__('Themeinwp', 'raute') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'raute') . '</span></a>';

                                echo esc_html__('Powered by ', 'raute') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'raute') . '" target="_blank"><span>' . esc_html__('WordPress.', 'raute') . '</span></a>';
                            } ?>

                        </div>

                    </div>

                    <div class="column column-2">
                        <?php raute_footer_go_to_top(); ?>
                    </div>

                </div>
            </div>
        </div>
    <?php
    }

endif;

add_action('raute_footer_content_action', 'raute_footer_content_info', 20);


if (!function_exists('raute_footer_go_to_top')) :

    // Scroll to Top render content
    function raute_footer_go_to_top()
    { ?>

        <a class="to-the-top theme-action-control" href="#site-header">
            <span class="action-control-trigger" tabindex="-1">
                <span class="to-the-top-long">
                    <?php printf(esc_html__('To the Top %s', 'raute'), '<span class="arrow" aria-hidden="true">&uarr;</span>'); ?>
                </span>
                <span class="to-the-top-short">
                    <?php printf(esc_html__('Up %s', 'raute'), '<span class="arrow" aria-hidden="true">&uarr;</span>'); ?>
                </span>
            </span>
        </a>

        <?php
    }

endif;

if (!function_exists('raute_iframe_escape')) :

    /** Escape Iframe **/
    function raute_iframe_escape($input)
    {

        $all_tags = array(
            'iframe' => array(
                'width' => array(),
                'height' => array(),
                'src' => array(),
                'frameborder' => array(),
                'allow' => array(),
                'allowfullscreen' => array(),
            ),
            'video' => array(
                'width' => array(),
                'height' => array(),
                'src' => array(),
                'style' => array(),
                'controls' => array(),
            )
        );

        return wp_kses($input, $all_tags);
    }

endif;

if (class_exists('Booster_Extension_Class')) {

    add_filter('booster_extemsion_content_after_filter', 'raute_after_content_pagination');
}

if (!function_exists('raute_after_content_pagination')) :

    function raute_after_content_pagination($after_content)
    {

        $pagination_single = wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'raute'),
            'after'  => '</div>',
            'echo' => false
        ));

        $after_content =  $pagination_single . $after_content;

        return $after_content;
    }

endif;

if (!function_exists('raute_excerpt_content')) :

    function raute_excerpt_content()
    {

        $raute_default = raute_get_default_theme_options();
        $ed_post_excerpt = get_theme_mod('ed_post_excerpt', $raute_default['ed_post_excerpt']);

        if ($ed_post_excerpt) { ?>

            <div class="entry-content entry-content-muted">

                <?php
                if (has_excerpt()) {

                    the_excerpt();
                } else {

                    echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                } ?>

            </div>

        <?php }
    }

endif;

if (!function_exists('raute_video_content_render')) :

    function raute_video_content_render($class1 = '', $class2 = '', $class3 = '', $ratio_value = 'default', $video_autoplay = 'autoplay-disable')
    {

        $image_size = 'medium_large'; ?>


        <article id="post-<?php the_ID(); ?>" <?php post_class('twp-archive-items'); ?>>
            <div class="entry-wrapper">
                <?php
                if ($video_autoplay == 'autoplay-enable') {
                    $autoplay_class = 'pause';
                    $play_pause_text = esc_html__('Pause', 'raute');
                } else {
                    $autoplay_class = 'play';
                    $play_pause_text = esc_html__('Play', 'raute');
                }

                add_filter('booster_extension_filter_like_ed', function () {
                    return false;
                });

                $content = apply_filters('the_content', get_the_content());
                $video = false;

                // Only get video from the content if a playlist isn't present.
                if (false === strpos($content, 'wp-playlist-script')) {

                    $video = get_media_embedded_in_content($content, array('video', 'object', 'embed', 'iframe'));
                }

                if (!empty($video)) { ?>

                    <div class="entry-content-media">
                        <div class="twp-content-video">

                            <?php
                            foreach ($video as $video_html) { ?>

                                <div class="entry-video theme-ratio-<?php echo esc_attr($ratio_value); ?>">
                                    <div class="twp-video-control-buttons hide-no-js">

                                        <button attr-id="<?php echo esc_attr($class2); ?>-<?php echo absint(get_the_ID()); ?>" class="theme-video-control theme-action-control twp-pause-play <?php echo esc_attr($autoplay_class); ?>">
                                            <span class="action-control-trigger">
                                                <span class="twp-video-control-action">
                                                    <?php raute_the_theme_svg($autoplay_class); ?>
                                                </span>

                                                <span class="screen-reader-text">
                                                    <?php echo $play_pause_text; ?>
                                                </span>
                                            </span>
                                        </button>

                                        <button attr-id="<?php echo esc_attr($class2); ?>-<?php echo absint(get_the_ID()); ?>" class="theme-video-control theme-action-control twp-mute-unmute unmute">
                                            <span class="action-control-trigger">
                                                <span class="twp-video-control-action">
                                                    <?php raute_the_theme_svg('mute'); ?>
                                                </span>

                                                <span class="screen-reader-text">
                                                    <?php esc_html_e('Unmute', 'raute'); ?>
                                                </span>
                                            </span>
                                        </button>

                                    </div>

                                    <div class="theme-video-panel <?php echo esc_attr($class3); ?>" data-autoplay="<?php echo esc_attr($video_autoplay); ?>" data-id="<?php echo esc_attr($class2); ?>-<?php echo absint(get_the_ID()); ?>">
                                        <?php echo raute_iframe_escape($video_html); ?>
                                    </div>

                                </div>

                            <?php
                                break;
                            } ?>

                            <?php
                            $format = get_post_format(get_the_ID()) ?: 'standard';
                            $icon = raute_post_format_icon($format);
                            if (!empty($icon)) { ?>
                                <div class="post-format-icon"><?php echo raute_svg_escape($icon); ?></div>
                            <?php } ?>

                        </div>
                    </div>

                    <?php
                } else {


                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
                    if ($featured_image) { ?>

                        <div class="entry-thumbnail">

                            <a href="<?php the_permalink(); ?>">
                                <img class="entry-responsive-thumbnail" src="<?php echo esc_url($featured_image); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
                            </a>

                            <?php
                            $format = get_post_format(get_the_ID()) ?: 'standard';
                            $icon = raute_post_format_icon($format);
                            if (!empty($icon)) { ?>
                                <div class="post-format-icon"><?php echo raute_svg_escape($icon); ?></div>
                            <?php } ?>

                        </div>

                <?php
                    }
                } ?>

                <div class="post-content">

                    <div class="entry-meta theme-meta-categories">

                        <?php raute_entry_footer($cats = true, $tags = false, $edits = false); ?>

                    </div>

                    <header class="entry-header">

                        <h2 class="entry-title entry-title-small">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                    </header>

                    <div class="entry-meta">
                        <?php
                        raute_posted_by();
                        ?>
                    </div>

                    <div class="entry-content entry-content-muted entry-content-small">

                        <?php
                        if (has_excerpt()) {

                            the_excerpt();
                        } else {

                            echo '<p>';
                            echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                            echo '</p>';
                        } ?>

                    </div>

                    <?php raute_read_more_render(); ?>

                </div>
            </div>
        </article>

    <?php
    }

endif;

if (!function_exists('raute_get_sidebar')) :

    function raute_get_sidebar()
    {

        $raute_default = raute_get_default_theme_options();
        $raute_post_sidebar_option = esc_attr(get_post_meta(get_the_ID(), 'raute_post_sidebar_option', true));
        if ($raute_post_sidebar_option == '' || $raute_post_sidebar_option == 'global-sidebar') {

            $global_sidebar_layout = get_theme_mod('global_sidebar_layout', $raute_default['global_sidebar_layout']);
            $sidebar = $global_sidebar_layout;
        } else {
            $sidebar = $raute_post_sidebar_option;
        }

        if (!is_active_sidebar('sidebar-1')) {
            $sidebar = 'no-sidebar';
        }
        return $sidebar;
    }

endif;

if (!function_exists('raute_post_format_icon')) :

    // Post Format Icon.
    function raute_post_format_icon($format)
    {

        if ($format == 'video') {
            $icon = raute_get_theme_svg('video');
        } elseif ($format == 'audio') {
            $icon = raute_get_theme_svg('audio');
        } elseif ($format == 'gallery') {
            $icon = raute_get_theme_svg('gallery');
        } elseif ($format == 'quote') {
            $icon = raute_get_theme_svg('quote');
        } elseif ($format == 'image') {
            $icon = raute_get_theme_svg('image');
        } else {
            $icon = '';
        }

        return $icon;
    }

endif;

if (!function_exists('raute_svg_escape')) :

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function raute_svg_escape($input)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if (!$svg) {
            return false;
        }

        return $svg;
    }

endif;

if (!function_exists('raute_render_filter')) :

    function raute_render_filter()
    {

        $raute_post_category_list = raute_post_category_list(false); ?>

        <div class="theme-panelarea-header">
            <div class="article-filter-bar">

                <?php if (class_exists('Booster_Extension_Class')) { ?>

                    <div class="article-filter-area filter-area-left">

                        <div class="article-filter-label">
                            <span><?php raute_the_theme_svg('sort'); ?></span>
                            <span><?php esc_html_e('Sort By:', 'raute'); ?></span>
                        </div>

                        <div data-filter-group="popularity" class="article-filter-type article-views-filter">
                            <button class="theme-button theme-button-filters theme-action-control twp-most-liked">
                                <span class="action-control-trigger" tabindex="-1">
                                    <?php esc_html_e('Most Liked', 'raute'); ?>
                                </span>
                            </button>
                            <button class="theme-button theme-button-filters theme-action-control twp-most-viewed">
                                <span class="action-control-trigger" tabindex="-1">
                                    <?php esc_html_e('Most Viewed', 'raute'); ?>
                                </span>
                            </button>
                        </div>

                    </div>

                <?php } ?>

                <div class="article-filter-area filter-area-right">
                    <div class="article-filter-item">
                        <div class="article-filter-label">
                            <span><?php raute_the_theme_svg('filter'); ?></span>
                            <span><?php esc_html_e('Filter By:', 'raute'); ?></span>
                        </div>

                        <div data-filter-group="category" class="article-filter-type article-categories-filter">

                            <div class="theme-categories-multiselect">
                                <button class="theme-categories-selection theme-button theme-button-filters theme-action-control" data-filter=".">
                                    <span class="action-control-trigger" tabindex="-1">
                                        <?php esc_html_e('Select Category', 'raute'); ?>
                                        <span class="theme-filter-icon dropdown-select-arrow"><?php raute_the_theme_svg('chevron-down'); ?></span>
                                    </span>
                                </button>
                                <span class="theme-categories-selected"></span>
                            </div>

                            <div class="theme-categories-dropdown">
                                <?php if ($raute_post_category_list) {

                                    foreach ($raute_post_category_list as $key => $category) {
                                        if ($category) { ?>

                                            <div class="cat-filter-item">
                                                <button class="twp-filter-<?php echo esc_attr($key); ?> theme-button theme-button-filters theme-action-control" data-filter=".<?php echo esc_attr($key); ?>">
                                                    <span class="action-control-trigger" tabindex="-1">
                                                        <?php echo esc_html($category); ?>
                                                    </span>
                                                </button>
                                            </div>

                                <?php }
                                    }
                                } ?>
                            </div>

                        </div>
                    </div>

                    <div class="article-filter-item">
                        <div class="article-filter-label">
                            <span><?php raute_the_theme_svg('settings'); ?></span>
                            <span><?php esc_html_e('Post Format:', 'raute'); ?></span>
                        </div>

                        <div data-filter-group="" class="article-filter-type article-format-filter">
                            <button class="theme-button theme-button-filters theme-action-control" data-filter=".standard">
                                <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                    <?php raute_the_theme_svg('standard'); ?>
                                </span>
                            </button>

                            <button class="theme-button theme-button-filters theme-action-control" data-filter=".gallery">
                                <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                    <?php raute_the_theme_svg('gallery'); ?>
                                </span>
                            </button>

                            <button class="theme-button theme-button-filters theme-action-control" data-filter=".video">
                                <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                    <?php raute_the_theme_svg('video'); ?>
                                </span>
                            </button>

                            <button class="theme-button theme-button-filters theme-action-control" data-filter=".quote">
                                <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                    <?php raute_the_theme_svg('quote'); ?>
                                </span>
                            </button>

                            <button class="theme-button theme-button-filters theme-action-control" data-filter=".audio">
                                <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                    <?php raute_the_theme_svg('audio'); ?>
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="article-filter-item article-filter-clear">
                        <button class="theme-button theme-button-filters theme-action-control">
                            <span class="action-control-trigger" tabindex="-1">
                                <span class="theme-filter-icon filter-clear-icon"><?php raute_the_theme_svg('cross'); ?></span>
                                <?php esc_html_e('Reset', 'raute'); ?>
                            </span>
                        </button>

                    </div>

                </div>
            </div>
        </div>
<?php
    }

endif;


