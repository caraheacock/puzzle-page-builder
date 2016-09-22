<?php
$padding_bottom = new PuzzleField;
$padding_bottom->set_name('Bottom Padding')
    ->set_id('padding_bottom')
    ->set_input_type('select')
    ->set_options(array(
        'large'     => 'Large',
        'normal'    => 'Normal',
        'no'        => 'None'
    ))
    ->set_selected('normal');

$f->add_field($padding_bottom);
?>
