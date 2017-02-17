<?php

/**
 * Plugin Name:         Puzzle Page Builder
 * Plugin URI:          https://github.com/puzzalea/puzzle-page-builder
 * Description:         Create pages using custom sections.
 * Version:             0.20.1
 * Author:              Puzzalea
 * Author URI:          https://github.com/puzzalea/puzzalea
 * License:             GNU General Public License v2 or later
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least:   4.7
 * Tested up to:        4.7
 * Text Domain:         puzzle-page-builder
 */

if (!defined('ABSPATH')) exit;

/* Set global variables */
define('PPB_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PPB_PLUGIN_URL', plugins_url('/', __FILE__));

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
    $puzzle_settings = new PuzzleSettings;
    $puzzle_colors = new PuzzleColors;
    $f = new PuzzleFields;
    $puzzle_icon_libraries = new PuzzleIconLibraries;
    $puzzle_sections = new PuzzleSections;

    /* Hook to allow developers to modify settings */
    do_action('ppb_modify_settings', $puzzle_settings);

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
