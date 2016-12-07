<?php
if (!defined('ABSPATH')) exit;

$subhead = new PuzzleField;
$subhead->set_name(__('Subhead', 'puzzle-page-builder'))
    ->set_id('subhead')
    ->set_input_type('text')
    ->set_save_as('h4');

$f->add_field($subhead);
?>
