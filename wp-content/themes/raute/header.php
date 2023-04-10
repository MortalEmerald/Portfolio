<?php

/**
 * Header file for the Raute WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Raute
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    } ?>

    <?php $raute_default = raute_get_default_theme_options();
    $ed_preloader = get_theme_mod('ed_preloader', $raute_default['ed_preloader']);
    if ($ed_preloader) { ?>
        <div class="preloader hide-no-js <?php if (isset($_COOKIE['MasonryGridNightDayMode']) && $_COOKIE['MasonryGridNightDayMode'] == 'true') {
                                                echo 'preloader-night-mode';
                                            } ?>">
            <div class="loader"></div>
        </div>
    <?php } ?>

    <?php $ed_cursor_option = get_theme_mod('ed_cursor_option', $raute_default['ed_cursor_option']);
    if ($ed_cursor_option) { ?>
        <div class="theme-custom-cursor theme-cursor-primary"></div>
        <div class="theme-custom-cursor theme-cursor-secondary"></div>
    <?php } ?>


    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to the content', 'raute'); ?></a>

        <div id="content" class="site-content">

            
            <div class="theme-custom-header">
                <?php the_custom_header_markup(); ?>
                <?php $header_section_title = get_theme_mod('header_section_title', $raute_default['header_section_title']); 
                $header_section_sub_title = get_theme_mod('header_section_sub_title', $raute_default['header_section_sub_title']); ?>
                <div class="custom-header-content">
                        <h2 class="custom-header-title line-clamp-2">
                            <?php echo esc_html($header_section_title); ?>
                        </h2>

                        <p class = 'line-clamp-2'>
                            <?php echo esc_html($header_section_sub_title); ?>
                        </p>
                </div>
            </div>


            <header id="site-header" class="theme-site-header" role="banner">
                <div class="wrapper">
                    <?php get_template_part('template-parts/header/header', 'content'); ?>
                </div>
            </header>
            <?php if ((is_home() || is_front_page()) && !is_paged()) {
                raute_main_banner_section();
                raute_category_section();
                raute_about_section();
                raute_gallery_section();
                raute_cta_section();
                raute_featured_section();
            } ?>