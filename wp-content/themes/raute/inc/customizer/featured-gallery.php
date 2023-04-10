<?php
// Homepage Gallery section settings.
$wp_customize->add_section( 'homepage_gallery_Section',
    array(
    'title'      => esc_html__( 'Gallery Section Settings', 'raute' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'homepage_option_panel',
    'priority'   => 50,

    )
);

$wp_customize->add_setting('ed_gallery_section',
    array(
        'default' => $raute_default['ed_gallery_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'raute_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_gallery_section',
    array(
        'label' => esc_html__('Enable Gallery Section', 'raute'),
        'section' => 'homepage_gallery_Section',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('gallery_section_title',
    array(
        'default'           => $raute_default['gallery_section_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('gallery_section_title',
    array(
        'label'       => esc_html__('Gallery Section Title', 'raute'),
        'section'     => 'homepage_gallery_Section',
        'type'        => 'text',
    )
);

for ($i=1; $i < 8; $i++) { 
    $wp_customize->add_setting('twp_gallery_image_'.$i,
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'twp_gallery_image_'.$i,
            array(
                'label'      => esc_html__( 'Gallery Image - ', 'raute' ).$i,
                'section'    => 'homepage_gallery_Section',
            )
        )
    );
}
