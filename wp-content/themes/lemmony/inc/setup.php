<?php 
/*
 * Disallow direct access
 */
if( !defined( 'ABSPATH' ) ) {
    die( 'Forbidden.' );
}


/**
 * Enqueue assets for block editor
 */
if( !function_exists( 'lemmony_setup' ) ) :
	function lemmony_setup() {
		// Block editor support
		add_theme_support( 'wp-block-styles' );

        // Custom styling
		add_editor_style( 'assets/css/styles.css' );
	}
	add_action( 'after_setup_theme', 'lemmony_setup' );
endif;


/**
 * Enqueue block editor assets
 */
function lemmony_gutenberg_assets() {
    // Editor controls scripts
	wp_enqueue_script( 'lemmony-editor', get_template_directory_uri() . '/assets/js/editor.js', [ 'wp-block-editor', 'wp-components', 'wp-element' ], LEMMONY_THEME_VERSION, true );
}
add_action( 'enqueue_block_editor_assets', 'lemmony_gutenberg_assets' );


/**
 * Enqueue assets
 */
if( !function_exists( 'lemmony_assets' ) ) :
	function lemmony_assets() {
        // Simple Parallax plugin
		wp_enqueue_script( 'simpleparallax', get_template_directory_uri() . '/assets/libraries/simpleParallax/simpleParallax.min.js', [], '5.5.1', true );

        // CountUp plugin
		wp_enqueue_script( 'countup', get_template_directory_uri() . '/assets/libraries/countup/countup.min.js', [], '2.3.2', true );

        // Typed plugin
		wp_enqueue_script( 'typed', get_template_directory_uri() . '/assets/libraries/typed/typed.min.js', [], '2.0.12', true );

        // Custom styling
		wp_enqueue_style( 'lemmony-editor', get_template_directory_uri() . '/assets/css/styles.css', [], wp_get_theme()->get( 'Version' ) );

        // Custom scripts
		wp_enqueue_script( 'lemmony-scripts', get_template_directory_uri() . '/assets/js/scripts.js', [], wp_get_theme()->get( 'Version' ), true );
	}
	add_action( 'wp_enqueue_scripts', 'lemmony_assets' );
endif;


/**
 * Enqueue admin assets
 */
function lemmony_admin_assets() {
    // Admin custom styling
    wp_enqueue_style( 'lemmony-admin', get_template_directory_uri() . '/assets/admin/css/admin.css', [], LEMMONY_THEME_VERSION );

    // Admin notice scripts
    $plugin = 'lemmony-companion/lemmony-companion.php';
    $page = isset( $_GET['page']  ) ? $_GET['page'] : '';
    if( ( !is_plugin_active( $plugin ) && get_user_meta( get_current_user_id(), 'lemmony-notice-closed', 1 ) != LEMMONY_THEME_VERSION ) || ( $page == 'lemmony' ) ) :
        wp_enqueue_script( 'lemmony-admin-notice', get_template_directory_uri() . '/assets/admin/js/admin-notice.js', [ 'jquery' ], LEMMONY_THEME_VERSION ); 
    endif;
}
add_action( 'admin_enqueue_scripts', 'lemmony_admin_assets' );


/**
 * Get assetes media URL (for patterns)
 */
function lemmony_media( $file ) {
    return get_template_directory_uri() . '/assets/media/content/' . $file;
}


/**
 * Register block categories
 */
function lemmony_register_block_categories() {
    register_block_pattern_category(
        'lemmony-patterns',
        [ 
            'label' => __( 'Lemmony Patterns', 'lemmony' )
        ]
    );
    register_block_pattern_category(
        'lemmony-pages',
        [ 
            'label' => __( 'Lemmony Pages', 'lemmony' )
        ]
    );
}
add_action( 'init', 'lemmony_register_block_categories' );


/**
 * Register block styles
 */
function lemmony_register_block_styles() {
    if( function_exists( 'register_block_style' ) ) {
        register_block_style(
            'core/post-terms',
            [
                'name'         => 'dots',
                'label'        => __( 'Dot Seperators', 'lemmony' ),
                'is_default'   => false,
            ]
        );

        register_block_style(
            'core/post-terms',
            [
                'name'         => 'boxes',
                'label'        => __( 'Boxes', 'lemmony' ),
                'is_default'   => false,
            ]
        );

        register_block_style(
            'core/post-author',
            [
                'name'         => 'large',
                'label'        => __( 'Large', 'lemmony' ),
                'is_default'   => false,
            ]
        );

        register_block_style(
            'core/post-navigation-link',
            [
                'name'         => 'button',
                'label'        => __( 'Button', 'lemmony' ),
                'is_default'   => false,
            ]
        );

        register_block_style(
            'core/query-pagination-previous',
            [
                'name'         => 'button',
                'label'        => __( 'Button', 'lemmony' ),
                'is_default'   => false,
            ]
        );

        register_block_style(
            'core/query-pagination-next',
            [
                'name'         => 'button',
                'label'        => __( 'Button', 'lemmony' ),
                'is_default'   => false,
            ]
        );

        register_block_style(
            'core/search',
            [
                'name'         => 'border-with-radius',
                'label'        => __( 'Border & Radius', 'lemmony' ),
                'is_default'   => false,
            ]
        );

        register_block_style(
            'core/image',
            [
                'name'         => 'hover-zoom',
                'label'        => __( 'Hover Zoom', 'lemmony' ),
            ]
        );

        register_block_style(
            'core/group',
            [
                'name'         => 'hover-bg',
                'label'        => __( 'Hover Background', 'lemmony' ),
            ]
        );

        register_block_style(
            'core/group',
            [
                'name'         => 'hover-bg',
                'label'        => __( 'Hover Background', 'lemmony' ),
            ]
        );

        register_block_style(
            'core/comment-template',
            [
                'name'         => 'replies-bg',
                'label'        => __( 'Replies with BG', 'lemmony' ),
            ]
        );
        
        register_block_style(
            'core/comments-title',
            [
                'name'         => 'with-icon',
                'label'        => __( 'With Icon', 'lemmony' ),
            ]
        );
    }
}
add_action( 'init', 'lemmony_register_block_styles' );