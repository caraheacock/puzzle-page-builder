<?php
$open_link_in_new_tab = new PuzzleField;
$open_link_in_new_tab->set_name('Open Link in New Tab')
    ->set_id('open_link_in_new_tab')
    ->set_input_type('checkbox');

$puzzle_fields = new PuzzleFields;
$puzzle_fields->add_field($open_link_in_new_tab);
?>
