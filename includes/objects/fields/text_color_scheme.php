<?php
if (!defined('ABSPATH')) exit;

$text_color_scheme = new PuzzleField;
$text_color_scheme->set_name(__('Text Color Scheme', 'puzzle-page-builder'))
    ->set_id('text_color_scheme')
    ->set_input_type('select')
    ->set_options(array(
        'dark'  => __('Dark', 'puzzle-page-builder'),
        'light' => __('Light', 'puzzle-page-builder')
    ));

$f->add_field($text_color_scheme);
?>
