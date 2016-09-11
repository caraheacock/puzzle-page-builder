<?php
$text_color_scheme = new PuzzleField;
$text_color_scheme->set_name('Text Color Scheme')
    ->set_id('text_color_scheme')
    ->set_input_type('select')
    ->set_options(array(
        'dark'  => 'Dark',
        'light' => 'Light'
    ));

$f->add_field($text_color_scheme);
?>
