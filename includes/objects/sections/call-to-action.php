<?php
$call_to_action = new PuzzleSection;
$call_to_action->set_name(__('Call to Action', 'puzzle-page-builder'))
    ->set_single_name(__('Call to Action', 'puzzle-page-builder'))
    ->set_columns_num(1)
    ->set_order(70)
    ->set_column_fields(array(
        $f->field('headline'),
        $f->field('content'),
        $f->field('button_text'),
        $f->field('button_link'),
        $f->field('open_link_in_new_tab'),
        $f->field('button_color')->set_width(6),
        $f->field('button_style')->set_width(6)
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

$puzzle_sections->add_section($call_to_action);
?>
