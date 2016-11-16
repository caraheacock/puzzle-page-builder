<?php
$team_members = new PuzzleSection;
$team_members->set_name(__('Team Members', 'puzzle-page-builder'))
    ->set_single_name(__('Team Member', 'puzzle-page-builder'))
    ->set_columns_num(-1)
    ->set_admin_column_width(4)
    ->set_order(50)
    ->set_column_fields(array(
        $f->field('subhead')
            ->set_name(__('Name', 'puzzle-page-builder'))
            ->set_id('name'),
        (new PuzzleField)->set_name(__('Title', 'puzzle-page-builder'))
            ->set_id('title')
            ->set_input_type('text')
            ->set_save_as('h5'),
        $f->field('image'),
        $f->field('content'),
        (new PuzzleField)->set_name(__('Phone', 'puzzle-page-builder'))
            ->set_id('phone')
            ->set_input_type('text')
            ->set_save_as('content'),
        (new PuzzleField)->set_name(__('Email Address', 'puzzle-page-builder'))
            ->set_id('email')
            ->set_input_type('text')
            ->set_placeholder('person@example.com')
            ->set_save_as('content'),
        (new PuzzleField)->set_name(__('Facebook Link', 'puzzle-page-builder'))
            ->set_id('facebook')
            ->set_input_type('text')
            ->set_placeholder('https://www.facebook.com/johndoe')
            ->set_save_as('link'),
        (new PuzzleField)->set_name(__('Twitter Link', 'puzzle-page-builder'))
            ->set_id('twitter')
            ->set_input_type('text')
            ->set_placeholder('https://twitter.com/johndoe')
            ->set_save_as('link'),
        (new PuzzleField)->set_name(__('LinkedIn Link', 'puzzle-page-builder'))
            ->set_id('linkedin')
            ->set_input_type('text')
            ->set_placeholder('https://www.linkedin.com/in/johndoe')
            ->set_save_as('link')
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
        $f->field('main_content')
    ));

$puzzle_sections->add_section($team_members);
?>
