<?php
/**
 * Tortoise functions and definitions
 */

if ( ! function_exists( 'tortoise_support' ) ) {

	// Sets up theme defaults and registers support for various WordPress features.
	function tortoise_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}
}
add_action( 'after_setup_theme', 'tortoise_support' );

if ( ! function_exists( 'tortoise_styles' ) ) {
	// Enqueue styles.
	function tortoise_styles() {

		// Register theme stylesheet.
		wp_register_style(
			'tortoise-style',
			get_template_directory_uri() . '/assets/css/theme.min.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);

		// Add styles inline.
		wp_add_inline_style( 'tortoise-style', tortoise_get_font_face_styles() );

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'tortoise-style' );

	}
}
add_action( 'wp_enqueue_scripts', 'tortoise_styles' );

if ( ! function_exists( 'tortoise_editor_styles' ) ) {
	// Enqueue editor styles.
	function tortoise_editor_styles() {
		// Add styles inline.
		wp_add_inline_style( 'wp-block-library', tortoise_get_font_face_styles() );

		add_editor_style(
			get_template_directory_uri() . '/assets/css/theme.min.css'
		);
	}
}
add_action( 'admin_init', 'tortoise_editor_styles' );

// Get font face styles.
if ( ! function_exists( 'tortoise_get_font_face_styles' ) ) {
	function tortoise_get_font_face_styles() {
		return "
		@font-face{
			font-family: 'Kanit';
			font-weight: 100;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-Thin.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 100;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-ThinItalic.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 200;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-ExtraLight.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 200;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-ExtraLightItalic.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 300;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-Light.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 300;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-LightItalic.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 400;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-Regular.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 400;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-Italic.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 500;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-Medium.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 500;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-MediumItalic.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 600;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-SemiBold.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 600;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-SemiBoldItalic.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 700;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-Bold.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 700;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-BoldItalic.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 800;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-ExtraBold.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 800;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-ExtraBoldItalic.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 900;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-Black.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Kanit';
			font-weight: 900;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/Kanit-BlackItalic.woff2' ) . "') format('woff2');
		}
		";
	}
}

// Add script to Editor
if ( ! function_exists( 'tortoise_admin_add_scripts' ) ) {
	function tortoise_admin_add_scripts( $hook ){
		if ( 'appearance_page_tortoise' != $hook ) {
			return;
		}
		
		wp_register_style( 'tortoise-settings-css',  get_template_directory_uri() . '/assets/css/admin.min.css' , '1.0.0' );
		wp_enqueue_style( 'tortoise-settings-css');
	
	}
}
add_action( 'admin_enqueue_scripts', 'tortoise_admin_add_scripts');

// Add admin page content
get_template_part( 'inc/theme' );

// Add admin page
if ( ! function_exists( 'tortoise_create_menu' ) ) {
	add_action( 'admin_menu', 'tortoise_create_menu' );
	// Adds our dashboard menu item
	function tortoise_create_menu() {
		add_theme_page( 'Tortoise WordPress Theme', 'Tortoise', 'edit_theme_options', 'tortoise', 'tortoise_admin_theme_page' );
	}
}