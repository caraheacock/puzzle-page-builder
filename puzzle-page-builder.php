<?php

/**
 * Plugin Name: Puzzle Page Builder
 * Plugin URI: https://github.com/caraheacock/puzzle-page-builder
 * Description: Create pages using custom sections.
 * Version: 0.16.0
 * Author: Cara Heacock
 * Author URI: http://caraheacock.com
 * License: GPL2
 * Text Domain: puzzle-page-builder
 */

/* Set global variables */
define('PPB_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PPB_PLUGIN_URL', plugins_url('/', __FILE__));

/* Settings */
function ppb_init_settings() {
    include(PPB_PLUGIN_DIR . 'includes/settings/settings.php');
}
add_action('plugins_loaded', 'ppb_init_settings', 8);

/* Helpers and classes */
function ppb_init_classes() {
    /* Helper functions */
    foreach (glob(PPB_PLUGIN_DIR . 'includes/helpers/*.php') as $filename) {
        include $filename;
    }

    /* Classes */
    foreach (glob(PPB_PLUGIN_DIR . 'includes/classes/*.php') as $filename) {
        include $filename;
    }
}
add_action('plugins_loaded', 'ppb_init_classes', 9);

/* Objects */
function ppb_init_objects() {
    /*
     * Instances of classes that are used throughout the included files
     * and actions
     */
    $puzzle_colors = new PuzzleColors;
    $f = new PuzzleFields;
    $puzzle_icon_libraries = new PuzzleIconLibraries;
    $puzzle_sections = new PuzzleSections;
    
    /* Colors */
    include(PPB_PLUGIN_DIR . 'includes/objects/colors/colors.php');
    
    /* Hook to allow developers to modify colors */
    do_action('ppb_modify_colors', $puzzle_colors);
    
    /* Fields */
    foreach (glob(PPB_PLUGIN_DIR . 'includes/objects/fields/*.php') as $filename) {
        include $filename;
    }
    
    /*
     * Hook to allow developers to modify core fields before they are used
     * in sections
     */
    do_action('ppb_modify_fields', $f);
    
    /* Icon libraries */
    foreach (glob(PPB_PLUGIN_DIR . 'includes/objects/icon_libraries/*.php') as $filename) {
        include $filename;
    }
    
    /* Hook to allow developers to modify the icon libraries */
    do_action('ppb_modify_icon_libraries', $puzzle_icon_libraries);
    
    /* Sections */
    foreach (glob(PPB_PLUGIN_DIR . 'includes/objects/sections/*.php') as $filename) {
        include $filename;
    }
    
    /* Hook to allow developers to modify the sections */
    do_action('ppb_modify_sections', $puzzle_sections, $f);
}
add_action('init', 'ppb_init_objects', 11);

/* Setup assets, page builder, etc. */
foreach (glob(PPB_PLUGIN_DIR . 'includes/setup/*.php') as $filename) {
    include $filename;
}

?>
