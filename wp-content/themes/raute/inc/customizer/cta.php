<?php
/**
* CTA Section
*
* @package Raute
*/
$raute_default = raute_get_default_theme_options();
$raute_post_category_list = raute_post_category_list();

// Homepage CTA section settings.
$wp_customize->add_section( 'homepage_cta_Section',
    array(
    'title'      => esc_html__( 'CTA Section Settings', 'raute' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'homepage_option_panel',
    'priority'   => 50,

    )
);

$wp_customize->add_setting('ed_cta_section',
    array(
        'default' => $raute_default['ed_cta_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'raute_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_cta_section',
    array(
        'label' => esc_html__('Enable CTA Section', 'raute'),
        'section' => 'homepage_cta_Section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('cta_section_sub_text',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('cta_section_sub_text',
    array(
        'label'       => esc_html__('Section Sub Title', 'raute'),
        'section'     => 'homepage_cta_Section',
        'type'        => 'text',
    )
);


$wp_customize->add_setting( 'select_page_for_cta', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'raute_sanitize_dropdown_pages',
) );

$wp_customize->add_control( 'select_page_for_cta', array(
    'label'             => __( 'Select CTA Page', 'raute' ) ,
    'section'           => 'homepage_cta_Section',
    'type'              => 'dropdown-pages',
    'allow_addition' => true,
    )
);


$wp_customize->add_setting('cta_section_button_text',
    array(
        'default'           => $raute_default['cta_section_button_text'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('cta_section_button_text',
    array(
        'label'       => esc_html__('Section Button Text', 'raute'),
        'section'     => 'homepage_cta_Section',
        'type'        => 'text',
    )
);

$wp_customize->add_setting( 'cta_section_button_url',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'cta_section_button_url',
    array(
    'label'       => esc_html__( 'Section Button Link', 'raute' ),
    'section'     => 'homepage_cta_Section',
    'type'        => 'text',
    )
);