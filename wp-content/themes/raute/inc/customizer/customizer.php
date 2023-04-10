<?php
/**
 * Raute Theme Customizer
 *
 * @package Raute
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('raute_customize_register')) :

function raute_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/header.php';
	require get_template_directory() . '/inc/customizer/main-banner-section.php';
	require get_template_directory() . '/inc/customizer/about-section.php';
	require get_template_directory() . '/inc/customizer/featured-section.php';
	require get_template_directory() . '/inc/customizer/featured-gallery.php';
	require get_template_directory() . '/inc/customizer/cta.php';
	require get_template_directory() . '/inc/customizer/category-section.php';
	require get_template_directory() . '/inc/customizer/pagination.php';
	require get_template_directory() . '/inc/customizer/preloader.php';
	require get_template_directory() . '/inc/customizer/archive.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/single.php';
	require get_template_directory() . '/inc/customizer/footer.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'raute_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'raute_customize_partial_blogdescription',
		) );
	}


	$wp_customize->add_setting('header_section_title',
	    array(
	        'default'           => $raute_default['header_section_title'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('header_section_title',
	    array(
	        'label'       => esc_html__('Header Section Title', 'raute'),
	        'section'     => 'header_image',
	        'type'        => 'text',
	    )
	);


	$wp_customize->add_setting('header_section_sub_title',
	    array(
	        'default'           => $raute_default['header_section_sub_title'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('header_section_sub_title',
	    array(
	        'label'       => esc_html__('Header Section Sub Title', 'raute'),
	        'section'     => 'header_image',
	        'type'        => 'text',
	    )
	);
	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'raute' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'raute' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	// Homepage Options Panel.
	$wp_customize->add_panel( 'homepage_option_panel',
	    array(
	        'title'      => esc_html__( 'HomePage Options', 'raute' ),
	        'priority'   => 150,
	        'capability' => 'edit_theme_options',
	    )
	);


	$wp_customize->add_setting('logo_width_range',
	    array(
	        'default'           => $raute_default['logo_width_range'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'raute_sanitize_number_range',
	    )
	);
	$wp_customize->add_control('logo_width_range',
	    array(
	        'label'       => esc_html__('Logo Width', 'raute'),
	        'description'       => esc_html__( 'Specify the range of logo size from a minimum of 200 pixels to a maximum of 700 pixels, with increments of 20 pixels per step.', 'raute' ),
	        'section'     => 'title_tagline',
	        'type'        => 'range',
	        'input_attrs' => array(
				           'min'   => 200,
				           'max'   => 700,
				           'step'   => 20,
			        	),
	    )
	);
	// Register custom section types.
	$wp_customize->register_section_type( 'Raute_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Raute_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Raute Pro', 'raute' ),
				'pro_text' => esc_html__( 'Purchase', 'raute' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/raute-pro/'),
				'priority'  => 1,
			)
		)
	);

}

endif;
add_action( 'customize_register', 'raute_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('raute_customizer_scripts')) :

    function raute_customizer_scripts(){   
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('raute-repeater', get_template_directory_uri() . '/assets/lib/custom/css/repeater.css');
    	wp_enqueue_style('raute-customizer', get_template_directory_uri() . '/assets/lib/custom/css/customizer.css');
        wp_enqueue_script('raute-customizer', get_template_directory_uri() . '/assets/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);
        wp_enqueue_script('raute-repeater', get_template_directory_uri() . '/assets/lib/custom/js/repeater.js', array('jquery','customize-controls'), '', 1);

        $raute_post_category_list = raute_post_category_list();

	    $cat_option = '';

	    if( $raute_post_category_list ){
		    foreach( $raute_post_category_list as $key => $cats ){
		    	$cat_option .= "<option value='". esc_attr( $key )."'>". esc_html( $cats )."</option>";
		    }
		}

	    wp_localize_script( 
	        'raute-repeater', 
	        'raute_repeater',
	        array(
	           	'categories'   => $cat_option,
	            'upload_image'   =>  esc_html__('Choose Image','raute'),
	            'use_image'   =>  esc_html__('Select','raute'),
	         )
	    );

        $ajax_nonce = wp_create_nonce('raute_ajax_nonce');
        wp_localize_script( 
		    'raute-customizer', 
		    'raute_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'raute_customizer_scripts');
add_action('customize_controls_init', 'raute_customizer_scripts');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('raute_customize_partial_blogname')) :

	function raute_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('raute_customize_partial_blogdescription')) :

	function raute_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;


add_action('wp_ajax_raute_customizer_font_weight', 'raute_customizer_font_weight_callback');
add_action('wp_ajax_nopriv_raute_customizer_font_weight', 'raute_customizer_font_weight_callback');

// Recommendec Post Ajax Call Function.
function raute_customizer_font_weight_callback() {

    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( wp_unslash( $_POST['_wpnonce'] ), 'raute_ajax_nonce' ) && isset( $_POST['currentfont'] ) && sanitize_text_field( wp_unslash( $_POST['currentfont'] ) ) ) {

       $currentfont = sanitize_text_field( wp_unslash( $_POST['currentfont'] ) );
       $headings_fonts_property = Raute_Fonts::raute_get_fonts_property( $currentfont );

       foreach( $headings_fonts_property['weight'] as $key => $value ){
       		echo '<option value="'.esc_attr( $key ).'">'.esc_html( $value ).'</option>';
       }
    }
    wp_die();
}