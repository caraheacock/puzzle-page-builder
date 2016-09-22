<?php
$content = new PuzzleField;
$content->set_name('Content')
    ->set_id('content')
    ->set_input_type('textarea')
    ->set_rows(5)
    ->set_save_as('content');

$f->add_field($content);
?>
