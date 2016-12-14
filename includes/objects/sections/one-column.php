<?php
if (!defined('ABSPATH')) exit;

$one_column = new PuzzleSection(array(
    'name'          => __('One Column', 'puzzle-page-builder'),
    'single_name'   => __('Column', 'puzzle-page-builder'),
    'columns_num'   => 1,
    'order'         => 10,
    'column_fields' => array(
        $f->field('content')->set_rows(10)
    ),
    'option_fields' => array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        $f->field('padding_top')->set_width(4),
        $f->field('padding_bottom')->set_width(4),
        $f->field('text_color_scheme')->set_width(4),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay')
    )
));

$puzzle_sections->add_section($one_column);
?>
