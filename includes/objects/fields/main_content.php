<?php
if (!defined('ABSPATH')) exit;

$main_content = new PuzzleField(array(
    'name'          => __('Main Content', 'puzzle-page-builder'),
    'input_type'    => 'editor',
    'rows'          => 10,
    'save_as'       => 'content'
));

$f->add_field($main_content);
?>
