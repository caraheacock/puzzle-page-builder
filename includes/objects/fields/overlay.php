<?php
if (!defined('ABSPATH')) exit;

$overlay = new PuzzleField;
$overlay->set_name(__('Overlay background color on background image', 'puzzle-page-builder'))
    ->set_id('overlay')
    ->set_input_type('checkbox');

$f->add_field($overlay);
?>
