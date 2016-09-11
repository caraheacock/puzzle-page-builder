<?php

/**
 * Plugin Name: Puzzle Page Builder
 * Plugin URI: https://github.com/caraheacock/puzzle-page-builder
 * Description: Create pages using custom sections.
 * Version: 0.9.1
 * Author: Cara Heacock
 * Author URI: http://caraheacock.com
 * License: GPL2
 */

/* Set global variables */
define('PPB_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PPB_PLUGIN_URL', plugins_url('/', __FILE__));

/* Miscellaneous helper functions */
require_once('php/helpers.php');

/* Classes */
foreach (glob(PPB_PLUGIN_DIR . 'php/classes/*.php') as $filename) {
    include $filename;
}

/* Objects */
function ppb_init_objects() {
    /*
     * Instances of classes that are used throughout the included files
     * and actions
     */
    $f = new PuzzleFields;
    $puzzle_icon_libraries = new PuzzleIconLibraries;
    $puzzle_sections = new PuzzleSections;
    
    /* Include fields */
    foreach (glob(PPB_PLUGIN_DIR . 'php/fields/*.php') as $filename) {
        include $filename;
    }
    
    /*
     * Hook to allow developers to modify core fields before they are used
     * in sections
     */
    do_action('ppb_modify_fields', $f);
    
    /* Include icon libraries */
    foreach (glob(PPB_PLUGIN_DIR . 'php/icon_libraries/*.php') as $filename) {
        include $filename;
    }
    
    /* Hook to allow developers to modify the icon libraries */
    do_action('ppb_modify_icon_libraries', $puzzle_icon_libraries);
    
    /* Include sections */
    foreach (glob(PPB_PLUGIN_DIR . 'php/sections/*.php') as $filename) {
        include $filename;
    }
    
    /* Hook to allow developers to modify the sections */
    do_action('ppb_modify_sections', $puzzle_sections, $f);
}
add_action('init', 'ppb_init_objects', 11);

/* Metaboxes, templates, etc. */
require_once('php/shortcodes.php');
require_once('php/icon_library.php');
require_once('php/page_builder.php');
require_once('php/assets.php');
require_once('php/templates.php');

?>
