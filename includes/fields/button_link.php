<?php
$button_link = new PuzzleField;
$button_link->set_name('Button Link')
    ->set_id('button_link')
    ->set_placeholder('http://')
    ->set_save_as('link')
    ->set_save_as_link_text('button_text');

$f->add_field($button_link);
?>
