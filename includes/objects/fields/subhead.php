<?php
if (!defined('ABSPATH')) exit;

$subhead = new PuzzleField(array(
    'name'          => __('Subhead', 'puzzle-page-builder'),
    'save_as'       => 'h4'
));

$f->add_field($subhead);
?>
