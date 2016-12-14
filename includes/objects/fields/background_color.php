<?php
if (!defined('ABSPATH')) exit;

$background_color = new PuzzleField(array(
    'name'          => __('Background Color', 'puzzle-page-builder'),
    'input_type'    => 'select',
    'options'       => $puzzle_colors->theme_colors_for_dropdown(),
    'selected'      => 'white'
));

$f->add_field($background_color);
?>
