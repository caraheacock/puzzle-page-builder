<?php
if (!defined('ABSPATH')) exit;

$content = new PuzzleField(array(
    'name'          => __('Content', 'puzzle-page-builder'),
    'input_type'    => 'editor',
    'rows'          => 5,
    'save_as'       => 'content'
));

$f->add_field($content);
?>
