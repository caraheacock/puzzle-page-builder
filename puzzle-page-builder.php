<?php

/**
 * Plugin Name: Puzzle Page Builder
 * Plugin URI: https://github.com/caraheacock/puzzle-page-builder
 * Description: Create pages using custom sections.
 * Version: 0.7.1
 * Author: Cara Heacock
 * Author URI: http://caraheacock.com
 * License: GPL2
 */

require_once('php/helpers.php');

/* Classes */
foreach (glob(plugin_dir_path(__FILE__) . 'php/classes/*.php') as $filename) {
    include $filename;
}

/* Objects */
foreach (glob(plugin_dir_path(__FILE__) . 'php/fields/*.php') as $filename) {
    include $filename;
}

foreach (glob(plugin_dir_path(__FILE__) . 'php/icon_libraries/*.php') as $filename) {
    include $filename;
}

foreach (glob(plugin_dir_path(__FILE__) . 'php/sections/*.php') as $filename) {
    include $filename;
}

/* Metaboxes, templates, etc. */
require_once('php/shortcodes.php');
require_once('php/icon_library.php');
require_once('php/page_builder.php');
require_once('php/assets.php');
require_once('php/templates.php');

?>
