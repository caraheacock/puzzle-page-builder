<?php
if (!defined('ABSPATH')) exit;

$button_link = new PuzzleField(array(
    'name'              => __('Button Link', 'puzzle-page-builder'),
    'placeholder'       => 'http://',
    'save_as'           => 'link',
    'save_as_link_text' => 'button_text'
));

$f->add_field($button_link);
?>
