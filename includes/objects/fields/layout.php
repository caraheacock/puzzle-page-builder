<?php
if (!defined('ABSPATH')) exit;

$layout = new PuzzleField;
$layout->set_name(__('Layout', 'puzzle-page-builder'))
    ->set_id('layout')
    ->set_input_type('select')
    ->set_options(array(
        'columns'   => __('Columns', 'puzzle-page-builder'),
        'rows'      => __('Rows', 'puzzle-page-builder')
    ));

$f->add_field($layout);
?>
