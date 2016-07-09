<?php
$content = new PuzzleField;
$content->set_name('Content')
    ->set_id('content')
    ->set_input_type('textarea')
    ->set_rows(5)
    ->set_save_as('content');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($content);
?>
