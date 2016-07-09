<?php
$headline_background_color = new PuzzleField;
$headline_background_color->set_name('Headline BG Color')
    ->set_id('headline_background_color')
    ->set_input_type('select')
    ->set_options(array(
        'white'     => 'White',
        'black'     => 'Black',
        'primary'   => 'Primary Color',
        'secondary' => 'Secondary Color',
        'none'      => 'Transparent'
    ));

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($headline_background_color);
?>
