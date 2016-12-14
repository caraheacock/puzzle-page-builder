<?php
if (!defined('ABSPATH')) exit;

$padding_top = new PuzzleField(array(
    'name'          => __('Top Padding', 'puzzle-page-builder'),
    'id'            => 'padding_top',
    'input_type'    => 'select',
    'options'       => array(
        'large'     => __('Large', 'puzzle-page-builder'),
        'normal'    => __('Normal', 'puzzle-page-builder'),
        'no'        => __('None', 'puzzle-page-builder')
    ),
    'selected'      => 'normal'
));

$f->add_field($padding_top);
?>
