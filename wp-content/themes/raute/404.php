<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Raute
 */

get_header();
?>

<div class="wrapper">
    <div class="wrapper-inner">

        <div class="theme-panelarea-primary column column-8 column-sm-12">
            <main id="main" class="site-main" role="main">
                <div class="theme-block error-block error-block-heading">
                    <header class="entry-header">
                        <h1 class="entry-title entry-title-xlarge">
                            <?php esc_html_e('Oops! That page can&rsquo;t be found.', 'raute'); ?>
                        </h1>
                    </header>

                </div>
                <div class="theme-block error-block error-block-search">

                    <div class="wrapper-inner">
                        <div class="column column-8 column-sm-12">
                            <?php get_search_form(); ?>
                        </div>
                    </div>

                </div>
                <div class="theme-block error-block error-block-top">

                    <div class="wrapper-inner">
                        <div class="column column-12 column-sm-12">
                            <h2><?php esc_html_e('Maybe it’s out there, somewhere...', 'raute'); ?></h2>
                            <p><?php esc_html_e('You can always find insightful stories on our', 'raute'); ?>
                                <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Homepage', 'raute'); ?></a>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="theme-block error-block error-block-middle">

                    <div class="wrapper-inner">
                        <div class="column column-12 column-sm-12">
                            <h2><?php esc_html_e('Still feeling lost? You’re not alone.', 'raute'); ?></h2>
                            <p><?php esc_html_e('Enjoy these stories about getting lost, losing things, and finding what you never knew you were looking for.', 'raute'); ?></p>
                        </div>
                    </div>

                </div>
                <div class="theme-block error-block error-block-bottom">
                    <?php raute_related_posts(); ?>
                </div>
            </main>
        </div>

    </div>
</div>

<?php
get_footer();
