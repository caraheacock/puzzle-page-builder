<?php
$f = new PuzzleFields;

$one_column = new PuzzleSection;
$one_column->set_name('One Column')
    ->set_single_name('Column')
    ->set_columns_num(1)
    ->set_order(10)
    ->set_column_fields(array(
        $f->field('content')->set_rows(10)
    ))
    ->set_option_fields(array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        $f->field('padding_top')->set_width(4),
        $f->field('padding_bottom')->set_width(4),
        $f->field('text_color_scheme')->set_width(4),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay')
    ));

$puzzle_sections = new PuzzleSections;
$puzzle_sections->add_section($one_column);
?>
