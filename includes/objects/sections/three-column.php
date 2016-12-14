<?php
if (!defined('ABSPATH')) exit;

$three_column = new PuzzleSection(array(
    'name'                  => __('Three Column', 'puzzle-page-builder'),
    'single_name'           => __('Column', 'puzzle-page-builder'),
    'columns_num'           => 3,
    'admin_column_width'    => 4,
    'order'                 => 30,
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
                '1-3_1-3_1-3'   => '1/3 1/3 1/3',
                '1-4_1-2_1-4'   => '1/4 1/2 1/4',
                '1-2_1-4_1-4'   => '1/2 1/4 1/4',
                '1-4_1-4_1-2'   => '1/4 1/4 1/2'
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

$puzzle_sections->add_section($three_column);
?>
