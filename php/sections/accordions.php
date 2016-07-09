<?php
$f = new PuzzleFields;

$accordions = new PuzzleSection;
$accordions->set_name('Accordions')
    ->set_single_name('Accordion')
    ->set_multiple(true)
    ->set_admin_column_classes('xs-span12')
    ->set_order(60)
    ->set_column_fields(array(
        $f->field('subhead'),
        $f->field('content')
    ))
    ->set_section_fields(array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        $f->field('padding_top')->set_width(4),
        $f->field('padding_bottom')->set_width(4),
        $f->field('text_color_scheme')->set_width(4),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay'),
        (new PuzzleField)->set_name('Only have one accordion open at a time')
            ->set_id('open_one_at_a_time')
            ->set_input_type('checkbox'),
        $f->field('main_content')
    ));

$puzzle_sections = new PuzzleSections;
$puzzle_sections->add_section($accordions);
?>
