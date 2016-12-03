<?php
$main_content = new PuzzleField;
$main_content->set_name(__('Main Content', 'puzzle-page-builder'))
    ->set_id('main_content')
    ->set_input_type('editor')
    ->set_rows(10)
    ->set_save_as('content');

$f->add_field($main_content);
?>
