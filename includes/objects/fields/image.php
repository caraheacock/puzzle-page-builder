<?php
if (!defined('ABSPATH')) exit;

$image = new PuzzleField(array(
    'name'          => __('Image', 'puzzle-page-builder'),
    'input_type'    => 'image'
));

$f->add_field($image);
?>
