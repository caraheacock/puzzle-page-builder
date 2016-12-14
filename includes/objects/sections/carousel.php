<?php
if (!defined('ABSPATH')) exit;

$carousel = new PuzzleSection(array(
    'name'                  => __('Carousel', 'puzzle-page-builder'),
    'single_name'           => __('Slide', 'puzzle-page-builder'),
    'columns_num'           => -1,
    'admin_column_width'    => 4,
    'order'                 => 0,
    'column_fields'         => array(
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
    ),
    'option_fields'         => array(
        $f->field('id')->set_width(6),
        new PuzzleField(array(
            'name'          => __('Carousel Speed', 'puzzle-page-builder'),
            'id'            => 'speed',
            'input_type'    => 'number',
            'tip'           => __('Enter in milliseconds, or 0 (zero) if you do not want the slider to play automatically. Defaults to 10000 (10 seconds between each slide) if left blank.', 'puzzle-page-builder'),
            'placeholder'   => '10000',
            'width'         => 6
        )),
        new PuzzleField(array(
            'name'          => __('Hide Arrows', 'puzzle-page-builder'),
            'id'            => 'hide_arrows',
            'input_type'    => 'checkbox',
            'width'         => 6
        )),
        new PuzzleField(array(
            'name'          => __('Hide Pagination', 'puzzle-page-builder'),
            'id'            => 'hide_pagination',
            'input_type'    => 'checkbox',
            'width'         => 6
        ))
    )
));

$puzzle_sections->add_section($carousel);
?>
