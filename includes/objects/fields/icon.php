<?php
if (!defined('ABSPATH')) exit;

$icon = new PuzzleField(array(
    'name'          => __('Icon', 'puzzle-page-builder'),
    'input_type'    => 'icon'
));

$f->add_field($icon);
?>
