<?php
if (!defined('ABSPATH')) exit;

$open_link_in_new_tab = new PuzzleField(array(
    'name'          => __('Open link in new tab', 'puzzle-page-builder'),
    'input_type'    => 'checkbox'
));

$f->add_field($open_link_in_new_tab);
?>
