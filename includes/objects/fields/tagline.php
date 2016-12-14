<?php
if (!defined('ABSPATH')) exit;

$tagline = new PuzzleField(array(
    'name'      => __('Tagline', 'puzzle-page-builder'),
    'save_as'   => 'h3'
));

$f->add_field($tagline);
?>
