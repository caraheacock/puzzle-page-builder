<?php
if (!defined('ABSPATH')) exit;

$accordions = new PuzzleSection(array(
    'name'          => __('Accordions', 'puzzle-page-builder'),
    'single_name'   => __('Accordion', 'puzzle-page-builder'),
    'columns_num'   => -1,
    'order'         => 60,
    'column_fields' => array(
        $f->field('subhead'),
        $f->field('content')
    ),
    'option_fields' => array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        $f->field('padding_top')->set_width(4),
        $f->field('padding_bottom')->set_width(4),
        $f->field('text_color_scheme')->set_width(4),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay'),
        new PuzzleField(array(
            'name'          => __('Only have one accordion open at a time', 'puzzle-page-builder'),
            'id'            => 'open_one_at_a_time',
            'input_type'    => 'checkbox',
        )),
        $f->field('main_content')
    )
));

$puzzle_sections->add_section($accordions);
?>
