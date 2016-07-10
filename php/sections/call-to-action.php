<?php
$f = new PuzzleFields;

$call_to_action = new PuzzleSection;
$call_to_action->set_name('Call to Action')
    ->set_single_name('Call to Action')
    ->set_columns_num(1)
    ->set_admin_column_classes('xs-span12')
    ->set_order(70)
    ->set_column_fields(array(
        $f->field('headline'),
        $f->field('content'),
        $f->field('button_text'),
        $f->field('button_link'),
        $f->field('open_link_in_new_tab')
    ))
    ->set_option_fields(array(
        $f->field('id'),
        $f->field('padding_top')->set_width(4),
        $f->field('padding_bottom')->set_width(4),
        $f->field('text_color_scheme')->set_width(4),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay')
    ));

$puzzle_sections = new PuzzleSections;
$puzzle_sections->add_section($call_to_action);
?>
