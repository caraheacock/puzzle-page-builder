<?php
if (!defined('ABSPATH')) exit;

$padding_bottom = new PuzzleField;
$padding_bottom->set_name(__('Bottom Padding', 'puzzle-page-builder'))
    ->set_id('padding_bottom')
    ->set_input_type('select')
    ->set_options(array(
        'large'     => __('Large', 'puzzle-page-builder'),
        'normal'    => __('Normal', 'puzzle-page-builder'),
        'no'        => __('None', 'puzzle-page-builder')
    ))
    ->set_selected('normal');

$f->add_field($padding_bottom);
?>
