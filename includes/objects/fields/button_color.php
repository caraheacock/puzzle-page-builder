<?php
if (!defined('ABSPATH')) exit;

$button_color = new PuzzleField(array(
    'name'          => __('Button Color', 'puzzle-page-builder'),
    'input_type'    => 'select',
    'options'       => $puzzle_colors->theme_colors_for_dropdown()
));

$f->add_field($button_color);
?>
