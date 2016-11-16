<?php
$button_style = new PuzzleField;
$button_style->set_name(__('Button Style', 'puzzle-page-builder'))
    ->set_id('button_style')
    ->set_input_type('select')
    ->set_options(array(
        'solid'         => __('Solid', 'puzzle-page-builder'),
        'outline'       => __('Border only', 'puzzle-page-builder')
    ));

$f->add_field($button_style);
?>
