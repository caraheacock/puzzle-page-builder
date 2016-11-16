<?php
$primary = new PuzzleColor;
$primary->set_name(__('Primary Color', 'puzzle-page-builder'))
    ->set_id('primary')
    ->set_color('#3b54a5')
    ->set_text_color_scheme('light');

$secondary = new PuzzleColor;
$secondary->set_name(__('Secondary Color', 'puzzle-page-builder'))
    ->set_id('secondary')
    ->set_color('#2cb799')
    ->set_text_color_scheme('light');

$white = new PuzzleColor;
$white->set_name(__('White', 'puzzle-page-builder'))
    ->set_id('white')
    ->set_color('#fff')
    ->set_text_color_scheme('dark');

$light_gray = new PuzzleColor;
$light_gray->set_name(__('Light Gray', 'puzzle-page-builder'))
    ->set_id('light-gray')
    ->set_color('#eee')
    ->set_text_color_scheme('dark');

$medium_gray = new PuzzleColor;
$medium_gray->set_name(__('Medium Gray', 'puzzle-page-builder'))
    ->set_id('medium-gray')
    ->set_color('#aaa')
    ->set_text_color_scheme('light');

$dark_gray = new PuzzleColor;
$dark_gray->set_name(__('Dark Gray', 'puzzle-page-builder'))
    ->set_id('dark-gray')
    ->set_color('#444')
    ->set_text_color_scheme('light');

$black = new PuzzleColor;
$black->set_name(__('Black', 'puzzle-page-builder'))
    ->set_id('black')
    ->set_color('#000')
    ->set_text_color_scheme('light');

$puzzle_colors->add_theme_colors(array(
    $primary, $secondary, $white, $light_gray, $medium_gray, $dark_gray, $black
));

?>
