<?php

/*
 * Puzzle Page Builder
 * Stylesheets and Scripts
 */

if (!defined('ABSPATH')) exit;

/* Add styles and scripts */
function ppb_scripts() {
    $puzzle_settings = new PuzzleSettings;
    
    /* Main style */
    $ppb_frontend_style_location = 'assets/css/frontend-style.css';
    wp_enqueue_style(
        'puzzle-page-builder-frontend-style',
        PPB_PLUGIN_URL . $ppb_frontend_style_location,
        array(),
        filemtime(PPB_PLUGIN_DIR . $ppb_frontend_style_location)
    );
    
    /* Custom style generated from user options */
    $puzzle_custom_style_location = 'assets/css/custom.css';
    ppb_check_if_custom_style_exists();
    wp_enqueue_style(
        'puzzle-page-builder-custom-style',
        PPB_PLUGIN_URL . $puzzle_custom_style_location,
        array(),
        filemtime(PPB_PLUGIN_DIR . $puzzle_custom_style_location)
    );
    
    /* Owl Carousel script */
    if ($puzzle_settings->has_owl_carousel()) {
        $owl_carousel_script_location = 'assets/js/lib/owl.carousel.min.js';
        wp_enqueue_script(
            'owl-carousel-script',
            PPB_PLUGIN_URL . $owl_carousel_script_location,
            array('jquery'),
            filemtime(PPB_PLUGIN_DIR . $owl_carousel_script_location)
        );
    }
    
    /* Main script */
    $ppb_frontend_script_location = 'assets/js/frontend-script.js';
    wp_enqueue_script(
        'puzzle-page-builder-frontend-script',
        PPB_PLUGIN_URL . $ppb_frontend_script_location,
        array('jquery'),
        filemtime(PPB_PLUGIN_DIR . $ppb_frontend_script_location)
    );
}
add_action('wp_enqueue_scripts', 'ppb_scripts');

/* Add admin styles */
function ppb_admin_styles() {
    wp_enqueue_style('wp-color-picker');
    
    wp_enqueue_style('puzzle-page-builder-google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i');
    
    $ppb_admin_style_location = 'assets/css/admin-style.css';
    wp_enqueue_style(
        'puzzle-page-builder-admin-style',
        PPB_PLUGIN_URL . $ppb_admin_style_location,
        array(),
        filemtime(PPB_PLUGIN_DIR . $ppb_admin_style_location)
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
        PPB_PLUGIN_URL . $ppb_admin_script_location,
        array('jquery', 'jquery-ui-sortable'),
        filemtime(PPB_PLUGIN_DIR . $ppb_admin_script_location)
    );
}
add_action('admin_print_scripts', 'ppb_admin_scripts');

/* Add editor stylesheets */
function ppb_editor_style($stylesheets) {
    $puzzle_settings = new PuzzleSettings;
    if (!$puzzle_settings->has_button_formats()) return $stylesheets;
    
    $stylesheets .= !empty($stylesheets) ? ',' : '';
    $stylesheets .= PPB_PLUGIN_URL . 'assets/css/editor-style.css';
    return $stylesheets;
}
add_filter('mce_css', 'ppb_editor_style', 9);

?>
