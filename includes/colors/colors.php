<?php
$primary = new PuzzleColor;
$primary->set_name('Primary Color')
    ->set_id('primary')
    ->set_color('#3b54a5')
    ->set_text_color_scheme('light');

$secondary = new PuzzleColor;
$secondary->set_name('Secondary Color')
    ->set_id('secondary')
    ->set_color('#2cb799')
    ->set_text_color_scheme('light');

$white = new PuzzleColor;
$white->set_name('White')
    ->set_id('white')
    ->set_color('#fff')
    ->set_text_color_scheme('dark');

$light_gray = new PuzzleColor;
$light_gray->set_name('Light Gray')
    ->set_id('light-gray')
    ->set_color('#eee')
    ->set_text_color_scheme('dark');

$medium_gray = new PuzzleColor;
$medium_gray->set_name('Medium Gray')
    ->set_id('medium-gray')
    ->set_color('#aaa')
    ->set_text_color_scheme('light');

$dark_gray = new PuzzleColor;
$dark_gray->set_name('Dark Gray')
    ->set_id('dark-gray')
    ->set_color('#444')
    ->set_text_color_scheme('light');

$black = new PuzzleColor;
$black->set_name('Black')
    ->set_id('black')
    ->set_color('#000')
    ->set_text_color_scheme('light');

$puzzle_colors->add_theme_colors(array(
    $primary, $secondary, $white, $light_gray, $medium_gray, $dark_gray, $black
));

?>
