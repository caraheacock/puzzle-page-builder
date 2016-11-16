<?php
$image = new PuzzleField;
$image->set_name(__('Image', 'puzzle-page-builder'))
    ->set_id('image')
    ->set_input_type('image');

$f->add_field($image);
?>
