<?php

/**
 * Header Layout 1
 *
 * @package Raute
 */
$raute_default = raute_get_default_theme_options();
$ed_desktop_menu = get_theme_mod('ed_desktop_menu', $raute_default['ed_desktop_menu']);
?>


<div class="wrapper-inner">
    <div class="column column-12">
        <div class="header-content-container">
            <div class="header-component header-component-left">
                <div class="header-titles">

                    <?php
                    // Site title or logo.
                    raute_site_logo();
                    // Site description.
                    raute_site_description();
                    ?>

                </div><!-- .header-titles -->
            </div><!-- .header-component-left -->

            <div class="header-component header-component-center">
                <div class="site-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'raute'); ?>" role="navigation">
                        <ul class="primary-menu">
                            <?php
                            if (has_nav_menu('raute-primary-menu')) {

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'raute-primary-menu',
                                    )
                                );
                            } else {

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'walker' => new Raute_Walker_Page(),
                                    )
                                );
                            } ?>
                        </ul>
                    </nav>
                </div>

            </div>

            <div class="header-component header-component-right">
                <?php if ($ed_desktop_menu) { ?>

                    <div class="navbar-components">
                        <div class="site-navigation">
                            <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'raute'); ?>" role="navigation">

                                <ul class="primary-menu">

                                    <?php
                                    if (has_nav_menu('raute-primary-menu')) {

                                        wp_nav_menu(
                                            array(
                                                'container' => '',
                                                'items_wrap' => '%3$s',
                                                'theme_location' => 'raute-primary-menu',
                                            )
                                        );
                                    } else {

                                        wp_list_pages(
                                            array(
                                                'match_menu_classes' => true,
                                                'show_sub_menu_icons' => true,
                                                'title_li' => false,
                                                'walker' => new Raute_Walker_Page(),
                                            )
                                        );
                                    } ?>

                                </ul>

                            </nav><!-- .primary-menu-wrapper -->
                        </div><!-- .site-navigation -->
                    </div>

                <?php } ?>
                <div class="navbar-controls hide-no-js">

                    <?php
                    $ed_day_night_mode_switch = get_theme_mod('ed_day_night_mode_switch', $raute_default['ed_day_night_mode_switch']);
                    if ($ed_day_night_mode_switch) { ?>

                        <button type="button" class="navbar-control theme-action-control navbar-day-night navbar-day-on">

                            <span class="header-tool-tip">
                                dark / light mode
                            </span>

                            <span class="action-control-trigger day-night-toggle-icon" tabindex="-1">
                                <span class="moon-toggle-icon">
                                    <i class="moon-icon">
                                        <?php raute_the_theme_svg('moon'); ?>
                                    </i>
                                </span>

                                <span class="sun-toggle-icon">
                                    <i class="sun-icon">
                                        <?php raute_the_theme_svg('sun'); ?>
                                    </i>
                                </span>
                            </span>
                        </button>

                    <?php }

                    $ed_header_search = get_theme_mod('ed_header_search', $raute_default['ed_header_search']);
                    if ($ed_header_search) { ?>

                        <button type="button" class="navbar-control theme-action-control navbar-control-search">

                            <span class="header-tool-tip">
                                search
                            </span>

                            <span class="action-control-trigger" tabindex="-1">
                                <?php raute_the_theme_svg('search'); ?>
                            </span>
                        </button>

                    <?php } ?>


                    <?php if (has_nav_menu('raute-social-menu')) { ?>

                        <div id="social-nav-offcanvas" class="navbar-control offcanvas-social-navigation">

                            <span class="header-tool-tip">
                                social share
                            </span>

                            <a href='' class="social-share-icon">
                                <?php raute_the_theme_svg('social-share'); ?>
                            </a>

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

                    <button type="button" class="navbar-control theme-action-control navbar-control-offcanvas">
                        <span class="action-control-trigger" tabindex="-1">
                            <?php raute_the_theme_svg('menu'); ?>
                        </span>
                    </button>

                </div>

            </div><!-- .header-component-right -->
        </div>
    </div>


</div>
<!-- header media -->