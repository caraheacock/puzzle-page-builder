<?php
if (!defined('ABSPATH')) exit;

$text_color_scheme = new PuzzleField(array(
    'name'          => __('Text Color Scheme', 'puzzle-page-builder'),
    'input_type'    => 'select',
    'options'       => array(
        'dark'  => __('Dark', 'puzzle-page-builder'),
        'light' => __('Light', 'puzzle-page-builder')
    )
));

$f->add_field($text_color_scheme);
?>
