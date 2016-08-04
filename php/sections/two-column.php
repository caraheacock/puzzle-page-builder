<?php
$f = new PuzzleFields;

$two_column = new PuzzleSection;
$two_column->set_name('Two Column')
    ->set_single_name('Column')
    ->set_columns_num(2)
    ->set_admin_column_width(6)
    ->set_order(20)
    ->set_column_fields(array(
        $f->field('content')->set_rows(10)
    ))
    ->set_option_fields(array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        (new PuzzleField)->set_name('Column Widths')
            ->set_id('column_widths')
            ->set_input_type('select')
            ->set_options(array(
                '1-2_1-2'   => '1/2 1/2',
                '1-3_2-3'   => '1/3 2/3',
                '2-3_1-3'   => '2/3 1/3'
            ))
            ->set_width(3),
        $f->field('padding_top')->set_width(3),
        $f->field('padding_bottom')->set_width(3),
        $f->field('text_color_scheme')->set_width(3),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay')
    ));

$puzzle_sections = new PuzzleSections;
$puzzle_sections->add_section($two_column);
?>
