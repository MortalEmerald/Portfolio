<?php
// Homepage Featured section settings.
$wp_customize->add_section( 'homepage_featured_post_Section',
    array(
    'title'      => esc_html__( 'Featured Section Settings', 'raute' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'homepage_option_panel',
    'priority'   => 30,
    )
);

$wp_customize->add_setting('ed_featured_section',
    array(
        'default' => $raute_default['ed_featured_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'raute_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_featured_section',
    array(
        'label' => esc_html__('Enable Featured Section', 'raute'),
        'section' => 'homepage_featured_post_Section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('featured_section_title',
    array(
        'default'           => $raute_default['featured_section_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('featured_section_title',
    array(
        'label'       => esc_html__('Section Title', 'raute'),
        'section'     => 'homepage_featured_post_Section',
        'type'        => 'text',
    )
);


$wp_customize->add_setting('featured_section_sub_title',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('featured_section_sub_title',
    array(
        'label'       => esc_html__('Section Sub Title', 'raute'),
        'section'     => 'homepage_featured_post_Section',
        'type'        => 'text',
    )
);

// Setting - drop down category for service.
$wp_customize->add_setting('select_category_for_featured',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(new Raute_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_featured',
    array(
        'label'           => esc_html__('Select Category for Featured', 'raute'),
        'section'         => 'homepage_featured_post_Section',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',

    )));