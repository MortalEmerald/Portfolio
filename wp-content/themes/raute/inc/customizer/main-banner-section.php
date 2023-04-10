<?php
// Homepage Main Banner section settings.
$wp_customize->add_section( 'homepage_main_banner_Section',
    array(
    'title'      => esc_html__( 'Main Banner Section Settings', 'raute' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'homepage_option_panel',
    'priority'   => 10,
    )
);

$wp_customize->add_setting('ed_main_banner_section',
    array(
        'default' => $raute_default['ed_main_banner_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'raute_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_main_banner_section',
    array(
        'label' => esc_html__('Enable Main Banner Section', 'raute'),
        'section' => 'homepage_main_banner_Section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('main_banner_section_title_wide',
    array(
        'default'           => $raute_default['main_banner_section_title_wide'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_banner_section_title_wide',
    array(
        'label'       => esc_html__('Section Title Wide', 'raute'),
        'section'     => 'homepage_main_banner_Section',
        'type'        => 'text',
    )
);

// Setting - drop down category for service.
$wp_customize->add_setting('select_category_for_main_banner_wide',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(new Raute_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_main_banner_wide',
    array(
        'label'           => esc_html__('Select Category for Main Banner Block Wide', 'raute'),
        'section'         => 'homepage_main_banner_Section',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',

    )));

$wp_customize->add_setting( 'number_of_post_main_banner_wide',
    array(
    'default'           => $raute_default['number_of_post_main_banner_wide'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'raute_sanitize_select',
    )
);
$wp_customize->add_control( 'number_of_post_main_banner_wide',
    array(
    'label'       => esc_html__( 'Number Of Post on Main Banner Wide section', 'raute' ),
    'section'     => 'homepage_main_banner_Section',
    'type'        => 'select',
    'choices'               => array(
        '3' => esc_html__( '3', 'raute' ),
        '5' => esc_html__( '5', 'raute' ),
        '7' => esc_html__( '7', 'raute' ),
        ),
    )
);

$wp_customize->add_setting('main_banner_section_title_narrow',
    array(
        'default'           => $raute_default['main_banner_section_title_narrow'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_banner_section_title_narrow',
    array(
        'label'       => esc_html__('Section Title Narrow', 'raute'),
        'section'     => 'homepage_main_banner_Section',
        'type'        => 'text',
    )
);

// Setting - drop down category for service.
$wp_customize->add_setting('select_category_for_main_banner_narrow',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(new Raute_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_main_banner_narrow',
    array(
        'label'           => esc_html__('Select Category for Main Banner Block Narrow', 'raute'),
        'section'         => 'homepage_main_banner_Section',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
    )));
