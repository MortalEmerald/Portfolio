<?php
/**
 * Raute About Page
 * @package Raute
 *
 */
if (!class_exists('Raute_About_page')):
    class Raute_About_page
    {
        function __construct()
        {
            add_action('admin_menu', array($this, 'raute_backend_menu'), 999);
        }
        // Add Backend Menu
        function raute_backend_menu()
        {
            add_theme_page(esc_html__('Raute', 'raute'), esc_html__('Raute', 'raute'), 'activate_plugins', 'raute-about', array($this, 'raute_main_page'), 1);
        }
        // Settings Form
        function raute_main_page()
        {
            require get_template_directory() . '/classes/about-render.php';
        }
    }
    new Raute_About_page();
endif;