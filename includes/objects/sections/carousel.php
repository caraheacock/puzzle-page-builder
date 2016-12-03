<?php
$carousel = new PuzzleSection;
$carousel->set_name(__('Carousel', 'puzzle-page-builder'))
    ->set_single_name(__('Slide', 'puzzle-page-builder'))
    ->set_columns_num(-1)
    ->set_admin_column_width(4)
    ->set_order(0)
    ->set_column_fields(array(
        $f->field('background_image'),
        $f->field('background_color'),
        $f->field('overlay'),
        $f->field('align_text')
            ->set_name(__('Align Content', 'puzzle-page-builder'))
            ->set_id('align_content'),
        $f->field('headline'),
        $f->field('headline_color'),
        $f->field('tagline'),
        $f->field('headline_color')->set_name(__('Tagline Color', 'puzzle-page-builder'))
            ->set_id('tagline_color'),
        $f->field('text_color_scheme')->set_name(__('Content Color Scheme', 'puzzle-page-builder')),
        $f->field('content')
    ))
    ->set_option_fields(array(
        $f->field('id')->set_width(6),
        (new PuzzleField)->set_name(__('Carousel Speed', 'puzzle-page-builder'))
            ->set_id('speed')
            ->set_input_type('number')
            ->set_tip(__('Enter in milliseconds, or "false" if you do not want the slider to play automatically. Defaults to 10000 (10 seconds between each slide) if left blank.', 'puzzle-page-builder'))
            ->set_placeholder('10000')
            ->set_width(6),
        (new PuzzleField)->set_name(__('Hide Arrows', 'puzzle-page-builder'))
            ->set_id('hide_arrows')
            ->set_input_type('checkbox')
            ->set_width(6),
        (new PuzzleField)->set_name(__('Hide Pagination', 'puzzle-page-builder'))
            ->set_id('hide_pagination')
            ->set_input_type('checkbox')
            ->set_width(6)
    ));

$puzzle_sections->add_section($carousel);
?>
