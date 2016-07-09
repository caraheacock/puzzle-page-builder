<?php
$main_content = new PuzzleField;
$main_content->set_name('Main Content')
    ->set_id('main_content')
    ->set_input_type('textarea')
    ->set_rows(10)
    ->set_save_as('content');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($main_content);
?>
