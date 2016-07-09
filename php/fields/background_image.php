<?php
$background_image = new PuzzleField;
$background_image->set_name('Background Image')
    ->set_id('background_image')
    ->set_input_type('image');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($background_image);
?>
