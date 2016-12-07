<?php
if (!defined('ABSPATH')) exit;

$align_text = new PuzzleField;
$align_text->set_name(__('Align Text', 'puzzle-page-builder'))
    ->set_id('align_text')
    ->set_input_type('select')
    ->set_options(array(
        'center'    => __('Center', 'puzzle-page-builder'),
        'left'      => __('Left', 'puzzle-page-builder'),
        'right'     => __('Right', 'puzzle-page-builder')
    ));

$f->add_field($align_text);
?>
