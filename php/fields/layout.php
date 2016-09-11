<?php
$layout = new PuzzleField;
$layout->set_name('Layout')
    ->set_id('layout')
    ->set_input_type('select')
    ->set_options(array(
        'columns'   => 'Columns',
        'rows'      => 'Rows'
    ));

$f->add_field($layout);
?>
