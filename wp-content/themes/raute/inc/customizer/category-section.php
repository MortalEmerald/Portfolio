<?php
// Homepage Category section settings.
$wp_customize->add_section( 'homepage_category_Section',
    array(
    'title'      => esc_html__( 'Category Section Settings', 'raute' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'homepage_option_panel',
    'priority'   => 100,
    )
);

$wp_customize->add_setting('ed_category_section',
    array(
        'default' => $raute_default['ed_category_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'raute_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_category_section',
    array(
        'label' => esc_html__('Enable Category Section', 'raute'),
        'section' => 'homepage_category_Section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('category_section_title',
    array(
        'default'           => $raute_default['category_section_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('category_section_title',
    array(
        'label'       => esc_html__('Section Title', 'raute'),
        'section'     => 'homepage_category_Section',
        'type'        => 'text',
    )
);

for ($i=1; $i < 4; $i++) { 
    // Setting - drop down category for service.
    $wp_customize->add_setting('select_category_for_category'.$i,
        array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(new Raute_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_category'.$i,
        array(
            'label'           => esc_html__('Select Category for Category', 'raute').$i,
            'section'         => 'homepage_category_Section',
            'type'            => 'dropdown-taxonomies',
            'taxonomy'        => 'category',

        )));
}
