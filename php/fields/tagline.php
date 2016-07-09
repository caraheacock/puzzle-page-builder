<?php
$tagline = new PuzzleField;
$tagline->set_name('Tagline')
    ->set_id('tagline')
    ->set_save_as('h3');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($tagline);
?>
