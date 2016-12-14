<?php
if (!defined('ABSPATH')) exit;

$headline = new PuzzleField(array(
    'name'      => __('Headline', 'puzzle-page-builder'),
    'save_as'   => 'h2'
));

$f->add_field($headline);
?>
