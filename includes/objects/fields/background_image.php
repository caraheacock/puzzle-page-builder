<?php
if (!defined('ABSPATH')) exit;

$background_image = new PuzzleField(array(
    'name'          => __('Background Image', 'puzzle-page-builder'),
    'input_type'    => 'image'
));

$f->add_field($background_image);
?>
