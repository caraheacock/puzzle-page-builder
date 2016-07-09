<?php
$f = new PuzzleFields;

$features = new PuzzleSection;
$features->set_name('Features')
    ->set_single_name('Feature')
    ->set_multiple(true)
    ->set_admin_column_classes('xs-span12 sm-span4 md-span6 lg-span4')
    ->set_order(40)
    ->set_column_fields(array(
        $f->field('icon'),
        $f->field('subhead'),
        $f->field('content'),
        $f->field('button_text'),
        $f->field('button_link'),
        $f->field('open_link_in_new_tab'),
        (new PuzzleField)->set_name('Make icon into a link')
            ->set_id('icon_link')
            ->set_input_type('checkbox')
    ))
    ->set_section_fields(array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        $f->field('layout')->set_width(3),
        $f->field('padding_top')->set_width(3),
        $f->field('padding_bottom')->set_width(3),
        $f->field('text_color_scheme')->set_width(3),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay'),
        $f->field('main_content')
    ));

$puzzle_sections = new PuzzleSections;
$puzzle_sections->add_section($features);
?>
