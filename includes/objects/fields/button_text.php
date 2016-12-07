<?php
if (!defined('ABSPATH')) exit;

$button_text = new PuzzleField;
$button_text->set_name(__('Button Text', 'puzzle-page-builder'))
    ->set_id('button_text');

$f->add_field($button_text);
?>
