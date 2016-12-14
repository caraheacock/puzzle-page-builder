<?php
if (!defined('ABSPATH')) exit;

$overlay = new PuzzleField(array(
    'name'          => __('Overlay background color on background image', 'puzzle-page-builder'),
    'id'            => 'overlay',
    'input_type'    => 'checkbox'
));

$f->add_field($overlay);
?>
