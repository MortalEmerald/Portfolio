<?php
/**
* Single Post Options.
*
* @package Raute
*/

$raute_default = raute_get_default_theme_options();

$wp_customize->add_section( 'single_post_setting',
	array(
	'title'      => esc_html__( 'Single Post Settings', 'raute' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Global Sidebar Layout.
$wp_customize->add_setting( 'global_sidebar_layout',
    array(
    'default'           => $raute_default['global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'raute_sanitize_select',
    )
);
$wp_customize->add_control( 'global_sidebar_layout',
    array(
    'label'       => esc_html__( 'Global Sidebar Layout', 'raute' ),
    'section'     => 'single_post_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__( 'Right Sidebar', 'raute' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'raute' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'raute' ),
        ),
    )
);

$wp_customize->add_setting('ed_related_post',
    array(
        'default' => $raute_default['ed_related_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'raute_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_related_post',
    array(
        'label' => esc_html__('Enable Related Posts', 'raute'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'related_post_title',
    array(
    'default'           => $raute_default['related_post_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'related_post_title',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'raute' ),
    'section'  => 'single_post_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting('twp_navigation_type',
    array(
        'default' => $raute_default['twp_navigation_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'raute_sanitize_single_pagination_layout',
    )
);
$wp_customize->add_control('twp_navigation_type',
    array(
        'label' => esc_html__('Single Post Navigation Type', 'raute'),
        'section' => 'single_post_setting',
        'type' => 'select',
        'choices' => array(
                'no-navigation' => esc_html__('Disable Navigation','raute' ),
                'norma-navigation' => esc_html__('Next Previous Navigation','raute' ),
                'ajax-next-post-load' => esc_html__('Ajax Load Next 3 Posts Contents','raute' )
            ),
    )
);

$wp_customize->add_setting('ed_floating_next_previous_nav',
    array(
        'default' => $raute_default['ed_floating_next_previous_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'raute_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_floating_next_previous_nav',
    array(
        'label' => esc_html__('Enable Floating Next/Previous Post Nav', 'raute'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);