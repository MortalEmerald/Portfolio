<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* @package Raute
 * @since 1.0.0
 */
$raute_default = raute_get_default_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('twp-archive-items'); ?>>
	<div class="entry-wrapper">
        <?php
        if( function_exists('has_block') && has_block('quote', get_the_content() ) ){

            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium_large' );
            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : '';?>

            <div class="entry-content-media">
                <div class="data-bg data-bg-big" <?php if( $featured_image ){ ?>data-background="<?php echo esc_url( $featured_image ); ?>" <?php } ?>>
                <?php
                $format = get_post_format(get_the_ID()) ?: 'standard';
                $icon = raute_post_format_icon($format);
                if (!empty($icon)) { ?>
                    <div class="post-format-icon"><?php echo raute_svg_escape($icon); ?></div>
                <?php } ?>

                <div class="twp-content-quote">

                    <?php
                    $post_blocks = parse_blocks( get_the_content() );

                    if( $post_blocks ){

                        foreach( $post_blocks as $post_block ){

                            if( isset( $post_block['blockName'] ) &&
                                isset( $post_block['innerHTML'] ) &&
                                $post_block['blockName'] == 'core/quote' ){


                                echo wp_kses_post( $post_block['innerHTML'] );


                                break;

                            }
                        }
                    } ?>

                </div>
                </div>
            </div>
            <?php

        }else{

            if( has_post_thumbnail() ){

                $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium_large' );
                $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                <div class="entry-thumbnail">

                    <a href="<?php the_permalink(); ?>">
                    <img class="entry-responsive-thumbnail" src="<?php echo esc_url( $featured_image ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">

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
                <?php raute_entry_footer( $cats = true, $tags = false, $edits = false ); ?>
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

            <?php raute_read_more_render(); ?>

        </div>
    </div>
            
</article>