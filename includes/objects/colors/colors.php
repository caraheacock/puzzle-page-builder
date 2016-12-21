<?php
if (!defined('ABSPATH')) exit;

$primary = new PuzzleColor(array(
    'name'              => __('Primary Color', 'puzzle-page-builder'),
    'id'                => 'primary',
    'color'             => '#3b54a5',
    'text_color_scheme' => 'light',
    'order'             => 0
));

$secondary = new PuzzleColor(array(
    'name'              => __('Secondary Color', 'puzzle-page-builder'),
    'id'                => 'secondary',
    'color'             => '#2cb799',
    'text_color_scheme' => 'light',
    'order'             => 10
));

$white = new PuzzleColor(array(
    'name'              => __('White', 'puzzle-page-builder'),
    'id'                => 'white',
    'color'             => '#fff',
    'text_color_scheme' => 'dark',
    'order'             => 20
));

$light_gray = new PuzzleColor(array(
    'name'              => __('Light Gray', 'puzzle-page-builder'),
    'id'                => 'light-gray',
    'color'             => '#eee',
    'text_color_scheme' => 'dark',
    'order'             => 30
));

$medium_gray = new PuzzleColor(array(
    'name'              => __('Medium Gray', 'puzzle-page-builder'),
    'id'                => 'medium-gray',
    'color'             => '#aaa',
    'text_color_scheme' => 'light',
    'order'             => 40
));

$dark_gray = new PuzzleColor(array(
    'name'              => __('Dark Gray', 'puzzle-page-builder'),
    'id'                => 'dark-gray',
    'color'             => '#444',
    'text_color_scheme' => 'light',
    'order'             => 50
));

$black = new PuzzleColor(array(
    'name'              => __('Black', 'puzzle-page-builder'),
    'id'                => 'black',
    'color'             => '#000',
    'text_color_scheme' => 'light',
    'order'             => 60
));

$puzzle_colors->add_theme_colors(array(
    $primary, $secondary, $white, $light_gray, $medium_gray, $dark_gray, $black
));

?>
