<?php
if (!defined('ABSPATH')) exit;

$background_image = new PuzzleField;
$background_image->set_name(__('Background Image', 'puzzle-page-builder'))
    ->set_id('background_image')
    ->set_input_type('image');

$f->add_field($background_image);
?>
