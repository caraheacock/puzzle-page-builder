<?php
$align_text = new PuzzleField;
$align_text->set_name('Align Text')
    ->set_id('align_text')
    ->set_input_type('select')
    ->set_options(array(
        'center'    => 'Center',
        'left'      => 'Left',
        'right'     => 'Right'
    ));

$f->add_field($align_text);
?>
