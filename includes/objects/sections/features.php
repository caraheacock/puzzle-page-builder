<?php
if (!defined('ABSPATH')) exit;

$features = new PuzzleSection(array(
    'name'                  => __('Features', 'puzzle-page-builder'),
    'single_name'           => __('Feature', 'puzzle-page-builder'),
    'columns_num'           => -1,
    'admin_column_width'    => 4,
    'order'                 => 40,
    'column_fields'         => array(
        $f->field('icon'),
        $f->field('subhead'),
        $f->field('content'),
        $f->field('button_text'),
        $f->field('button_link'),
        $f->field('open_link_in_new_tab'),
        new PuzzleField(array(
            'name'          => __('Make icon into a link', 'puzzle-page-builder'),
            'id'            => 'icon_link',
            'input_type'    =>'checkbox'
        ))
    ),
    'option_fields'         => array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        $f->field('layout')->set_width(3),
        $f->field('padding_top')->set_width(3),
        $f->field('padding_bottom')->set_width(3),
        $f->field('text_color_scheme')->set_width(3),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay'),
        new PuzzleField(array(
            'name'          => __('Icon Color', 'puzzle-page-builder'),
            'id'            => 'icon_color',
            'input_type'    => 'select',
            'options'       => array_merge(
                $puzzle_colors->theme_colors_for_dropdown(),
                array(
                    'text-color'        => 'Text Color',
                    'headline-color'    => 'Headline Color'
                )
            ),
            'width'         => 4
        )),
        $f->field('button_color')->set_width(4),
        $f->field('button_style')->set_width(4),
        $f->field('main_content')
    )
));

$puzzle_sections->add_section($features);
?>
