<?php

/*
 * Puzzle Page Builder
 * Stylesheets and Scripts
 */

/* Add styles and scripts */
function ppb_scripts() {
    $puzzle_settings = new PuzzleSettings;
    
    $ppb_frontend_styles_location = 'assets/css/frontend-styles.css';
    wp_enqueue_style(
        'puzzle-page-builder-frontend-styles',
        plugin_dir_url(dirname(__FILE__)) . $ppb_frontend_styles_location,
        array(),
        filemtime(plugin_dir_path(dirname(__FILE__)) . $ppb_frontend_styles_location)
    );
    
    if ($puzzle_settings->has_owl_carousel()) {
        $owl_carousel_script_location = 'assets/js/lib/owl.carousel.min.js';
        wp_enqueue_script(
            'owl-carousel-script',
            plugin_dir_url(dirname(__FILE__)) . $owl_carousel_script_location,
            array('jquery'),
            filemtime(plugin_dir_path(dirname(__FILE__)) . $owl_carousel_script_location)
        );
    }
    
    $ppb_frontend_script_location = 'assets/js/frontend-script.js';
    wp_enqueue_script(
        'puzzle-page-builder-frontend-script',
        plugin_dir_url(dirname(__FILE__)) . $ppb_frontend_script_location,
        array('jquery'),
        filemtime(plugin_dir_path(dirname(__FILE__)) . $ppb_frontend_script_location)
    );
}
add_action('wp_enqueue_scripts', 'ppb_scripts');

/* Add admin styles */
function ppb_admin_styles() {
    wp_enqueue_style('wp-color-picker');
    
    wp_enqueue_style('puzzle-page-builder-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
    
    $ppb_admin_styles_location = 'assets/css/admin-styles.css';
    wp_enqueue_style(
        'puzzle-page-builder-admin-styles',
        plugin_dir_url(dirname(__FILE__)) . $ppb_admin_styles_location,
        array(),
        filemtime(plugin_dir_path(dirname(__FILE__)) . $ppb_admin_styles_location)
    );
}
add_action('admin_print_styles', 'ppb_admin_styles');

/* Add admin scripts */
function ppb_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('wp-color-picker');
    
    $ppb_admin_script_location = 'assets/js/admin-script.js';
    wp_enqueue_script(
        'puzzle-page-builder-admin-script',
        plugin_dir_url(dirname(__FILE__)) . $ppb_admin_script_location,
        array('jquery', 'jquery-ui-sortable'),
        filemtime(plugin_dir_path(dirname(__FILE__)) . $ppb_admin_script_location)
    );
}
add_action('admin_print_scripts', 'ppb_admin_scripts');

?>
