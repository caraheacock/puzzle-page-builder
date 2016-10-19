<?php
$button_style = new PuzzleField;
$button_style->set_name('Button Style')
    ->set_id('button_style')
    ->set_input_type('select')
    ->set_options(array(
        'solid'         => 'Solid',
        'outline'       => 'Border only'
    ));

$f->add_field($button_style);
?>
