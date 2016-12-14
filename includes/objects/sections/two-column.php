<?php
if (!defined('ABSPATH')) exit;

$two_column = new PuzzleSection(array(
    'name'                  => __('Two Column', 'puzzle-page-builder'),
    'single_name'           => __('Column', 'puzzle-page-builder'),
    'columns_num'           => 2,
    'admin_column_width'    => 6,
    'order'                 => 20,
    'column_fields'         => array(
        $f->field('content')->set_rows(10)
    ),
    'option_fields'         => array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        new PuzzleField(array(
            'name'          => __('Column Widths', 'puzzle-page-builder'),
            'id'            => 'column_widths',
            'input_type'    => 'select',
            'options'       => array(
                '1-2_1-2'   => '1/2 1/2',
                '1-3_2-3'   => '1/3 2/3',
                '2-3_1-3'   => '2/3 1/3'
            ),
            'width'         => 3
        )),
        $f->field('padding_top')->set_width(3),
        $f->field('padding_bottom')->set_width(3),
        $f->field('text_color_scheme')->set_width(3),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay')
    )
));

$puzzle_sections->add_section($two_column);
?>
