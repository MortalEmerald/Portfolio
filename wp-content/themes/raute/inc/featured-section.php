<?php

/**
 * Featured Trip Section
 *
 * @since Raute 1.0.0
 *
 */

if (!function_exists('raute_featured_section')) :

    function raute_featured_section()
    {
        $raute_default = raute_get_default_theme_options();
        $ed_featured_section = get_theme_mod('ed_featured_section', $raute_default['ed_featured_section']);
        $count = 1;
        if ($ed_featured_section) {
            $select_category_for_featured = get_theme_mod('select_category_for_featured');
            $featured_section_title = get_theme_mod('featured_section_title', $raute_default['featured_section_title']);
            $featured_section_sub_title = get_theme_mod('featured_section_sub_title');

            $qargs = array(
                'posts_per_page' => 3,
                'orderby' => 'post__in',
                'post_type' => 'post',
            );

            if (!empty($select_category_for_featured)) {
                $qargs['cat'] = absint($select_category_for_featured);
            }
            $image_url = '';
            $featured_post_query = new WP_Query($qargs); ?>

        <?php if ($featured_post_query->have_posts()) : ?>
            <div class="theme-grid-article theme-block">
                <div class="wrapper">
                    <div class="wrapper-inner">
                        <div class="column column-12">
                            <div class="theme-panel-header">
                                <div class="panel-header-title">
                                    <?php if (!empty($featured_section_title)) { ?>
                                        <h2 class="entry-title entry-title-big">
                                            <?php echo esc_html($featured_section_title); ?>
                                        </h2>
                                    <?php } ?>
                                </div>
                                
                                 <?php if (!empty($featured_section_sub_title)) { ?>
                                    <div class="panel-header-subtitle">
                                        <h2>
                                            <?php echo esc_html($featured_section_sub_title); ?>
                                        </h2>
                                    </div>
                                    <?php } ?>
                            </div>

                            <div class="theme-panel-body">
                                <div class="wrapper-inner">
                                    <?php while ($featured_post_query->have_posts()) : $featured_post_query->the_post();
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium_large');
                                            $image_url = isset($image[0]) ? $image[0] : '';
                                        }
                                    ?>
                                    <?php 
                                    $twp_colum_featured_class = '';
                                    if ($count %2 == 0) {
                                        $twp_colum_featured_class = 'column-6 column-lg-4 column-sm-12 order-sm-1 mb-sm-32';
                                        $twp_colum_featured_aos = 'fade-up';
                                        $twp_colum_featured_aos_duration = '1000';
                                    } else {
                                        $twp_colum_featured_class = 'column-3 column-lg-4 column-sm-6 column-xs-12 mb-sm-32';
                                        $twp_colum_featured_aos = 'fade-down';
                                        $twp_colum_featured_aos_duration = '1000';
                                    } ?>
                                    <div class="column <?php echo $twp_colum_featured_class; ?>" data-aos = <?php echo $twp_colum_featured_aos; ?> data-aos-duration = <?php echo $twp_colum_featured_aos_duration; ?>>
                                        <article class="theme-news-article content-overlay-position image-border-radius">
                                            <div class="data-bg data-bg-large theme-image-overlay" data-background='<?php echo esc_url($image_url); ?>'></div>

                                            <div class="news-article-content">
                                                <h2 class="entry-title entry-title-medium">
                                                    <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
                                                </h2>

                                                <div class = 'line-clamp-3'>
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <?php
                                    $count++;
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

<?php
        }
    }

endif;
