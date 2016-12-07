<?php
if (!defined('ABSPATH')) exit;

$icon = new PuzzleField;
$icon->set_name(__('Icon', 'puzzle-page-builder'))
    ->set_id('icon')
    ->set_input_type('icon');

$f->add_field($icon);
?>
