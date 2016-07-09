<?php
$headline = new PuzzleField;
$headline->set_name('Headline')
    ->set_id('headline')
    ->set_save_as('h2');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($headline);
?>
