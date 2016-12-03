<?php
$content = new PuzzleField;
$content->set_name(__('Content', 'puzzle-page-builder'))
    ->set_id('content')
    ->set_input_type('editor')
    ->set_rows(5)
    ->set_save_as('content');

$f->add_field($content);
?>
