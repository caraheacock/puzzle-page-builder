<?php

/*
 * Puzzle Page Builder
 * Template functionality
 */

/*
 * Locates a template part
 * A theme's templates take precedence over the plugin's templates.
 * If neither template can be found, nothing will load.
 */
function ppb_locate_template($template_name) {
    $location = '';
    $puzzle_settings = new PuzzleSettings;
    
    $theme_location = get_stylesheet_directory() . trailingslashit($puzzle_settings->templates_directory()) . $template_name . '.php';
    $plugin_location = plugin_dir_path(dirname(__FILE__)) . 'views/partials/' . $template_name . '.php';
    
    if (file_exists($theme_location)) {
        $location = $theme_location;
    } elseif (file_exists($plugin_location)) {
        $location = $plugin_location;
    }
    
    return $location;
}

/*
 * Loads a template part
 * A theme's templates take precedence over the plugin's templates.
 * If neither template can be found, nothing will load.
 */
function ppb_get_template_part($template_name) {
    $puzzle_settings = new PuzzleSettings;
    
    $theme_location = get_stylesheet_directory() . trailingslashit($puzzle_settings->templates_directory()) . $template_name . '.php';
    $plugin_location = plugin_dir_path(dirname(__FILE__)) . 'views/partials/' . $template_name . '.php';
    
    if (file_exists($theme_location)) {
        get_template_part($template_name);
    } elseif (file_exists($plugin_location)) {
        include($plugin_location);
    }
}

?>