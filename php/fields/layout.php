<?php
$layout = new PuzzleField;
$layout->set_name('Layout')
    ->set_id('layout')
    ->set_input_type('select')
    ->set_options(array(
        'columns'   => 'Columns',
        'rows'      => 'Rows'
    ));

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($layout);
?>
