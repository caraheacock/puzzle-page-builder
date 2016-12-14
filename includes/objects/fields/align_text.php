<?php
if (!defined('ABSPATH')) exit;

$align_text = new PuzzleField(array(
    'name'          => 'Align Text',
    'input_type'    => 'select',
    'options'       => array(
        'center'    => __('Center', 'puzzle-page-builder'),
        'left'      => __('Left', 'puzzle-page-builder'),
        'right'     => __('Right', 'puzzle-page-builder')
    )
));

$f->add_field($align_text);
?>
