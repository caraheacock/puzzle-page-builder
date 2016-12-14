<?php
if (!defined('ABSPATH')) exit;

$button_text = new PuzzleField(array(
    'name'  => __('Button Text', 'puzzle-page-builder')
));

$f->add_field($button_text);
?>
