<?php
$padding_top = new PuzzleField;
$padding_top->set_name('Top Padding')
    ->set_id('padding_top')
    ->set_input_type('select')
    ->set_options(array(
        'large'     => 'Large',
        'normal'    => 'Normal',
        'no'        => 'None'
    ))
    ->set_selected('normal');

$f->add_field($padding_top);
?>
