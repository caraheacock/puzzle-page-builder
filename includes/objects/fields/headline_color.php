<?php
$options = array_merge(
    array('default'   => 'Default Headline Color'),
    $puzzle_colors->theme_colors_for_dropdown()
);

$headline_color = new PuzzleField;
$headline_color->set_name(__('Headline Color', 'puzzle-page-builder'))
    ->set_id('headline_color')
    ->set_input_type('select')
    ->set_options($options);

$f->add_field($headline_color);
?>
