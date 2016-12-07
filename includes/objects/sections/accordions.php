<?php
if (!defined('ABSPATH')) exit;

$accordions = new PuzzleSection;
$accordions->set_name(__('Accordions', 'puzzle-page-builder'))
    ->set_single_name(__('Accordion', 'puzzle-page-builder'))
    ->set_columns_num(-1)
    ->set_order(60)
    ->set_column_fields(array(
        $f->field('subhead'),
        $f->field('content')
    ))
    ->set_option_fields(array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        $f->field('padding_top')->set_width(4),
        $f->field('padding_bottom')->set_width(4),
        $f->field('text_color_scheme')->set_width(4),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay'),
        (new PuzzleField)->set_name(__('Only have one accordion open at a time', 'puzzle-page-builder'))
            ->set_id('open_one_at_a_time')
            ->set_input_type('checkbox'),
        $f->field('main_content')
    ));

$puzzle_sections->add_section($accordions);
?>
