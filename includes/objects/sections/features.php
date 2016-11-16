<?php
$features = new PuzzleSection;
$features->set_name(__('Features', 'puzzle-page-builder'))
    ->set_single_name(__('Feature', 'puzzle-page-builder'))
    ->set_columns_num(-1)
    ->set_admin_column_width(4)
    ->set_order(40)
    ->set_column_fields(array(
        $f->field('icon'),
        $f->field('subhead'),
        $f->field('content'),
        $f->field('button_text'),
        $f->field('button_link'),
        $f->field('open_link_in_new_tab'),
        (new PuzzleField)->set_name(__('Make icon into a link', 'puzzle-page-builder'))
            ->set_id('icon_link')
            ->set_input_type('checkbox')
    ))
    ->set_option_fields(array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        $f->field('layout')->set_width(3),
        $f->field('padding_top')->set_width(3),
        $f->field('padding_bottom')->set_width(3),
        $f->field('text_color_scheme')->set_width(3),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay'),
        (new PuzzleField)->set_name(__('Icon Color', 'puzzle-page-builder'))
            ->set_id('icon_color')
            ->set_input_type('select')
            ->set_options(array_merge(
                $puzzle_colors->theme_colors_for_dropdown(),
                array(
                    'text-color'        => 'Text Color',
                    'headline-color'    => 'Headline Color'
                )
            ))
            ->set_width(4),
        $f->field('button_color')->set_width(4),
        $f->field('button_style')->set_width(4),
        $f->field('main_content')
    ));

$puzzle_sections->add_section($features);
?>
