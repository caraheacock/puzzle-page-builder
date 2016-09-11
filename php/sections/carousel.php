<?php
$f = new PuzzleFields;

$carousel = new PuzzleSection;
$carousel->set_name('Carousel')
    ->set_single_name('Slide')
    ->set_columns_num(-1)
    ->set_admin_column_width(4)
    ->set_order(0)
    ->set_column_fields(array(
        $f->field('background_image'),
        $f->field('background_color'),
        $f->field('overlay'),
        $f->field('align_text'),
        $f->field('headline'),
        $f->field('headline_color')->set_width(6),
        $f->field('headline_background_color')->set_width(6),
        $f->field('tagline'),
        $f->field('headline_color')->set_name('Tagline Color')
            ->set_id('tagline_color')
            ->set_width(6),
        $f->field('headline_background_color')->set_name('Tagline BG Color')
            ->set_id('tagline_background_color')
            ->set_width(6),
        $f->field('content')
    ))
    ->set_option_fields(array(
        $f->field('id')->set_width(6),
        (new PuzzleField)->set_name('Carousel Speed')
            ->set_id('speed')
            ->set_tip('Enter in milliseconds, or "false" if you do not want the slider to play automatically. Defaults to 10000 (10 seconds between each slide) if left blank.')
            ->set_placeholder('10000')
            ->set_width(6),
        (new PuzzleField)->set_name('Hide Arrows')
            ->set_id('hide_arrows')
            ->set_input_type('checkbox')
            ->set_width(6),
        (new PuzzleField)->set_name('Hide Pagination')
            ->set_id('hide_pagination')
            ->set_input_type('checkbox')
            ->set_width(6)
    ));

$puzzle_sections->add_section($carousel);
?>
