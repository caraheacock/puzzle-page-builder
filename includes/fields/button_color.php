<?php
$button_color = new PuzzleField;
$button_color->set_name('Button Color')
    ->set_id('button_color')
    ->set_input_type('select')
    ->set_options(array(
        'primary'       => 'Primary Color',
        'secondary'     => 'Secondary Color',
        'white'         => 'White',
        'light-gray'    => 'Light Gray',
        'medium-gray'   => 'Medium Gray',
        'dark-gray'     => 'Dark Gray',
        'black'         => 'Black'
    ));

$f->add_field($button_color);
?>
