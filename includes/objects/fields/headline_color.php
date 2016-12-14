<?php
if (!defined('ABSPATH')) exit;

$options = array_merge(
    array('default' => 'Default Headline Color'),
    $puzzle_colors->theme_colors_for_dropdown()
);

$headline_color = new PuzzleField(array(
    'name'          => __('Headline Color', 'puzzle-page-builder'),
    'input_type'    => 'select',
    'options'       => $options
));

$f->add_field($headline_color);
?>
