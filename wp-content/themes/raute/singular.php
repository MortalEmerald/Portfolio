<?php

/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Raute
 * @since 1.0.0
 */
get_header();
global $post;
$raute_ed_post_rating = esc_html(get_post_meta($post->ID, 'raute_ed_post_rating', true));
$sidebar = raute_get_sidebar();
if ($sidebar == 'left-sidebar' || $sidebar == 'right-sidebar') {
    $class_1 = 'column-8';

    if ($sidebar == 'left-sidebar') {
        $class_2 = 'order-2';
        $class_3 = 'order-1';
    } else {
        $class_2 = 'order-1';
        $class_3 = 'order-2';
    }
} else {
    $class_1 = 'column-12';
    $class_2 = '';
    $class_3 = '';
} ?>

<div class="wrapper">
    <div class="wrapper-inner">

        <div class="theme-panelarea-primary column <?php echo $class_1; ?> <?php echo $class_2; ?> column-md-12">
            <main id="main" class="site-main <?php if ($raute_ed_post_rating) {
                                                    echo 'raute-no-comment';
                                                } ?>" role="main">

                <?php
                if (have_posts()) : ?>

                    <div class="article-wraper">


                        <?php while (have_posts()) :
                            the_post();

                            get_template_part('template-parts/content', 'single');

                            /**
                             *  Output comments wrapper if it's a post, or if comments are open,
                             * or if there's a comment number – and check for password.
                             **/

                            if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) { ?>

                                <div class="comments-wrapper">
                                    <?php comments_template(); ?>
                                </div><!-- .comments-wrapper -->

                            <?php
                            }

                            $next_post = get_next_post();
                            if (!empty($next_post)) : ?>
                                <div class="twp-single-next-post twp-secondary-font">
                                    <h3 class="twp-title">
                                        <?php echo esc_html__('Next Post', 'raute'); ?>
                                        <?php raute_the_theme_svg('border-right'); ?>
                                    </h3>

                                    <?php
                                    $post_categories = get_the_category($next_post);
                                    if ($post_categories) {
                                        $output = '<div class="twp-categories"><ul>';
                                        foreach ($post_categories as $post_category) {
                                            $output .= '<li class="float-left">
                                                            <a class="raute-categories twp-primary-text" href="' . esc_url(get_category_link($post_category)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'raute'), $post_category->name)) . '"> 
                                                                ' . esc_html($post_category->name) . '
                                                            </a>
                                                        </li>';
                                        }
                                        $output .= '</ul></div>';
                                        echo $output;
                                    }
                                    ?>

                                    <h2 class="entry-title entry-title-big"><a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"><?php echo ($next_post->post_title); ?></a></h2>

                                    <div class="twp-time twp-primary-text"><?php echo get_the_date('D M j , Y', $next_post->ID); ?></div>

                                    <div class="twp-caption"><?php echo esc_html(get_the_excerpt($next_post->ID)); ?></div>
                                    <?php
                                    if (!empty(get_the_post_thumbnail($next_post->ID, 'large'))) { ?>
                                        <div class="twp-image-section"><?php echo wp_kses_post(get_the_post_thumbnail($next_post->ID, 'large')); ?></div>
                                    <?php } ?>
                                </div>
                        <?php endif;

                        endwhile; ?>

                    </div>

                <?php
                else :

                    get_template_part('template-parts/content', 'none');

                endif;

                /**
                 * Navigation
                 *
                 * @hooked raute_post_floating_nav - 10
                 * @hooked raute_related_posts - 20
                 * @hooked raute_single_post_navigation - 30
                 */

                do_action('raute_navigation_action'); ?>

            </main>
        </div>

        <?php if ($sidebar != 'no-sidebar') { ?>
            <div class="theme-panelarea-secondary column column-4 column-md-12 <?php echo $class_3; ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php } ?>

    </div>
</div>

<?php
get_footer();
