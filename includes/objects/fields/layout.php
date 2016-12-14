<?php
if (!defined('ABSPATH')) exit;

$layout = new PuzzleField(array(
    'name'          => __('Layout', 'puzzle-page-builder'),
    'input_type'    => 'select',
    'options'       => array(
        'columns'   => __('Columns', 'puzzle-page-builder'),
        'rows'      => __('Rows', 'puzzle-page-builder')
    )
));

$f->add_field($layout);
?>
