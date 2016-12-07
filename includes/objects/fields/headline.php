<?php
if (!defined('ABSPATH')) exit;

$headline = new PuzzleField;
$headline->set_name(__('Headline', 'puzzle-page-builder'))
    ->set_id('headline')
    ->set_save_as('h2');

$f->add_field($headline);
?>
