<?php
$icon = new PuzzleField;
$icon->set_name('Icon')
    ->set_id('icon')
    ->set_input_type('icon');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($icon);
?>
