<?php
$button_text = new PuzzleField;
$button_text->set_name('Button Text')
    ->set_id('button_text');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($button_text);
?>
