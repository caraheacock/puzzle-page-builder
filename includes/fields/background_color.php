<?php
$background_color = new PuzzleField;
$background_color->set_name('Background Color')
    ->set_id('background_color')
    ->set_input_type('select')
    ->set_options($puzzle_colors->theme_colors_for_dropdown())
    ->set_selected('white');

$f->add_field($background_color);
?>
