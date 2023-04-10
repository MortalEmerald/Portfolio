<?php
/**
 * Pagination Settings
 *
 * @package Raute
 */

$raute_default = raute_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'raute_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'raute' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'raute_pagination_layout',
	array(
	'default'           => $raute_default['raute_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'raute_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'raute' ),
	'section'     => 'raute_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','raute'),
		'numeric' => esc_html__('Numeric Method','raute'),
		'load-more' => esc_html__('Ajax Load More Button','raute'),
		'auto-load' => esc_html__('Ajax Auto Load','raute'),
	),
	)
);