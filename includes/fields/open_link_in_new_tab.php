<?php
$open_link_in_new_tab = new PuzzleField;
$open_link_in_new_tab->set_name(__('Open link in new tab', 'puzzle-page-builder'))
    ->set_id('open_link_in_new_tab')
    ->set_input_type('checkbox');

$f->add_field($open_link_in_new_tab);
?>
