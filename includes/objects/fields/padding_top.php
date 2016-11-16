<?php
$padding_top = new PuzzleField;
$padding_top->set_name(__('Top Padding', 'puzzle-page-builder'))
    ->set_id('padding_top')
    ->set_input_type('select')
    ->set_options(array(
        'large'     => __('Large', 'puzzle-page-builder'),
        'normal'    => __('Normal', 'puzzle-page-builder'),
        'no'        => __('None', 'puzzle-page-builder')
    ))
    ->set_selected('normal');

$f->add_field($padding_top);
?>
