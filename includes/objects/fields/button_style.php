<?php
if (!defined('ABSPATH')) exit;

$button_style = new PuzzleField(array(
    'name'          => __('Button Style', 'puzzle-page-builder'),
    'input_type'    => 'select',
    'options'       => array(
        'solid'         => __('Solid', 'puzzle-page-builder'),
        'outline'       => __('Border only', 'puzzle-page-builder')
    )
));

$f->add_field($button_style);
?>
