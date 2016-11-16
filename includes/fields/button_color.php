<?php
$button_color = new PuzzleField;
$button_color->set_name(__('Button Color', 'puzzle-page-builder'))
    ->set_id('button_color')
    ->set_input_type('select')
    ->set_options($puzzle_colors->theme_colors_for_dropdown());

$f->add_field($button_color);
?>
