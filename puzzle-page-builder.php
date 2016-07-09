<?php

/**
 * Plugin Name: Puzzle Page Builder
 * Plugin URI: https://github.com/caraheacock/puzzle-page-builder
 * Description: Create pages using custom sections.
 * Version: 0.3.0
 * Author: Cara Heacock
 * Author URI: http://caraheacock.com
 * License: GPL2
 */

require_once('php/helpers.php');
require_once('php/classes/settings.php');

require_once('php/classes/icon_library.php');
require_once('php/classes/icon_libraries.php');
require_once('php/classes/page_builder_template.php');
require_once('php/classes/section.php');
require_once('php/classes/sections.php');
require_once('php/classes/page_builder.php');

foreach (glob(plugin_dir_path(__FILE__) . 'php/icon_libraries/*.php') as $filename) {
    include $filename;
}

foreach (glob(plugin_dir_path(__FILE__) . 'php/sections/*.php') as $filename) {
    include $filename;
}

require_once('php/shortcodes.php');
require_once('php/icon_library.php');
require_once('php/page_builder.php');
require_once('php/assets.php');
require_once('php/templates.php');

?>
