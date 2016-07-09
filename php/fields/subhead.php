<?php
$subhead = new PuzzleField;
$subhead->set_name('Subhead')
    ->set_id('subhead')
    ->set_input_type('text')
    ->set_save_as('h4');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($subhead);
?>
