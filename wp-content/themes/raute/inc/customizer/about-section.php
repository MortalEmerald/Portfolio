<?php
/**
* Slider Section
*
* @package Raute
*/
$raute_default = raute_get_default_theme_options();
$raute_post_category_list = raute_post_category_list();

// Homepage About section settings.
$wp_customize->add_section( 'homepage_about_Section',
    array(
    'title'      => esc_html__( 'About Section Settings', 'raute' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'homepage_option_panel',
    'priority'   => 50,

    )
);

$wp_customize->add_setting('ed_about_section',
    array(
        'default' => $raute_default['ed_about_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'raute_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_about_section',
    array(
        'label' => esc_html__('Enable About Section', 'raute'),
        'section' => 'homepage_about_Section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'select_page_for_about', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'raute_sanitize_dropdown_pages',
) );

$wp_customize->add_control( 'select_page_for_about', array(
    'label'             => __( 'Select About Page', 'raute' ) ,
    'section'           => 'homepage_about_Section',
    'type'              => 'dropdown-pages',
    'allow_addition' => true,
    )
);

$wp_customize->add_setting('about_section_sub_title',
    array(
        'default'           => $raute_default['about_section_sub_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('about_section_sub_title',
    array(
        'label'       => esc_html__('Section Sub Title', 'raute'),
        'section'     => 'homepage_about_Section',
        'type'        => 'text',
    )
);

$wp_customize->add_setting('twp_about_featured_image_1',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'twp_about_featured_image_1',
        array(
            'label'      => esc_html__( 'About Page Featured Image - 1', 'raute' ),
            'section'    => 'homepage_about_Section',
        )
    )
);

$wp_customize->add_setting('twp_about_featured_image_2',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'twp_about_featured_image_2',
        array(
            'label'      => esc_html__( 'About Page Featured Image - 2', 'raute' ),
            'section'    => 'homepage_about_Section',
        )
    )
);