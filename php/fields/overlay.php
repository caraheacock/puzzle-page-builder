<?php
$overlay = new PuzzleField;
$overlay->set_name('Overlay background color on background image')
    ->set_id('overlay')
    ->set_input_type('checkbox');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($overlay);
?>
