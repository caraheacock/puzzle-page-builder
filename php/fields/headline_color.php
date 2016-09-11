<?php
$headline_color = new PuzzleField;
$headline_color->set_name('Headline Color')
    ->set_id('headline_color')
    ->set_input_type('select')
    ->set_options(array(
        'default'   => 'Default Headline Color',
        'white'     => 'White',
        'black'     => 'Black',
        'primary'   => 'Primary Color',
        'secondary' => 'Secondary Color'
    ));

$f->add_field($headline_color);
?>
