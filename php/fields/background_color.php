<?php
$background_color = new PuzzleField;
$background_color->set_name('Background Color')
    ->set_id('background_color')
    ->set_input_type('select')
    ->set_options(array(
        'white'     => 'White',
        'gray'      => 'Gray',
        'primary'   => 'Primary Color',
        'secondary' => 'Secondary Color'
    ));

$f->add_field($background_color);
?>
