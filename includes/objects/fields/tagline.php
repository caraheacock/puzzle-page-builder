<?php
if (!defined('ABSPATH')) exit;

$tagline = new PuzzleField;
$tagline->set_name(__('Tagline', 'puzzle-page-builder'))
    ->set_id('tagline')
    ->set_save_as('h3');

$f->add_field($tagline);
?>
